@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body p-5">
            <div class="text-danger mb-3" style="font-size: 4rem;">✗</div>
            <h2 class="mb-3">Pago cancelado</h2>
            @if($payment)
                <p>Pago #{{ $payment->id }} no fue completado.</p>
            @endif
            <a href="{{ route('payments.index') }}" class="btn btn-primary mt-3">Intentar de nuevo</a>
            <a href="/" class="btn btn-outline-secondary mt-3">Volver al inicio</a>
        </div>
    </div>
</div>
@endsection
