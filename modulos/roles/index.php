<?php 
session_start(); 
include_once('../../tools/accesos.php'); 
if($_SESSION['acceso16'] !== 'Rol'){
    header("Location: ../../tools/logout.php");
}
include_once("../../tools/header.php");   
include_once("../../tools/navbar.php");  
include_once("../../tools/aside.php");  

$page_title = "Roles de usuario";
?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Carrito de compras - <?php echo $page_title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"> </i> <a href="../../"> Inicio</a></li>
              <li class="breadcrumb-item active"><?php echo $page_title ?></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <?php include_once('rolesModal.php'); ?>

     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h1><i class="fas fa-user-tag"></i>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" onclick="Incluir()">
                    <i class="fas fa-plus-circle"></i>
                    Nuevo
                  </button>  
                
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" onclick="Sindicato()">
                    Elegir sindicato y empresa
                  </button>  

                   <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" onclick="Empresa()">
                    Elegir Empresa
                  </button>   -->
                </h1>
              </div>
              <div class="card-body">
                 <?php include_once('rolesTabla.php'); ?>            
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

 <?php include_once("../../tools/footer.php"); ?>
 
<script src="rolesFunciones.js"></script>