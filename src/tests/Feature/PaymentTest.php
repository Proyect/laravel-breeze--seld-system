<?php

namespace Tests\Feature;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $sale = \App\Models\Sales::create([
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
        $this->postJson('/webhooks/mercadopago', [])
            ->assertOk()
            ->assertJson(['status' => 'ok']);
    }
}
