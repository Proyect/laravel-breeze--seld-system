<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Services\Payments\PaymentService;

class PayController extends Controller
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $pay = Payment::all();
        return view('pay.index',compact('pay'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'sale_id' => ['nullable', 'integer'],
            'amount' => ['required', 'numeric', 'min:0.5'],
            'currency' => ['nullable', 'string', 'size:3'],
            'method' => ['nullable', 'string', 'max:50'],
        ]);

        $payment = new Payment();
        $payment->sale_id = $data['sale_id'] ?? null;
        $payment->amount = $data['amount'];
        $payment->currency = $data['currency'] ?? 'ARS';
        $payment->method = $data['method'] ?? null;
        $payment->status = 'active';
        $payment->payment_status = 'pending';
        $payment->save();

        $intent = $this->paymentService->createPayment($payment);

        return response()->json($intent);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
