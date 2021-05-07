<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');    
?>
<script src="vencimientoFunciones.js"></script>
<table id="example" class="table table-bordered table-striped">
  <thead>
   <tr>
      <th>Periodo</th>
      <th style="font-size: 12px">Cuit 0</th>
      <th style="font-size: 12px">Cuit 1</th>
      <th style="font-size: 12px">Cuit 2</th>
      <th style="font-size: 12px">Cuit 3</th>
      <th style="font-size: 12px">Cuit 4</th>
      <th style="font-size: 12px">Cuit 5</th>
      <th style="font-size: 12px">Cuit 6</th>
      <th style="font-size: 12px">Cuit 7</th>
      <th style="font-size: 12px">Cuit 8</th>
      <th style="font-size: 12px">Cuit 9</th>
      <th>Status</th>                      
      <th>Acciones</th>                
    </tr>            
  </tr>
  </thead>
  <tbody>
  <?php       
  $idsindicato = $_SESSION['idsindicato'];  
  if ($_SESSION['rolid']==1) {
    $sql = "SELECT * FROM vencimiento WHERE status != 2";
  }else{
    $sql = "SELECT * FROM vencimiento WHERE status != 2 AND idsindicato = '$idsindicato'";
  }
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $periodo = $data['periodo'];
    $cuit0 = $data['cuit0'];
    $cuit1 = $data['cuit1'];
    $cuit2 = $data['cuit2'];
    $cuit3 = $data['cuit3'];
    $cuit4 = $data['cuit4'];
    $cuit5 = $data['cuit5'];
    $cuit6 = $data['cuit6'];
    $cuit7 = $data['cuit7'];
    $cuit8 = $data['cuit8'];
    $cuit9 = $data['cuit9'];
    $fecha = $data['fecha'];     
    $status = $data['status']; 

    $periodo = date("d-m-Y", strtotime($periodo));
  ?>
    <tr>      
      <td><?php echo $periodo ?></td> 
      <td><?php echo $cuit0 ?></td> 
      <td><?php echo $cuit1 ?></td> 
      <td><?php echo $cuit2 ?></td> 
      <td><?php echo $cuit3 ?></td> 
      <td><?php echo $cuit4 ?></td> 
      <td><?php echo $cuit5 ?></td> 
      <td><?php echo $cuit6 ?></td> 
      <td><?php echo $cuit7 ?></td> 
      <td><?php echo $cuit8 ?></td> 
      <td><?php echo $cuit9 ?></td> 
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
      <th>Periodo</th>
      <th style="font-size: 12px">Cuit 0</th>
      <th style="font-size: 12px">Cuit 1</th>
      <th style="font-size: 12px">Cuit 2</th>
      <th style="font-size: 12px">Cuit 3</th>
      <th style="font-size: 12px">Cuit 4</th>
      <th style="font-size: 12px">Cuit 5</th>
      <th style="font-size: 12px">Cuit 6</th>
      <th style="font-size: 12px">Cuit 7</th>
      <th style="font-size: 12px">Cuit 8</th>
      <th style="font-size: 12px">Cuit 9</th>
      <th>Status</th>                      
      <th>Acciones</th>                
    </tr>      
  </tfoot>
</table>