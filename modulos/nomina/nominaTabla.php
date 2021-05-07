<?php 
require_once("../../tools/mypathdb.php");   
require_once('../../tools/sed.php');     
?>
<script src="nominaFunciones.js"></script>
<table id="example" class="table table-bordered table-striped">
  <thead>
  <tr>
      <th>Afiliado</th>
      <th>Sindicato</th>
      <th>Categoría</th>
      <th>Empresa</th>
      <th>Sueldo</th>
      <th>Fecha alta</th>
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>                
  </tr>
  </thead>
  <tbody>
  <?php       
  $idsindicato = $_SESSION['idsindicato'];  
  $idempresa = $_SESSION['idempresa'];    
  // if ($_SESSION['rolid']==1) {
  //   $sql = "SELECT * FROM nomina WHERE status != 2";
  // }else{
    $sql = "SELECT * FROM nomina WHERE status != 2 AND idsindicato = '$idsindicato'  AND idempresa = '$idempresa'";
  // }
   // var_dump($sql);
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $id = $data['id'];
    $idsindicato = $data['idsindicato'];
    $idempresa = $data['idempresa'];
    $cuil = $data['cuil'];
    $sueldo = $data['sueldo'];
    $idcategoriaempleado = $data['idcategoriaempleado'];
    $fechaalta = $data['fechaalta'];
    $fechamodificacion = $data['fechamodificacion'];
    $fecha = $data['fecha'];      
    $status = $data['status']; 

    $sql2 = "SELECT * FROM sindicatos WHERE id=$idsindicato";  
    $resultado2 = mysqli_query($conn, $sql2);
    while($data2 = mysqli_fetch_array($resultado2))
    {
      $sindicato = $data2['razonsocial'];
    }
       
    $sql3 = "SELECT * FROM padron WHERE cuil=$cuil";  

    $resultado3 = mysqli_query($conn, $sql3);
    while($data3 = mysqli_fetch_array($resultado3))
    {
      $nombre = $data3['nombre'];
      $apellido = $data3['apellido'];
    }

    $sql5 = "SELECT * FROM categoriaempleados WHERE id=$idcategoriaempleado";
    $resultado5 = mysqli_query($conn, $sql5);
    while($data5 = mysqli_fetch_array($resultado5))
    {
      $categoriaempleado = $data5['nombre'];
    }  

    $nombre = isset($nombre) ? $nombre = $nombre :  $nombre= ""; //ternaria
    $apellido = isset($apellido) ? $apellido = $apellido :  $apellido= ""; //ternaria
  ?>
    <tr>      
      <td><?php echo $nombre . " " . $apellido?></td> 
      <td style="font-size: 12px"><?php echo $sindicato ?></td> 
      <td style="font-size: 12px"><?php echo $categoriaempleado ?></td> 
      <td style="font-size: 12px"><?php echo $empresa ?></td> 
      <td style="font-size: 12px"><?php echo $sueldo ?></td> 
      <td style="font-size: 12px"><?php echo $fechaalta ?></td> 
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
      <th>Afiliado</th>
      <th>Sindicato</th>
      <th>Categoría</th>
      <th>Empresa</th>
      <th>Sueldo</th>
      <th>Fecha alta</th>
      <th>Status</th>                      
      <th>Acciones</th>                
  </tr>   
  </tfoot>
</table>