localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

$(document).ready(function() {
  $("#fechabaja").datepicker({
    dateFormat: 'dd-mm-yy', 
    changeMonth: true,
    changeYear: true,
    autoclose: true,
    yearRange: '2021:2023'
  });
  $("#fechamodificacion").datepicker({
    dateFormat: 'dd-mm-yy', 
    changeMonth: true,
    changeYear: true,
    autoclose: true,
    yearRange: '2021:2023'
  });
  $("#fechaalta").datepicker({
    dateFormat: 'dd-mm-yy', 
    changeMonth: true,
    changeYear: true,
    autoclose: true,
    yearRange: '2021:2023'
  });
  $(".cuitformato").mask("99-99999999-9");
})

function Incluir() 
{  
  document.querySelector('#titleModal').innerHTML = "Nueva empresa";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";  
  document.querySelector("#nombre").value = "";  
  // document.querySelector("#idsindicato").value = "";  
  document.querySelector("#cuit").value = "";
  document.querySelector("#seccional").value = "";
  document.querySelector("#numero").value = "";
  document.querySelector("#direccion").value = "";
  document.querySelector("#localidad").value = "";
  document.querySelector("#codpostal").value = "";
  document.querySelector("#idprovincia").value = "";
  document.querySelector("#ramo").value = "";
  document.querySelector("#email").value = "";
  document.querySelector("#contacto").value = "";
  document.querySelector("#fechaalta").value = "";  
  document.querySelector("#fechamodificacion").value = "";   
  document.querySelector("#fechabaja").value = "";   

  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "empresaModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Esta empresa ya existe!", "error");          
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
              swal("Houston, tenemos un problema", "Consulte al desarrollador del sistema", "error");
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
      url: "empresaModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Esta empresa fue eliminada!", "error");                      
        }  
        if (respuesta.error == 2) {   
          swal("Houston, tenemos un problema", "Esta empresa no fue encontrada!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }
        if (respuesta.error == 4) {            
          swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
        }  
        if (respuesta.exito == 1) {          
          document.querySelector('#titleModal').innerHTML = "Actualizar empresa";
          document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;       
          document.querySelector("#nombre").value = respuesta.nombre;   
          document.querySelector("#idsindicato").value = respuesta.idsindicato;       
          document.querySelector("#cuit").value = respuesta.cuit;       
          document.querySelector("#seccional").value = respuesta.seccional;       
          document.querySelector("#numero").value = respuesta.numero;       
          document.querySelector("#direccion").value = respuesta.direccion;       
          document.querySelector("#localidad").value = respuesta.localidad;       
          document.querySelector("#codpostal").value = respuesta.codpostal;       
          document.querySelector("#idprovincia").value = respuesta.idprovincia;       
          document.querySelector("#ramo").value = respuesta.ramo;       
          document.querySelector("#email").value = respuesta.email;       
          document.querySelector("#contacto").value = respuesta.contacto;       
          document.querySelector("#fechaalta").value = respuesta.fechaalta;       
          document.querySelector("#fechamodificacion").value = respuesta.fechamodificacion;        
          document.querySelector("#fechabaja").disabled = false;   
    
          $("#idempresaantecedente").removeAttr('disabled');
          $("#idempresaprecedente").removeAttr('disabled');

          document.querySelector("#idempresaantecedente").value = respuesta.idempresaantecedente;       
          document.querySelector("#idempresaprecedente").value = respuesta.idempresaprecedente;       
          document.querySelector("#status").value = respuesta.status;       

          if (respuesta.fechabaja == '01-01-1970') {
              document.querySelector("#fechabaja").value = '';      
          }   else {
              document.querySelector("#fechabaja").value = respuesta.fechabaja;      
          }       
                  
          if (respuesta.modificacion == '30-11--0001') {
            document.querySelector("#fechamodificacion").value = '';      
          }   else {
             document.querySelector("#fechamodificacion").value = respuesta.fechamodificacion;      
          }       
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
          url: "empresaModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {
            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Esta empresa ya existe!", "error");        
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
            url: "empresaModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Esta empresa no fue encontrado!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Este empresa está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
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