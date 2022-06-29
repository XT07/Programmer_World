<?php
    session_start();
    $_SESSION["usuario"];
    $_SESSION["senha"];
    if(empty($_SESSION["usuario"]) || empty($_SESSION["senha"])){
        header("location: login.php");
    }
    $_SESSION["pr"];
    $_SESSION['email'];
    $_SESSION['id'];
    $_SESSION["descricao"];
    $_SESSION['foto'];
    require("../templates/header.php");
    include("../include/mysqli.php");
    $usuarioErro = "";
    $emailErro = "";
    $email = "";
    $usuario = "";
    $descricao = "";
    $senha = "";
    $senhaErro = "";
    $pr = "";
    $id = $_SESSION["id"];
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["alterar"])){
        if(!empty($_POST["id"])){
            $id = $_POST["id"];
        }
        if(empty($_POST["usuario"])){
            $usuarioErro = "Campo obrigatório";
        }
        else{
            $usuario = $_POST["usuario"];
        }
        if(empty($_POST["email"])){
            $emailErro = "Campo obrigatório";
        }
        else{
            $email = $_POST["email"];
        }
        if(empty($_POST["senha"])){
            $senhaErro = "Campo obrigatório";
        }
        else{
            $senha = $_POST["senha"];
        }
        if(empty($_POST["descricao"])){

        }
        else{
            $descricao = $_POST["descricao"];
        }
        if(empty($_POST["pr"])){
            $pr = false;
        }
        else{
            $pr = true;
        }
    }
    if($usuario && $email && $senha && isset($_POST["alterar"])){
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE id_user <> ? AND nome = ?");
        if($sql->execute(array($id, $usuario))){
            if($sql->rowCount() > 0){
                $usuarioErro = "Este usuário já existe";
            }
            else{
                $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = ? AND id_user <> ?");
                if($sql->execute(array($email, $id))){
                    if($sql->rowCount() > 0){
                        $emailErro = "Este e-mail já foi cadastrado";
                    }
                    else{
                        $sql = $pdo->prepare("UPDATE usuario SET nome = ?, email = ?, senha = ?, pr = ?, descricao = ? WHERE id_user = ?");
                        if($sql->execute(array($usuario, $email, md5($senha), $pr,$descricao, $id))){
                            $_SESSION["usuario"] = $usuario;
                            $_SESSION['email'] = $email;
                            $_SESSION["senha"] = $senha;
                            $_SESSION["descricao"] = $descricao;
                            $_SESSION["pr"] = $pr;
                            header("LOCATION: conta.php");
                        }
                    }
                }
            }
        }
    }
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
    <form action="" method="POST">
        <div class="container">
            <div class="info">
                <ul class="ulFoto">
                    <li>
                        <img src="../img/perfil.jpg" class="perfilFoto"><br>
                    </li>
                    <li>
                        <label class="lFoto">Mudar foto</label>
                    </li>
                </ul>
                <h1>Perfil</h1>
                <p>
                    <?php
                        echo "Olá, ".$_SESSION['usuario']."<br>";
                    ?>
                    <label>Novo nome: </label>
                    <input type="text" name="usuario" maxlength="125"  value="<?php echo $_SESSION["usuario"]; ?>" class="formInput"><br>
                    <span class="spanErro"><?php echo $usuarioErro; ?></span><br>
                    <label>Programador: </label>
                    <input type="checkbox" name="pr" class="formInput"><br>
                </p>
                <p>
                    <?php
                        echo "E-mail: ".$_SESSION['email']."<br>";
                    ?>
                    <label>Novo e-mail: </label>
                    <input type="email" name="email" maxlength="125" value="<?php echo $_SESSION["email"]; ?>" class="formInput"><br>
                    <span class="spanErro"><?php echo $emailErro; ?></span><br>
                </p>
                <p>
                <?php
                    echo "Senha: ***********************<br>";
                ?>
                    <label>Nova senha: </label>
                    <input type="password" name="senha" maxlength="125" class="formInput"><br>
                    <span class="spanErro"><?php echo $senhaErro; ?></span><br>
                </p>
                <p>
                    Descrição do perfiil<br>
                    <textarea class="descricao" name="descricao" value="" maxlength="1000"><?php echo addslashes($_SESSION["descricao"]);?></textarea>
                </p>
                <input type="submit" value="salvar" name="alterar" class="btn"><br><br>
                <a href="conta.php"><b class="voltar"><<</b> Voltar</a>
            </div>
            <ul class="contaUl">
                <li><a href="conta.php">Perfil</a></li>
                <li>Privacidade</li>
                <li>Aparência</li>
                <li>Notificações</li>
                <li><a href="log-out.php">Encerrar sessão</a></li>
            </ul>
        </div>
    </form>
</body>