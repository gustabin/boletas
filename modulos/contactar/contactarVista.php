<?php 
if(!empty($_GET['contactado'])==1) {   ?>

    <script type="text/javascript">
        swal("Mensaje enviado satisfactoriamente", "Todo bien", "success"); 
    </script>
<?php } ?> 

<script src="contactarFunciones.js"></script>

<table class="table table-light table-bordered">
    <tbody>        
        <tr>
            <td colspan="6">
                 <form class="form-horizontal" id="formDefault">         
                    <div class="alert alert-light" role="alert">                      
                        <div class="row">
                          <div class="col-sm-12">                      
                            <div class="form-group">                   
                              <label class="control-label">Nombres</label>
                              <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre y apellido" required="" value="">
                            </div> 
                          </div>            
                        </div>

                        <div class="row">
                          <div class="col-sm-12">                      
                            <div class="form-group">                   
                              <label class="control-label">Teléfono</label>
                              <input class="form-control" id="telefono" name="telefono" type="text" placeholder="Telefono" value="">
                            </div>   
                          </div>            
                        </div>    

                        <div class="row">           
                          <div class="col-sm-12">
                            <div class="form-group">                   
                              <label class="control-label">Email</label>
                              <input class="form-control" id="email" name="email" type="email" placeholder="Email" required="" value="">
                            </div>  
                          </div>
                        </div>    

                        <div class="row">
                          <div class="col-sm-12"> 
                            <div class="form-group">
                                <label class="control-label">Mensaje</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="2" placeholder="Escriba su mensaje" required=""></textarea>
                            </div> 
                          </div>
                        </div>   

                        <div class="row">
                          <div class="col-sm-6"> 
                           <div class="form-group">
                              <button class="btn btn-primary" 
                                type="submit" 
                                name="btnAccion"
                                value="Contactar" 
                                onclick="Contactar()">
                                Enviar
                              </button>
                                                  
                              <button class="btn btn-secondary" 
                                type="button" 
                                name="btnAccion"
                                value="Cerrar" 
                                onclick="Cerrar()">
                                Cerrar 
                              </button>     
                           </div> 
                          </div>
                        </div> 
                    </div>
                </form>                        
            </td>            
        </tr>
    </tbody>
</table>