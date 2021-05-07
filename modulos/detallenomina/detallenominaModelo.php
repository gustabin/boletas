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
      $periodo = $_POST['periodo'];  
      $cuit = $_SESSION['cuit'];  

      $idsindicato = $_SESSION['idsindicato'];
      $idempresa = $_SESSION['idempresa'];     

      $cuit = eliminarComillas($cuit);
      $idsindicato = eliminarComillas($idsindicato);
      $idempresa = eliminarComillas($idempresa);
      
      if(empty($periodo) OR empty($cuit) OR  empty($idsindicato) OR empty($idempresa))   
        {
          $data = array("error" => '2');
          die(json_encode($data));
        }     

      $idconcepto="";
      $sql2 = "SELECT * FROM conceptos WHERE idsindicato = '$idsindicato' AND status=1";
// var_dump($sql2);
//    die();
          $resultado2 = mysqli_query($conn, $sql2);
          while($data2 = mysqli_fetch_array($resultado2))
          {
              $id = $data2['id'] .',';   
              $idconcepto .= $id;
          }


      $sql3 = "SELECT * FROM nomina WHERE status != 2 AND idsindicato = '$idsindicato'  AND idempresa = '$idempresa'";
   //    var_dump($sql3);
   // die();
      $resultado3 = mysqli_query($conn, $sql3);
      while($data3 = mysqli_fetch_array($resultado3))
      {
        $cuil = $data3['cuil'];

        $sql = "INSERT INTO `historialnomina` (`id`, `periodo`, `cuit`, `cuil`, `idconcepto`) VALUES (NULL, '$periodo', '$cuit', '$cuil', '$idconcepto')";
  //  var_dump($sql);
  // die();
        if (mysqli_query($conn, $sql)) {   
         
        } else {        
           $data = array("error" => '1');
           die(json_encode($data));
        }
      }
      $data = array("exito" => '1');
      die(json_encode($data));      
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if($option=="copiar"){ 
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= ""; 
  $periodo = $_GET['periodo'];
  if($_SESSION['token'] == $token){  
    $cuit = $_SESSION['cuit'];
    $fechaactual = date("Y/m");
    //elimina la nomina del mes actual
    $sql = "DELETE FROM `historialnomina` WHERE periodo = '$fechaactual' AND cuit= $cuit";
    $resultado = mysqli_query($conn, $sql);    

    $sql = "SELECT * FROM historialnomina WHERE periodo = '$periodo' AND cuit= $cuit";
    $resultado = mysqli_query($conn, $sql);
    while($data = mysqli_fetch_array($resultado))
    {
        $periodo = $data['periodo'];           
        $tipoboleta = $data['tipoboleta'];
        $cuil = $data['cuil'];
        $idconcepto = $data['idconcepto']; 

        if ($periodo!=$fechaactual) {
            $sql2 = "INSERT INTO `historialnomina` (`id`, `periodo`, `tipoboleta`, `cuit`, `cuil`, `idconcepto`) VALUES (NULL, '$fechaactual', '$tipoboleta', '$cuit', '$cuil', '$idconcepto')";
            
            if (mysqli_query($conn, $sql2)) {        
            } else {        
            }      
        }          
    }
    mysqli_close($conn);
    $data = array("exito" => '1');
    die(json_encode($data));
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if($option=="empresa"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){    
      $cuit=$_POST["cuit"];
      $password=$_POST["password"];
      $_SESSION["loginEmpresa"]="";
      $sql = "SELECT * FROM empresas WHERE cuit = $cuit";

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

        if ($status==0)  //empresa eliminada
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($status!=0)  //nomina activa o inactivo
        {
          $password = SED::encryption($password);

          $sql = "SELECT * FROM usuario WHERE idempresa = $id AND password = '$password'";
          $result = mysqli_query($conn, $sql);
          while($data=mysqli_fetch_array($result))
            {
              $rolid = $data['rolid'];
              $idUsuario = $data['id'];         
              $status = $data['status']; 
              $idempresa = $data['idempresa']; 
            }     
            
            if (!isset($idempresa)) 
            {        
              $data = array("error" => '2');        
              die(json_encode($data));
            }

            if ($status==0)  //usuario eliminado
            {                  
              $data = array("error" => '1');
              die(json_encode($data));
            }

            if ($status!=0)  //usuario activa o inactivo
            {
               $_SESSION["loginEmpresa"]="logueado";
               $_SESSION['nombreempresa']= $nombre;
               $data = array("exito" => '1',
                            "id"=>$id, 
                            "idsindicato"=>$idsindicato, 
                            "nombre"=>$nombre, 
                            "status"=>$status,
                            "rolid"=>$rolid,
                            "idUsuario"=>$idUsuario);          
               die(json_encode($data));
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

      $sql = "SELECT * FROM nomina WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $idempresa = $data['idempresa'];
          $idpadron = $data['idpadron'];
          $cuil = $data['cuil'];
          $idcategoriaempleado = $data['idcategoriaempleado'];      
          $fechaalta = $data['fechaalta'];
          $fechamodificacion = $data['fechamodificacion'];
          $idusuarioalta = $data['idusuarioalta'];
          $idusuariomodificacion = $data['idusuariomodificacion'];     
          $fecha = $data['fecha'];      
          $status = $data['status']; 
        }

        $claveDesencriptada = SED::decryption($idsindicato);
        $idsindicato=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idempresa);
        $idempresa=$claveDesencriptada;    

        $claveDesencriptada = SED::decryption($idpadron);
        $idpadron=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idcategoriaempleado);
        $idcategoriaempleado=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idusuarioalta);
        $idusuarioalta=$claveDesencriptada;  

        $claveDesencriptada = SED::decryption($idusuariomodificacion);
        $idusuariomodificacion=$claveDesencriptada;

        $fechaalta = date("Y-m-d", strtotime($fechaalta));

        $fechamodificacion = date("Y-m-d", strtotime($fechamodificacion));

        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  //nomina eliminada
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($status!=0)  //nomina activa o inactivo
        {
           $data = array("exito" => '1',
                        "id"=>$id, 
                        "idsindicato"=>$idsindicato, 
                        "idempresa"=>$idempresa, 
                        "idpadron"=>$idpadron, 
                        "cuil"=>$cuil,
                        "idcategoriaempleado"=>$idcategoriaempleado,
                        "fechaalta"=>$fechaalta, 
                        "fechamodificacion"=>$fechamodificacion,
                        "idusuarioalta"=>$idusuarioalta, 
                        "idusuariomodificacion"=>$idusuariomodificacion,        
                        "fecha"=>$fecha, "status"=>$status);
          die(json_encode($data));
        }     
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
} 


if($option=="modificarConsultar"){ 
  $periodo = $_GET['periodo']; 
  $periodo = date("Y/m", strtotime($periodo));    
  $cuit = $_GET['cuit']; 

  $sql = "SELECT * FROM `historialnomina` WHERE periodo='$periodo' AND cuit='$cuit'";  
  $objeto = [];   
  $result = mysqli_query($conn, $sql);
  while($data=mysqli_fetch_array($result))
    {
      $id = $data['id'];
      $tipoboleta = $data['tipoboleta'];         
      $cuil = $data['cuil'];  
      $idconcepto = $data['idconcepto'];  

      array_push($objeto, array("exito" => '1', 
                    "id"=>$id, 
                    "tipoboleta"=>$tipoboleta, 
                    "cuil"=>$cuil,
                    "idconcepto"=>$idconcepto)); 
    }
    die(json_encode($objeto)); 
}

if($option=="modificar"){  
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){ 
      $clave = $_POST['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;  

      $idcategoriaempleado = $_POST['idcategoriaempleado'];  

      $idusuariomodificacion =  isset($_SESSION['idusuario'])?$_SESSION['idusuario']:'';

      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($idcategoriaempleado);
      $idcategoriaempleado=$claveDesencriptada;

      $idcategoriaempleado = eliminarComillas($idcategoriaempleado);

      $fechamodificacion = date("Y-m-d");

      $sql = "SELECT * FROM nomina WHERE id = $clave";  
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id']; 
        }
       
        if(!empty($id))
        {            
            $sql = "UPDATE nomina SET 
            idcategoriaempleado = '$idcategoriaempleado',  fechamodificacion = '$fechamodificacion', 
            idusuariomodificacion = '$idusuariomodificacion', status = $status WHERE id = $clave";   
        
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

      $sql = "DELETE FROM nomina WHERE id = $clave";
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