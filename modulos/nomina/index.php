<?php 
session_start(); 
include_once('../../tools/accesos.php');

if($_SESSION['acceso12'] !== 'Nomina'){
    header("Location: ../../tools/logout.php");
}
include_once('../../tools/header.php');
include_once('../../tools/navbar.php'); 
include_once('../../tools/aside.php'); 

$page_title = "Nómina";
?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
      <div class="content-wrapper">
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Boletas sindicales - <?= $page_title ?></h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"> </i> <a href="../../index.php"> Inicio</a></li>
                    <li class="breadcrumb-item active"><?= $page_title ?></li>
                  </ol>
                </div>
              </div>
            </div>
          </section>

          <?php include_once('nominaModal.php'); ?>
          <?php include_once('nominaEmpresaModal.php'); ?>

          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">            
                  <div class="card">
                    <div class="card-header">                
                      <h1><i class="fas fa-user-tag"></i> 
                        <?php //if (isset($_SESSION["loginEmpresa"])) {    ?>
                          <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" 
                      onclick="Incluir()" id="botonNuevo" name="botonNuevo"><i class="fas fa-plus-circle"></i> Nuevo empleado</button>
                          <?php  // } ?>
                      <?php //if (!isset($_SESSION["loginEmpresa"])) { ?>
                         <!-- <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#modalEmpresa-default" onclick="Empresa()"><i class="far fa-building"></i> Empresa</button> -->
                        <?php  //} ?>                
                      </h1>
                    </div>
                    <div class="card-body">
                      <?php include_once('nominaTabla.php'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
      </div>
<?php include_once('../../tools/footer.php'); ?> 