<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Detalle empleado nómina</h5>
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
                    <label class="control-label">Nómina período</label>
                    <input class="form-control periodoformato" id="periodo" name="periodo" type="text" placeholder="Nómina" required="">
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