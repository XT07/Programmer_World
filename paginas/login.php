<?php
    require("../templates/header.php");
    $usuarioErro = $usuario = "";
    $senhaErro = $senha = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST("logar"))){
        if(isset($_POST["usuario"])){
            $usuarioErro = "Campo obrigatório";
        }
        else{
            $usuario = $_POST["usuario"];
        }
        if(isset($_POST["senha"])){
            $senhaErro = "Campo obrigatório";
        }
        else{
            $senha = $_POST["senha"];
        }
    }
?>
<form action="" method="post">
    <fieldset>
        <h2>Login</h2>
        <label>Usuário</label><br>
        <input type="text" name="usuario" maxlength="100"><br>
        <span><?php echo $usuarioErro; ?></span><br>
        <label>Senha</label><br>
        <input type="password" name="senha" maxlength="100"><br>
        <span><?php echo $senhaErro; ?></span><br>
        <input type="submit" value="Logar" name="logar">
    </fieldset>
</form>