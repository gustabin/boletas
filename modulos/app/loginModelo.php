<?php  
session_start();
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 
require_once('../../tools/sed.php');

$option = $_GET['option'];  

if($option=="buscar"){
  $email = $_POST['email'];  
  $password = $_POST['password'];  

  //Validar con preg_match
  //$validaemail = preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['email']);
  // $validapassword = preg_match('/^[0-9a-zA-Z]+$/', $_POST['password']);
  // $validapassword =preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=!\?]{8,20}$/',$_POST['password']);

  // if($validaemail == 0 OR $validapassword == 0){
  //   
  //   $data = array("error" => '3');
  //   die(json_encode($data));
  // } 
  $email = eliminarComillas($email);

  
  $password = SED::encryption($password);
    
  
  if(empty($email) OR empty($password))   
  {$data = array("error" => '2');
    die(json_encode($data));
  }

  //Buscar los datos en la tabla USUARIO  
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

      //if(isset($_SESSION['intentosFallidos'])){  
      //  if($_SESSION['intentosFallidos']>=3)
        // {
          // Intentos fallidos
          // $data = array("error" => '4');
          // die(json_encode($data)); 
        // }     
      // }else{  
       // $_SESSION['intentosFallidos']=0;
      // }

      //$_SESSION['intentosFallidos']= $_SESSION['intentosFallidos']+1;
      die(json_encode($data));
    }

  if ($status!=0)  //cliente activo o inactivo
    {
      $data = array("exito" => '1');  
      die(json_encode($data));
    }     
}

mysqli_close($conn);