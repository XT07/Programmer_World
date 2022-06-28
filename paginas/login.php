<?php
    session_start();
    require("../templates/header.php");
    $usuarioErro = $usuario = "";
    $senhaErro = $senha = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logar"])){
        if(empty($_POST["usuario"])){
            $usuarioErro = "Campo obrigatório";
        }
        else{
            $usuario = $_POST["usuario"];
        }
        if(empty($_POST["senha"])){
            $senhaErro = "Campo obrigatório";
        }
        else{
            $senha = $_POST["senha"];
        }
    }
    include("../include/mysqli.php");
    if($usuario && $senha && isset($_POST["logar"])){
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE nome = ?");
        if($sql->execute(array($usuario))){
            if($sql->rowCount() > 0){

            }
            else{
                $usuarioErro = "Este usuario não existe";
            }
        }
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE senha = ? AND nome = ?");
        if($sql->execute(array(md5($senha), $usuario))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($info as $key => $values){
                    $_SESSION["usuario"] = $values["nome"];
                    $_SESSION["senha"] = $values["senha"];
                    $_SESSION["pr"] = $values["pr"];
                }
            if($sql->rowCount() > 0){
                header("location: home.php");
            }
            else{
                $senhaErro = "Senha inválida";
            }
        }
    }
?>
<body>
    <form action="" method="post">
        <fieldset>
            <div class="formTop">
                <h2>Login</h2>
                <p>Não tem login ? <a href="pessoa.php">Cadastre-se</a></p>
                <label>Usuário</label><br>
                <input type="text" name="usuario" maxlength="100" class="formInput"><br>
                <span class="spanErro"><?php echo $usuarioErro; ?></span><br>
                <label>Senha</label><br>
                <input type="password" name="senha" maxlength="100" class="formInput"><br>
                <span class="spanErro"><?php echo $senhaErro; ?></span><br>
                <input type="submit" value="Logar" name="logar" class="btn">
            </div>
        </fieldset>
    </form>
</body>
<?php
    require("../templates/footer.php");
?>