<?php
  require_once "../DataBase/ConexionBD.php";
  session_start();

  $fileName = $_FILES["ArchivoOA"]["name"];
  $fileTmpLoc = $_FILES["ArchivoOA"]["tmp_name"]; 
  $fileType = $_FILES["ArchivoOA"]["type"]; 
  $fileSize = $_FILES["ArchivoOA"]["size"]; 
  $fileErrorMsg = $_FILES["ArchivoOA"]["error"]; 

  if (!$fileTmpLoc) 
  {
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
  }

  $NombreUsuario = $_POST["NombreUsuario"];
  if(move_uploaded_file($fileTmpLoc, "../Almacenamiento/$NombreUsuario/$fileName"))
  {
    $NombreOA=$_POST["NombreOA"];
    $DescripcionOA=$_POST["DescripcionOA"];
    $Archivo="../Almacenamiento/$NombreUsuario/$fileName";
    $EstadoOA=$_POST["EstadoOA"];
    $TipoOA=$_POST["TipoOA"];
    $MateriaOA=$_POST["MateriaOA"];
    $Mensaje = "@v_Mensaje";

    $StoreProcedure =' CALL sp_RegistrarObjetoAprendizaje (\''.$NombreOA.'\',\''.$DescripcionOA.'\',\''.$Archivo.'\',\''.$EstadoOA.'\',\''.$TipoOA.'\',\''.$NombreUsuario.'\',\''.$MateriaOA.'\',@v_Mensaje);';
    $q=$conexion->exec($StoreProcedure);

    $StoreProcedure = 'Select '.$Mensaje;
    
    $res=$conexion->query($StoreProcedure)->fetch();
    $Mensaje = $res[$Mensaje];
        
    header( 'Location: ../Principal/index.php' ) ; 
  }
  else 
  {
    echo "move_uploaded_file function failed";
  }
?>
