<?php 
session_start();
require_once('../../tools/sed.php');
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

// var_dump($_REQUEST);
// die();
$option = $_GET['option'];  
 
if($option=="incluir"){ 
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $nombre = strtoupper($_POST['nombre']);
      $idsindicato = $_POST['idsindicato'];
      $descripcion = $_POST['descripcion'];  
      $formula = isset($_POST['formula'])?$_POST['formula']:'';
      $porcentaje = isset($_POST['porcentaje'])?$_POST['porcentaje']:'';

      $confirma = $_POST['confirma'];
      $importecantidad = $_POST['importecantidad'];
      $seimprime = $_POST['seimprime'];
      $conceptoasociado = strtoupper($_POST['conceptoasociado']);
      $debitocredito = $_POST['debitocredito'];  
      $idtipoboleta = $_POST['idtipoboleta']; 
      $status = $_POST['status']; 

      $nombre = eliminarComillas($nombre);
      $confirma = eliminarComillas($confirma);
      $importecantidad = eliminarComillas($importecantidad);
      $seimprime = eliminarComillas($seimprime);
      $conceptoasociado = eliminarComillas($conceptoasociado);
      $debitocredito = eliminarComillas($debitocredito);
      $porcentaje = eliminarComillas($porcentaje);

      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      // $idtipoboletaDesencriptada = SED::decryption($idtipoboleta);
      // $idtipoboleta = $idtipoboletaDesencriptada;
      
      if(empty($nombre) OR empty($descripcion))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "INSERT INTO `conceptos` (`id`, `idsindicato`, `nombre`, `descripcion`, `formula`, `porcentaje`,  `confirma`, `importecantidad`, `seimprime`, `conceptoasociado`, `debitocredito`, `idtipoboleta`, `fecha`, `status`) VALUES (NULL, $idsindicato, '$nombre', '$descripcion', '$formula', '$porcentaje', '$confirma', '$importecantidad', '$seimprime', '$conceptoasociado', '$debitocredito', $idtipoboleta, NOW(), $status)";
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

      $sql = "SELECT * FROM conceptos WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $nombre = $data['nombre'];
          $descripcion = $data['descripcion'];
          $formula = $data['formula'];
          $porcentaje = $data['porcentaje'];
          $confirma = $data['confirma'];
          $importecantidad = $data['importecantidad'];
          $seimprime = $data['seimprime'];
          $conceptoasociado = $data['conceptoasociado'];
          $debitocredito = $data['debitocredito'];  
          $idtipoboleta = $data['idtipoboleta'];      
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

        if ($status!=0)  
        {
          $data = array("exito" => '1',
              "id"=>$id, 
              "idsindicato"=>$idsindicato, 
              "nombre"=> $nombre, 
              "descripcion"=>$descripcion,
              "formula"=>$formula, 
              "porcentaje"=>$porcentaje, 
              "confirma"=>$confirma, 
              "importecantidad"=>$importecantidad,
              "seimprime"=>$seimprime, 
              "conceptoasociado"=>$conceptoasociado, 
              "debitocredito"=>$debitocredito, 
              "idtipoboleta"=>$idtipoboleta,
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

      $sql = "SELECT * FROM conceptos WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {      
          $id = $data['id'];      
          $idsindicato = $data['idsindicato'];      
          $nombre = $data['nombre'];
          $descripcion = $data['descripcion'];
          $formula = $data['formula'];
          $porcentaje = $data['porcentaje'];
          $confirma = $data['confirma'];
          $importecantidad = $data['importecantidad'];
          $seimprime = $data['seimprime'];
          $conceptoasociado = $data['conceptoasociado'];
          $debitocredito = $data['debitocredito'];                
          $idtipoboleta = $data['idtipoboleta'];      
          $fecha = $data['fecha'];      
          $status = $data['status'];
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;
          
          $claveSindicato = SED::encryption($idsindicato);
          $idsindicato = $claveSindicato;

          // $idtipoboletaDesencriptada = SED::decryption($idtipoboleta);
          // $idtipoboleta = $idtipoboletaDesencriptada;
        }

       mysqli_close($conn);
       
       $data = array("exito" => '1', "id" => $id, "idsindicato" => $idsindicato, "nombre"=> $nombre, "descripcion"=>$descripcion,
         "formula"=>$formula, "porcentaje"=>$porcentaje, "confirma"=>$confirma, "importecantidad"=>$importecantidad,
         "seimprime"=>$seimprime, "conceptoasociado"=>$conceptoasociado, "debitocredito"=>$debitocredito, "idtipoboleta"=>$idtipoboleta,
         "fecha" => $fecha, "status" => $status);

       die(json_encode($data));
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if($option=="modificar"){  
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= ""; //ternaria
  if($_SESSION['token'] == $token){
      $clave = $_POST['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;  

      $idsindicato = $_POST['idsindicato'];
      $nombre = strtoupper($_POST['nombre']);
      $descripcion = $_POST['descripcion'];  
      $formula = isset($_POST['formula'])?$_POST['formula']:'';
      $porcentaje = isset($_POST['porcentaje'])?$_POST['porcentaje']:'';
     
      $confirma = $_POST['confirma'];
      $importecantidad = $_POST['importecantidad'];
      $seimprime = $_POST['seimprime'];
      $conceptoasociado = strtoupper($_POST['conceptoasociado']);
      $debitocredito = $_POST['debitocredito'];  
      
      $idtipoboleta = $_POST['idtipoboleta'];      
      $status = $_POST['status'];

      $nombre = eliminarComillas($nombre);
      $porcentaje = eliminarComillas($porcentaje);
      
      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      // $idtipoboletaDesencriptada = SED::decryption($idtipoboleta);
      // $idtipoboleta = $idtipoboletaDesencriptada;

      if(empty($nombre) OR empty($descripcion))  
      {$data = array("error" => '3');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM conceptos WHERE id = $clave";  
       
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];      
        }
       
        if(!empty($id))
        {
            $sql = "UPDATE conceptos SET idsindicato = '$idsindicato', nombre = '$nombre', descripcion = '$descripcion', 
            formula = '$formula', porcentaje = '$porcentaje', confirma = '$confirma', importecantidad = '$importecantidad', 
            seimprime = '$seimprime', conceptoasociado = '$conceptoasociado', debitocredito = '$debitocredito', idtipoboleta = '$idtipoboleta',
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

      $sql = "DELETE FROM conceptos WHERE id = $clave";
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