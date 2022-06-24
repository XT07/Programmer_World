<?php
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
                <a href='log-out.php' class="aMenu">Amigos</a>
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Chat</a>
                <ul class="ul-chat">
                    <li><a href=''>público</a></li>
                    <li><a href=''>privado</a></li>
                </ul>
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Projetos</a>
                <ul class="ul-pro">
                    <li><a href="">de amigos</a></li>
                    <li><a href="">público</a></li>
                    <li><a href="">meus projetos</a></li>
                </ul>
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Comunidade</a>
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Conta</a>
                <ul class="ul-conta">
                    <li><a href="">configurações</a></li>
                    <a href='log-out.php' class="aMenu">Encerrar sessão</a>
                </ul>
            </li>
        </ul>
    </div>
</body>