<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');
?>
<script src="conceptoFunciones.js"></script>

<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>    
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Tipo de Boleta</th>
      <th>Porcentaje</th>
      <th>Débito / crédito</th>
      <th>Status</th>                      
      <th>Acciones</th>                     
  </tr>
  </thead>
  <tbody>
  <?php 
  $idsindicato = $_SESSION['idsindicato'];
  $sql = "SELECT * FROM conceptos WHERE status != 2 AND idsindicato='$idsindicato'";
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $idsindicato = $data['idsindicato']; 
    $nombre = $data['nombre'];
    $descripcion = $data['descripcion'];
    $formula = $data['formula'];
    $porcentaje = $data['porcentaje'];
    $confirma = $data['confirma'];
    $importecantidad = $data['importecantidad'];
    $seimprime = $data['seimprime'];
    $conceptoasociado = $data['conceptoasociado'];
    $debitocredito = $data['debitocredito'];    
    $fecha = $data['fecha'];      
    $idtipoboleta = $data['idtipoboleta'];  
    if ($idtipoboleta) {
          $sql2 = "SELECT * FROM tipoboleta WHERE id=$idtipoboleta";          
          $resultado2 = mysqli_query($conn, $sql2);
          while($data2 = mysqli_fetch_array($resultado2))
          {
            $tipoboleta = isset($data2['nombre'])?$data2['nombre']:'0';
          }
    }else{
           $tipoboleta = 'No definida';
    }
          

    $status = $data['status'];    

    switch ($debitocredito) {
      case '1':
        $debitocredito  = "Suma";
        break;

      case '2':
        $debitocredito  = "Resta";
        break;
      
      default:
        break;
    }
    ?>
    <tr>      
      <td><?php echo $nombre ?></td> 
      <td><?php echo $descripcion ?></td> 
      <td><?php echo $tipoboleta ?></td> 
      <td><?php echo $porcentaje ?></td> 
      <td><?php echo $debitocredito ?></td> 
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
      <th>Descripción</th>
      <th>Tipo de Boleta</th>
      <th>Porcentaje</th>
      <th>Débito / crédito</th>
      <th>Status</th>                      
      <th>Acciones</th>               
  </tr>
  </tfoot>
</table>