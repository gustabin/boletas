<?php 
session_start();
require_once('../../tools/sed.php');
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];  
//var_dump($_REQUEST);
if($option=="incluir"){ 
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $idsindicato = $_POST['idsindicato'];  
      $idempresa = $_POST['idempresa'];  
      $idpadron = $_POST['idpadron'];  
      $cuil = $_POST['cuil'];  
      $sueldo = $_POST['sueldo'];  
      $idcategoriaempleado = $_POST['idcategoriaempleado'];  
      $idusuarioalta = $_SESSION['idusuario'] ;      
      
      $claveDesencriptada = SED::decryption($idsindicato);
      $idsindicato=$claveDesencriptada;

      $claveDesencriptada = SED::decryption($idempresa);
      $idempresa=$claveDesencriptada; 

      $claveDesencriptada = SED::decryption($idcategoriaempleado);
      $idcategoriaempleado=$claveDesencriptada;

      $status = $_POST['status'];

      $idsindicato = eliminarComillas($idsindicato);
      $idempresa = eliminarComillas($idempresa);
      // $idpadron = eliminarComillas($idpadron);
      $cuil = eliminarComillas($cuil);
      $sueldo = eliminarComillas($sueldo);
      $idcategoriaempleado = eliminarComillas($idcategoriaempleado);

      
      if(empty($idsindicato) OR empty($idempresa) OR  empty($cuil) OR empty($idcategoriaempleado)  OR empty($sueldo))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      // Buscar en el padron por cuil
      
      $sql = "SELECT * FROM padron WHERE cuil = $cuil";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
      {
          $id = $data['id'];          
      }

      if(empty($id))   
        { 
          $data = array("error" => '5');
          die(json_encode($data));
        }

      //incluir los datos en la tabla nomina
      $sql = "INSERT INTO `nomina` (`id`, `idsindicato`, `idempresa`, `idpadron`, `cuil`, `sueldo`, `idcategoriaempleado`, `fechaalta`, `idusuarioalta`, `fecha`, `status`) VALUES (NULL, '$idsindicato', '$idempresa', '$idpadron', '$cuil', '$sueldo', '$idcategoriaempleado', NOW(), '$idusuarioalta', NOW(), $status)";

      if (mysqli_query($conn, $sql)) {
        
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } else {
        
        $sql2 = "SELECT * FROM `nomina` WHERE `cuil`= '$cuil'";

        $result2 = mysqli_query($conn, $sql2);
        while($data2=mysqli_fetch_array($result2))
          {
            $idempresa = $data2['idempresa'];            
          }    

        $sql3 = "SELECT * FROM `empresas` WHERE `id`= '$idempresa'";
        
        $result3 = mysqli_query($conn, $sql3);
        while($data3=mysqli_fetch_array($result3))
          {
            $nombre = $data3['nombre'];            
          } 
        $data = array("error" => '1', "nombre" => $nombre);
        die(json_encode($data));
      }
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if($option=="empresa"){
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
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
          $sueldo = $data['sueldo'];
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
                        "sueldo"=>$sueldo,
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
          $sueldo = $data['sueldo'];  
          $idcategoriaempleado = $data['idcategoriaempleado'];  
          $fechaalta = $data['fechaalta'];

          $fechamodificacion = $data['fechamodificacion'];
          $idusuarioalta = $data['idusuarioalta'];
          $idusuariomodificacion = isset($data['idusuariomodificacion'])?$data['idusuariomodificacion']:'';     
          $fecha = $data['fecha'];      
          $status = $data['status'];                             
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;
        }

        $fechaalta = date("d-m-Y", strtotime($fechaalta));
        $fechamodificacion = date("d-m-Y", strtotime($fechamodificacion));
        $fecha = date("d-m-Y h:i:s A", strtotime($fecha));

        $claveEncriptada = SED::encryption($idsindicato);
        $idsindicato=$claveEncriptada;

        $claveEncriptada = SED::encryption($idempresa);
        $idempresa=$claveEncriptada;

        $claveEncriptada = SED::encryption($idpadron);
        $idpadron=$claveEncriptada;

        $claveEncriptada = SED::encryption($idcategoriaempleado);
        $idcategoriaempleado=$claveEncriptada;

        $claveEncriptada = SED::encryption($idusuarioalta);
        $idusuarioalta=$claveEncriptada;

        $claveEncriptada = SED::encryption($idusuariomodificacion);
        $idusuariomodificacion=$claveEncriptada;

        mysqli_close($conn);
        $data = array("exito" => '1',
                        "id"=>$id, 
                        "idsindicato"=>$idsindicato, 
                        "idempresa"=>$idempresa, 
                        "idpadron"=>$idpadron, 
                        "cuil"=>$cuil,
                        "sueldo"=>$sueldo,
                        "idcategoriaempleado"=>$idcategoriaempleado,
                        "fechaalta"=>$fechaalta, 
                        "fechamodificacion"=>$fechamodificacion,
                        "idusuarioalta"=>$idusuarioalta, 
                        "idusuariomodificacion"=>$idusuariomodificacion,        
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
      $sueldo = $_POST['sueldo'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;  

      $idcategoriaempleado = $_POST['idcategoriaempleado'];  

      $idusuariomodificacion =  isset($_SESSION['idusuario'])?$_SESSION['idusuario']:'';

      $status = $_POST['status'];

      $claveDesencriptada = SED::decryption($idcategoriaempleado);
      $idcategoriaempleado=$claveDesencriptada;

      $idcategoriaempleado = eliminarComillas($idcategoriaempleado);
      $sueldo = eliminarComillas($sueldo);

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
            idcategoriaempleado = '$idcategoriaempleado',  fechamodificacion = '$fechamodificacion', sueldo = '$sueldo', 
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