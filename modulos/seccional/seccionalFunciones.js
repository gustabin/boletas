localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

function Incluir()   
{  
  document.querySelector('#titleModal').innerHTML = "Nueva seccional";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";  
  // document.querySelector("#idsindicato").value = "";  
  document.querySelector("#nombre").value = "";     
  document.querySelector("#fecha").value = "";    
  document.querySelector("#status").value = "";   
  
  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "seccionalModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Esta seccional ya existe!", "error");          
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


function Modificar(id,token) 
{
    $.ajax(
    {
      type:"POST",
      url: "seccionalModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Esta seccional fue eliminada!", "error");                      
        }  
        if (respuesta.error == 2) {  
          swal("Houston, tenemos un problema", "Esta seccional no fue encontrada!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }
        if (respuesta.error == 4) {            
          swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
        } 
        if (respuesta.exito == 1) {          
          document.querySelector('#titleModal').innerHTML = "Actualizar seccional";
          document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;          
          document.querySelector("#idsindicato").value = respuesta.idsindicato;           
          document.querySelector("#nombre").value = respuesta.nombre;          
          document.querySelector("#fecha").value = respuesta.fecha; 
          document.querySelector("#status").value = respuesta.status;          
          $('#modal-default').modal('show');           
        }
      }
    })      

    
    $("body").on('submit', '#formDefault', function(event) 
    {
      event.preventDefault()
      if ($('#formDefault').valid()) {    
        $.ajax({
          type:"POST",
          url: "seccionalModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Esta seccional ya existe!", "error");        
            }
            if (respuesta.error == 3) {            
              swal("Houston, tenemos un problema", "Debe introducir correctamente los datos! evite usar caracteres especiales", "error");
            }  
            if (respuesta.error == 4) {            
              swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
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


function Eliminar(id,token) {
    swal({
      title: "¿Está seguro de eliminar este registro?",
      text: "Una vez eliminado, ¡no podrá recuperar este registro!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
            type: "POST",            
            url: "seccionalModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Esta categoría de empleados no fue encontrada!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Esta seccional está relacionada con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
              }
              if (respuesta.error == 4) {            
                swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
              } 
              if (respuesta.exito == 1) {                       
                window.location.href='index.php';          
              }
            }
          });        
      } 
    });
}