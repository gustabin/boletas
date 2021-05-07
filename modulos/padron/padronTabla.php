<?php 
require_once("../../tools/mypathdb.php");   
require_once('../../tools/sed.php');     
?>
<script src="padronFunciones.js"></script>

<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Documento</th>
      <th>Cuil</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Empresa</th>     
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>
  </thead>
  <tbody>
  <?php     
  $idsindicato = $_SESSION['idsindicato'];
  $sql = "SELECT * FROM padron WHERE status != 2 AND idsindicato = '$idsindicato'";
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $documento = $data['documento'];
    $cuil = $data['cuil'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $alta = $data['alta'];
    $status = $data['status'];  
    $idempresa = $data['idempresa'];      
    $alta = date("d-m-Y", strtotime($alta));

    $sql2 = "SELECT * FROM empresas WHERE status != 2 AND id = '$idempresa'";
    $resultado2 = mysqli_query($conn, $sql2);
    while($data2 = mysqli_fetch_array($resultado2))
    {
      $empresa = $data2['nombre'];
    }
  ?>
    <tr>      
      <td><?php echo $documento ?></td> 
      <td><?php echo $cuil ?></td> 
      <td><?php echo $nombre ?></td> 
      <td><?php echo $apellido ?></td> 
      <td><?php echo $empresa ?></td> 
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
      <th>Documento</th>
      <th>Cuil</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Empresa</th>     
      <th>Status</th>                      
      <th>Acciones</th>           
  </tr>
  </tfoot>
</table>