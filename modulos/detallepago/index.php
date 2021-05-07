<?php 
session_start(); 
// $_SESSION['filas']=13;
$_SESSION['id']="";
include_once('../../tools/accesos.php');
if($_SESSION['acceso12'] !== 'Nomina'){
    header("Location: ../../tools/logout.php");
}
include_once('../../tools/header.php');
include_once('../../tools/navbar.php'); 
include_once('../../tools/aside.php'); 

$page_title = "Detalle de pago del empleado"; 
?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
      <div class="content-wrapper">
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1><?= $page_title ?></h1>
                  - <a href="../detallenomina">Detalle de nómina</a>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"> </i> <a href="../../index.php"> Inicio</a></li>
                    <li class="breadcrumb-item active"><?= $page_title ?>  </li>
                  </ol>
                </div>
              </div>
            </div>
          </section>

          <?php include_once('detallepagoModal.php'); ?>

          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">            
                  <div class="card">
                    <div class="card-body">
                      <?php include_once('detallepagoTabla.php'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
      </div>
<?php include_once('../../tools/footer.php'); ?> 