
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <script src="js/jssor.slider-27.5.0.min.js"></script>
        <script src="js/slider.js"></script>
        <title>Road Runner Cross Bikes SA</title>
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <!-- AREA QUE SEGURADO TODA A PAGINA -->
        <div id="pagina">
            <!-- IMPORTANDO O HEADER -->
            <?php 
                require_once('header.html');
            ?>
            <!-- AREA ONDE ESTÁ TODA ESTRUTURA DO SITE, EXCETO HEADER E FOOTER -->
            <div id="tudo" class="center">
                <div id="slider">
                    <?php
                        require_once('slider.php');
                    ?>
                </div>
                <!-- AREA QUE SEGURA TODO CONTEUDO DA PAGINA -->
                <div id="conteudo">

                    <!-- AREA DAS REDE SOCIAIS -->
                    <div id="redes-sociais">
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

                    <!-- MENU À ESQUERDA DA PAGINA -->
                    <ul id="menu-esq">
                        <!-- ITEM DO MENU -->
                        <li class="item-menu-esq">
                            <a href="#">
                                <h3>Item de Menu</h3>
                            </a>
                        </li>
                        <li class="item-menu-esq">
                            <a href="#">
                                <h3>Item de Menu</h3>
                            </a>
                        </li>
                    </ul>
                    
                    <!-- AREA ONDE ESTÃO OS PRODUTOS DA LOJA -->
                    <div id="produtos">
                        <?php
                            for($cont = 0; $cont < 15; $cont++){
                        ?>
                        <!-- AREA INDIVIDUAL QUE SEGURA AS INFORMAÇÃOES DE CADA PRODUTO -->
                        <div class="produto">
                            <!-- IMAGEM DO PRODUTO -->
                            <figure>
                                <div class="produto-img center">
                                    <img src="imgs/biketemp.jpg" class="img-div" alt="#" title="#">
                                </div>
                            </figure>
                            <!-- NOME DO PRODUTO -->
                            <div class="nome-texts">
                                <p class="produto-nome">Bicicleta koan Mahuna - Aro 29" - Alumínio - 27V </p>
                            </div>
                            <!-- DESCRIÇÃO DO PRODUTO -->
                            <div class="descricao-texts">
                                <p class="produto-descricao">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                                </p>
                            </div>
                            <!-- PREÇO DO PRODUTO -->
                            <div class="preco-texts">
                                <p class="produto-preco">R$259,90</p>
                            </div>
                            <!-- LINK PARA ACESSAR OS DETALHES DO PRODUTO -->
                            <a class="detalhes" href="#">Detalhes</a>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- IMPORTANDO FOOTER DA PAGINA -->
            <?php 
                require_once('footer.html');
            ?>
        </div>
    </body>
</html>