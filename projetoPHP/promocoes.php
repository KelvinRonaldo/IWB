<?php
     require_once("bd/conexao.php");
     $conexao = conexaoMySql();

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <script src="cms/js/jquery-3.3.1.min.js"></script>
        <script src="js/menu_categorias.js"></script>
        <script src="js/filtrarPromocoes.js"></script>
        <title>PROMOÇÕES</title>
        <meta charset="utf-8">
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <!-- AREA QUE SEGURADO TODA A PAGINA -->
        <div id="pagina">
            <!-- IMPORTANDO HEADER -->
            <?php 
                require_once('header.html');
            ?>
            <!-- AREA ONDE ESTÁ TODA ESTRUTURA DO SITE, EXCETO HEADER E FOOTER -->
            <div id="tudo" class="center">
                <!-- AREA COM TITULO DA PAGINA -->
                <div id="titulo-pagina">
                    <h1>PROMOÇÕES</h1>
                </div>
                <!-- AREA QUE SEGURA TODO CONTEUDO DA PAGINA -->
                <div id="conteudo">

                    <!-- LOCAL DAS REDE SOCIAIS -->
                    <div id="redes-sociais-promocoes">
                        <a href="#">
                            <div class="divs-redes">
                                <img class="img-div" src="imgs/faceicon.png" alt="Facebook" title="Facebook">
                            </div>
                        </a>
                        <a href="#">
                            <div class="divs-redes">
                                <img class="img-div" src="imgs/gplusicon.png" alt="G+" title="G+">
                            </div>
                        </a>
                        <a href="#">
                            <div class="divs-redes">
                                <img class="img-div" src="imgs/twittericon.png" alt="Twitter" title="Twitter">
                            </div>
                        </a>
                    </div>
                    <div id="abrir-menu" class="flexbox">
                        <figure>
                            <img class="icon-filter" src="./imgs/mobile/filtro.png">
                        </figure>
                    </div>
                    <?php require_once("menuCategorias.php") ?>
                    
                    <!-- ITEM EM PROMOÇÕES A DIREITA DO SITE -->
                    <div id="promocoes-dir">
                    </div>

                </div>
            </div>
            <!-- IMPORTANDO FOOTER -->
            <?php 
                require_once('footer.html');
            ?>
        </div>
    </body>
</html>