<?php  
session_start();
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 
require_once('../../tools/sed.php');

$option = $_GET['option'];  

if($option=="buscar"){
  $email = $_POST['email'];  
  $password = $_POST['password'];  

  $email = eliminarComillas($email);  
  $password = SED::encryption($password);    
  
  if(empty($email) OR empty($password))   
  {$data = array("error" => '2');
    die(json_encode($data));
  }

  $sql = "SELECT *  FROM usuario WHERE email = '$email' AND password = '$password'";  
  $result = mysqli_query($conn, $sql);
  while($data=mysqli_fetch_array($result))
    {    
      $idempresa = $data['idempresa'];      
      $nombre = $data['nombre'];      
      $apellido = $data['apellido'];      
      $status = $data['status'];      
      $rolid = $data['rolid']; 

      //Asignar variables de session
      $_SESSION['idusuario']= $data['id'];   

      $_SESSION['idempresa']= $data['idempresa'];    
      $_SESSION['nombre']= $data['nombre'];    
      $_SESSION['apellido']= $data['apellido']; 
      $_SESSION['rolid']= $data['rolid'];   
      
      $_SESSION['intentosFallidos']= '';

      // Crear token
      $hora = date('H:i:s');
      $session_id = session_id();      
      $token = hash('sha256', $hora.$session_id);  
      $_SESSION['token'] = $token;       
    }
  if (!isset($idempresa)) {
    $data = array("error" => '1');  
    die(json_encode($data));
  }

  //Buscar los datos en la tabla EMPRESAS  
  $sql = "SELECT *  FROM empresas WHERE id = '$idempresa'";  
  $result = mysqli_query($conn, $sql);
  while($data=mysqli_fetch_array($result))
    {    
      //Asignar variables de session    
      $_SESSION['idsindicato']= $data['idsindicato'];   
      $_SESSION['nombreempresa']= $data['nombre'];   
      $_SESSION['cuit']= $data['cuit'];       
      $_SESSION['seccional']= $data['seccional'];       
      $_SESSION['rama']= $data['ramo'];   
    }


  //Buscar el nombre del sindicato en la tabla SINDICATOS
  $idsindicato = $_SESSION['idsindicato'];
  $sql2 = "SELECT *  FROM sindicatos WHERE id = $idsindicato";  
  $result2 = mysqli_query($conn, $sql2);
  while($data2=mysqli_fetch_array($result2))
    {    
      $_SESSION['nombresindicato']= $data2['razonsocial']; 
    }

  if (!isset($status)) 
    {        
      $data = array("error" => '1');    
      $_SESSION['idusuario']= '';    
      $_SESSION['idempresa']= '';    
      $_SESSION['nombre']= '';    
      $_SESSION['apellido']= ''; 
      $_SESSION['rolid']= '';  
      $_SESSION['idsindicato']= '';   
      $_SESSION['nombreempresa']= '';    
      $_SESSION['cuit']= '';       

      die(json_encode($data));
    }

  if ($status!=0)  //cliente activo o inactivo
    {
      $data = array("exito" => '1');  
      die(json_encode($data));
    }     
}

mysqli_close($conn);