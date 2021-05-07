<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo periodo de vencimiento</h5>
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
                   <label for="periodo">Período</label>
                    <i class="fa fa-calendar"></i>
                    <input type="text"  id="periodo" name="periodo" class="form-control required periodo" maxlength="20" style="width: 100px" title="Período" />                    
                  </div>  
                  
                  <div class="form-group">
                    <label class="control-label">Cuit 0</label>
                    <input class="form-control" id="cuit0" name="cuit0" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 0">   
                  </div>    

                  <div class="form-group">
                    <label class="control-label">Cuit 1</label>
                    <input class="form-control" id="cuit1" name="cuit1" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 1">   
                  </div>  

                  <div class="form-group">
                    <label class="control-label">Cuit 2</label>
                    <input class="form-control" id="cuit2" name="cuit2" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 2">   
                  </div>   

                  <div class="form-group">
                    <label class="control-label">Cuit 3</label>
                    <input class="form-control" id="cuit3" name="cuit3" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 3">   
                  </div> 

                  <div class="form-group">
                    <label class="control-label">Cuit 4</label>
                    <input class="form-control" id="cuit4" name="cuit4" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 4">   
                  </div> 

                  <div class="form-group">
                    <label class="control-label">Cuit5</label>
                    <input class="form-control" id="cuit5" name="cuit5" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 5">   
                  </div> 

                  <div class="form-group">
                    <label class="control-label">Cuit 6</label>
                    <input class="form-control" id="cuit6" name="cuit6" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 6">   
                  </div> 

                  <div class="form-group">
                    <label class="control-label">Cuit 7</label>
                    <input class="form-control" id="cuit7" name="cuit7" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 7">   
                  </div> 

                  <div class="form-group">
                    <label class="control-label">Cuit 8</label>
                    <input class="form-control" id="cuit8" name="cuit8" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 8">   
                  </div> 

                  <div class="form-group">
                    <label class="control-label">Cuit 9</label>
                    <input class="form-control" id="cuit9" name="cuit9" type="text" required=""  onkeypress="return isNumberKey(event)" title="Cuit 9">   
                  </div> 

                  <div class="form-group">
                    <label class="control-label">Fecha</label>
                    <input class="form-control" id="fecha" name="fecha" placeholder="<?php echo date("d-m-Y");?>" disabled>
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