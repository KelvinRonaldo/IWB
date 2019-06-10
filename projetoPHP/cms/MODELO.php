<?php

    require_once ('verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/fontes.css">
    <title>GERENCIAR </title>
    <meta charset="utf-8">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <script src="js/jquery-3.3.1.min.js"></script>
</head>
    <body>
        <!-- CONTAINER DO MODAL -->
        <div id="container">
            <div id="modal-noticia" class="center">

            </div>
        </div>
        <!-- AREA DE TODO O CONTEUDO DA PAGINA -->
        <div id="tudo">
            <!-- IMPORTANDO ARQUIVO COM HEADER DA PAGINA -->
            <?php
                require_once('header.html');
            ?>
            <div id="menu" class="center flexbox">
                <!-- IMPORTANDO ARQUIVO COM MENU DA PAGINA -->
                <?php
                    require_once('menu.php');
                ?>
            </div>
            <!-- AREA COM O CONTEUDO DA PAGINA -->
            <div id="conteudo-noticias">

            </div>
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('footer.html');
            ?>
        </div>
    </body>
</html>