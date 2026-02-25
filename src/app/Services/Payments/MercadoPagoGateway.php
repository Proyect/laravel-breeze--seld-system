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
        // Aquí se implementará la lógica para procesar webhooks de Mercado Pago
    }
}
