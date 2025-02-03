//user 
  function Load(url="users/create"){
    console.log("Load DataTable");
    $('tbody').val("");
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
                              '" data-email ="'+item.email+'data-email_verified_at'+item.email_verified_at+
                              'data-address ='+item.address+
                              '"  onclick="FormEdit(this)"></i> - <i class="bi bi-x-square text-danger" title="Delete" name="del" data-id ="'+item.id+'" onclick="FormDelete()"></i> </td>' +
                      '</tr>';
          //console.log(row);
          $('tbody').append(row);         
        });
        $('#data').DataTable();
      }); 
  };

    $(document).ready(function(){        
        $("#modal_data").modal('hide');
        Load();
      });

  function FormEdit(params){
    console.log("Show Edit Form");          
    $('[name="edt"]').on('click', function(){
      let item = $(this).data();console.log("start to begin");
      
      console.log(item);       
      $("#modal_data #id").val(item.id);      
      $("#modal_data #name").val(item.name);  
      $("#modal_data #lastName").val(item.lastName);
      $("#modal_data #email").val(item.email);       
      $("#modal_data #email").val(item.email);
      $("#modal_data #tel").val(item.phone);
      $("#modal_data #email").val(item.email);    
    }); 
     
     $("#modal_data").modal('show');   
  };
  
  //send datas
  $("#registration-form").submit(function (event) {
    event.preventDefault();
    var form = $(this).serialize();
    console.log(form.id);    
    $.ajax({
      type: "PUT",
      url: "users/"+form.id,
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
        Load();

        $("#toast [class='modal-body']").text("Error en la actualizacion de datos");
        $("#toast").modal("show");        

        setTimeout(function () {
          $('#toast').modal('hide');     
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();   
        },5000);         
      }
    });  
  });  
  
  $("#delete-form").submit(function (event) {
    
    event.preventDefault();
    var form = $(this).serialize(); console.log(form);
    
    console.log("delete form");
    $.ajax({
      type: "POST",
      url: "users/"+form.id,
      data: form,
      dataType: "dataType",
      beforeSend: function(){
        console.log("Enviando Informacion");
        
      },
      success: function (response) {
        console.log(response);
        Load();
        $("#toast #body_toast").text("Datos Eliminados correctamente");
        $("#toast").modal("show");   
        
        setTimeout(function () {
          $('#toast').modal('hide');     
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();   
        },5000);   
      },
      error:function () {
        console.error();
        Load();

        $("#toast [class='modal-body']").text("Error en el borrado de datos");
        $("#toast").modal("show");        

        setTimeout(function () {
          $('#toast').modal('hide');     
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();   
        },5000);         
      }
    }); 
  });
   
      
  function  FormDelete(params) {    
        //delete
        $("[name='del']").on("click",function(){
          console.log("Delete");
          let item = $(this).data();
          console.log(item);
          $("#modalDelete #delete-form #id").val(item.id); 
          $("#modalDelete").modal("show");
        });
      };
      $(document).ready(function () {
        FormDelete();
      });   

        
     

