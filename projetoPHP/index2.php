<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <title>PROJETO PHP</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php 
            require_once('header.html');
        ?>
        <div id="aux">
            
        </div>
        <div id="tudo" class="center">
            <section id="slider">
                <h2 hidden> VALIDADOR</h2>
                <?php
                    require_once('slider.html');
                ?>
            </section>
            <div id="conteudo">

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

                <ul id="menu-esq">
                    <li class="item-menu-esq">
                        <h3>Item de Menu</h3>
                    </li>
                    <li class="item-menu-esq">
                        <h3>Item de Menu</h3>
                    </li>
                </ul>
                <section id="produtos">
                    <h2 hidden> VALIDADOR</h2>
                    <div class="produto">
                        <figure>
                            <div class="produto-img center">
                                <img src="imgs/biketemp.jpg" class="img-div" alt="#" title="#">
                            </div>
                        </figure>
                        <div class="titles-nome">
                            <h4 class="nome">Nome:</h4>
                        </div>
                        <div class="nome-texts">
                            <p class="produto-nome">Bicicleta koan Mahuna - Aro 29" - Alumínio - 27V</p>
                        </div>
                        
                        <div class="titles-descricao">
                            <h4 class="descricao">Descrição:</h4>
                        </div>
                        <div class="descricao-texts">
                            <p class="produto-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                            </p>
                        </div>
                        
                        <div class="titles-preco">
                            <h4 class="preco">Preço:</h4>
                        </div>
                        <div class="preco-texts">
                            <p class="produto-preco">R$259,90</p>
                        </div>
                        <a class="detalhes" href="#">Detalhes</a>
                    </div>
                </section>
            </div>
        </div>
        <?php 
            require_once('footer.html');
        ?>
    </body>
</html>