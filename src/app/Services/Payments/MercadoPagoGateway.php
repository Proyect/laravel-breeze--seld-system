<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class MercadoPagoGateway implements PaymentGateway
{
    public function createPaymentIntent(Payment $payment): array
    {
        $accessToken = Config::get('services.mercadopago.access_token');
        $publicKey = Config::get('services.mercadopago.public_key');

        // Si el SDK de Mercado Pago está instalado, usamos Checkout Pro para crear una preferencia
        if ($accessToken && class_exists('MercadoPago\\SDK') && class_exists('MercadoPago\\Preference')) {
            \MercadoPago\SDK::setAccessToken($accessToken);

            $preference = new \MercadoPago\Preference();
            $preference->items = [
                [
                    'title' => 'Pago #' . $payment->id,
                    'quantity' => 1,
                    'unit_price' => (float) $payment->amount,
                    'currency_id' => $payment->currency ?: 'ARS',
                ],
            ];

            $preference->back_urls = [
                'success' => Config::get('app.url') . '/payments/success?payment_id=' . $payment->id,
                'failure' => Config::get('app.url') . '/payments/cancel?payment_id=' . $payment->id,
                'pending' => Config::get('app.url') . '/payments/success?payment_id=' . $payment->id,
            ];

            $preference->auto_return = 'approved';
            $preference->external_reference = (string) $payment->id;
            $preference->notification_url = Config::get('app.url') . '/webhooks/mercadopago';
            $preference->save();

            $payment->provider_payment_id = $preference->id;
            $payment->save();

            return [
                'provider' => 'mercadopago',
                'public_key' => $publicKey,
                'payment_id' => $payment->id,
                'amount' => $payment->amount,
                'currency' => $payment->currency,
                'redirect_url' => $preference->init_point,
            ];
        }

        // Si no hay SDK instalado, devolvemos datos básicos para que el frontend actúe o para mostrar un error controlado
        return [
            'provider' => 'mercadopago',
            'public_key' => $publicKey,
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'redirect_url' => null,
        ];
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

        $response = \Illuminate\Support\Facades\Http::withToken($accessToken)
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
