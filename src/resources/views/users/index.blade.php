@extends('layouts.app')
@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Usuarios</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_data" onclick="newData()">
            <i class="bi bi-plus-circle"></i> Nuevo usuario
        </button>
    </div>

    <table id="data" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="modal_data" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="registration-form">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="cuil" class="form-label">CUIL</label>
                            <input type="text" id="cuil" name="cuil" class="form-control">
                        </div>
                        <div class="col mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select id="role" name="role" class="form-select">
                                <option value="user">Usuario</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="col mb-3">
                            <label for="lastName" class="form-label">Apellido</label>
                            <input type="text" id="lastName" name="lastName" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="col mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" id="address" name="address" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control">
                        <small class="text-muted">Dejar vacío al editar para no cambiarla</small>
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
            <div class="modal-body">¿Eliminar este usuario?</div>
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
    </div></div>
</div>

<script src="{{ asset('media/js/table.js') }}"></script>
@endsection
