<?php
    session_start();
    $_SESSION["usuario"];
    $_SESSION["senha"];
    $_SESSION['descricao'];
    $_SESSION['id'];
    if(empty($_SESSION["usuario"]) || empty($_SESSION["senha"])){
        header("location: login.php");
    }
    $_SESSION["pr"];
    $_SESSION['email'];
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
                <a href='amigos.php' class="aMenu">Amigos</a>
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
            <ul class="ulFoto">
                <li>
                    <img src="<?php echo $_SESSION["foto"]; ?>" class="perfilFoto"><br>
                </li>
            </ul>
            <h1>Perfil</h1>
            <p>
                <?php
                    echo "Olá, ".$_SESSION['usuario']."<br><br>";
                    if($_SESSION['pr'] == 1){
                        $programador = "Sim";
                        echo "Programador: ".$programador;
                    }
                    else{
                        $programador = "Não";
                        echo "Programador: ".$programador;
                    }
                ?>
            </p>
            <p>
                <?php
                    echo "E-mail: ".$_SESSION['email']."<br>";
                ?>
            </p>
            <p>
                <?php
                    echo "Senha: ***********************<br>";
                ?>
            </p>
            <p>
                Descrição do perfiil<br>
                <textarea class="descricao" name="descricao" value="" maxlength="1000" readonly><?php echo addslashes($_SESSION["descricao"]); ?>
                </textarea>
            </p>
            <p><a href="editPerfil.php" class="aPerfil">Editar perfil</a></p>
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