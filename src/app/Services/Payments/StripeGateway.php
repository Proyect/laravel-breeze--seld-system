<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class StripeGateway implements PaymentGateway
{
    public function createPaymentIntent(Payment $payment): array
    {
        $secretKey = Config::get('services.stripe.secret');
        $publicKey = Config::get('services.stripe.public');

        return [
            'provider' => 'stripe',
            'public_key' => $publicKey,
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
        ];
    }

    public function handleWebhook(Request $request): void
    {
        // Aquí se implementará la lógica para procesar webhooks de Stripe
    }
}
