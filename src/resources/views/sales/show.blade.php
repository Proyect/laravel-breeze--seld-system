@extends('layouts.app')
@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Venta #{{ $sale->id }}</h2>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Información</div>
                <div class="card-body">
                    <p><strong>Cliente:</strong> {{ $sale->user->name }} {{ $sale->user->lastName }}</p>
                    <p><strong>Email:</strong> {{ $sale->user->email }}</p>
                    <p><strong>Estado:</strong> <span class="badge bg-secondary">{{ $sale->status }}</span></p>
                    <p><strong>Total:</strong> ${{ number_format($sale->total_amount, 2) }}</p>
                    <p><strong>Fecha:</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead><tr><th>Producto</th><th>Cant.</th><th>Precio</th></tr></thead>
                        <tbody>
                            @foreach($sale->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>${{ number_format($product->pivot->unit_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($sale->status === 'pending')
        <form action="{{ route('payments.store') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
            <input type="hidden" name="amount" value="{{ $sale->total_amount }}">
            <input type="hidden" name="currency" value="ARS">
            <button type="submit" class="btn btn-success btn-lg">Pagar con Mercado Pago / Stripe</button>
        </form>
    @endif

    @if($sale->payments->count())
        <div class="card mt-4">
            <div class="card-header">Pagos</div>
            <div class="card-body">
                @foreach($sale->payments as $payment)
                    <p>#{{ $payment->id }} — {{ $payment->provider }} — {{ $payment->payment_status }} — ${{ number_format($payment->amount, 2) }}</p>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
