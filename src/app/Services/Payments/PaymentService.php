<?php

namespace App\Services\Payments;

use App\Models\Payment;

class PaymentService
{
    private MercadoPagoGateway $mercadoPagoGateway;
    private StripeGateway $stripeGateway;

    public function __construct(MercadoPagoGateway $mercadoPagoGateway, StripeGateway $stripeGateway)
    {
        $this->mercadoPagoGateway = $mercadoPagoGateway;
        $this->stripeGateway = $stripeGateway;
    }

    public function createPayment(Payment $payment): array
    {
        if ($payment->currency === 'ARS') {
            $payment->provider = 'mercadopago';
            $payment->save();

            return $this->mercadoPagoGateway->createPaymentIntent($payment);
        }

        $payment->provider = 'stripe';
        $payment->save();

        return $this->stripeGateway->createPaymentIntent($payment);
    }
}
