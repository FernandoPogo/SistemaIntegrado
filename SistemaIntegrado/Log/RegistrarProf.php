<?php
require_once "../DataBase/ConexionBD.php";

if ( isset($_POST["correo"]) && isset($_POST["nombresUsuario"]) && isset($_POST["apellidosUsuario"]) && isset($_POST["nombreUsuario"])
    && isset($_POST["password"]) && isset($_POST["confirmarpassword"]) && isset($_POST["seccionUsuario"])) 
{
  if ($_POST["password"] == $_POST["confirmarpassword"]) 
  { 
    $CorreoUsuario=$_POST["correo"];
    $NombresUsuario=$_POST["nombresUsuario"];
    $ApellidosUsuario=$_POST["apellidosUsuario"];
    $NombreUsuario=$_POST["nombreUsuario"];
    $PasswordUsuario=$_POST["password"];
    $TipoUsuario="Profesor";
    $SeccionUsuario=$_POST["seccionUsuario"];
    $Mensaje = "@v_Mensaje";

    if (mkdir("../Almacenamiento/$NombreUsuario", 0777, true)) 
    {
      chmod("../Almacenamiento/$NombreUsuario", 0777);
      mkdir("../Almacenamiento/$NombreUsuario/Repositorio", 0777, true);
      chmod("../Almacenamiento/$NombreUsuario/Repositorio", 0777);
      mkdir("../Almacenamiento/$NombreUsuario/Comentarios", 0777, true);
      chmod("../Almacenamiento/$NombreUsuario/Comentarios", 0777);
      mkdir("../Almacenamiento/$NombreUsuario/Perfil", 0777, true);
      chmod("../Almacenamiento/$NombreUsuario/Perfil", 0777);

      $StoreProcedure =' CALL sp_RegistrarUsuario (\''.$CorreoUsuario.'\',\''.$NombresUsuario.'\',\''.$ApellidosUsuario.'\',\''.$NombreUsuario.'\',\''.$PasswordUsuario.'\',\''.$TipoUsuario.'\',\''.$SeccionUsuario.'\','.$Mensaje.');';    
      $q=$conexion->exec($StoreProcedure);

      $StoreProcedure = 'Select '.$Mensaje;
    
      $res=$conexion->query($StoreProcedure)->fetch();
      $Mensaje = $res[$Mensaje];

      echo "<script>alert('$Mensaje');</script>";

      header( 'Location: ../Principal/index.php' ) ;
    }
    echo "<script>alert('El usuario ya existe');</script>";
  }  
  else 
  {
    $_SESSION['ErrorRegEst'] = 'Contraseñas no coinciden.';
  }
}  
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 

<head>
  <?php
    require "../Principal/head.php";
  ?>

  <style>
    .bottom5 { 
        margin-bottom:70px; 
    }
  </style>
</head>

<body class="bg-dark">
  <div class="container">
    <?php
      if ( isset($_SESSION["ErrorRegEst"]) ) 
      {
        echo('<div class="alert alert-danger alert-dismissable">');
        echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
        echo('<strong>Error! </strong>' . $_SESSION["ErrorRegEst"]);
        echo('</div>');
        unset($_SESSION["ErrorRegEst"]);
      }
    ?>
    <div class="card card-register mx-auto mt-5 bottom5">
      <h4 class="card-header">Registro de Profesor</h4>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="CorreoElectronico">Correo electronico</label>
            <input class="form-control" id="correo" name="correo" type="email" maxlength="50" placeholder="Ingrese su correo electronico" required>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="nombresUsuario">Nombres</label>
                <input class="form-control" id="nombresUsuario" name="nombresUsuario" type="text" maxlength="50" placeholder="Ingrese sus nombres" required>
              </div>
              <div class="col-md-6">
                <label for="apellidosUsuario">Apellidos</label>
                <input class="form-control" id="apellidosUsuario" name="apellidosUsuario" type="text" placeholder="Ingrese sus apellidos" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nombreUsuario">Usuario</label>
            <input class="form-control" id="nombreUsuario" name="nombreUsuario" type="text" maxlength="50" placeholder="Ingrese su usuario" required>
          </div>
          <div class="form-group">
            <div class="form-row"> 
              <div class="col-md-6"> 
                <label for="password">Contraseña</label> 
                <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required> 
              </div> 
              <div class="col-md-6"> 
                <label for="confirmarpassword">Confirmar contraseña</label> 
                <input class="form-control" id="confirmarpassword" name="confirmarpassword" type="password" placeholder="Confirmar contraseña" required> 
              </div> 
            </div>

            <div class="form-group">
              <label for="seccionUsuario">Seccion</label>
              <select class="form-control" id="seccionUsuario" name="seccionUsuario">
              <?php
                $TipoUsuario = "Profesor";
                $StoreProcedure = 'CALL sp_ObtenerSecciones (\''.$TipoUsuario.'\')';
                $resultado=$conexion->query($StoreProcedure);
                $Facultad = '';
                foreach ($resultado as $row) 
                {
                  if ($row['NombreFacultad'] != $Facultad) 
                  {
                    $Facultad = $row['NombreFacultad'];
                    echo('<optgroup label="' . $Facultad . '">');
                  }
		  $Seccion = $row['NombreSeccion'];
                  echo('<option>' . $Seccion . '</option>');
                }
                echo('</optgroup>');
                ?>
              </select>      
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Registrar">
        </form>
      
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="../Frameworks/jquery/jquery.min.js"></script>
  <script src="../Frameworks/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../Frameworks/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
