<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');
?> 
<script src="sindicatoFunciones.js"></script>

<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Cuit</th>
      <th>Razón social</th>
      <th>Dirección</th>
      <th>Status</th>                   
      <th>Acciones</th>                
  </tr>                
  </tr>
  </thead>
  <tbody>
  <?php     
  $idsindicato = $_SESSION['idsindicato']; 
  $sql = "SELECT * FROM sindicatos WHERE status != 2 AND id = '$idsindicato'";
  
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $cuit = $data['cuit'];
    $razonsocial = $data['razonsocial'];
    $direccion = $data['direccion'];   
    $fecha = $data['fecha'];      
    $status = $data['status']; 
  ?>
    <tr>      
      <td><?php echo $cuit ?></td> 
      <td><?php echo substr($razonsocial, 0, 50) ?></td>      
      <td><?php echo substr($direccion, 0, 40) ?></td>      
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
      <th>Cuit</th>
      <th>Razón social</th>
      <th>Dirección</th>   
      <th>Status</th>                
      <th>Acciones</th>                      
  </tr>
  </tfoot>
</table>