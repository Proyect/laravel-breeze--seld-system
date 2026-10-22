<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MercadoPagoGateway implements PaymentGateway
{
    public function createPaymentIntent(Payment $payment): array
    {
        $accessToken = Config::get('services.mercadopago.access_token');
        $publicKey = Config::get('services.mercadopago.public_key');
        $appUrl = rtrim(Config::get('app.url'), '/');

        $base = [
            'provider' => 'mercadopago',
            'public_key' => $publicKey,
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'redirect_url' => null,
        ];

        if (! $accessToken) {
            return $base;
        }

        $preference = $this->createPreferenceViaApi($payment, $accessToken, $appUrl);

        if ($preference) {
            $payment->provider_payment_id = $preference['id'];
            $payment->save();

            return array_merge($base, [
                'redirect_url' => $preference['init_point'] ?? $preference['sandbox_init_point'] ?? null,
            ]);
        }

        return $base;
    }

    private function createPreferenceViaApi(Payment $payment, string $accessToken, string $appUrl): ?array
    {
        $notificationToken = Config::get('services.mercadopago.notification_token');
        $notificationUrl = $appUrl.'/webhooks/mercadopago';

        if ($notificationToken) {
            $notificationUrl .= '?token='.urlencode($notificationToken);
        }

        $payload = [
            'items' => [
                [
                    'title' => 'Pago #'.$payment->id,
                    'quantity' => 1,
                    'unit_price' => (float) $payment->amount,
                    'currency_id' => $payment->currency ?: 'ARS',
                ],
            ],
            'back_urls' => [
                'success' => $appUrl.'/payments/success?payment_id='.$payment->id,
                'failure' => $appUrl.'/payments/cancel?payment_id='.$payment->id,
                'pending' => $appUrl.'/payments/success?payment_id='.$payment->id,
            ],
            'auto_return' => 'approved',
            'external_reference' => (string) $payment->id,
            'notification_url' => $notificationUrl,
        ];

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->timeout(15)
            ->post('https://api.mercadopago.com/checkout/preferences', $payload);

        if ($response->successful()) {
            return $response->json();
        }

        Log::warning('Mercado Pago preference failed', [
            'status' => $response->status(),
            'body' => $response->json(),
        ]);

        return null;
    }

    public function handleWebhook(Request $request): void
    {
        $accessToken = Config::get('services.mercadopago.access_token');

        if (! $accessToken) {
            return;
        }

        $topic = $request->input('type') ?? $request->input('topic');
        $dataId = $request->input('data.id') ?? $request->input('id');

        if (! in_array($topic, ['payment', 'payment.created', 'payment.updated'], true) || ! $dataId) {
            return;
        }

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->timeout(15)
            ->get('https://api.mercadopago.com/v1/payments/'.rawurlencode((string) $dataId));

        if (! $response->successful()) {
            Log::warning('Mercado Pago: no se pudo consultar el pago', [
                'mp_payment_id' => $dataId,
                'status' => $response->status(),
            ]);
            abort(502, 'No se pudo consultar el pago.');
        }

        $paymentData = $response->json();
        $externalReference = $paymentData['external_reference'] ?? null;
        $status = $paymentData['status'] ?? null;

        if (! $externalReference) {
            return;
        }

        $payment = Payment::find($externalReference);

        if (! $payment) {
            return;
        }

        $payment->provider_payment_id = (string) $dataId;
        $payment->metadata = array_merge($payment->metadata ?? [], [
            'mercadopago_payment_id' => $dataId,
            'mercadopago_status' => $status,
        ]);

        if ($status === 'approved' && ! $this->amountMatches($payment, $paymentData)) {
            Log::error('Mercado Pago: monto/moneda pagados no coinciden con el pago', [
                'payment_id' => $payment->id,
                'expected' => [$payment->amount, $payment->currency],
                'received' => [$paymentData['transaction_amount'] ?? null, $paymentData['currency_id'] ?? null],
            ]);
            $payment->save();

            return;
        }

        $mappedStatus = match ($status) {
            'approved' => 'approved',
            'rejected', 'cancelled' => 'rejected',
            'refunded' => 'refunded',
            default => 'pending',
        };

        if ($payment->payment_status === $mappedStatus) {
            return;
        }

        match ($mappedStatus) {
            'approved' => $payment->markAsApproved(),
            'rejected' => $payment->markAsRejected(),
            'refunded' => $payment->markAsRefunded(),
            default => $payment->save(),
        };
    }

    private function amountMatches(Payment $payment, array $paymentData): bool
    {
        if (! isset($paymentData['transaction_amount'])) {
            return false;
        }

        $paidCents = (int) round(((float) $paymentData['transaction_amount']) * 100);
        $expectedCents = (int) round($payment->amount * 100);
        $currency = strtoupper((string) ($paymentData['currency_id'] ?? $payment->currency));

        return $paidCents === $expectedCents && $currency === strtoupper($payment->currency);
    }
}
