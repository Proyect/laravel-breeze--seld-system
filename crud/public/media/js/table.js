//user 
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

    $(document).ready(function(){        
        $("#modal_data").modal('hide');
        Load();
      });

  function FormEdit(){
    console.log("Show Edit Form");          
    $('[name="edt"]').on('click', function(){
      let item = $(this).data();
      
      console.log(item);       
      $("#modal_data #id").val(item.id); 
      $("#modal_data #id").prop('readonly', true);     
      $("#modal_data #name").val(item.name);  
      $("#modal_data #lastName").val(item.lastName);
      $("#modal_data #email").val(item.email);       
      $("#modal_data #email_verifield_at").val(item.email_verifield_at);
      $("#modal_data #tel").val(item.phone);
      $("#modal_data #email").val(item.email);    
    }); 
     
     $("#modal_data").modal('show');   
  };

  function newData(){
    console.log("New data");
    $("#btnRegister").on('click',function() {
        
      $("#modal_data #id").val("");      
      $("#modal_data #name").val("");  
      $("#modal_data #lastName").val("");
      $("#modal_data #email").val("");       
      $("#modal_data #email_verifield_at").val("");
      $("#modal_data #tel").val("");
      $("#modal_data #email").val("");  
    })
  }

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
  
  $("#deleteForm").submit(function (event) {
    console.log("Start to delete proccess");
    
    event.preventDefault();
    let form = $(this).serialize(); 
    let id = $("#deleteForm #id").val();    
    
    console.log("delete form");
    $.ajax({
      type: "DELETE",
      url: "users/"+id,
      data: form,
      dataType: "dataType",
      beforeSend: function(){
        console.log("Enviando Solicitud");        
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
    $("#modalDelete").modal("hide"); 
  });
   
      
  function  FormDelete(params) {    
        //delete
        $("[name='del']").on("click",function(){
          console.log("Open Delete Form");
          let item = $(this).data();
          console.log(item);
          $("#modalDelete #deleteForm #id").val(item.id); 
          console.log("item: "+item.id);          
          $("#modalDelete").modal("show");
          $("#modal_data").modal("hide");
        });
      }; 

      $(document).ready(function () {
        FormDelete();
      });   

        
     

