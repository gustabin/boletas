<?php 
  require_once('../../tools/mypathdb.php'); 
  require_once('../../tools/sed.php');  
?>
<section class="content">
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Detalle de pago del empleado</h5>
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
                    <div class="col-4">
                      <div class="icheck-primary">
                       <label class="control-label">Nómina</label>
                       <input class="form-control" id="periodo" name="periodo" type="text" required="" readonly>
                      </div>
                    </div>
                    <div class="col-4">           
                       <label class="control-label">CUIT</label>
                       <input class="form-control" id="cuit" name="cuit" type="text" required="" readonly>
                    </div>   
                    <div class="col-4">           
                       <label class="control-label">CUIL</label>
                    <input class="form-control" id="cuil" name="cuil" type="text" required="" readonly>
                    </div>         
                  </div>      

                  <div class="form-inline" style="padding-top: 15px">
                    <label for="sueldo">Sueldo</label>                    
                    <input type="text"  id="sueldo" name="sueldo" class="form-control required sueldo" maxlength="20" style="width: 100px" readonly title="Sueldo" />  
                  </div>      

                  <div class="form-group" style="padding-top: 15px">              
                    <div class="row">
                        <div class="col-6">  
                          <label style="font-weight: normal;">Tipo de boleta</label> 
                        </div>
                        <div class="col-6">
                           <?php 
                          $id = $_SESSION['idsindicato'];        
                          $sql = "SELECT * FROM tipoboleta WHERE idsindicato=$id";
                          $resultado = mysqli_query($conn, $sql);
                          $contadorTipoBoleta=1;
                          while($data = mysqli_fetch_array($resultado))                          
                          {
                            $id = $data['id'];
                            $nombre = $data['nombre'];
                          ?>      
                            <input type="checkbox" id="chkTipoBoleta<?php echo $contadorTipoBoleta ?>" value="<?php echo $id ?>" checked 
                            onclick="actualizarTipoBoleta(this.checked, this.value, this.id);">
                            <label for=""><?php echo $nombre ?></label></br>
                          <?php 
                          $contadorTipoBoleta++;
                          } ?>
                        </div>                             
                      </div> 
                  </div>                         

                  <div class="form-group">                  
                      <?php        
                      // Calcula filas
                      $idsindicato = $_SESSION['idsindicato'];
                      $sql2 = "SELECT * FROM conceptos WHERE idsindicato=$idsindicato AND seimprime=1 AND status=1";
                      $resultado2 = mysqli_query($conn, $sql2);
                      $filas = mysqli_num_rows($resultado2);
                      $_SESSION['filas']=$filas;

                      for ($i=1; $i <= $filas; $i++) { 
                      ?>
                          <div class="row" id="fila<?php echo $i?>" name="fila<?php echo $i?>">
                            <div class="col-6">  
                                <label class="form-check-label"  id="idtipoboleta<?php echo $i?>" style="font-weight: normal;"> </label>
                                <input type="text"  id="nombreconcepto<?php echo $i?>" name="nombreconcepto<?php echo $i?>" 
                                style="font-weight: normal; width: 150px; border: none" readonly  />  
                                <input type="hidden"  id="conceptoOculto<?php echo $i?>" name="conceptoOculto<?php echo $i?>"  />
                                <label class="form-check-label"  id="formulaconcepto<?php echo $i?>" style="font-weight: normal;"> </label>
                                %           
                            </div>
                            <div class="col-3">
                                  <input type="checkbox" id="concepto<?php echo $i?>" onclick="actualizarValor(this.checked, this.value, this.id);" />  
                                  <span><label id="subtotalconcepto<?php echo $i?>"></label></span>
                            </div>                             
                          </div> 
                      <?php
                      } ?>     

                          <div class="row" style="margin-top: 20px">
                            <div class="col-5">                                     
                               <h5> <label style="font-weight: normal;">Sub total de ingresos</label>  </h5>
                            </div>
                            <div class="col-4">
                               <h5> <input type="text" readonly id="txtValor" value="0" style="border: none; font-weight: 900;" /> </h5>
                            </div>                             
                          </div> 
                  </div> 
                        
                  <div class="tile-footer" style="padding-top: 20px">
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