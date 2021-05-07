<?php 
require_once("../../tools/mypathdb.php");   
require_once('../../tools/sed.php');     
?>
<script src="empresaFunciones.js"></script>

<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Empresa</th>
      <th>Cuit</th>
      <th>Ramo</th>
      <th>Contacto</th>      
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>
  </thead>
  <tbody>
  <?php     
  $idsindicato = $_SESSION['idsindicato'];
  $sql = "SELECT * FROM empresas WHERE status != 2 AND idsindicato = '$idsindicato'";
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $nombre = $data['nombre'];
    $idsindicato = $data['idsindicato'];
    $cuit = $data['cuit'];
    $idramo = $data['ramo'];
    $idprovincia = $data['idprovincia'];
    $contacto = $data['contacto']; 
    $fechaalta = $data['fechaalta']; 
    $fechaalta = date("d-m-Y", strtotime($fechaalta));
    $status = $data['status']; 

    $mascaracuit =substr($cuit,0,2) ."-". substr($cuit,2,8) ."-". substr($cuit,10);
    $cuit = $mascaracuit;

    $sql4 = "SELECT * FROM ramos WHERE id=$idramo";

    $resultado4 = mysqli_query($conn, $sql4);
    while($data4 = mysqli_fetch_array($resultado4))
    {
      $ramo = $data4['nombre'];
    }

    $sql5 = "SELECT * FROM provincias WHERE id=$idprovincia";
    $resultado5 = mysqli_query($conn, $sql5);
    while($data5 = mysqli_fetch_array($resultado5))
    {
      $provincia = $data5['nombre'];
    }
  ?>
    <tr>      
      <td ><?php echo $nombre ?></td> 
      <td style="font-size: 12px"><?php echo $cuit ?></td> 
      <td><?php echo $ramo ?></td> 
      <td style="font-size: 12px"><?php echo $contacto ?></td>
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
      <th>Cuit</th>
      <th>Ramo</th>
      <th>Contacto</th> 
      <th>Status</th>                      
      <th>Acciones</th>          
  </tr>
  </tfoot>
</table>