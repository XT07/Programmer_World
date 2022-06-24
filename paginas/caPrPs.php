<?php
    require("../templates/header.php");
    $usuarioErro = $usuario = "";
    $emailErro = $email = "";
    $senhaErro = $senha = "";
    $senhaCopErro = "";
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
                        $sql = $pdo->prepare("INSERT INTO usuario VALUES (null, ?, ?, ?)");
                        if($sql->execute(array($usuario, $email, md5($senha)))){}
                        header("LOCATION: login.php");
                    }
                }
            }
        }
    }
?>
<body>
    <form>
        <fieldset>
            <div class="formTop">
                <h2>Cadastrar-se como</h2><br>
                <a href="programador.php" class="caPrPs">Programador</a><br><br>
                <a href="pessoa.php" class="caPrPs">Não programador</a><br>
                <div class="voltarIn">
                    <a href="login.php"><b class="voltar"><<</b> Voltar</a>
                </div>
            </div>
        </fieldset>
    </form>
</body>
<?php
    require("../templates/footer.php");
?>