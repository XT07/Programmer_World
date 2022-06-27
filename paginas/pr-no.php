<?php
    session_start();
    include("../include/mysql.php");
    if($_SESSION["pr"] == 1){
        header("LOCATION: programador.php");
    }
    else{
        header("LOCATION: home.php");
    }
?>