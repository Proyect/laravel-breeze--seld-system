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
        <h2 class="mb-0">Ventas</h2>
        <a href="{{ route('sales.create') }}" class="btn btn-primary">Nueva venta</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    @if(auth()->user()->isAdmin())
                        <th>Usuario</th>
                    @endif
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
                        @if(auth()->user()->isAdmin())
                            <td>{{ $sale->user->name ?? 'N/A' }}</td>
                        @endif
                        <td>
                            <span class="badge bg-{{ $statusClass[$sale->status] ?? 'secondary' }}">
                                {{ $sale->status }}
                            </span>
                        </td>
                        <td>${{ number_format($sale->total_amount, 2, ',', '.') }}</td>
                        <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                        <td class="d-flex gap-1 flex-wrap">
                            <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                            @if($sale->status === 'pending')
                                <form action="{{ route('payments.store') }}" method="POST">
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
                    <tr>
                        <td colspan="{{ auth()->user()->isAdmin() ? 6 : 5 }}" class="text-center py-4">
                            No hay ventas registradas.
                            <a href="{{ route('sales.create') }}">Crear la primera</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $sales->links() }}
    </div>
</div>
@endsection
