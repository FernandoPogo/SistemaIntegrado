<?php
require ('../DataBase/ConexionBD.php');
session_start();
  
if(isset($_POST["NuevoComentario"]))
{
  $NewCodigoForo=$_POST["CodigoForo"];
  $NewUsuario=$_SESSION["NombreUsuario"];
  $NewOpinion=$_POST["NuevoComentario"];
  $Mensaje = "@v_Mensaje";
    
  $StoreProcedure ='CALL sp_RegistrarComentario ('.$NewCodigoForo.',\''.$NewUsuario.'\',\''.$NewOpinion.'\',@v_Mensaje);
';
  $resultado=$conexion->prepare($StoreProcedure);
  $resultado->execute();

  header( 'Location: ../Comunidad Desarrollo/Buscar1.php' );
  return;
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
    * {
        box-sizing: border-box;
    }

    #myInput {
        background-image: url('images/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }

    #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
    }

    #myTable th,
    #myTable td {
        text-align: left;
        padding: 12px;
    }

    #myTable tr {
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header,
    #myTable tr:hover {
        background-color: #f1f1f1;
    }

    .modalmy {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        padding-left: 250px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }
    /* Modal Content */

    .modalmy-content {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
            flex-direction: column;
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        border-radius: 0.3rem;
        background-clip: padding-box;
        outline: 0;
    }

    .arrow {
        box-sizing: border-box;
        height: 1vw;
        width: 1vw;
        border-style: solid;
        border-color: black;
        border-width: 0px 1px 1px 0px;
        transform: rotate(45deg);
        transition: border-width 150ms ease-in-out;
    }

    .arrow:hover {
        border-bottom-width: 4px;
        border-right-width: 4px;
    }

    .top5 {
      margin-top:15px;
    }

    .bottom5 {
      margin-bottom:20px;
    }

    .bottom10 {
      margin-bottom:10px;
    }

    .padding5 {
      padding-right: 45px;
    }

    .padding15 {
      padding-left: 0px;
    }

  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php
    require "../Principal/navbar.php";
  ?>

  <div class="content-wrapper bg-light">
    <div class="container">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Tema del foro" title="Ingrese el tema del foro">
        
    <div class="form-group">
      <label for="MateriaForo">Materia</label>
      <select class="form-control" id="MateriaForo" name="MateriaForo">

      <?php
	require ('../DataBase/ConexionBD.php');
        $StoreProcedure="CALL sp_obtenerMaterias";

        $resultado=$conexion->prepare($StoreProcedure);

        if($resultado->execute())
        { 
            while ($materia = $resultado->fetch()) 
            {
              echo('<option>' . $materia['NombreMateria'] . '</option>');   
            }
        }
      ?>
      </select>
    </div>
                      
    <table id="myTable">
      <tr class="header">
        <th style="width:30%;">Tema</th>
        <th style="width:30%;">Autor</th>
        <th style="width:30%;">Tema</th>
        <th style="width:20%;">Fecha</th>
        <th style="width:20%;">Estado</th>
        <th style="width:20%;">Tipo</th>
        <th style="width:10%;">
      </tr>

      <?php
        require ('../DataBase/ConexionBD.php');
          
        $Tema="";
        $Materias="Todas";
        $Usuario=$_SESSION["NombreUsuario"];     

        $StoreProcedure ='CALL sp_ObtenerForos (\''.$Tema.'\',\''.$Materias.'\',\''.$Usuario.'\');';
        $resultado=$conexion->prepare($StoreProcedure);

        if($resultado->execute())
        { 
          while ($fila = $resultado->fetch()) 
          {
            $CodigoForo=$fila['CodigoForo'];
            $NombreForo=$fila['NombreForo'];
            $DescripcionForo=$fila['DescripcionForo'];
            $NombreUsuario=$fila['NombreUsuario'];
            $NombreMateria=$fila['NombreMateria'];
            $FechaCreacionForo=$fila['FechaCreacionForo'];
            $EstadoForo=$fila['EstadoForo'];
            $TipoForo=$fila['TipoForo'];
            echo '<tr>';
              echo '<td>' . $NombreForo . '</td>';
              echo '<td>' . $NombreUsuario . '</td>';
              echo '<td>' . $NombreMateria . '</td>';
              echo '<td>' . $FechaCreacionForo . '</td>';
              if($EstadoForo==0)
              {
                echo '<td>' . "Inactivo" . '</td>';
              }
              else
              {
                echo '<td>' . "Activo" . '</td>';
              }
              echo '<td>' . $TipoForo . '</td>';
                   
              echo '<td> <div onclick="openModal(' . "'myModal" . $CodigoForo . "'" . ')" class="arrow"></div> </td>';
            echo '</tr>'; 
                ////////////////////////////////////////////////
		//		Foro Abierto		      //
                ////////////////////////////////////////////////

       
            echo '<div id="myModal' . $CodigoForo . '" class="modalmy">';
              echo '<div class="modalmy-content">';
                echo '<div class="modal-header">';
                  echo '<h4 class="modal-title">' . $NombreForo . '</h4>';
                  echo '<button type="button" class="close" onclick="getElementById(' . "'myModal" . $CodigoForo . "'" . ').style.display =' . "'none'" . ';">&times;</button>';
                echo '</div>';

                echo '<div class="container">';
                  echo '<div id="myDiv' . $CodigoForo . '">';
                    echo '<li class="list-group-item">';
                      echo '<div class="row top5">';
                        echo '<div class="col-2 text-left">';
                          echo '<b>'.$NombreUsuario.': </b>';
                        echo '</div>';
                        echo '<div class="col-10 text-left">';
                          echo $DescripcionForo;
                        echo '</div>';
                      echo '</div>';
                    echo '</li>';
                  echo '</div>';
                  echo '<br><br />';

                  echo '<div class="comments">';
                    echo '<ul class="list-group">';
  
                      $StoreProcedure ='CALL sp_ObtenerComentarios ('.$CodigoForo.');';
		      
                      $resul=  $conexion1->prepare($StoreProcedure);
                      if($resul->execute())
                      { 
                        while ($comentario = $resul->fetch()) 
                        {
                          $Opinion=$comentario['Opinion'];
                	  $OpinionUsuario=$comentario['NombreUsuario'];
                          $FechaOpinion=$comentario['FechaOpinion'];
                          echo '<li class="list-group-item">';
                            echo '<div class="col-6">';
                            echo '<strong>'.$OpinionUsuario.': </strong>&emsp;&emsp;&emsp;&emsp;';
  			    echo '</div>';
                            echo '<div class="offset-2">';
                            echo $Opinion;
  			    echo '</div>';
                            echo '<div class="col offset-9">';
                            echo $FechaOpinion;
  			    echo '</div>';
                          echo '</li>';
                        }
                      }
                    echo '</ul>';
                  echo '</div>';
                 
                  echo '<form method="post" class="top5" enctype="multipart/form-data">';
                    echo '<div class="form-group">';
                      echo '<textarea name="NuevoComentario" rows="3" class="form-control"  placeholder="Ingrese un comentario" required></textarea>';
                    echo '</div>';
                    echo '<div class="form-group">';
                      echo '<div class="form-row">';
                        echo '<div class="col-6 offset-6">';

                          echo '<input type="hidden" name="CodigoForo" value="' . $CodigoForo.'">';
                         
                          echo '<input class="btn btn-info btn-block" type="submit" value="Agregar Comentario">';
                        echo '</div>';
                      echo '</div>';
                    echo '</div>';
                  echo '</form>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
          }
        }
        ?>
      </table>
    </div>
  </div>
    <?php
      require "../Principal/footer.php";
    ?>


    <script>
      function myFunction() {
        var input, filter, table, tr, tn, ta, tan, tc, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          tn = tr[i].getElementsByTagName("td")[0];
          ta = tr[i].getElementsByTagName("td")[1];
          tan = tr[i].getElementsByTagName("td")[2];
          tc = tr[i].getElementsByTagName("td")[3];
          if (tn || ta || tan || tc) {
            if (tn.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else if (ta.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else if (tan.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else if (tc.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }

      function openModal(modale) {
        var modal = document.getElementById(modale);
        modal.style.display = "block";

        window.onclick = function (event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      }

      function showHide(div) {
        var x = document.getElementById(div);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
      }

      function unzip(zip_path, id, name) {
        var formdata = new FormData();
        formdata.append("zip_path", zip_path);
        formdata.append("id", id);
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "unzip.php");
        ajax.send(formdata);
        alert("Objeto de Aprendizaje descomprimido con exito!");
        javascript:location.href='buscar.php';
      }


    </script>
  </div>
</body>

</html>
<script src="../Frameworks/jquery/jquery.js"></script>
<script src="../Frameworks/jquery/jquery.min.js"></script>
<script>
	$(document).ready(function(){
                $.ajax({
                    method: "GET",
                    url: "mat.php",
                }).done(function( data ) {
                        var result = $.parseJSON(data);
                        $.each( result, function( key, value ) {
                            $("#cbxMaterias").append("<option>"+value['nombreMateria']+"</option>");
							
                        });
                });
            });
var puntuacion;
    $('[type*="radio"]').change(function () {
        var me = $(this);
        //alert(me.attr('value'));
        puntuacion=me.attr('value');
    });
$('[id*="btnCalificar"]').click(function () {
    var me = $(this);
    var strId=me.attr('id');
    var numeroId=strId.substring(12);
    var id=$("#idUsuario").val();
    $.ajax({
        method: "POST",
        url: "puntuacion.php",
        data: {"idObjetoAprendizaje": numeroId, "puntuacion": puntuacion, "idUsuario": id},
    }).done(function( data ) {
        var result = $.parseJSON(data);
        $.each( result, function( key, value ) {
            alert(value['mensaje']);
        });
    });
});
$('[id*="Descargar"]').click(function () {
        var me = $(this);
        var strId = me.attr('id');
        var numeroId = strId.substring(9);
        $.ajax({
            method: "POST",
            url: "cargarObjetos.php",
            data: {"idDescargas": numeroId},
        }).done(function( data ) {
            var result = $.parseJSON(data);
            $.each( result, function( key, value ) {
                alert(value['mensaje']);
            });
        });

    });
</script>
