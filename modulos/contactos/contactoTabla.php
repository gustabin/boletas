<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');
?>
<script src="contactoFunciones.js"></script>

<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>      
      <th>Nombre</th>
      <th>Telefono</th>
      <th>Email</th>
      <th>Mensaje</th>
      <th>Fecha</th>                   
      <th>Acciones</th>                
  </tr>
  </thead>
  <tbody>
  <?php     
  $sql = "SELECT * FROM contactos WHERE status !=1";
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono']; 
    $email = $data['email'];     
    $mensaje = $data['mensaje'];
    $status = $data['status']; 
    $fecha = $data['fecha'];         
    ?>
    <tr style="font-size: 10px">  
      <td><?php echo $nombre ?></td>
      <td><?php echo $telefono ?></td>
      <td><?php echo $email ?></td>        
      <td style="font-size: 12px"><?php echo $mensaje ?></td>        
      <td style="width: 80px"><?php echo $fecha ?></td>         
      <td style="width: 100px">          
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
                onclick="Modificar('<?php echo $id ?>')">              
              <i class="fas fa-eye"></i></button>

              <button class="btn btn-danger btn-sm" 
                type="button" 
                title="Eliminar" 
                onclick="Eliminar('<?php echo $id ?>')">
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
      <th>Telefono</th>
      <th>Email</th>
      <th>Mensaje</th>
      <th>Fecha</th>                      
      <th>Acciones</th>                    
  </tr>
  </tfoot>
</table>