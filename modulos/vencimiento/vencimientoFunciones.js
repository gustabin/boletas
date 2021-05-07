localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

$(document).ready(function() {
  $("#periodo").datepicker({
    dateFormat: 'dd-mm-yy', 
    changeMonth: true,
    changeYear: true,
    autoclose: true,
    yearRange: '2021:2023'
  });  
})

function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode != 46 && charCode > 31 
     && (charCode < 48 || charCode > 57))      
      return false;     
   return true;
}


function Incluir() 
{  
  document.querySelector('#titleModal').innerHTML = "Nuevo periodo de vencimiento";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";    
  document.querySelector("#periodo").value = "";
  document.querySelector("#cuit0").value = ""; 
  document.querySelector("#cuit1").value = "";    
  document.querySelector("#cuit2").value = "";    
  document.querySelector("#cuit3").value = ""; 
  document.querySelector("#cuit4").value = "";    
  document.querySelector("#cuit5").value = "";    
  document.querySelector("#cuit6").value = ""; 
  document.querySelector("#cuit7").value = "";    
  document.querySelector("#cuit8").value = "";    
  document.querySelector("#cuit9").value = ""; 
  document.querySelector("#fecha").value = "";    
  document.querySelector("#status").value = "";   
  
  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "vencimientoModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Este periodo de vencimiento ya existe!", "error");          
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
              swal("Houston, tenemos un problema", "Debe ingresar 2 digitos, del 1 al 31", "error");
            }  
            if (respuesta.error == 6) {            
              swal("Houston, tenemos un problema", "Hay un problema con la fecha", "error");
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
      url: "vencimientoModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Este periodo de vencimiento fue eliminado!", "error");                      
        }  
        if (respuesta.error == 2) {  
          swal("Houston, tenemos un problema", "Este periodo de vencimiento no fue encontrado!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }
        if (respuesta.error == 4) {            
          swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
        }
        if (respuesta.error == 5) {            
           swal("Houston, tenemos un problema", "Debe ingresar 2 digitos, del 1 al 31", "error");
        }  
        if (respuesta.error == 6) {            
            swal("Houston, tenemos un problema", "Hay un problema con la fecha", "error");
          }   
        if (respuesta.exito == 1) {               
          document.querySelector('#titleModal').innerHTML = "Actualizar periodo de vencimiento";
          document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;    
          document.querySelector("#idsindicato").value = respuesta.idsindicato;    
          document.querySelector("#periodo").value = respuesta.periodo;   
          document.querySelector("#cuit0").value = respuesta.cuit0;   
          document.querySelector("#cuit1").value = respuesta.cuit1;      
          document.querySelector("#cuit2").value = respuesta.cuit2;       
          document.querySelector("#cuit3").value = respuesta.cuit3;   
          document.querySelector("#cuit4").value = respuesta.cuit4;      
          document.querySelector("#cuit5").value = respuesta.cuit5;      
          document.querySelector("#cuit6").value = respuesta.cuit6;   
          document.querySelector("#cuit7").value = respuesta.cuit7;       
          document.querySelector("#cuit8").value = respuesta.cuit8;       
          document.querySelector("#cuit9").value = respuesta.cuit9;    
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
          url: "vencimientoModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {
            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Este periodo de vencimiento ya existe!", "error");        
            }
            if (respuesta.error == 3) {            
              swal("Houston, tenemos un problema", "Debe introducir correctamente los datos! evite usar caracteres especiales", "error");
            }  
            if (respuesta.error == 4) {            
              swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
            }
            if (respuesta.error == 5) {            
              swal("Houston, tenemos un problema", "Debe ingresar 2 digitos, del 1 al 31", "error");
            }  
            if (respuesta.error == 6) {            
              swal("Houston, tenemos un problema", "Hay un problema con la fecha", "error");
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
            url: "vencimientoModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Este periodo de vencimiento no fue encontrada!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Este vencimiento está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
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