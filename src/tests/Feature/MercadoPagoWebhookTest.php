<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MercadoPagoWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_mercadopago_webhook_approves_payment_from_provider_payload(): void
    {
        config([
            'services.mercadopago.access_token' => 'TEST-TOKEN',
            'services.mercadopago.webhook_secret' => null,
        ]);

        $user = User::factory()->create();
        $sale = Sales::query()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 120,
        ]);
        $payment = Payment::query()->create([
            'sale_id' => $sale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 120,
            'currency' => 'ARS',
            'provider' => 'mercadopago',
            'provider_payment_id' => 'pref-1',
            'payment_status' => 'pending',
        ]);

        Http::fake([
            'https://api.mercadopago.com/v1/payments/555' => Http::response([
                'id' => 555,
                'status' => 'approved',
                'external_reference' => (string) $payment->id,
            ], 200),
        ]);

        $this->postJson('/webhooks/mercadopago', [
            'type' => 'payment',
            'data' => ['id' => '555'],
        ])->assertOk();

        $payment->refresh();
        $this->assertSame('approved', $payment->payment_status);
        $this->assertSame('555', $payment->metadata['mercadopago_payment_id']);
    }

    public function test_mercadopago_webhook_is_idempotent_for_approved_payments(): void
    {
        config([
            'services.mercadopago.access_token' => 'TEST-TOKEN',
            'services.mercadopago.webhook_secret' => null,
        ]);

        $user = User::factory()->create();
        $sale = Sales::query()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 10,
        ]);
        $payment = Payment::query()->create([
            'sale_id' => $sale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 10,
            'currency' => 'ARS',
            'provider' => 'mercadopago',
            'payment_status' => 'approved',
            'metadata' => ['mercadopago_payment_id' => '555'],
        ]);

        Http::fake([
            'https://api.mercadopago.com/v1/payments/555' => Http::response([
                'id' => 555,
                'status' => 'approved',
                'external_reference' => (string) $payment->id,
            ], 200),
        ]);

        $this->postJson('/webhooks/mercadopago', [
            'type' => 'payment',
            'data' => ['id' => '555'],
        ])->assertOk();

        $this->assertSame('approved', $payment->fresh()->payment_status);
    }

    public function test_mercadopago_webhook_accepts_valid_signature(): void
    {
        $secret = 'mp_secret';
        $dataId = '777';
        $requestId = 'req-abc';
        $ts = (string) time();
        $manifest = "id:{$dataId};request-id:{$requestId};ts:{$ts};";
        $hash = hash_hmac('sha256', $manifest, $secret);

        config([
            'services.mercadopago.access_token' => 'TEST-TOKEN',
            'services.mercadopago.webhook_secret' => $secret,
        ]);

        $user = User::factory()->create();
        $sale = Sales::query()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 33,
        ]);
        $payment = Payment::query()->create([
            'sale_id' => $sale->id,
            'method' => 'online',
            'status' => 'active',
            'amount' => 33,
            'currency' => 'ARS',
            'provider' => 'mercadopago',
            'payment_status' => 'pending',
        ]);

        Http::fake([
            'https://api.mercadopago.com/v1/payments/777' => Http::response([
                'id' => 777,
                'status' => 'rejected',
                'external_reference' => (string) $payment->id,
            ], 200),
        ]);

        $this->postJson('/webhooks/mercadopago', [
            'type' => 'payment',
            'data' => ['id' => $dataId],
        ], [
            'x-signature' => "ts={$ts},v1={$hash}",
            'x-request-id' => $requestId,
        ])->assertOk();

        $this->assertSame('rejected', $payment->fresh()->payment_status);
    }
}
