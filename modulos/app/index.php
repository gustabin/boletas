<?php 
include_once('../../tools/header.php'); 
?>
<?php $page_title = "Login" ;?>

<body class="hold-transition sidebar-mini">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>App Boletas sindicales - <?= $page_title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"> </i> <a href="index.php"> Inicio</a></li>
              <li class="breadcrumb-item active"><?= $page_title ?></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">            
            <div class="card">             
              <div class="card-body">
                  <?php include_once('loginModal.php'); ?>
              </div>
            </div>
          </div>
          <div class="col-md-4">
          </div>
        </div>
      </div>
    </section>   

  <div>
<?php include_once('../../tools/footer.php'); ?> 