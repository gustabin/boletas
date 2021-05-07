<?php 
require_once('../../tools/mypathdb.php'); 
require_once('vendor/php-excel-reader/excel_reader2.php'); 
require_once('vendor/SpreadsheetReader.php'); 

if (isset($_POST["import"]))
{    
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];  
      if(in_array($_FILES["file"]["type"],$allowedFileType)){
            $targetPath = 'subidas/'.$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);        
            $Reader = new SpreadsheetReader($targetPath);        
            $sheetCount = count($Reader->sheets());
            for($i=0;$i<$sheetCount;$i++)
            {            
            $Reader->ChangeSheet($i);            
            foreach ($Reader as $Row)
            {          
                $documento = "";
                if(isset($Row[0])) {
                    $documento = mysqli_real_escape_string($conn,$Row[0]);
                }
                $cuil = "";
                if(isset($Row[1])) {
                    $cuil = mysqli_real_escape_string($conn,$Row[1]);
                }
                $nombre = "";
                if(isset($Row[2])) {
                    $nombre = mysqli_real_escape_string($conn,$Row[2]);
                }        
                $apellido = "";
                if(isset($Row[3])) {
                    $apellido = mysqli_real_escape_string($conn,$Row[3]);
                }               
                $telefono = "";
                if(isset($Row[4])) {
                    $telefono = mysqli_real_escape_string($conn,$Row[4]);
                }  
                $direccion = "";
                if(isset($Row[5])) {
                    $direccion = mysqli_real_escape_string($conn,$Row[5]);
                }  
                $localidad = "";
                if(isset($Row[6])) {
                    $localidad = mysqli_real_escape_string($conn,$Row[6]);
                } 
                $nacimiento = "";
                if(isset($Row[7])) {
                    $nacimiento = mysqli_real_escape_string($conn,$Row[7]);
                } 
                $sueldo = "";
                if(isset($Row[8])) {
                    $sueldo = mysqli_real_escape_string($conn,$Row[8]);
                } 
                if(isset($Row[9])) {
                    $baja = mysqli_real_escape_string($conn,$Row[9]);      
                }
                if(isset($Row[10])) {
                    $alta = mysqli_real_escape_string($conn,$Row[10]);
                }         

                // $nacimiento = date("Y-m-d", strtotime($nacimiento));
                // $alta = date("Y-m-d", strtotime($alta));
                // $baja = date("Y-m-d", strtotime($baja));
                // if ($alta == '1970-01-01') {
                //     $alta = 'NULL';      
                // } 
                // if ($baja == '1970-01-01') {
                //     $baja = 'NULL';      
                // }  
                $sexo =0;
                $idestadocivil =1;
                $idsindicato =$_SESSION['idsindicato'];
                $idseccional =1;
                $idnacionalidad =1;
                $idsituacionrevista =1;
                $idcategoriaempleado =1;
                $idempresa =1;
                $idtipodocumento =1;
                $provincia =1;
                $idusuarioalta=$_SESSION['idusuario'];

                if (!empty($nombre) || !empty($precio) || !empty($descripcion) || !empty($codigo) || !empty($stock) ) {
                    $sql = "insert into padron(documento, cuil, nombre, apellido, sexo, telefono, direccion, localidad, provincia, nacimiento, idestadocivil, idsindicato, idseccional, idnacionalidad, idsituacionrevista, idcategoriaempleado, idempresa, idtipodocumento, baja, alta, fecha, idusuarioalta) 
                        VALUES('$documento', '$cuil', '$nombre', '$apellido', '$sexo', '$telefono', '$direccion', '$localidad', '$provincia', $nacimiento,
                        '$idestadocivil', '$idsindicato', '$idseccional', '$idnacionalidad', '$idsituacionrevista', '$idcategoriaempleado', '$idempresa',
                        '$idtipodocumento', $baja, $alta, NOW(), $idusuarioalta)";
                        // var_dump($sql);
                        // die();

                    $resultados = mysqli_query($conn, $sql);                
                    if (! empty($resultados)) {
                        $type = "success";
                        $message = "Excel importado correctamente";
                    } else {
                        $type = "danger";
                        $message = "No se importaron todos los empleados. ";
                    }
                }
             }        
         }
  }
  else
  { 
        $type = "warning";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
  }
}
?>