localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

function Incluir() 
{  
  document.querySelector('#titleModal').innerHTML = "Nuevo Concepto";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";  
  document.querySelector("#nombre").value = "";
  document.querySelector("#descripcion").value = "";
  document.querySelector("#formula").value = "";
  document.querySelector("#porcentaje").value = "";
  document.querySelector("#confirma").value = "";
  document.querySelector("#importecantidad").value = "";
  document.querySelector("#seimprime").value = "";    
  document.querySelector("#conceptoasociado").value = "";    
  document.querySelector("#debitocredito").value = "";    
  document.querySelector("#idtipoboleta").value = "1";    
  document.querySelector("#fecha").value = "";    
  document.querySelector("#status").value = "";   
  $('#campoImagen').hide();  

  if(localStorage.getItem("bandera") === null){
      localStorage.setItem("bandera","entro");
      $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "conceptoModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Este concepto ya existe!", "error");          
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
      url: "conceptoModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Este concepto fue eliminado!", "error");                      
        }  
        if (respuesta.error == 2) {  
          swal("Houston, tenemos un problema", "Este concepto no fue encontrado!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }
        if (respuesta.error == 4) {            
          swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
        }   
        if (respuesta.exito == 1) {          
          document.querySelector('#titleModal').innerHTML = "Actualizar concepto";
          document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;
          document.querySelector("#idsindicato").value = respuesta.idsindicato;           
          document.querySelector("#nombre").value = respuesta.nombre;
          document.querySelector("#descripcion").value = respuesta.descripcion;
          document.querySelector("#formula").value = respuesta.formula;
          document.querySelector("#porcentaje").value = respuesta.porcentaje;
          document.querySelector("#confirma").value = respuesta.confirma;
          document.querySelector("#importecantidad").value = respuesta.importecantidad;
          document.querySelector("#seimprime").value = respuesta.seimprime;   
          document.querySelector("#conceptoasociado").value = respuesta.conceptoasociado;    
          document.querySelector("#debitocredito").value = respuesta.debitocredito;   
          document.querySelector("#idtipoboleta").value = respuesta.idtipoboleta;  
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
          url: "conceptoModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Este concepto ya existe!", "error");        
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
            url: "conceptoModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Este concepto no fue encontrado!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Este concepto está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
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