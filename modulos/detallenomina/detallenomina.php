<?php 
//session_start(); 
include_once('../../tools/accesos.php');

if($_SESSION['acceso12'] !== 'Nomina'){
    header("Location: ../../tools/logout.php");
}
// include_once('../../tools/header.php');
// include_once('../../tools/navbar.php'); 
// include_once('../../tools/aside.php'); 

//$page_title = "Detalle de empleado";
?>

          

<?php //include_once('detallenominaModal.php'); ?>
<?php include_once('detallenominaTablaDetalle.php'); ?>
<?php //include_once('../../tools/footer.php'); ?> 