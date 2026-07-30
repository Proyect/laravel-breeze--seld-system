<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StripeWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_stripe_checkout_completed_approves_payment(): void
    {
        $secret = 'whsec_test_secret';
        config(['services.stripe.webhook_secret' => $secret]);

        $user = User::factory()->create();
        $sale = Sales::query()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 25,
        ]);
        $payment = Payment::query()->create([
            'sale_id' => $sale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 25,
            'currency' => 'USD',
            'provider' => 'stripe',
            'provider_payment_id' => 'cs_test_123',
            'payment_status' => 'pending',
            'metadata' => [],
        ]);

        $payload = json_encode([
            'id' => 'evt_test_1',
            'object' => 'event',
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'id' => 'cs_test_123',
                    'object' => 'checkout.session',
                    'payment_intent' => 'pi_test_999',
                ],
            ],
        ], JSON_THROW_ON_ERROR);

        $timestamp = time();
        $signature = hash_hmac('sha256', $timestamp.'.'.$payload, $secret);

        $this->call(
            'POST',
            '/webhooks/stripe',
            [],
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Stripe-Signature' => "t={$timestamp},v1={$signature}",
            ],
            $payload
        )->assertOk();

        $payment->refresh();
        $this->assertSame('approved', $payment->payment_status);
        $this->assertSame('pi_test_999', $payment->metadata['stripe_payment_intent']);
    }

    public function test_stripe_payment_intent_failed_marks_rejected_via_metadata(): void
    {
        $secret = 'whsec_test_secret';
        config(['services.stripe.webhook_secret' => $secret]);

        $user = User::factory()->create();
        $sale = Sales::query()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 40,
        ]);
        $payment = Payment::query()->create([
            'sale_id' => $sale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 40,
            'currency' => 'USD',
            'provider' => 'stripe',
            'provider_payment_id' => 'cs_test_456',
            'payment_status' => 'pending',
            'metadata' => ['stripe_payment_intent' => 'pi_failed_1'],
        ]);

        $payload = json_encode([
            'id' => 'evt_test_2',
            'object' => 'event',
            'type' => 'payment_intent.payment_failed',
            'data' => [
                'object' => [
                    'id' => 'pi_failed_1',
                    'object' => 'payment_intent',
                ],
            ],
        ], JSON_THROW_ON_ERROR);

        $timestamp = time();
        $signature = hash_hmac('sha256', $timestamp.'.'.$payload, $secret);

        $this->call(
            'POST',
            '/webhooks/stripe',
            [],
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Stripe-Signature' => "t={$timestamp},v1={$signature}",
            ],
            $payload
        )->assertOk();

        $this->assertSame('rejected', $payment->fresh()->payment_status);
    }
}
