<?php require_once("../../tools/mypathdb.php");  
      require_once('../../tools/sed.php');
?>
<script src="esquemaFunciones.js"></script>
<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Sindicato</th>
      <th>Logo vertical</th>
      <th>Logo horizontal</th>
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>                
  </tr>
  </thead>
  <tbody>
  <?php     
  $idsindicato = $_SESSION['idsindicato'];  
  if ($_SESSION['rolid']==1) {
    $sql = "SELECT * FROM esquema WHERE status != 2";
  }else{
    $sql = "SELECT * FROM esquema WHERE status != 2 AND idsindicato = '$idsindicato'";
  }
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $idsindicato = $data['idsindicato'];
    $texto1boleta = $data['texto1boleta'];
    $texto2boleta = $data['texto2boleta'];
    $texto3boleta = $data['texto3boleta'];
    $texto4boleta = $data['texto4boleta'];
    $textoNomina = $data['textoNomina'];
    $logovertical = $data['logovertical'];
    $logohorizontal = $data['logohorizontal'];
    $fecha = $data['fecha'];      
    $status = $data['status']; 
   
        $sql4 = "SELECT * FROM sindicatos WHERE id=$idsindicato";
        $resultado4 = mysqli_query($conn, $sql4);
        while($data4 = mysqli_fetch_array($resultado4))
        {
          $sindicato = $data4['razonsocial'];
        }  

    switch ($logovertical) {
      case '1':
        $logovertical = "Arriba";
        break;
      case '2':
        $logovertical = "Centro";
        break;
      case '3':
        $logovertical = "Abajo";
        break; 
    }
    switch ($logohorizontal) {
      case '1':
        $logohorizontal = "Izquierda";
        break;
      case '2':
        $logohorizontal = "Centro";
        break;
      case '3':
        $logohorizontal = "Derecha";
        break; 
    }
  ?>
    <tr>      
      <td><?php echo $sindicato ?></td> 
      <td><?php echo $logovertical ?></td> 
      <td><?php echo $logohorizontal ?></td> 
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
      <th>Logo vertical</th>
      <th>Logo horizontal</th>
      <th>Status</th>                      
      <th>Acciones</th>                
   </tr>   
  </tfoot>
</table>