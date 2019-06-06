<?php
    require_once("./bd/conexao.php");
    $conexao = conexaoMySql();

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <script src="./js/jssor.slider-27.5.0.min.js"></script>
        <script src="./js/slider.js"></script>
        <script src="./cms/js/jquery-3.3.1.min.js"></script>
        <script src="./js/menu_categorias.js"></script>
        <script src="./js/filtrarProdutos.js"></script>
        <title>Road Runner Cross Bikes SA</title>
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <!-- AREA QUE SEGURADO TODA A PAGINA -->
        <div id="pagina">
            <!-- IMPORTANDO O HEADER -->
            <?php 
                require_once('./header.html');
            ?>
            <!-- AREA ONDE ESTÁ TODA ESTRUTURA DO SITE, EXCETO HEADER E FOOTER -->
            <div id="tudo" class="center">
                <div id="slider">
                    <?php
                        require_once('slider.php');
                    ?>
                </div>

                <div id="imagem-home-mobile">
                    <figure>
                        <img id="img-home" src="imgs/009.jpg" alt="Imagem Principal Home" title="Imagem Principal Home">
                    </figure>

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

                    <div id="abrir-menu" class="flexbox">
                        <figure>
                            <img class="icon-filter" src="./imgs/mobile/filtro.png">
                        </figure>
                    </div>

                        <!-- ITEM DO MENU -->
                    <div id="container-categoria-menu" class="container-categoria-menu">
                    <!-- MENU À ESQUERDA DA PAGINA -->
                        <div id="menu-esq" class="menu-categoria-close">
                            <?php
                                $sqlCategoria = "SELECT * FROM tbl_categoria WHERE status = 'ativado'";
                                $selectCategoria = mysqli_query($conexao, $sqlCategoria);

                                while($rsCategorias = mysqli_fetch_array($selectCategoria)){
                                $codCategoria = $rsCategorias['cod_categoria'];
                                $categoria = $rsCategorias['categoria'];
                            ?>
                            <div class="item-menu-esq">
                                <h3 onclick="buscarPorProdutosFiltros(<?= $codCategoria?>, 0)"><?php echo $categoria; ?></h3>
                                <div class="icon-subcategorias">
                                    <!-- <p>+</p> -->
                                    <figure>
                                        <img src="./imgs/plus.png" class="icon-show-categories">
                                    </figure>
                                </div>

                                <ul class="caixa-subitem-menu-esq esconder">
                                    <?php
                                        $sqlSubcategoria = "SELECT distinct s.subcategoria,s.cod_subcategoria
                                        FROM tbl_categoria AS c
                                        INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
                                        ON c.cod_categoria = tpsc.cod_categoria
                                        INNER JOIN tbl_subcategoria AS s
                                        ON tpsc.cod_subcategoria = s.cod_subcategoria
                                        WHERE c.status = 'ativado' AND s.status = 'ativado'
                                        AND c.cod_categoria = ".$codCategoria;

                                        $selectSubcategoria = mysqli_query($conexao, $sqlSubcategoria);

                                        while($rsSubcategorias = mysqli_fetch_array($selectSubcategoria)){
                                        $codSubategoria = $rsSubcategorias['cod_subcategoria'];
                                        $subcategoria = $rsSubcategorias['subcategoria'];
                                    ?>
                                    <li class="subitem-menu-esq">
                                        <h3 class="subitem-menu-esq-h3" onclick="buscarPorProdutosFiltros(<?= $codCategoria.', '.$codSubategoria; ?>)"><?= $subcategoria?></h3>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            <?php
                                }
                            ?>                            
                        </div>
                    </div>
                    
                    <!-- AREA ONDE ESTÃO OS PRODUTOS DA LOJA -->
                    <div id="produtos">
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