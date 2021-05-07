<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo pago por institución</h5>
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
                    <select class="form-control" id="idempresa" name="idempresa" required="">
                        <?php 
                        $sql = "SELECT * FROM empresas WHERE status!=2";
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
                          <option value="<?php echo $id ?>"><?php echo $empresa ?></option>
                        <?php 
                        } ?>
                    </select>
                  </div>  


                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Banco</label>
                        <select class="form-control" id="idbanco" name="idbanco" required="">
                          <?php 
                          $sql = "SELECT * FROM bancos";
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
                    <label class="control-label">Id boleta</label>
                    <input class="form-control" id="idboleta" name="idboleta" type="text" required="">
                  </div>   
                  <div class="form-group">
                   <label for="fechaalta">Fecha de pago</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="fechapago" name="fechapago" class="form-control required fechapago" maxlength="20" style="width: 100px" title="Fecha de pago" />                    
                  </div>                

                  <div class="form-group">
                    <label class="control-label">Importe</label>
                    <input class="form-control" id="importe" name="importe" type="text" required=""  onkeypress="return isNumberKey(event)" title="Importe">   
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