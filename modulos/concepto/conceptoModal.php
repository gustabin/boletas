<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo Concepto</h5>
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
                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Tipo de boleta</label>
                        <select class="form-control" id="idtipoboleta" name="idtipoboleta" type="text" placeholder="idtipoboleta" required="">
                          <?php 
                          $id = $_SESSION['idsindicato'];        
                          $sql = "SELECT * FROM tipoboleta WHERE idsindicato=$id";
                          $resultado = mysqli_query($conn, $sql);
                          while($data = mysqli_fetch_array($resultado))                          
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];
                            
                            // $claveEncriptada = SED::encryption($id);
                            // $id=$claveEncriptada;         
                          ?>      
                            <option value="<?php echo $id ?>"><?php echo $nombre ?></option> 
                          <?php 
                          } ?>
                        </select>
                      </div> 
                    </div>                    
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre" required="" style="text-transform:uppercase">
                  </div>     
                  <div class="form-group">
                    <label class="control-label">Descripción</label>
                    <input class="form-control" id="descripcion" name="descripcion" type="text" placeholder="Descripción" required="">
                  </div>            
                  <div class="form-group">
                    <label class="control-label">Formula</label>
                    <input class="form-control" id="formula" name="formula" type="text" placeholder="Formula">
                  </div>   
                  <div class="form-group">
                    <label class="control-label">Porcentaje</label>
                    <input class="form-control" id="porcentaje" name="porcentaje" type="text" placeholder="Porcentaje">
                  </div>     
                  <div class="control-group-inline">
                    <label class="control-label">Confirma</label>
                    <select class="form-control" id="confirma" name="confirma" required="" style="display: inline-block; width: 25%;">                          
                        <option value="1">Si</option>
                        <option value="0">No</option>                     
                    </select>

                    <label class="control-label" style="padding-left: 75px">Se imprime</label>
                    <select class="form-control" id="seimprime" name="seimprime" required="" style="display: inline-block; width: 25%;">
                        <option value="1">Si</option>
                        <option value="0">No</option>                     
                    </select>
                  </div>  
                  <div class="form-group" style="padding-top: 15px">
                    <label class="control-label">Importe cantidad</label>                   
                     <select  class="form-control" id="importecantidad" name="importecantidad" required="">                          
                        <option value="1">Importe</option>
                        <option value="2">Cantidad</option>                     
                    </select>
                  </div>    

                  <div class="form-group">
                    <label class="control-label">Concepto asociado</label>
                    <input class="form-control" id="conceptoasociado" name="conceptoasociado" type="text" placeholder="concepto asociado" style="text-transform:uppercase">
                  </div> 
                  <div class="form-group">
                    <label class="control-label">Débito/crédito</label>
                    <select  class="form-control" id="debitocredito" name="debitocredito" required="">                          
                        <option value="1">Suma</option>
                        <option value="2">Resta</option>                     
                    </select>
                  </div>                   
                  
                
                  <div class="form-group">
                    <label class="control-label">Fecha</label>
                    <input class="form-control" id="fecha" name="fecha" placeholder="<?php echo date("d-m-Y");?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="status">Estado</label>
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