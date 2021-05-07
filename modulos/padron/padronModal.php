<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nueva persona</h5>
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
                    <label class="control-label">Documento</label>
                    <input class="form-control" id="documento" name="documento" type="text" placeholder="Documento" required="">
                  </div> 
                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Tipo documento</label>
                        <select class="form-control" id="idtipodocumento" name="idtipodocumento" required="">
                          <?php 
                          $sql = "SELECT * FROM documentos WHERE status!=2";
                          $resultado = mysqli_query($conn, $sql);
                          while($data = mysqli_fetch_array($resultado))
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];       
                          ?>
                          <?php                          
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;                          
                          ?>
                            <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div> 
                    </div>                    
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Cuil</label>
                    <input class="form-control" id="cuil" name="cuil" type="text" placeholder="Cuil" required="">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre" required="">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Apellido</label>
                    <input class="form-control" id="apellido" name="apellido" type="text" placeholder="Apellido" required="">
                  </div> 
                  <!-- aqui va el sexo OJO -->
                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo" required="">          
                            <option value="1">Masculino</option>    
                            <option value="2">Femenino</option>
                        </select>
                      </div> 
                    </div>                    
                  </div>   
                  <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <input class="form-control" id="telefono" name="telefono" type="text" placeholder="Teléfono" required="">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Dirección</label>
                    <input class="form-control" id="direccion" name="direccion" type="text" placeholder="Dirección" required="">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Localidad</label>
                    <input class="form-control" id="localidad" name="localidad" type="text" placeholder="Localidad" required="">
                  </div>                  
                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Provincia</label>
                        <select class="form-control" id="provincia" name="provincia" required="">
                          <?php 
                          $sql = "SELECT * FROM provincias";
                          $resultado = mysqli_query($conn, $sql);
                          while($data = mysqli_fetch_array($resultado))
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];       
                          ?>
                          <?php                          
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;                          
                          ?>
                            <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div> 
                    </div>                    
                  </div> 
                  <style>
                    .form-control{
                      display: inline-block;
                    }
                  </style>
                  
                  <div class="form-group">
                    <label for="nacimiento">Fecha de nacimiento</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="nacimiento" name="nacimiento" class="form-control required nacimiento" maxlength="20" style="width: 100px" title="Fecha de nacimiento" />  
                  </div>   

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


                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Seccional</label>
                        <select class="form-control" id="idseccional" name="idseccional" required="">
                          <?php                          
                            $id = $_SESSION['idsindicato'];
                            $sql = "SELECT * FROM seccional WHERE status=1 AND idsindicato=$id";    
                            
                            $resultado = mysqli_query($conn, $sql);
                            while($data = mysqli_fetch_array($resultado))
                            {
                              $id = $data['id'];
                              $nombre = $data['nombre'];       
                            ?>
                            <?php 
                            $claveEncriptada = SED::encryption($id);
                            $id=$claveEncriptada;
                            ?>
                              <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                            <?php 
                            } 
                          ?>
                        </select>
                      </div> 
                    </div>                    
                  </div>    

                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Empresa</label>
                        <select class="form-control" id="idempresa" name="idempresa" required="">
                          <?php 
                          $id = $_SESSION['idsindicato'];
                          $sql = "SELECT * FROM empresas WHERE status=1 AND idsindicato=$id";
                          $resultado = mysqli_query($conn, $sql);
                          while($data = mysqli_fetch_array($resultado))
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];       
                          ?>
                          <?php 
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;
                          ?>
                            <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div> 
                    </div>                    
                  </div>

                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Estado civil</label>
                        <select class="form-control" id="idestadocivil" name="idestadocivil" required="">
                          <?php 
                          $sql = "SELECT * FROM estadocivil";
                          $resultado = mysqli_query($conn, $sql);
                          while($data = mysqli_fetch_array($resultado))
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];       
                          ?>
                          <?php                          
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;                          
                          ?>
                            <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div> 
                    </div>                    
                  </div> 

                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Nacionalidad</label>
                        <select class="form-control" id="idnacionalidad" name="idnacionalidad" required="">
                          <?php 
                          $sql = "SELECT * FROM nacionalidades";
                          $resultado = mysqli_query($conn, $sql);
                          while($data = mysqli_fetch_array($resultado))
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];       
                          ?>
                          <?php                          
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;                          
                          ?>
                            <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div> 
                    </div>                    
                  </div> 

                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Situación de revista</label>
                        <select class="form-control" id="idsituacionrevista" name="idsituacionrevista" required="">
                          <?php 
                          $sql = "SELECT * FROM situacionrevista";
                          $resultado = mysqli_query($conn, $sql);
                          while($data = mysqli_fetch_array($resultado))
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];       
                          ?>
                          <?php                          
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;                          
                          ?>
                            <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div> 
                    </div>                    
                  </div> 

                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Categoría empleado</label>
                        <select class="form-control" id="idcategoriaempleado" name="idcategoriaempleado" required="">
                          <?php 
                          $id = $_SESSION['idsindicato'];
                          $sql = "SELECT * FROM categoriaempleados WHERE idsindicato='$id'";
                          $resultado = mysqli_query($conn, $sql);
                          while($data = mysqli_fetch_array($resultado))
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];       
                          ?>
                          <?php                          
                          $claveEncriptada = SED::encryption($id);
                          $id=$claveEncriptada;                          
                          ?>
                            <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div> 
                    </div>                    
                  </div> 

                  <div class="control-group-inline">
                    <label for="baja">Fecha de baja</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="baja" name="baja" class="form-control baja" maxlength="20" style="width: 100px" title="Fecha de baja" disabled /> 
                    
                   <label for="alta"  style="padding-left: 15px">Fecha de alta</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="alta" name="alta" class="form-control required alta" maxlength="20" style="width: 100px" title="Fecha de alta" placeholder="<?php echo date("d-m-Y");?>" disabled />                    
                  </div>     

                  <div class="form-group" style="padding-top: 15px">
                    <label for="modificacion">Fecha de modificación</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="modificacion" name="modificacion" class="form-control required modificacion" maxlength="20" style="width: 100px" title="Fecha de modificacion"  disabled>
                  </div>   
                  
                  <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="status" name="status" required=""> 
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>                    
                    </select>
                  </div>
                  <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i><span id="btnTextCancelar">Cancelar</span></a>
                  </div>
                </form>                
              </div>            
            </div>
        </div>      
      </div>
    </div>
  </div>
 </section>