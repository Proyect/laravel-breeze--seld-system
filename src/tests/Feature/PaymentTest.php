<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\CreatesUsers;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

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
        $other = \App\Models\User::factory()->create(['role' => 'user']);
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
        $other = \App\Models\User::factory()->create(['role' => 'user']);

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

    public function test_stripe_webhook_endpoint_responds(): void
    {
        $this->postJson('/webhooks/stripe', [])
            ->assertOk()
            ->assertJson(['status' => 'ok']);
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
}
