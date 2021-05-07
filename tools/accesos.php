<?php 
require_once('../../tools/mypathdb.php'); 

  if (!isset($_SESSION['rolid'])) {
    header("Location: ../../tools/logout.php");
  }

  $rolid = $_SESSION['rolid'];
  $sql = "SELECT * FROM roles WHERE id = $rolid";  

  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
      $accesos = $data['accesos']; 
  }  
  
  $_SESSION['acceso1'] = '';
  $_SESSION['acceso2'] = '';
  $_SESSION['acceso3'] = '';
  $_SESSION['acceso4'] = '';
  $_SESSION['acceso5'] = '';
  $_SESSION['acceso6'] = '';
  $_SESSION['acceso7'] = '';
  $_SESSION['acceso8'] = '';
  $_SESSION['acceso9'] = '';
  $_SESSION['acceso10'] = '';
  $_SESSION['acceso11'] = '';
  $_SESSION['acceso12'] = '';
  $_SESSION['acceso13'] = '';
  $_SESSION['acceso14'] = '';
  $_SESSION['acceso15'] = '';
  $_SESSION['acceso16'] = '';
  $_SESSION['acceso17'] = '';
  $_SESSION['acceso18'] = '';
  $_SESSION['acceso19'] = '';
  $_SESSION['acceso20'] = '';
  $_SESSION['acceso21'] = '';
  $_SESSION['acceso22'] = '';
  $_SESSION['acceso23'] = '';
  $_SESSION['acceso24'] = '';
  $_SESSION['acceso25'] = '';
  $_SESSION['acceso26'] = '';
  $_SESSION['acceso27'] = '';
  $_SESSION['acceso28'] = '';
  $_SESSION['acceso29'] = '';
  
  $data = $accesos;
  $cadena = explode(";", $data);      

  foreach ($cadena as $valor) {   
      if ($valor == 'Clientes') {          
          $_SESSION['acceso1'] = "Clientes";
      }     
  }
  foreach ($cadena as $valor) { 
      if ($valor == 'Bancos') {          
          $_SESSION['acceso2'] = "Bancos";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'CategoriaEmpleados') {         
          $_SESSION['acceso3'] = "CategoriaEmpleados";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Conceptos') {          
          $_SESSION['acceso4'] = "Conceptos";
      } 
  }  
  foreach ($cadena as $valor) {  
      if ($valor == 'Documentos') {          
          $_SESSION['acceso5'] = "Documentos";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Empresas') {          
          $_SESSION['acceso6'] = "Empresas";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'EmpresasLogin') {          
          $_SESSION['acceso7'] = "EmpresasLogin";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Esquema') {          
          $_SESSION['acceso8'] = "Esquema";
      } 
  }   
  foreach ($cadena as $valor) {  
      if ($valor == 'EstadoCivil') {          
          $_SESSION['acceso9'] = "EstadoCivil";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'ImporteSeguro') {          
          $_SESSION['acceso10'] = "ImporteSeguro";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Nacionalidades') {          
          $_SESSION['acceso11'] = "Nacionalidades";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Nomina') {          
          $_SESSION['acceso12'] = "Nomina";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Pagos') {          
          $_SESSION['acceso13'] = "Pagos";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Provincias') {          
          $_SESSION['acceso14'] = "Provincias";
      } 
  }     
  foreach ($cadena as $valor) {  
      if ($valor == 'Ramas') {          
          $_SESSION['acceso15'] = "Ramas";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Rol') {          
          $_SESSION['acceso16'] = "Rol";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Seteos') {          
          $_SESSION['acceso17'] = "Seteos";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'SituacionRevista') {          
          $_SESSION['acceso18'] = "SituacionRevista";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'TasaInteres') {          
          $_SESSION['acceso19'] = "TasaInteres";
      } 
  }  
  foreach ($cadena as $valor) {  
      if ($valor == 'TipoDocumento') {          
          $_SESSION['acceso20'] = "TipoDocumento";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Usuarios') {          
          $_SESSION['acceso21'] = "Usuarios";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Vencimiento') {          
          $_SESSION['acceso22'] = "Vencimiento";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Contacto') {          
          $_SESSION['acceso23'] = "Contacto";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Padron') {          
          $_SESSION['acceso24'] = "Padron";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Sindicato') {          
          $_SESSION['acceso25'] = "Sindicato";
      } 
  }  
  foreach ($cadena as $valor) {  
      if ($valor == 'Seccional') {          
          $_SESSION['acceso26'] = "Seccional";
      } 
  } 
  foreach ($cadena as $valor) {  
      if ($valor == 'Recibos') {          
          $_SESSION['acceso27'] = "Recibos";
      } 
  }   
  foreach ($cadena as $valor) {  
      if ($valor == 'Importar') {          
          $_SESSION['acceso28'] = "Importar";
      } 
  }
  foreach ($cadena as $valor) {  
      if ($valor == 'Tipoboleta') {          
          $_SESSION['acceso29'] = "Tipoboleta";
      } 
  }      
?>
<?php
  // $sql = "SELECT COUNT(*) total FROM contacto WHERE status = 0";
  // $result = mysqli_query($conn, $sql);
  // $fila = mysqli_fetch_assoc($result);  
  // $solicitudContactos= $fila['total'];