<?php require_once("../../tools/mypathdb.php");   
      require_once('../../tools/sed.php');
?>
<!-- <script src="clienteFunciones.js"></script> -->

<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Id</th>
      <th>Banco</th>                       
  </tr>
  </thead>
  <tbody>
  <?php     
  $sql = "SELECT * FROM bancos";
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];    
    $nombre = $data['nombre'];    
    ?>
    <tr>      
      <td><?php echo $id ?></td> 
      <td><?php echo $nombre ?></td>
    </tr>
  <?php  
  }  
  mysqli_close($conn);
  ?>                  
  </tbody>
  <tfoot>
   <tr>
      <th>Id</th>
      <th>Banco</th>                       
  </tr>
  </tfoot>
</table>