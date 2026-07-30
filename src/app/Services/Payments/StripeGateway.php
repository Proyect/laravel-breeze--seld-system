<?php

namespace App\Services\Payments;

use App\Exceptions\InvalidWebhookSignatureException;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use UnexpectedValueException;

class StripeGateway implements PaymentGateway
{
    public function createPaymentIntent(Payment $payment): array
    {
        $secretKey = Config::get('services.stripe.secret');
        $publicKey = Config::get('services.stripe.public');

        if (! $secretKey) {
            throw new \RuntimeException('Stripe secret key is not configured.');
        }

        Stripe::setApiKey($secretKey);

        $amountInCents = (int) round($payment->amount * 100);
        $currency = strtolower($payment->currency ?: 'usd');

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
            'client_reference_id' => (string) $payment->id,
            'metadata' => [
                'payment_id' => (string) $payment->id,
                'sale_id' => (string) ($payment->sale_id ?? ''),
            ],
            'success_url' => route('payments.success', ['payment_id' => $payment->id], absolute: true),
            'cancel_url' => route('payments.cancel', ['payment_id' => $payment->id], absolute: true),
        ]);

        $payment->provider_payment_id = $session->id;
        $payment->metadata = array_merge($payment->metadata ?? [], [
            'stripe_session_id' => $session->id,
            'stripe_payment_intent' => $session->payment_intent ?? null,
        ]);
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

        if (! $endpointSecret) {
            throw new \RuntimeException('Stripe webhook secret is not configured.');
        }

        if (! $sigHeader) {
            throw new InvalidWebhookSignatureException('Missing Stripe-Signature header.');
        }

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (UnexpectedValueException $e) {
            throw new InvalidWebhookSignatureException('Invalid Stripe payload.', previous: $e);
        } catch (SignatureVerificationException $e) {
            throw new InvalidWebhookSignatureException('Invalid Stripe signature.', previous: $e);
        }

        Log::info('Stripe webhook received', [
            'type' => $event->type,
            'id' => $event->id,
        ]);

        switch ($event->type) {
            case 'checkout.session.completed':
                /** @var Session $session */
                $session = $event->data->object;
                $this->markPaymentAsApprovedBySessionId(
                    $session->id,
                    $session->payment_intent ?? null
                );
                break;

            case 'checkout.session.expired':
                /** @var Session $session */
                $session = $event->data->object;
                $this->markPaymentAsRejectedByProviderId($session->id);
                break;

            case 'payment_intent.payment_failed':
                if (isset($event->data->object->id)) {
                    $intentId = $event->data->object->id;
                    $this->markPaymentAsRejectedByPaymentIntent($intentId);
                }
                break;
        }
    }

    private function markPaymentAsApprovedBySessionId(string $sessionId, ?string $paymentIntentId = null): void
    {
        $payment = Payment::where('provider_payment_id', $sessionId)->first();

        if (! $payment) {
            Log::warning('Stripe approved webhook without matching payment', [
                'session_id' => $sessionId,
            ]);

            return;
        }

        if ($payment->payment_status === 'approved') {
            return;
        }

        $metadata = $payment->metadata ?? [];
        if ($paymentIntentId) {
            $metadata['stripe_payment_intent'] = $paymentIntentId;
        }

        $payment->metadata = $metadata;
        $payment->payment_status = 'approved';
        $payment->save();
    }

    private function markPaymentAsRejectedByProviderId(string $providerId): void
    {
        $payment = Payment::where('provider_payment_id', $providerId)->first();

        if (! $payment || $payment->payment_status === 'approved') {
            return;
        }

        $payment->payment_status = 'rejected';
        $payment->save();
    }

    private function markPaymentAsRejectedByPaymentIntent(string $paymentIntentId): void
    {
        $payment = Payment::query()
            ->where('provider', 'stripe')
            ->where(function ($query) use ($paymentIntentId) {
                $query->where('provider_payment_id', $paymentIntentId)
                    ->orWhere('metadata->stripe_payment_intent', $paymentIntentId);
            })
            ->first();

        if (! $payment || $payment->payment_status === 'approved') {
            return;
        }

        $payment->payment_status = 'rejected';
        $payment->save();
    }
}
