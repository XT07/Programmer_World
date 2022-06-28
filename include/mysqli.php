<?php
    define("HOST", "localhost");
    define("USER", "id19181357_luiz");
    define("DB", "id19181357_db_pw");
    define("PASS", "pw89278927Lf@db");
    try{
        $pdo = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        echo "erro";
        exit;
    }
?>