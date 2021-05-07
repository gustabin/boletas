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
      $periodo = $_POST['periodo'];
      $cuit0 = $_POST['cuit0'];  
      $cuit1 = $_POST['cuit1'];  
      $cuit2 = $_POST['cuit2'];  
      $cuit3 = $_POST['cuit3'];  
      $cuit4 = $_POST['cuit4'];  
      $cuit5 = $_POST['cuit5'];  
      $cuit6 = $_POST['cuit6'];  
      $cuit7 = $_POST['cuit7'];  
      $cuit8 = $_POST['cuit8'];  
      $cuit9 = $_POST['cuit9'];  
      
      $status = $_POST['status'];

      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      $cuit0 = eliminarComillas($cuit0);
      $cuit1 = eliminarComillas($cuit1);
      $cuit2 = eliminarComillas($cuit2);
      $cuit3 = eliminarComillas($cuit3);
      $cuit4 = eliminarComillas($cuit4);
      $cuit5 = eliminarComillas($cuit5);
      $cuit6 = eliminarComillas($cuit6);
      $cuit7 = eliminarComillas($cuit7);
      $cuit8 = eliminarComillas($cuit8);
      $cuit9 = eliminarComillas($cuit9);

      $periodo = date("Y-m-d", strtotime($periodo));
      $hoy= date("Y") . "-". date("m") . "-" . date("d");
      if ($periodo<$hoy) {
        $data = array("error" => '6');
        die(json_encode($data));
      }            

      if ($cuit0>31 OR $cuit1>31 OR $cuit2>31 OR $cuit3>31 OR $cuit4>31 OR $cuit5>31 OR $cuit6>31 OR $cuit7>31 OR $cuit8>31 OR $cuit9>31)  {
        $data = array("error" => '4');
        die(json_encode($data));
      }
      
      if(empty($periodo) OR empty($cuit1) OR empty($cuit2) OR empty($cuit3) OR empty($cuit4) OR empty($cuit5) OR empty($cuit6) OR empty($cuit7)  OR empty($cuit8) OR empty($cuit9))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }
      
      $sql = "INSERT INTO `vencimiento` (`id`, `idsindicato`, `periodo`, `cuit0`, `cuit1`, `cuit2`, `cuit3`, `cuit4`, `cuit5`, `cuit6`, `cuit7`, `cuit8`, `cuit9`, `fecha`, `status`)
       VALUES (NULL, '$idsindicato', '$periodo', '$cuit0', '$cuit1', '$cuit2', '$cuit3', '$cuit4', '$cuit5', '$cuit6', '$cuit7', '$cuit8', '$cuit9', NOW(), $status)";

      if (mysqli_query($conn, $sql)) {    
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } else {
        
        $data = array("error" => '1');
        die(json_encode($data));
      }
  }else{
    $data = array("error" => '5');
    die(json_encode($data));
  }
}

if($option=="consultar"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "SELECT * FROM vencimiento WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {      
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $periodo = $data['periodo'];
          $cuit0 = $data['cuit0'];
          $cuit1 = $data['cuit1'];
          $cuit2 = $data['cuit2'];     
          $cuit3 = $data['cuit3'];    
          $cuit4 = $data['cuit4'];    
          $cuit5 = $data['cuit5'];    
          $cuit6 = $data['cuit6'];    
          $cuit7 = $data['cuit7'];    
          $cuit8 = $data['cuit8'];    
          $cuit9 = $data['cuit9'];      
          $fecha = $data['fecha'];      
          $status = $data['status']; 
        }

        $periodo = date("d-m-Y", strtotime($periodo));
        $hoy= date("Y") . "-". date("m") . "-" . date("d");

        if ($periodo<$hoy) {
          $data = array("error" => '6');
          die(json_encode($data));
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

        if ($cuit0>31 OR $cuit1>31 OR $cuit2>31 OR $cuit3>31 OR $cuit4>31 OR $cuit5>31 OR $cuit6>31 OR $cuit7>31 OR $cuit8>31 OR $cuit9>31)  {
          $data = array("error" => '5');
          die(json_encode($data));
        }

        
        if(empty($periodo) OR empty($cuit1) OR empty($cuit2) OR empty($cuit3) OR empty($cuit4) OR empty($cuit5) OR empty($cuit6) OR empty($cuit7)  OR empty($cuit8) OR empty($cuit9))   
        {$data = array("error" => '2');
          die(json_encode($data));
        }

        if ($status!=0) 
        { 
          $data = array("exito" => '1',"id"=>$id, "idsindicato"=>$idsindicato, "periodo"=> $periodo, "cuit0"=>$cuit0,
           "cuit1"=>$cuit1, "cuit2"=>$cuit2, "cuit3"=>$cuit3, "cuit4"=>$cuit4, "cuit5"=>$cuit5,  
           "cuit6"=>$cuit6, "cuit7"=>$cuit7, "cuit8"=>$cuit8, "cuit9"=>$cuit9,              
           "fecha"=>$fecha, "status"=>$status);
          die(json_encode($data));
        }     
  }else{
    $data = array("error" => '5');
    die(json_encode($data));
  }
} 

if($option=="modificarConsultar"){  
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];

      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "SELECT * FROM vencimiento WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];      
          $periodo = $data['periodo'];
          $cuit0 = $data['cuit0'];
          $cuit1 = $data['cuit1'];
          $cuit2 = $data['cuit2'];     
          $cuit3 = $data['cuit3'];    
          $cuit4 = $data['cuit4'];    
          $cuit5 = $data['cuit5'];    
          $cuit6 = $data['cuit6'];    
          $cuit7 = $data['cuit7'];    
          $cuit8 = $data['cuit8'];    
          $cuit9 = $data['cuit9'];      
          $fecha = $data['fecha'];      
          $status = $data['status'];           
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;

          $claveSindicato = SED::encryption($idsindicato);
          $idsindicato = $claveSindicato;
        }

        $periodo = date("d-m-Y", strtotime($periodo));        

        $fecha = date("d-m-Y h:i:s A", strtotime($fecha));
        mysqli_close($conn);
         $data = array("exito" => '1',"id"=>$id, "idsindicato" => $idsindicato, "periodo"=> $periodo, "cuit0"=>$cuit0,
           "cuit1"=>$cuit1, "cuit2"=>$cuit2, "cuit3"=>$cuit3, "cuit4"=>$cuit4, "cuit5"=>$cuit5,  
           "cuit6"=>$cuit6, "cuit7"=>$cuit7, "cuit8"=>$cuit8, "cuit9"=>$cuit9,              
           "fecha"=>$fecha, "status"=>$status);
       die(json_encode($data));
  }else{
    $data = array("error" => '5');
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
      $periodo = $_POST['periodo'];
      $cuit0 = $_POST['cuit0'];  
      $cuit1 = $_POST['cuit1'];  
      $cuit2 = $_POST['cuit2'];  
      $cuit3 = $_POST['cuit3'];  
      $cuit4 = $_POST['cuit4'];  
      $cuit5 = $_POST['cuit5'];  
      $cuit6 = $_POST['cuit6'];  
      $cuit7 = $_POST['cuit7'];  
      $cuit8 = $_POST['cuit8'];  
      $cuit9 = $_POST['cuit9'];  
      
      $status = $_POST['status'];

      $cuit0 = eliminarComillas($cuit0);
      $cuit1 = eliminarComillas($cuit1);
      $cuit2 = eliminarComillas($cuit2);
      $cuit3 = eliminarComillas($cuit3);
      $cuit4 = eliminarComillas($cuit4);
      $cuit5 = eliminarComillas($cuit5);
      $cuit6 = eliminarComillas($cuit6);
      $cuit7 = eliminarComillas($cuit7);
      $cuit8 = eliminarComillas($cuit8);
      $cuit9 = eliminarComillas($cuit9);

      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      $periodo = date("Y-m-d", strtotime($periodo));
      $hoy= date("Y") . "-". date("m") . "-" . date("d");

      if ($periodo<$hoy) {
        $data = array("error" => '6');
        die(json_encode($data));
      }  
      
      if ($cuit0>31 OR $cuit1>31 OR $cuit2>31 OR $cuit3>31 OR $cuit4>31 OR $cuit5>31 OR $cuit6>31 OR $cuit7>31 OR $cuit8>31 OR $cuit9>31)  {
        $data = array("error" => '5');
        die(json_encode($data));
      }

      
      if(empty($periodo) OR empty($cuit1) OR empty($cuit2) OR empty($cuit3) OR empty($cuit4) OR empty($cuit5) OR empty($cuit6) OR empty($cuit7)  OR empty($cuit8) OR empty($cuit9))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

     
      $sql = "SELECT * FROM vencimiento WHERE id = $clave";  
        
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id']; 
        }
      if(!empty($id))
      {       
          $sql = "UPDATE vencimiento SET idsindicato = '$idsindicato', periodo = '$periodo', cuit0 = '$cuit0', 
          cuit1 = '$cuit1',  cuit2 = '$cuit2',  cuit3 = '$cuit3',  cuit4 = '$cuit4',  cuit5 = '$cuit5',
          cuit6 = '$cuit6',  cuit7 = '$cuit7',  cuit8 = '$cuit8',  cuit9 = '$cuit9',
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
    $data = array("error" => '5');
    die(json_encode($data));
  }
}


if($option=="eliminar"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "DELETE FROM vencimiento WHERE id = $clave";
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
    $data = array("error" => '5');
    die(json_encode($data));
  }
}

mysqli_close($conn);