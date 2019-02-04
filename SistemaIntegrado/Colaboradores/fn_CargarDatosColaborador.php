<?php
  require_once "../DataBase/ConexionBD.php";
  session_start();
  
  $fotoName = $_FILES["FotoC"]["name"];
  $fotoTmpLoc = $_FILES["FotoC"]["tmp_name"]; 
  $fotoType = $_FILES["FotoC"]["type"]; 
  $fotoSize = $_FILES["FotoC"]["size"]; 
  $fotoErrorMsg = $_FILES["FotoC"]["error"]; 
 
  if (!$fotoTmpLoc) 
  {
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
  }

    $NombreUsuario=$_POST["NombreUsuario"];
    $CedulaC=$_POST["CedulaC"];
    $FechaNacimientoC=$_POST["FechaNacimientoC"];
    $DireccionC=$_POST["DireccionC"];
    $TelefonoC=$_POST["TelefonoC"];
    $SexoC=$_POST["SexoC"];
    $FotoC = "../Almacenamiento/$NombreUsuario/Perfil/$fotoName";

    move_uploaded_file($fotoTmpLoc, $FotoC);

    $StoreProcedure =' CALL sp_RegistrarColaborador(\''.$NombreUsuario.'\',\''.$CedulaC.'\',\''.$FechaNacimientoC.'\',\''.$DireccionC.'\',\''.$TelefonoC.'\',\''.$SexoC.'\',\''.$FotoC.'\');';
    $q=$conexion->exec($StoreProcedure);  
?>
