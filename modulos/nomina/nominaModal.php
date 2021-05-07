<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo trabajador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>  
        <div class="modal-body"> 
          <div class="tile">     
              <div class="tile-body">                
                <form class="form-horizontal" id="formDefault">                   
                  <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">                 
                  <input type="hidden" name="id" id="id" value="">
                  <div class="form-group">
                    <label class="control-label">Sindicato</label>
                    <?php 
                   
                        $id = $_SESSION['idsindicato'];                      
                        $sql = "SELECT * FROM sindicatos WHERE status=1 AND id=$id";
                        $resultado = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($resultado))
                        {
                          $id = $data['id'];
                          $sindicato = $data['razonsocial'];       
                                                 
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;  
                        } ?>
                        <input type="hidden"  id="idsindicato" name="idsindicato" class="form-control" maxlength="200" style="width: 100%" title="idsindicato" value="<?php echo $id?>" /> 
                        <input type="text"  id="sindicato" name="sindicato" class="form-control required" maxlength="200" style="width: 100%" title="Sindicato" value="<?php echo $sindicato?>" disabled/> <?php
                    ?>                    
                  </div> 

                   <div class="form-group">
                    <label class="control-label">Empresa</label>
                    <?php 
                      $id = $_SESSION['idempresa'];
                      $sql = "SELECT * FROM empresas WHERE id=$id AND status=1";    
                      $resultado = mysqli_query($conn, $sql);
                      while($data = mysqli_fetch_array($resultado))
                      {
                        $id = $data['id'];
                        $empresa = $data['nombre']; 
                      ?>
                      <?php                          
                        $claveEncriptada = SED::encryption($id);
                        $id=$claveEncriptada;                          
                      ?>                           
                      <?php 
                    } ?>
                     <input type="hidden"  id="idempresa" name="idempresa" class="form-control" maxlength="200" style="width: 100%" title="idempresa" value="<?php echo $id?>" /> 
                      <input type="text"  id="empresa" name="empresa" class="form-control required" maxlength="200" style="width: 100%" title="empresa" value="<?php echo $empresa?>" disabled/> 
                  </div>                       

                  <div class="form-group">
                    <label class="control-label">Cuil Afiliado</label>
                     <span class="form-group" id="encontrado">
                         <i class="fas fa-check"></i>
                     </span>
                     <input type="text"  id="cuil" name="cuil" class="form-control required" maxlength="200" style="width: 100%" autocomplete="off" onKeyUp="buscar();"  onkeypress="validar(event)" />  
                      <div id="resultadoBusqueda"></div>   
                      <div id="cantidadresultado"></div>                     
                  </div>   

                  <div class="form-group" style="display: none">
                    <label class="control-label">Id Padron</label>                    
                     <input type="text"  id="idpadron" name="idpadron" class="form-control required" maxlength="200" style="width: 100%" />
                  </div>  

                  <div class="form-group" id="empleado">
                    <label class="control-label">Categoria empleado</label>
                     <select name="idcategoriaempleado" id="idcategoriaempleado" class="form-control" required="" onclick="seleccionar();">
                        <?php 
                        $id = $_SESSION['idsindicato'];
                        $sql = "SELECT * FROM categoriaempleados WHERE idsindicato=$id";
                        $resultado = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($resultado))
                        {
                          $id = $data['id'];
                          $usuario = $data['nombre'];       
                        ?>
                        <?php                          
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;                          
                        ?>
                          <option value="<?php echo $id ?>"><?php echo $usuario ?></option>
                        <?php 
                        } ?>
                    </select>
                  </div>                                   
                   
                  <div class="form-group">
                     <label class="control-label">Sueldo</label>
                     <input type="text"  id="sueldo" name="sueldo" class="form-control required sueldo" maxlength="20" style="width: 100px" title="Sueldo" />  
                  </div>  

                  <div class="form-group" id="divfechaalta"> 
                   <label for="fechaalta">Fecha de alta</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="txtfechaalta" name="txtfechaalta" class="form-control fechaalta" maxlength="20" style="width: 100px" title="Fecha de alta" />                    
                  </div>                      
                  
                  <div class="form-group" id="divfechamodificacion">
                    <label for="fechamodificacion">Fecha de modificación</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="fechamodificacion" name="fechamodificacion" class="form-control fechamodificacion" maxlength="20" style="width: 100px" title="Fecha de modificación" /> 
                  </div>                              
                   
                  <div class="form-group" id="divusuariomodificacion">
                    <label class="control-label">Usuario modificación</label>                    
                    <select class="form-control" id="idusuariomodificacion" name="idusuariomodificacion" disabled="">
                        <?php 
                        $sql = "SELECT * FROM usuario";
                        $resultado = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($resultado))
                        {
                          $id = $data['id'];
                          $usuario = $data['nombre'];       
                        ?>
                        <?php                          
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;                          
                        ?>
                          <option value="<?php echo $id ?>"><?php echo $usuario ?></option>
                        <?php 
                        } ?>
                    </select>
                  </div>   
                 
                  <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="status" name="status" required="" onclick="seleccionar();">
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>                    
                    </select>
                  </div>                  
                  <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-secondary" type="submit" disabled="true"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i><span id="btnTextCancelar">Cancelar</span></a>
                  </div>
                </form> 
              </div>            
          </div>            
        </div>      
      </div>
    </div>
  </div>
 </section>