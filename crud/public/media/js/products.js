function Load(url="users/create"){
    console.log("Load DataTable");
    $('tbody').text("");
    $.getJSON(url, function(data) {
      $.each(data, function(index, item) {
        console.log(item);
        const row = '<tr>' +
                      '<td>' + item.name+ '</td>' +
                      '<td>' + item.lastName + '</td>' +
                      '<td>' + item.phone + '</td>' +
                      '<td>' + item.email+ '</td>' +
                      '<td>  <i  class="bi bi-pencil-square text-primary" Title="Edit" name="edt" data-id= ' + item.id +
                              ' data-name ="'+item.name+'"  data-lastName ="'+item.lastName+'" data-phone ="'+item.phone+
                              '" data-email ="'+item.email+'" data-email_verified_at ="'+item.email_verified_at+
                              '" data-address ="'+item.address+
                              '"  onclick="FormEdit(this)"></i> - <i class="bi bi-x-square text-danger" title="Delete" name="del" data-id ="'+item.id+'" onclick="FormDelete()"></i> </td>' +
                      '</tr>';
          $('tbody').append(row);
        });
        $('#data').DataTable();
      });
  };
