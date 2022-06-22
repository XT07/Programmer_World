<?php
    require("../templates/header.php");
    require("../include/mysqli.php");
    if(empty($_POST["usuario"]) || empty($_POST["senha"])){
        header("LOCATION: login.php");
    }
?>