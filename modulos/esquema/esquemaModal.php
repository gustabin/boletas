<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo esquema</h5>
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
                    <label class="control-label">Texto 1 boleta</label>
                    <input class="form-control" id="texto1boleta" name="texto1boleta" type="text" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Texto 2 boleta</label>
                    <input class="form-control" id="texto2boleta" name="texto2boleta" type="text" required="">
                  </div>         
                  <div class="form-group">
                    <label class="control-label">Texto 3 boleta</label>
                    <input class="form-control" id="texto3boleta" name="texto3boleta" type="text" required="">
                  </div>  
                  <div class="form-group">
                    <label class="control-label">Texto 4 boleta</label>
                    <input class="form-control" id="texto4boleta" name="texto4boleta" type="text" required="">
                  </div>    
                  <div class="form-group">
                    <label class="control-label">Texto en nómina</label>
                    <textarea class="form-control" id="textoNomina" name="textoNomina" type="text" required="">
                      
                    </textarea>
                  </div>  
                  <div class="form-group">
                    <label for="logovertical">Logo vertical</label>
                    <select class="form-control" id="logovertical" name="logovertical" required="">
                      <option value="1">Arriba</option>
                      <option value="2">Centro</option>                    
                      <option value="3">Abajo</option>                    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="logohorizontal">Logo horizontal</label>
                    <select class="form-control" id="logohorizontal" name="logohorizontal" required="">
                      <option value="1">Izquierda</option>
                      <option value="2">Centro</option>                    
                      <option value="3">Derecha</option>                    
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