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
    include("../include/mysqli.php");
    $pesq = "";
    $nomePesq = "";
    $desPesq = "";
    $mPesq = "";
    if(empty($_POST["pesq"])){
        
    }
    else{
        $pesq = $_POST["pesq"];
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE nome = ?");
        if($sql->execute(array($pesq))){
            if($sql->rowCount() > 0){
                $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($info as $key => $values){
                    $nomePesq = $values["nome"];
                    $desPesq = $values["descricao"];
                    $pesq = "";
                    $moPesq = 1;
                }
            }
            else{
                $pesq = "Nenhum resultado para: ".$_POST["pesq"];
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
                <a href='amigos.php' class="aMenu">Amigos</a>
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
    <div class="containerPesq">
        <form action="" method="POST">
            <input type="text" name="pesq" class="pesq" placeholder="Pesquisar...">
        </form>
        <?php
            echo $pesq;
        ?>
        <br>
        <br>
        <div class="respPesq">
            <?php
                if(isset($_POST["pesq"]) && !empty($nomePesq) || !empty($desPesq)){
                    $mPesq = 1;
                }
                if($mPesq = 1){}
            ?>

        </div>
    </div>
</body>