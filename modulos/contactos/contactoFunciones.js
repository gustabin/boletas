function Modificar(id) 
{
    $.ajax(
    {
      type:"POST",
      url: "contactoModelo.php?option=modificarConsultar&id="+id,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        
        if (respuesta.error == 1) {   
          swal("Houston, tenemos un problema", "Este mensaje fue eliminado!", "error");                      
        }  
        if (respuesta.error == 2) {  
          swal("Houston, tenemos un problema", "Este mensaje no fue encontrado!", "error");                
        }    
        if (respuesta.error == 3) {            
          swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
        }       
       
        if (respuesta.exito == 1) {          
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML = "Actualizar";
          document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
          document.querySelector("#id").value = respuesta.id;
          document.querySelector("#nombre").value = respuesta.nombre;
          document.querySelector("#telefono").value = respuesta.telefono;
          document.querySelector("#email").value = respuesta.email;
          document.querySelector("#mensaje").value = respuesta.mensaje;
          document.querySelector("#fecha").value = respuesta.fecha;
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
          url: "contactoModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Este mensaje ya existe!", "error");        
            }
            if (respuesta.error == 3) {            
              swal("Houston, tenemos un problema", "Debe introducir correctamente los datos! evite usar caracteres especiales", "error");
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



function Eliminar(id) {
  // alert('Eliminar');
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
            url: "contactoModelo.php?option=eliminar&id="+ id,
            dataType: "json",
            data: $(this).serialize(),
            success: function(respuesta) {              
              if (respuesta.error ==1) {                
                swal("Houston, tenemos un problema", "Este mensaje no fue encontrado!", "error");  
              }
              if (respuesta.error ==2) {                
                swal("Houston, tenemos un problema", "Este contacto está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
              }
              if (respuesta.exito == 1) {                       
                window.location.href='index.php';          
              }
            }
          });        
      } 
    });
}