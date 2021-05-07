<?php 
session_start(); 
require_once('../../tools/sed.php');
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];  

if($option=="incluir"){ 
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $cuit = $_POST['cuit'];
      $razonsocial = $_POST['razonsocial'];  
      $direccion = $_POST['direccion'];  
      $status = $_POST['status'];

      $cuit = eliminarComillas($cuit);
      $razonsocial = eliminarComillas($razonsocial);
      $direccion = eliminarComillas($direccion);
     
      
      if(empty($cuit) OR empty($direccion) OR empty($razonsocial))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      //incluir los datos en la tabla empresas
      $sql = "INSERT INTO `sindicatos` (`id`, `cuit`, `razonsocial`, `direccion`, `fecha`, `status`) VALUES (NULL, '$cuit', '$razonsocial', '$direccion', NOW(), $status)";
      if (mysqli_query($conn, $sql)) {
        
        mysqli_close($conn);
        $data = array("exito" => '1', "sql" => $sql);
        die(json_encode($data));
      } else {
        
        $data = array("error" => '1', "sql" => $sql);
        die(json_encode($data));
      }
  }else{
    $data = array("error" => '4', "sql" => $sql);
    die(json_encode($data));
  }
}

if($option=="consultar"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "SELECT * FROM sindicatos WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $cuit = $data['cuit'];
          $razonsocial = $data['razonsocial'];   
          $direccion = $data['direccion'];   
          $fecha = $data['fecha'];      
          $status = $data['status'];    
        }   

        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  //sindicato eliminado
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($status!=0)  //sindicato activo o inactivo
        {
          $data = array("exito" => '1',"id"=>$id, "cuit"=> $cuit, "razonsocial"=>$razonsocial,
           "direccion"=>$direccion, "fecha"=>$fecha, "status"=>$status);
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

      $sql = "SELECT * FROM sindicatos WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $cuit = $data['cuit'];
          $razonsocial = $data['razonsocial'];      
          
          $direccion = $data['direccion'];      
          $fecha = $data['fecha'];      
          $status = $data['status'];  
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;      
        }   

       mysqli_close($conn);
       $data =  array("exito" => '1',
                      "id"=>$id, 
                      "cuit"=> $cuit, 
                      "razonsocial"=>$razonsocial,
                      "direccion"=>$direccion, 
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

      $cuit = $_POST['cuit'];
      $razonsocial = $_POST['razonsocial'];  
      $direccion = $_POST['direccion'];  
      $status = $_POST['status'];  

      $cuit = eliminarComillas($cuit);
      $razonsocial = eliminarComillas($razonsocial);
      $direccion =  eliminarComillas($direccion);

      
      if(empty($cuit) OR empty($direccion) OR empty($razonsocial))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM sindicatos WHERE id = $clave";  
        
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id']; 
        }
       
        if(!empty($id))
        { 
            $sql = "UPDATE sindicatos SET cuit = '$cuit', razonsocial = '$razonsocial', 
            direccion = '$direccion', status = $status WHERE id = $clave";        
           
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

      $sql = "DELETE FROM `sindicatos` WHERE id = $clave";

      if (mysqli_query($conn, $sql)) {        
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } else {        
        if(mysqli_errno($conn)==1451){
          $data = array("error" => '3', "errorDescription" => mysqli_error($conn));
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