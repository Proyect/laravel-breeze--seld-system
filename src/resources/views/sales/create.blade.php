@extends('layouts.app')
@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Nueva venta</h2>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($products->isEmpty())
        <div class="alert alert-warning">
            No hay productos activos con stock disponible.
            @if(auth()->user()->isAdmin())
                <a href="{{ route('products.index') }}">Administrar productos</a>
            @endif
        </div>
    @else
        <form action="{{ route('sales.store') }}" method="POST" id="sale-form">
            @csrf
            <div class="card mb-4">
                <div class="card-header">Seleccioná productos</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th style="width:140px">Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr data-price="{{ $product->price }}">
                                        <td>
                                            <strong>{{ $product->name }}</strong>
                                            @if($product->description)
                                                <div class="text-muted small">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</div>
                                            @endif
                                        </td>
                                        <td>${{ number_format($product->price, 2, ',', '.') }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <input type="number"
                                                   name="products[{{ $product->id }}]"
                                                   class="form-control qty-input"
                                                   min="0"
                                                   max="{{ $product->stock }}"
                                                   value="0">
                                        </td>
                                        <td class="subtotal">$0,00</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total estimado</th>
                                    <th id="grand-total">$0,00</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" id="submit-sale" disabled>
                Crear venta
            </button>
        </form>
    @endif
</div>

<script>
document.querySelectorAll('.qty-input').forEach(function (input) {
    input.addEventListener('input', recalculate);
});

function formatMoney(value) {
    return '$' + value.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function recalculate() {
    let total = 0;
    let hasItems = false;

    document.querySelectorAll('tbody tr[data-price]').forEach(function (row) {
        const price = parseFloat(row.dataset.price);
        const qty = parseInt(row.querySelector('.qty-input').value || '0', 10);
        const subtotal = price * Math.max(qty, 0);
        row.querySelector('.subtotal').textContent = formatMoney(subtotal);
        total += subtotal;
        if (qty > 0) hasItems = true;
    });

    document.getElementById('grand-total').textContent = formatMoney(total);
    document.getElementById('submit-sale').disabled = !hasItems;
}

document.getElementById('sale-form')?.addEventListener('submit', function (e) {
    document.querySelectorAll('.qty-input').forEach(function (input) {
        if (parseInt(input.value || '0', 10) <= 0) {
            input.disabled = true;
        }
    });
});
</script>
@endsection
