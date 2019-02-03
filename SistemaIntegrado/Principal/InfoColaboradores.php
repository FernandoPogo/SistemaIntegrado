<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php
        require "../Principal/head.php";
    ?>
    <style>
        .jumbotron {
            padding-top:20px;
            padding-bottom:20px;
        }
        .top5 
	{
            margin-top:15px;
        }
        .bottom5 
	{
            margin-bottom:20px;
        }
        .padding5 
	{
            padding-right: 45px;
        }
        .padding15 
	{
            padding-left: 0px;
        }
    </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <?php
        require "../Principal/navbar.php";
    ?>

    <div class="content-wrapper bg-light">

    <div class="jumbotron">
       <img src="../Imagenes/imgGITHUB.png" align="right" width=300px height=300px margin=25px>   
       <h1 class="display-4" align="center">
         Colaboradores
       </h1>
       
       <p class="lead"> parrafo 1</p>
       
       <p class="lead"> parrafo 2</p>
       
       <hr class="my-3">

      <a href="#" onclick="window.open('../Complementos/Manual de Usuario - Colaboradores.pdf')">Conocer más</a>
     </div>
          
    <?php
        require "../Principal/footer.php";
    ?>
  </div>
</body>

</html>
