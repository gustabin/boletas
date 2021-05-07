<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');
?>
<script src="detallepagoFunciones.js"></script>
<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Nomina</th>
      <th>CUIT</th>
      <th>CUIL</th>
      <th>Tipo de boleta</th>
      <th>Acciones</th>         
  </tr>                
  </tr>
  </thead>
  <tbody>
  <?php         
  $concepto="";
  $cuit = $_SESSION['cuit'];  
  $periodo = $_GET['periodo'];  
  $sql = "SELECT * FROM historialnomina WHERE periodo = '$periodo' AND cuit= $cuit";  
  // var_dump($sql);
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $periodo = $data['periodo'];
    $tipoboleta = $data['tipoboleta'];
    $cuil = $data['cuil'];
    $idconcepto = $data['idconcepto']; 

    $claveEncriptada = SED::encryption($id);
    $id=$claveEncriptada;
  ?>
    <tr>      
      <td><?php echo $periodo?></td> 
      <td><?php echo $cuit?></td> 
      <td><?php echo $cuil?></td> 
      <td><?php echo $tipoboleta?></td> 
      <td>          
          <div class="text-center">
              <button class="btn btn-primary btn-sm" 
                type="button" 
                data-toggle="modal" 
                data-target="#modal-default" 
                title="Modificar" 
                onclick="Modificar('<?php echo $id ?>','<?php echo $_SESSION['token'] ?>')">
                <i class="fas fa-pencil-alt"></i>
              </button>
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
        <th>Nomina</th>
        <th>CUIT</th>
        <th>CUIL</th>
        <th>Tipo de boleta</th>
        <th>Acciones</th>         
    </tr>        
  </tfoot>
</table>