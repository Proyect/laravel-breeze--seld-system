@extends('layouts.app')
@section('content')

@php
    $statusClass = [
        'pending' => 'warning',
        'processing' => 'info',
        'shipped' => 'primary',
        'completed' => 'success',
    ];
@endphp

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Venta #{{ $sale->id }}</h2>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Información</div>
                <div class="card-body">
                    <p><strong>Cliente:</strong> {{ $sale->user->name }} {{ $sale->user->lastName }}</p>
                    <p><strong>Email:</strong> {{ $sale->user->email }}</p>
                    <p>
                        <strong>Estado:</strong>
                        <span class="badge bg-{{ $statusClass[$sale->status] ?? 'secondary' }}">{{ $sale->status }}</span>
                    </p>
                    <p><strong>Total:</strong> ${{ number_format($sale->total_amount, 2, ',', '.') }}</p>
                    <p><strong>Fecha:</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            @if(auth()->user()->isAdmin())
                <div class="card mb-3">
                    <div class="card-header">Actualizar estado</div>
                    <div class="card-body">
                        <form action="{{ route('sales.update', $sale) }}" method="POST" class="d-flex gap-2 align-items-end">
                            @csrf
                            @method('PUT')
                            <div class="flex-grow-1">
                                <label class="form-label">Estado</label>
                                <select name="status" class="form-select">
                                    @foreach(['pending', 'processing', 'shipped', 'completed'] as $status)
                                        <option value="{{ $status }}" @selected($sale->status === $status)>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cant.</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>${{ number_format($product->pivot->unit_price, 2, ',', '.') }}</td>
                                    <td>${{ number_format($product->pivot->unit_price * $product->pivot->quantity, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($sale->status === 'pending')
        <form action="{{ route('payments.store') }}" method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
            <input type="hidden" name="amount" value="{{ $sale->total_amount }}">
            <input type="hidden" name="currency" value="ARS">
            <button type="submit" class="btn btn-success btn-lg">Pagar con Mercado Pago / Stripe</button>
        </form>
    @endif

    @if($sale->payments->count())
        <div class="card mt-4">
            <div class="card-header">Pagos asociados</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Proveedor</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->provider ?? '—' }}</td>
                                <td>{{ $payment->currency }} {{ number_format($payment->amount, 2, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ $payment->payment_status === 'approved' ? 'success' : ($payment->payment_status === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ $payment->payment_status }}
                                    </span>
                                </td>
                                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
