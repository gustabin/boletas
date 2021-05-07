localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

$(document).ready(function() {
  $("#sindicato").on('change', function () {
    $("#sindicato option:selected").each(function () {
        elegido=$(this).val();
        $.post("modelos.php", { elegido: elegido }, function(data){
            $("#idempresa").html(data);
        });     
    });
   });
})

function Sindicato()
{
     document.querySelector('#titleModal').innerHTML = "Elegir Sindicato";  
     $('#formDefault').hide();
     $('#formEmpresa').hide();
     $('#formSindicato').show();
     
     $("body").on('submit', '#formSindicato', function(event) { 
    event.preventDefault()
    if ($('#formSindicato').valid()) {  
      $.ajax({
        type:"POST",
        url: "rolesModelo.php?option=sindicato",
        dataType: "json",
        data: $(this).serialize(),
        success: function(respuesta) {          
          if (respuesta.error == 1) {            
            swal("Houston, tenemos un problema", "Consulte con sistemas!", "error");          
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

// function Empresa()
// {
//      document.querySelector('#titleModal').innerHTML = "Elegir Empresa";  
//      $('#formDefault').hide();
//      $('#formSindicato').hide();
//      $('#formEmpresa').show();
     
//      $("body").on('submit', '#formEmpresa', function(event) { 
//     event.preventDefault()
//     if ($('#formEmpresa').valid()) {  
//       $.ajax({
//         type:"POST",
//         url: "rolesModelo.php?option=empresa",
//         dataType: "json",
//         data: $(this).serialize(),
//         success: function(respuesta) {          
//           if (respuesta.error == 1) {            
//             swal("Houston, tenemos un problema", "Consulte con sistemas!", "error");          
//           }
              
//           if (respuesta.exito == 1) {        
//             document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";           
//             window.location.href='index.php';         
//           }
//         }
//       })
//     }
//   })    
// }



function Incluir()  
{
  document.querySelector('#titleModal').innerHTML = "Nuevo rol";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";
  document.querySelector("#nombre").value = "";
  document.querySelector("#descripcion").value = "";    
  document.querySelector("#accesos").value = "";    
  document.querySelector("#fecha").value = "";   

  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "rolesModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Este rol ya existe!", "error");          
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
  $.ajax({
  type:"POST",
  url: "rolesModelo.php?option=modificarConsultar&id="+id+"&token="+token,
  dataType: "json",
  data: $(this).serialize(),
  success: function(respuesta) {          
    if (respuesta.error == 1) {            
      swal("Houston, tenemos un problema", "Este rol ya fue eliminado!", "error");          
    }
    if (respuesta.error == 2) {            
      swal("Houston, tenemos un problema", "Este rol no fue encontrado!", "error");
    }  
    if (respuesta.error == 3) {            
      swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
    }           
    if (respuesta.error == 4) {            
      swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
    }   
    if (respuesta.exito == 1) {        
      document.querySelector('#titleModal').innerHTML = "Actualizar roles";    
      document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
      document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
      document.querySelector('#btnText').innerHTML = "Actualizar";
      document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";    
      document.querySelector("#id").value = respuesta.id;
      document.querySelector("#nombre").value = respuesta.nombre;
      document.querySelector("#descripcion").value = respuesta.descripcion;    
      document.querySelector("#accesos").value = respuesta.accesos;    
      document.querySelector("#txtAcceso1").checked = respuesta.acceso1;
      document.querySelector("#txtAcceso2").checked = respuesta.acceso2;
      document.querySelector("#txtAcceso3").checked = respuesta.acceso3;          
      document.querySelector("#txtAcceso4").checked = respuesta.acceso4;      
      document.querySelector("#txtAcceso5").checked = respuesta.acceso5;      
      document.querySelector("#txtAcceso6").checked = respuesta.acceso6;      
      document.querySelector("#txtAcceso7").checked = respuesta.acceso7;      
      document.querySelector("#txtAcceso8").checked = respuesta.acceso8;      
      document.querySelector("#txtAcceso9").checked = respuesta.acceso9;      
      document.querySelector("#txtAcceso10").checked = respuesta.acceso10;      
      document.querySelector("#txtAcceso11").checked = respuesta.acceso11;      
      document.querySelector("#txtAcceso12").checked = respuesta.acceso12;      
      document.querySelector("#txtAcceso13").checked = respuesta.acceso13;      
      document.querySelector("#txtAcceso14").checked = respuesta.acceso14;      
      document.querySelector("#txtAcceso15").checked = respuesta.acceso15;      
      document.querySelector("#txtAcceso16").checked = respuesta.acceso16;      
      document.querySelector("#txtAcceso17").checked = respuesta.acceso17;      
      document.querySelector("#txtAcceso18").checked = respuesta.acceso18;      
      document.querySelector("#txtAcceso19").checked = respuesta.acceso19;      
      document.querySelector("#txtAcceso20").checked = respuesta.acceso20;      
      document.querySelector("#txtAcceso21").checked = respuesta.acceso21;      
      document.querySelector("#txtAcceso22").checked = respuesta.acceso22;      
      document.querySelector("#txtAcceso23").checked = respuesta.acceso23;      
      document.querySelector("#txtAcceso24").checked = respuesta.acceso24;      
      document.querySelector("#txtAcceso25").checked = respuesta.acceso25;      
      document.querySelector("#txtAcceso26").checked = respuesta.acceso26;      
      document.querySelector("#txtAcceso27").checked = respuesta.acceso27;      
      document.querySelector("#txtAcceso28").checked = respuesta.acceso28;      
      document.querySelector("#txtAcceso29").checked = respuesta.acceso29;      
      document.querySelector("#fecha").value = respuesta.fecha;        
      document.querySelector("#status").value = respuesta.status; 
      $('#modal-default').modal('show');  
    }
  }
  })

  $("body").on('submit', '#formDefault', function(event) { 
    event.preventDefault()
    if ($('#formDefault').valid()) {  
      $.ajax({
        type:"POST",
        url: "rolesModelo.php?option=modificar",
        dataType: "json",
        data: $(this).serialize(),
        success: function(respuesta) {          
          if (respuesta.error == 1) {            
            swal("Houston, tenemos un problema", "Este rol ya existe!", "error");          
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
  });   
}


function Eliminar(id,token) 
{
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
            url: "rolesModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Esta roles no fue encontrada!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Este rol está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
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