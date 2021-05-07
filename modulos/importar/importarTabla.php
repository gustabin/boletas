<div class="outer-container">
    <form action="" method="post"
        name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div>
            <label>Elija Archivo Excel</label> <input type="file" name="file"
                id="file" accept=".xls,.xlsx">
            <button type="submit" id="submit" name="import"
                class="btn-submit">Importar Registros</button>  
            <button class="btn btn-primary btn-sm" type="button" title="Ayuda" onclick="Ayuda()">
              <i class="fas fa-question-circle"></i></button>         
        </div>
    </form>        
</div>

<?php if(!empty($message)) {  ?>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?> alert alert-<?php echo $type?>">
        <h2><?php echo $message;  ?></h2>
    </div>
<?php } ?>
<hr>
<br>  

 <table id="example" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>Documento</th>
      <th>Cuil</th>
      <th>Nombre</th>
      <th>Apellido</th>      
      <th>Nacimiento</th>   
      <th>Alta</th>   
      <th>Baja</th>             
    </tr>
    </thead>
    <tbody> 
    <?php 
    $sql = "SELECT * FROM padron WHERE status != 2";
    $resultado = mysqli_query($conn, $sql);
    while($data = mysqli_fetch_array($resultado))
    {
      $id = $data['id'];
      $documento = $data['documento'];
      $cuil = $data['cuil'];
      $nombre = $data['nombre'];
      $apellido = $data['apellido'];
      $telefono = $data['telefono'];
      $nacimiento = $data['nacimiento'];
      $alta = $data['alta'];
      $status = $data['status'];  

    ?>     
    <tr>
      <td><?php echo $documento ?></td> 
      <td><?php echo $cuil ?></td> 
      <td><?php echo $nombre ?></td> 
      <td><?php echo $apellido ?></td> 
      <td><?php echo $nacimiento ?></td> 
      <td><?php echo $alta ?></td> 
      <td><?php echo $baja ?></td> 
      </td>
    </tr>    
    <?php 
    }
    mysqli_close($conn);
    ?>
    </tbody>
    <tfoot>
    <tr>
      <th>Documento</th>
      <th>Cuil</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Nacimiento</th>   
      <th>Alta</th>    
      <th>Baja</th>       
    </tr>
    </tfoot>
</table>