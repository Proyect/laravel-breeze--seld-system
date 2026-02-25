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
        $this->gateway->handleWebhook($request);

        return response()->json(['status' => 'ok']);
    }
}
