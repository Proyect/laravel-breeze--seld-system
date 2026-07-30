<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Illuminate\Http\Request;

interface PaymentGateway
{
    public function createPaymentIntent(Payment $payment): array;

    /**
     * @throws \App\Exceptions\InvalidWebhookSignatureException
     * @throws \RuntimeException
     */
    public function handleWebhook(Request $request): void;
}
