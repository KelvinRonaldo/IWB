<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <script src="./js/menu_categorias.js"></script>
        <script src="./js/filtrarPromocoes.js"></script>
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
                    <!-- LISTA/MENU DE "FILTROS" DE PRODUTOS A ESQUERDA DA PAGINA -->
                    <div id="promocoes-esq">
                        <ul id="menu-promocoes">
                            <li class="item-menu-promocoes">
                                <!-- TITULO DO TIPO DE ITEM A SER FILTRADO -->
                                <h3>BICICLETAS</h3>
                                <ul id="submenu-bicicletas-promo">
                                    <!-- ITENS DA LISTA DE FILTROS -->
                                    <li class="item-submenu-bicicletas">
                                        <a href="#">Bike Elétrica</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="item-menu-promocoes">
                                <!-- TITULO DO TIPO DE ITEM A SER FILTRADO -->
                                <h3>ACESSÓRIOS</h3>
                                <ul id="submenu-acessorios-promo">
                                    <!-- ITENS DA LISTA DE FILTROS -->
                                    <?php
                                        for($cont = 0; $cont < 7; $cont++){
                                    ?>
                                    <li class="item-submenu-acessorios">
                                        <a href="#">Bike Elétrica</a>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- ITEM EM PROMOÇÕES A DIREITA DO SITE -->
                    <div id="promocoes-dir">
                            <?php

                            require_once('./bd/conexao.php');
                            $conexao = conexaoMySql();

                                $sql = "SELECT promo.*, promo.status AS status_promocao,
                                produto.*, produto.status AS status_promocao
                                FROM tbl_promocao AS promo
                                INNER JOIN tbl_produto AS produto
                                ON promo.cod_produto = produto.cod_produto
                                WHERE promo.status = 'ativado' AND produto.status = 'ativado'";

                                $select = mysqli_query($conexao, $sql);

                                while($rsPromocao = mysqli_fetch_array($select)){
                                    $percentualDesconto = $rsPromocao['percentual_desconto'];
                                    $precoDesconto = $rsPromocao['preco_desconto'];
                                    $statusPromocao = $rsPromocao['status_promocao'];
                                    $nomeProduto = $rsPromocao['nome'];
                                    $precoProduto = $rsPromocao['preco'];
                                    $statusProduto = $rsPromocao['status_promocao'];
                                    $imagemProduto = $rsPromocao['imagem'];
                                    $numeroParcelas = $rsPromocao['numero_parcelas'];
                                    $metodoPagamento = $rsPromocao['metodo_pagamento'];
                                    $precoParcelas = $rsPromocao['preco_parcelas'];
                                    $precoParcelas = number_format($precoParcelas, 2, ',', '.');
                            ?>
                            <!-- AREA QUE SEGURA AS INFORMAÇÕES DO PRODUTO EM PROMOÇÃO -->
                            <div class="promocoes">
                                <figure>
                                    <!-- IMAGEM DO PRODUTO EM PROMOÇÃO -->
                                    <div class="promocoes-img center">
                                        <img src="./arquivos/<?php echo $imagemProduto ?>" class="img-div" alt="#" title="#">
                                    </div>
                                </figure>
                                <!-- NOME DO PRODUTO EM PROMOÇÃO -->
                                <div class="promocoes-nome">
                                    <p>
                                        <?php echo $nomeProduto ?>
                                    </p>
                                </div>
                                <!-- % DE DESCONTO DO PRODUTO EM PROMOÇÃO -->
                                <div class="porcentagem-desconto">
                                    <h4><?php echo $percentualDesconto ?>% DE DESCONTO</h4>
                                </div>
                                <!-- PREÇO INICIAL DO PRODUTO EM PROMOÇÃO -->
                                <div class="promocoes-inicial">
                                    <p>DE R$<?php echo $precoProduto ?></p>
                                </div>
                                <!-- VALOR DO PRODUTO EM PROMOÇÃO COM O DESCONTO -->
                                <div class="promocoes-com-desconto">
                                    <p><span class="por">POR </span>R$<?php echo $precoDesconto ?></p>
                                </div>
                                <!-- INFORMAÇÕES DE PAGAMENTO  -->
                                <div class="tipo-pagamento">
                                <?php
                                    if(($numeroParcelas != null && $metodoPagamento != null) || $percentualDesconto != 100) {
                                ?>
                                    <p>
                                        <span class="negrito"><?php echo $numeroParcelas . "x de R$" . $precoParcelas ?></span><?php echo " ".$metodoPagamento ?>
                                    </p>
                                <?php
                                    }
                                ?>
                                </div>
                                <!-- BOTÃO PARA IR A PAGINA DE COMPRA DO PRODUTO EM PROMOÇÃO -->
                                <div class="caixa-btn-comprar">
                                    <input onclick="location.href(promocoes.php)" type="button" class="btn-comprar" value="COMPRAR">
                                </div>
                            </div>
                            <?php
                                }
                            ?>
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