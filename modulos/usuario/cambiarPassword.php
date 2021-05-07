<?php require_once('../../tools/sed.php');
require_once('../../tools/eliminarComillas.php'); 
require_once('../../tools/mypathdb.php'); ?> 
<?php
$clave = $_POST['idPassword'];

$claveDesencriptada = SED::decryption($clave);
$clave=$claveDesencriptada;

//establecer el password
if (isset($_POST['cambiarPassword'])) {
   //Recogemos el archivo enviado por el formulario
   $password = $_POST['txtPassword'];  
   $validapassword =preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=!\?]{8,20}$/',$_POST['txtPassword']);

   if($validapassword == 0){   
    echo '<div><b>Ocurrió algún error al actualizar el registro. No pudo guardarse.</b></br>';   
    echo 'El password debe contener números, letras mayúsculas y minúsculas,</br>';   
    echo 'caracteres especiales y entre 8 y 20 caracteres.</b></div>';   
    die();
   }   
    
   //$password = eliminarComillas($password); 
   
   $password = SED::encryption($password);

   if (isset($password) && $password != "") { 
      $sql = "UPDATE usuario SET password = '$password' WHERE id = $clave";
      
      if (mysqli_query($conn, $sql)) {
        
        mysqli_close($conn);
        header("Location: index.php");    
      } else {
        echo '<div><b>Ocurrió algún error al actualizar el registro. No pudo guardarse.</b></div>';          
      }
  }        
}