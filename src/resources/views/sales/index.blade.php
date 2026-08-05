@extends('layouts.app')
@section('content')

<div class="container py-4">
    <h2 class="mb-4">Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->user->name ?? 'N/A' }}</td>
                    <td><span class="badge bg-secondary">{{ $sale->status }}</span></td>
                    <td>${{ number_format($sale->total_amount, 2) }}</td>
                    <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                        @if($sale->status === 'pending')
                            <form action="{{ route('payments.store') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                <input type="hidden" name="amount" value="{{ $sale->total_amount }}">
                                <input type="hidden" name="currency" value="ARS">
                                <button type="submit" class="btn btn-sm btn-success">Pagar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No hay ventas registradas</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
