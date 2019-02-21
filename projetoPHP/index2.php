<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <title>PROJETO PHP</title>
    </head>
    <body>
        <header>
            <div id="cabecalho" class="center">
                <div id="cabecalho-esq">
                    <figure>
                        <a href="#">
                            <div id="logo">
                                <img src="imgs/logoTemp.png" class="img-div" alt="LOGO" title="LOGO">
                            </div>
                        </a>
                    </figure>
                    <nav id="menu">
                        <h3 id="titulo-menu">MENU >></h3>
                        <ul id="caixa-menu">
                            <li class="item-menu">Home</li>
                            <li class="item-menu">Home</li>
                            <li class="item-menu">Home</li>
                            <li class="item-menu">Home</li>
                            <li class="item-menu">Home</li>
                            <li class="item-menu">Home</li>
                        </ul>
                    </nav>
                </div>
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
            <div id="tudo" class="center">
                <section id="slider">
                    <h2 hidden> VALIDADOR</h2>
                    <?php
                        require_once('standard.php');
                    ?>
                </section>
                <div id="conteudo">

                    <div id="redes-sociais">
                        <div class="divs-redes">
                            <h3>face</h3>
                        </div>
                        <div class="divs-redes">
                            <h3>youtube</h3>
                        </div>
                        <div class="divs-redes">
                            <h3>twitter</h3>
                        </div>
                    </div>

                    <ul id="menu-esq">
                        <li class="item-menu-esq"></li>
                        <li class="item-menu-esq"></li>
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
                                <p class="produto-nome">123 1</p>
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
        </header>
    </body>
</html>