 <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>      
    </ul>
    <?php if($_SESSION['nombreempresa']){
          echo $_SESSION['nombreempresa'];
    } 
    
    if (!isset($_SESSION['nombresindicato'])) {
        $_SESSION['nombresindicato']="";
    } else {
        echo " - " . $_SESSION['nombresindicato'];
    }

    if (!isset($_SESSION['seccional'])) {  ?>
         <a href="../../modulos/seccional/index.php"> - Es necesario definir una seccional </a>
    <?php } 

    if (!isset($_SESSION['rama'])) {  ?>
         <a href="../../modulos/ramo/index.php"> - Es necesario definir una rama </a>
    <?php }  ?>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><?php //echo $solicitudContactos ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php        
        $i=0;          
        // Calcular solicitud de contactos
        $sql = "SELECT * FROM contactos WHERE Status = 0 LIMIT 4";       

        $result = mysqli_query($conn, $sql);
        while($data=mysqli_fetch_array($result))
          {
            $id = $data['id'];
            $nombrecontacto = $data['nombre'];
            $telefono = $data['telefono'];
            $email = $data['email'];
            $mensaje = $data['mensaje'];  
            $i = $i + 1;  
            $avatar = !empty(($_SESSION['avatar'])) ? $_SESSION['avatar'] : 'userAvatar'.$i.'.png';
            ?>
                <a href="#" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                    <img src="../../img/<?php echo $avatar ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        <?php echo $nombrecontacto ?>
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                      </h3>
                      <p class="text-sm"><?php echo $mensaje ?></p>
                      <p class="text-sm"><?php echo $telefono ?></p>
                      <p class="text-sm text-muted"><i class="far fa-email mr-1"></i> <?php echo $email ?></p>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
          <?php } ?>
          <a href="../contactos/index.php" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Perfil</span>                   
          <div class="dropdown-divider"></div>
          <a href="../../tools/logout.php" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> Logout
            <span class="float-right text-muted text-sm"></span>
          </a>         
        </div>
      </li>
     <!--  <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>