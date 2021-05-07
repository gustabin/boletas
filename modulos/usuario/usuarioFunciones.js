localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

function Incluir() 
{  
  document.querySelector('#titleModal').innerHTML = "Nuevo usuario";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";  
  document.querySelector("#idempresa").value = "";  
  document.querySelector("#nombre").value = "";     
  document.querySelector("#apellido").value = "";     
  document.querySelector("#telefono").value = "";     
  document.querySelector("#email").value = "";     
  document.querySelector("#cuil").value = "";     
  document.querySelector("#direccion").value = "";     
  document.querySelector("#rolid").value = "";     
  //document.querySelector("#token").value = "";     
  document.querySelector("#fecha").value = "";    
  document.querySelector("#status").value = "";   
  document.querySelector("#idPassword").value = "";
  $('#campoPassword').hide();    

  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "usuarioModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Este usuario ya existe!", "error");          
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
      url: "usuarioModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Este usuario fue eliminado!", "error");                      
        }  
        if (respuesta.error == 2) {  
          swal("Houston, tenemos un problema", "Este usuario no fue encontrado!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }
        if (respuesta.error == 4) {            
            swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
        }
        if (respuesta.exito == 1) {          
          document.querySelector('#titleModal').innerHTML = "Actualizar usuario";
          document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;         
          document.querySelector("#idempresa").value = respuesta.idempresa;         
          document.querySelector("#nombre").value =respuesta.nombre;         
          document.querySelector("#apellido").value = respuesta.apellido;           
          document.querySelector("#telefono").value = respuesta.telefono;           
          document.querySelector("#email").value = respuesta.email;  
          document.querySelector("#cuil").value = respuesta.cuil;            
          document.querySelector("#direccion").value = respuesta.direccion;         
          document.querySelector("#rolid").value = respuesta.rolid;             
          //document.querySelector("#token").value = respuesta.token;         
          document.querySelector("#fecha").value = respuesta.fecha;           
          document.querySelector("#status").value = respuesta.status; 
          document.querySelector("#idPassword").value = respuesta.id;
          $('#campoPassword').show();   
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
          url: "usuarioModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Este usuario ya existe!", "error");        
            }
            if (respuesta.error == 2) {            
              swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
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
            url: "usuarioModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Este usuario no fue encontrado!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Este usuario está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
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