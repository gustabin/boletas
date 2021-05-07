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
      $cuit = $_POST['cuit'];
      $seccional = $_POST['seccional'];
      $numero = $_POST['numero'];
      $direccion = $_POST['direccion'];
      $localidad = $_POST['localidad']; 
      $codpostal = $_POST['codpostal']; 
      $idprovincia = $_POST['idprovincia'];  
      $ramo = $_POST['ramo'];
      $email = $_POST['email'];  
      $contacto = $_POST['contacto'];  
      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($idsindicato);
      $idsindicato=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($seccional);
      $seccional=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idprovincia);
      $idprovincia=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($ramo);
      $ramo=$claveDesencriptada;

      $cuit = str_replace("-", "", $cuit);

      $nombre = eliminarComillas($nombre);
      $idsindicato = eliminarComillas($idsindicato);
      $cuit = eliminarComillas($cuit);
      $seccional = eliminarComillas($seccional);
      $numero = eliminarComillas($numero);
      $direccion = eliminarComillas($direccion);
      $localidad = eliminarComillas($localidad);
      $codpostal = eliminarComillas($codpostal);
      $idprovincia = eliminarComillas($idprovincia);
      $ramo = eliminarComillas($ramo);
      $contacto = eliminarComillas($contacto);
      
      if(empty($nombre) OR empty($idsindicato) OR empty($cuit)  OR empty($numero) OR empty($direccion) OR empty($localidad) 
       OR empty($idprovincia) OR empty($ramo) OR empty($email) OR empty($contacto))   
      {
        $data = array("error" => '2');
        die(json_encode($data));
      }
      
      $sql ="INSERT INTO `empresas` (`id`, `idsindicato`, `nombre`, `cuit`, `seccional`, `numero`, `direccion`, `localidad`, `codpostal`, `idprovincia`, `ramo`, `email`, `contacto`, `fechaalta`, `fecha`, `status`) VALUES (NULL, '$idsindicato', '$nombre', '$cuit', '$seccional', $numero, '$direccion', '$localidad', '$codpostal', $idprovincia, $ramo, '$email', '$contacto', NOW(), NOW(), $status);";

      if (mysqli_query($conn, $sql)) 
      {
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } 
      else 
      {
        if(mysqli_errno($conn)==1064)
        {
            mysqli_close($conn);
            $data = array("error" => '5');
            die(json_encode($data));  
        }         
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

      $sql = "SELECT * FROM empresas WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
      {
          $id = $data['id'];
          $nombre = $data['nombre'];
          $idsindicato = $data['idsindicato'];
          $cuit = $data['cuit'];
          $seccional = $data['seccional'];
          $numero = $data['numero'];
          $direccion = $data['direccion'];
          $localidad = $data['localidad'];
          $codpostal = $data['codpostal'];
          $idprovincia = $data['idprovincia'];      
          $ramo = $data['ramo'];
          $email = $data['email'];
          $contacto = $data['contacto'];
          $fechabaja = $data['fechabaja'];
          $fechaalta = $data['fechaalta'];
          $fechamodificacion = $data['fechamodificacion']; 
          $idempresaantecedente = isset($data['idempresaantecedente'])?$data['idempresaantecedente']:''; 
          $idempresaprecedente = isset($data['idempresaprecedente'])?$data['idempresaprecedente']:''; 
          $status = $data['status']; 
        }

        $cuit =substr($cuit,0,2) ."-". substr($cuit,2,10) ."-". substr($cuit,10);

        $claveDesencriptada = SED::decryption($idsindicato);
        $idsindicato=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($seccional);
        $seccional=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idprovincia);
        $idprovincia=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($ramo);
        $ramo=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idempresaantecedente);
        $idempresaantecedente=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idempresaprecedente);
        $idempresaprecedente=$claveDesencriptada;


        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  //empresa eliminado
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($status!=0)  //empresa activo o inactivo
        {
          $data = array("exito" => '1',
                      "id"=>$id, 
                      "nombre"=> $nombre, 
                      "idsindicato"=> $idsindicato, 
                      "cuit"=> $cuit, 
                      "seccional"=>$seccional, 
                      "numero"=>$numero, 
                      "direccion"=>$direccion, 
                      "localidad"=>$localidad, 
                      "codpostal"=>$codpostal, 
                      "idprovincia"=>$idprovincia, 
                      "ramo"=>$ramo, 
                      "email"=>$email, 
                      "contacto"=>$contacto, 
                      "fechabaja"=>$fechabaja, 
                      "fechaalta"=>$fechaalta, 
                      "fechamodificacion"=>$fechamodificacion, 
                      "idempresaantecedente"=>$idempresaantecedente, 
                      "idempresaprecedente"=>$idempresaprecedente, 
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

      $sql = "SELECT * FROM empresas WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];      
          $nombre = $data['nombre'];
          $idsindicato = $data['idsindicato'];
          $cuit = $data['cuit'];
          $seccional = $data['seccional'];
          $numero = $data['numero'];
          $direccion = $data['direccion'];
          $localidad = $data['localidad'];
          $codpostal = $data['codpostal'];
          $idprovincia = $data['idprovincia'];      
          $ramo = $data['ramo'];
          $email = $data['email'];
          $contacto = $data['contacto'];
          $fechabaja = $data['fechabaja'];
          $fechaalta = $data['fechaalta'];
          $fechamodificacion = $data['fechamodificacion']; 
          $idempresaantecedente = isset($data['idempresaantecedente'])?$data['idempresaantecedente']:''; 
          $idempresaprecedente = isset($data['idempresaprecedente'])?$data['idempresaprecedente']:''; 
          $status = $data['status'];       
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;

          $_SESSION['nombreempresa']= $nombre;
        }
        mysqli_close($conn);
        $mascaracuit =substr($cuit,0,2) ."-". substr($cuit,2,8) ."-". substr($cuit,10);
        $cuit = $mascaracuit;

        $fechabaja = date("d-m-Y", strtotime($fechabaja));    

        $fechaalta = date("d-m-Y", strtotime($fechaalta));
        $fechamodificacion = date("d-m-Y", strtotime($fechamodificacion));

        $claveEncriptada = SED::encryption($idsindicato);
        $idsindicato=$claveEncriptada;
        
        $claveEncriptada = SED::encryption($seccional);
        $seccional=$claveEncriptada;

        $claveEncriptada = SED::encryption($idprovincia);
        $idprovincia=$claveEncriptada;

        $claveEncriptada = SED::encryption($ramo);
        $ramo=$claveEncriptada;

        $claveEncriptada = SED::encryption($idempresaantecedente);
        $idempresaantecedente=$claveEncriptada;

        $claveEncriptada = SED::encryption($idempresaprecedente);
        $idempresaprecedente=$claveEncriptada;

        $data = array("exito" => '1',
                      "id"=>$id, 
                      "nombre"=> $nombre, 
                      "idsindicato"=> $idsindicato, 
                      "cuit"=> $cuit, 
                      "seccional"=>$seccional, 
                      "numero"=>$numero, 
                      "direccion"=>$direccion, 
                      "localidad"=>$localidad, 
                      "codpostal"=>$codpostal, 
                      "idprovincia"=>$idprovincia, 
                      "ramo"=>$ramo, 
                      "email"=>$email, 
                      "contacto"=>$contacto, 
                      "fechabaja"=>$fechabaja, 
                      "fechaalta"=>$fechaalta, 
                      "fechamodificacion"=>$fechamodificacion, 
                      "idempresaantecedente"=>$idempresaantecedente, 
                      "idempresaprecedente"=>$idempresaprecedente, 
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

      $nombre = $_POST['nombre'];
      $idsindicato = $_POST['idsindicato'];
      $cuit = $_POST['cuit'];
      $seccional = $_POST['seccional'];
      $numero = $_POST['numero'];
      $direccion = $_POST['direccion'];
      $localidad = $_POST['localidad']; 
      $codpostal = $_POST['codpostal']; 
      $idprovincia = $_POST['idprovincia'];  
      $ramo = $_POST['ramo'];
      $email = $_POST['email'];  
      $contacto = $_POST['contacto']; 
      $fechabaja = $_POST['fechabaja'];
      $idempresaantecedente = isset($_POST['idempresaantecedente'])?$_POST['idempresaantecedente']:'';
      $idempresaprecedente = isset($_POST['idempresaprecedente'])?$_POST['idempresaprecedente']:'';
      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($idsindicato);
      $idsindicato=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($seccional);
      $seccional=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idprovincia);
      $idprovincia=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($ramo);
      $ramo=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idempresaantecedente);
      $idempresaantecedente=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idempresaprecedente);
      $idempresaprecedente=$claveDesencriptada;

      $cuit = str_replace("-", "", $cuit);
      $nombre = eliminarComillas($nombre);
      $idsindicato = eliminarComillas($idsindicato);
      $cuit = eliminarComillas($cuit);
      $seccional = eliminarComillas($seccional);
      $numero = eliminarComillas($numero);
      $direccion = eliminarComillas($direccion);
      $localidad = eliminarComillas($localidad);
      $codpostal = eliminarComillas($codpostal);
      $idprovincia = eliminarComillas($idprovincia);
      $ramo = eliminarComillas($ramo);
      $contacto = eliminarComillas($contacto);
      
      
      if(empty($nombre) OR empty($idsindicato) OR empty($cuit) OR empty($numero) OR empty($direccion) OR empty($localidad) 
       OR empty($idprovincia) OR empty($ramo) OR empty($email) OR empty($contacto))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM empresas WHERE id = $clave";  

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];      
        }
       
        if(!empty($id))
        {
            $sql = "UPDATE empresas SET nombre = '$nombre', idsindicato = '$idsindicato', cuit = '$cuit', 
            seccional = '$seccional', numero = '$numero', direccion = '$direccion', localidad = '$localidad', 
            codpostal = '$codpostal', idprovincia = '$idprovincia', ramo = '$ramo', email = '$email', 
            contacto = '$contacto', fechabaja = '$fechabaja', fechamodificacion = NOW(), 
            idempresaantecedente = '$idempresaantecedente', idempresaprecedente = '$idempresaprecedente', 
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

      $sql = "DELETE FROM empresas WHERE id = $clave";
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