<!-- Main content -->
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">        
        <div class="modal-body"> 
          <div class="tile">            
              <div class="tile-body">                
                <form class="form-horizontal" id="formDefault">                  
                  <input type="hidden" name="id" id="id" value="">
                  <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre del contacto" required="" disabled="">
                  </div>    
                  <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <input class="form-control" id="telefono" name="telefono" type="text" placeholder="Teléfono" required="" disabled="">
                  </div>   
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="Email" required="" disabled="">
                  </div>            
                  <div class="form-group">
                    <label class="control-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="2" placeholder="Mensaje" required="" disabled=""></textarea>
                  </div>                  
                  <div class="form-group">
                    <label class="control-label">Fecha</label>
                    <input class="form-control" id="fecha" name="fecha" placeholder="<?php echo date("d-m-Y");?>" disabled>
                  </div>
                  
                  <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-primary" type="submit" style="display: none"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i><span id="btnTextCancelar">Cancelar</span></a>
                  </div>
                </form>                
              </div>            
            </div>
        </div>      
      </div>
    </div>
  </div>
 </section>