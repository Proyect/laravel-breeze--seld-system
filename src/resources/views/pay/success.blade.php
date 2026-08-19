@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body p-5">
            <div class="text-success mb-3" style="font-size: 4rem;">✓</div>
            <h2 class="mb-3">¡Pago exitoso!</h2>
            @if($payment)
                <p>Pago #{{ $payment->id }} — {{ $payment->currency }} {{ number_format($payment->amount, 2) }}</p>
            @endif
            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Ir al panel</a>
            <a href="/" class="btn btn-outline-secondary mt-3">Volver al inicio</a>
        </div>
    </div>
</div>
@endsection
