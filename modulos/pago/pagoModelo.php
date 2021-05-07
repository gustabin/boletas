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
      $idempresa = $_POST['idempresa'];  
      $idbanco = $_POST['idbanco'];
      $idboleta = $_POST['idboleta'];
      $fechapago = $_POST['fechapago'];
      $importe = $_POST['importe'];

      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      $idempresaDesencriptada = SED::decryption($idempresa);
      $idempresa = $idempresaDesencriptada;

      $idbancoDesencriptada = SED::decryption($idbanco);
      $idbanco = $idbancoDesencriptada;

      $idsindicato = eliminarComillas($idsindicato);
      $idempresa = eliminarComillas($idempresa);
      $idbanco = eliminarComillas($idbanco);
      $idboleta = eliminarComillas($idboleta);

      $fechapago = date("Y-m-d", strtotime($fechapago));

      if ($importe>9999.99)  {
        $data = array("error" => '5');
        die(json_encode($data));
      }
      
      if(empty($idsindicato) OR empty($idempresa) OR empty($idbanco) OR empty($idboleta) OR empty($fechapago) OR empty($importe))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "INSERT INTO `pagos` (`id`, `idsindicato`, `idempresa`, `idbanco`, `idboleta`, `fechapago`, `importe`, `fecha`, `status`) VALUES (NULL, '$idsindicato', '$idempresa', 
      '$idbanco', '$idboleta', '$fechapago', '$importe', NOW(), 1)";

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

      $sql = "SELECT * FROM pagos WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $idempresa = $data['idempresa'];
          $idbanco = $data['idbanco'];
          $idboleta = $data['idboleta'];
          $fechapago = $data['fechapago'];
          $importe = $data['importe'];      
          $fecha = $data['fecha'];      
          $status = $data['status']; 
        }

        $claveDesencriptada = SED::decryption($idsindicato);
        $idsindicato=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idempresa);
        $idempresa=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idbanco);
        $idbanco=$claveDesencriptada;

        $fechapago = date("Y-m-d", strtotime($fechapago));
       
        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==2)  //pago eliminado
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($importe>9999.99)  {
          $data = array("error" => '5');
          die(json_encode($data));
        }

        if ($status!=2)  //pago activo o inactivo
        {
          $data = array("exito" => '1',"id"=>$id, "idsindicato"=> $idsindicato, "idempresa"=>$idempresa,
           "idbanco"=>$idbanco, "idboleta"=>$idboleta, "fechapago"=>$fechapago, "importe"=>$importe,      
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

      $sql = "SELECT * FROM pagos WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
         $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $idempresa = $data['idempresa'];
          $idbanco = $data['idbanco'];
          $idboleta = $data['idboleta'];
          $fechapago = $data['fechapago'];
          $importe = $data['importe'];      
          $fecha = $data['fecha'];      
          $status = $data['status']; 
          
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;
        }
        $fechapago = date("d-m-Y", strtotime($fechapago));
        $fecha = date("d-m-Y h:i:s A", strtotime($fecha));

        $claveEncriptada = SED::encryption($idsindicato);
        $idsindicato=$claveEncriptada;

        $claveEncriptada = SED::encryption($idempresa);
        $idempresa=$claveEncriptada;

        $claveEncriptada = SED::encryption($idbanco);
        $idbanco=$claveEncriptada;

        mysqli_close($conn);
        $data = array("exito" => '1',"id"=>$id, "idsindicato"=> $idsindicato, "idempresa"=>$idempresa,
          "idbanco"=>$idbanco, "idboleta"=>$idboleta, "fechapago"=>$fechapago, "importe"=>$importe,
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

      $idbanco = $_POST['idbanco'];
      $idboleta = $_POST['idboleta'];
      $fechapago = $_POST['fechapago'];
      $importe = $_POST['importe'];

      $claveDesencriptada = SED::decryption($idbanco);
      $idbanco=$claveDesencriptada;
      
      $idbanco = eliminarComillas($idbanco);
      $idboleta = eliminarComillas($idboleta);
      $importe = eliminarComillas($importe);  

      $fechapago = date("Y-m-d", strtotime($fechapago));

      if ($importe>9999.99)  {
        $data = array("error" => '5');
        die(json_encode($data));
      }
      
      if(empty($idbanco) OR empty($idboleta) OR empty($fechapago) OR empty($importe))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM pagos WHERE id = $clave";  
        
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id']; 
        }
       
        if(!empty($id))
        {       
            $sql = "UPDATE pagos SET   
            idbanco = '$idbanco', idboleta = '$idboleta', fechapago = '$fechapago', 
            importe = '$importe'
            WHERE id = $clave";         

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

      $sql = "DELETE FROM pagos WHERE id = $clave";
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