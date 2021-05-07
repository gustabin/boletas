<?php
// Modulo ajax para recuperar el password del usuario
$email = strtolower($_POST['usuario']);

// === Consultar los datos en la tabla usuarios ===== 
require_once('../../tools/mypathdb.php');
require_once('../../tools/eliminarComillas.php');
require_once('../../tools/sed.php');

//eliminar ataques por injeccion de codigo
$email = eliminarComillas($email);
// ======= Consultar los datos en la tabla usuarios =======
$sql = "SELECT * FROM usuario WHERE email='$email'"; 

$result = mysqli_query($conn, $sql);
while($data=mysqli_fetch_array($result))
{   // Los datos se han encontrado correctamente
	$nombre = $data['nombre'];
	$apellido = $data['apellido'];
	$clave = $data['password'];
	 
	$claveDesencriptada = SED::decryption($clave);
	$clave=$claveDesencriptada;
	
	// === Enviar un correo notificando que alguien se esta recuperando la clave ===
	$destino = "gustabin@yahoo.com";
	$asunto = "Solicitud de clave del sistema";
	$cabeceras = "Content-type: text/html";
	$cuerpo = "<h2>Hola, un usuario esta recuperando la clave en boletas sindicales!</h2>
	Hemos recibido la siguiente información:<br>	
	<b>Usuario: </b> $nombre  $apellido<br>	
	<b>Email: </b> $email<br>	
	<br><br>
	<br>
	El equipo de boletas sindicales.<br>
	<img src=https://oikosplus.com/tienda/admin/img/logoEmpresa.png height=50px width=50px />
	<a href=https://www.facebook.com/gustabin2.0>
	<img src=https://oikosplus.com/boletas/img/logoFacebook.jpg alt=Logo Facebook height=50px width=50px></a>
	<h5>Desarrollado por Ing. Gustavo Arias<br>
	Copyright © 2020. Todos los derechos reservados. Version 1.0.0 <br></h5>
	";
	
	$yourWebsite = "oikosplus.com";
	$yourEmail = "info@oikosplus.com";
	$cabeceras = "From: $yourWebsite <$yourEmail>\n" . "Content-type: text/html";
	
	if ($_SERVER['SERVER_NAME']!='localhost') {
		mail($destino,$asunto,$cuerpo,$cabeceras);
	}

	// ===== envio de correo al cliente =======	
	$destino = $email;
	$asunto = "Recuperación de clave del sistema boletas";
	$cabeceras = "Content-type: text/html";
	$cuerpo = "<h2>Apreciado cliente, </h2> $nombre $apellido <br>
	Hemos recuperado los datos solicitados. <br><br>
	Su clave es: $clave<br>
	Su usuario es: $email<br><br><br>
	Gracias por confiar en nosotros.
	<br>
	El equipo de boletas sindicales.<br>
	<img src=https://oikosplus.com/tienda/admin/img/logoEmpresa.png height=50px width=50px />
	<a href=https://www.facebook.com/gustabin2.0>
	<img src=https://oikosplus.com/tienda/admin/img/logoFacebook.jpg alt=Logo Facebook height=50px width=50px></a>
	<h5>Desarrollado por Ing. Gustavo Arias<br>
	Copyright © 2020. Todos los derechos reservados. Version 1.0.0 <br></h5>
	";

	$yourWebsite = "oikosplus.com";
	$yourEmail = "info@oikosplus.com";
	$cabeceras = "From: $yourWebsite <$yourEmail>\n" . "Content-type: text/html";
	if ($_SERVER['SERVER_NAME']!='localhost') {
		mail($destino,$asunto,$cuerpo,$cabeceras);
	}

	//== envio de informacion al ajax
	$data = array ("exito" => '1');
	die(json_encode($data));
}
	// ========== No encontrado ocurrio un error ===========
	mysqli_close($conn);
	$data = array("error" => '1');
	die(json_encode($data));
?>