<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeGateway implements PaymentGateway
{
    public function createPaymentIntent(Payment $payment): array
    {
        $secretKey = Config::get('services.stripe.secret');
        $publicKey = Config::get('services.stripe.public');

        Stripe::setApiKey($secretKey);

        $amountInCents = (int) round($payment->amount * 100);
        $currency = strtolower($payment->currency);

        $session = Session::create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'unit_amount' => $amountInCents,
                    'product_data' => [
                        'name' => 'Pago #' . $payment->id,
                    ],
                ],
                'quantity' => 1,
            ]],
            'success_url' => Config::get('app.url') . '/payments/success?payment_id=' . $payment->id,
            'cancel_url' => Config::get('app.url') . '/payments/cancel?payment_id=' . $payment->id,
        ]);

        $payment->provider_payment_id = $session->id;
        $payment->metadata = [
            'stripe_session_id' => $session->id,
        ];
        $payment->save();

        return [
            'provider' => 'stripe',
            'public_key' => $publicKey,
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'redirect_url' => $session->url,
        ];
    }

    public function handleWebhook(Request $request): void
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = Config::get('services.stripe.webhook_secret');

        if (!$endpointSecret) {
            return;
        }

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
        } catch (\UnexpectedValueException $e) {
            // Payload inválido
            return;
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Firma inválida
            return;
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                /** @var \Stripe\Checkout\Session $session */
                $session = $event->data->object;
                $this->markPaymentAsApprovedBySessionId($session->id);
                break;

            case 'payment_intent.payment_failed':
                // Intento fallido: marcamos el pago como rechazado si lo encontramos
                if (isset($event->data->object->id)) {
                    $intentId = $event->data->object->id;
                    $this->markPaymentAsRejectedByProviderId($intentId);
                }
                break;
        }
    }

    private function markPaymentAsApprovedBySessionId(string $sessionId): void
    {
        $payment = Payment::where('provider_payment_id', $sessionId)->first();

        if ($payment) {
            $payment->payment_status = 'approved';
            $payment->save();
        }
    }

    private function markPaymentAsRejectedByProviderId(string $providerId): void
    {
        $payment = Payment::where('provider_payment_id', $providerId)->first();

        if ($payment) {
            $payment->payment_status = 'rejected';
            $payment->save();
        }
    }
}
