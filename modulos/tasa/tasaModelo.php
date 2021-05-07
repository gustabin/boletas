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
      $vigenciadesde = $_POST['vigenciadesde'];  
      $vigenciahasta = $_POST['vigenciahasta'];

      if ($vigenciadesde > $vigenciahasta) {
        $data = array("error" => '6');
        die(json_encode($data));
      }

      $porcentaje = $_POST['porcentaje'];
      $status = $_POST['status'];

      $sindicatoDesencriptada = SED::decryption($idsindicato);
      $idsindicato = $sindicatoDesencriptada;

      $idsindicato = eliminarComillas($idsindicato);
      $porcentaje = eliminarComillas($porcentaje);

      $vigenciadesde = date("Y-m-d", strtotime($vigenciadesde));
      $vigenciahasta = date("Y-m-d", strtotime($vigenciahasta));

      if ($porcentaje>9.99)  {
        $data = array("error" => '5');
        die(json_encode($data));
      }

      
      if(empty($idsindicato) OR empty($vigenciadesde) OR empty($vigenciahasta) OR empty($porcentaje))   
      {$data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "INSERT INTO `tasainteres` (`id`, `idsindicato`, `vigenciadesde`, `vigenciahasta`, `porcentaje`, `fecha`, `status`) VALUES (NULL, '$idsindicato', '$vigenciadesde', '$vigenciahasta', '$porcentaje',  NOW(), $status)";

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

      $sql = "SELECT * FROM tasainteres WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $vigenciadesde = $data['vigenciadesde'];
          $vigenciahasta = $data['vigenciahasta'];
          $porcentaje = $data['porcentaje'];       
          $fecha = $data['fecha'];      
          $status = $data['status']; 
        }

        $claveDesencriptada = SED::decryption($idsindicato);
        $idsindicato=$claveDesencriptada;

        $vigenciadesde = date("d-m-Y", strtotime($vigenciadesde));
        $vigenciahasta = date("d-m-Y", strtotime($vigenciahasta));
       
        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==0)  //pago eliminado
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($porcentaje>9.99)  {
           $data = array("error" => '5');
           die(json_encode($data));
        }

        if ($status!=0)  //pago activo o inactivo
        {
          $data = array("exito" => '1',"id"=>$id, "idsindicato"=> $idsindicato, "vigenciadesde"=>$vigenciadesde,
           "vigenciahasta"=>$vigenciahasta, "porcentaje"=>$porcentaje,     
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

      $sql = "SELECT * FROM tasainteres WHERE id = $clave";   

      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $vigenciadesde = $data['vigenciadesde'];
          $vigenciahasta = $data['vigenciahasta'];
          $porcentaje = $data['porcentaje'];
          $fecha = $data['fecha'];     
          $status = $data['status']; 
          
          
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;
        }
        $vigenciadesde = date("d-m-Y", strtotime($vigenciadesde));
        $vigenciahasta = date("d-m-Y", strtotime($vigenciahasta));
        $fecha = date("d-m-Y h:i:s A", strtotime($fecha));

        $claveEncriptada = SED::encryption($idsindicato);
        $idsindicato=$claveEncriptada;

       mysqli_close($conn);
         $data = array("exito" => '1',"id"=>$id, "idsindicato"=> $idsindicato, "vigenciadesde"=>$vigenciadesde,
           "vigenciahasta"=>$vigenciahasta, "porcentaje"=>$porcentaje,     
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
        $vigenciadesde = $_POST['vigenciadesde'];  
        $vigenciahasta = $_POST['vigenciahasta'];
        $porcentaje = $_POST['porcentaje'];
        $status = $_POST['status'];

        $claveDesencriptada = SED::decryption($idsindicato);
        $idsindicato=$claveDesencriptada;

        $idsindicato = eliminarComillas($idsindicato);
        $porcentaje = eliminarComillas($porcentaje);

        $vigenciadesde = date("Y-m-d", strtotime($vigenciadesde));
        $vigenciahasta = date("Y-m-d", strtotime($vigenciahasta));

        if ($vigenciadesde > $vigenciahasta) {
          $data = array("error" => '6');
          die(json_encode($data));
        }


        if ($porcentaje>9.99)  {
          $data = array("error" => '5');
          die(json_encode($data));
        }

        
        if(empty($idsindicato) OR empty($vigenciadesde) OR empty($vigenciahasta) OR empty($porcentaje))   
        {$data = array("error" => '2');
          die(json_encode($data));
        }

       
        $sql = "SELECT * FROM tasainteres WHERE id = $clave";  
          
        $result = mysqli_query($conn, $sql);
        while($data=mysqli_fetch_array($result))
          {
            $id = $data['id']; 
          }
        if(!empty($id))
        {       
            $sql = "UPDATE tasainteres SET idsindicato = '$idsindicato', vigenciadesde = '$vigenciadesde', 
            vigenciahasta = '$vigenciahasta', porcentaje = '$porcentaje', 
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

      $sql = "DELETE FROM tasainteres WHERE id = $clave";
      if (mysqli_query($conn, $sql)) {
        
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } else {
        if(mysqli_errno($conn)==1451){
          $data = array("error" => '5', "errorDescription" => mysqli_error($conn));
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