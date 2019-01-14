<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
        <h2 class="display-4 text-center">Nuevo Elemento</h2>
      </div>
    </div>

    <div class="row bottom5">
      <div class="col-8 offset-2">
        <div class="card">
          <div class="card-body">
            <form enctype="multipart/form-data" method="post">
              <div class="form-group">
                <label for="NombreOA">Nombre del OA</label>
                <input type="text" class="form-control" id="NombreOA" name="NombreOA" placeholder="Nombre" required>
              </div>
             
              <div class="form-group">
                <label for="MateriaOA">Materia</label>
                <select class="form-control" id="MateriaOA" name="MateriaOA">
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
                <label for="DescripcionOA">Descripcion</label>
                <textarea rows="3" class="form-control" id="DescripcionOA" name="DescripcionOA" placeholder="Descripcion" required></textarea>
              </div>
            
              <div class="form-group">
                <div class="form-row">
                  <div class="col-6 "> 
                    <label for="EstadoOA">Estado</label>
                    <select class="form-control" id="EstadoOA" name="EstadoOA">;
                      <option>Activo</option>
                      <option>Inactivo</option>
                    </select>
                  </div> 
                  <div class="col-6"> 
                    <label for="TipoOA">Tipo</label>
                    <select class="form-control" id="TipoOA" name="TipoOA">;
                      <option>Publico</option>
                      <option>Privado</option>
                    </select>
                  </div> 
                </div>              
              </div>

              <div class="form-group">
                <label for="ArchivoOA">Adjuntar un archivo</label>
                <input type="file" class="form-control" name="ArchivoOA" id="ArchivoOA">
              </div>

              <div class="form-group">
                <div class="form-row">
                  <div class="col-4 offset-4">
                    <button type="button" class="btn btn-danger btn-block" onclick="javascript:location.href='../Principal/index.php'">Cancelar</button>
                  </div>
                  <?php
                    echo '<div class="col-4">';
                      echo '<button type="button" class="btn btn-success btn-block" onclick="CargarArchivo(\''.$_SESSION["NombreUsuario"].'\')">Subir</button>';
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

    <script src="../Frameworks/jszip/jszip.js"></script>
    <script src="../Frameworks/jszip/jszip-utils.js"></script>
    <script>
    function _(dato) 
    {
      return document.getElementById(dato).value;
    }

    function CargarArchivo(NombreUsuario) 
    {			
      if (_('NombreOA') == '' || _('DescripcionOA') == '') 
      {
        alert("Error uno o mas campos vacios");
      } 
      else 
      {
        alert(NombreUsuario+" || "+ _("NombreOA")+" || "+_("MateriaOA")+" || "+ _("DescripcionOA") +" || "+ _("EstadoOA") +" || "+ _("TipoOA"));

        var ArchivoOA = document.getElementById("ArchivoOA").files[0];
        var formdata = new FormData();
        formdata.append("NombreUsuario",NombreUsuario);
        formdata.append("NombreOA", _("NombreOA"));
        formdata.append("MateriaOA", _("MateriaOA"));
        formdata.append("DescripcionOA", _("DescripcionOA"));
        formdata.append("EstadoOA", _("EstadoOA"));
        formdata.append("TipoOA", _("TipoOA"));
        formdata.append("ArchivoOA", ArchivoOA);
        
        
        $.ajax({  	url: "fn_CargarArchivo.php",
    			type: "post",
    			dataType: "html",
    			data: formdata,
    			cache: false,
    			contentType: false,
    			processData: false
		});

        alert("Objeto de Aprendizaje guardado con exito!");
        javascript: location.href = '../Repositorio/Buscar.php';
      }
    }

  </script>
  <script src="../Frameworks/jquery/jquery.js"></script>
  <script src="../Frameworks/jquery/jquery.min.js"></script>
  </div>
</body>

</html>
