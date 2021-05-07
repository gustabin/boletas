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
      $texto1boleta = $_POST['texto1boleta'];  
      $texto2boleta = $_POST['texto2boleta'];
      $texto3boleta = $_POST['texto3boleta'];
      $texto4boleta = $_POST['texto4boleta'];
      $textoNomina = $_POST['textoNomina'];
      $logovertical = $_POST['logovertical'];
      $logohorizontal = $_POST['logohorizontal'];
      $status = $_POST['status'];

      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      $idsindicato = eliminarComillas($idsindicato);
      $texto1boleta = eliminarComillas($texto1boleta);
      $texto2boleta = eliminarComillas($texto2boleta);
      $texto3boleta = eliminarComillas($texto3boleta);
      $texto4boleta = eliminarComillas($texto4boleta);  
      $textoNomina = eliminarComillas($textoNomina);  

      
      if(empty($idsindicato) OR empty($texto1boleta) OR empty($logovertical) OR empty($logohorizontal))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "INSERT INTO `esquema` (`id`, `idsindicato`, `texto1boleta`, `texto2boleta`, `texto3boleta`, `texto4boleta`, `textoNomina`, `logovertical`, `logohorizontal`, `fecha`, `status`) VALUES (NULL, '$idsindicato', '$texto1boleta', '$texto2boleta', '$texto3boleta', '$texto4boleta', '$textoNomina','$logovertical', '$logohorizontal', NOW(), $status)";

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

      $sql = "SELECT * FROM esquema WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $texto1boleta = $data['texto1boleta'];
          $texto2boleta = $data['texto2boleta'];
          $texto3boleta = $data['texto3boleta'];
          $texto4boleta = $data['texto4boleta'];
          $textoNomina = $data['textoNomina'];
          $logovertical = $data['logovertical'];
          $logohorizontal = $data['logohorizontal'];
          $fecha = $data['fecha'];      
          $status = $data['status']; 
        }

        $claveDesencriptada = SED::decryption($idsindicato);
        $idsindicato=$claveDesencriptada;

        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  //esquema eliminada
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($status!=0)  //esquema activo o inactivo
        {
          $data = array("exito" => '1',"id"=>$id, "idsindicato"=> $idsindicato, "texto1boleta"=>$texto1boleta,
           "texto2boleta"=>$texto2boleta, "texto3boleta"=>$texto3boleta, "texto4boleta"=>$texto4boleta,
           "textoNomina"=>$textoNomina,
           "logovertical"=>$logovertical, "logohorizontal"=>$logohorizontal, 
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

      $sql = "SELECT * FROM esquema WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $texto1boleta = $data['texto1boleta'];
          $texto2boleta = $data['texto2boleta'];
          $texto3boleta = $data['texto3boleta'];
          $texto4boleta = $data['texto4boleta'];
          $textoNomina = $data['textoNomina'];
          $logovertical = $data['logovertical'];
          $logohorizontal = $data['logohorizontal'];
          $fecha = $data['fecha'];      
          $status = $data['status'];           
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;
        }
        
        $fecha = date("Y-m-d h:i:s A", strtotime($fecha));

        $claveEncriptada = SED::encryption($idsindicato);
        $idsindicato=$claveEncriptada;

        mysqli_close($conn);
        $data = array("exito" => '1',"id"=>$id, "idsindicato"=> $idsindicato, "texto1boleta"=>$texto1boleta,
           "texto2boleta"=>$texto2boleta, "texto3boleta"=>$texto3boleta, "texto4boleta"=>$texto4boleta,
           "textoNomina"=>$textoNomina,
           "logovertical"=>$logovertical, "logohorizontal"=>$logohorizontal,  
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
      $texto1boleta = $_POST['texto1boleta'];  
      $texto2boleta = $_POST['texto2boleta'];
      $texto3boleta = $_POST['texto3boleta'];
      $texto4boleta = $_POST['texto4boleta'];
      $textoNomina = $_POST['textoNomina'];
      $logovertical = $_POST['logovertical'];
      $logohorizontal = $_POST['logohorizontal'];
      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($idsindicato);
      $idsindicato=$claveDesencriptada;

      $idsindicato = eliminarComillas($idsindicato);
      $texto1boleta = eliminarComillas($texto1boleta);
      $texto2boleta = eliminarComillas($texto2boleta);
      $texto3boleta = eliminarComillas($texto3boleta);
      $texto4boleta = eliminarComillas($texto4boleta);  
      $textoNomina = eliminarComillas($textoNomina);  
      
      if(empty($idsindicato) OR empty($texto1boleta) OR empty($logovertical) OR empty($logohorizontal))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM esquema WHERE id = $clave";  
        
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id']; 
        }
       
        if(!empty($id))
        { 
            $sql = "UPDATE esquema SET idsindicato = '$idsindicato', texto1boleta = '$texto1boleta', 
            texto2boleta = '$texto2boleta', texto3boleta = '$texto3boleta', texto4boleta = '$texto4boleta', 
            textoNomina = '$textoNomina', 
            logovertical = '$logovertical', logohorizontal = '$logohorizontal', 
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

      $sql = "DELETE FROM esquema WHERE id = $clave";
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