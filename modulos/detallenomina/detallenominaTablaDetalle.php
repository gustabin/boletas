<?php 
require_once("../../tools/mypathdb.php");   
require_once('../../tools/sed.php');   
$periodo = $_GET['periodo'];  
?>
<script src="detallenominaFunciones.js"></script>
<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Nomina</th>
      <th>CUIT</th>
      <th>CUIL</th>
      <th>Tipo de boleta</th>
      <th>id Concepto</th>
      <th>Acciones</th>         
  </tr>                
  </tr>
  </thead>
  <tbody>
  <?php        
  $concepto="";
  $cuit = $_SESSION['cuit'];  
  $sql = "SELECT * FROM historialnomina WHERE periodo = '$periodo' AND cuit= $cuit";  
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $periodo = $data['periodo'];
    $tipoboleta = $data['tipoboleta'];
    $cuil = $data['cuil'];
    $idconcepto = $data['idconcepto']; 
    //extraer conceptos 
    $exploded = explode(",", $idconcepto);
    $concepto="";
    $elementos=  substr_count($idconcepto, ','); 

    for ($i=0; $i < $elementos; $i++) { 
       $idconcepto= $exploded[$i];
       $sql2 = "SELECT * FROM conceptos WHERE id=$idconcepto";
       $resultado2 = mysqli_query($conn, $sql2);
       while($data2 = mysqli_fetch_array($resultado2))
       {
         $concepto .= $data2['nombre'] . " ";       
       }  
    }  
  ?>
    <tr>      
      <td><?php echo $periodo?></td> 
      <td><?php echo $cuit?></td> 
      <td><?php echo $cuil?></td> 
      <td><?php echo $tipoboleta?></td> 
      <td><?php echo $concepto ?></td> 
      <td>          
          <div class="text-center">
           <!-- <a href="historialDetalle.php?periodo=<?php //echo $periodo?>"> -->
              <button class="btn btn-primary btn-sm" 
                type="button" 
                data-toggle="modal" 
                data-target="#modal-default" 
                title="Modificar" 
                >        
                <i class="fas fa-pencil-alt"></i>
              </button>
            <!-- </a> -->
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
        <th>id Concepto</th>
        <th>Acciones</th>         
    </tr>        
  </tfoot>
</table>