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
    <div class="container">
        <div class="info">
            <ul class="ulFoto">
                <li>
                    <?php echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($_SESSION["foto"]).'" class="perfilFoto">' ?><br>
                </li>
            </ul>
            <h1>Perfil</h1>
            <p>
                <?php
                    echo "Hey, ".$_SESSION['usuario']."<br><br>";
                    if($_SESSION['pr'] == 1){
                        $programador = "Yes";
                        echo "Programmer: ".$programador;
                    }
                    else{
                        $programador = "No";
                        echo "Programmer: ".$programador;
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
                    echo "Password: ***********************<br>";
                ?>
            </p>
            <p>
                profile description<br>
                <textarea class="descricao" name="descricao" value="" maxlength="1000" readonly><?php echo addslashes($_SESSION["descricao"]); ?>
                </textarea>
            </p>
            <p><a href="editPerfil.php" class="aPerfil">Edit profile</a></p>
        </div>
        <ul class="contaUl">
        <li><a href="conta.php">Profile</a></li>
                <li>Privacy</li>
                <li>Appearance</li>
                <li>Notifications</li>
                <li><a href="log-out.php">close session</a></li>
        </ul>
    </div>
    <div class="animacao">
            <div class="boxAn"></div>
            <br>
            <br>
            <br>
            <div class="boxAnRi"></div>
            <br>
            <br>
            <br>
            <div class="boxAn"></div>
            <br>
            <br>
            <br>
            <div class="boxAnRi"></div>
            <br>
            <br>
            <br>
            <div class="boxAn"></div>
            <br>
            <br>
            <div class="boxAnRi"></div>
            <br>
            <br>
            <br>
            <div class="boxAn"></div>
            <br>
            <br>
            <br>
            <div class="boxAnRi"></div>
            <br>
            <br>
            <br>
            <div class="boxAn"></div>
            <br>
            <br>
            <br>
            <div class="boxAnRi"></div>
            <br>
            <br>
            <br>
            <div class="boxAn"></div>
    </div>
</body>