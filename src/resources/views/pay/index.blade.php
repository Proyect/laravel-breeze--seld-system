@extends('layouts.app')
@section('content')

<div class="container py-4">
    <h2 class="mb-4">Pagos</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">Nuevo pago</div>
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST" class="row g-3" id="payment-form">
                @csrf
                <div class="col-md-4">
                    <label class="form-label">Venta pendiente</label>
                    <select name="sale_id" id="sale_id" class="form-select">
                        <option value="">Sin venta asociada</option>
                        @foreach($pendingSales as $sale)
                            <option value="{{ $sale->id }}" data-amount="{{ $sale->total_amount }}">
                                #{{ $sale->id }} — ${{ number_format($sale->total_amount, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Monto</label>
                    <input type="number" step="0.01" name="amount" id="amount" class="form-control" required min="0.5" value="{{ old('amount') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Moneda</label>
                    <select name="currency" class="form-select">
                        <option value="ARS">ARS</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Iniciar pago</button>
                </div>
            </form>
            <p class="text-muted small mt-3 mb-0">ARS usa Mercado Pago. USD u otras monedas usan Stripe. Sin claves en `.env`, el pago se registra pero no redirige.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Venta</th>
                    <th>Proveedor</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>
                            @if($payment->sale_id)
                                <a href="{{ route('sales.show', $payment->sale_id) }}">#{{ $payment->sale_id }}</a>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $payment->provider ?? '—' }}</td>
                        <td>{{ $payment->currency }} {{ number_format($payment->amount, 2, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $payment->payment_status === 'approved' ? 'success' : ($payment->payment_status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ $payment->payment_status }}
                            </span>
                        </td>
                        <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No hay pagos registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $payments->links() }}
    </div>
</div>

<script>
document.getElementById('sale_id')?.addEventListener('change', function () {
    const option = this.options[this.selectedIndex];
    const amount = option?.dataset?.amount;
    if (amount) {
        document.getElementById('amount').value = amount;
    }
});
</script>
@endsection
