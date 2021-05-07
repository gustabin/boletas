// Funcion MostrarRecuperar
function MostrarRecuperar()
{
  // alert("MostrarRecuperar")
  $('#recuperar').show();
  $('#login').hide();
}

// Funcion MostrarLogin
function MostrarLogin() 
{
  // alert(MostrarLogin)
  $('#recuperar').hide();
  $('#login').show();
}
 
//Funcion Buscar
function Buscar()  
{
    // alert("Buscar")
  
  $("body").on('submit', '#formDefault', function(event) {     
    event.preventDefault()
    if ($('#formDefault').valid()) {  
      $.ajax({
        type:"POST",
        url: "loginModelo.php?option=buscar",
        dataType: "json",
        data: $(this).serialize(),
        success: function(respuesta) {          
          if (respuesta.error == 1) {            
            swal("Houston, tenemos un problema", "Este usuario no existe o el password es invalido", "error");              
          }  
          if (respuesta.error == 2) {            
            swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
          }       
          if (respuesta.error == 3) {            
              swal("Houston, tenemos un problema", "Debe introducir correctamente los datos! evite usar caracteres especiales", "error");
          } 
          if (respuesta.error == 4) {            
              swal("Houston, tenemos un problema", "Muchos intentos fallidos! intentelo en 30 min", "error");
          }   
          if (respuesta.exito == 1) {
             window.location.href='../home';          
            //window.location.href='../homexxx/';          
          }

        }
      })
    }
  })    
}

// Funcion recuperar
function Recuperar()
{
    // alert("Recuperar")
    
  $("body").on('submit', '#formRecuperar', function(event) {
    event.preventDefault()
    if ($('#formRecuperar').valid()) {
      $.ajax({
        type:"POST",
        url: "recuperarModelo.php",
        dataType: "json",
        data: $(this).serialize(),
        success: function(respuesta) {
          if (respuesta.error == 1) {
              swal("Houston, tenemos un problema", "Este usuario no existe", "error");   
          }

          if (respuesta.exito == 1) {
            swal("Mensaje enviado satisfactoriamente", "Todo bien", "success"); 
          }
        }
      })
    }
  })
}