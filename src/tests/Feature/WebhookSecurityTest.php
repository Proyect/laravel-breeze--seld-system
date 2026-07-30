<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebhookSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_stripe_webhook_rejects_invalid_signature_without_csrf(): void
    {
        config([
            'services.stripe.webhook_secret' => 'whsec_test_secret',
        ]);

        $response = $this->postJson('/webhooks/stripe', [
            'type' => 'checkout.session.completed',
        ], [
            'Stripe-Signature' => 'invalid',
        ]);

        $response->assertStatus(400);
    }

    public function test_stripe_webhook_fails_when_secret_missing(): void
    {
        config([
            'services.stripe.webhook_secret' => null,
        ]);

        $response = $this->postJson('/webhooks/stripe', []);

        $response->assertStatus(500);
    }

    public function test_mercadopago_webhook_rejects_invalid_signature_when_configured(): void
    {
        config([
            'services.mercadopago.access_token' => 'TEST-TOKEN',
            'services.mercadopago.webhook_secret' => 'mp_secret',
        ]);

        $response = $this->postJson('/webhooks/mercadopago', [
            'type' => 'payment',
            'data' => ['id' => '123'],
        ], [
            'x-signature' => 'ts=1,v1=invalid',
            'x-request-id' => 'req-1',
        ]);

        $response->assertStatus(400);
    }
}
