<?php 
session_start();
require_once('../../tools/sed.php');
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];  

if($option=="incluir"){   
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $nombre = $_POST['nombre'];
      $status = $_POST['status'];

      $nombre = eliminarComillas($nombre);

      if(empty($nombre))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "INSERT INTO `documentos` (`id`, `nombre`, `fecha`, `status`) VALUES (NULL, '$nombre', NOW(), $status)";

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

if($option=="consultar"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];

      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "SELECT * FROM documentos WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $nombre = $data['nombre'];
          $status = $data['status']; 
        }

        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  //documento eliminado
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($status!=0)  //documento activo o inactivo
        {
          $data = array("exito" => '1',"id"=>$id, "nombre"=> $nombre, 
           "fecha"=>$fecha, "status"=>$status);
          die(json_encode($data));
        }     
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
} 


if($option=="modificarConsultar"){ 
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "SELECT * FROM documentos WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];      
          $nombre = $data['nombre'];
          $fecha = $data['fecha'];      
          $status = $data['status'];    
          
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;
        }
       mysqli_close($conn);
       $data = array("exito" => '1', "id" => $id, "nombre"=> $nombre,
         "fecha" => $fecha, "status" => $status);
       die(json_encode($data));
  }else{
      $data = array("error" => '4');
      die(json_encode($data));
  }
}

if($option=="modificar"){  
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_POST['id'];

      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;  

      $nombre = $_POST['nombre'];
      $status = $_POST['status'];

      $nombre = eliminarComillas($nombre);
      
      if(empty($nombre))  
      {$data = array("error" => '3');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM documentos WHERE id = $clave";  
       
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];   
        }
       
        if(!empty($id))
        {
            $sql = "UPDATE documentos SET nombre = '$nombre', 
            status = $status WHERE id = $clave";
              
            if (mysqli_query($conn, $sql)) {
                     
              mysqli_close($conn);
              $data = array("exito" => '1');
              die(json_encode($data));
            } 
        }else{
                  
          mysqli_close($conn);
          $data = array("error" => '1');
          die(json_encode($data));    
        }
  }else{
      $data = array("error" => '4');
      die(json_encode($data));
  }
}


if($option=="eliminar"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];

      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "DELETE FROM documentos WHERE id = $clave";
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