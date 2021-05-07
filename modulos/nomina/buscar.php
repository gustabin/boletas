<?php  
session_start();
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 
require_once('../../tools/sed.php');

$consultaBusqueda = $_POST['valorBusqueda'];
$consultaBusqueda = eliminarComillas($consultaBusqueda);
$mensaje = "";
$contador= 0;
$cantidad= "";

if (isset($consultaBusqueda)) {
	$idsindicato = $_SESSION['idsindicato'];

	$sql = "SELECT * FROM padron WHERE idsindicato = $idsindicato AND cuil LIKE '%$consultaBusqueda%'";
	$resultado = mysqli_query($conn, $sql);	

	$filas = mysqli_num_rows($resultado);

	if ($filas === 0) {
		$mensaje = "<p>No hay ningún trabajador con ese CUIL, nombre o apellido</p>";
	} else {
		echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';
		 while($data = mysqli_fetch_array($resultado))
			{
			$contador=$contador +1;
			$id = $data['id'];
			$nombre = $data['nombre'];       
			$apellido = $data['apellido'];       
			$cuil = $data['cuil'];  

			
			$claveEncriptada = SED::encryption($id);
			$id=$claveEncriptada;   
		
			$mensaje .= '
			<p>
			<strong>Nombre:</strong> ' . $nombre . ' ' . $apellido . '<br>
			<span id="id'. $contador . '"   style="display:none"> ' . $id   . '<br></span>
			Cuil:<span id="cuilpadron" onclick="pegarCuil('. $cuil . ')"> <a href="#">' . $cuil . '</a><br></span>
			Id padron:<span id="txtidpadron"> ' . $data['id'] . '<br></span>
			<span id="cantidad'. $contador . '" style="display:none"><strong>contador:</strong> ' . $contador . '<br></span>
			</p>';			
		};
	}; 
};
echo $mensaje;
?>