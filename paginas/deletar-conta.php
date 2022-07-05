<?php
    session_start();
    $id = $_SESSION["id"];
    include("../include/mysqli.php");
    $sql = $pdo->prepare("DELETE FROM usuario WHERE id_user = ?");
    if($sql->execute(array($id))){
        header("LOCATION: login.php");
    }
?>