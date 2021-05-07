//Funcion Contactar
function Contactar()  
{
  
  $("body").on('submit', '#formDefault', function(event) {     
    event.preventDefault()
    if ($('#formDefault').valid()) {  
      $.ajax({
        type:"POST",
        url: "contactarModelo.php?option=contactar",
        dataType: "json",
        data: $(this).serialize(),
        success: function(respuesta) {          
          if (respuesta.error == 1) {  
            swal("Houston, tenemos un problema", "Este email no existe o el password es invalido", "error");
          }  
          
          if (respuesta.exito == 1) {
            window.location.href='index.php?contactado=1'; 
          }
        }
      })
    }    
  })  
}

function Cerrar()
{
   window.location.href='../index.php';
}

