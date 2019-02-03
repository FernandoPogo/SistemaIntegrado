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
        <h2 class="display-4" align="center">Editar Colaborador</h2>
      </div>
    </div>
    <div class="row bottom5">
      <div class="col-8 offset-2">
        <div class="card">
          <div class="card-body">
            <form method="post" enctype='multipart/form-data'>
              <?php
                    require ('../DataBase/ConexionBD.php');
          
                      $Usuario=$_SESSION["NombreUsuario"];     

                      $StoreProcedure ='CALL sp_ObtenerDatosColaboradorCompleto (\''.$Usuario.'\');';
                      $resultado=$conexion->prepare($StoreProcedure);

                      if($resultado->execute())
                      {  
                        while ($fila = $resultado->fetch()) 
                      {
                        $CedulaC=$fila['CedulaColaborador'];
                        $FechaNacimientoC=$fila['FechaNacimientoColaborador'];
                        $NombresUsuario=$fila['NombresUsuario'];
                        $ApellidosUsuario=$fila['ApellidosUsuario'];
                    $CorreoElectronicoUsuario=$fila['CorreoElectronicoUsuario'];
                        $DireccionC=$fila['DireccionColaborador'];
                        $TelefonoC=$fila['TelefonoColaborador'];
                        $SexoC=$fila['SexoColaborador'];
                        $EstadoC=$fila['EstadoColaborador'];
                        $FotoC=$fila['ImagenColaborador'];

                  echo '<div class="offset-4">';
                    echo '<div class="form-group center-block">';
                      echo '  <img   src="'.$FotoC.'"
width="50%" height="60%" border="15" align="Center">';
                    echo '</div>';
                  echo '</div>';

                  echo '<div class="form-group">';
                  echo '<div class="form-row">';             
                  echo '<div class="col-md-6">';
                    echo '<label for="CedulaC">Cédula de identidad</label>';

                    echo '<input type="text" class="form-control" name="CedulaC" id="CedulaC" value="'.$CedulaC.'" disabled>';
                  echo '</div>';
                  echo '<div class="col-md-6">';
                    echo '<label for="FechaNacimientoC">Fecha Nacimiento</label>';
                    echo '<input class="form-control" id="FechaNacimientoC" name="FechaNacimientoC" type="date" maxlength="50" value="'.$FechaNacimientoC.'" disabled>';
                  echo '</div>';
                echo '</div>';
              echo '</div>';               
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
              echo '<input type="text" class="form-control" name="CorreoElectronicoC" id="CorreoElectronicoC" value='.$CorreoElectronicoUsuario.' disabled>';
            echo'</div>';
      
            echo '<div class="form-group">';
              echo '<label for="DireccionC">Direccion</label>';
              echo '<input type="text" class="form-control" name="DireccionC" id="DireccionC" value="'.$DireccionC.'" required>';
            echo '</div>';
          
            echo '<div class="form-group">';
              echo '<div class="form-row">';
                echo '<div class="col-6">'; 
                  echo '<label for="TelefonoC">Telefono</label>';
                  echo '<input class="form-control" id="TelefonoC" name="TelefonoC" type="text" value='.$TelefonoC.' required>';
                echo '</div>'; 
                echo '<div class="col-6 ">'; 
                  echo '<label for="SexoC">Sexo</label>';
                  echo '<select class="form-control" id="SexoC" name="SexoC" disabled>';
                    echo '<option>'.$SexoC.'</option>';
                  echo '</select>';
                echo '</div>';
              echo '</div>';                       
            echo '</div>';


            echo '<div class="form-group">';
              echo '<div class="form-row">';
                echo '<div class="col-6 ">'; 
                  echo '<label for="EstadoC">Estado</label>';
                  echo '<select class="form-control" id="EstadoC" name="EstadoC">';
                    if($EstadoC=="1")
                    {
                      echo '<option>Visible</option>';
                      echo '<option>Oculto</option>';
                    }
                    else
                    {
                      echo '<option>Oculto</option>';
                      echo '<option>Visible</option>';
                    }
                  echo '</select>';
                echo '</div>';
              echo '</div>';                       
            echo '</div>';
                  
            echo '<div class="form-group">';
              echo '<label for="FotoC">Adjuntar Fotografia</label>';
              echo '<input type="file" class="form-control" name="FotoC" id="FotoC" style="display: none" onchange="ruta.value=FotoC.value">';
              echo '</br>';
              echo '<input type="text" id="ruta" name="ruta" value="'.$FotoC.'" size="12">';  
              echo '<input type="button" value="Cambiar" onclick="FotoC.click(); ruta.value=FotoC.value">';  
            echo '</div>';         
          }
        }?>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-4 offset-4">
                    <button type="button" class="btn btn-danger btn-block" onclick="javascript:location.href='../Principal/index.php'">Cancelar</button>
                  </div>
                  <?php
                    echo '<div class="col-4">';
                      echo '<button type="button" class="btn btn-success btn-block"  onclick="ModificarDatosColaborador(\''.$_SESSION["NombreUsuario"].'\')">Guardar Datos</button>';
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

    function ModificarDatosColaborador(NombreUsuario, EstadoColaborador) 
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
        formdata.append("EstadoC",_("EstadoC"));
        formdata.append("ruta", _("ruta")); 
        formdata.append("FotoC", FotoC);
        
        $.ajax({  	url: "fn_ModificarDatosColaborador.php",
    			type: "post",
    			dataType: "html",
    			data: formdata,
    			cache: false,
    			contentType: false,
    			processData: false
		});

        alert("Sus datos se han modificado!");
        javascript: location.href = '../Principal/index.php';
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

