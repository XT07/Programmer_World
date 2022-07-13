<?php
    session_start();
    $_SESSION["usuario"] = "";
    $_SESSION["senha"] = "";
    $_SESSION['email'] = "";
    $_SESSION['foto'] = "";
    $_SESSION['descricao'] = "";
    require("../templates/header.php");
    include("../include/mysqli.php");
    $usuarioErro = $usuario = "";
    $senhaErro = $senha = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logar"])){
        if(empty(tI($_POST["usuario"]))){
            $usuarioErro = "Campo obrigatório";
        }
        else{
            $usuario = tI($_POST["usuario"]);
        }
        if(empty(tI($_POST["senha"]))){
            $senhaErro = "Campo obrigatório";
        }
        else{
            $senha = tI($_POST["senha"]);
        }
    }   
    $_SESSION["senhaDescrip"] = $senha;
    if($usuario && $senha && isset($_POST["logar"])){
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE nome = ?");
        if($sql->execute(array($usuario))){
            if($sql->rowCount() > 0){

            }
            else{
                $emailErro = "Este e-mail não está cadastrado";
            }
        }
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE senha = ? AND nome = ?");
        if($sql->execute(array(md5($senha), $usuario))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($info as $key => $values){
                    $_SESSION["usuario"] = $values["nome"];
                    $_SESSION["senha"] = $values["senha"];
                    $_SESSION["pr"] = $values["pr"];
                    $_SESSION['email'] = $values["email"];
                    $_SESSION['foto'] = $values["foto"];
                    $_SESSION['descricao'] = $values["descricao"];
                    $_SESSION['id'] = $values["id_user"];
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
    <form action="  " method="post">
        <fieldset>
            <div class="formTop">
                <h2>Login</h2>
                <p>Don't have registration ? <a href="pessoa.php">registration here</a></p>
                <label>User</label><br>
                <input type="text" name="usuario" maxlength="100" class="formInput"><br>
                <span class="spanErro"><?php echo $usuarioErro; ?></span><br>
                <label>Password</label><br>
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