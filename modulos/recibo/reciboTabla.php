<?php 
require_once("../../tools/mypathdb.php");   
require_once('../../tools/sed.php');
?>
<table id="example" class="table table-bordered"  >  
  <tbody>  
    <?php 
      $id=$_SESSION['idempresa'];
      $sql = "SELECT * FROM empresas WHERE id=$id";
      $resultado = mysqli_query($conn, $sql);
      while($data = mysqli_fetch_array($resultado))
      {
        $id = $data['id'];
        $empresa = $data['nombre'];       
        $cuit = $data['cuit'];       
        $direccion = $data['direccion'];
      } 
    ?>
    
    <?php 
      $id=$_SESSION['idsindicato'];
      $sql = "select * from nomina nom INNER JOIN padron pad on nom.idpadron = pad.id AND nom.idsindicato = $id ";

      $resultado = mysqli_query($conn, $sql);
      $row_cnt = mysqli_num_rows($resultado);
      while($data = mysqli_fetch_array($resultado))
      {
              $id = $data['id'];
              $idsindicato = $data['idsindicato'];
              $idempresa = $data['idempresa'];
              $idpadron = $data['idpadron'];
              $idcategoriaempleado = $data['idcategoriaempleado'];
              $fechaalta = $data['fechaalta'];
              $fechamodificacion = $data['fechamodificacion'];
              $fecha = $data['fecha'];      
              $status = $data['status']; 
              $nombre = $data['nombre'];
              $apellido = $data['apellido'];
              $sueldo = $data['sueldo'];
              $cuil = $data['cuil'];
              $totalingresos = 0;
              $totalegresos = 0;
              $ingreso = 0;
              $total = 0;
              //$sueldo = 65000; //************** OJO QUITAR HARDCODE **************
              $adicional = 32500; //************** OJO QUITAR HARDCODE **************
              $capacitacion = 0; //************** OJO QUITAR HARDCODE **************
              $antiguedad = 6825; //************** OJO QUITAR HARDCODE **************
              $sac = 52162.50; //************** OJO QUITAR HARDCODE **************
              $afab = 0; //************** OJO QUITAR HARDCODE **************
              $otros = 0; //************** OJO QUITAR HARDCODE **************
              //$totalingresos = $sueldo + $adicional + $antiguedad + $sac;

              $sql2 = "SELECT * FROM categoriaempleados WHERE id=$idcategoriaempleado";
              $result2 = mysqli_query($conn, $sql2);
              while($data2=mysqli_fetch_array($result2))
              {
                $categoriaempleado = $data2['nombre'];  
              }
              ?>
              <tr>  
                <td style="border: hidden"><?php echo $empresa ?></td>     
                <td style="border: hidden"></td> 
                <td style="border: hidden"><?php echo $direccion ?></td> 
                <td style="border: hidden">            </td> 
                <td style="border: hidden; text-align: right;"><?php echo $cuit ?></td> 
              </tr>
              <tr>      
                <td style="border: hidden"> </td> 
                <td style="border: hidden"> </td> 
                <td style="border: hidden"> </td> 
                <td style="border: hidden"> </td> 
              </tr>
              <tr>      
                <td style="border: hidden"><?php echo $nombre . " " . $apellido ?></td> 
                <td style="border: hidden"><?php echo $cuil ?></td> 
                <td style="border: hidden">            </td> 
                <td style="border: hidden">            </td> 
                <td style="border: hidden">            </td> 
              </tr>
              <tr>      
                <td style="border: hidden">Cat </td> 
                <td style="border: hidden"><?php echo $categoriaempleado ?></td> 
              </tr>
              <tr>      
                <td style="border: hidden"> </td> 
                <td style="border: hidden"> </td> 
                <td style="border: hidden"> </td> 
              </tr>
               <tr>      
                <td style="border: hidden">Sueldo </td> 
                <td style="border: hidden"><h3><?php echo number_format($sueldo,2) ?></h3></td> 
                <td style="border: hidden"></td> 
              </tr>
              <!--<tr>      
                <td style="border: hidden">Adicional </td> 
                <td style="border: hidden"></td> 
                <td style="border: hidden; text-align: right;"><?php //echo number_format($adicional,2) ?></td> 
              </tr>
              <tr>      
                <td style="border: hidden">Capacitación </td> 
                <td style="border: hidden"></td> 
                <td style="border: hidden; text-align: right;"><?php //echo number_format($capacitacion,2) ?></td> 
              </tr>
              <tr>      
                <td style="border: hidden">Af/Ab </td> 
                <td style="border: hidden"></td> 
                <td style="border: hidden; text-align: right;"><?php //echo number_format($afab,2) ?></td> 
              </tr>
              <tr>      
                <td style="border: hidden">Otros </td> 
                <td style="border: hidden"></td> 
                <td style="border: hidden; text-align: right;"><?php //echo number_format($otros,2) ?></td> 
              </tr>
              <tr>      
                <td style="border: hidden">Antigüedad </td> 
                <td style="border: hidden"></td> 
                <td style="border: hidden; text-align: right;"><?php //echo number_format($antiguedad,2) ?></td> 
              </tr>
              <tr>      
                <td style="border: hidden"></td> 
                <td style="border: hidden; text-align: right;"><?php //echo number_format($sac,2) ?></td> 
              </tr> -->
              <?php 
              $totalingresos= $sueldo;
                  $sql3 = "SELECT * FROM conceptos WHERE idsindicato=$idsindicato AND status=1 AND seimprime=1";
                  
                  $resultado3 = mysqli_query($conn, $sql3);
                  while($data3 = mysqli_fetch_array($resultado3))
                  {                    
                    $nombreconcepto = $data3['nombre'];
                    $porcentaje = $data3['porcentaje'];
                    $descripcion = $data3['descripcion'];
                    $formula = !empty($data3['formula'])?$data3['formula']:'';
                    $confirma = $data3['confirma'];
                    $importecantidad = $data3['importecantidad'];
                    $seimprime = $data3['seimprime'];
                    $conceptoasociado = $data3['conceptoasociado'];
                    $debitocredito = $data3['debitocredito']; //1=suma; 2=resta
                    $valorconcepto= $sueldo * $porcentaje/100;

                    //$valorconcepto = !empty($formula) ? (strval($formula/100)) * $totalingresos : 0;
                    if ($debitocredito==1) {
                      $totalingresos= $totalingresos + $valorconcepto;
                    }
                    if ($debitocredito==2) {
                      $totalegresos= $totalegresos + $valorconcepto;
                    }                    
                    // $totalegresos = $totalegresos + $valorconcepto;   
                    ?>
                    <?php if ($seimprime==1) { ?>
                      <tr>      
                        <td style="border: hidden; padding-top: 0px; "></td> 
                        <td style="border: hidden; padding-top: 0px; "><?php echo $descripcion ?> <?php echo $porcentaje ?>%</td> 
                        <?php if ($debitocredito=='1') {?>
                          <td style="border: hidden; padding-top: 0px; text-align: right;"><?php echo number_format($valorconcepto,2) ?></td> 
                        <?php } else {?>
                          <td style="border: hidden; padding-top: 0px; text-align: right;"></td> 
                          <td style="border: hidden; padding-top: 0px; text-align: right;"><?php echo number_format($valorconcepto,2) ?></td> 
                        <?php } ?>
                      </tr>
                    <?php } ?>
                    <?php
                  }    
              ?>
              <tr>  
                <td style="border: hidden; padding-top: 0px; "></td>     
                <td style="border: hidden; padding-top: 0px; "></td> 
                <td style="border: hidden; padding-top: 0px; text-align: right;"><?php echo number_format($totalingresos,2) ?></td> 
                <td style="border: hidden; padding-top: 0px; text-align: right;"><?php echo number_format($totalegresos,2) ?></td> 
                <?php $total = $totalingresos - $totalegresos; ?>
                <td style="border: hidden; padding-top: 0px; text-align: right; font-weight: 900;"><?php echo number_format($total,2) ?></td> 
              </tr>
              <tr>      
                <td style="border: hidden"> =============</td> 
                <td style="border: hidden"> =============</td> 
                <td style="border: hidden"> =============</td> 
                <td style="border: hidden"> =============</td> 
                <td style="border: hidden"> =============</td> 
              </tr>
      <?php
      }
    ?>                
  </tbody> 
</table>