<?php
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
                      
    <table id="myTable">
      <tr class="header">
        <th style="width:30%;">Tema</th>
        <th style="width:30%;">Tema</th>
        <th style="width:20%;">Fecha</th>
        <th style="width:20%;">Estado</th>
        <th style="width:20%;">Tipo</th>
        <th style="width:10%;">
      </tr>

      <?php
        require ('../DataBase/ConexionBD.php');
          
        $Usuario=$_SESSION["NombreUsuario"];     

        $StoreProcedure ='CALL sp_ObtenerMisForos (\''.$Usuario.'\');';
        $resultado=$conexion->prepare($StoreProcedure);

        if($resultado->execute())
        { 
          while ($fila = $resultado->fetch()) 
          {
            $CodigoForo=$fila['CodigoForo'];
            $NombreForo=$fila['NombreForo'];
            $DescripcionForo=$fila['DescripcionForo'];
            $NombreMateria=$fila['NombreMateria'];
            $FechaCreacionForo=$fila['FechaCreacionForo'];
            $EstadoForo=$fila['EstadoForo'];
            $TipoForo=$fila['TipoForo'];
            echo '<tr>';
              echo '<td>' . $NombreForo . '</td>';
              echo '<td>' . $NombreMateria . '</td>';
              echo '<td>' . $FechaCreacionForo . '</td>';
              if($EstadoForo==0)
              {
                echo '<td><input class="d-block small mt-6" type="submit" name="" value="Desactivado" id="button1" onClick="ModificarEstadoForo('.$CodigoForo.','."1".');"</input></td>';
              }
              else
              {
                echo '<td><input class="d-block small mt-6" type="submit" name="" value="      Activo      " id="button2" onClick="ModificarEstadoForo('.$CodigoForo.','."0".');"</input></td>';
              }
              
              echo '<td><input class="d-block small mt-6" type="submit" name="" value="'. $TipoForo .'" id="button3" onClick="ModificarTipoForo('.$CodigoForo.',\''.$TipoForo.'\');"</input></td>';
              
 	      echo '<td><input class="d-block small mt-6" type="submit" name="" value="Eliminar" id="button4" onClick="EliminarForo('.$CodigoForo.');"</input></td>';
          }
        }
	echo '</table>';
        ?>
    </div>
  </div>
    <?php
      require "../Principal/footer.php";
    ?>

    <script>
      function EliminarForo(CodigoForo)
      { 
         var parametros = {
                            "CodigoForo" : CodigoForo
                          }
         $.ajax({
                  data:  parametros,
                  url:   'fn_EliminarForo.php', 
                  type:  'post'
        	});
      }
    </script>

    <script>
      function ModificarEstadoForo(CodigoForo, EstadoForo)
      {
      	var parametros = {
                            "CodigoForo" : CodigoForo,
			    "EstadoForo" : EstadoForo
                          }
         $.ajax({
                  data:  parametros,
                  url:   'fn_ModificarEstadoForo.php', 
                  type:  'post'			   
        	});        
      }
    </script>


    <script>
      function ModificarTipoForo(CodigoForo, TipoForo)
      {
      	var parametros = {
                            "CodigoForo" : CodigoForo,
			    "TipoForo"   : TipoForo
                          }
         $.ajax({
                  data:  parametros,
                  url:   'fn_ModificarTipoForo.php', 
                  type:  'post'
        	});
      }
    </script>

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
