<?php
    require_once "../DataBase/ConexionBD.php";
    session_start();
    
    session_destroy();
    header("Location: ../Principal/index.php");
