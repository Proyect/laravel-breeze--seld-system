@extends('layouts.app')
@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Productos</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_data" onclick="newData()">
            <i class="bi bi-plus-circle"></i> Nuevo producto
        </button>
    </div>

    <table id="data" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="modal_data" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="registration-form">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" required>
                        </div>
                        <div class="col mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Confirmar</h5></div>
            <div class="modal-body">¿Eliminar este producto?</div>
            <div class="modal-footer">
                <form id="delete-form">
                    <input type="hidden" id="delete-id">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="toast" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-body" id="body_toast"></div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></div>
    </div></div>
</div>

<script>
function newData() {
    $('#registration-form')[0].reset();
    $('#id').val('');
}
</script>
<script src="{{ asset('media/js/products.js') }}"></script>
@endsection
