localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

function Incluir() 
{   
  document.querySelector('#titleModal').innerHTML = "Nuevo sindicato";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";  
  document.querySelector("#cuit").value = "";
  document.querySelector("#razonsocial").value = "";
  document.querySelector("#direccion").value = ""; 
  document.querySelector("#fecha").value = "";    
  document.querySelector("#status").value = "";   
  
  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "sindicatoModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Esta sindicato ya existe!", "error");          
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
      url: "sindicatoModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Esta sindicato fue eliminado!", "error");                      
        }  
        if (respuesta.error == 2) {  
          swal("Houston, tenemos un problema", "Esta sindicato no fue encontrado!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }
        if (respuesta.error == 4) {            
          swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
        }  
        if (respuesta.exito == 1) {          
          document.querySelector('#titleModal').innerHTML = "Actualizar sindicato";
          document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;        
          document.querySelector("#cuit").value = respuesta.cuit;
          document.querySelector("#razonsocial").value = respuesta.razonsocial;
          document.querySelector("#direccion").value = respuesta.direccion;          
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
          url: "sindicatoModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Esta sindicato ya existe!", "error");        
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
            url: "sindicatoModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Este sindicato no fue encontrado!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Este sindicato está relacionado con un registro de una tabla!, " + respuesta.errorDescription, "error");  
              }
              if (respuesta.error ==3) {                
                swal("Houston, tenemos un problema", "Este sindicato está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
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