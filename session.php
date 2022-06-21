<?php
    session_start();
    $_SESSION["aviso"];
    if(isset($_SESSION["aviso"])){
        echo "Sessão iniciada";
    }
    else{
        echo "Erro ao iniciar sessão";
    }
?>