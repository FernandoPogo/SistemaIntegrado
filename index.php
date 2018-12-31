<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
     require "head.php";
    ?>
</head>

<body class="fixed-nev sticky-footer bg-dark" id="page-top">
    <?php
     require "navbar.php";
    ?>
    <div class="content-wrapper">
     <?php
      if ( isset($_SESSION["Exitoso"])) {
         echo('<div class="alert alert-success alert-dismissable">');
         echo('<a href="#" class="close" data-dismiss="alert" arial-label="close">×</a>');
         echo('<strong>!</strong> ');
         echo('</div>');
         unset($_SESSION["Exitoso"]);
      }      
      if ( isset($_SESSION["Registro"]) ) {
         echo('<div class="alert alert-success alert-dismissable">');
         echo('<a href="#" class="close" data-dismiss="alert" arial-label="close">×</a>');
         echo($_SESSION["Registro"]);
         echo('</div>');
         unset($_SESSION["Registro"]);
      }
     ?>
  
     <div class="jumbotron">
       <img src="Imagenes/logoEPN.png" align="right" width=300px height=300px margin=25px>   
       <h1 class="display-4" align="center">
         SISTEMA INTEGRADO DE APRENDIZAJE
       </h1>
       
       <p class="lead"> parrafo 1</p>
       
       <p class="lead"> parrafo 2</p>
       
       <hr class="my-3">
     </div>
     
    <?php
       require "footer.php"
    ?>
   </div>
</body>

</html>
