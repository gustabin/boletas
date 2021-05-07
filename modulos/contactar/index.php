<?php 
session_start(); 
include_once('../../tools/accesos.php');
if($_SESSION['acceso23'] !== 'Contacto'){
  header("Location: ../../tools/logout.php");
}
include_once('../../tools/header.php');
include_once('../../tools/navbar.php'); 
include_once('../../tools/aside.php'); 
?>


<div class="wrapper">
<br>
<!--         <?php
      //   if($mensaje!="") 
        {?>
            <div class="alert alert-success">                     
                <?php //echo $mensaje;?>
                <a href="admin/modulos/carrito" class="badge badge-success">Ver carrito</a>                
            </div>
            <?php 
        } ?> -->
  <!-- Navbar -->
  <nav class=" navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="../../../index.php" class="navbar-brand">
        <img src="../../img/logoEmpresa.png" alt="Logo carrito" class="brand-image elevation-3"
             style="opacity: .8; width: 50px">
        <span class="brand-text font-weight-light">Carrito de compras</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../../../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if(!empty($_SESSION['carrito'])){ ?>
              <li class="nav-item">
                  <a class="nav-link" href="../carrito" tabindex="-1" aria-disabled="true">Carrito(<?php 
                      echo (empty($_SESSION['carrito']))?0:count($_SESSION['carrito']);
                  ?>)</a>
              </li>    
            <?php } ?>            
            <li class="nav-item">
                <a class="nav-link" href="index.php" tabindex="-1" aria-disabled="true">Contacto</a>
            </li>              
        </ul>      
      </div>
    </div>
  </nav>
    <br>
    <br>
    <div class="container">
<br>
<?php if((isset($mensaje))!="") 
        {?>
            <div class="alert alert-success">                     
                <?php echo $mensaje;?>                                
            </div>
            <?php 
        } ?>
<h3>Contactar</h3>

<?php include_once('contactarVista.php'); ?>
<?php include_once('../../tools/footer.php'); ?> 