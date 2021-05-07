localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

$(document).ready(function() {
  $(".periodoformato").mask("9999/99");
})

function Incluir() 
{  
  document.querySelector('#titleModal').innerHTML = "Nueva nómina";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";  

  $("#cuil").prop("disabled", false);   
  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "detallenominaModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Esta nómina ya existe!", "error");          
            }
            if (respuesta.error == 2) {            
              swal("Houston, tenemos un problema", "Faltan datos por completar!", "error");          
            }
            if (respuesta.error == 3) {            
              swal("Houston, tenemos un problema", "Debe introducir correctamente los datos! evite usar caracteres especiales", "error");
            }         
            if (respuesta.error == 4) {            
              swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
            }    
            if (respuesta.error == 5) {            
              swal("Houston, tenemos un problema", "No se encuentra el empleado en el padrón", "error");
            }   
            if (respuesta.exito == 1) {        
              document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";           
              window.location.href='index.php';         
            }
          }
        })
      }
    })    
  }
}

function Empresa() 
{    
  document.querySelector('#titleModal').innerHTML = "Empresa del trabajador";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";    
  
  $("body").on('submit', '#formDefault', function(event) { 
    event.preventDefault()
    if ($('#formDefault').valid()) {  
      $.ajax({
        type:"POST",
        url: "nominaModelo.php?option=empresa",
        dataType: "json",
        data: $(this).serialize(),
        success: function(respuesta) {          
          if (respuesta.error == 1) {            
            swal("Houston, tenemos un problema", "Esta empresa no existe!", "error");          
          }
          if (respuesta.error == 2) {            
            swal("Houston, tenemos un problema", "Empresa no encontrada!", "error");          
          }
          if (respuesta.error == 3) {            
            swal("Houston, tenemos un problema", "Debe introducir correctamente los datos! evite usar caracteres especiales", "error");
          }         
          if (respuesta.error == 4) {            
            swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
          }     
          if (respuesta.exito == 1) {        
             window.location.href = 'index.php';   
          }
        }
      })
    }
  })    
}


function Copiar(periodo,token) {
    $.ajax({
        type: "POST",            
        url: "detallenominaModelo.php?option=copiar&periodo="+periodo+"&token="+token,
        dataType: "json",
        data: $(this).serialize(),
        success: function(respuesta) {              
          if (respuesta.error ==1) {                
            swal("Houston, tenemos un problema", "Esta nómina no fue encontrada!", "error");  
          }
          if (respuesta.error ==2) {                
            swal("Houston, tenemos un problema", "Este detalle de nomina está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
          }
          if (respuesta.error == 4) {            
            swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
          }  
          if (respuesta.exito == 1) {          
            swal("La nomina fue copiada satisfactoriamente", "Muy bien!", "success");               
            window.location.href='index.php';          
          }
        }
      });        
}
