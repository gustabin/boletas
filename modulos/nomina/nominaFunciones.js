localStorage.removeItem("bandera");
function guardarUnaVez(){
      localStorage.removeItem("bandera")
}

// Funcion MostrarRecuperar
function MostrarRecuperar()
{
  // alert("MostrarRecuperar")
  $('#recuperar').show();
  //$('#login').hide();
}

$(document).ready(function() {
  $("#fechaalta").datepicker({
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
  //Combos dependientes con jQuery, Ajax y PHP
  $("#idsindicato").on('change', function () {
    $("#idsindicato option:selected").each(function () {
        elegido=$(this).val();
        $.post("modelos.php", { elegido: elegido }, function(data){
            $("#idcategoriaempleado").html(data);
        });     
    });
   });

  $("#resultadoBusqueda").html('');
  $("#cantidadresultado").html('');
})

function validar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)  {
    if ($('#cantidad2').length) {     
    } else {      
      if ( $("input#cuil").val() == parseInt($("#cuilpadron").text()) ) {
          $("#encontrado").show(); 
          $("#idpadron").val(parseInt($("#txtidpadron").text()));    
          $("#status").val('');            
          $("#btnActionForm").prop("disabled", true);   
          $("#btnActionForm").removeClass("btn-secondary");
          $("#btnActionForm").addClass("btn-primary");
          $("#btnActionForm").show();    
      }else{
          alert("Debes colocar el número de CUIL");   
          $("#btnActionForm").removeClass("btn-primary");
          $("#btnActionForm").addClass("btn-secondary");
          $("#encontrado").hide();          
          $("#divfechaalta").hide(); 
          $("#divfechamodificacion").hide(); 
          // $("#divusuarioalta").hide(); 
          $("#divestado").hide();   
      }      
    }   
  }    
}

function pegarCuil(cuil) {
  document.querySelector("#cuil").value = cuil;   
  buscar();
}

function buscar() {
    var textoBusqueda = $("input#cuil").val();
    if (textoBusqueda != "") {
        $.post("buscar.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
        }); 
    } else { 
        $("#resultadoBusqueda").html('');
  };
};

function seleccionar(){
  if ( $("input#cuil").val() == parseInt($("#cuilpadron").text()) ) {
       $("#idpadron").val(parseInt($("#txtidpadron").text()));  
  }
  $("#btnActionForm").prop("disabled", true);   
  $("#btnActionForm").removeClass("btn-secondary");
  $("#btnActionForm").addClass("btn-primary");
  $("#btnActionForm").show();    
  $("#btnActionForm").prop("disabled", false);  
}


function Incluir() 
{  
  document.querySelector('#titleModal').innerHTML = "Nuevo trabajador en la nomina";    
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";    
  document.querySelector("#id").value = "";  

  $("#cuil").prop("disabled", false);   
  $("#encontrado").hide(); 
  $("#divfechaalta").hide(); 
  $("#divfechamodificacion").hide(); 
  // $("#divusuarioalta").hide(); 
  document.querySelector("#idcategoriaempleado").value = "";   
  document.querySelector("#fechamodificacion").value = "";    
  document.querySelector("#status").value = "";   

  if(localStorage.getItem("bandera") === null){
    localStorage.setItem("bandera","entro");
    $("body").on('submit', '#formDefault', function(event) { 
      event.preventDefault()
      if ($('#formDefault').valid()) {  
        $.ajax({
          type:"POST",
          url: "nominaModelo.php?option=incluir",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {          
            if (respuesta.error == 1) {            
              swal("Houston, tenemos un problema", "Este trabajador ya existe en la empresa " + respuesta.nombre, "error");          
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


function Modificar(id,token) 
{
  $("#btnActionForm").prop("disabled", true);  
  $("#btnActionForm").removeClass("btn-primary");
  $("#btnActionForm").addClass("btn-secondary"); 

    $("#cuil").prop("disabled", true); 
    $("#txtfechaalta").prop("disabled", true); 
    
    $("#divfechaalta").show(); 
    $("#divfechamodificacion").hide(); 
    $("#fechamodificacion").prop("disabled", true); 

    $.ajax(
    {
      type:"POST",
      url: "nominaModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Este trabajador fue eliminado!", "error");                      
        }  
        if (respuesta.error == 2) {  
          swal("Houston, tenemos un problema", "Este trabajador no fue encontrado!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }
        if (respuesta.error == 4) {            
          swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
        }  
        if (respuesta.exito == 1) {          
          document.querySelector('#titleModal').innerHTML = "Actualizar nomina";
          document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;     
          document.querySelector("#idsindicato").value = respuesta.idsindicato;     
          document.querySelector("#idempresa").value = respuesta.idempresa;     
          document.querySelector("#cuil").value = respuesta.cuil;     
          document.querySelector("#sueldo").value = respuesta.sueldo;     
          document.querySelector("#idcategoriaempleado").value = respuesta.idcategoriaempleado;   
          document.querySelector("#idpadron").value = respuesta.idpadron;     
          document.querySelector("#txtfechaalta").value = respuesta.fechaalta;     
          document.querySelector("#fechamodificacion").value = respuesta.fechamodificacion;     
          document.querySelector("#status").value = respuesta.status;   

          $('#modal-default').modal('show');    

          if (respuesta.fechamodificacion == '01-01-1970') {
            document.querySelector("#fechamodificacion").value = '';      
          }   else {
             document.querySelector("#fechamodificacion").value = respuesta.fechamodificacion;      
          }   

        }
      }
    })      

    
    $("body").on('submit', '#formDefault', function(event) 
    {
      event.preventDefault()
      if ($('#formDefault').valid()) {    
        $.ajax({
          type:"POST",
          url: "nominaModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {
            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Este trabajador ya existe!", "error");        
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
            url: "nominaModelo.php?option=eliminar&id="+id+"&token="+token,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Esta nomina no fue encontrada!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Esta nómina está relacionada con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
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

// Funcion recuperar
function Recuperar()
{
  $("body").on('submit', '#formRecuperar', function(event) {
    event.preventDefault()
    if ($('#formRecuperar').valid()) {
      $.ajax({
        type:"POST",
        url: "../login/recuperarModelo.php",
        dataType: "json",
        data: $(this).serialize(),
        success: function(respuesta) {
          if (respuesta.error == 1) {
              swal("Houston, tenemos un problema", "Este usuario no existe", "error");   
          }

          if (respuesta.exito == 1) {
            swal("Mensaje enviado satisfactoriamente", "Todo bien", "success"); 
          }
        }
      })
    }
  })
}