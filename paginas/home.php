<?php
    require("../templates/header.php");
?>
<body>
    <input type="checkbox" id="menu" class="checkMenu">
    <label for="menu" class="lMenu">
        <img src="../img/menu.png" class="imgMenu">
    </label>
    <div class="navMenu">
        <ul class="ulMenu">
            <li><a href='log-out.php' class="aMenu">Amigos</a></li>
        </ul>
        <ul class="aMenu">
            <li><a href='log-out.php' class="aMenu">Chat</a></li>
        </ul>
        <ul class="aMenu">
            <li><a href='log-out.php' class="aMenu">Chat privado</a></li>
        </ul>
        <ul class="aMenu">
            <li><a href='log-out.php' class="aMenu">Encerrar sessão</a></li>
        </ul>
    </div>
</body>