<?php
  require_once "../DataBase/ConexionBD.php";
  session_start();
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
        <h2 class="display-4" align="center">Nuevo Colaborador</h2>
      </div>
    </div>
    <div class="row bottom5">
      <div class="col-8 offset-2">
        <div class="card">
          <div class="card-body">
            <form method="post" enctype='multipart/form-data'>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="CedulaC">Cédula de identidad</label>
                    <input type="text" class="form-control" name="CedulaC" id="CedulaC" placeholder="Cedula" required>
                  </div>
                  <div class="col-md-6">
                    <label for="FechaNacimientoC">Fecha Nacimiento</label>
                    <input class="form-control" id="FechaNacimientoC" name="FechaNacimientoC" type="date" maxlength="50" placeholder="Ingrese su fecha de nacimiento" required>
                  </div>
                </div>
              </div>               

              <?php
                require ('../DataBase/ConexionBD.php');
          
                $Usuario=$_SESSION["NombreUsuario"];     

                $StoreProcedure ='CALL sp_ObtenerDatosColaborador (\''.$Usuario.'\');';
                $resultado=$conexion->prepare($StoreProcedure);

                if($resultado->execute())
                {  
                  while ($fila = $resultado->fetch()) 
                  {
                    $NombresUsuario=$fila['NombresUsuario'];
                    $ApellidosUsuario=$fila['ApellidosUsuario'];
                    $CorreoElectronicoUsuario=$fila['CorreoElectronicoUsuario'];

                    echo '<div class="form-group">';
                      echo '<div class="form-row">';
                        echo '<div class="col-md-6">';
                          echo '<label for="nombresUsuario">Nombres</label>';
                          echo '<input class="form-control" id="nombresUsuario" name="nombresUsuario" type="text" maxlength="50" value="'.$NombresUsuario.'" disabled>';
                        echo '</div>';
                      echo '<div class="col-md-6">';
                        echo '<label for="apellidosUsuario">Apellidos</label>';
                        echo '<input class="form-control" id="apellidosUsuario" name="apellidosUsuario" type="text" value="'.$ApellidosUsuario.'" disabled>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';

                  echo '<div class="form-group">';
                    echo '<label for="CorreoElectronicoC">Correo Electronico</label>';
                    echo '<input type="text" class="form-control" name="CorreoElectronicoC" id="CorreoElectronicoC" value="'.$CorreoElectronicoUsuario.'" disabled>';
                  echo'</div>';
                }
              }      
            ?>

              <div class="form-group">
                <label for="DireccionC">Direccion</label>
                <input type="text" class="form-control" name="DireccionC" id="DireccionC" placeholder="Direccion" required>
              </div>
          
              <div class="form-group">
                <div class="form-row">
                  <div class="col-6"> 
                    <label for="TelefonoC">Telefono</label>
                    <input class="form-control" id="TelefonoC" name="TelefonoC" type="text" placeholder="Ingrese su telefono" required>
                  </div> 
                  <div class="col-6 "> 
                    <label for="SexoC">Sexo</label>
                    <select class="form-control" id="SexoC" name="SexoC">;
                      <option>Masculino</option>
                      <option>Femenino</option>
                    </select>
                  </div>
                </div>                       
              </div>
                  
              <div class="form-group">
                <label for="FotoC">Adjuntar Fotografia</label>
                <input type="file" class="form-control" name="FotoC" id="FotoC">
              </div>         
 
              <div class="form-group">
                <div class="form-row">
                  <div class="col-4 offset-4">
                    <button type="button" class="btn btn-danger btn-block" onclick="javascript:location.href='../Principal/index.php'">Cancelar</button>
                  </div>
                  <?php
                    echo '<div class="col-4">';
                      echo '<button type="button" class="btn btn-success btn-block"  onclick="CargarDatosColaborador(\''.$_SESSION["NombreUsuario"].'\')">Registrar Colaborador</button>';
                    echo '</div>';
                  ?>
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

    <script>
    function _(dato) 
    {
      return document.getElementById(dato).value;
    }

    function CargarDatosColaborador(NombreUsuario) 
    {			
      if (_('CedulaC') == '' || _('FechaNacimientoC') == '' || _('DireccionC') == '' || _('TelefonoC') == '' || _('SexoC') == '') 
      {
        alert("Error uno o mas campos vacios");
      } 
      else 
      {
        var FotoC = document.getElementById("FotoC").files[0];
        var formdata = new FormData();
        formdata.append("NombreUsuario",NombreUsuario);
        formdata.append("CedulaC", _("CedulaC"));
        formdata.append("FechaNacimientoC", _("FechaNacimientoC"));
        formdata.append("DireccionC", _("DireccionC"));
        formdata.append("TelefonoC", _("TelefonoC"));
        formdata.append("SexoC", _("SexoC"));
        formdata.append("FotoC", FotoC);
                
        $.ajax({  	url: "fn_CargarDatosColaborador.php",
    			type: "post",
    			dataType: "html",
    			data: formdata,
    			cache: false,
    			contentType: false,
    			processData: false
		});

        alert("Ha sido registrado como colaborador!");
        javascript: location.href = '../Colaboradores/Editar.php';
      }
    }

  </script>
  <script src="../Frameworks/jquery/jquery.js"></script>
  <script src="../Frameworks/jquery/jquery.min.js"></script>




  </div>
<!-- Bootstrap core JavaScript-->
  <script src="../Frameworks/jquery/jquery.min.js"></script>
  <script src="../Frameworks/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../Frameworks/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>

