@extends('layouts.app')
@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Consultas del sitio</h2>
    </div>

    <table id="data" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="modalView" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle de consulta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <span id="view-name"></span></p>
                <p><strong>Email:</strong> <a id="view-email" href="#"></a></p>
                <p><strong>Fecha:</strong> <span id="view-date"></span></p>
                <hr>
                <p id="view-message" class="mb-0"></p>
            </div>
            <div class="modal-footer">
                <form id="status-form" class="d-flex gap-2 align-items-center">
                    <input type="hidden" id="status-id">
                    <select id="status" class="form-select form-select-sm" style="width:auto">
                        <option value="pending">Pendiente</option>
                        <option value="read">Leída</option>
                        <option value="responded">Respondida</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar estado</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Confirmar</h5></div>
            <div class="modal-body">¿Eliminar esta consulta?</div>
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

<script src="{{ asset('media/js/inquiries.js') }}"></script>
@endsection
