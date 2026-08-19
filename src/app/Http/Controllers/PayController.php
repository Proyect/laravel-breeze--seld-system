<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\Payments\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PayController extends Controller
{
    public function __construct(private PaymentService $paymentService)
    {
    }

    public function index(): View
    {
        $payments = Payment::with('sale')->latest()->get();

        return view('pay.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sale_id' => ['nullable', 'integer', 'exists:sales,id'],
            'amount' => ['required', 'numeric', 'min:0.5'],
            'currency' => ['nullable', 'string', 'size:3'],
            'method' => ['nullable', 'string', 'max:50'],
        ]);

        $currency = strtoupper($data['currency'] ?? 'ARS');

        $payment = Payment::create([
            'sale_id' => $data['sale_id'] ?? null,
            'amount' => $data['amount'],
            'currency' => $currency,
            'method' => $data['method'] ?? ($currency === 'ARS' ? 'mercadopago' : 'stripe'),
            'status' => 'active',
            'payment_status' => 'pending',
        ]);

        $intent = $this->paymentService->createPayment($payment);

        if ($request->expectsJson()) {
            return response()->json($intent);
        }

        if (! empty($intent['redirect_url'])) {
            return redirect()->away($intent['redirect_url']);
        }

        return back()->with('error', 'No se pudo iniciar el pago. Verificá la configuración de la pasarela.');
    }

    public function success(Request $request): View
    {
        $payment = null;

        if ($request->filled('payment_id')) {
            $payment = Payment::find($request->payment_id);
            if ($payment && $payment->payment_status === 'pending') {
                $payment->update(['payment_status' => 'approved']);
            }
        }

        return view('pay.success', compact('payment'));
    }

    public function cancel(Request $request): View
    {
        $payment = $request->filled('payment_id')
            ? Payment::find($request->payment_id)
            : null;

        if ($payment && $payment->payment_status === 'pending') {
            $payment->update(['payment_status' => 'rejected']);
        }

        return view('pay.cancel', compact('payment'));
    }
}
