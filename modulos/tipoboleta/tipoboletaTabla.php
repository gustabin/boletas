<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');
?>
<script src="tipoboletaFunciones.js"></script>
<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>      
      <th>Nombre</th> 
      <th>Sindicato</th> 
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>
  </thead>
  <tbody>
  <?php     
  $idsindicato = $_SESSION['idsindicato'];
  
  $sql = "SELECT * FROM tipoboleta WHERE status != 2 AND idsindicato = '$idsindicato'";
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $idsindicato = $data['idsindicato']; 
    $nombre = $data['nombre'];
    $fecha = $data['fecha'];      
    $status = $data['status'];    

    $sql2 = "SELECT * FROM sindicatos WHERE id=$idsindicato";
    $resultado2 = mysqli_query($conn, $sql2);
    while($data2 = mysqli_fetch_array($resultado2))
    {
      $sindicato = $data2['razonsocial'];
    }
    ?>
    <tr>      
      <td><?php echo $nombre ?></td> 
      <td><?php echo $sindicato ?></td>       
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
      <th>Sindicato</th> 
      <th>Status</th>                      
      <th>Acciones</th>                 
  </tr>
  </tfoot>
</table>