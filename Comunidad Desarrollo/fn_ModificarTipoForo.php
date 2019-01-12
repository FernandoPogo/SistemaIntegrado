<?php
  require_once "../DataBase/ConexionBD.php";
  
  $CodigoForo=$_POST["CodigoForo"];  
  $TipoForo=$_POST["TipoForo"];   

  $StoreProcedure ='CALL sp_ModificarTipoMisForos ('.$CodigoForo.',\''.$TipoForo.'\');';
  $q=$conexion->exec($StoreProcedure);

?>


