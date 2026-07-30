<?php

namespace App\Services\Payments;

use App\Models\Payment;

class PaymentService
{
    public function __construct(
        private MercadoPagoGateway $mercadoPagoGateway,
        private StripeGateway $stripeGateway,
    ) {
    }

    public function createPayment(Payment $payment): array
    {
        $currency = strtoupper($payment->currency ?: 'ARS');

        if ($currency === 'ARS') {
            $payment->provider = 'mercadopago';
            $payment->currency = 'ARS';
            $payment->save();

            return $this->mercadoPagoGateway->createPaymentIntent($payment);
        }

        $payment->provider = 'stripe';
        $payment->save();

        return $this->stripeGateway->createPaymentIntent($payment);
    }
}
