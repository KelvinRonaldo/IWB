<?php

    // IMAGEM DA NOTICIA GERAL NÃO ESTA VINDO PARA ESSA PÁGINA

    $tituloNvl1 = null;
    $tituloNvl2 = null;
    $tituloNvl3 = null;
    $resumoNvl1 = null;
    $resumoNvl2 = null;
    $resumoNvl3 = null;
    $imgNvl1 = null;
    $imgNvl2 = null;
    $imgNvl3 = null;
    $titutoIndisponivel = "INDISPONIVEL";
    $resumoIndisponivel = "Essa noticia principal não esta disponivel no momento";
    $imgIndisponivel = "naoDisponivel.jpg";


    require_once('bd/conexao.php');
    $conexao = conexaoMySql();

    $sql = "SELECT * FROM tbl_noticia_principal";
    $select = mysqli_query($conexao, $sql);

    while($rsNoticia = mysqli_fetch_array($select)){
        

        if($rsNoticia['cod_destaque'] == '1' && $rsNoticia['status'] == 'ativado'){
            $tituloNvl1 = $rsNoticia['titulo_noticia'];
            $resumoNvl1 = $rsNoticia['resumo'];
            $imgNvl1 = $rsNoticia['imagem'];
        }
        
        if($rsNoticia['cod_destaque'] == '2' && $rsNoticia['status'] == 'ativado'){
            $tituloNvl2= $rsNoticia['titulo_noticia'];
            $resumoNvl2 = $rsNoticia['resumo'];       
            $imgNvl2 = $rsNoticia['imagem'];                     
        }
        
        if($rsNoticia['cod_destaque'] == '3' && $rsNoticia['status'] == 'ativado'){
            $tituloNvl3 = $rsNoticia['titulo_noticia'];
            $resumoNvl3 = $rsNoticia['resumo'];               
            $imgNvl3 = $rsNoticia['imagem'];
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <title>NOTÍCIAS</title>
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <!-- AREA QUE SEGURADO TODA A PAGINA-->
        <div id="pagina">
            <!-- IMPORTANDO HEADER DA PAGINA-->
            <?php 
                require_once('header.html');
            ?>
            <!-- AREA ONDE ESTÁ TODA ESTRUTURA DO SITE, EXCETO HEADER E FOOTER-->
            <div id="tudo" class="center">
                <!-- AREA COM TITULO DA PAGINA -->
                <div id="titulo-pagina">
                    <h1>NOTÍCIAS EM DESTAQUE</h1>
                </div>
                <!-- AREA ONDE ESTÃO AS NOTICIAS PRINCIPAIS-->
                <article id="noticias-principais">
                    <!-- AREA DAS REDES SOCIAIS -->
                    <div id="redes-sociais-noticias">
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

                    <!-- NOTICIAS PRINCIPAIS A ESQUERDA-->
                    <div id="principais-esq">
                        <!-- AREA DA PRIMEIRA NOTICIA PRINCIPAL -->
                        <div id="noticia-principal1">
                            <div id="conteudo-principal1" style="background-image: url(./arquivos/<?php echo($imgNvl1 == null ? $imgIndisponivel : $imgNvl1); ?>);">
                                <div id="texto-principal1">
                                    <h2><?php echo($tituloNvl1 == "" ? $titutoIndisponivel : $tituloNvl1); ?></h2>
                                    <p>
                                        <?php echo($resumoNvl1 == "" ? $resumoIndisponivel : $resumoNvl1); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- NOTICIAS PRINCIPAIS A DIREITA -->
                    <div id="principais-dir">
                        <!-- AREA DA SEGUNDA NOTICIA PRINCIPAL-->
                        <div id="noticia-principal2">
                            <div id="conteudo-principal2" style="background-image: url(./arquivos/<?php echo($imgNvl2 == null ? $imgIndisponivel : $imgNvl2); ?>);">
                                <div id="texto-principal2">
                                    <h2><?php echo($tituloNvl2 == "" ? $titutoIndisponivel : $tituloNvl2); ?></h2>
                                    <p>
                                        <?php echo($resumoNvl2 == "" ? $resumoIndisponivel : $resumoNvl2); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- AREA DA TERCEIRA NOTICIA PRINCIPAL-->
                        <div id="noticia-principal3">
                            <div id="conteudo-principal3" style="background-image: url(./arquivos/<?php echo($imgNvl3 == null ? $imgIndisponivel : $imgNvl3); ?>);">
                                <div id="texto-principal3">
                                    <h2><?php echo($tituloNvl3 == "" ? $titutoIndisponivel : $tituloNvl3); ?></h2>
                                    <p>
                                        <?php echo($resumoNvl3 == "" ? $resumoIndisponivel : $resumoNvl3); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- AREA DO DO CONTEUDO  DA PAGINA-->
                <div id="conteudo">
                    <!-- NOTICIAS A ESQUERDA DO SITE -->
                    <article id="noticias-esq">
                        <?php
                            $sql = "SELECT * FROM tbl_noticia WHERE status = 'ativado'";
                            $select = mysqli_query($conexao, $sql);

                            while($rsNoticia = mysqli_fetch_array($select)){
                                $tituloNoticia = $rsNoticia['titulo_noticia'];
                                $resumo = $rsNoticia['resumo'];
                                $autor = $rsNoticia['autor'];
                                $imagem = $rsNoticia['imagem'];
                            
                                $dataDb = explode("-", $rsNoticia['data']);
                                $data = $dataDb[2]."/".$dataDb[1]."/".$dataDb[0];
                        ?>
                        <!-- AREA QUE SEGURA AS INFORMAÇÕES DA NOTICIA-->
                        <div class="container-noticias">
                            <!-- IMAGEM RELACIONADA A NOTICIA -->
                            <div class="img-noticias" style="background-image: url(./arquivos/<?php echo($imagem); ?>);">                            
                            </div>
                            <div class="txt-noticias">
                                <!-- NOME DO AUTO E DATA DA NOTICIA -->
                                <div class="noticias-autor-data">
                                    <h3><?php echo($autor." - ".$data); ?></h3>
                                </div>
                                <!-- TITULO DA NOTICIA -->
                                <div class="titulo-noticias">
                                    <a href="#">
                                        <h2><?php echo($tituloNoticia); ?></h2>
                                    </a>
                                </div>
                                <!-- PEQUENO TEXTO QUE RESUME A NOTICIA-->
                                <div class="resumo-noticias">
                                    <p> <?php echo($resumo); ?> </p>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </article>
                    <!-- AREA A ESQUERDA ONDE FICAM AS NOTICIAS MAIS RECENTES DO SITE-->
                    <div id="noticias-dir">
                        <div id="topo-recentes">
                            <h2>MAIS RECENTES</h2>
                        </div>
                        <div class="mais-recentes">           
                            <!-- LISTA DE NOTICIAS MASI RECENTES  -->       
                            <ul>
                                <?php
                                    $sqlRecentes = "SELECT titulo_noticia FROM tbl_noticia
                                    WHERE status = 'ativado' ORDER BY cod_noticia DESC LIMIT 10";
                                    $selectRecentes = mysqli_query($conexao, $sqlRecentes);

                                    while($rsNoticiaRecentes = mysqli_fetch_array($selectRecentes)){
                                        $tituloNoticiaRecentes = $rsNoticiaRecentes['titulo_noticia'];
                                ?>
                                <li class="item-recentes">
                                    <a href="#">
                                        <?= $tituloNoticiaRecentes ?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
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