<?php   require_once('../../tools/sed.php');   ?>
     <section class="content"> 
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="formDefault">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                  <label for="nombre" class="control-label">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del rol" required="">
                </div>
                <div class="form-group">
                  <label for="descripcion" class="control-label">Descripción</label>
                  <textarea class="form-control" id="descripcion" name="descripcion" rows="3" cols="50" required="" placeholder="Descripción del rol">Descripción del rol</textarea>
                </div>               
                <div class="form-group">
                    <label class="control-label">Acceso a modulos</label>
                    <input class="form-check-input" type="hidden" value="" id="accesos" name="accesos" style="width: 308px;">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Clientes" id="txtAcceso1" name="txtAcceso1" >
                      <label class="form-check-label" for="txtAcceso1">
                        Clientes
                      </label>
                    </div>   
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Bancos" id="txtAcceso2" name="txtAcceso2">
                      <label class="form-check-label" for="txtAcceso2">
                        Bancos
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="CategoriaEmpleados" id="txtAcceso3" name="txtAcceso3">
                      <label class="form-check-label" for="txtAcceso3">
                        Categoria Empleados
                      </label>
                    </div>   
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Conceptos" id="txtAcceso4" name="txtAcceso4">
                      <label class="form-check-label" for="txtAcceso4">
                        Conceptos
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Documentos" id="txtAcceso5" name="txtAcceso5">
                      <label class="form-check-label" for="txtAcceso5">
                        Documentos
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Empresas" id="txtAcceso6" name="txtAcceso6">
                      <label class="form-check-label" for="txtAcceso6">
                        Empresas
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="EmpresasLogin" id="txtAcceso7" name="txtAcceso7">
                      <label class="form-check-label" for="txtAcceso7">
                        Empresas Login
                      </label>
                    </div>                       
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Esquema" id="txtAcceso8" name="txtAcceso8">
                      <label class="form-check-label" for="txtAcceso8">
                        Esquema
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="EstadoCivil" id="txtAcceso9" name="txtAcceso9">
                      <label class="form-check-label" for="txtAcceso9">
                        Estado Civil
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="ImporteSeguro" id="txtAcceso10" name="txtAcceso10">
                      <label class="form-check-label" for="txtAcceso10">
                        Importe Seguro
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Nacionalidades" id="txtAcceso11" name="txtAcceso11">
                      <label class="form-check-label" for="txtAcceso11">
                        Nacionalidades
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Nomina" id="txtAcceso12" name="txtAcceso12">
                      <label class="form-check-label" for="txtAcceso12">
                        Nomina
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Pagos" id="txtAcceso13" name="txtAcceso13">
                      <label class="form-check-label" for="txtAcceso13">
                        Pagos
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Provincias" id="txtAcceso14" name="txtAcceso14">
                      <label class="form-check-label" for="txtAcceso14">
                        Provincias
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Ramas" id="txtAcceso15" name="txtAcceso15">
                      <label class="form-check-label" for="txtAcceso15">
                        Ramas
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Rol" id="txtAcceso16" name="txtAcceso16">
                      <label class="form-check-label" for="txtAcceso16">
                        Rol
                      </label>
                    </div>  
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Seteos" id="txtAcceso17" name="txtAcceso17">
                      <label class="form-check-label" for="txtAcceso17">
                        Seteos
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="SituacionRevista" id="txtAcceso18" name="txtAcceso18">
                      <label class="form-check-label" for="txtAcceso18">
                        Situacion Revista
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="TasaInteres" id="txtAcceso19" name="txtAcceso19">
                      <label class="form-check-label" for="txtAcceso19">
                        Tasa de Interes
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="TipoDocumento" id="txtAcceso20" name="txtAcceso20">
                      <label class="form-check-label" for="txtAcceso20">
                        Tipo de Documento
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Usuarios" id="txtAcceso21" name="txtAcceso21">
                      <label class="form-check-label" for="txtAcceso21">
                        Usuarios
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Vencimiento" id="txtAcceso22" name="txtAcceso22">
                      <label class="form-check-label" for="txtAcceso22">
                        Vencimiento
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Contacto" id="txtAcceso23" name="txtAcceso23">
                      <label class="form-check-label" for="txtAcceso23">
                        Contacto
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Padron" id="txtAcceso24" name="txtAcceso24">
                      <label class="form-check-label" for="txtAcceso24">
                        Padron
                      </label>
                    </div>    
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Sindicato" id="txtAcceso25" name="txtAcceso25">
                      <label class="form-check-label" for="txtAcceso25">
                        Sindicato
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Seccional" id="txtAcceso26" name="txtAcceso26">
                      <label class="form-check-label" for="txtAcceso26">
                        Seccional
                      </label>
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Recibos" id="txtAcceso27" name="txtAcceso27">
                      <label class="form-check-label" for="txtAcceso27">
                        Recibos de sueldo
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Importar" id="txtAcceso28" name="txtAcceso28">
                      <label class="form-check-label" for="txtAcceso28">
                        Importar padrón
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Tipoboleta" id="txtAcceso29" name="txtAcceso29">
                      <label class="form-check-label" for="txtAcceso29">
                        Tipo de boleta
                      </label>
                    </div>
                  </div>  
                <div class="form-group">
                  <label for="fecha" class="control-label">Fecha</label>
                  <input type="text" class="form-control" id="fecha" name="fecha" placeholder="<?php echo date("d-m-Y"); ?>" disabled>
                </div>
                <div class="form-group">
                  <label class="control-label">Estados</label>
                  <select class="form-control" name="status" id="status" required="">
                      <option value="1">Activo</option>  
                      <option value="0">Inactivo</option>  
                  </select>
                </div>
                <div class="title-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                    <span id="btnText">Guardar</span>                    
                  </button>
                  &nbsp;&nbsp;&nbsp;
                  <a class="btn btn-secondary" href="#" data-dismiss="modal">
                    <i class="fa fa-fw fa-lg fa-times-circle"></i>
                    <span id="btnTextCancelar">Cancelar</span>
                  </a>
                </div>
              </form>
              <form class="form-horizontal" id="formSindicato" style="display: none">
                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Sindicato</label>                        
                        <select class="form-control" id="sindicato" name="sindicato" required="">
                          <?php                          
                            $sql = "SELECT * FROM sindicatos WHERE status=1";   
                            $resultado = mysqli_query($conn, $sql);
                            while($data = mysqli_fetch_array($resultado))
                            {
                              $id = $data['id'];
                              $nombre = $data['razonsocial'];       
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
                    <label class="control-label">Empresa</label>
                    <select class="form-control" id="idempresa" name="idempresa" >
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
                  <div class="title-footer">
                    <button id="btnActionFormSindicato" class="btn btn-primary" type="submit">
                      <i class="fa fa-fw fa-lg fa-check-circle"></i>
                      <span id="btnText">Elegir</span>                    
                    </button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="#" data-dismiss="modal">
                      <i class="fa fa-fw fa-lg fa-times-circle"></i>
                      <span id="btnTextCancelar">Cancelar</span>
                    </a>
                  </div>
              </form>
              <form class="form-horizontal" id="formEmpresa" style="display: none">
                  <div class="row">
                    <div class="col-sm-12">                      
                      <div class="form-group">                   
                        <label class="control-label">Empresa</label>                        
                        <select class="form-control" id="empresa" name="empresa" required="">
                          <?php                     
                            $idsindicato  = $_SESSION['idsindicato'];   
                            $sql = "SELECT * FROM empresas WHERE status=1 AND idsindicato = $idsindicato";   
                            //var_dump($sql);
                            //die();
                            $resultado = mysqli_query($conn, $sql);
                            while($data = mysqli_fetch_array($resultado))
                            {
                              $id = $data['id'];
                              $nombre = $data['nombre'];       
                            ?>                           
                              <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                            <?php 
                            }                             
                          ?>
                        </select>                       
                      </div> 
                    </div>                    
                  </div>               
                  <div class="title-footer">
                    <button id="btnActionFormEmpresa" class="btn btn-primary" type="submit">
                      <i class="fa fa-fw fa-lg fa-check-circle"></i>
                      <span id="btnText">Elegir</span>                    
                    </button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="#" data-dismiss="modal">
                      <i class="fa fa-fw fa-lg fa-times-circle"></i>
                      <span id="btnTextCancelar">Cancelar</span>
                    </a>
                  </div>
              </form>
            </div>           
          </div>
        </div>
      </div>
    </section>