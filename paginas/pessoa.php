<?php
    session_start();
    require("../templates/header.php");
    include("../include/mysqli.php");
    $usuarioErro = $usuario = "";
    $emailErro = $email = "";
    $senhaErro = $senha = "";
    $senhaCopErro = "";
    $pr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])){
        if(empty(tI($_POST["usuario"]))){
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
        if(empty(tI($_POST["senha"]))){
            $senhaErro = "Campo obrigatório";
        }
        else{
            $senha = tI($_POST["senha"]);
        }
        if(tI($_POST["senhaCop"]) != $senha){
            $senhaCopErro = "As duas senha precisam ser iguais";
        }
        else{
            $senha = tI($_POST["senhaCop"]);
        }
        if(empty($_POST["pr"])){
            $pr = false;
        }
        else{
            $pr = true;
        }
    }
    if($usuario && $email && $senha && isset($_POST["cadastrar"])){
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE nome = ?");
        if($sql->execute(array($usuario))){
            if($sql->rowCount() > 0){
                $usuarioErro = "Este usuário já foi cadastrado";
            }
            else{
                $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
                if($sql->execute(array($email))){
                    if($sql->rowCount() > 0){
                        $emailErro = "Este e-mail já foi cadastrado";
                    }
                    else{
                        $sql = $pdo->prepare("INSERT INTO usuario VALUES (null, ?, ?, ?, ?, null, null)");
                        if($sql->execute(array($usuario, $email, md5($senha), $pr))){}
                        header("LOCATION: login.php");
                    }
                }
            }
        }
    }
?>
<body>
    <div class="containerForm">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class="formLog">
            <fieldset>
                <div class="formTop">
                    <h2>Registration</h2>
                    <p>Has login ? <a href="login.php">login here</a></p>
                    <label>User</label><br>
                    <input type="text" name="usuario" maxlenght="125" class="formInput"><br>
                    <span class="spanErro"><?php echo $usuarioErro; ?></span><br>
                    <label>E-mail</label><br>
                    <input type="email" name="email" maxlength="125" class="formInput"><br>
                    <span class="spanErro"><?php echo $emailErro; ?></span><br>
                    <label>Password</label><br>
                    <input type="password" name="senha" maxlenght="125" class="formInput"><br>
                    <span class="spanErro"><?php echo $senhaErro; ?></span><br>
                    <label>Confirm password</label><br>
                    <input type="password" name="senhaCop" maxlenght="125" class="formInput"><br>
                    <span class="spanErro"><?php echo $senhaCopErro; ?></span><br>
                    <label>I'm an programmer <input type="checkbox" name="pr" class="formInput"></label><br><br>
                </div>
                <div class="formBottom">
                    <input type="submit" value="Cadastrar" name="cadastrar" class="btn">
                </div>
                <a href="login.php"><b class="voltar"><<</b> Back</a>
            </fieldset>
        </form>
    </div>
</body>
<?php
    require("../templates/footer.php");
?>