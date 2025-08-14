 // Handle form submission with Ajax
 $('#form').submit(function(event) {
    event.preventDefault(); // Prevent default form submission

    formData= $(this).serialize();    
    // Send Ajax request to save data
    $.ajax({
      url: "sendData.php", // Replace with your server-side script URL
      method: 'POST',
      data : formData,
      success: function(response) {
        console.log("Data Send");              
          $('#form').trigger('reset');
          $(".toast-body").text("Datos enviados correctamente")
          $(".toast").show();  
          setTimeout($(".toast").hide, 3000);      
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error detect:', textStatus, errorThrown);
      }
    });
  });
