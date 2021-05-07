<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');
?>
<script src="usuarioFunciones.js"></script>

<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Email</th>
      <th>Cuil</th>      
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>
  </thead>
  <tbody>
  <?php     
  $idempresa=$_SESSION['idempresa'];
  $sql = "SELECT * FROM usuario WHERE status != 2 AND idempresa='$idempresa' OR rolid=1";
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $email = $data['email'];
    $password = $data['password'];
    $cuil = $data['cuil'];    
    $status = $data['status'];  
    ?>
    <tr>      
      <td><?php echo $nombre ?></td> 
      <td><?php echo $apellido ?></td> 
      <td><?php echo $email ?></td> 
      <td><?php echo $cuil ?></td> 
      <td>
          <?php if($status == 1) {?>
                  <span class="badge badge-success">Activo</span>
          <?php }else{ ?>    
                  <span class="badge badge-danger">Inactivo</span>
          <?php } ?>   
      </td>   
      <td>          
          <div class="text-center">
          <?php 
           
          $claveEncriptada = SED::encryption($id);
          $id=$claveEncriptada;
           ?>
              <button class="btn btn-primary btn-sm" 
                type="button" 
                data-toggle="modal" 
                data-target="#modal-default" 
                title="Modificar" 
                onclick="Modificar('<?php echo $id ?>','<?php echo $_SESSION['token'] ?>')">          
                <i class="fas fa-pencil-alt"></i>
              </button>

              <button class="btn btn-danger btn-sm" 
                type="button" 
                title="Eliminar" 
                onclick="Eliminar('<?php echo $id ?>','<?php echo $_SESSION['token'] ?>')">
              <i class="fas fa-trash-alt"></i></button> 
          </div>
      </td>
    </tr>
  <?php  
  }  
  mysqli_close($conn);
  ?>                  
  </tbody>
  <tfoot>
   <tr>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Email</th>
      <th>Cuil</th>      
      <th>Status</th>                      
      <th>Acciones</th>                    
  </tr>
  </tfoot>
</table>