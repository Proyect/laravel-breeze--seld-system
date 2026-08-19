let inquiriesCache = {};

function statusBadge(status) {
    const map = {
        pending: '<span class="badge bg-warning text-dark">Pendiente</span>',
        read: '<span class="badge bg-info">Leída</span>',
        responded: '<span class="badge bg-success">Respondida</span>',
    };
    return map[status] || status;
}

function Load(url = "/inquiries/list/data") {
    if ($.fn.DataTable.isDataTable('#data')) {
        $('#data').DataTable().destroy();
    }
    $('tbody').empty();
    inquiriesCache = {};
    $.getJSON(url, function (data) {
        $.each(data, function (index, item) {
            inquiriesCache[item.id] = item;
            const msg = item.message.length > 60 ? item.message.substring(0, 60) + '…' : item.message;
            const date = item.created_at ? new Date(item.created_at).toLocaleString('es-AR') : '';
            const row = '<tr>' +
                '<td>' + date + '</td>' +
                '<td>' + $('<div>').text(item.name).html() + '</td>' +
                '<td>' + $('<div>').text(item.email).html() + '</td>' +
                '<td>' + $('<div>').text(msg).html() + '</td>' +
                '<td>' + statusBadge(item.status) + '</td>' +
                '<td>' +
                '<i class="bi bi-eye text-primary me-2" style="cursor:pointer" title="Ver" data-id="' + item.id + '" onclick="FormView(this)"></i>' +
                '<i class="bi bi-x-square text-danger" style="cursor:pointer" title="Delete" data-id="' + item.id + '" onclick="FormDelete(this)"></i>' +
                '</td>' +
                '</tr>';
            $('tbody').append(row);
        });
        $('#data').DataTable({ order: [[0, 'desc']] });
    });
}

function FormView(el) {
    const item = inquiriesCache[$(el).data('id')];
    if (!item) return;
    const date = item.created_at ? new Date(item.created_at).toLocaleString('es-AR') : '';
    $('#view-name').text(item.name);
    $('#view-email').text(item.email).attr('href', 'mailto:' + item.email);
    $('#view-date').text(date);
    $('#view-message').text(item.message);
    $('#status-id').val(item.id);
    $('#status').val(item.status);
    $('#modalView').modal('show');
}

function FormDelete(el) {
    $('#delete-id').val($(el).data('id'));
    $('#modalDelete').modal('show');
}

$('#status-form').submit(function (event) {
    event.preventDefault();
    const id = $('#status-id').val();
    $.ajax({
        type: 'PUT',
        url: '/inquiries/' + id,
        data: { status: $('#status').val(), _token: $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            Load();
            $('#toast #body_toast').text(response.mje || 'Estado actualizado');
            $('#toast').modal('show');
            $('#modalView').modal('hide');
        },
        error: function () {
            $('#toast #body_toast').text('Error al actualizar');
            $('#toast').modal('show');
        }
    });
});

$('#delete-form').submit(function (event) {
    event.preventDefault();
    const id = $('#delete-id').val();
    $.ajax({
        type: 'DELETE',
        url: '/inquiries/' + id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            Load();
            $('#toast #body_toast').text(response.mje || 'Consulta eliminada');
            $('#toast').modal('show');
            $('#modalDelete').modal('hide');
        },
        error: function () {
            $('#toast #body_toast').text('Error al eliminar');
            $('#toast').modal('show');
        }
    });
});

$(document).ready(function () {
    Load();
});
