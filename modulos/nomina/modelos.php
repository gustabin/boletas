<?php
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/sed.php');
$html = "";

 $clave = $_POST['elegido'];
  
  $claveDesencriptada = SED::decryption($clave);
  $clave=$claveDesencriptada;  

$sql = "SELECT * FROM categoriaempleados WHERE idsindicato=$clave AND status=1";

$result = mysqli_query($conn, $sql);
while($data=mysqli_fetch_array($result))
{
	$id = $data['id'];
	$nombre = $data['nombre'];      
	$claveEncriptada = SED::encryption($id);
	$id=$claveEncriptada;                          
  $html = '<option value="'. $id . '">' .$nombre. '</option>';	
  echo $html;	
}
?>