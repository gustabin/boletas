<script src="loginFunciones.js"></script>
 <section class="content" id="login">
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingresa los datos para iniciar tu sesión</p>
      <form class="form-horizontal" id="formDefault"> 
        <div class="input-group mb-3">
          <input type="email" class="form-control redondeado" placeholder="Email" name="email" id="email" required="" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control redondeado" placeholder="Password" name="password" id="password" value="" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordar mis datos
              </label>
            </div>
          </div>
          <div class="col-4">           
            <button type="submit" class="btn btn-primary btn-block" onclick="Buscar()">Login</button> 
          </div>          
        </div>
        <div class="row" style="padding-top: 10px">
          <div class="col-7">   
              <a href="#" onclick="MostrarRecuperar()">Olvide mi password</a>
          </div>   
        </div>
      </form>          
    </div>
  </div>
 </section>

  <section class="content" id="recuperar" style="display: none;">
    <div class="card">
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
                 
                  <div class="form-group"> 
                    <div class="col-md-12 control">
                      <div style="border-top: 1px solid#888; padding-top: 15px; font-size: 14px;" align="center">
                        ¿Tiene una cuenta?
                        <a href="#" onclick="MostrarLogin()" style="color:blue">Login</a>
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
  </section>

