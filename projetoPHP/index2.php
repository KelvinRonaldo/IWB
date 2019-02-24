<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <title>PROJETO PHP</title>
    </head>
    <body>
        <header>
            <div id="cabecalho" class="center">
                <div id="cabecalho-esq">
                    <figure>
                        <a href="#">
                            <div id="logo">
                                <img src="imgs/bikeicon.png" class="img-div" alt="LOGO" title="LOGO">
                            </div>
                        </a>
                    </figure>
                    <nav id="menu">
                        <h3 id="titulo-menu">MENU<span id="seta-menu">X</span></h3>
                        <ul id="caixa-menu">
                            <li class="item-menu" onclick="window.location.href='#'">Notícias</li>
                            <li class="item-menu" onclick="window.location.href='#'">Sobre</li>
                            <li class="item-menu" onclick="window.location.href='#'">Promoções</li>
                            <li class="item-menu" onclick="window.location.href='#'">Lojas</li>
                            <li class="item-menu" onclick="window.location.href='#'">Eventos</li>
                            <li class="item-menu" onclick="window.location.href='#'">Contato</li>
                        </ul>
                    </nav>
                </div>
                <!-- <div onclick="teste()" id="oi" style="width: auto; height: auto; z-index: 0;">
                    <img src="imgs/user.png" style="width: 40px; height: 40px;">
                </div> -->
                <div id="cabecalho-dir">
                    <form name="frm_login" action="#" method="POST">
                        <div class="text-login">
                            <h6 id="usuario">Usuário:</h6>
                            <input type="text" name="txt_usuario" id="txt-usuario">
                        </div>
                        <div class="text-login">
                            <h6 id="senha">Senha:</h6>
                            <input type="password" name="txt_senha" id="txt-senha">
                        </div>
                        <div id="btn">
                            <input type="submit" name="btn-login" id="btn-login" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </header>
        <div id="aux">
            
        </div>
        <div id="tudo" class="center">
            <section id="slider">
                <h2 hidden> VALIDADOR</h2>
                <?php
                    require_once('slider.php');
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
                        <!-- ------------------------ -->
                        <div class="titles-descricao">
                            <h4 class="descricao">Descrição:</h4>
                        </div>
                        <div class="descricao-texts">
                            <p class="produto-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                            </p>
                        </div>
                        <!-- ------------- -->
                        <div class="titles-preco">
                            <h4 class="preco">Preço:</h4>
                        </div>
                        <div class="preco-texts">
                            <p class="produto-preco">R$259,90</p>
                        </div>
                        <a class="detalhes" href="#">Detalhes</a>
                    </div>
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
                        <!-- ------------------------ -->
                        <div class="titles-descricao">
                            <h4 class="descricao">Descrição:</h4>
                        </div>
                        <div class="descricao-texts">
                            <p class="produto-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                            </p>
                        </div>
                        <!-- ------------- -->
                        <div class="titles-preco">
                            <h4 class="preco">Preço:</h4>
                        </div>
                        <div class="preco-texts">
                            <p class="produto-preco">R$259,90</p>
                        </div>
                        <a class="detalhes" href="#">Detalhes</a>
                    </div>
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
                        <!-- ------------------------ -->
                        <div class="titles-descricao">
                            <h4 class="descricao">Descrição:</h4>
                        </div>
                        <div class="descricao-texts">
                            <p class="produto-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                            </p>
                        </div>
                        <!-- ------------- -->
                        <div class="titles-preco">
                            <h4 class="preco">Preço:</h4>
                        </div>
                        <div class="preco-texts">
                            <p class="produto-preco">R$259,90</p>
                        </div>
                        <a class="detalhes" href="#">Detalhes</a>
                    </div>
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
                        <!-- ------------------------ -->
                        <div class="titles-descricao">
                            <h4 class="descricao">Descrição:</h4>
                        </div>
                        <div class="descricao-texts">
                            <p class="produto-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                            </p>
                        </div>
                        <!-- ------------- -->
                        <div class="titles-preco">
                            <h4 class="preco">Preço:</h4>
                        </div>
                        <div class="preco-texts">
                            <p class="produto-preco">R$259,90</p>
                        </div>
                        <a class="detalhes" href="#">Detalhes</a>
                    </div>
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
                        <!-- ------------------------ -->
                        <div class="titles-descricao">
                            <h4 class="descricao">Descrição:</h4>
                        </div>
                        <div class="descricao-texts">
                            <p class="produto-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                            </p>
                        </div>
                        <!-- ------------- -->
                        <div class="titles-preco">
                            <h4 class="preco">Preço:</h4>
                        </div>
                        <div class="preco-texts">
                            <p class="produto-preco">R$259,90</p>
                        </div>
                        <a class="detalhes" href="#">Detalhes</a>
                    </div>
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
                        <!-- ------------------------ -->
                        <div class="titles-descricao">
                            <h4 class="descricao">Descrição:</h4>
                        </div>
                        <div class="descricao-texts">
                            <p class="produto-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                            </p>
                        </div>
                        <!-- ------------- -->
                        <div class="titles-preco">
                            <h4 class="preco">Preço:</h4>
                        </div>
                        <div class="preco-texts">
                            <p class="produto-preco">R$259,90</p>
                        </div>
                        <a class="detalhes" href="#">Detalhes</a>
                    </div>
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
                        <!-- ------------------------ -->
                        <div class="titles-descricao">
                            <h4 class="descricao">Descrição:</h4>
                        </div>
                        <div class="descricao-texts">
                            <p class="produto-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.
                            </p>
                        </div>
                        <!-- ------------- -->
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
        <footer class="center">
            <div id="footer-linha1" class="center">
                <div id="center-footerL1" class="center">
                    <div id="contatos">
                        <figure>
                            <div id="contatos-icon">
                                <img class="img-div" src="imgs/phone.png">
                            </div>
                        </figure>
                        <div id="contatos-text">
                            <h3 id="title-contatos">Contatos</h3>
                            <p id="text-contatos">(11) 4637-0192 <br> (11) 6870-2345</p>
                        </div>
                    </div>
                    <div id="horario">
                        <figure>
                            <div id="horario-icon">
                                <img class="img-div" src="imgs/watch.png">
                            </div>
                        </figure>
                        <div id="horario-text">
                            <h3 id="title-hora">Horários de Atendimento</h3>
                            <p id="text-hora">Segunda à Sexta | 08:30h às 18:30h <br> Sábados | 10h às 14h</p>
                        </div>
                    </div>
                    <div id="endereco">
                        <figure>
                            <div id="endereco-icon">
                                <img class="img-div" src="imgs/local.png">
                            </div>
                        </figure>
                        <div id="endereco-text">
                            <h3 id="title-endereco">Endereço</h3>
                            <p id="text-endereco">Rua Clodomiro Amazonas, 74 Itaim - São Paulo SP CEP: 04537-001</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer-linha2" class="center">
                <div id="center-footerL2" class="center">
                    <h2>Desenvolvido por Kelvin Ronaldo</h2>
                </div>
            </div>
        </footer>
    </body>
</html>