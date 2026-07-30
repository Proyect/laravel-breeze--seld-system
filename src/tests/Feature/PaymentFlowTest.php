<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_only_sees_own_payments_in_index(): void
    {
        $owner = User::factory()->create(['role' => 'user']);
        $other = User::factory()->create(['role' => 'user']);

        $ownerSale = Sales::query()->create([
            'user_id' => $owner->id,
            'status' => 'pending',
            'total_amount' => 100,
        ]);
        $otherSale = Sales::query()->create([
            'user_id' => $other->id,
            'status' => 'pending',
            'total_amount' => 200,
        ]);

        $ownPayment = Payment::query()->create([
            'sale_id' => $ownerSale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 100,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);
        Payment::query()->create([
            'sale_id' => $otherSale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 200,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        $response = $this->actingAs($owner)->get('/payments');

        $response->assertOk();
        $payments = $response->viewData('pay');
        $this->assertCount(1, $payments);
        $this->assertTrue($payments->first()->is($ownPayment));
    }

    public function test_admin_can_see_all_payments(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        $sale = Sales::query()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 50,
        ]);

        Payment::query()->create([
            'sale_id' => $sale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 50,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->get('/payments');
        $response->assertOk();
        $this->assertCount(1, $response->viewData('pay'));
    }

    public function test_payment_store_requires_existing_sale(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->postJson('/payments', [
                'sale_id' => 999,
            ])
            ->assertStatus(422);
    }

    public function test_payment_success_and_cancel_are_owner_only(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();

        $sale = Sales::query()->create([
            'user_id' => $owner->id,
            'status' => 'pending',
            'total_amount' => 80,
        ]);

        $payment = Payment::query()->create([
            'sale_id' => $sale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 80,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        $this->actingAs($owner)
            ->get('/payments/success?payment_id='.$payment->id)
            ->assertOk();

        $this->actingAs($owner)
            ->get('/payments/cancel?payment_id='.$payment->id)
            ->assertOk();

        $this->actingAs($intruder)
            ->get('/payments/success?payment_id='.$payment->id)
            ->assertForbidden();
    }

    public function test_sale_with_zero_amount_is_rejected(): void
    {
        $user = User::factory()->create();
        $sale = Sales::query()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 0,
        ]);

        $this->actingAs($user)
            ->postJson('/payments', ['sale_id' => $sale->id])
            ->assertStatus(422);

        $this->assertDatabaseCount('payments', 0);
    }
}
