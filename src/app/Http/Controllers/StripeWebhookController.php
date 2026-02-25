<?php

namespace App\Http\Controllers;

use App\Services\Payments\StripeGateway;
use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    private StripeGateway $gateway;

    public function __construct(StripeGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function handle(Request $request)
    {
        $this->gateway->handleWebhook($request);

        return response()->json(['status' => 'ok']);
    }
}
