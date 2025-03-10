function Load(url="products/create"){
    console.log("Load DataTable");
    $('tbody').text("");
    $.getJSON(url, function(data) {
      $.each(data, function(index, item) {
        console.log(item);
        const row = '<tr>' +
                      '<td>' + item.name+ '</td>' +
                      '<td>' + item.description + '</td>' +
                      '<td>' + item.price + '</td>' +
                      '<td>' + item.model+ '</td>' +
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

   //send datas
   $("#registration-form").submit(function (event) {
    event.preventDefault();
    var form = $(this).serialize();
    let id = $("#modal_data #id").val();
    if (id =="") {
      metod = "POST";
    } else {
      metod = "PUT";
    }   
    $.ajax({
      type: metod,
      url: "users/"+id,
      data: form,
      dataType: "dataType",
      beforeSend: function(){
        console.log("Enviando Informacion");        
      },
      success: function (response) {
        console.log(response);
        Load();
        $("#toast #body_toast").text("Datos Cargados correctamente");
        $("#toast").modal("show");   
        
        setTimeout(function () {
          $('#toast').modal('hide');     
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();   
        },5000);   
      },
      error:function () {
        console.error();       

        $("#toast [class='modal-body']").text("Error en la actualizacion de datos");
        $("#toast").modal("show");    
        Load();    

        setTimeout(function () {
          $('#toast').modal('hide');     
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();   
        },5000);         
      }
    });  
  });  