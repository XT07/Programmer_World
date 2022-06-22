<?php
    session_start();
    $_SESSION["aviso"] = "";
    if(isset($_SESSION["aviso"])){
    }
    else{
        echo "Erro ao iniciar a sessão";
    }
?>