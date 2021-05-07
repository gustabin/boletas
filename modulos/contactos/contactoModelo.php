<?php require_once('../../tools/sed.php');?> 
<?php 
session_start();
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];  

if($option=="modificarConsultar"){  
  $clave = $_GET['id'];

  
  $claveDesencriptada = SED::decryption($clave);
  $clave=$claveDesencriptada;

  $sql = "SELECT * FROM contactos WHERE id = $clave";  
  
  $result = mysqli_query($conn, $sql);
  while($data=mysqli_fetch_array($result))
    {
      $id = $data['id'];      
      $nombre = $data['nombre'];
      $telefono = $data['telefono'];      
      $email = $data['email'];      
      $mensaje = $data['mensaje'];      
      $fecha = $data['fecha'];      
      $status = $data['status'];   
      
      $claveEncriptada = SED::encryption($id);
      $id=$claveEncriptada;
    }
   mysqli_close($conn);
   $data = array("exito" => '1', "id" => $id, "nombre" => $nombre, "telefono" => $telefono, "email" => $email,
   "mensaje" => $mensaje, "fecha" => $fecha, "status" => $status);   
   die(json_encode($data));
}


if($option=="eliminar"){
  $clave = $_GET['id'];
  
  $claveDesencriptada = SED::decryption($clave);
  $clave=$claveDesencriptada;

  $sql = "DELETE FROM contactos WHERE id = $clave";

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
}

mysqli_close($conn);