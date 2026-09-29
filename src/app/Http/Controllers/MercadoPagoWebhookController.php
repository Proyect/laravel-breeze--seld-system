<?php

namespace App\Http\Controllers;

use App\Services\Payments\MercadoPagoGateway;
use Illuminate\Http\Request;

class MercadoPagoWebhookController extends Controller
{
    private MercadoPagoGateway $gateway;

    public function __construct(MercadoPagoGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function handle(Request $request)
    {
        $expected = config('services.mercadopago.notification_token');

        if ($expected === null) {
            abort(403, 'Token de notificación no configurado.');
        }

        if ($request->query('token') !== $expected) {
            abort(403, 'Token de notificación inválido.');
        }

        $this->gateway->handleWebhook($request);

        return response()->json(['status' => 'ok']);
    }
}
