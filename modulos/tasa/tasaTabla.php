<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');
?>
<script src="tasaFunciones.js"></script>
<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Sindicato</th>
      <th>Vigencia desde</th>
      <th>Vigencia hasta</th>
      <th>Porcentaje</th>
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>                
  </tr>
  </thead>
  <tbody>
  <?php     
  $idsindicato = $_SESSION['idsindicato'];  
  if ($_SESSION['rolid']==1) {
    $sql = "SELECT * FROM tasainteres WHERE status != 2";
  }else{
    $sql = "SELECT * FROM tasainteres WHERE status != 2 AND idsindicato = '$idsindicato'";
  }
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $idsindicato = $data['idsindicato'];
    $vigenciadesde = $data['vigenciadesde'];
    $vigenciahasta = $data['vigenciahasta'];
    $porcentaje = $data['porcentaje'];
    $fecha = $data['fecha'];     
    $status = $data['status']; 

    $vigenciadesde = date("d-m-Y", strtotime($vigenciadesde));
    $vigenciahasta = date("d-m-Y", strtotime($vigenciahasta));

    $sql4 = "SELECT * FROM sindicatos WHERE id=$idsindicato";
    $resultado4 = mysqli_query($conn, $sql4);
    while($data4 = mysqli_fetch_array($resultado4))
    {
      $sindicato = $data4['razonsocial'];
    }  
  ?>
    <tr>      
      <td style="font-size: 12px"><?php echo $sindicato ?></td> 
      <td><?php echo $vigenciadesde ?></td> 
      <td><?php echo $vigenciahasta ?></td> 
      <td><?php echo $porcentaje ?></td> 
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
      <th>Sindicato</th>
      <th>Vigencia desde</th>
      <th>Vigencia hasta</th>
      <th>Porcentaje</th>
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>    
  </tfoot>
</table>