<?php 
session_start();
require_once('../../tools/sed.php');
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];  

if($option=="incluir"){ 
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $idempresa = $_POST['idempresa'];
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $telefono = $_POST['telefono'];
      $email = $_POST['email'];
      $cuil = $_POST['cuil'];
      $direccion = $_POST['direccion'];
      $rolid = $_POST['rolid'];
      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($idempresa);
      $idempresa=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($rolid);
      $rolid=$claveDesencriptada;

      $idempresa = eliminarComillas($idempresa);
      $nombre = eliminarComillas($nombre);
      $apellido = eliminarComillas($apellido);
      $telefono = eliminarComillas($telefono);
      $email = eliminarComillas($email);

      $cuil = eliminarComillas($cuil);
      $direccion = eliminarComillas($direccion);
      $rolid = eliminarComillas($rolid);
      $status = eliminarComillas($status);

      if(empty($idempresa) OR empty($nombre)  OR empty($apellido)  OR empty($telefono)  OR empty($email) OR empty($cuil)  OR empty($direccion)  OR empty($rolid) )   
      {$data = array("error" => '2');
        die(json_encode($data));
      }
     
      $password = SED::encryption($password);

      $sql = "INSERT INTO `usuario` (`id`, `idempresa`, `nombre`, `apellido`, `telefono`, `email`, `password`, `cuil`, `direccion`, `rolid`, `fecha`, `status`) VALUES (NULL, '$idempresa', '$nombre', '$apellido', '$telefono', '$email', '$password', '$cuil', '$direccion', '$rolid', NOW(), $status)";

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

      $sql = "SELECT * FROM usuario WHERE id = $clave";

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idempresa = $data['idempresa'];
          $nombre = $data['nombre'];
          $apellido = $data['apellido'];
          $telefono = $data['telefono'];
          $email = $data['email'];
          $password = $data['password'];
          $cuil = $data['cuil'];
          $direccion = $data['direccion'];
          $rolid = $data['rolid'];
          $fecha = $data['fecha'];
          $status = $data['status']; 
        }

        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  //ramo eliminado
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;

          $claveDesencriptada = SED::decryption($idempresa);
          $idempresa=$claveDesencriptada;

          $claveDesencriptada = SED::decryption($rolid);
          $rolid=$claveDesencriptada;

        if ($status!=0)  //ramo activo o inactivo
        {
          $data = array("exito" => '1',
            "id"=>$id, 
            "idempresa"=>$idempresa, 
            "nombre"=> $nombre, 
            "apellido"=> $apellido, 
            "telefono"=> $telefono, 
            "email"=> $email, 
            "password"=> $password, 
            "cuil"=> $cuil, 
            "direccion"=> $direccion, 
            "rolid"=> $rolid,
            "fecha"=>$fecha, 
            "status"=>$status);
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

      $sql = "SELECT * FROM usuario WHERE id = $clave";   
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idempresa = $data['idempresa'];
          $nombre = $data['nombre'];
          $apellido = $data['apellido'];
          $telefono = $data['telefono'];
          $email = $data['email'];
          $password = $data['password'];
          $cuil = $data['cuil'];
          $direccion = $data['direccion'];
          $rolid = $data['rolid'];
          $fecha = $data['fecha'];
          $status = $data['status']; 
          
          // 
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;

          $claveEncriptada = SED::encryption($idempresa);
          $idempresa=$claveEncriptada;

          $claveEncriptada = SED::encryption($rolid);
          $rolid=$claveEncriptada;
        }
       mysqli_close($conn);
       $data = array("exito" => '1',
            "id"=>$id, 
            "idempresa"=>$idempresa, 
            "nombre"=> $nombre, 
            "apellido"=> $apellido, 
            "telefono"=> $telefono, 
            "email"=> $email, 
            "password"=> $password, 
            "cuil"=> $cuil, 
            "direccion"=> $direccion, 
            "rolid"=> $rolid, 
            "fecha"=>$fecha, 
            "status"=>$status);
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

      $idempresa = $_POST['idempresa'];
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $telefono = $_POST['telefono'];
      $email = $_POST['email'];
      $cuil = $_POST['cuil'];
      $direccion = $_POST['direccion'];
      $rolid = $_POST['rolid'];
      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($idempresa);
      $idempresa=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($rolid);
      $rolid=$claveDesencriptada;

      $idempresa = eliminarComillas($idempresa);
      $nombre = eliminarComillas($nombre);
      $apellido = eliminarComillas($apellido);
      $telefono = eliminarComillas($telefono);
      $email = eliminarComillas($email);
      $cuil = eliminarComillas($cuil);
      $direccion = eliminarComillas($direccion);
      $rolid = eliminarComillas($rolid);
      $status = eliminarComillas($status);

      if(empty($nombre)  OR empty($apellido)  OR empty($telefono)  OR empty($email)  OR empty($cuil)  OR empty($direccion)  OR empty($rolid)  )   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM usuario WHERE id = $clave";  
       
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];   
        }
       
        if(!empty($id))
        {
            $sql = "UPDATE usuario SET idempresa= '$idempresa', nombre = '$nombre', apellido = '$apellido', telefono = '$telefono',
            email = '$email', cuil = '$cuil', direccion = '$direccion', rolid = '$rolid', 
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

      $sql = "DELETE FROM usuario WHERE id = $clave";
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