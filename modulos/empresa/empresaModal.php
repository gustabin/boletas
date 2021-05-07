<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nueva empresa</h5>
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
                    <label class="control-label">Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre" required="">
                  </div> 
                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Rama</label>
                        <select class="form-control" id="ramo" name="ramo" required="">
                          <?php 
                          $idsindicato = $_SESSION['idsindicato'];
                          $sql = "SELECT * FROM ramos WHERE idsindicato=$idsindicato ";
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
                    <label class="control-label">Sindicato</label>
                    <?php                     
                        $sql = "SELECT * FROM sindicatos WHERE status=1 AND id=$idsindicato";
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
                        <select class="form-control" id="seccional" name="seccional" required="">
                          <?php                          
                            $sql = "SELECT * FROM seccional WHERE status=1 AND idsindicato=$idsindicato";   
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
                  
                  <div class="form-group">
                    <label class="control-label">Cuit</label>
                    <input class="form-control cuitformato" id="cuit" name="cuit" type="text" placeholder="Cuit" required="">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Número</label>
                    <input class="form-control" id="numero" name="numero" type="text" placeholder="Número" required="">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Dirección</label>
                    <input class="form-control" id="direccion" name="direccion" type="text" placeholder="Dirección" required="">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Localidad</label>
                    <input class="form-control" id="localidad" name="localidad" type="text" placeholder="Localidad" required="">
                  </div>        
                  <div class="form-group">
                    <label class="control-label">Código Postal</label>
                    <input class="form-control" id="codpostal" name="codpostal" type="text" placeholder="Cód postal" required="">
                  </div>   
                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Provincia</label>
                        <select class="form-control" id="idprovincia" name="idprovincia" required="">
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
                    <label class="control-label">Email</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="Email" required="">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Contacto</label>
                    <input class="form-control" id="contacto" name="contacto" type="text" placeholder="Contacto" required="">
                  </div>                 

                  <div class="control-group-inline">
                    <label for="baja">Fecha de baja</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="fechabaja" name="fechabaja" class="form-control baja" maxlength="20" style="width: 100px" title="Fecha de baja"  /> 
                    
                   <label for="alta"  style="padding-left: 15px">Fecha de alta</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="fechaalta" name="fechaalta" class="form-control required alta" maxlength="20" style="width: 100px" title="Fecha de alta" placeholder="<?php echo date("d-m-Y");?>" disabled />                    
                  </div>     

                  <div class="form-group" style="padding-top: 15px">
                    <label for="modificacion">Fecha de modificación</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="fechamodificacion" name="fechamodificacion" class="form-control required modificacion" maxlength="20" style="width: 100px" title="Fecha de modificacion"  disabled>
                  </div>   
                 
                  <div class="form-group">
                    <label class="control-label">Empresa precedente</label>                    
                    <select class="form-control" id="idempresaprecedente" name="idempresaprecedente" disabled="">
                      <?php 
                      $sql2 = "SELECT * FROM empresas";
                      $resultado2 = mysqli_query($conn, $sql2);
                      while($data2 = mysqli_fetch_array($resultado2))
                      {
                        $id = $data2['id'];
                        $nombre = $data2['nombre'];       
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
                   <div class="form-group">
                    <label class="control-label">Empresa antecedente</label>                    
                    <select class="form-control" id="idempresaantecedente" name="idempresaantecedente" disabled="">
                      <?php 
                      $sql = "SELECT * FROM empresas";
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
                  <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="status" name="status" required=""> 
                      <option value="1" selected>Activo</option>
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