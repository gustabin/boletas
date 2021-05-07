  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../../img/logo.png" alt="Boletas Logo" class="xbrand-image ximg-circle elevation-3"
           style="opacity: .8; width: 40px; height: 40px; margin-left: 15px">
      <span class="brand-text font-weight-light">Boletas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../img/userAvatar2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo  $_SESSION['nombre'] . " " .   $_SESSION['apellido']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tablas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="../../modulos/usuario" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>1. Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/roles" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>2. Roles</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="../../modulos/sindicato" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>3. Sindicatos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/seccional" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>4. Seccionales</p>
                </a>
              </li>     
              <li class="nav-item">
                <a href="../../modulos/empresa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>5. Empresas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/recibo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>6. Carga del período</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="../../modulos/bancos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>7. Bancos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/categoriaempleados" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>8. Categoría Empleados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/documento" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>9. Documentos a mostrar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/provincias" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>10. Provincias</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="../../modulos/ramo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>11. Ramas</p>
                </a>
              </li>             
              <li class="nav-item">
                <a href="../../modulos/estadocivil" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>12. Estado civil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/importeseguro" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>13. Importe seguro/vigencia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/nacionalidad" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>14. Nacionalidad</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/padron" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>15. Padrón</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/nomina" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>16. Nómina</p>
                </a>
              </li>     
              <li class="nav-item">
                <a href="../../modulos/detallenomina" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>17. Detalle de Nómina</p>
                </a>
              </li>           
              <li class="nav-item">
                <a href="../../modulos/situacion" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>18. Situación de revista</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/pago" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>19. Pagos por Institución</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/tasa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>20. Tasa Interes, vigencia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/vencimiento" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>21. AAMM Vencimiento/cuit</p>
                </a>
              </li>
             <!--  <li class="nav-item">
                <a href="../../modulos/concepto" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Conceptos de la boleta</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="../../modulos/esquema" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>22. Datos fijos del Sistema</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../modulos/concepto" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>23. Conceptos</p>
                </a>
              </li>             
             
               
              <li class="nav-item">
                <a href="../../modulos/importar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>24. Importar padrón</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="../../modulos/tipoboleta" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>25. Tipo de boleta</p>
                </a>
              </li> 
              <li class="nav-item" style="pointer-events:none;  opacity:0.6;">
                <a href="../../modulos/cliente" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cliente / Obra Social / Mutual</p>
                </a>
              </li>    
              <li class="nav-item" style="pointer-events:none;  opacity:0.6;">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Login Empresas</p>
                </a>
              </li> 
              <li class="nav-item" style="pointer-events:none;  opacity:0.6;">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boletas Generadas</p>
                </a>
              </li>     
              <li class="nav-item" style="pointer-events:none;  opacity:0.6;">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nómina de esas boletas</p>
                </a>
              </li>  
              <li class="nav-item" style="pointer-events:none;  opacity:0.6;">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Códigos de Barras</p>
                </a>
              </li>
              <li class="nav-item" style="pointer-events:none;  opacity:0.6;">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parentezco</p>
                </a>
              </li>     
            </ul>
          </li> 
          <!-- <li class="nav-header">EXAMPLES</li>
            <li class="nav-item">
              <a href="pages/calendar.html" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Calendar
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Gallery
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  Mailbox
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/mailbox/mailbox.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inbox</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/mailbox/compose.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compose</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/mailbox/read-mail.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Read</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Pages
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/examples/invoice.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Invoice</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/profile.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/e-commerce.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>E-commerce</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/projects.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Projects</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/project-add.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Project Add</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/project-edit.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Project Edit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/project-detail.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Project Detail</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/contacts.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contacts</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                  Extras
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/examples/login.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Login</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/register.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Register</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/forgot-password.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Forgot Password</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/recover-password.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Recover Password</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/lockscreen.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lockscreen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Legacy User Menu</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/language-menu.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Language Menu</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/404.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Error 404</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/500.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Error 500</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/pace.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pace</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/blank.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Blank Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="starter.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Starter Page</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">MISCELLANEOUS</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Documentation</p>
              </a>
            </li>
            <li class="nav-header">MULTI LEVEL EXAMPLE</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Level 1</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Level 1
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Level 2
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Level 1</p>
              </a>
            </li>
            <li class="nav-header">LABELS</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Important</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Warning</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Informational</p>
              </a>
            </li -->
        </ul> 
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>