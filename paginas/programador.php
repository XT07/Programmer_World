<?php
    require("../templates/header.php");
    $usuarioErro = $usuario = "";
    $emailErro = $email = "";
    $senhaErro = $senha = "";
    $senhaCopErro = "";
    $aux = "";
    $ling = "";
    $css = "";
    $html = "";
    $java = "";
    $js = "";
    $c = "";
    $cMM = "";
    $php = "";
    $mysql = "";
    $lua = "";
    $python = "";
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
        if(empty($_POST["aux"])){
            $aux = false;
        }
        else{
            $aux = true;
        }
        if(empty($_POST["css"])){
            $css = false;
        }
        else{
            $css = true;
        }
        if(empty($_POST["html"])){
            $html = false;
        }
        else{
            $html = true;
        }
        if(empty($_POST["java"])){
            $java = false;
        }
        else{
            $java = true;
        }
        if(empty($_POST["js"])){
            $js = false;
        }
        else{
            $js = true;
        }
        if(empty($_POST["c"])){
            $c = false;
        }
        else{
            $c = true;
        }
        if(empty($_POST["c++"])){
            $cMM = false;
        }
        else{
            $cMM = true;
        }
        if(empty($_POST["php"])){
            $php = false;
        }
        else{
            $php = true;
        }
        if(empty($_POST["mysql"])){
            $mysql = false;
        }
        else{
            $mysql = true;
        }
        if(empty($_POST["lua"])){
            $lua = false;
        }
        else{
            $lua = true;
        }
        if(empty($_POST["python"])){
            $python = false;
        }
        else{
            $python = true;
        }
    }
    include("../include/mysqli.php");
    if($usuario && $email && $senha && isset($_POST["cadastrar"])){
        $sql = $pdo->prepare("SELECT * FROM pr WHERE nome = ?");
        if($sql->execute(array($usuario))){
            if($sql->rowCount() > 0){
                $usuarioErro = "Este usuário já existe";
            }
            else{
                $sql = $pdo->prepare("SELECT * FROM pr WHERE email = ?");
                if($sql->execute(array($email))){
                    if($sql->rowCount() > 0){
                        $emailErro = "Este e-mail já foi cadastrado";
                    }
                    else{
                        $sql = $pdo->prepare("INSERT INTO pr VALUES (null, ?, ?, ?, ?, null)");
                        if($sql->execute(array($usuario, $email, md5($senha), $aux))){}
                        $sql = $pdo->prepare("INSERT INTO ling VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        if($sql->execute(array($css, $html, $java, $js, $c, $cMM, $php, $mysql, $lua, $python))){}
                        header("LOCATION: login.php");
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
                <h2>Quais destas linguagens vocÊ tem experiência ?</h2>
            </div>
            <div class="ling">
                <input type="checkbox" name="css" id="css"  value="css" class="lingR">
                <label for="css">CSS</label><br>
                <input type="checkbox" name="html" id="html"  value="html" class="lingR">
                <label for="html">HTML</label><br>
                <input type="checkbox" name="java" id="java"  value="java" class="lingR">
                <label for="java">JAVA</label><br>
                <input type="checkbox" name="js" id="js"  value="js" class="lingR">
                <label for="js">JS</label><br>
                <input type="checkbox" name="c" id="c"  value="c" class="lingR">
                <label for="c">C</label><br>
                <input type="checkbox" name="c++" id="c++"  value="c++" class="lingR">
                <label for="c++">C++</label><br>
                <input type="checkbox" name="php" id="php"  value="php" class="lingR">
                <label for="php">PHP</label><br>
                <input type="checkbox" name="mysql" id="mysql"  value="mysql" class="lingR">
                <label for="mysql">MYSQL</label><br>
                <input type="checkbox" name="lua" id="lua"  value="lua" class="lingR">
                <label for="lua">LUA</label><br>
                <input type="checkbox" name="python" id="python"  value="python" class="lingR">
                <label for="python"></label>PYTHON<br>
                <input type="checkbox" name="aux" id="aux" class="lingR">
                <label for="aux">Aceito receber perguntas sobre as linguagens acima.</label><br>
            </div>
            <div class="clear"></div><br>
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