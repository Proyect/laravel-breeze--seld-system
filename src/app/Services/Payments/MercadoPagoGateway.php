<?php

namespace App\Services\Payments;

use App\Exceptions\InvalidWebhookSignatureException;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoGateway implements PaymentGateway
{
    public function createPaymentIntent(Payment $payment): array
    {
        $accessToken = Config::get('services.mercadopago.access_token');
        $publicKey = Config::get('services.mercadopago.public_key');

        if (! $accessToken) {
            throw new \RuntimeException('Mercado Pago access token is not configured.');
        }

        MercadoPagoConfig::setAccessToken($accessToken);

        $client = new PreferenceClient;
        $preferenceRequest = [
            'items' => [[
                'title' => 'Pago #'.$payment->id,
                'quantity' => 1,
                'unit_price' => (float) $payment->amount,
                'currency_id' => $payment->currency ?: 'ARS',
            ]],
            'external_reference' => (string) $payment->id,
            'back_urls' => [
                'success' => route('payments.success', ['payment_id' => $payment->id], absolute: true),
                'failure' => route('payments.cancel', ['payment_id' => $payment->id], absolute: true),
                'pending' => route('payments.success', ['payment_id' => $payment->id], absolute: true),
            ],
            'auto_return' => 'approved',
            'notification_url' => route('webhooks.mercadopago', absolute: true),
            'metadata' => [
                'payment_id' => $payment->id,
                'sale_id' => $payment->sale_id,
            ],
        ];

        try {
            $preference = $client->create($preferenceRequest, new RequestOptions);
        } catch (MPApiException $e) {
            Log::error('Mercado Pago preference creation failed', [
                'payment_id' => $payment->id,
                'status' => $e->getApiResponse()?->getStatusCode(),
                'content' => $e->getApiResponse()?->getContent(),
            ]);

            throw new \RuntimeException('Unable to create Mercado Pago preference.', previous: $e);
        }

        $payment->provider_payment_id = $preference->id;
        $payment->metadata = array_merge($payment->metadata ?? [], [
            'mercadopago_preference_id' => $preference->id,
        ]);
        $payment->save();

        return [
            'provider' => 'mercadopago',
            'public_key' => $publicKey,
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'redirect_url' => $preference->init_point,
        ];
    }

    public function handleWebhook(Request $request): void
    {
        $accessToken = Config::get('services.mercadopago.access_token');
        $webhookSecret = Config::get('services.mercadopago.webhook_secret');

        if (! $accessToken) {
            throw new \RuntimeException('Mercado Pago access token is not configured.');
        }

        if ($webhookSecret) {
            $this->assertValidSignature($request, $webhookSecret);
        }

        $type = $request->input('type') ?? $request->input('topic');
        $dataId = $request->input('data.id') ?? $request->input('id');

        if (! $dataId) {
            Log::warning('Mercado Pago webhook missing resource id', [
                'payload' => $request->all(),
            ]);

            return;
        }

        Log::info('Mercado Pago webhook received', [
            'type' => $type,
            'data_id' => $dataId,
        ]);

        if ($type !== null && $type !== 'payment') {
            return;
        }

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->timeout(15)
            ->get('https://api.mercadopago.com/v1/payments/'.$dataId);

        if (! $response->successful()) {
            Log::error('Mercado Pago payment lookup failed', [
                'data_id' => $dataId,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new \RuntimeException('Unable to fetch Mercado Pago payment.');
        }

        $remotePayment = $response->json();
        $externalReference = $remotePayment['external_reference'] ?? null;
        $status = $remotePayment['status'] ?? null;

        $payment = null;
        if ($externalReference) {
            $payment = Payment::find($externalReference);
        }

        if (! $payment) {
            $payment = Payment::query()
                ->where('provider', 'mercadopago')
                ->where(function ($query) use ($dataId) {
                    $query->where('provider_payment_id', $dataId)
                        ->orWhere('metadata->mercadopago_payment_id', $dataId);
                })
                ->first();
        }

        if (! $payment) {
            Log::warning('Mercado Pago webhook without matching local payment', [
                'data_id' => $dataId,
                'external_reference' => $externalReference,
            ]);

            return;
        }

        if ($payment->payment_status === 'approved' && $status === 'approved') {
            return;
        }

        $metadata = $payment->metadata ?? [];
        $metadata['mercadopago_payment_id'] = $dataId;
        $metadata['mercadopago_status'] = $status;
        $payment->metadata = $metadata;

        $payment->payment_status = match ($status) {
            'approved' => 'approved',
            'rejected', 'cancelled' => 'rejected',
            'refunded' => 'refunded',
            default => $payment->payment_status ?: 'pending',
        };

        $payment->save();
    }

    private function assertValidSignature(Request $request, string $secret): void
    {
        $xSignature = $request->header('x-signature');
        $xRequestId = $request->header('x-request-id');
        $dataId = $request->input('data.id') ?? $request->query('data.id');

        if (! $xSignature || ! $xRequestId || ! $dataId) {
            throw new InvalidWebhookSignatureException('Missing Mercado Pago signature headers.');
        }

        $parts = [];
        foreach (explode(',', $xSignature) as $part) {
            [$key, $value] = array_pad(explode('=', trim($part), 2), 2, null);
            if ($key && $value) {
                $parts[$key] = $value;
            }
        }

        $ts = $parts['ts'] ?? null;
        $hash = $parts['v1'] ?? null;

        if (! $ts || ! $hash) {
            throw new InvalidWebhookSignatureException('Malformed Mercado Pago signature.');
        }

        $manifest = "id:{$dataId};request-id:{$xRequestId};ts:{$ts};";
        $expected = hash_hmac('sha256', $manifest, $secret);

        if (! hash_equals($expected, $hash)) {
            throw new InvalidWebhookSignatureException('Invalid Mercado Pago signature.');
        }
    }
}
