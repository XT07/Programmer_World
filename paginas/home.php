<?php
    session_start();
    $_SESSION["usuario"];
    $_SESSION["senha"];
    if(empty($_SESSION["usuario"]) || empty($_SESSION["senha"])){
        header("location: login.php");
    }
    require("../templates/header.php");
?>
<body style="margin: 0; padding: 0;">
    <input type="checkbox" id="menu" class="checkMenu">
    <label for="menu" class="lMenu">
        <img src="../img/menu.png" class="imgMenu">
    </label>
    <div class="navMenu">
    <ul class="ulMenu">
            <li class="liMenu">
                <a href='amigos.php' class="aMenu">Friends</a>
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Chat</a>
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Projects</a>
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Comunity</a>
            </li>
            <li class="liMenu">
                <a href='conta.php' class="aMenu">Account</a>
            </li>
        </ul>
    </div>
</body>