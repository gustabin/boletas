<?php  
session_start();
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 
require_once('../../tools/sed.php');

$option = $_GET['option'];  

if($option=="contactar"){
  $nombre = $_POST['nombre']; 
  $telefono = $_POST['telefono']; 
  $email = $_POST['email'];  
  $mensaje = $_POST['mensaje'];    

  //Validar con preg_match
  $validaemail = preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['email']);


  if($validaemail == 0){
    
    $data = array("error" => '3');
    die(json_encode($data));
  } 

  
  if(empty($email) OR empty($nombre) OR empty($telefono) OR empty($mensaje))   
  {$data = array("error" => '2');
    die(json_encode($data));
  }

  //Buscar los datos en la tabla CONTACTO  
  $sql ="INSERT INTO `contacto` (`id`, `nombre`, `telefono`, `email`, `mensaje`, `status`, `fecha`) VALUES (NULL, '$nombre', '$telefono', '$email', '$mensaje', 0, NOW());";

  if (mysqli_query($conn, $sql)) {
    
    mysqli_close($conn);
    $data = array("exito" => '1');
    die(json_encode($data));
  } else {
    
    $data = array("error" => '1');
    die(json_encode($data));
  }  
}

mysqli_close($conn);