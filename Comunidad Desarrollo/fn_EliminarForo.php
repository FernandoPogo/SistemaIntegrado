<?php
  require_once "../DataBase/ConexionBD.php";
  
  $CodigoForo=$_POST["CodigoForo"];  
   
  $StoreProcedure =' CALL sp_EliminarForo ('.$CodigoForo.');';
  $q=$conexion->exec($StoreProcedure);

?>

