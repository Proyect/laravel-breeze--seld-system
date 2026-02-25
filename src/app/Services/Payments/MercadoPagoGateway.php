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

        return [
            'provider' => 'mercadopago',
            'public_key' => $publicKey,
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
        ];
    }

    public function handleWebhook(Request $request): void
    {
        // Aquí se implementará la lógica para procesar webhooks de Mercado Pago
    }
}
