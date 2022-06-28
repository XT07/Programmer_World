<?php
    session_start();
    $_SESSION["usuario"];
    $_SESSION["pr"];
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
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Projetos</a>
            </li>
            <li class="liMenu">
                <a href='log-out.php' class="aMenu">Comunidade</a>
            </li>
            <li class="liMenu">
                <a href='conta.php' class="aMenu">Conta</a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="info">
            <h1>Perfil</h1>
            <p>
                <?php
                    echo "Olá, ".$_SESSION['usuario']."<br>";
                    if($_SESSION["pr"] == 1){
                    echo "Programador";
                    }
                ?>
            </p>
        </div>
        <ul class="contaUl">
            <li><a href="conta.php">Perfil</a></li>
            <li>Privacidade</li>
            <li>Aparência</li>
            <li>Notificações</li>
            <li><a href="log-out.php">Encerrar sessão</a></li>
        </ul>
    </div>
</body>