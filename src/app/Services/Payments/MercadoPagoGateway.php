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
        $payload = [
            'items' => [
                [
                    'title' => 'Pago #' . $payment->id,
                    'quantity' => 1,
                    'unit_price' => (float) $payment->amount,
                    'currency_id' => $payment->currency ?: 'ARS',
                ],
            ],
            'back_urls' => [
                'success' => $appUrl . '/payments/success?payment_id=' . $payment->id,
                'failure' => $appUrl . '/payments/cancel?payment_id=' . $payment->id,
                'pending' => $appUrl . '/payments/success?payment_id=' . $payment->id,
            ],
            'auto_return' => 'approved',
            'external_reference' => (string) $payment->id,
            'notification_url' => $appUrl . '/webhooks/mercadopago',
        ];

        $response = Http::withToken($accessToken)
            ->acceptJson()
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
            ->get("https://api.mercadopago.com/v1/payments/{$dataId}");

        if (! $response->successful()) {
            return;
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

        $payment->payment_status = match ($status) {
            'approved' => 'approved',
            'rejected', 'cancelled' => 'rejected',
            'refunded' => 'refunded',
            default => 'pending',
        };

        $payment->save();
    }
}
