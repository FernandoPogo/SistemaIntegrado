<?php
require ('../DataBase/ConexionBD.php');
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
        font-size: 14px;
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
    <input type="text" id="CedulaColaborador" onkeyup="BuscarCedula()" placeholder="Cedula del colaborador" title="Cedula del colaborador">
    <input type="text" id="NombreColaborador" onkeyup="BuscarNombre()" placeholder="Nombre del colaborador" title="Nombre del colaborador">
                          
    <table id="myTable">
      <tr class="header">
        <th style="width:10%;">Nombre</th>
        <th style="width:20%;">Nombre Completo</th>
        <th style="width:5%;">Cedula</th>
        <th style="width:5%;">Fecha de Nacimiento</th>
        <th style="width:20%;">Direccion</th>
        <th style="width:20%;">Correo Electrónico</th>
        <th style="width:5%;">Telefono</th>
        <th style="width:5%;">Sexo</th>
        <th style="width:20%;">Fotografía</th>
        <th style="width:10%;">
        
      <?php
        require ('../DataBase/ConexionBD.php');
          
        $Tema="";
        $Materias="Todas";
        $Usuario=$_SESSION["NombreUsuario"];     

        $StoreProcedure ='CALL sp_ObtenerColaboradores ();';
        $resultado=$conexion->prepare($StoreProcedure);

        if($resultado->execute())
        { 
          while ($fila = $resultado->fetch()) 
          {
            $CodigoUsuario=$fila['CodigoUsuario'];
            $NombreC=$fila['NombreUsuario'];
            $NombreCompletoC=$fila['NombreCompleto'];
            $CedulaC=$fila['CedulaColaborador'];
            $FechaNacimientoC=$fila['FechaNacimientoColaborador'];
            $DireccionC=$fila['DireccionColaborador'];
            $CorreoC=$fila['CorreoElectronicoUsuario'];
            $TelefonoC=$fila['TelefonoColaborador'];
            $SexoC=$fila['SexoColaborador'];
            $ImagenC=$fila['ImagenColaborador'];

            echo '<tr>';
              echo '<td>' . $NombreC . '</td>';
              echo '<td>' . $NombreCompletoC . '</td>';
              echo '<td>' . $CedulaC . '</td>';
              echo '<td>' . $FechaNacimientoC . '</td>';
              echo '<td>' . $DireccionC . '</td>';
              echo '<td>' . $CorreoC . '</td>';
              echo '<td>' . $TelefonoC . '</td>';
              echo '<td>' . $SexoC . '</td>';
              echo '<td><img   src="'.$ImagenC.'"
width="100%" height="100%" border="15" align="Center"></td>';                   
              echo '<td> <div onclick="openModal(' . "'myModal" . $CodigoUsuario . "'" . ')" class="arrow"></div> </td>';
            echo '</tr>';

                ////////////////////////////////////////////////
		//	      Objetos de aprendizaje	      //
                ////////////////////////////////////////////////
   
            echo '<div id="myModal' . $CodigoUsuario . '" class="modalmy">';
              echo '<div class="modalmy-content">';
                echo '<div class="modal-header">';
                  echo '<h4 class="modal-title">' . $NombreCompletoC . '</h4>';
                  echo '<button type="button" class="close" onclick="getElementById(' . "'myModal" . $CodigoUsuario . "'" . ').style.display =' . "'none'" . ';">&times;</button>';
                echo '</div>';

                echo '<div class="container">';
                  echo '<div id="myDiv' . $CodigoUsuario .'">';
                    echo '<li class="list-group-item">';
                      echo '<ul class="list-group">';
                        $StoreProcedure ='CALL sp_ObtenerObjetosAprendizajeColaboradores('.$CodigoUsuario.',\''.$Usuario.'\');';
		      
                        $resul=  $conexion1->prepare($StoreProcedure);
                        if($resul->execute())
                        { 
                          while ($OA = $resul->fetch()) 
                          {
                            $CodigoOA=$OA['CodigoObjetoAprendizaje'];
                            $NombreOA=$OA['NombreObjetoAprendizaje'];
                            $DescripcionOA=$OA['DescripcionObjetoAprendizaje'];
                	  $FechaCreacionOA=$OA['FechaCreacionObjetoAprendizaje'];
                            $MateriaOA=$OA['NombreMateria'];
                            $TipoOA=$OA['TipoObjetoAprendizaje'];
                            $ArchivoOA=$OA['ArchivoObjetoAprendizaje'];

                            echo '<li class="list-group-item">';
                              echo '<div class="row top2">';
                                echo '<div class="col-6 text-left padding5">';
                                  echo '<b>Nombre Objeto de Aprendizaje:</b>';
                                echo '</div>'; 
                                echo '<div class="col-6">';
                                  echo $NombreOA;
                                echo '</div>';  
                              echo '</div>';
                              echo '<div class="row top2">';
                                echo '<div class="col-6 text-left padding100">';
                                  echo '<b>Descripcion:</b>';
                                echo '</div>'; 
                                echo '<div class="col-6">';
                                  echo $DescripcionOA;
                                echo '</div>';  
                              echo '</div>';
  			      echo '<div class="row top2">';
                                echo '<div class="col-6 text-left padding5">';
                                  echo '<b>Materia:</b>';
                                echo '</div>'; 
                                echo '<div class="col-6">';
                                  echo $MateriaOA;
                                echo '</div>';      
                                echo '<div class="col-6 text-left padding5">';
                                  echo '<b>Tipo:</b>';
                                echo '</div>'; 
                                echo '<div class="col-6">';
                                  echo $TipoOA;
                                echo '</div>';
                                echo '<div class="col-6 text-left padding5">';
                                  echo '<b>Fecha de Creación:</b>';
                                echo '</div>'; 
                                echo '<div class="col-6">';
                                  echo $FechaCreacionOA;
                                echo '</div>';
                                echo '<div class="col-3 offset-6 text-rigth padding5">';
                                  echo '<button type="button" class="btn btn-success btn-block">Visualizar</button>';            
                                echo '</div>'; 
                                echo '<div class="col-3 text-right padding5">';
                                  echo '<a class="btn btn-primary btn-block" id="Descargar'.$CodigoOA.'" href="'. $ArchivoOA . '" download>Descargar</a>';
                                echo '</div>';
                              echo '</div>';
  			    echo '</div>';
                          echo '</li>';
                        }
                      }
                    echo '</ul>';
                    echo '</li">';
                  echo '</div>';      
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
      function BuscarCedula() 
      {
        var input, filter, table, tr, tn, i;
        input = document.getElementById("CedulaColaborador");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          tn = tr[i].getElementsByTagName("td")[2];
          if (tn) 
          {
            if (tn.innerHTML.toUpperCase().indexOf(filter) > -1) 
            {
              tr[i].style.display = "";
            } 
            else 
            {
              tr[i].style.display = "none";
            }
          }
        }
      }

      function BuscarNombre() 
      {
        var input, filter, table, tr, tn, i;
        input = document.getElementById("NombreColaborador");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          tn = tr[i].getElementsByTagName("td")[1];
          if (tn) 
          {
            if (tn.innerHTML.toUpperCase().indexOf(filter) > -1) 
            {
              tr[i].style.display = "";
            } 
            else 
            {
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
