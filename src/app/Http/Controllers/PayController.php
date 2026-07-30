<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sales;
use App\Services\Payments\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PayController extends Controller
{
    public function __construct(private PaymentService $paymentService)
    {
    }

    public function index(Request $request): View
    {
        $user = $request->user();

        $payments = Payment::query()
            ->with('sale')
            ->when(! $user->isAdmin(), function ($query) use ($user) {
                $query->whereHas('sale', fn ($saleQuery) => $saleQuery->where('user_id', $user->id));
            })
            ->latest()
            ->get();

        return view('pay.index', ['pay' => $payments]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'sale_id' => ['required', 'integer', 'exists:sales,id'],
            'method' => ['nullable', 'string', 'max:50'],
            'provider' => ['nullable', 'in:stripe,mercadopago'],
        ]);

        $sale = Sales::query()->findOrFail($data['sale_id']);
        $user = $request->user();

        if (! $user->isAdmin() && (int) $sale->user_id !== (int) $user->id) {
            abort(403, 'No autorizado para pagar esta venta.');
        }

        if ($sale->total_amount <= 0) {
            return response()->json(['message' => 'La venta no tiene un monto válido.'], 422);
        }

        $provider = $data['provider'] ?? null;

        $payment = new Payment;
        $payment->sale_id = $sale->id;
        $payment->amount = $sale->total_amount;
        $payment->currency = $provider === 'stripe' ? 'USD' : 'ARS';
        $payment->method = $data['method'] ?? 'online';
        $payment->status = 'active';
        $payment->payment_status = 'pending';
        $payment->save();

        try {
            $intent = $this->paymentService->createPayment($payment);
        } catch (\Throwable $e) {
            Log::error('Payment intent creation failed', [
                'payment_id' => $payment->id,
                'message' => $e->getMessage(),
            ]);

            $payment->payment_status = 'rejected';
            $payment->save();

            return response()->json([
                'message' => 'No se pudo iniciar el pago. Intente nuevamente.',
            ], 502);
        }

        return response()->json($intent);
    }

    public function success(Request $request): View|RedirectResponse
    {
        $payment = $this->findOwnedPayment($request);

        return view('pay.success', compact('payment'));
    }

    public function cancel(Request $request): View|RedirectResponse
    {
        $payment = $this->findOwnedPayment($request);

        return view('pay.cancel', compact('payment'));
    }

    private function findOwnedPayment(Request $request): Payment
    {
        $paymentId = $request->validate([
            'payment_id' => ['required', 'integer', 'exists:payments,id'],
        ])['payment_id'];

        $payment = Payment::with('sale')->findOrFail($paymentId);
        $user = $request->user();

        if (
            ! $user->isAdmin()
            && (! $payment->sale || (int) $payment->sale->user_id !== (int) $user->id)
        ) {
            abort(403);
        }

        return $payment;
    }
}
