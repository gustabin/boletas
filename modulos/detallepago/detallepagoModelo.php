<?php 
session_start();
require_once('../../tools/sed.php');
require_once('../../tools/mypathdb.php'); 
require_once('../../tools/eliminarComillas.php'); 

$option = $_GET['option'];  
 //  var_dump($_REQUEST);
 // die();

if($option=="consultar"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "SELECT * FROM pagos WHERE id = $clave";
      $result = mysqli_query($conn, $sql);
      while($data=mysqli_fetch_array($result))
        {
          $id = $data['id'];
          $idsindicato = $data['idsindicato'];
          $idempresa = $data['idempresa'];
          $idbanco = $data['idbanco'];
          $idboleta = $data['idboleta'];
          $fechapago = $data['fechapago'];
          $importe = $data['importe'];      
          $fecha = $data['fecha'];      
          $status = $data['status']; 
        }

        $claveDesencriptada = SED::decryption($idsindicato);
        $idsindicato=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idempresa);
        $idempresa=$claveDesencriptada;

        $claveDesencriptada = SED::decryption($idbanco);
        $idbanco=$claveDesencriptada;

        $fechapago = date("Y-m-d", strtotime($fechapago));
       
        if (!isset($status)) 
        {        
          $data = array("error" => '2');        
          die(json_encode($data));
        }

        if ($status==2)  //pago eliminado
        {                  
          $data = array("error" => '1');
          die(json_encode($data));
        }

        if ($importe>9999.99)  {
          $data = array("error" => '5');
          die(json_encode($data));
        }

        if ($status!=2)  //pago activo o inactivo
        {
          $data = array("exito" => '1',"id"=>$id, "idsindicato"=> $idsindicato, "idempresa"=>$idempresa,
           "idbanco"=>$idbanco, "idboleta"=>$idboleta, "fechapago"=>$fechapago, "importe"=>$importe,      
           "fecha"=>$fecha, "status"=>$status);
          die(json_encode($data));
        }    
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  } 
} 


if($option=="modificarConsultar"){  
  $concepto1=""; 
  $nombreconcepto1=""; 
  $checkmarkconcepto1=""; 
  $formula1=""; 
  $idtipoboleta1=""; 
  $concepto2=""; 
  $nombreconcepto2=""; 
  $checkmarkconcepto2=""; 
  $formula2=""; 
  $idtipoboleta2=""; 
  $concepto3=""; 
  $nombreconcepto3=""; 
  $checkmarkconcepto3=""; 
  $formula3=""; 
  $idtipoboleta3=""; 
  $concepto4=""; 
  $nombreconcepto4=""; 
  $checkmarkconcepto4=""; 
  $formula4=""; 
  $idtipoboleta4=""; 
  $concepto5=""; 
  $nombreconcepto5=""; 
  $checkmarkconcepto5=""; 
  $formula5=""; 
  $idtipoboleta5=""; 
  $concepto6=""; 
  $nombreconcepto6=""; 
  $checkmarkconcepto6=""; 
  $formula6=""; 
  $idtipoboleta6=""; 
  $concepto7=""; 
  $nombreconcepto7=""; 
  $checkmarkconcepto7=""; 
  $formula7=""; 
  $idtipoboleta7=""; 
  $concepto8=""; 
  $nombreconcepto8=""; 
  $checkmarkconcepto8=""; 
  $formula8=""; 
  $idtipoboleta8=""; 
  $concepto9=""; 
  $nombreconcepto9=""; 
  $checkmarkconcepto9=""; 
  $formula9=""; 
  $idtipoboleta9=""; 
  $concepto10=""; 
  $nombreconcepto10="0"; 
  $checkmarkconcepto10=""; 
  $formula10=""; 
  $idtipoboleta10=""; 
  $concepto11=""; 
  $nombreconcepto11=""; 
  $checkmarkconcepto11=""; 
  $formula11=""; 
  $idtipoboleta11=""; 
  $concepto12=""; 
  $nombreconcepto12=""; 
  $checkmarkconcepto12=""; 
  $formula12=""; 
  $idtipoboleta12=""; 
  $concepto13=""; 
  $nombreconcepto13=""; 
  $checkmarkconcepto13=""; 
  $formula13=""; 
  $idtipoboleta13=""; 
  $concepto14=""; 
  $nombreconcepto14=""; 
  $checkmarkconcepto14=""; 
  $formula14=""; 
  $idtipoboleta14=""; 
  $concepto15=""; 
  $nombreconcepto15=""; 
  $checkmarkconcepto15=""; 
  $formula15=""; 
  $idtipoboleta15=""; 
  $concepto16=""; 
  $nombreconcepto16=""; 
  $checkmarkconcepto16=""; 
  $formula16=""; 
  $idtipoboleta16=""; 
  $concepto17=""; 
  $nombreconcepto17=""; 
  $checkmarkconcepto17=""; 
  $formula17=""; 
  $idtipoboleta17=""; 
  $concepto18=""; 
  $nombreconcepto18=""; 
  $checkmarkconcepto18=""; 
  $formula18=""; 
  $idtipoboleta18=""; 
  $concepto19=""; 
  $nombreconcepto19=""; 
  $checkmarkconcepto19=""; 
  $formula19=""; 
  $idtipoboleta19=""; 
  $concepto20=""; 
  $nombreconcepto20="0"; 
  $checkmarkconcepto20=""; 
  $formula20=""; 
  $idtipoboleta20=""; 

  $idsindicato = $_SESSION['idsindicato'];
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){

              $concepto="";
              $clave = $_GET['id'];
              $_SESSION['id']=$clave;
              $claveDesencriptada = SED::decryption($clave);
              $id=$claveDesencriptada;
              $swi=1;
              $concepto="";
              // Consultar en la tabla conceptos
              $sql2 = "SELECT * FROM conceptos WHERE idsindicato=$idsindicato AND seimprime=1 AND status=1";

              $resultado2 = mysqli_query($conn, $sql2);
              $filas = mysqli_num_rows($resultado2);
              $_SESSION['filas']=$filas;
              if ($filas>0) {
                while($data2 = mysqli_fetch_array($resultado2))
                {
                      $concepto = $data2['id'];     
                      // Recorrer el explode

                      $sql3 = "SELECT * FROM historialnomina WHERE id = $id";

                      $result3 = mysqli_query($conn, $sql3);
                      while($data3=mysqli_fetch_array($result3))
                        {
                          $idconcepto = $data3['idconcepto']; 
                          $periodo = $data3['periodo']; 

                          $tipoboleta = $data3['tipoboleta']; 
                          $cuit = $data3['cuit']; 
                          $cuil = $data3['cuil'];                          
                                     
                          $exploded = explode(",", $idconcepto);          
                          $elementos=  substr_count($idconcepto, ','); 
                          $checkmark="";

                          for ($i=0; $i < $elementos; $i++) { 
                            $idconceptoexploded= $exploded[$i]; 
                            if ($concepto==$idconceptoexploded) {
                              $checkmark=true;
                            }          
                          }                         
                                    
                          switch ($swi) {     
                           case 1:
                             $concepto1 = $data2['id']; 
                             $nombreconcepto1 = $data2['descripcion'];
                             $formula1 = $data2['porcentaje']; 
                             $idtipoboleta1 = $data2['idtipoboleta'];    
                             $checkmarkconcepto1 = $checkmark;                             
                             break;
                           case 2:
                             $concepto2 = $data2['id']; 
                             $nombreconcepto2 = $data2['descripcion'];
                             $formula2 = $data2['porcentaje']; 
                             $idtipoboleta2 = $data2['idtipoboleta'];    
                             $checkmarkconcepto2 = $checkmark;
                             break;
                           case 3:
                             $concepto3 = $data2['id']; 
                             $nombreconcepto3 = $data2['descripcion'];
                             $formula3 = $data2['porcentaje']; 
                             $idtipoboleta3 = $data2['idtipoboleta'];    
                             $checkmarkconcepto3 = $checkmark;
                             break;                        
                           case 4:
                             $concepto4 = $data2['id']; 
                             $nombreconcepto4 = $data2['descripcion'];
                             $formula4 = $data2['porcentaje']; 
                             $idtipoboleta4 = $data2['idtipoboleta'];    
                             $checkmarkconcepto4 = $checkmark;
                             break;
                           case 5:
                             $concepto5 = $data2['id']; 
                             $nombreconcepto5 = $data2['descripcion'];
                             $formula5 = $data2['porcentaje'];
                             $idtipoboleta5 = $data2['idtipoboleta'];     
                             $checkmarkconcepto5 = $checkmark;
                             break;
                           case 6:
                             $concepto6 = $data2['id']; 
                             $nombreconcepto6 = $data2['descripcion'];
                             $formula6 = $data2['porcentaje']; 
                             $idtipoboleta6 = $data2['idtipoboleta'];    
                             $checkmarkconcepto6 = $checkmark;
                             break;
                           case 7:
                             $concepto7 = $data2['id']; 
                             $nombreconcepto7 = $data2['descripcion'];
                             $formula7 = $data2['porcentaje']; 
                             $idtipoboleta7 = $data2['idtipoboleta'];    
                             $checkmarkconcepto7 = $checkmark;
                             break;
                           case 8:
                             $concepto8 = $data2['id']; 
                             $nombreconcepto8 = $data2['descripcion'];
                             $formula8 = $data2['porcentaje']; 
                             $idtipoboleta8 = $data2['idtipoboleta'];    
                             $checkmarkconcepto8 = $checkmark;
                             break;
                           case 9:
                             $concepto9 = $data2['id']; 
                             $nombreconcepto9 = $data2['descripcion'];
                             $formula9 = $data2['porcentaje']; 
                             $idtipoboleta9 = $data2['idtipoboleta'];    
                             $checkmarkconcepto9 = $checkmark;
                             break;
                           case 10:
                             $concepto10 = $data2['id']; 
                             $nombreconcepto10 = $data2['descripcion'];
                             $formula10 = $data2['porcentaje']; 
                             $idtipoboleta10 = $data2['idtipoboleta'];    
                             $checkmarkconcepto10 = $checkmark;
                             break;
                           case 11:
                             $concepto11 = $data2['id']; 
                             $nombreconcepto11 = $data2['descripcion'];
                             $formula11 = $data2['porcentaje']; 
                             $idtipoboleta11 = $data2['idtipoboleta'];    
                             $checkmarkconcepto11 = $checkmark;
                             break;
                           case 12:
                             $concepto12 = $data2['id']; 
                             $nombreconcepto12 = $data2['descripcion'];
                             $formula12 = $data2['porcentaje']; 
                             $idtipoboleta12 = $data2['idtipoboleta'];    
                             $checkmarkconcepto12 = $checkmark;
                             break;
                           case 13:
                             $concepto13 = $data2['id']; 
                             $nombreconcepto13 = $data2['descripcion'];
                             $formula13 = $data2['porcentaje']; 
                             $idtipoboleta13 = $data2['idtipoboleta'];    
                             $checkmarkconcepto13 = $checkmark;
                             break;
                           case 14:
                             $concepto14 = $data2['id']; 
                             $nombreconcepto14 = $data2['descripcion'];
                             $formula14 = $data2['porcentaje']; 
                             $idtipoboleta14 = $data2['idtipoboleta'];    
                             $checkmarkconcepto14 = $checkmark;
                             break;
                           case 15:
                             $concepto15 = $data2['id']; 
                             $nombreconcepto15 = $data2['descripcion'];
                             $formula15 = $data2['porcentaje']; 
                             $idtipoboleta15 = $data2['idtipoboleta'];    
                             $checkmarkconcepto15 = $checkmark;
                             break;
                           case 16:
                             $concepto16 = $data2['id']; 
                             $nombreconcepto16 = $data2['descripcion'];
                             $formula16 = $data2['porcentaje']; 
                             $idtipoboleta16 = $data2['idtipoboleta'];    
                             $checkmarkconcepto16 = $checkmark;
                             break;
                           case 17:
                             $concepto17 = $data2['id']; 
                             $nombreconcepto17 = $data2['descripcion'];
                             $formula17 = $data2['porcentaje'];
                             $idtipoboleta17 = $data2['idtipoboleta'];     
                             $checkmarkconcepto17 = $checkmark;
                             break;
                           case 18:
                             $concepto18 = $data2['id']; 
                             $nombreconcepto18 = $data2['descripcion'];
                             $formula18 = $data2['porcentaje']; 
                             $idtipoboleta18 = $data2['idtipoboleta'];    
                             $checkmarkconcepto18 = $checkmark;
                             break;
                           case 19:
                             $concepto19 = $data2['id']; 
                             $nombreconcepto19 = $data2['descripcion'];
                             $formula19 = $data2['porcentaje']; 
                             $idtipoboleta19 = $data2['idtipoboleta'];    
                             $checkmarkconcepto19 = $checkmark;
                             break;
                           case 20:
                             $concepto20 = $data2['id']; 
                             $nombreconcepto20 = $data2['descripcion'];
                             $formula20 = $data2['porcentaje']; 
                             $idtipoboleta20 = $data2['idtipoboleta'];    
                             $checkmarkconcepto20 = $checkmark;
                             break;                 
                           default:                   
                             break;
                          } 
                           $swi=$swi+1;
                        }                      
                }
              }else{
                $data = array("error" => '6');
                die(json_encode($data));
              }


        $sql = "SELECT * FROM nomina WHERE cuil=$cuil AND status=1";
  
        $resultado = mysqli_query($conn, $sql);
        while($data = mysqli_fetch_array($resultado))
        {
          $sueldo = $data['sueldo'];  
        }
        
        $claveEncriptada = SED::encryption($id);
        $id=$claveEncriptada;

        mysqli_close($conn);
        $data = array("exito" => '1',
          "id"=>$id, 
          "periodo"=> $periodo, 
          "tipoboleta"=>$tipoboleta,
          "cuit"=>$cuit, 
          "cuil"=>$cuil, 
          "sueldo"=>$sueldo, 
          "idconcepto"=>$idconcepto,
          "concepto1"=>$concepto1,            
          "nombreconcepto1"=>$nombreconcepto1,
          "checkmarkconcepto1"=>$checkmarkconcepto1,
          "formulaconcepto1"=>$formula1,
          "idtipoboleta1"=>$idtipoboleta1,
          "concepto2"=>$concepto2, 
          "nombreconcepto2"=>$nombreconcepto2,
          "checkmarkconcepto2"=>$checkmarkconcepto2,
          "formulaconcepto2"=>$formula2,
          "idtipoboleta2"=>$idtipoboleta2,
          "concepto3"=>$concepto3, 
          "nombreconcepto3"=>$nombreconcepto3,
          "checkmarkconcepto3"=>$checkmarkconcepto3, 
          "formulaconcepto3"=>$formula3,
          "idtipoboleta3"=>$idtipoboleta3,
          "concepto4"=>$concepto4, 
          "nombreconcepto4"=>$nombreconcepto4,
          "checkmarkconcepto4"=>$checkmarkconcepto4,
          "formulaconcepto4"=>$formula4,
          "idtipoboleta4"=>$idtipoboleta4,
          "concepto5"=>$concepto5, 
          "nombreconcepto5"=>$nombreconcepto5,
          "checkmarkconcepto5"=>$checkmarkconcepto5,
          "formulaconcepto5"=>$formula5,
          "idtipoboleta5"=>$idtipoboleta5,
          "concepto6"=>$concepto6, 
          "nombreconcepto6"=>$nombreconcepto6,
          "checkmarkconcepto6"=>$checkmarkconcepto6,
          "formulaconcepto6"=>$formula6,
          "idtipoboleta6"=>$idtipoboleta6,
          "concepto7"=>$concepto7, 
          "nombreconcepto7"=>$nombreconcepto7,
          "checkmarkconcepto7"=>$checkmarkconcepto7,
          "formulaconcepto7"=>$formula7,
          "idtipoboleta7"=>$idtipoboleta7,
          "concepto8"=>$concepto8, 
          "nombreconcepto8"=>$nombreconcepto8,
          "checkmarkconcepto8"=>$checkmarkconcepto8,
          "formulaconcepto8"=>$formula8,
          "idtipoboleta8"=>$idtipoboleta8,
          "concepto9"=>$concepto9, 
          "nombreconcepto9"=>$nombreconcepto9,
          "checkmarkconcepto9"=>$checkmarkconcepto9,
          "formulaconcepto9"=>$formula9,
          "idtipoboleta9"=>$idtipoboleta9,
          "concepto10"=>$concepto10, 
          "nombreconcepto10"=>$nombreconcepto10,
          "checkmarkconcepto10"=>$checkmarkconcepto10,
          "formulaconcepto10"=>$formula10,
          "idtipoboleta10"=>$idtipoboleta10,
          "concepto11"=>$concepto11, 
          "nombreconcepto11"=>$nombreconcepto11,
          "checkmarkconcepto11"=>$checkmarkconcepto11,
          "formulaconcepto11"=>$formula11,
          "idtipoboleta11"=>$idtipoboleta11,
          "concepto12"=>$concepto12, 
          "nombreconcepto12"=>$nombreconcepto12,
          "checkmarkconcepto12"=>$checkmarkconcepto12,
          "formulaconcepto12"=>$formula12,
          "idtipoboleta12"=>$idtipoboleta12,
          "concepto13"=>$concepto13, 
          "nombreconcepto13"=>$nombreconcepto13,
          "checkmarkconcepto13"=>$checkmarkconcepto13,
          "formulaconcepto13"=>$formula13,
          "idtipoboleta13"=>$idtipoboleta13,
          "concepto14"=>$concepto14, 
          "nombreconcepto14"=>$nombreconcepto14,
          "checkmarkconcepto14"=>$checkmarkconcepto14,
          "formulaconcepto14"=>$formula14,
          "idtipoboleta14"=>$idtipoboleta14,
          "concepto15"=>$concepto15, 
          "nombreconcepto15"=>$nombreconcepto15,
          "checkmarkconcepto15"=>$checkmarkconcepto15,
          "formulaconcepto15"=>$formula15,
          "idtipoboleta15"=>$idtipoboleta15,
          "concepto16"=>$concepto16, 
          "nombreconcepto16"=>$nombreconcepto16,
          "checkmarkconcepto16"=>$checkmarkconcepto16,
          "formulaconcepto16"=>$formula16,
          "idtipoboleta16"=>$idtipoboleta16,
          "concepto17"=>$concepto17, 
          "nombreconcepto17"=>$nombreconcepto17,
          "checkmarkconcepto17"=>$checkmarkconcepto17,
          "formulaconcepto17"=>$formula17,
          "idtipoboleta17"=>$idtipoboleta17,
          "concepto18"=>$concepto18, 
          "nombreconcepto18"=>$nombreconcepto18,
          "checkmarkconcepto18"=>$checkmarkconcepto18,
          "formulaconcepto18"=>$formula18,
          "idtipoboleta18"=>$idtipoboleta18,
          "concepto19"=>$concepto19, 
          "nombreconcepto19"=>$nombreconcepto19,
          "checkmarkconcepto19"=>$checkmarkconcepto19,          
          "formulaconcepto19"=>$formula19,
          "idtipoboleta19"=>$idtipoboleta19,
          "concepto20"=>$concepto20, 
          "nombreconcepto20"=>$nombreconcepto20,
          "checkmarkconcepto20"=>$checkmarkconcepto20,
          "formulaconcepto20"=>$formula20,
          "idtipoboleta20"=>$idtipoboleta20
        );            
       die(json_encode($data));  
  }
  else
  {
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

if($option=="modificarConsultarConcepto"){ 
  $concepto1=""; 
  $nombreconcepto1=""; 
  $checkmarkconcepto1=""; 
  $formula1=""; 
  $idtipoboleta1=""; 
  $concepto2=""; 
  $nombreconcepto2=""; 
  $checkmarkconcepto2=""; 
  $formula2=""; 
  $idtipoboleta2=""; 
  $concepto3=""; 
  $nombreconcepto3=""; 
  $checkmarkconcepto3=""; 
  $formula3=""; 
  $idtipoboleta3=""; 
  $concepto4=""; 
  $nombreconcepto4=""; 
  $checkmarkconcepto4=""; 
  $formula4=""; 
  $idtipoboleta4=""; 
  $concepto5=""; 
  $nombreconcepto5=""; 
  $checkmarkconcepto5=""; 
  $formula5=""; 
  $idtipoboleta5=""; 
  $concepto6=""; 
  $nombreconcepto6=""; 
  $checkmarkconcepto6=""; 
  $formula6=""; 
  $idtipoboleta6=""; 
  $concepto7=""; 
  $nombreconcepto7=""; 
  $checkmarkconcepto7=""; 
  $formula7=""; 
  $idtipoboleta7=""; 
  $concepto8=""; 
  $nombreconcepto8=""; 
  $checkmarkconcepto8=""; 
  $formula8=""; 
  $idtipoboleta8=""; 
  $concepto9=""; 
  $nombreconcepto9=""; 
  $checkmarkconcepto9=""; 
  $formula9=""; 
  $idtipoboleta9=""; 
  $concepto10=""; 
  $nombreconcepto10="0"; 
  $checkmarkconcepto10=""; 
  $formula10=""; 
  $idtipoboleta10=""; 
  $concepto11=""; 
  $nombreconcepto11=""; 
  $checkmarkconcepto11=""; 
  $formula11=""; 
  $idtipoboleta11=""; 
  $concepto12=""; 
  $nombreconcepto12=""; 
  $checkmarkconcepto12=""; 
  $formula12=""; 
  $idtipoboleta12=""; 
  $concepto13=""; 
  $nombreconcepto13=""; 
  $checkmarkconcepto13=""; 
  $formula13=""; 
  $idtipoboleta13=""; 
  $concepto14=""; 
  $nombreconcepto14=""; 
  $checkmarkconcepto14=""; 
  $formula14=""; 
  $idtipoboleta14=""; 
  $concepto15=""; 
  $nombreconcepto15=""; 
  $checkmarkconcepto15=""; 
  $formula15=""; 
  $idtipoboleta15=""; 
  $concepto16=""; 
  $nombreconcepto16=""; 
  $checkmarkconcepto16=""; 
  $formula16=""; 
  $idtipoboleta16=""; 
  $concepto17=""; 
  $nombreconcepto17=""; 
  $checkmarkconcepto17=""; 
  $formula17=""; 
  $idtipoboleta17=""; 
  $concepto18=""; 
  $nombreconcepto18=""; 
  $checkmarkconcepto18=""; 
  $formula18=""; 
  $idtipoboleta18=""; 
  $concepto19=""; 
  $nombreconcepto19=""; 
  $checkmarkconcepto19=""; 
  $formula19=""; 
  $idtipoboleta19=""; 
  $concepto20=""; 
  $nombreconcepto20="0"; 
  $checkmarkconcepto20=""; 
  $formula20=""; 
  $idtipoboleta20=""; 

  $clave = $_SESSION['id'];
  $idsindicato = $_SESSION['idsindicato'];
        $concepto="";
        $claveDesencriptada = SED::decryption($clave);
        $id=$claveDesencriptada;
        $swi=1;
        $concepto="";

        $sql2 = "SELECT * FROM conceptos WHERE idsindicato=$idsindicato AND seimprime=1 AND status=1";

        $resultado2 = mysqli_query($conn, $sql2);
        $filas = mysqli_num_rows($resultado2);
        $_SESSION['filas']=$filas;
        if ($filas>0) {
          while($data2 = mysqli_fetch_array($resultado2))
          {
                $concepto = $data2['id'];                     
                // Recorrer el explode

                $sql3 = "SELECT * FROM historialnomina WHERE id = $id";

                $result3 = mysqli_query($conn, $sql3);
                while($data3=mysqli_fetch_array($result3))
                  {
                    $idconcepto = $data3['idconcepto']; 
                    $periodo = $data3['periodo']; 

                    $tipoboleta = $data3['tipoboleta']; 
                    $cuit = $data3['cuit']; 
                    $cuil = $data3['cuil'];                          
                         
                    $exploded = explode(",", $idconcepto);          
                    $elementos=  substr_count($idconcepto, ','); 
                    $checkmark="";

                    for ($i=0; $i < $elementos; $i++) { 
                      $idconceptoexploded= $exploded[$i]; 
                      if ($concepto==$idconceptoexploded) {
                        $checkmark=true;
                      }          
                    }
                             
                    switch ($swi) {     
                     case 1:
                       $concepto1 = $data2['id']; 
                       $nombreconcepto1 = $data2['descripcion'];
                       $formula1 = $data2['porcentaje']; 
                       $idtipoboleta1 = $data2['idtipoboleta']; 
                       $checkmarkconcepto1 = $checkmark;
                       $_SESSION['concepto1'] = $formula1;
                       break;
                     case 2:
                       $concepto2 = $data2['id']; 
                       $nombreconcepto2 = $data2['descripcion'];
                       $formula2 = $data2['porcentaje']; 
                       $idtipoboleta2 = $data2['idtipoboleta']; 
                       $checkmarkconcepto2 = $checkmark;
                       break;
                     case 3:
                       $concepto3 = $data2['id']; 
                       $nombreconcepto3 = $data2['descripcion'];
                       $formula3 = $data2['porcentaje']; 
                       $idtipoboleta3 = $data2['idtipoboleta']; 
                       $checkmarkconcepto3 = $checkmark;
                       break;                        
                     case 4:
                       $concepto4 = $data2['id']; 
                       $nombreconcepto4 = $data2['descripcion'];
                       $formula4 = $data2['porcentaje']; 
                       $idtipoboleta4 = $data2['idtipoboleta']; 
                       $checkmarkconcepto4 = $checkmark;
                       break;
                     case 5:
                       $concepto5 = $data2['id']; 
                       $nombreconcepto5 = $data2['descripcion'];
                       $formula5 = $data2['porcentaje']; 
                       $idtipoboleta5 = $data2['idtipoboleta']; 
                       $checkmarkconcepto5 = $checkmark;
                       break;
                     case 6:
                       $concepto6 = $data2['id']; 
                       $nombreconcepto6 = $data2['descripcion'];
                       $formula6 = $data2['porcentaje']; 
                       $idtipoboleta6 = $data2['idtipoboleta']; 
                       $checkmarkconcepto6 = $checkmark;
                       break;
                     case 7:
                       $concepto7 = $data2['id']; 
                       $nombreconcepto7 = $data2['descripcion'];
                       $formula7 = $data2['porcentaje']; 
                       $idtipoboleta7 = $data2['idtipoboleta']; 
                       $checkmarkconcepto7 = $checkmark;
                       break;
                     case 8:
                       $concepto8 = $data2['id']; 
                       $nombreconcepto8 = $data2['descripcion'];
                       $formula8 = $data2['porcentaje']; 
                       $idtipoboleta8 = $data2['idtipoboleta']; 
                       $checkmarkconcepto8 = $checkmark;
                       break;
                     case 9:
                       $concepto9 = $data2['id']; 
                       $nombreconcepto9 = $data2['descripcion'];
                       $formula9 = $data2['porcentaje']; 
                       $idtipoboleta9 = $data2['idtipoboleta']; 
                       $checkmarkconcepto9 = $checkmark;
                       break;
                     case 10:
                       $concepto10 = $data2['id']; 
                       $nombreconcepto10 = $data2['descripcion'];
                       $formula10 = $data2['porcentaje']; 
                       $idtipoboleta10 = $data2['idtipoboleta']; 
                       $checkmarkconcepto10 = $checkmark;
                       break;
                     case 11:
                       $concepto11 = $data2['id']; 
                       $nombreconcepto11 = $data2['descripcion'];
                       $formula11 = $data2['porcentaje']; 
                       $idtipoboleta11 = $data2['idtipoboleta']; 
                       $checkmarkconcepto11 = $checkmark;
                       break;
                     case 12:
                       $concepto12 = $data2['id']; 
                       $nombreconcepto12 = $data2['descripcion'];
                       $formula12 = $data2['porcentaje']; 
                       $idtipoboleta12 = $data2['idtipoboleta']; 
                       $checkmarkconcepto12 = $checkmark;
                       break;
                     case 13:
                       $concepto13 = $data2['id']; 
                       $nombreconcepto13 = $data2['descripcion'];
                       $formula13 = $data2['porcentaje']; 
                       $idtipoboleta13 = $data2['idtipoboleta']; 
                       $checkmarkconcepto13 = $checkmark;
                       break;
                     case 14:
                       $concepto14 = $data2['id']; 
                       $nombreconcepto14 = $data2['descripcion'];
                       $formula14 = $data2['porcentaje']; 
                       $idtipoboleta14 = $data2['idtipoboleta']; 
                       $checkmarkconcepto14 = $checkmark;
                       break;
                     case 15:
                       $concepto15 = $data2['id']; 
                       $nombreconcepto15 = $data2['descripcion'];
                       $formula15 = $data2['porcentaje']; 
                       $idtipoboleta15 = $data2['idtipoboleta']; 
                       $checkmarkconcepto15 = $checkmark;
                       break;
                     case 16:
                       $concepto16 = $data2['id']; 
                       $nombreconcepto16 = $data2['descripcion'];
                       $formula16 = $data2['porcentaje']; 
                       $idtipoboleta16 = $data2['idtipoboleta']; 
                       $checkmarkconcepto16 = $checkmark;
                       break;
                     case 17:
                       $concepto17 = $data2['id']; 
                       $nombreconcepto17 = $data2['descripcion'];
                       $formula17 = $data2['porcentaje']; 
                       $idtipoboleta17 = $data2['idtipoboleta']; 
                       $checkmarkconcepto17 = $checkmark;
                       break;
                     case 18:
                       $concepto18 = $data2['id']; 
                       $nombreconcepto18 = $data2['descripcion'];
                       $formula18 = $data2['porcentaje']; 
                       $idtipoboleta18 = $data2['idtipoboleta']; 
                       $checkmarkconcepto18 = $checkmark;
                       break;
                     case 19:
                       $concepto19 = $data2['id']; 
                       $nombreconcepto19 = $data2['descripcion'];
                       $formula19 = $data2['porcentaje']; 
                       $idtipoboleta19 = $data2['idtipoboleta']; 
                       $checkmarkconcepto19 = $checkmark;
                       break;
                     case 20:
                       $concepto20 = $data2['id']; 
                       $nombreconcepto20 = $data2['descripcion'];
                       $formula20 = $data2['porcentaje']; 
                       $idtipoboleta20 = $data2['idtipoboleta']; 
                       $checkmarkconcepto20 = $checkmark;
                       break;                 
                     default:                   
                       break;
                    } 
                     $swi=$swi+1;
                  }                      
          }
        }else{
          $data = array("error" => '6');
          die(json_encode($data));
        }


        $sql = "SELECT * FROM nomina WHERE cuil=$cuil AND status=1";
 
        $resultado = mysqli_query($conn, $sql);
        while($data = mysqli_fetch_array($resultado))
        {
          $sueldo = $data['sueldo'];  
        }
        
        $claveEncriptada = SED::encryption($id);
        $id=$claveEncriptada;

        mysqli_close($conn);
        $data = array("exito" => '1',
          "id"=>$id, 
          "periodo"=> $periodo, 
          "tipoboleta"=>$tipoboleta,
          "cuit"=>$cuit, 
          "cuil"=>$cuil, 
          "sueldo"=>$sueldo, 
          "idconcepto"=>$idconcepto,
          "concepto1"=>$concepto1,            
          "nombreconcepto1"=>$nombreconcepto1,
          "checkmarkconcepto1"=>$checkmarkconcepto1,
          "formulaconcepto1"=>$formula1,
          "idtipoboleta1"=>$idtipoboleta1,
          "concepto2"=>$concepto2, 
          "nombreconcepto2"=>$nombreconcepto2,
          "checkmarkconcepto2"=>$checkmarkconcepto2,
          "formulaconcepto2"=>$formula2,
          "idtipoboleta2"=>$idtipoboleta2,
          "concepto3"=>$concepto3, 
          "nombreconcepto3"=>$nombreconcepto3,
          "checkmarkconcepto3"=>$checkmarkconcepto3, 
          "formulaconcepto3"=>$formula3,
          "idtipoboleta3"=>$idtipoboleta3,
          "concepto4"=>$concepto4, 
          "nombreconcepto4"=>$nombreconcepto4,
          "checkmarkconcepto4"=>$checkmarkconcepto4,
          "formulaconcepto4"=>$formula4,
          "idtipoboleta4"=>$idtipoboleta4,
          "concepto5"=>$concepto5, 
          "nombreconcepto5"=>$nombreconcepto5,
          "checkmarkconcepto5"=>$checkmarkconcepto5,
          "formulaconcepto5"=>$formula5,
          "idtipoboleta5"=>$idtipoboleta5,
          "concepto6"=>$concepto6, 
          "nombreconcepto6"=>$nombreconcepto6,
          "checkmarkconcepto6"=>$checkmarkconcepto6,
          "formulaconcepto6"=>$formula6,
          "idtipoboleta6"=>$idtipoboleta6,
          "concepto7"=>$concepto7, 
          "nombreconcepto7"=>$nombreconcepto7,
          "checkmarkconcepto7"=>$checkmarkconcepto7,
          "formulaconcepto7"=>$formula7,
          "idtipoboleta7"=>$idtipoboleta7,
          "concepto8"=>$concepto8, 
          "nombreconcepto8"=>$nombreconcepto8,
          "checkmarkconcepto8"=>$checkmarkconcepto8,
          "formulaconcepto8"=>$formula8,
          "idtipoboleta8"=>$idtipoboleta8,
          "concepto9"=>$concepto9, 
          "nombreconcepto9"=>$nombreconcepto9,
          "checkmarkconcepto9"=>$checkmarkconcepto9,
          "formulaconcepto9"=>$formula9,
          "idtipoboleta9"=>$idtipoboleta9,
          "concepto10"=>$concepto10, 
          "nombreconcepto10"=>$nombreconcepto10,
          "checkmarkconcepto10"=>$checkmarkconcepto10,
          "formulaconcepto10"=>$formula10,
          "idtipoboleta10"=>$idtipoboleta10,
          "concepto11"=>$concepto11, 
          "nombreconcepto11"=>$nombreconcepto11,
          "checkmarkconcepto11"=>$checkmarkconcepto11,
          "formulaconcepto11"=>$formula11,
          "idtipoboleta11"=>$idtipoboleta11,
          "concepto12"=>$concepto12, 
          "nombreconcepto12"=>$nombreconcepto12,
          "checkmarkconcepto12"=>$checkmarkconcepto12,
          "formulaconcepto12"=>$formula12,
          "idtipoboleta12"=>$idtipoboleta12,
          "concepto13"=>$concepto13, 
          "nombreconcepto13"=>$nombreconcepto13,
          "checkmarkconcepto13"=>$checkmarkconcepto13,
          "formulaconcepto13"=>$formula13,
          "idtipoboleta13"=>$idtipoboleta13,
          "concepto14"=>$concepto14, 
          "nombreconcepto14"=>$nombreconcepto14,
          "checkmarkconcepto14"=>$checkmarkconcepto14,
          "formulaconcepto14"=>$formula14,
          "idtipoboleta14"=>$idtipoboleta14,
          "concepto15"=>$concepto15, 
          "nombreconcepto15"=>$nombreconcepto15,
          "checkmarkconcepto15"=>$checkmarkconcepto15,
          "formulaconcepto15"=>$formula15,
          "idtipoboleta15"=>$idtipoboleta15,
          "concepto16"=>$concepto16, 
          "nombreconcepto16"=>$nombreconcepto16,
          "checkmarkconcepto16"=>$checkmarkconcepto16,
          "formulaconcepto16"=>$formula16,
          "idtipoboleta16"=>$idtipoboleta16,
          "concepto17"=>$concepto17, 
          "nombreconcepto17"=>$nombreconcepto17,
          "checkmarkconcepto17"=>$checkmarkconcepto17,
          "formulaconcepto17"=>$formula17,
          "idtipoboleta17"=>$idtipoboleta17,
          "concepto18"=>$concepto18, 
          "nombreconcepto18"=>$nombreconcepto18,
          "checkmarkconcepto18"=>$checkmarkconcepto18,
          "formulaconcepto18"=>$formula18,
          "idtipoboleta18"=>$idtipoboleta18,
          "concepto19"=>$concepto19, 
          "nombreconcepto19"=>$nombreconcepto19,
          "checkmarkconcepto19"=>$checkmarkconcepto19,
          "formulaconcepto19"=>$formula19,
          "idtipoboleta19"=>$idtipoboleta19,
          "concepto20"=>$concepto20, 
          "nombreconcepto20"=>$nombreconcepto20,
          "checkmarkconcepto20"=>$checkmarkconcepto20,
          "formulaconcepto20"=>$formula20,
          "idtipoboleta20"=>$idtipoboleta20
        );         
       die(json_encode($data));  
 }



function buscarCadena($cadena){
  //let $mystring = $cadena;
  $findme   = '#';
  $pos = strpos($cadena, $findme);
  if ($pos === false) {
  } else {
      $cadena="";
  }  
  return $cadena;
}

if($option=="modificar"){  
  $token = isset($_POST['token']) ? $token = $_POST['token'] :  $token= "";
  if($_SESSION['token'] == $token){

      $clave = $_POST['id'];

      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada; 

      $tipoboleta = $_POST['tipoboleta'];

      $_POST['conceptoOculto1'] = isset($_POST['conceptoOculto1']) ? $conceptoOculto1 = $_POST['conceptoOculto1'] : $conceptoOculto1 = "";  
      $_POST['conceptoOculto2'] = isset($_POST['conceptoOculto2']) ? $conceptoOculto2 = $_POST['conceptoOculto2'] : $conceptoOculto2 = "";
      $_POST['conceptoOculto3'] = isset($_POST['conceptoOculto3']) ? $conceptoOculto3 = $_POST['conceptoOculto3'] : $conceptoOculto3 = "";
      $_POST['conceptoOculto4'] = isset($_POST['conceptoOculto4']) ? $conceptoOculto4 = $_POST['conceptoOculto4'] : $conceptoOculto4 = "";
      $_POST['conceptoOculto5'] = isset($_POST['conceptoOculto5']) ? $conceptoOculto5 = $_POST['conceptoOculto5'] : $conceptoOculto5 = "";
      $_POST['conceptoOculto6'] = isset($_POST['conceptoOculto6']) ? $conceptoOculto6 = $_POST['conceptoOculto6'] : $conceptoOculto6 = "";
      $_POST['conceptoOculto7'] = isset($_POST['conceptoOculto7']) ? $conceptoOculto7 = $_POST['conceptoOculto7'] : $conceptoOculto7 = "";
      $_POST['conceptoOculto8'] = isset($_POST['conceptoOculto8']) ? $conceptoOculto8 = $_POST['conceptoOculto8'] : $conceptoOculto8 = "";
      $_POST['conceptoOculto9'] = isset($_POST['conceptoOculto9']) ? $conceptoOculto9 = $_POST['conceptoOculto9'] : $conceptoOculto9 = "";
      $_POST['conceptoOculto10'] = isset($_POST['conceptoOculto10']) ? $conceptoOculto10 = $_POST['conceptoOculto10'] : $conceptoOculto10 = "";
      $_POST['conceptoOculto11'] = isset($_POST['conceptoOculto11']) ? $conceptoOculto11 = $_POST['conceptoOculto11'] : $conceptoOculto11 = "";
      $_POST['conceptoOculto12'] = isset($_POST['conceptoOculto12']) ? $conceptoOculto12 = $_POST['conceptoOculto12'] : $conceptoOculto12 = "";
      $_POST['conceptoOculto13'] = isset($_POST['conceptoOculto13']) ? $conceptoOculto13 = $_POST['conceptoOculto13'] : $conceptoOculto13 = "";
      $_POST['conceptoOculto14'] = isset($_POST['conceptoOculto14']) ? $conceptoOculto14 = $_POST['conceptoOculto14'] : $conceptoOculto14 = "";
      $_POST['conceptoOculto15'] = isset($_POST['conceptoOculto15']) ? $conceptoOculto15 = $_POST['conceptoOculto15'] : $conceptoOculto15 = "";
      $_POST['conceptoOculto16'] = isset($_POST['conceptoOculto16']) ? $conceptoOculto16 = $_POST['conceptoOculto16'] : $conceptoOculto16 = "";
      $_POST['conceptoOculto17'] = isset($_POST['conceptoOculto17']) ? $conceptoOculto17 = $_POST['conceptoOculto17'] : $conceptoOculto17 = "";
      $_POST['conceptoOculto18'] = isset($_POST['conceptoOculto18']) ? $conceptoOculto18 = $_POST['conceptoOculto18'] : $conceptoOculto18 = "";
      $_POST['conceptoOculto19'] = isset($_POST['conceptoOculto19']) ? $conceptoOculto19 = $_POST['conceptoOculto19'] : $conceptoOculto19 = "";
      $_POST['conceptoOculto20'] = isset($_POST['conceptoOculto20']) ? $conceptoOculto20 = $_POST['conceptoOculto20'] : $conceptoOculto20 = "";

      $conceptoOculto1= buscarCadena($conceptoOculto1);
      $conceptoOculto2= buscarCadena($conceptoOculto2);
      $conceptoOculto3= buscarCadena($conceptoOculto3);
      $conceptoOculto4= buscarCadena($conceptoOculto4);
      $conceptoOculto5= buscarCadena($conceptoOculto5);
      $conceptoOculto6= buscarCadena($conceptoOculto6);
      $conceptoOculto7= buscarCadena($conceptoOculto7);
      $conceptoOculto8= buscarCadena($conceptoOculto8);
      $conceptoOculto9= buscarCadena($conceptoOculto9);
      $conceptoOculto10= buscarCadena($conceptoOculto10);
      $conceptoOculto11= buscarCadena($conceptoOculto11);
      $conceptoOculto12= buscarCadena($conceptoOculto12);
      $conceptoOculto13= buscarCadena($conceptoOculto13);
      $conceptoOculto14= buscarCadena($conceptoOculto14);
      $conceptoOculto15= buscarCadena($conceptoOculto15);
      $conceptoOculto16= buscarCadena($conceptoOculto16);
      $conceptoOculto17= buscarCadena($conceptoOculto17);
      $conceptoOculto18= buscarCadena($conceptoOculto18);
      $conceptoOculto19= buscarCadena($conceptoOculto19);
      $conceptoOculto20= buscarCadena($conceptoOculto20);
      
      $idconcepto =  $conceptoOculto1 .",". $conceptoOculto2 .",". $conceptoOculto3 .",". $conceptoOculto4 .",". $conceptoOculto5 .",". 
                    $conceptoOculto6 .",". $conceptoOculto7 .",". $conceptoOculto8 .",". $conceptoOculto9 .",". $conceptoOculto10 .",". 
                    $conceptoOculto11 .",". $conceptoOculto12 .",". $conceptoOculto13 .",". $conceptoOculto14 .",". $conceptoOculto15 .",". 
                    $conceptoOculto16 .",". $conceptoOculto17 .",". $conceptoOculto18 .",". $conceptoOculto19 .",". $conceptoOculto20;
      // var_dump($idconcepto);
      // die();
      if(empty($clave) OR empty($tipoboleta))   
      {
        $data = array("error" => '2');
        die(json_encode($data));
      }

      $sql = "UPDATE historialnomina SET   
      tipoboleta = '$tipoboleta', idconcepto = '$idconcepto'
      WHERE id = $clave";       

      if (mysqli_query($conn, $sql)) {               
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } 
        
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}


if($option=="eliminar"){
  $token = isset($_GET['token']) ? $token = $_GET['token'] :  $token= "";
  if($_SESSION['token'] == $token){
      $clave = $_GET['id'];
      
      $claveDesencriptada = SED::decryption($clave);
      $clave=$claveDesencriptada;

      $sql = "DELETE FROM pagos  WHERE id = $clave";
      if (mysqli_query($conn, $sql)) {
        
        mysqli_close($conn);
        $data = array("exito" => '1');
        die(json_encode($data));
      } else {
        if(mysqli_errno($conn)==1451){
          $data = array("error" => '2', "errorDescription" => mysqli_error($conn));          
          die(json_encode($data));  
        } 
        mysqli_close($conn);
        $data = array("error" => '1');
        die(json_encode($data));
      }
  }else{
    $data = array("error" => '4');
    die(json_encode($data));
  }
}

mysqli_close($conn);