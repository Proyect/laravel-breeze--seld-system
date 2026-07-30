@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="h3 mb-3">Pago recibido</h1>
    <p class="mb-2">Gracias. Registramos tu intento de pago #{{ $payment->id }}.</p>
    <p class="text-muted mb-4">Estado actual: <strong>{{ $payment->payment_status }}</strong></p>
    <a href="{{ route('payments.index') }}" class="btn btn-primary">Volver a pagos</a>
</div>
@endsection
