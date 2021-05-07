<?php 
session_start();
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/sed.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];

if ($option=="sindicato") {
	$id = $_POST['sindicato'];
	$claveDesencriptada = SED::decryption($id);
  	$id=$claveDesencriptada;  

    $sql = "SELECT * FROM sindicatos WHERE id=$id";   

    $resultado = mysqli_query($conn, $sql);
    while($data = mysqli_fetch_array($resultado))
    {
      $nombre = $data['razonsocial'];       
    }                         
	$_SESSION['nombresindicato']= $nombre;
	$_SESSION['idsindicato']= $id;


	if ( isset($_POST['idempresa'])) {
		$id = $_POST['idempresa'];
		$claveDesencriptada = SED::decryption($id);
	  	$id=$claveDesencriptada;  

	    $sql = "SELECT * FROM empresas WHERE id=$id";   

	    $resultado = mysqli_query($conn, $sql);
	    while($data = mysqli_fetch_array($resultado))
	    {
	      $nombre = $data['nombre'];       
	    }                             		
		$_SESSION['nombreempresa']= $nombre;
		$_SESSION['idempresa']= $id;
	}
	
	$data = array("exito" => '1');	
	die(json_encode($data));
}

// if ($option=="empresa") {
// 	$id = $_POST['empresa'];

//     $sql = "SELECT * FROM empresas WHERE id=$id";   
//     $resultado = mysqli_query($conn, $sql);
//     while($data = mysqli_fetch_array($resultado))
//     {
//       $nombre = $data['nombre'];       
//     }                             
		
// 	$_SESSION['nombreempresa']= $nombre;
// 	$_SESSION['idempresa']= $id;

// 	$data = array("exito" => '1');	
// 	die(json_encode($data));
// }

if ($option=="incluir") {
	$token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
	if($_SESSION['token'] == $token){
		  $nombre = $_POST['nombre'];
		  $descripcion = $_POST['descripcion'];

		  $_POST['txtAcceso1'] = isset($_POST['txtAcceso1']) ? $acceso1 = $_POST['txtAcceso1'] : $acceso1 = "";
		  $_POST['txtAcceso2'] = isset($_POST['txtAcceso2']) ? $acceso2 = $_POST['txtAcceso2'] : $acceso2 = "";
		  $_POST['txtAcceso3'] = isset($_POST['txtAcceso3']) ? $acceso3 = $_POST['txtAcceso3'] : $acceso3 = "";
		  $_POST['txtAcceso4'] = isset($_POST['txtAcceso4']) ? $acceso4 = $_POST['txtAcceso4'] : $acceso4 = "";
		  $_POST['txtAcceso5'] = isset($_POST['txtAcceso5']) ? $acceso5 = $_POST['txtAcceso5'] : $acceso5 = "";
		  $_POST['txtAcceso6'] = isset($_POST['txtAcceso6']) ? $acceso6 = $_POST['txtAcceso6'] : $acceso6 = "";
		  $_POST['txtAcceso7'] = isset($_POST['txtAcceso7']) ? $acceso7 = $_POST['txtAcceso7'] : $acceso7 = "";
		  $_POST['txtAcceso8'] = isset($_POST['txtAcceso8']) ? $acceso8 = $_POST['txtAcceso8'] : $acceso8 = "";
		  $_POST['txtAcceso9'] = isset($_POST['txtAcceso9']) ? $acceso9 = $_POST['txtAcceso9'] : $acceso9 = "";
		  $_POST['txtAcceso10'] = isset($_POST['txtAcceso10']) ? $acceso10 = $_POST['txtAcceso10'] : $acceso10 = "";
		  $_POST['txtAcceso11'] = isset($_POST['txtAcceso11']) ? $acceso11 = $_POST['txtAcceso11'] : $acceso11 = "";
		  $_POST['txtAcceso12'] = isset($_POST['txtAcceso12']) ? $acceso12 = $_POST['txtAcceso12'] : $acceso12 = "";
		  $_POST['txtAcceso13'] = isset($_POST['txtAcceso13']) ? $acceso13 = $_POST['txtAcceso13'] : $acceso13 = "";
		  $_POST['txtAcceso14'] = isset($_POST['txtAcceso14']) ? $acceso14 = $_POST['txtAcceso14'] : $acceso14 = "";
		  $_POST['txtAcceso15'] = isset($_POST['txtAcceso15']) ? $acceso15 = $_POST['txtAcceso15'] : $acceso15 = "";
		  $_POST['txtAcceso16'] = isset($_POST['txtAcceso16']) ? $acceso16 = $_POST['txtAcceso16'] : $acceso16 = "";
		  $_POST['txtAcceso17'] = isset($_POST['txtAcceso17']) ? $acceso17 = $_POST['txtAcceso17'] : $acceso17 = "";
		  $_POST['txtAcceso18'] = isset($_POST['txtAcceso18']) ? $acceso18 = $_POST['txtAcceso18'] : $acceso18 = "";
		  $_POST['txtAcceso19'] = isset($_POST['txtAcceso19']) ? $acceso19 = $_POST['txtAcceso19'] : $acceso19 = "";
		  $_POST['txtAcceso20'] = isset($_POST['txtAcceso20']) ? $acceso20 = $_POST['txtAcceso20'] : $acceso20 = "";
		  $_POST['txtAcceso21'] = isset($_POST['txtAcceso21']) ? $acceso21 = $_POST['txtAcceso21'] : $acceso21 = "";
		  $_POST['txtAcceso22'] = isset($_POST['txtAcceso22']) ? $acceso22 = $_POST['txtAcceso22'] : $acceso22 = "";
		  $_POST['txtAcceso23'] = isset($_POST['txtAcceso23']) ? $acceso23 = $_POST['txtAcceso23'] : $acceso23 = "";
		  $_POST['txtAcceso24'] = isset($_POST['txtAcceso24']) ? $acceso24 = $_POST['txtAcceso24'] : $acceso24 = "";
		  $_POST['txtAcceso25'] = isset($_POST['txtAcceso25']) ? $acceso25 = $_POST['txtAcceso25'] : $acceso25 = "";
		  $_POST['txtAcceso26'] = isset($_POST['txtAcceso26']) ? $acceso26 = $_POST['txtAcceso26'] : $acceso26 = "";
		  $_POST['txtAcceso27'] = isset($_POST['txtAcceso27']) ? $acceso27 = $_POST['txtAcceso27'] : $acceso27 = "";
		  $_POST['txtAcceso28'] = isset($_POST['txtAcceso28']) ? $acceso28 = $_POST['txtAcceso28'] : $acceso28 = "";
		  $_POST['txtAcceso29'] = isset($_POST['txtAcceso29']) ? $acceso29 = $_POST['txtAcceso29'] : $acceso29 = "";

		  $acceso1 = eliminarComillas($acceso1);
		  $acceso2 = eliminarComillas($acceso2);
		  $acceso3 = eliminarComillas($acceso3);
		  $acceso4 = eliminarComillas($acceso4);  
		  $acceso5 = eliminarComillas($acceso5); 
		  $acceso6 = eliminarComillas($acceso6);
		  $acceso7 = eliminarComillas($acceso7);
		  $acceso8 = eliminarComillas($acceso8);
		  $acceso9 = eliminarComillas($acceso9);
		  $acceso10 = eliminarComillas($acceso10);
		  $acceso11 = eliminarComillas($acceso11);
		  $acceso12 = eliminarComillas($acceso12);
		  $acceso13 = eliminarComillas($acceso13);
		  $acceso14 = eliminarComillas($acceso14);
		  $acceso15 = eliminarComillas($acceso15);
		  $acceso16 = eliminarComillas($acceso16);
		  $acceso17 = eliminarComillas($acceso17);
		  $acceso18 = eliminarComillas($acceso18);
		  $acceso19 = eliminarComillas($acceso19);
		  $acceso20 = eliminarComillas($acceso20);
		  $acceso21 = eliminarComillas($acceso21);
		  $acceso22 = eliminarComillas($acceso22);
		  $acceso23 = eliminarComillas($acceso23);
		  $acceso24 = eliminarComillas($acceso24);
		  $acceso25 = eliminarComillas($acceso25);
		  $acceso26 = eliminarComillas($acceso26);
		  $acceso27 = eliminarComillas($acceso27);
		  $acceso28 = eliminarComillas($acceso28);
		  $acceso29 = eliminarComillas($acceso29);
		  
		  $accesos = $acceso1 .";". $acceso2 .";". $acceso3 .";". $acceso4 .";". $acceso5 .";". $acceso6 .";". $acceso7 .";". $acceso8 
		  .";". $acceso9 .";". $acceso10 .";". $acceso11 .";". $acceso12 .";". $acceso13 .";". $acceso14 .";". $acceso15
		  .";". $acceso16 .";". $acceso17 .";". $acceso18 .";". $acceso19 .";". $acceso20 .";". $acceso21 .";". $acceso22
		  .";". $acceso23 .";". $acceso24 .";". $acceso25 .";". $acceso26 .";". $acceso27 .";". $acceso28 .";". $acceso29;

			$status = $_POST['status'];

			$validanombre = preg_match('/^[a-zA-ZñÑáéíóúü0-9-.,; ]+$/', $_POST['nombre']);

			if ($validanombre == 0) {
				$data = array("error" => '3');
				die(json_encode($data));
			}

			$descripcion = eliminarComillas($descripcion);
			$nombre = eliminarComillas($nombre);

			if (empty($nombre) OR empty($descripcion) OR empty($status)) {
				$data = array("error" => '2');
				die(json_encode($data));
			}

		  $sql = "INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `accesos`, `fecha`, `status`) VALUES 
		  (NULL, '$nombre', '$descripcion', '$accesos', NOW(), '$status')";
			if (mysqli_query($conn, $sql)) {
				mysqli_close($conn);
				$data = array("exito" => '1');
				die(json_encode($data));
			} else {
				$data = array("error" => '1');
				die(json_encode($data));
			}
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if ($option=="consultar") {
	$token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
	if($_SESSION['token'] == $token){
			$clave = $_GET['id'];

			$claveDesencriptada = SED::decryption($clave);
	  	$clave=$claveDesencriptada;

	  	$sql = "SELECT * FROM roles WHERE id = $clave";
	  	$resultado = mysqli_query($conn, $sql);
	    while($data = mysqli_fetch_array($resultado))
	    {
	      $id = $data['id'];
	      $nombre = $data['nombre'];
	      $descripcion = $data['descripcion'];
	      $accesos = $data['accesos'];
	      $fecha = $data['fecha'];
	      $status = $data['status'];
	  	}

	  	if (!isset($status)) 
	  	{
	  		$data = array("error" => '2');
			die(json_encode($data));
	  	}

	  	if ($status==2) // Rol eliminado
	  	{
	  		$data = array("error" => '1');
			die(json_encode($data));
	  	}

	  	if ($status!=2) // Rol activo o inactivo
	  	{
	  		$data = array("exito" => '1', "id" => $id, "nombre" => $nombre, "descripcion" => $descripcion, "accesos" => $accesos,
	  	           "fecha" => $fecha, "status" => $status);
			die(json_encode($data));
	  	}
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if ($option=="modificarConsultar") {
	$token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
	if($_SESSION['token'] == $token){
			$clave = $_GET['id'];

			$claveDesencriptada = SED::decryption($clave);
		  	$clave=$claveDesencriptada;

		  	$sql = "SELECT * FROM roles WHERE id = $clave";

		  	$resultado = mysqli_query($conn, $sql);
		    while($data = mysqli_fetch_array($resultado))
		    {
		      $id = $data['id'];
		      $nombre = $data['nombre'];
		      $descripcion = $data['descripcion'];
		      $accesos = $data['accesos'];
		      $fecha = $data['fecha'];
		      $status = $data['status'];
		      
		      $claveEncriptada = SED::encryption($id);
		      $id=$claveEncriptada;
		  	}

		    mysqli_close($conn);  	
		      $acceso1 = '';
			  $acceso2 = '';
			  $acceso3 = '';
			  $acceso4 = '';
			  $acceso5 = '';
			  $acceso6 = '';
			  $acceso7 = '';
			  $acceso8 = '';
			  $acceso9 = '';
			  $acceso10 = '';
			  $acceso11 = '';
			  $acceso12 = '';
			  $acceso13 = '';
			  $acceso14 = '';
			  $acceso15 = '';
			  $acceso16 = '';
			  $acceso17 = '';
			  $acceso18 = '';
			  $acceso19 = '';
			  $acceso20 = '';
			  $acceso21 = '';
			  $acceso22 = '';
			  $acceso23 = '';
			  $acceso24 = '';
			  $acceso25 = '';
			  $acceso26 = '';
			  $acceso27 = '';
			  $acceso28 = '';
			  $acceso29 = '';
			  $data = $accesos;

			  $cadena = explode(";", $data);      

			  foreach ($cadena as $valor) {   
			      if ($valor == 'Clientes') {
			          $acceso1 = 'checked';
			      }     
			  }
			  foreach ($cadena as $valor) { 
			      if ($valor == 'Bancos') {
			          $acceso2 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'CategoriaEmpleados') {
			          $acceso3 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Conceptos') {
			          $acceso4 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Documentos') {
			          $acceso5 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Empresas') {
			          $acceso6 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'EmpresasLogin') {
			          $acceso7 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Esquema') {
			          $acceso8 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'EstadoCivil') {
			          $acceso9 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'ImporteSeguro') {
			          $acceso10 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Nacionalidades') {
			          $acceso11 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Nomina') {
			          $acceso12 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Pagos') {
			          $acceso13 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Provincias') {
			          $acceso14 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Ramas') {
			          $acceso15 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Rol') {
			          $acceso16 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Seteos') {
			          $acceso17 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'SituacionRevista') {
			          $acceso18 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'TasaInteres') {
			          $acceso19 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'TipoDocumento') {
			          $acceso20 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Usuarios') {
			          $acceso21 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Vencimiento') {
			          $acceso22 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Contacto') {
			          $acceso23 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Padron') {
			          $acceso24 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Sindicato') {
			          $acceso25 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Seccional') {
			          $acceso26 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Recibos') {
			          $acceso27 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Importar') {
			          $acceso28 = 'checked';
			      } 
			  }
			  foreach ($cadena as $valor) {  
			      if ($valor == 'Tipoboleta') {
			          $acceso29 = 'checked';
			      } 
			  }

				$data = array(
					"exito" => '1', 
					"id" => $id, 
					"nombre" => $nombre, 
					"descripcion" => $descripcion, 
					"accesos" => $accesos,
				    "acceso1" => $acceso1, 
				    "acceso2" => $acceso2, 
				    "acceso3" => $acceso3, 
				    "acceso4" => $acceso4,  
				    "acceso5" => $acceso5,
				    "acceso6" => $acceso6,
				    "acceso7" => $acceso7,  
				    "acceso8" => $acceso8,
				    "acceso9" => $acceso9,
				    "acceso10" => $acceso10,
				    "acceso11" => $acceso11,
				    "acceso12" => $acceso12,
				    "acceso13" => $acceso13,
				    "acceso14" => $acceso14,
				    "acceso15" => $acceso15,
				    "acceso16" => $acceso16,
				    "acceso17" => $acceso17,
				    "acceso18" => $acceso18,
				    "acceso19" => $acceso19,
				    "acceso20" => $acceso20,
				    "acceso21" => $acceso21,
				    "acceso22" => $acceso22,
				    "acceso23" => $acceso23,
				    "acceso24" => $acceso24,
				    "acceso25" => $acceso25,
				    "acceso26" => $acceso26,
				    "acceso27" => $acceso27,
				    "acceso28" => $acceso28,
				    "acceso29" => $acceso29,
						"fecha" => $fecha, 
						"status" => $status);
			die(json_encode($data));
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if ($option=="modificar") {
	$token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
	if($_SESSION['token'] == $token){
			$clave = $_POST['id'];
			$claveDesencriptada = SED::decryption($clave);
		 	$clave=$claveDesencriptada;

			$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];

		  $_POST['txtAcceso1'] = isset($_POST['txtAcceso1']) ? $acceso1 = $_POST['txtAcceso1'] : $acceso1 = "";
		  $_POST['txtAcceso2'] = isset($_POST['txtAcceso2']) ? $acceso2 = $_POST['txtAcceso2'] : $acceso2 = "";
		  $_POST['txtAcceso3'] = isset($_POST['txtAcceso3']) ? $acceso3 = $_POST['txtAcceso3'] : $acceso3 = "";
		  $_POST['txtAcceso4'] = isset($_POST['txtAcceso4']) ? $acceso4 = $_POST['txtAcceso4'] : $acceso4 = "";
		  $_POST['txtAcceso5'] = isset($_POST['txtAcceso5']) ? $acceso5 = $_POST['txtAcceso5'] : $acceso5 = "";
		  $_POST['txtAcceso6'] = isset($_POST['txtAcceso6']) ? $acceso6 = $_POST['txtAcceso6'] : $acceso6 = "";
		  $_POST['txtAcceso7'] = isset($_POST['txtAcceso7']) ? $acceso7 = $_POST['txtAcceso7'] : $acceso7 = "";
		  $_POST['txtAcceso8'] = isset($_POST['txtAcceso8']) ? $acceso8 = $_POST['txtAcceso8'] : $acceso8 = "";
		  $_POST['txtAcceso9'] = isset($_POST['txtAcceso9']) ? $acceso9 = $_POST['txtAcceso9'] : $acceso9 = "";
		  $_POST['txtAcceso10'] = isset($_POST['txtAcceso10']) ? $acceso10 = $_POST['txtAcceso10'] : $acceso10 = "";
		  $_POST['txtAcceso11'] = isset($_POST['txtAcceso11']) ? $acceso11 = $_POST['txtAcceso11'] : $acceso11 = "";
		  $_POST['txtAcceso12'] = isset($_POST['txtAcceso12']) ? $acceso12 = $_POST['txtAcceso12'] : $acceso12 = "";
		  $_POST['txtAcceso13'] = isset($_POST['txtAcceso13']) ? $acceso13 = $_POST['txtAcceso13'] : $acceso13 = "";
		  $_POST['txtAcceso14'] = isset($_POST['txtAcceso14']) ? $acceso14 = $_POST['txtAcceso14'] : $acceso14 = "";
		  $_POST['txtAcceso15'] = isset($_POST['txtAcceso15']) ? $acceso15 = $_POST['txtAcceso15'] : $acceso15 = "";
		  $_POST['txtAcceso16'] = isset($_POST['txtAcceso16']) ? $acceso16 = $_POST['txtAcceso16'] : $acceso16 = "";
		  $_POST['txtAcceso17'] = isset($_POST['txtAcceso17']) ? $acceso17 = $_POST['txtAcceso17'] : $acceso17 = "";
		  $_POST['txtAcceso18'] = isset($_POST['txtAcceso18']) ? $acceso18 = $_POST['txtAcceso18'] : $acceso18 = "";
		  $_POST['txtAcceso19'] = isset($_POST['txtAcceso19']) ? $acceso19 = $_POST['txtAcceso19'] : $acceso19 = "";
		  $_POST['txtAcceso20'] = isset($_POST['txtAcceso20']) ? $acceso20 = $_POST['txtAcceso20'] : $acceso20 = "";
		  $_POST['txtAcceso21'] = isset($_POST['txtAcceso21']) ? $acceso21 = $_POST['txtAcceso21'] : $acceso21 = "";
		  $_POST['txtAcceso22'] = isset($_POST['txtAcceso22']) ? $acceso22 = $_POST['txtAcceso22'] : $acceso22 = "";
		  $_POST['txtAcceso23'] = isset($_POST['txtAcceso23']) ? $acceso23 = $_POST['txtAcceso23'] : $acceso23 = "";
		  $_POST['txtAcceso24'] = isset($_POST['txtAcceso24']) ? $acceso24 = $_POST['txtAcceso24'] : $acceso24 = "";
		  $_POST['txtAcceso25'] = isset($_POST['txtAcceso25']) ? $acceso25 = $_POST['txtAcceso25'] : $acceso25 = "";
		  $_POST['txtAcceso26'] = isset($_POST['txtAcceso26']) ? $acceso26 = $_POST['txtAcceso26'] : $acceso26 = "";
		  $_POST['txtAcceso27'] = isset($_POST['txtAcceso27']) ? $acceso27 = $_POST['txtAcceso27'] : $acceso27 = "";
		  $_POST['txtAcceso28'] = isset($_POST['txtAcceso28']) ? $acceso28 = $_POST['txtAcceso28'] : $acceso28 = "";
		  $_POST['txtAcceso29'] = isset($_POST['txtAcceso29']) ? $acceso29 = $_POST['txtAcceso29'] : $acceso29 = "";

		  $acceso1 = eliminarComillas($acceso1);
		  $acceso2 = eliminarComillas($acceso2);
		  $acceso3 = eliminarComillas($acceso3);
		  $acceso4 = eliminarComillas($acceso4);  
		  $acceso5 = eliminarComillas($acceso5);  
		  $acceso6 = eliminarComillas($acceso6);
		  $acceso7 = eliminarComillas($acceso7);
		  $acceso8 = eliminarComillas($acceso8);
		  $acceso9 = eliminarComillas($acceso9);
		  $acceso10 = eliminarComillas($acceso10);
		  $acceso11 = eliminarComillas($acceso11);
		  $acceso12 = eliminarComillas($acceso12);
		  $acceso13 = eliminarComillas($acceso13);
		  $acceso14 = eliminarComillas($acceso14);
		  $acceso15 = eliminarComillas($acceso15);
		  $acceso16 = eliminarComillas($acceso16);
		  $acceso17 = eliminarComillas($acceso17);
		  $acceso18 = eliminarComillas($acceso18);
		  $acceso19 = eliminarComillas($acceso19);
		  $acceso20 = eliminarComillas($acceso20);
		  $acceso21 = eliminarComillas($acceso21);
		  $acceso22 = eliminarComillas($acceso22);
		  $acceso23 = eliminarComillas($acceso23);
		  $acceso24 = eliminarComillas($acceso24);
		  $acceso25 = eliminarComillas($acceso25);
		  $acceso26 = eliminarComillas($acceso26);
		  $acceso27 = eliminarComillas($acceso27);
		  $acceso28 = eliminarComillas($acceso28);
		  $acceso29 = eliminarComillas($acceso29);
		  $accesos = $acceso1 .";". $acceso2 .";". $acceso3 .";". $acceso4 .";". $acceso5 .";". $acceso6 .";". $acceso7 .";". $acceso8 
		  .";". $acceso9 .";". $acceso10 .";". $acceso11 .";". $acceso12 .";". $acceso13 .";". $acceso14 .";". $acceso15
		  .";". $acceso16 .";". $acceso17 .";". $acceso18 .";". $acceso19 .";". $acceso20 .";". $acceso21 .";". $acceso22
		  .";". $acceso23 .";". $acceso24 .";". $acceso25 .";". $acceso26 .";". $acceso27 .";". $acceso28 .";". $acceso29;

			$status = $_POST['status'];

			$validanombre = preg_match('/^[a-zA-ZñÑáéíóúü0-9-.,; ]+$/', $_POST['nombre']);

			if ($validanombre == 0) {
				$data = array("error" => '3');
				die(json_encode($data));
			}

			$descripcion = eliminarComillas($descripcion);
			$nombre = eliminarComillas($nombre);

			if (empty($nombre) OR empty($descripcion)) {
				$data = array("error" => '3');
				die(json_encode($data));
			}

			$sql = "SELECT * FROM roles WHERE nombre = '$nombre' AND id != $clave";

			$resultado = mysqli_query($conn, $sql);
		    while($data = mysqli_fetch_array($resultado))
		    {
		      $id = $data['id'];
		      $nombre = $data['nombre'];
		      $descripcion = $data['descripcion'];
		      $accesos = $data['accesos'];
		      $fecha = $data['fecha'];
		      $status = $data['status']; 
		  	}
		  	if (empty($id)) 
		  	{
		  		$sql = "UPDATE roles SET nombre = '$nombre', descripcion = '$descripcion',
		  		status = $status, accesos = '$accesos' WHERE id = $clave";

		  		if (mysqli_query($conn, $sql)) {
		  			mysqli_close($conn);
		  			$data = array("exito" => '1');
					die(json_encode($data));
		  		}
		  	} else {
				$data = array("error" => '1');
				die(json_encode($data));
		  	}	
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if ($option=="eliminar") {
	$token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
	if($_SESSION['token'] == $token){
			$clave = $_GET['id'];

			$claveDesencriptada = SED::decryption($clave);
		  	$clave=$claveDesencriptada;

		  	$sql = "DELETE FROM roles WHERE id = $clave";  		
		  		
			if (mysqli_query($conn, $sql)) {
				mysqli_close($conn);
				$data = array("exito" => '1');
				die(json_encode($data));
		  	} else {
			    if(mysqli_errno($conn)==1451){
		          $data = array("error" => '2', "errorDescription" => mysqli_error($conn));
		          die(json_encode($data));  
		        } 
			    mysqli_close($conn);
					$data = array("error" => '1');
					die(json_encode($data));
				}	
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

mysqli_close($conn);