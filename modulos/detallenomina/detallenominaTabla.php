<?php 
require_once("../../tools/mypathdb.php");   
require_once('../../tools/sed.php');     
?>
<script src="detallenominaFunciones.js"></script>
<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Nomina</th>
      <th>CUIT</th>
      <th>Acciones</th>                
  </tr>                
  </tr>
  </thead>
  <tbody>
  <?php       
  $cuit = $_SESSION['cuit'];

  $sql = "SELECT DISTINCT periodo FROM historialnomina WHERE cuit= $cuit";

   
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
     $periodo = $data['periodo'];
  ?>
    <tr>      
      <td><?php echo $periodo?></td> 
      <td><?php echo $cuit?></td> 
     
      <td>          
          <div class="text-center">
           <a href="../detallepago/index.php?periodo=<?php echo $periodo?>">
              <button class="btn btn-primary btn-sm" 
                type="button" 
                data-toggle="modal" 
                data-target="#modal-default" 
                title="Modificar" 
                >        
                <i class="fas fa-pencil-alt"></i>
              </button>
            </a>
              <button class="btn btn-info btn-sm" 
                type="button" 
                title="Copiar" 
                onclick="Copiar('<?php echo $periodo ?>','<?php echo $_SESSION['token'] ?>')">
              <i class="fas fa-copy"></i></button> 
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
        <th>Acciones</th>                
    </tr>        
  </tfoot>
</table>