<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeGateway implements PaymentGateway
{
    public function createPaymentIntent(Payment $payment): array
    {
        $secretKey = Config::get('services.stripe.secret');
        $publicKey = Config::get('services.stripe.public');

        $base = [
            'provider' => 'stripe',
            'public_key' => $publicKey,
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'redirect_url' => null,
        ];

        if (! $secretKey) {
            return $base;
        }

        try {
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
                            'name' => 'Pago #'.$payment->id,
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'success_url' => rtrim(Config::get('app.url'), '/').'/payments/success?payment_id='.$payment->id,
                'cancel_url' => rtrim(Config::get('app.url'), '/').'/payments/cancel?payment_id='.$payment->id,
                'metadata' => [
                    'payment_id' => (string) $payment->id,
                ],
            ]);

            $payment->provider_payment_id = $session->id;
            $payment->metadata = array_merge($payment->metadata ?? [], [
                'stripe_session_id' => $session->id,
            ]);
            $payment->save();

            return array_merge($base, [
                'redirect_url' => $session->url,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Stripe checkout session failed', ['error' => $e->getMessage()]);

            return $base;
        }
    }

    public function handleWebhook(Request $request): void
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = Config::get('services.stripe.webhook_secret');

        if (! $endpointSecret) {
            Log::error('Stripe webhook recibido pero STRIPE_WEBHOOK_SECRET no está configurado');
            abort(503, 'Webhook no configurado.');
        }

        try {
            $event = Webhook::constructEvent(
                $payload,
                (string) $sigHeader,
                $endpointSecret
            );
        } catch (\UnexpectedValueException|SignatureVerificationException $e) {
            Log::warning('Stripe webhook con firma inválida', ['error' => $e->getMessage()]);
            abort(400, 'Firma inválida.');
        }

        switch ($event->type) {
            case 'checkout.session.completed':
            case 'checkout.session.async_payment_succeeded':
                /** @var Session $session */
                $session = $event->data->object;
                $this->attachPaymentIntentId($session);
                if (($session->payment_status ?? null) === 'paid') {
                    $this->markPaymentAsApprovedBySession($session);
                }
                break;

            case 'checkout.session.async_payment_failed':
            case 'checkout.session.expired':
                $payment = Payment::where('provider_payment_id', $event->data->object->id)->first();
                if ($payment && $payment->payment_status === 'pending') {
                    $payment->markAsRejected();
                }
                break;

            case 'payment_intent.payment_failed':
                if (isset($event->data->object->id)) {
                    $this->markPaymentAsRejectedByPaymentIntentId($event->data->object->id);
                }
                break;

            case 'charge.refunded':
                $paymentIntentId = $event->data->object->payment_intent ?? null;
                if ($paymentIntentId) {
                    $this->markPaymentAsRefundedByPaymentIntentId($paymentIntentId);
                }
                break;
        }
    }

    private function markPaymentAsApprovedBySession(Session $session): void
    {
        $payment = Payment::where('provider_payment_id', $session->id)->first();

        if (! $payment) {
            return;
        }

        $expectedCents = (int) round($payment->amount * 100);
        $paidCents = (int) ($session->amount_total ?? 0);
        $paidCurrency = strtolower((string) ($session->currency ?? ''));

        if ($paidCents !== $expectedCents || $paidCurrency !== strtolower($payment->currency)) {
            Log::error('Stripe: monto/moneda pagados no coinciden con el pago', [
                'payment_id' => $payment->id,
                'expected' => [$expectedCents, $payment->currency],
                'received' => [$paidCents, $paidCurrency],
            ]);

            return;
        }

        $payment->markAsApproved();
    }

    private function attachPaymentIntentId(Session $session): void
    {
        if (! $session->payment_intent) {
            return;
        }

        $payment = Payment::where('provider_payment_id', $session->id)->first();

        if (! $payment) {
            return;
        }

        $metadata = $payment->metadata ?? [];
        $metadata['stripe_payment_intent_id'] = $session->payment_intent;
        $payment->metadata = $metadata;
        $payment->save();
    }

    private function markPaymentAsRejectedByPaymentIntentId(string $paymentIntentId): void
    {
        $payment = Payment::where('metadata->stripe_payment_intent_id', $paymentIntentId)->first();

        if ($payment) {
            $payment->markAsRejected();
        }
    }

    private function markPaymentAsRefundedByPaymentIntentId(string $paymentIntentId): void
    {
        $payment = Payment::where('metadata->stripe_payment_intent_id', $paymentIntentId)->first();

        if ($payment) {
            $payment->markAsRefunded();
        }
    }
}
