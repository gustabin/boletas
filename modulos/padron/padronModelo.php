<?php 
session_start();
require_once('../../tools/sed.php');
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];  

if($option=="incluir"){ 
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $documento = $_POST['documento'];
      $cuil = $_POST['cuil'];
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];  
      $sexo = $_POST['sexo'];
      $telefono = $_POST['telefono'];
      $direccion = $_POST['direccion'];
      $localidad = $_POST['localidad']; 
      $provincia = $_POST['provincia'];
      $nacimiento = $_POST['nacimiento'];
      $idsindicato = $_POST['idsindicato'];
      $idseccional = $_POST['idseccional'];      
      $idestadocivil = $_POST['idestadocivil'];
      $idnacionalidad = $_POST['idnacionalidad'];
      $idsituacionrevista = $_POST['idsituacionrevista'];
      $idcategoriaempleado = $_POST['idcategoriaempleado'];
      $idempresa = $_POST['idempresa'];
      $idusuarioalta = $_SESSION['idusuario'] ;
      $idtipodocumento = $_POST['idtipodocumento'] ;
      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($provincia);
      $provincia=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idestadocivil);
      $idestadocivil=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idnacionalidad);
      $idnacionalidad=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idsindicato);
      $idsindicato=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idseccional);
      $idseccional=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idsituacionrevista);
      $idsituacionrevista=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idcategoriaempleado);
      $idcategoriaempleado=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idempresa);
      $idempresa=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idtipodocumento);
      $idtipodocumento=$claveDesencriptada;

      $documento = eliminarComillas($documento);
      $cuil = eliminarComillas($cuil);
      $nombre = eliminarComillas($nombre);
      $apellido = eliminarComillas($apellido);
      $sexo = eliminarComillas($sexo);
      $telefono = eliminarComillas($telefono);
      $direccion = eliminarComillas($direccion);
      $localidad = eliminarComillas($localidad);
      $provincia = eliminarComillas($provincia);
      $idsindicato = eliminarComillas($idsindicato);
      $idseccional = eliminarComillas($idseccional);
      $idestadocivil = eliminarComillas($idestadocivil);
      $idnacionalidad = eliminarComillas($idnacionalidad);
      $idsituacionrevista = eliminarComillas($idsituacionrevista);
      $idcategoriaempleado = eliminarComillas($idcategoriaempleado);
      $idempresa = eliminarComillas($idempresa);
      $idtipodocumento = eliminarComillas($idtipodocumento);

      $nacimiento = date("Y-m-d", strtotime($nacimiento));
      $idusuarioalta = eliminarComillas($idusuarioalta);
      
      if(empty($documento) OR empty($cuil) OR empty($nombre) OR empty($apellido) OR empty($sexo) OR empty($telefono) 
       OR empty($direccion) OR empty($localidad) OR empty($provincia) OR empty($nacimiento) OR empty($idestadocivil)
       OR empty($idsindicato) OR empty($idseccional) OR empty($idnacionalidad) OR empty($idsituacionrevista) 
       OR empty($idcategoriaempleado) OR empty($idempresa) OR empty($idtipodocumento))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }
      
       $sql = "INSERT INTO `padron` (`id`, `documento`, `cuil`, `nombre`, `apellido`, `sexo`, `telefono`, `direccion`, 
       `localidad`, `provincia`, `nacimiento`, `idsindicato`, `idseccional`, `idestadocivil`, `idnacionalidad`, 
       `idsituacionrevista`, `idcategoriaempleado`, `idempresa`, `idtipodocumento`, `alta`, `idusuarioalta`, `fecha`, `status`) 
      VALUES (NULL, '$documento', '$cuil', '$nombre', '$apellido', $sexo, '$telefono', '$direccion', 
      '$localidad', '$provincia', '$nacimiento', '$idsindicato', '$idseccional', '$idestadocivil', '$idnacionalidad',
      '$idsituacionrevista', '$idcategoriaempleado', '$idempresa', '$idtipodocumento', NOW(), '$idusuarioalta', NOW(), $status)";

       if (mysqli_query($conn, $sql)) {          
            mysqli_close($conn);
            $data = array("exito" => '1');
            die(json_encode($data));        
       }
       if (mysqli_errno($conn)) {                        
            // printf(mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n");
            switch (mysqli_errno($conn)) {
              case '1062':
                $data = array("error" => '1');
                die(json_encode($data));
                break;
            }
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

      $sql = "SELECT * FROM padron WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
      {
          $id = $data['id'];
          $documento = $data['documento'];
          $cuil = $data['cuil'];
          $nombre = $data['nombre'];
          $apellido = $data['apellido'];
          $sexo = $data['sexo'];
          $telefono = $data['telefono'];
          $direccion = $data['direccion'];
          $localidad = $data['localidad'];
          $provincia = $data['provincia'];
          $nacimiento = $data['nacimiento'];
          $idsindicato = $data['idsindicato'];
          $idseccional = $data['idseccional'];
          $idestadocivil = $data['idestadocivil'];
          $idnacionalidad = $data['idnacionalidad'];
          $idsituacionrevista = $data['idsituacionrevista'];          
          $idcategoriaempleado = $data['idcategoriaempleado'];     
          $idempresa = $data['idempresa'];     
          $idtipodocumento = $data['idtipodocumento'];     
          $baja = $data['baja'];
          $alta = $data['alta'];
          $modificacion = $data['modificacion'];      
          $idusuarioalta = $data['idusuarioalta'];      
          $status = $data['status']; 
        }

        $claveDesencriptada = SED::decryption($provincia);
        $provincia=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idusuarioalta);
        $idusuarioalta=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idestadocivil);
        $idestadocivil=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idnacionalidad);
        $idnacionalidad=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idsindicato);
        $idsindicato=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idseccional);
        $idseccional=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idsituacionrevista);
        $idsituacionrevista=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idcategoriaempleado);
        $idcategoriaempleado=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idempresa);
        $idempresa=$claveDesencriptada;
          
        $claveDesencriptada = SED::decryption($idtipodocumento);
        $idtipodocumento=$claveDesencriptada;

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
          $data = array("exito" => '1',"id"=>$id, "documento"=> $documento, "cuil"=> $cuil, "nombre"=>$nombre,
           "apellido"=>$apellido, "sexo"=>$sexo, "telefono"=>$telefono, "direccion"=>$direccion, "localidad"=>$localidad, 
           "provincia"=>$provincia, "nacimiento"=>$nacimiento, "idsindicato"=>$idsindicato, 
           "idseccional"=>$idseccional, "idestadocivil"=>$idestadocivil, "idnacionalidad"=>$idnacionalidad, 
           "idsituacionrevista"=>$idsituacionrevista, "idcategoriaempleado"=>$idcategoriaempleado, 
           "idempresa"=>$idempresa, "idtipodocumento"=>$idtipodocumento, "baja"=>$baja, 
           "alta"=>$alta, "modificacion"=>$modificacion, 
           "idusuarioalta"=>$idusuarioalta, "status"=>$status);
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

      $sql = "SELECT * FROM padron WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];      
          $documento = $data['documento'];
          $cuil = $data['cuil'];
          $nombre = $data['nombre'];
          $apellido = $data['apellido'];
          $sexo = $data['sexo'];
          $telefono = $data['telefono'];
          $direccion = $data['direccion'];
          $localidad = $data['localidad'];
          $provincia = $data['provincia'];
          $nacimiento = $data['nacimiento'];
          $idsindicato = $data['idsindicato'];
          $idseccional = $data['idseccional'];
          $idestadocivil = $data['idestadocivil'];
          $idnacionalidad = $data['idnacionalidad'];
          $idsituacionrevista = $data['idsituacionrevista'];    
          $idcategoriaempleado = $data['idcategoriaempleado'];  
          $idempresa = $data['idempresa'];  
          $idtipodocumento = $data['idtipodocumento']; 
          $baja = $data['baja'];
          $alta = $data['alta'];
          $modificacion = $data['modificacion'];
          $idusuarioalta = $data['idusuarioalta'];
          $status = $data['status'];  
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;
        }
       mysqli_close($conn);

        $claveEncriptada = SED::encryption($provincia);
        $provincia=$claveEncriptada;

        $claveEncriptada = SED::encryption($idusuarioalta);
        $idusuarioalta=$claveEncriptada;
        
        $claveEncriptada = SED::encryption($idestadocivil);
        $idestadocivil=$claveEncriptada;

        $claveEncriptada = SED::encryption($idnacionalidad);
        $idnacionalidad=$claveEncriptada;

        $claveEncriptada = SED::encryption($idsindicato);
        $idsindicato=$claveEncriptada;

        $claveEncriptada = SED::encryption($idseccional);
        $idseccional=$claveEncriptada;
        
        $claveEncriptada = SED::encryption($idsituacionrevista);
        $idsituacionrevista=$claveEncriptada;

        $claveEncriptada = SED::encryption($idcategoriaempleado);
        $idcategoriaempleado=$claveEncriptada;        

        $claveEncriptada = SED::encryption($idempresa);
        $idempresa=$claveEncriptada;    

        $claveEncriptada = SED::encryption($idtipodocumento);
        $idtipodocumento=$claveEncriptada;    

        $nacimiento = date("d-m-Y", strtotime($nacimiento));
        $baja = date("d-m-Y", strtotime($baja));
        $alta = date("d-m-Y", strtotime($alta));
        $modificacion = date("d-m-Y", strtotime($modificacion));

        $data = array("exito" => '1',"id"=>$id, "documento"=> $documento, "cuil"=> $cuil, "nombre"=>$nombre,
        "apellido"=>$apellido, "sexo"=>$sexo, "telefono"=>$telefono, "direccion"=>$direccion, "localidad"=>$localidad, 
        "provincia"=>$provincia, "nacimiento"=>$nacimiento, "idsindicato"=>$idsindicato, 
        "idseccional"=>$idseccional, "idestadocivil"=>$idestadocivil, "idnacionalidad"=>$idnacionalidad, 
        "idsituacionrevista"=>$idsituacionrevista, "idcategoriaempleado"=>$idcategoriaempleado, 
        "idempresa"=>$idempresa, "idtipodocumento"=>$idtipodocumento, "baja"=>$baja, "alta"=>$alta, "modificacion"=>$modificacion, 
        "idusuarioalta"=>$idusuarioalta, "status"=>$status);
        die(json_encode($data));
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if($option=="modificar")
{  
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if(isset($_SESSION['token']) == isset($token)) {
      $clave = $_POST['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;  

      $documento = $_POST['documento'];
      $cuil = $_POST['cuil'];
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];  
      $sexo = $_POST['sexo'];
      $telefono = $_POST['telefono'];
      $direccion = $_POST['direccion'];
      $localidad = $_POST['localidad']; 
      $provincia = $_POST['provincia'];
      $nacimiento = $_POST['nacimiento'];
      $idsindicato = $_POST['idsindicato'];
      $idseccional = $_POST['idseccional'];
      $idestadocivil = $_POST['idestadocivil'];
      $idnacionalidad = $_POST['idnacionalidad'];
      $idsituacionrevista = $_POST['idsituacionrevista'];
      $idcategoriaempleado = $_POST['idcategoriaempleado'];
      $idempresa = $_POST['idempresa'];
      $idtipodocumento = $_POST['idtipodocumento'];      

      $baja = $_POST['baja'];

      $idusuariomodificacion =  isset($_SESSION['idusuario'])?$_SESSION['idusuario']:'';
      if ($baja) 
      {    
        $idusuariobaja = $_SESSION['idusuario'];
      }else
      {
        $idusuariobaja = 'NULL';
      }
      
      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($provincia);
      $provincia=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idestadocivil);
      $idestadocivil=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idnacionalidad);
      $idnacionalidad=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idsindicato);
      $idsindicato=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idseccional);
      $idseccional=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idsituacionrevista);
      $idsituacionrevista=$claveDesencriptada;
      
      $claveDesencriptada = SED::decryption($idcategoriaempleado);
      $idcategoriaempleado=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idempresa);
      $idempresa=$claveDesencriptada;
      
      $claveDesencriptada = SED::decryption($idtipodocumento);
      $idtipodocumento=$claveDesencriptada;

      $documento = eliminarComillas($documento);
      $cuil = eliminarComillas($cuil);
      $nombre = eliminarComillas($nombre);
      $apellido = eliminarComillas($apellido);
      $sexo = eliminarComillas($sexo);
      $telefono = eliminarComillas($telefono);
      $direccion = eliminarComillas($direccion);
      $localidad = eliminarComillas($localidad);
      $provincia = eliminarComillas($provincia);
      $idestadocivil = eliminarComillas($idestadocivil);
      $idnacionalidad = eliminarComillas($idnacionalidad);
      $idsituacionrevista = eliminarComillas($idsituacionrevista);
      $idsindicato = eliminarComillas($idsindicato);
      $idseccional = eliminarComillas($idseccional);
      $idcategoriaempleado = eliminarComillas($idcategoriaempleado);      
      $idempresa = eliminarComillas($idempresa);
      $idtipodocumento = eliminarComillas($idtipodocumento);            

      $nacimiento = date("Y-m-d", strtotime($nacimiento));
      $baja = date("Y-m-d", strtotime($baja));
      $idusuariomodificacion = eliminarComillas($idusuariomodificacion);
      
      if(empty($documento) OR empty($cuil) OR empty($nombre) OR empty($apellido) OR empty($sexo) OR empty($telefono) 
       OR empty($direccion) OR empty($localidad) OR empty($provincia) OR empty($nacimiento) 
       OR empty($idusuariomodificacion) OR empty($idestadocivil) OR empty($idnacionalidad) OR empty($idsituacionrevista)
       OR empty($idsindicato) OR empty($idseccional) OR empty($idcategoriaempleado) OR empty($idempresa) 
       OR empty($idtipodocumento))   
      {
        $data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "SELECT * FROM padron WHERE id = $clave";  
       
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];      
        }
       
        if(!empty($id))
        {
            $sql = "UPDATE padron SET documento = '$documento', cuil = '$cuil', nombre = '$nombre', apellido = '$apellido', 
            sexo = '$sexo', telefono = '$telefono', direccion = '$direccion', localidad = '$localidad', provincia = '$provincia', 
            nacimiento = '$nacimiento', idsindicato = '$idsindicato', idseccional = '$idseccional', 
            idestadocivil = '$idestadocivil', idnacionalidad = '$idnacionalidad', idsituacionrevista = '$idsituacionrevista',
            idcategoriaempleado = '$idcategoriaempleado', idempresa = '$idempresa', idtipodocumento = '$idtipodocumento',
            baja = '$baja', modificacion = NOW(), idusuariomodificacion = '$idusuariomodificacion', idusuariobaja = '$idusuariobaja',
            status = $status WHERE id = $clave";

             if (mysqli_query($conn, $sql)) {          
                  mysqli_close($conn);
                  $data = array("exito" => '1');
                  die(json_encode($data));        
             }
             if (mysqli_errno($conn)) {                        
                  // printf(mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n");
                  switch (mysqli_errno($conn)) {
                    case '1062':
                      $data = array("error" => '1');
                      die(json_encode($data));
                      break;
                  }
             }
        }else{
          $data = array("error" => '4');
          die(json_encode($data));
        }
  }
}


if($option=="eliminar"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "DELETE FROM padron WHERE id = $clave";
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