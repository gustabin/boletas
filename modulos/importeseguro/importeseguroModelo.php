<?php 
session_start();
require_once('../../tools/sed.php');
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];  
if($option=="incluir"){ 
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $idsindicato = $_POST['idsindicato'];
      $nombre = $_POST['nombre'];
      $vigenciadesde = $_POST['vigenciadesde'];  
      $vigenciahasta = $_POST['vigenciahasta'];
      $importe = $_POST['importe']; 
      $status = $_POST['status'];

      
      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      $vigenciadesde = date("Y-m-d", strtotime($vigenciadesde));
      $vigenciahasta = date("Y-m-d", strtotime($vigenciahasta));
      $importe = str_replace ( ',' , '.' , $importe);

      if ($importe>9999.99)  {
        $data = array("error" => '5');
        die(json_encode($data)); 
      }
      
      if(empty($nombre) OR empty($vigenciadesde) OR empty($vigenciahasta) OR empty($importe))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "INSERT INTO `importeseguro` (`id`, `idsindicato`, `nombre`, `vigenciadesde`, `vigenciahasta`, `importe`, `fecha`, `status`) VALUES (NULL, $idsindicato, '$nombre', '$vigenciadesde', '$vigenciahasta', '$importe', NOW(), $status)";

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

      $sql = "SELECT * FROM importeseguro WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $nombre = $data['nombre'];
          $vigenciadesde = $data['vigenciadesde'];
          $vigenciahasta = $data['vigenciahasta'];
          $importe = $data['importe'];
          $fecha = $data['fecha'];      
          $status = $data['status']; 
        }

        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($importe>9999.99)  {
          $data = array("error" => '5');
          die(json_encode($data));
        }

        if ($status!=0)  
        {
          $data = array("exito" => '1',"id"=>$id, "idsindicato"=>$idsindicato, "nombre"=>$nombre, "vigenciadesde"=>$vigenciadesde,
           "vigenciahasta"=>$vigenciahasta, "importe"=>$importe, 
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

    $sql = "SELECT * FROM importeseguro WHERE id = $clave";   

    $result = mysqli_query($conn, $sql);
    while($data=mysqli_fetch_array($result))
      {
        $id = $data['id'];
        $idsindicato = $data['idsindicato'];      
        $nombre = $data['nombre'];      
        $vigenciadesde = $data['vigenciadesde'];
        $vigenciahasta = $data['vigenciahasta'];
        $importe = $data['importe'];
        $fecha = $data['fecha'];      
        $status = $data['status'];         
        
        $claveEncriptada = SED::encryption($id);
        $id=$claveEncriptada;
        
        $claveSindicato = SED::encryption($idsindicato);
        $idsindicato = $claveSindicato;
      }
      $vigenciadesde = date("d-m-Y", strtotime($vigenciadesde));
      $vigenciahasta = date("d-m-Y", strtotime($vigenciahasta));
      $fecha = date("d-m-Y h:i:s A", strtotime($fecha));
      mysqli_close($conn);
      $data = array("exito" => '1',"id"=>$id, "idsindicato" => $idsindicato, "nombre" => $nombre, 
      "vigenciadesde"=>$vigenciadesde, "vigenciahasta"=>$vigenciahasta, "importe"=>$importe, 
      "fecha"=>$fecha, "status"=>$status);     
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
      $vigenciadesde = $_POST['vigenciadesde'];  
      $vigenciahasta = $_POST['vigenciahasta'];
      $importe = $_POST['importe']; 
      $status = $_POST['status'];
      
      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      $vigenciadesde = date("Y-m-d", strtotime($vigenciadesde));
      $vigenciahasta = date("Y-m-d", strtotime($vigenciahasta));
      $importe = str_replace ( ',' , '.' , $importe);

      if ($importe>9999.99)  {
        $data = array("error" => '4');
        die(json_encode($data));
      }
      
      if(empty($nombre) OR empty($vigenciadesde) OR empty($vigenciahasta) OR empty($importe))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM importeseguro WHERE id = $clave";  
        
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id']; 
        }
       
        if(!empty($id))
        { 
            $sql = "UPDATE importeseguro SET idsindicato = '$idsindicato', nombre = '$nombre', 
            vigenciadesde = '$vigenciadesde', vigenciahasta = '$vigenciahasta', importe = '$importe',         
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

      $sql = "DELETE FROM importeseguro WHERE id = $clave";
      if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } else {
        if(mysqli_errno($conn)==1451){
          $data = array("error" => '6', "errorDescription" => mysqli_error($conn));          
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