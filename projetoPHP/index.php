<?php
    require_once("bd/conexao.php");
    $conexao = conexaoMySql();

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