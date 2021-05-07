localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

$(document).ready(function() {
 //$(".sueldo").mask("999999.99");
  $("#nacimiento").datepicker({
    dateFormat: 'dd-mm-yy', 
    changeMonth: true,
    changeYear: true,
    autoclose: true,
    yearRange: '1950:2003'
  });
  $("#baja").datepicker({
    dateFormat: 'dd-mm-yy', 
    changeMonth: true,
    changeYear: true,
    autoclose: true,
    yearRange: '2021:2023'
  });
  $("#modificacion").datepicker({
    dateFormat: 'dd-mm-yy', 
    changeMonth: true,
    changeYear: true,
    autoclose: true,
    yearRange: '2021:2023'
  });
  $("#alta").datepicker({
    dateFormat: 'dd-mm-yy', 
    changeMonth: true,
    changeYear: true,
    autoclose: true,
    yearRange: '2021:2023'
  });
})

function Incluir() 
{  
  document.querySelector('#titleModal').innerHTML = "Nueva persona del padrón";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";  
  document.querySelector("#documento").value = "";
  document.querySelector("#cuil").value = "";
  document.querySelector("#nombre").value = "";
  document.querySelector("#apellido").value = "";
  document.querySelector("#sexo").value = "";
  document.querySelector("#telefono").value = "";
  document.querySelector("#direccion").value = "";
  document.querySelector("#localidad").value = "";
  document.querySelector("#provincia").value = "";
  document.querySelector("#nacimiento").value = "";     
  //document.querySelector("#sueldo").value = "";     
  document.querySelector("#baja").value = ""; 
  document.querySelector("#alta").value = "";  
  document.querySelector("#modificacion").value = "";   
  document.querySelector("#status").value = "";    
  
  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "padronModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Este cuil ya existe!", "error");          
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
      url: "padronModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {        
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Esta persona fue eliminada!", "error");                      
        }  
        if (respuesta.error == 2) {   
          swal("Houston, tenemos un problema", "Esta persona no fue encontrada!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }
        if (respuesta.error == 4) {            
          swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
        }   
        if (respuesta.exito == 1) {          
          document.querySelector('#titleModal').innerHTML = "Actualizar padrón";
          document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;       
          document.querySelector("#documento").value = respuesta.documento;       
          document.querySelector("#cuil").value = respuesta.cuil;       
          document.querySelector("#nombre").value = respuesta.nombre;       
          document.querySelector("#apellido").value = respuesta.apellido;       
          document.querySelector("#sexo").value = respuesta.sexo;       
          document.querySelector("#telefono").value = respuesta.telefono;       
          document.querySelector("#direccion").value = respuesta.direccion;        
          document.querySelector("#localidad").value = respuesta.localidad;       
          document.querySelector("#provincia").value = respuesta.provincia;       
          document.querySelector("#nacimiento").value = respuesta.nacimiento;
          //document.querySelector("#sueldo").value = respuesta.sueldo;
          document.querySelector("#idsindicato").value = respuesta.idsindicato;
          document.querySelector("#idseccional").value = respuesta.idseccional;
          document.querySelector("#idestadocivil").value = respuesta.idestadocivil;
          document.querySelector("#idnacionalidad").value = respuesta.idnacionalidad;
          document.querySelector("#idsituacionrevista").value = respuesta.idsituacionrevista;
          document.querySelector("#idcategoriaempleado").value = respuesta.idcategoriaempleado;
          document.querySelector("#idempresa").value = respuesta.idempresa;
          document.querySelector("#idtipodocumento").value = respuesta.idtipodocumento;
          document.querySelector("#alta").value = respuesta.alta;      
          document.querySelector("#baja").disabled = false;

          if (respuesta.baja == '01-01-1970') {
            document.querySelector("#baja").value = '';      
          }   else {
             document.querySelector("#baja").value = respuesta.baja;   
             document.querySelector("#baja").disabled = true;   
          }       
                  
          if (respuesta.modificacion == '30-11--0001') {
            document.querySelector("#modificacion").value = '';      
          }   else {
             document.querySelector("#modificacion").value = respuesta.modificacion;      
          }    

          document.querySelector("#status").value = respuesta.status; 
          $('#modal-default').modal('show');           
        }
      }
    })      

    
    $("body").on('submit', '#formDefault', function(event) 
    {
      document.querySelector("#baja").disabled = false;   
      event.preventDefault()
      if ($('#formDefault').valid()) {    
        $.ajax({
          type:"POST",
          url: "padronModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Esta persona ya existe!", "error");        
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
            url: "padronModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Esta persona no fue encontrado!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Este padrón está relacionada con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
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