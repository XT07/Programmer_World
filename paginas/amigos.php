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
    $moPesq = "";
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <h2>Procurar usuário</h2>
            <input type="text" name="pesq" class="pesq" placeholder="Pesquisar...">
        </form>
        <?php
            echo $pesq;
        ?>
        <br>
        <br>
        <div class="respPesq">
            <?php
            $pr = "Usuário";
                if(empty($_POST["pesq"])){
                    
                }
                else{
                    $pesq = tI($_POST["pesq"]);
                    $sql = $pdo->prepare("SELECT * FROM usuario WHERE nome = ?");
                    if($sql->execute(array($pesq))){
                        if($sql->rowCount() > 0){
                            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                            foreach($info as $key => $values){
                                if($values["pr"] == 1){
                                    $pr = "Programador";
                                }
                                echo "<table class='resp'>";
                                echo "<tbody>";
                                echo "<tr class='linha'>";
                                echo "<td class='mResp'>";
                                echo "<label class='nomePesq'>".$values['nome']."</label>";
                                echo "</td>";
                                echo "<td class='mResp'>";
                                echo "<label class='nomePesqDes' maxlength='50'>".$pr."</label>";
                                echo "</td>";
                                echo "<td>";
                                echo "<input type='button' name='verPerfil' class='btnT' value='Ver perfil'>";
                                echo "</td>";
                                echo "</tr>";
                                echo "</tbody>";
                                echo "</table>";
                            }
                        }
                        else{
                            echo "Nenhum resultado para: ".tI($_POST["pesq"]);
                        }
                    }
                }
            ?>
        </div>
    </div>
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