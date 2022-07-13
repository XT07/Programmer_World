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
    $_SESSION["senhaDescrip"];
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
    $imgContent = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["alterar"])){
        if(!empty($_POST["id"])){
            $id = $_POST["id"];
        }
        if(empty($_POST["usuario"])){
            $usuarioErro = "Campo obrigatório";
        }
        else{
            $usuario = tI($_POST["usuario"]);
        }
        if(empty(tI($_POST["email"]))){
            $emailErro = "Campo obrigatório";
        }
        else{
            $email = tI($_POST["email"]);
        }
        if(empty($_POST["senha"])){
            $senhaErro = "Campo obrigatório";
        }
        else{
            $senha = tI($_POST["senha"]);
        }
        if(empty(tI($_POST["descricao"]))){

        }
        else{
            $descricao = tI($_POST["descricao"]);
        }
        if(empty($_POST["pr"])){
            $pr = false;
        }
        else{
            $pr = true;
        }
    }
    if(isset($_POST["alterar"])){
        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array("jpg","png","jpeg","gif");
        if(in_array($fileType, $allowTypes)){
            $image = $_FILES["img"]["tmp_name"];
            $imgContent = file_get_contents($image);
        }
    }
    if(!empty($_SESSION["foto"]) && empty($imgContent)){
        $imgContent = $_SESSION["foto"];
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
                        $sql = $pdo->prepare("UPDATE usuario SET nome = ?, email = ?, senha = ?, pr = ?, foto = ?, descricao = ? WHERE id_user = ?");
                        if($sql->execute(array($usuario, $email, md5($senha), $pr, $imgContent, $descricao, $id))){
                            $_SESSION["usuario"] = $usuario;
                            $_SESSION['email'] = $email;
                            $_SESSION["senha"] = $senha;
                            $_SESSION["senhaDescrip"] = $senha;
                            $_SESSION["descricao"] = $descricao;
                            $_SESSION["pr"] = $pr;
                            $_SESSION["foto"] = $imgContent;
                            header("LOCATION: conta.php");
                        }
                    }
                }
            }
        }
    }
    $prOk = "";
    if($_SESSION["pr"] == 1){
        $prOk = "checked";
    }
    $confirm = "";
    $senhaConfErro = "";
    $senhaConf = "";
    if(isset($_POST["confirm"])){
        $confirm = "enter your password: <input type='password' name='senhaConf' class='formInput'>
        <br>
        <br>
        <input type='submit' name='delete' class='btn' value='confirm'> ||| <a href=''>cancel</a>
        ";
    }
    if(isset($_POST["delete"])){
        if(empty($_POST["senhaConf"])){
            $senhaConfErro = "Insira a senha";
        }
        else{
            $senhaConf = $_POST["senhaConf"];
        }
    }
    if($senhaConf && isset($_POST["delete"])){
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE senha = ? AND id_user = ?");
        if($sql->execute(array(md5($senhaConf), $id))){
            if($sql->rowCount() > 0){
                header("location: deletar-conta.php");
            }
            else{
                $senhaConfErro = "invalid password";
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div class="info">
                <ul class="ulFoto">
                    <li>
                        <?php echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($_SESSION["foto"]).'" class="perfilFoto">' ?>
                    </li>
                    <li>
                        <label>Change profile photo</label><br>
                        <input type="file" name="img"><br>
                        <label>Max suported 40 GB</label><br>
                        <label>jpg, jpeg, png, gif</label>
                    </li>
                </ul>
                <h1>Profile</h1>
                <p>
                    <?php
                        echo "Hey, ".$_SESSION['usuario']."<br>";
                    ?>
                    <label>New name: </label><br>
                    <input type="text" name="usuario" maxlength="125"  value="<?php echo $_SESSION["usuario"]; ?>" class="formInput"><br>
                    <span class="spanErro"><?php echo $usuarioErro; ?></span><br>
                    <label>Programmer: <input type="checkbox" name="pr" class="formInput" <?php echo $prOk; ?>></label><br>
                </p>
                <p>
                    <?php
                        echo "E-mail: ".$_SESSION['email']."<br>";
                    ?>
                    <label>New e-mail: </label><br>
                    <input type="email" name="email" maxlength="125" value="<?php echo $_SESSION["email"]; ?>" class="formInput"><br>
                    <span class="spanErro"><?php echo $emailErro; ?></span><br>
                </p>
                <p>
                <?php
                    echo "Senha: ***********************<br>";
                ?>
                    <label>New password: </label><br>
                    <input type="password" name="senha" maxlength="125" class="formInput" value="<?php echo $_SESSION["senhaDescrip"];?>"><br>
                    <span class="spanErro"><?php echo $senhaErro; ?></span><br>
                </p>
                <p>
                    profile description<br>
                    <textarea class="descricao" name="descricao" value="" maxlength="1000"><?php echo addslashes($_SESSION["descricao"]);?></textarea>
                </p>
                <input type="submit" value="Deletar conta" name="confirm" class="btn">
                <span><?php echo $confirm; ?></span><br>
                <span class="spanErro"><?php echo $senhaConfErro; ?></span><br><br>
                <input type="submit" value="salvar" name="alterar" class="btn"><br><br>
                <a href="conta.php"><b class="voltar"><<</b> Back</a>
            </div>
            <ul class="contaUl">
                <li><a href="conta.php">Profile</a></li>
                <li>Privacy</li>
                <li>Appearance</li>
                <li>Notifications</li>
                <li><a href="log-out.php">close session</a></li>
            </ul>
        </div>
    </form>
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