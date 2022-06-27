<?php
    require("../templates/header.php");
    $usuarioErro = $usuario = "";
    $emailErro = $email = "";
    $senhaErro = $senha = "";
    $senhaCopErro = "";
    $pr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])){
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
        if($_POST["senhaCop"] != $senha){
            $senhaCopErro = "As duas senha precisam ser iguais";
        }
        else{
            $senha = $_POST["senhaCop"];
        }
        if(empty($_POST["pr"])){
            $pr = false;
        }
        else{
            $pr = true;
        }
    }
    include("../include/mysqli.php");
    if($usuario && $email && $senha && isset($_POST["cadastrar"])){
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE nome = ?");
        if($sql->execute(array($usuario))){
            if($sql->rowCount() > 0){
                $usuarioErro = "Este usuário já existe";
            }
            else{
                $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
                if($sql->execute(array($email))){
                    if($sql->rowCount() > 0){
                        $emailErro = "Este e-mail já foi cadastrado";
                    }
                    else{
                        $sql = $pdo->prepare("INSERT INTO usuario VALUES (null, ?, ?, ?, ?)");
                        if($sql->execute(array($usuario, $email, md5($senha), $pr))){}
                        header("LOCATION: pr-no.php");
                    }
                }
            }
        }
    }
?>
<body>
    <form action="" method="POST" class="formLog">
        <fieldset>
            <div class="formTop">
                <h2>Cadastro</h2>
                <p>Tem login ? <a href="login.php">Faça login aqui</a></p>
                <label>Usuario</label><br>
                <input type="text" name="usuario" maxlenght="125" class="formInput"><br>
                <span class="spanErro"><?php echo $usuarioErro; ?></span><br>
                <label>E-mail</label><br>
                <input type="email" name="email" maxlength="125" class="formInput"><br>
                <span class="spanErro"><?php echo $emailErro; ?></span><br>
                <label>Senha</label><br>
                <input type="password" name="senha" maxlenght="125" class="formInput"><br>
                <span class="spanErro"><?php echo $senhaErro; ?></span><br>
                <label>Confirmar senha</label><br>
                <input type="password" name="senhaCop" maxlenght="125" class="formInput"><br>
                <span class="spanErro"><?php echo $senhaCopErro; ?></span><br>
                <label>Sou programador</label><br>
                <input type="checkbox" name="pr" class="formInput"><br>
            </div>
            <div class="formBottom">
                <input type="submit" value="Cadastrar" name="cadastrar" class="btn">
            </div>
            <a href="caPrPs.php"><b class="voltar"><<</b> Voltar</a>
        </fieldset>
    </form>
</body>
<?php
    require("../templates/footer.php");
?>