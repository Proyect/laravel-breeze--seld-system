@extends('layouts.app')
@section('content')

<div class="container py-4">
    <h2 class="mb-4">Pagos</h2>

    <div class="card mb-4">
        <div class="card-header">Nuevo pago</div>
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label class="form-label">Monto</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required min="0.5">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Moneda</label>
                    <select name="currency" class="form-select">
                        <option value="ARS">ARS</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Venta (opcional)</label>
                    <input type="number" name="sale_id" class="form-control" placeholder="ID de venta">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Iniciar pago</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped">
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
                    <td>{{ $payment->sale_id ?? '—' }}</td>
                    <td>{{ $payment->provider ?? '—' }}</td>
                    <td>{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</td>
                    <td><span class="badge bg-{{ $payment->payment_status === 'approved' ? 'success' : ($payment->payment_status === 'rejected' ? 'danger' : 'warning') }}">{{ $payment->payment_status }}</span></td>
                    <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No hay pagos registrados</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
