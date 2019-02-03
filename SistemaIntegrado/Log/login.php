<?php
  require_once "../DataBase/ConexionBD.php";
  session_start();

  if ( isset($_POST["NombreUsuario"]) && isset($_POST["PasswordUsuario"]) && isset($_POST["TipoUsuario"]) ) 
  {
    $Nombre = $_POST["NombreUsuario"];
    $Password = $_POST["PasswordUsuario"];
    $Tipo = $_POST["TipoUsuario"];
    $Mensaje = "@v_Mensaje";

    $StoreProcedure ='CALL sp_VerificarUsuarioPassword (\''.$Nombre.'\',\''.$Password.'\',\''.$Tipo.'\','.$Mensaje.');';
    $q=$conexion->exec($StoreProcedure);

    $StoreProcedure = 'Select '.$Mensaje;
    
    $res=$conexion->query($StoreProcedure)->fetch();
    $Mensaje = $res[$Mensaje];
    
    if($Mensaje=='Administrador'||$Mensaje=='Profesor'||$Mensaje=='Estudiante')
    {
      $_SESSION["Usuario"] = $_POST["NombreUsuario"];
      $_SESSION["TipoUsuario"] = $_POST["TipoUsuario"];
      $_SESSION["IDUsuario"] = $result[$idType];
      if ($_POST["TipoUsuario"] != 'Administrador') 
      {
        $_SESSION["NombreUsuario"] = $Nombre;
      }
      header( 'Location: ../Principal/index.php' ) ;
      return;
    }
    $_SESSION['errorLog']=$Mensaje;
  }
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 

  <head>
    <?php
      require "../Principal/head.php";
    ?>
  </head>

  <body class="bg-dark">
    <div class="container">
      <?php
        if ( isset($_SESSION["ErrorLog"]) ) {
          echo('<div class="alert alert-danger alert-dismissable">');
          echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
          echo('<strong>Error! </strong>' . $_SESSION["ErrorLog"]);
          echo('</div>');
          unset($_SESSION["ErrorLog"]);
        }
      ?>
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Ingreso al Sistema</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <select class="form-control" id="TipoUsuario" name="TipoUsuario">
                <option value="Administrador">Administrador</option>
                <option value="Profesor">Profesor</option>
                <option value="Estudiante">Estudiante</option>
              </select>
            </div>
            <div class="form-group">
              <label for="Usuario">Usuario</label>
              <input class="form-control" id="NombreUsuario" name="NombreUsuario" type="text" placeholder="Ingresar Usuario" required>
            </div>
            <div class="form-group">
              <label for="Contraseña">Contraseña</label>
              <input class="form-control" id="PasswordUsuario" name="PasswordUsuario" type="password" placeholder="Ingresar Contraseña" required>
            </div>
            <input class="btn btn-primary btn-block" type="submit" value="Ingresar">
            <a class="btn btn-danger btn-block" href="../Principal/index.php">Cancelar</a>
          </form>
          <div class="text-center">
            <a class="btn btn-link"  data-toggle="modal" data-target="#OpcionesDeRegistro" href="">Registrarse</a>
          </div>
        </div>
      </div>
    </div>


<div class="modal fade" id="OpcionesDeRegistro" tabindex="-1" role="dialog" aria-labelledby="OpcionesDeRegistroLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Seleccione el tipo de registro</div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="RegistrarProf.php">Profesor</a>
        <a class="btn btn-success" href="RegistrarEst.php">Estudiante</a>
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
