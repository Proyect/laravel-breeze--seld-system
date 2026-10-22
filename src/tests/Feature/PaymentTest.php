<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\CreatesUsers;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use CreatesUsers, RefreshDatabase;

    public function test_authenticated_user_can_view_payments(): void
    {
        $this->actingAs($this->createUser())
            ->get('/payments')
            ->assertOk();
    }

    public function test_guest_cannot_view_payments(): void
    {
        $this->get('/payments')->assertRedirect('/login');
    }

    public function test_user_can_create_payment_record(): void
    {
        $this->actingAs($this->createUser())
            ->postJson('/payments', [
                'amount' => 1500.00,
                'currency' => 'ARS',
            ])
            ->assertOk()
            ->assertJsonStructure(['provider', 'payment_id', 'amount']);

        $this->assertDatabaseHas('payments', [
            'amount' => 1500.00,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);
    }

    public function test_payment_success_does_not_auto_approve(): void
    {
        $user = $this->createUser();
        $payment = Payment::create([
            'user_id' => $user->id,
            'method' => 'mercadopago',
            'status' => 'active',
            'amount' => 100,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        $this->actingAs($user)
            ->get("/payments/success?payment_id={$payment->id}")
            ->assertOk();

        $this->assertEquals('pending', $payment->fresh()->payment_status);
    }

    public function test_user_cannot_pay_another_users_sale(): void
    {
        $owner = $this->createUser();
        $other = User::factory()->create(['role' => 'user']);
        $sale = Sales::create([
            'user_id' => $owner->id,
            'status' => 'pending',
            'total_amount' => 500,
        ]);

        $this->actingAs($other)
            ->post('/payments', [
                'sale_id' => $sale->id,
                'amount' => 500,
                'currency' => 'ARS',
            ])
            ->assertForbidden();
    }

    public function test_user_only_sees_own_payments(): void
    {
        $user = $this->createUser();
        $other = User::factory()->create(['role' => 'user']);

        Payment::create([
            'user_id' => $other->id,
            'method' => 'mercadopago',
            'status' => 'active',
            'amount' => 999,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        $this->actingAs($user)
            ->get('/payments')
            ->assertOk()
            ->assertDontSee('999');
    }

    public function test_payment_success_page_is_accessible(): void
    {
        $user = $this->createUser();
        $payment = Payment::create([
            'user_id' => $user->id,
            'method' => 'mercadopago',
            'status' => 'active',
            'amount' => 100,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        $this->actingAs($user)
            ->get("/payments/success?payment_id={$payment->id}")
            ->assertOk();
    }

    public function test_payment_cancel_page_is_accessible(): void
    {
        $this->actingAs($this->createUser())
            ->get('/payments/cancel')
            ->assertOk();
    }

    public function test_stripe_webhook_without_secret_returns_service_unavailable(): void
    {
        config(['services.stripe.webhook_secret' => null]);

        $this->postJson('/webhooks/stripe', [])->assertStatus(503);
    }

    public function test_stripe_webhook_rejects_invalid_signature(): void
    {
        config(['services.stripe.webhook_secret' => 'whsec_test']);

        $this->call('POST', '/webhooks/stripe', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => 't=1,v1=invalid',
            'CONTENT_TYPE' => 'application/json',
        ], '{}')->assertStatus(400);
    }

    public function test_stripe_webhook_approves_paid_session_with_matching_amount(): void
    {
        $payment = $this->createStripePayment(150);

        $this->postSignedStripeEvent($this->checkoutCompletedEvent('cs_test_1', 15000, 'usd'))
            ->assertOk();

        $this->assertEquals('approved', $payment->fresh()->payment_status);
    }

    public function test_stripe_webhook_ignores_session_with_mismatched_amount(): void
    {
        $payment = $this->createStripePayment(150);

        $this->postSignedStripeEvent($this->checkoutCompletedEvent('cs_test_1', 100, 'usd'))
            ->assertOk();

        $this->assertEquals('pending', $payment->fresh()->payment_status);
    }

    public function test_stripe_webhook_does_not_approve_unpaid_session(): void
    {
        $payment = $this->createStripePayment(150);

        $this->postSignedStripeEvent($this->checkoutCompletedEvent('cs_test_1', 15000, 'usd', 'unpaid'))
            ->assertOk();

        $this->assertEquals('pending', $payment->fresh()->payment_status);
    }

    private function createStripePayment(float $amount): Payment
    {
        return Payment::create([
            'user_id' => $this->createUser()->id,
            'method' => 'stripe',
            'provider' => 'stripe',
            'provider_payment_id' => 'cs_test_1',
            'status' => 'active',
            'amount' => $amount,
            'currency' => 'USD',
            'payment_status' => 'pending',
        ]);
    }

    private function checkoutCompletedEvent(string $sessionId, int $amountTotal, string $currency, string $paymentStatus = 'paid'): array
    {
        return [
            'id' => 'evt_test',
            'object' => 'event',
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'id' => $sessionId,
                    'object' => 'checkout.session',
                    'amount_total' => $amountTotal,
                    'currency' => $currency,
                    'payment_status' => $paymentStatus,
                    'payment_intent' => 'pi_test',
                ],
            ],
        ];
    }

    private function postSignedStripeEvent(array $event)
    {
        $secret = 'whsec_test';
        config(['services.stripe.webhook_secret' => $secret]);

        $payload = json_encode($event);
        $timestamp = time();
        $signature = hash_hmac('sha256', "{$timestamp}.{$payload}", $secret);

        return $this->call('POST', '/webhooks/stripe', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => "t={$timestamp},v1={$signature}",
            'CONTENT_TYPE' => 'application/json',
        ], $payload);
    }

    public function test_mercadopago_webhook_endpoint_responds(): void
    {
        $token = config('services.mercadopago.notification_token');

        $this->postJson("/webhooks/mercadopago?token={$token}", [])
            ->assertOk()
            ->assertJson(['status' => 'ok']);
    }

    public function test_mercadopago_webhook_approves_payment_and_updates_sale(): void
    {
        $user = $this->createUser();
        $sale = Sales::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 500,
        ]);
        $payment = Payment::create([
            'user_id' => $user->id,
            'sale_id' => $sale->id,
            'method' => 'mercadopago',
            'status' => 'active',
            'amount' => 500,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        config(['services.mercadopago.access_token' => 'test-token']);
        $token = config('services.mercadopago.notification_token');

        Http::fake([
            '*' => Http::response([
                'external_reference' => (string) $payment->id,
                'status' => 'approved',
                'transaction_amount' => 500,
                'currency_id' => 'ARS',
            ]),
        ]);

        $this->postJson("/webhooks/mercadopago?token={$token}", [
            'type' => 'payment',
            'data' => ['id' => '123456789'],
        ])->assertOk();

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'api.mercadopago.com/v1/payments/');
        });

        $this->assertEquals('approved', $payment->fresh()->payment_status);
        $this->assertEquals('processing', $sale->fresh()->status);
    }

    public function test_mercadopago_webhook_refunded_restores_stock(): void
    {
        $user = $this->createUser();
        $product = Product::create([
            'name' => 'Web Product',
            'description' => 'Desc',
            'price' => 100,
            'stock' => 10,
            'status' => 'active',
        ]);
        $sale = Sales::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 200,
        ]);
        $sale->products()->attach($product->id, [
            'quantity' => 2,
            'unit_price' => 100,
        ]);
        $sale->details()->create([
            'sales_id' => $sale->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'unit_price' => 100,
            'subtotal' => 200,
        ]);
        $product->decrement('stock', 2);

        $payment = Payment::create([
            'user_id' => $user->id,
            'sale_id' => $sale->id,
            'method' => 'mercadopago',
            'status' => 'active',
            'amount' => 200,
            'currency' => 'ARS',
            'payment_status' => 'approved',
        ]);
        $sale->update(['status' => 'processing']);

        config(['services.mercadopago.access_token' => 'test-token']);
        $token = config('services.mercadopago.notification_token');

        Http::fake([
            '*' => Http::response([
                'external_reference' => (string) $payment->id,
                'status' => 'refunded',
            ]),
        ]);

        $this->postJson("/webhooks/mercadopago?token={$token}", [
            'type' => 'payment',
            'data' => ['id' => '999999'],
        ])->assertOk();

        $this->assertEquals('refunded', $payment->fresh()->payment_status);
        $this->assertEquals(10, $product->fresh()->stock);
    }

    public function test_mercadopago_webhook_rejects_invalid_token(): void
    {
        $this->postJson('/webhooks/mercadopago?token=invalid', [])
            ->assertForbidden();
    }

    public function test_mercadopago_webhook_does_not_approve_mismatched_amount(): void
    {
        $user = $this->createUser();
        $payment = Payment::create([
            'user_id' => $user->id,
            'method' => 'mercadopago',
            'status' => 'active',
            'amount' => 500,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        config(['services.mercadopago.access_token' => 'test-token']);
        $token = config('services.mercadopago.notification_token');

        Http::fake([
            '*' => Http::response([
                'external_reference' => (string) $payment->id,
                'status' => 'approved',
                'transaction_amount' => 1,
                'currency_id' => 'ARS',
            ]),
        ]);

        $this->postJson("/webhooks/mercadopago?token={$token}", [
            'type' => 'payment',
            'data' => ['id' => '123'],
        ])->assertOk();

        $this->assertEquals('pending', $payment->fresh()->payment_status);
    }
}
