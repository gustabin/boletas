function actualizarTipoBoleta(estaChequeado, valorTipoBoleta, id) {
     alert("estaChequeado: " +estaChequeado + " valorTipoBoleta: " + valorTipoBoleta + " id: " + id);
     return valorTipoBoleta;
}

function actualizarValor(estaChequeado, valor, id) {
 let numero= id.substring(8, (id.length));
  // Variables.  
  var suma_actual = 0;
  var campo_resultado = document.getElementById('txtValor');
  valor = parseInt(valor);

  // Obtener la suma que pueda tener el campo 'txtValor'.
  try {
    if (campo_resultado != null) {

      if (isNaN(campo_resultado.value)) {
        campo_resultado.value = 0;
      }

      suma_actual = parseInt(campo_resultado.value);
    }
  } catch (ex) {
    // alert('No existe el campo de la suma.');
  }

  // Determinar que: si el check está seleccionado "checked"
  // entonces, agregue el valor a la variable "suma_actual";
  // de lo contrario, le resta el valor del check a "suma_actual".
  if (estaChequeado == true) {
    suma_actual = suma_actual + valor;
    document.getElementById("conceptoOculto"+numero).value=document.getElementById("conceptoOculto"+numero).value.replace("#","");
  } else {
    document.getElementById("conceptoOculto"+numero).value = '#' + document.getElementById("conceptoOculto"+numero).value; 
    suma_actual = suma_actual - valor;
  }

  // Colocar el resultado de las operaciones anteriores de vuelta
  // al campo "txtValor".
  campo_resultado.value = suma_actual;
}


function Modificar(id,token) 
{    
    // var valorTipoBoleta=1;
    $.ajax(
    {
      type:"POST",
      url: "detallepagoModelo.php?option=modificarConsultar&id="+id+"&token="+token,
      dataType: "json",
      data: $(this).serialize(),
      success: function(respuesta) {
        
          if (respuesta.error == 1) {   
            swal("Houston, tenemos un problema", "Este pago fue eliminado!", "error");                      
          }  
          if (respuesta.error == 2) {  
            swal("Houston, tenemos un problema", "Este pago no fue encontrado!", "error");                
          }    
          if (respuesta.error == 3) {            
            swal("Houston, tenemos un problema", "Debe completar todos los datos!", "error");
          }
          if (respuesta.error == 4) {            
            swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
          }    
          if (respuesta.error == 5) {            
             swal("Houston, tenemos un problema", "El importe debe ser menor de 10.000", "error");
          } 
          if (respuesta.error == 6) {            
             swal("Houston, tenemos un problema", "No tenemos el CUIL, revise la nómina para esta empresa", "error");
          }  
          if (respuesta.exito == 1) {            
            document.querySelector('#titleModal').innerHTML = "Detalle de pago del empleado";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML = "Actualizar";
            document.querySelector('#btnTextCancelar').innerHTML = "Cancelar";
            document.querySelector("#id").value = respuesta.id;     
            
            document.querySelector("#periodo").value = respuesta.periodo;     
            // document.querySelector("#tipoboleta").value = respuesta.tipoboleta;     
            document.querySelector("#cuit").value = respuesta.cuit;       
            document.querySelector("#cuil").value = respuesta.cuil;                
            document.querySelector("#sueldo").value = respuesta.sueldo;   

            // for (var i = 1; i <= 20; i++) {
            //     if (respuesta.concepto+i) {
            //         document.getElementById("concepto"+i).checked = respuesta.checkmarkconcepto+i;  
            //         document.getElementById("conceptoOculto"+i).value = respuesta.concepto+i;            
            //         document.getElementById("concepto"+i).value = respuesta.formulaconcepto+i * respuesta.sueldo;    
            //         document.querySelector("#nombreconcepto"+i).value =respuesta.nombreconcepto+i; 
            //         document.querySelector("#formulaconcepto"+i).innerHTML =respuesta.formulaconcepto+i; 
            //         document.querySelector("#idtipoboleta"+i).innerHTML =respuesta.idtipoboleta+i;                 
            //         document.querySelector("#subtotalconcepto"+i).innerHTML =respuesta.formulaconcepto+i * respuesta.sueldo;
            //         if (document.getElementById("concepto"+i).checked ) {
            //             document.getElementById("txtValor").value = respuesta.formulaconcepto+i * respuesta.sueldo;}                
            //         if (respuesta.nombreconcepto1) {$("#idconcepto"+i).show();}   
            //     }   
            // }

            if (respuesta.concepto1) {
                document.getElementById("concepto1").checked = respuesta.checkmarkconcepto1;  
                document.getElementById("conceptoOculto1").value = respuesta.concepto1;            
                document.getElementById("concepto1").value = respuesta.formulaconcepto1 * respuesta.sueldo;    
                document.querySelector("#nombreconcepto1").value =respuesta.nombreconcepto1; 
                document.querySelector("#formulaconcepto1").innerHTML =respuesta.formulaconcepto1; 
                document.querySelector("#idtipoboleta1").innerHTML =respuesta.idtipoboleta1;                 
                document.querySelector("#subtotalconcepto1").innerHTML =respuesta.formulaconcepto1 * respuesta.sueldo;
                if (document.getElementById("concepto1").checked ) {
                    document.getElementById("txtValor").value = "respuesta.formulaconcepto1 * respuesta.sueldo";}                
                if (respuesta.nombreconcepto1) {$("#idconcepto1").show();}   
            }      

            if (respuesta.concepto2) {
                document.getElementById("concepto2").checked = respuesta.checkmarkconcepto2;   
                document.getElementById("conceptoOculto2").value = respuesta.concepto2;   
                document.getElementById("concepto2").value = respuesta.formulaconcepto2 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto2").value =respuesta.nombreconcepto2; 
                document.querySelector("#formulaconcepto2").innerHTML =respuesta.formulaconcepto2;  
                document.querySelector("#idtipoboleta2").innerHTML =respuesta.idtipoboleta2;      
                document.querySelector("#subtotalconcepto2").innerHTML =respuesta.formulaconcepto2 * respuesta.sueldo;  
                if (document.getElementById("concepto2").checked ) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo;  }
                if (respuesta.nombreconcepto2) {$("#idconcepto2").show();}   
            }  

            if (respuesta.concepto3) {
                document.getElementById("concepto3").checked = respuesta.checkmarkconcepto3;  
                document.getElementById("conceptoOculto3").value = respuesta.concepto3;   
                document.getElementById("concepto3").value = respuesta.formulaconcepto3/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto3").value =respuesta.nombreconcepto3;  
                document.querySelector("#formulaconcepto3").innerHTML =respuesta.formulaconcepto3; 
                document.querySelector("#idtipoboleta3").innerHTML =respuesta.idtipoboleta3;       
                document.querySelector("#subtotalconcepto3").innerHTML =respuesta.formulaconcepto3/100 * respuesta.sueldo; 
                if (document.getElementById("concepto3").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo +
                    respuesta.formulaconcepto3/100 * respuesta.sueldo;    
                }                 
                if (respuesta.nombreconcepto3) {$("#idconcepto3").show();}
            }

            if (respuesta.concepto4) {
                document.getElementById("concepto4").checked = respuesta.checkmarkconcepto4;  
                document.getElementById("conceptoOculto4").value = respuesta.concepto4;   
                document.getElementById("concepto4").value = respuesta.formulaconcepto4/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto4").value =respuesta.nombreconcepto4; 
                document.querySelector("#formulaconcepto4").innerHTML =respuesta.formulaconcepto4;  
                document.querySelector("#idtipoboleta4").innerHTML =respuesta.idtipoboleta4;      
                document.querySelector("#subtotalconcepto4").innerHTML =respuesta.formulaconcepto4/100 * respuesta.sueldo;  
                if (document.getElementById("concepto4").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo;   
                }                  
                if (respuesta.nombreconcepto4) {$("#idconcepto4").show();}
            }

            if (respuesta.concepto5) {
                document.getElementById("concepto5").checked = respuesta.checkmarkconcepto5;   
                document.getElementById("conceptoOculto5").value = respuesta.concepto5;   
                document.getElementById("concepto5").value = respuesta.formulaconcepto5/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto5").value =respuesta.nombreconcepto5;  
                document.querySelector("#formulaconcepto5").innerHTML =respuesta.formulaconcepto5; 
                document.querySelector("#idtipoboleta5").innerHTML =respuesta.idtipoboleta5;       
                document.querySelector("#subtotalconcepto5").innerHTML =respuesta.formulaconcepto5/100 * respuesta.sueldo; 
                if (document.getElementById("concepto5").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo;     
                }                 
                if (respuesta.nombreconcepto5) {$("#idconcepto5").show();}
            }

            if (respuesta.concepto6) {
                document.getElementById("concepto6").checked = respuesta.checkmarkconcepto6;   
                document.getElementById("conceptoOculto6").value = respuesta.concepto6;   
                document.getElementById("concepto6").value = respuesta.formulaconcepto6/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto6").value =respuesta.nombreconcepto6;  
                document.querySelector("#formulaconcepto6").innerHTML =respuesta.formulaconcepto6; 
                document.querySelector("#idtipoboleta6").innerHTML =respuesta.idtipoboleta6;       
                document.querySelector("#subtotalconcepto6").innerHTML =respuesta.formulaconcepto6/100 * respuesta.sueldo; 
                if (document.getElementById("concepto6").checked ) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo;  
                }                 
                if (respuesta.nombreconcepto6) {$("#idconcepto6").show();}
            }

            if (respuesta.concepto7) {
                document.getElementById("concepto7").checked = respuesta.checkmarkconcepto7;  
                document.getElementById("conceptoOculto7").value = respuesta.concepto7;   
                document.getElementById("concepto7").value = respuesta.formulaconcepto7/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto7").value =respuesta.nombreconcepto7;  
                document.querySelector("#formulaconcepto7").innerHTML =respuesta.formulaconcepto7;  
                document.querySelector("#idtipoboleta7").innerHTML =respuesta.idtipoboleta7;      
                document.querySelector("#subtotalconcepto7").innerHTML =respuesta.formulaconcepto7/100 * respuesta.sueldo;                  
                if (document.getElementById("concepto7").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto7) {$("#idconcepto7").show();}
            }

            if (respuesta.concepto8) {
                document.getElementById("concepto8").checked = respuesta.checkmarkconcepto8;   
                document.getElementById("conceptoOculto8").value = respuesta.concepto8;   
                document.getElementById("concepto8").value = respuesta.formulaconcepto8/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto8").value =respuesta.nombreconcepto8; 
                document.querySelector("#formulaconcepto8").innerHTML =respuesta.formulaconcepto8;  
                document.querySelector("#idtipoboleta8").innerHTML =respuesta.idtipoboleta8;      
                document.querySelector("#subtotalconcepto8").innerHTML =respuesta.formulaconcepto8/100 * respuesta.sueldo;
                if (document.getElementById("concepto8").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto8) {$("#idconcepto8").show();}
            }

            if (respuesta.concepto9) {
                document.getElementById("concepto9").checked = respuesta.checkmarkconcepto9;  
                document.getElementById("conceptoOculto9").value = respuesta.concepto9;   
                document.getElementById("concepto9").value = respuesta.formulaconcepto9/100 * respuesta.sueldo; 
                document.querySelector("#nombreconcepto9").value =respuesta.nombreconcepto9; 
                document.querySelector("#formulaconcepto9").innerHTML =respuesta.formulaconcepto9; 
                document.querySelector("#idtipoboleta9").innerHTML =respuesta.idtipoboleta9;       
                document.querySelector("#subtotalconcepto9").innerHTML =respuesta.formulaconcepto9/100 * respuesta.sueldo;  
                if (document.getElementById("concepto9").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto9) {$("#idconcepto9").show();}
            }

            if (respuesta.concepto10) {
                document.getElementById("concepto10").checked = respuesta.checkmarkconcepto10;   
                document.getElementById("conceptoOculto10").value = respuesta.concepto10;   
                document.getElementById("concepto10").value = respuesta.formulaconcepto10/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto10").value =respuesta.nombreconcepto10; 
                document.querySelector("#formulaconcepto10").innerHTML =respuesta.formulaconcepto10; 
                document.querySelector("#idtipoboleta10").innerHTML =respuesta.idtipoboleta10;       
                document.querySelector("#subtotalconcepto10").innerHTML =respuesta.formulaconcepto10/100 * respuesta.sueldo;  
                if (document.getElementById("concepto10").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto10) {$("#idconcepto10").show();}
            }

            if (respuesta.concepto11) {
                document.getElementById("concepto11").checked = respuesta.checkmarkconcepto11;   
                document.getElementById("conceptoOculto11").value = respuesta.concepto11;   
                document.getElementById("concepto11").value = respuesta.formulaconcepto11/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto11").value =respuesta.nombreconcepto11;  
                document.querySelector("#formulaconcepto11").innerHTML =respuesta.formulaconcepto11;  
                document.querySelector("#idtipoboleta11").innerHTML =respuesta.idtipoboleta11;      
                document.querySelector("#subtotalconcepto11").innerHTML =respuesta.formulaconcepto11/100 * respuesta.sueldo;  
                if (document.getElementById("concepto11").checked) {
                     document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo; 
                }
                if (respuesta.nombreconcepto11) {$("#idconcepto11").show();}
            }

            if (respuesta.concepto12) {
                document.getElementById("concepto12").checked = respuesta.checkmarkconcepto12;  
                document.getElementById("conceptoOculto12").value = respuesta.concepto12;   
                document.getElementById("concepto12").value = respuesta.formulaconcepto12/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto12").value =respuesta.nombreconcepto12; 
                document.querySelector("#formulaconcepto12").innerHTML =respuesta.formulaconcepto12;  
                document.querySelector("#idtipoboleta12").innerHTML =respuesta.idtipoboleta12;      
                document.querySelector("#subtotalconcepto12").innerHTML =respuesta.formulaconcepto12/100 * respuesta.sueldo;  
                if (document.getElementById("concepto12").checked) {
                     document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto12) {$("#idconcepto12").show();}
            }

            if (respuesta.concepto13) {
                document.getElementById("concepto13").checked = respuesta.checkmarkconcepto13;  
                document.getElementById("conceptoOculto13").value = respuesta.concepto13;   
                document.getElementById("concepto13").value = respuesta.formulaconcepto13/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto13").value =respuesta.nombreconcepto13;
                document.querySelector("#formulaconcepto13").innerHTML =respuesta.formulaconcepto13;  
                document.querySelector("#idtipoboleta13").innerHTML =respuesta.idtipoboleta13;      
                document.querySelector("#subtotalconcepto13").innerHTML =respuesta.formulaconcepto13/100 * respuesta.sueldo;  
                if (document.getElementById("concepto13").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto13/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto13) {$("#idconcepto13").show();}
            }

            if (respuesta.concepto14) {
                document.getElementById("concepto14").checked = respuesta.checkmarkconcepto14;  
                document.getElementById("conceptoOculto14").value = respuesta.concepto14;   
                document.getElementById("concepto14").value = respuesta.formulaconcepto14/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto14").value =respuesta.nombreconcepto14; 
                document.querySelector("#formulaconcepto14").innerHTML =respuesta.formulaconcepto14;  
                document.querySelector("#idtipoboleta14").innerHTML =respuesta.idtipoboleta14;      
                document.querySelector("#subtotalconcepto14").innerHTML =respuesta.formulaconcepto14/100 * respuesta.sueldo; 
                if (document.getElementById("concepto14").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto13/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto14/100 * respuesta.sueldo;   
                }
                if (respuesta.nombreconcepto14) {$("#idconcepto14").show();}
            }

            if (respuesta.concepto15) {
                document.getElementById("concepto15").checked = respuesta.checkmarkconcepto15;
                document.getElementById("conceptoOculto15").value = respuesta.concepto15;     
                document.getElementById("concepto15").value = respuesta.formulaconcepto15/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto15").value =respuesta.nombreconcepto15; 
                document.querySelector("#formulaconcepto15").innerHTML =respuesta.formulaconcepto15;  
                document.querySelector("#idtipoboleta15").innerHTML =respuesta.idtipoboleta15;      
                document.querySelector("#subtotalconcepto15").innerHTML =respuesta.formulaconcepto15/100 * respuesta.sueldo;  
                if (document.getElementById("concepto15").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto13/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto14/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto15/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto15) {$("#idconcepto15").show();}
            }

            if (respuesta.concepto16) {
                document.getElementById("concepto16").checked = respuesta.checkmarkconcepto16;  
                document.getElementById("conceptoOculto16").value = respuesta.concepto16;   
                document.getElementById("concepto16").value = respuesta.formulaconcepto16/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto16").value =respuesta.nombreconcepto16; 
                document.querySelector("#formulaconcepto16").innerHTML =respuesta.formulaconcepto16;  
                document.querySelector("#idtipoboleta16").innerHTML =respuesta.idtipoboleta16;      
                document.querySelector("#subtotalconcepto16").innerHTML =respuesta.formulaconcepto16/100 * respuesta.sueldo;  
                if (document.getElementById("concepto16").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto13/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto14/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto15/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto16/100 * respuesta.sueldo; 
                }
                if (respuesta.nombreconcepto16) {$("#idconcepto16").show();}
            }

            if (respuesta.concepto17) {
                document.getElementById("concepto17").checked = respuesta.checkmarkconcepto17;  
                document.getElementById("conceptoOculto17").value = respuesta.concepto17;   
                document.getElementById("concepto17").value = respuesta.formulaconcepto17/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto17").value =respuesta.nombreconcepto17;  
                document.querySelector("#formulaconcepto17").innerHTML =respuesta.formulaconcepto17; 
                document.querySelector("#idtipoboleta17").innerHTML =respuesta.idtipoboleta17;       
                document.querySelector("#subtotalconcepto17").innerHTML =respuesta.formulaconcepto17/100 * respuesta.sueldo;  
                if (document.getElementById("concepto17").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto13/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto14/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto15/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto16/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto17/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto17) {$("#idconcepto17").show();}
            }

            if (respuesta.concepto18) {
                document.getElementById("concepto18").checked = respuesta.checkmarkconcepto18;  
                document.getElementById("conceptoOculto18").value = respuesta.concepto18;   
                document.getElementById("concepto18").value = respuesta.formulaconcepto18/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto18").value =respuesta.nombreconcepto18;  
                document.querySelector("#formulaconcepto18").innerHTML =respuesta.formulaconcepto18;  
                document.querySelector("#idtipoboleta18").innerHTML =respuesta.idtipoboleta18;      
                document.querySelector("#subtotalconcepto18").innerHTML =respuesta.formulaconcepto18/100 * respuesta.sueldo;  
                if (document.getElementById("concepto18").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto13/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto14/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto15/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto16/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto17/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto18/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto18) {$("#idconcepto18").show();}
            }

            if (respuesta.concepto19) {
                document.getElementById("concepto19").checked = respuesta.checkmarkconcepto19;  
                document.getElementById("conceptoOculto19").value = respuesta.concepto19;   
                document.getElementById("concepto19").value = respuesta.formulaconcepto19/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto19").value =respuesta.nombreconcepto19; 
                document.querySelector("#formulaconcepto19").innerHTML =respuesta.formulaconcepto19;  
                document.querySelector("#idtipoboleta19").innerHTML =respuesta.idtipoboleta19;      
                document.querySelector("#subtotalconcepto19").innerHTML =respuesta.formulaconcepto19/100 * respuesta.sueldo;  
                if (document.getElementById("concepto19").checked) {
                    document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto13/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto14/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto15/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto16/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto17/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto18/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto19/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto19) {$("#idconcepto19").show();}
            }

            if (respuesta.concepto20) {
                document.getElementById("concepto20").checked = respuesta.checkmarkconcepto20;  
                document.getElementById("conceptoOculto20").value = respuesta.concepto20;   
                document.getElementById("concepto20").value = respuesta.formulaconcepto20/100 * respuesta.sueldo;  
                document.querySelector("#nombreconcepto20").value =respuesta.nombreconcepto20;
                document.querySelector("#formulaconcepto20").innerHTML =respuesta.formulaconcepto20;  
                document.querySelector("#idtipoboleta20").innerHTML =respuesta.idtipoboleta20;      
                document.querySelector("#subtotalconcepto20").innerHTML =respuesta.formulaconcepto20/100 * respuesta.sueldo;  
                if (document.getElementById("concepto20").checked) {
                     document.getElementById("txtValor").value = 
                    respuesta.formulaconcepto1 * respuesta.sueldo + 
                    respuesta.formulaconcepto2 * respuesta.sueldo + 
                    respuesta.formulaconcepto3/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto4/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto5/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto6/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto7/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto8/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto9/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto10/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto11/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto12/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto13/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto14/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto15/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto16/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto17/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto18/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto19/100 * respuesta.sueldo + 
                    respuesta.formulaconcepto20/100 * respuesta.sueldo;  
                }
                if (respuesta.nombreconcepto20) {$("#idconcepto20").show();}
            }

          }        

          $('#modal-default').modal('show');           
        }      
    })      

    
    $("body").on('submit', '#formDefault', function(event) 
    {
      event.preventDefault()
      if ($('#formDefault').valid()) {    
        $.ajax({
          type:"POST",
          url: "detallepagoModelo.php?option=modificar",
          dataType: "json",
          data: $(this).serialize(),
          success: function(respuesta) {
            
            if (respuesta.error == 1) {             
              swal("Houston, tenemos un problema", "Este pago ya existe!", "error");        
            }
            if (respuesta.error ==2) {                
              swal("Houston, tenemos un problema", "Este detalle de pago está relacionado con un registro de otra tabla!, " + respuesta.errorDescription, "error");  
            }
            if (respuesta.error == 3) {            
              swal("Houston, tenemos un problema", "Debe introducir correctamente los datos! evite usar caracteres especiales", "error");
            }  
            if (respuesta.error == 4) {            
              swal("Houston, tenemos un problema", "Has intentado acceder sin cumplir con el token", "error");
            }    
            if (respuesta.error == 5) {            
              swal("Houston, tenemos un problema", "El importe debe ser menor de 10.000", "error");
            }  
            if (respuesta.exito == 1) {                       
              document.querySelector('#btnTextCancelar').innerHTML = "Cerrar";             
              window.location.href='index.php?periodo=' + document.querySelector("#periodo").value;         
            }
          }
        })
      }
    })  
} 