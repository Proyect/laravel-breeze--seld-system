<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sales;
use App\Services\Payments\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PayController extends Controller
{
    public function __construct(private PaymentService $paymentService)
    {
    }

    public function index(): View
    {
        $this->authorize('viewAny', Payment::class);

        $user = auth()->user();

        $query = Payment::with('sale')->latest();

        if (! $user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $payments = $query->paginate(20);

        $pendingSalesQuery = Sales::where('status', 'pending')->latest();
        if (! $user->isAdmin()) {
            $pendingSalesQuery->where('user_id', $user->id);
        }
        $pendingSales = $pendingSalesQuery->get();

        return view('pay.index', compact('payments', 'pendingSales'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Payment::class);

        $data = $request->validate([
            'sale_id' => ['nullable', 'integer', 'exists:sales,id'],
            'amount' => ['required', 'numeric', 'min:0.5'],
            'currency' => ['nullable', 'string', 'size:3'],
            'method' => ['nullable', 'string', 'max:50'],
        ]);

        $sale = null;

        if (! empty($data['sale_id'])) {
            $sale = Sales::findOrFail($data['sale_id']);

            $this->authorize('view', $sale);

            if ($sale->status !== 'pending') {
                return back()->with('error', 'Solo se pueden pagar ventas en estado pending.');
            }

            $saleCents = (int) round($sale->total_amount * 100);
            $amountCents = (int) round($data['amount'] * 100);

            if ($saleCents !== $amountCents) {
                throw ValidationException::withMessages([
                    'amount' => 'El monto no coincide con el total de la venta.',
                ]);
            }
        }

        $currency = strtoupper($data['currency'] ?? 'ARS');

        $payment = Payment::create([
            'user_id' => $sale?->user_id ?? auth()->id(),
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
        $payment = $this->findOwnedPayment($request);

        return view('pay.success', compact('payment'));
    }

    public function cancel(Request $request): View
    {
        $payment = $this->findOwnedPayment($request);

        return view('pay.cancel', compact('payment'));
    }

    private function findOwnedPayment(Request $request): ?Payment
    {
        if (! $request->filled('payment_id')) {
            return null;
        }

        $payment = Payment::find($request->payment_id);

        if (! $payment) {
            return null;
        }

        $this->authorize('view', $payment);

        return $payment;
    }
}
