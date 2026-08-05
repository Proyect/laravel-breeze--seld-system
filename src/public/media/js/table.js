function Load(url = "/users/create") {
    if ($.fn.DataTable.isDataTable('#data')) {
        $('#data').DataTable().destroy();
    }
    $('tbody').empty();
    $.getJSON(url, function (data) {
        $.each(data, function (index, item) {
            const row = '<tr>' +
                '<td>' + item.name + '</td>' +
                '<td>' + (item.lastName || '') + '</td>' +
                '<td>' + (item.phone || '') + '</td>' +
                '<td>' + item.email + '</td>' +
                '<td><i class="bi bi-pencil-square text-primary" title="Edit" name="edt" data-id="' + item.id +
                '" data-name="' + item.name + '" data-lastname="' + (item.lastName || '') +
                '" data-cuil="' + (item.cuil || '') + '" data-phone="' + (item.phone || '') +
                '" data-email="' + item.email + '" data-address="' + (item.address || '') +
                '" data-role="' + (item.role || 'user') +
                '" onclick="FormEdit(this)"></i> - <i class="bi bi-x-square text-danger" title="Delete" data-id="' + item.id + '" onclick="FormDelete(this)"></i></td>' +
                '</tr>';
            $('tbody').append(row);
        });
        $('#data').DataTable();
    });
}

function newData() {
    $("#modal_data #id").val('');
    $("#modal_data #name").val('');
    $("#modal_data #lastName").val('');
    $("#modal_data #cuil").val('');
    $("#modal_data #email").val('');
    $("#modal_data #phone").val('');
    $("#modal_data #address").val('');
    $("#modal_data #password").val('');
    $("#modal_data #role").val('user');
}

function FormEdit(el) {
    const item = $(el).data();
    $("#modal_data #id").val(item.id);
    $("#modal_data #name").val(item.name);
    $("#modal_data #lastName").val(item.lastname);
    $("#modal_data #cuil").val(item.cuil);
    $("#modal_data #email").val(item.email);
    $("#modal_data #phone").val(item.phone);
    $("#modal_data #address").val(item.address);
    $("#modal_data #role").val(item.role);
    $("#modal_data #password").val('');
    $("#modal_data").modal('show');
}

function FormDelete(el) {
    $("#modalDelete #delete-id").val($(el).data('id'));
    $("#modalDelete").modal('show');
}

$("#registration-form").submit(function (event) {
    event.preventDefault();
    const form = $(this).serialize();
    const id = $("#modal_data #id").val();
    const method = id ? "PUT" : "POST";
    const url = id ? "/users/" + id : "/users";

    $.ajax({
        type: method,
        url: url,
        data: form,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            Load();
            $("#toast #body_toast").text(response.mje || "Datos guardados correctamente");
            $("#toast").modal("show");
            $("#modal_data").modal('hide');
        },
        error: function () {
            $("#toast #body_toast").text("Error al guardar los datos");
            $("#toast").modal("show");
        }
    });
});

$("#delete-form").submit(function (event) {
    event.preventDefault();
    const id = $("#modalDelete #delete-id").val();

    $.ajax({
        type: "DELETE",
        url: "/users/" + id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            Load();
            $("#toast #body_toast").text(response.mje || "Usuario eliminado");
            $("#toast").modal("show");
            $("#modalDelete").modal('hide');
        },
        error: function () {
            $("#toast #body_toast").text("Error al eliminar");
            $("#toast").modal("show");
        }
    });
});

$(document).ready(function () {
    Load();
});
