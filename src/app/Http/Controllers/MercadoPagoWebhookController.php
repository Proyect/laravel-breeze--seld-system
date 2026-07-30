<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidWebhookSignatureException;
use App\Services\Payments\MercadoPagoGateway;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MercadoPagoWebhookController extends Controller
{
    public function __construct(private MercadoPagoGateway $gateway)
    {
    }

    public function handle(Request $request): JsonResponse
    {
        try {
            $this->gateway->handleWebhook($request);
        } catch (InvalidWebhookSignatureException $e) {
            Log::warning('Mercado Pago webhook rejected', ['message' => $e->getMessage()]);

            return response()->json(['error' => 'Invalid signature'], 400);
        } catch (\Throwable $e) {
            Log::error('Mercado Pago webhook failed', ['message' => $e->getMessage()]);

            return response()->json(['error' => 'Webhook processing failed'], 500);
        }

        return response()->json(['status' => 'ok']);
    }
}
