<?php
  require_once "../DataBase/ConexionBD.php";
  
  $CodigoForo=$_POST["CodigoForo"];  
  $EstadoForo=$_POST["EstadoForo"];
  
  $StoreProcedure ='CALL sp_ModificarEstadoMisForos ('.$CodigoForo.','.$EstadoForo.');';
  $q=$conexion->exec($StoreProcedure);
?>


