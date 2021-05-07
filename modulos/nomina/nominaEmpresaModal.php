<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?> 
  <?php     
  $idsindicato = $_SESSION['idsindicato'];  
 
  $sql = "SELECT * FROM esquema WHERE status != 2 AND idsindicato = '$idsindicato'";
  $resultado = mysqli_query($conn, $sql);
  while($data = mysqli_fetch_array($resultado))
  {
    $textoNomina = $data['textoNomina'];    
  }  
  ?>
<section class="content">
  <div class="modal fade" id="modalEmpresa-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Empresa trabajador</h5>
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
                        <label class="control-label">CUIT</label>
                        <input type="text" class="form-control redondeado" placeholder="CUIT" name="cuit" id="cuit" required="" value="">
                      </div> 
                      <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" class="form-control redondeado" placeholder="Password" name="password" id="password" value="" required="">
                      </div>                                    
                      <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>
                          <span id="btnText">Acceder</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal">
                          <i class="fa fa-fw fa-lg fa-times-circle"></i><span id="btnTextCancelar">Cancelar</span></a>
                      </div>
                      <div class="row" style="padding-top: 10px">
                        <div class="col-7">   
                            <a href="../empresa">¿Su empresa no está?</a>
                        </div>   
                      </div>
                      <div class="row" style="padding-top: 10px">
                        <div class="col-7">   
                            <a href="#" onclick="MostrarRecuperar()">Olvide mi password</a>
                        </div>   
                      </div>
                    </form>                  
                <div class="row">
                     <label for="" style="font-weight: 100"><?php echo $textoNomina ?></label> 
                </div>  
              </div>  
               <div class="card"  id="recuperar" style="display: none">
                  <div class="card-body login-card-body">
                      <p class="login-box-msg">Formulario de Recuperación de clave</p>     
                      <div class="list-group-item">
                        Indique su usuario (correo electrónico):
                      </div>
                      <div class="list-group-item">
                          <h4 class="list-group-item-heading"> 
                          <form class="form-horizontal" id="formRecuperar">            
                              <div class="input-group mb-3">
                                  <input type="email" class="form-control redondeado" placeholder="Email" name="usuario" id="usuario" required="" value="">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                    </div>
                                  </div>
                              </div>       
                             
                              <div class="col-12">           
                                  <button type="submit" class="btn btn-primary btn-block" onclick="Recuperar()">Recuperar</button>
                              </div>
                          </form>
                          </h4>
                      </div>      
                  </div>
                </div>          
            </div>
        </div>      
      </div>
    </div>
  </div>
 </section>

