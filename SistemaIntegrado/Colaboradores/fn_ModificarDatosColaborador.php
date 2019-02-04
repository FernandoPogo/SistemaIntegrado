<?php
  require_once "../DataBase/ConexionBD.php";
  session_start();
  
  $fotoName = $_FILES["FotoC"]["name"];
  $fotoTmpLoc = $_FILES["FotoC"]["tmp_name"]; 
  $fotoType = $_FILES["FotoC"]["type"]; 
  $fotoSize = $_FILES["FotoC"]["size"]; 
  $fotoErrorMsg = $_FILES["FotoC"]["error"]; 
 
  $NombreUsuario=$_POST["NombreUsuario"];   
  $FotoC = "../Almacenamiento/$NombreUsuario/Perfil/$fotoName";

  if (!$fotoTmpLoc) 
  {
    $FotoC = $_POST["ruta"];
  }

    $CedulaC=$_POST["CedulaC"];
    $FechaNacimientoC=$_POST["FechaNacimientoC"];
    $DireccionC=$_POST["DireccionC"];
    $TelefonoC=$_POST["TelefonoC"];
    $SexoC=$_POST["SexoC"];
    $EstadoC=$_POST["EstadoC"];
    
    $StoreProcedure =' CALL sp_ModificarColaborador(\''.$NombreUsuario.'\',\''.$CedulaC.'\',\''.$FechaNacimientoC.'\',\''.$DireccionC.'\',\''.$TelefonoC.'\',\''.$SexoC.'\',\''.$EstadoC.'\',\''.$FotoC.'\');';

    $q=$conexion->exec($StoreProcedure);

    move_uploaded_file($fotoTmpLoc, $FotoC); 

?>
