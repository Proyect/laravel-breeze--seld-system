function Load(url = "/products/create") {
    if ($.fn.DataTable.isDataTable('#data')) {
        $('#data').DataTable().destroy();
    }
    $('tbody').empty();
    $.getJSON(url, function (data) {
        $.each(data, function (index, item) {
            const row = '<tr>' +
                '<td>' + item.name + '</td>' +
                '<td>' + item.description + '</td>' +
                '<td>' + item.price + '</td>' +
                '<td>' + item.status + '</td>' +
                '<td><i class="bi bi-pencil-square text-primary" title="Edit" name="edt" data-id="' + item.id +
                '" data-name="' + item.name + '" data-description="' + item.description +
                '" data-price="' + item.price + '" data-stock="' + item.stock +
                '" data-status="' + item.status +
                '" onclick="FormEdit(this)"></i> - <i class="bi bi-x-square text-danger" title="Delete" name="del" data-id="' + item.id + '" onclick="FormDelete(this)"></i></td>' +
                '</tr>';
            $('tbody').append(row);
        });
        $('#data').DataTable();
    });
}

function FormEdit(el) {
    const item = $(el).data();
    $("#modal_data #id").val(item.id);
    $("#modal_data #name").val(item.name);
    $("#modal_data #description").val(item.description);
    $("#modal_data #price").val(item.price);
    $("#modal_data #stock").val(item.stock);
    $("#modal_data #status").val(item.status);
    $("#modal_data").modal('show');
}

function FormDelete(el) {
    const id = $(el).data('id');
    $("#modalDelete #delete-id").val(id);
    $("#modalDelete").modal('show');
}

$("#registration-form").submit(function (event) {
    event.preventDefault();
    const form = $(this).serialize();
    const id = $("#modal_data #id").val();
    const method = id ? "PUT" : "POST";
    const url = id ? "/products/" + id : "/products";

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
        url: "/products/" + id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            Load();
            $("#toast #body_toast").text(response.mje || "Producto eliminado");
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
