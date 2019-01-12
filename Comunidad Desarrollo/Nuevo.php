<?php
  require_once "../DataBase/ConexionBD.php";
  session_start();
  
  if(isset($_POST["TemaForo"])  && isset($_POST["DescripcionForo"]))
  {
    $TemaForo=$_POST["TemaForo"];
    $DescripcionForo=$_POST["DescripcionForo"];
    $EstadoForo=$_POST["EstadoForo"];
    $TipoForo=$_POST["TipoForo"];
    $NombreUsuario=$_SESSION["NombreUsuario"];
    $MateriaForo=$_POST["MateriaForo"];
    $Mensaje = "@v_Mensaje";
        
    $StoreProcedure =' CALL sp_RegistrarForo (\''.$TemaForo.'\',\''.$DescripcionForo.'\',\''.$EstadoForo.'\',\''.$TipoForo.'\',\''.$NombreUsuario.'\',\''.$MateriaForo.'\',@v_Mensaje);';
    $q=$conexion->exec($StoreProcedure);

    $StoreProcedure = 'Select '.$Mensaje;
    
    $res=$conexion->query($StoreProcedure)->fetch();
    $Mensaje = $res[$Mensaje];
        
    header( 'Location: ../Principal/index.php' ) ; 
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <?php
    require "../Principal/head.php";
  ?>
  <style>
    .jumbotron 
    {
      padding-top: 20px;
      padding-bottom: 20px;
    }

    .bottom5 
    { 
      margin-bottom:20px; 
    }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php
  require "../Principal/navbar.php";
  ?>
  <div class="content-wrapper bg-light">    
    <div class="container">
      <div class="jumbotron">
        <h2 class="display-4" align="center">Nuevo Foro de Discusión</h2>
      </div>
    </div>
    <div class="row bottom5">
      <div class="col-8 offset-2">
        <div class="card">
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label for="MateriaForo">Materia</label>
                <select class="form-control" id="MateriaForo" name="MateriaForo">
                <?php
                  require_once "../DataBase/ConexionBD.php";

                  $StoreProcedure="CALL sp_obtenerMaterias";
                  $resultado = $conexion->query($StoreProcedure);
                  
                  foreach ($resultado as $materia) 
                  {
                    echo('<option>' . $materia['NombreMateria'] . '</option>'); 
                  }                  
                ?>
                </select>
              </div>
              
              <div class="form-group">
                <label for="TemaForo">Tema de discusión</label>
                <input type="text" class="form-control" name="TemaForo" id="TemaForo" placeholder="Tema" required>
              </div>
               
              <div class="form-group">
                <div class="form-row">
                  <div class="col-6 "> 
                    <label for="EstadoForo">Estado</label>
                    <select class="form-control" id="EstadoForo" name="EstadoForo">;
                      <option>Activo</option>
                      <option>Inactivo</option>
                    </select>
                  </div> 
                  <div class="col-6"> 
                    <label for="TipoForo">Tipo</label>
                    <select class="form-control" id="TipoForo" name="TipoForo">;
                      <option>Publico</option>
                      <option>Privado</option>
                    </select>
                  </div> 
                </div>              
              </div>

              <div class="form-group">
                <label for="DescripcionForo">Descripcion</label>
                <textarea rows="3" class="form-control" name="DescripcionForo" id="DescripcionForo" placeholder="Descripcion" required></textarea>
              </div>
                            
              <div class="form-group">
                <div class="form-row">
                  <div class="col-4 offset-4">
                    <button type="button" class="btn btn-danger btn-block" onclick="javascript:location.href='../Principal/index.php'">Cancelar</button>
                  </div>
                  <div class="col-4">
                    <input class="btn btn-primary btn-block" type="submit" value="Subir">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
      require "../Principal/footer.php";
    ?>
  </div>
<!-- Bootstrap core JavaScript-->
  <script src="../Frameworks/jquery/jquery.min.js"></script>
  <script src="../Frameworks/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../Frameworks/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>

