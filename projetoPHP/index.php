<?php
    require_once("bd/conexao.php");
    $conexao = conexaoMySql();
    $codCategoria = null;
    $codSubcategoria = null;
    $statusProduto = null;
    $statusPromocao = null;
    $imagemProduto = null;
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <script src="cms/js/jquery-3.3.1.min.js"></script>
        <script src="js/jssor.slider-27.5.0.min.js"></script>
        <script src="js/slider.js"></script>
        <script src="js/menu_categorias.js"></script>
        <script src="js/filtrarProdutos.js"></script>
        <script>
            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#container-index').fadeIn(300);
                });
            });
            const viewProduto = (codProduto) =>{
                $.ajax({
                    type: "GET",
                    url: "modais/viewProduto.php",
                    data: {codProduto: codProduto},
                    success: function(dados){
                        $("#modal-index").html(dados);
                    }
                });
            }

            document.onkeydown = f5;
            document.onkeypress = f5;
            document.onkeyup = f5;

            var f5Pressionado = false;

            function f5(evento){
                    evento = evento || window.event;
                if( f5Pressionado ) return; 

                    if (evento.keyCode == 116) {
                        location.href = "index.php?";
                        f5Pressionado = true;
                    }
            }
        </script>
        <title>Road Runner Cross Bikes SA</title>
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <div id="container-index">
            <div id="modal-index" class="center">

            </div>
        </div>
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
                            <img class="icon-filter" src="imgs/mobile/filtro.png">
                        </figure>
                    </div>

                    
                    <?php require_once("menuCategorias.php") ?>
                    
                    <!-- AREA ONDE ESTÃO OS PRODUTOS DA LOJA -->
                    <div id="produtos">
                        <?php
                            if(isset($_GET['cod_categoria']) && isset($_GET['cod_subcategoria'])){
                                $codCategoria = $_GET['cod_categoria'];
                                $codSubcategoria = $_GET['cod_subcategoria'];
                            }else{
                                $codCategoria = 0;
                                $codSubcategoria = 0;
                            }

                            if(isset($_GET['pesquisa'])){
                                $pesquisa = $_GET['pesquisa'];
                            
                                $texto = explode(" ", $pesquisa);
                            
                                $texto = array_filter($texto);
                            
                                $numPalavras = sizeof($texto);
                            
                                $pesquisa = "%";
                            
                                for($i = 0; $i < $numPalavras; $i++){        
                                    $pesquisa .= $texto[$i]."%";
                                }
                            
                                $sql = "SELECT p.*, pr.*, pr.status AS status_promocao FROM tbl_produto AS p
                                LEFT JOIN tbl_promocao AS pr
                                ON p.cod_produto = pr.cod_produto
                                WHERE p.nome LIKE '".$pesquisa."' OR
                                p.descricao LIKE '".$pesquisa."'
                                GROUP BY p.nome";

                            }else{
                                if($codCategoria == 0 && $codSubcategoria == 0){
                                    $filtro = "ORDER BY RAND()";
                                }elseif($codCategoria != 0 && $codSubcategoria == 0){
                                    $filtro = "AND c.cod_categoria = ".$codCategoria." AND s.cod_subcategoria > ".$codSubcategoria;
                                }elseif($codCategoria != 0 && $codSubcategoria != 0){
                                    $filtro = "AND c.cod_categoria = ".$codCategoria." AND s.cod_subcategoria = ".$codSubcategoria;
                                }
    
                                $sql = "SELECT DISTINCT p.nome, p.*, pr.preco_desconto, pr.status AS status_promocao, c.cod_categoria
                                FROM tbl_promocao AS pr
                                RIGHT JOIN tbl_produto AS p
                                ON pr.cod_produto = p.cod_produto
                                INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
                                ON p.cod_produto = tpsc.cod_produto
                                INNER JOIN tbl_subcategoria AS s
                                ON tpsc.cod_subcategoria = s.cod_subcategoria
                                INNER JOIN tbl_categoria AS c
                                ON tpsc.cod_categoria = c.cod_categoria
                                WHERE p.status = 'ativado' 
                                AND s.status = 'ativado'
                                AND c.status = 'ativado'".$filtro;
                            }

                            $produtos[] = (array) null;
                            $arrayProduto[] = (array) null;

                            $select = mysqli_query($conexao, $sql);

                            while($rsProdutoFiltrado = mysqli_fetch_array($select)){
                                $codProduto = $rsProdutoFiltrado['cod_produto'];
                                $nomeProduto = $rsProdutoFiltrado['nome'];
                                $descricaoProduto = $rsProdutoFiltrado['descricao'];

                                if($rsProdutoFiltrado['preco_desconto'] == null){
                                    $precoProduto = number_format($rsProdutoFiltrado['preco'], 2, ',', '.');
                                }else{
                                    $precoProduto = number_format($rsProdutoFiltrado['preco_desconto'], 2, ',', '.');
                                }

                                $statusProduto = $rsProdutoFiltrado['status'];
                                $statusPromocao = $rsProdutoFiltrado['status_promocao'];
                                $imagemProduto = $rsProdutoFiltrado['imagem'];
                     
                        ?>
                        <div class='produto'>
                            <figure>
                                <div class='produto-img center'>
                                    <img src='arquivos/<?= $imagemProduto ?>' class='img-div' alt='#' title='#'>
                                </div>
                            </figure>
                            <div class='nome-texts'>
                                <p class='produto-nome'><?= $nomeProduto ?></p>
                            </div>
                            <div class='descricao-texts'>
                                <p class='produto-descricao'>
                                <?= $descricaoProduto ?>
                                </p>
                            </div>
                            <div class='preco-texts'>
                                <p class='produto-preco'><?= $precoProduto ?></p>
                            </div>
                            <span class='detalhes visualizar' onclick="viewProduto(<?= $codProduto ?>)">Detalhes</span>
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