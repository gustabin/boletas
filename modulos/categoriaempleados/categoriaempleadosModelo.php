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
    $idsindicato = $_POST['idsindicato'];
    $status = $_POST['status'];

    $nombre = eliminarComillas($nombre);

    
    $sindicatoDesencriptada = SED::decryption($idsindicato);
    $idsindicato = $sindicatoDesencriptada;

    
    if(empty($nombre))   
    {$data = array("error" => '2');
      die(json_encode($data));
    }    
    
    $sql = "INSERT INTO `categoriaempleados` (`id`, `idsindicato`, `nombre`, `fecha`, `status`) VALUES (NULL, $idsindicato, '$nombre', NOW(), $status)";
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

      $sql = "SELECT * FROM categoriaempleados WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $nombre = $data['nombre'];
          $status = $data['status']; 
        }

        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  //categoria de empleados eliminado
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }    

        if ($status!=0)  //categoria de empleados activo o inactivo
        {
          $data = array("exito" => '1',"id"=>$id, "idsindicato"=>$idsindicato, "nombre"=> $nombre, 
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

      $sql = "SELECT * FROM categoriaempleados WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];      
          $idsindicato = $data['idsindicato'];      
          $nombre = $data['nombre'];
          $fecha = $data['fecha'];      
          $status = $data['status'];    
          
          $claveEncriptada = SED::encryption($id);
          $id = $claveEncriptada;

          $claveSindicato = SED::encryption($idsindicato);
          $idsindicato = $claveSindicato;
        }
       mysqli_close($conn);
       $data = array("exito" => '1', "id" => $id, "idsindicato" => $idsindicato, "nombre"=> $nombre,
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

      $idsindicato = $_POST['idsindicato'];
      $nombre = $_POST['nombre'];
      $status = $_POST['status'];

      $nombre = eliminarComillas($nombre);

      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;
      
      if(empty($nombre))  
      {$data = array("error" => '3');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM categoriaempleados WHERE id = $clave";  
       
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];   
        }
       
        if(!empty($id))
        {
            $sql = "UPDATE categoriaempleados SET idsindicato = '$idsindicato', nombre = '$nombre', 
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

      $sql = "DELETE FROM categoriaempleados WHERE id = $clave";
      if (mysqli_query($conn, $sql)) {
        
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } else {

        if(mysqli_errno($conn)==1451){
          $data = array("error" => '5', "errorDescription" => mysqli_error($conn));          
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