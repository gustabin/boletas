<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo usuario</h5>
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
                   <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Empresa</label>
                        <select class="form-control" id="idempresa" name="idempresa" required="">
                          <?php 
                          $idsindicato = $_SESSION['idsindicato'];
                          $sql = "SELECT * FROM empresas WHERE status != 2 AND idsindicato = '$idsindicato'";
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
                    <label class="control-label">Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre" required="">
                  </div>                  
                  <div class="form-group">
                    <label class="control-label">Apellido</label>
                    <input class="form-control" id="apellido" name="apellido" type="text" placeholder="Apellido" required="">
                  </div>    
                  <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <input class="form-control" id="telefono" name="telefono" type="text" placeholder="Teléfono" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="Email" required="">
                  </div>                 
                  <div class="form-group">
                    <label class="control-label">Cuil</label>
                    <input class="form-control" id="cuil" name="cuil" type="text" placeholder="Cuil" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Dirección</label>
                    <input class="form-control" id="direccion" name="direccion" type="text" placeholder="Dirección" required="">
                  </div>

                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Rolid</label>
                        <select class="form-control" id="rolid" name="rolid" type="text" placeholder="Rol id"required="">
                          <?php 
                          $sql = "SELECT * FROM roles WHERE status != 2";
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

                <div class="row">
                  <div class="col-sm-12">                      
                    <div class="form-group" id="campoPassword" name="campoPassword" style="display: none"> 
                      <label class="control-label">Password</label>                        
                      <form action="cambiarPassword.php" method="POST"/>
                        <input type="hidden" name="idPassword" id="idPassword" value=""> 
                        <input class="form-control" id="txtPassword" name="txtPassword" type="password" placeholder="Password" required=""> 
                        <input type="submit" name="cambiarPassword" value="Establecer password"/>
                      </form>
                    </div>   
                  </div>                    
                </div> 
              </div>            
            </div>
        </div>      
      </div>
    </div>
  </div>
 </section>