<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_amount_is_taken_from_sale_not_request(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $sale = Sales::query()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 150.50,
        ]);

        $this->actingAs($user)
            ->postJson('/payments', [
                'sale_id' => $sale->id,
                'amount' => 1,
                'currency' => 'USD',
            ])
            ->assertStatus(502);

        $payment = Payment::query()->first();

        $this->assertNotNull($payment);
        $this->assertEquals('150.50', $payment->amount);
        $this->assertEquals('ARS', $payment->currency);
        $this->assertEquals('rejected', $payment->payment_status);
    }

    public function test_user_cannot_pay_another_users_sale(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $sale = Sales::query()->create([
            'user_id' => $owner->id,
            'status' => 'pending',
            'total_amount' => 99.00,
        ]);

        $this->actingAs($intruder)
            ->postJson('/payments', [
                'sale_id' => $sale->id,
            ])
            ->assertForbidden();
    }
}
