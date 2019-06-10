<?php

    require_once('bd/conexao.php');
    $conexao = conexaoMySql();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <title>EVENTOS</title>
        <meta charset="utf-8">
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
                <!-- AREA COM TITULO DA PAGINA -->
                <div id="titulo-pagina">
                    <h1>NOSSOS EVENTOS</h1>
                </div>
                <!-- AREA QUE SEGURA TODO CONTEUDO DA PAGINA -->
                <div id="conteudo-eventos">
                    <?php

                        $sql = "SELECT tabEvent.cod_evento, tabEvent.titulo_evento, tabEvent.host, 
                        tabEvent.entrada, tabEvent.descricao, tabEvent.data, tabEvent.imagem,
                        tabEvent.status, tabEvent.cod_endereco, 
                        tabAddress.logradouro, tabAddress.numero,
                        tabAddress.bairro, tabAddress.cep,
                        tabCity.cidade, tabCity.cod_cidade, 
                        tabState.estado, tabState.cod_estado, tabState.uf
                        FROM tbl_evento AS tabEvent
                        INNER JOIN tbl_endereco AS tabAddress
                        ON tabEvent.cod_endereco = tabAddress.cod_endereco
                        INNER JOIN tbl_cidade AS tabCity
                        ON tabAddress.cod_cidade = tabCity.cod_cidade
                        INNER JOIN tbl_estado AS tabState
                        ON tabCity.cod_estado = tabState.cod_estado
                        WHERE tabEvent.status = 'ativado'";

                        $select = mysqli_query($conexao, $sql);

                        while($rsEventos = mysqli_fetch_array($select)){
                            $titulo = $rsEventos['titulo_evento'];
                            $descricao = $rsEventos['descricao'];
                            $dataBanco = explode("-", $rsEventos['data']);
                            $data = $dataBanco[2]."/".$dataBanco[1]."/".$dataBanco[0];
                            $promotor = $rsEventos['host'];
                            $entrada = $rsEventos['entrada'];
                            $status = $rsEventos['status'];
                            $logradouro = $rsEventos['logradouro'];
                            $numero = $rsEventos['numero'];
                            $bairro = $rsEventos['bairro'];
                            $cep = $rsEventos['cep'];
                            $cidade = $rsEventos['cidade'];
                            $uf = $rsEventos['uf'];
                            $imagem = $rsEventos['imagem'];

                            $endereco = $logradouro." ".$numero.", ".$bairro.", ".$cidade." - ".$uf;


                    ?>
                    <!-- AREA ONDE FICAM AS INFORMAÇÕES SOBRE CADA EVENTO -->
                    <div class="container-evento">
                        <!-- AREA COM IMAGEM E TEXTO(TITULO E DESCRICAO) DO EVENTO-->
                        <div class="img-txt-evento">
                            <div class="img-evento flexbox">
                                <!-- IMAGEM DO EVENTO -->
                                <figure>
                                    <img class="img-src-evento" alt="Evento X" title="Evento X" src="arquivos/<?php echo(isset($imagem)? $imagem : 'naoDisponivel.jpg'); ?>">
                                </figure>
                            </div>
                            <div class="txt-evento">
                                <!-- TITTULO DO EVENTO -->
                                <div class="title-evento">
                                    <h2><?php echo(isset($titulo)? $titulo : ''); ?></h2>
                                </div>
                                <!-- AREAS COM INFORMAÇÕES CHAVE DO EVENTO -->
                                <div class="info-evento"> 
                                    
                                    <?php
                                        if(!empty($data)){
                                    ?>
                                    <!-- DATA DO EVENTO -->
                                    <div class="data-evento">
                                        <!-- ICONE DE DATA(CALENDARIO) -->
                                        <figure>
                                            <img class="img-evento-data" alt="Data/Hora" title="Data/Hora" src="imgs/date.png">
                                        </figure>
                                        <!-- AREA RETRÁTIL COM DATA DO EVENTO -->
                                        <div class="detalhes-data">
                                            <p><?php echo(isset($data)? $data : ''); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>

                                    <?php
                                         if(!empty($endereco)){
                                    ?>
                                    <!-- AREA COM LOCAL DO EVENTO -->
                                    <div class="local-evento">
                                        <!-- ICONE DE LOCAL(MARCADOR DE MAPA) -->
                                        <figure>
                                            <img class="img-evento-local" alt="Local" title="Local" src="imgs/localizacao2.png">
                                        </figure>
                                        <!-- AREA RETRÁTIL COM ENDERECO DO EVENTO -->
                                        <div class="detalhes-local">
                                            <p><?php echo($endereco); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                         }
                                    ?>

                                    <?php
                                        if(!empty($promotor)){
                                    ?>
                                    <!-- AREA COM NOME DO PROMOTOR DO EVENTO -->
                                    <div class="host-evento">
                                        <!-- ICONE DE HOST(LOJA, PROMOTOR DO EVENTO) -->
                                        <figure>
                                            <img class="img-evento-host" alt="Promotor do Evento" title="Promotor do Evento" src="imgs/host.png">
                                        </figure>
                                        <!-- AREA RETRÁTIL COM NOME DO PROMOTOR DO EVENTO -->
                                        <div class="detalhes-host">
                                            <p><?php echo($promotor); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                         }
                                    ?>

                                    <?php
                                        if(!empty($entrada)){
                                    ?>
                                    <!-- AREA COM INFORMAÇÕES DE ENTRADA DO EVENTO -->
                                    <div class="entrada-evento">
                                        <!-- ICONE DE ENTRADA(INGRESSO, TICKET) -->
                                        <figure>
                                            <img class="img-evento-entrada" alt="Entradas" title="Entradas" src="imgs/ticket.png">
                                        </figure>
                                        <!-- AREA RETRATIL COM PREÇO DAS ENTRADAS -->
                                        <div class="detalhes-entrada">
                                            <p><?php echo($entrada); ?><br>
                                                <a href="#">Compre Aqui</a>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                         }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- DESCRICAO DO EVENTO -->
                        <div class="descricao-evento">
                            <p>&nbsp;
                            <?php echo(isset($descricao)? nl2br($descricao) : ''); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <!-- IMPORTANDO FOOTER -->
            <?php 
                require_once('footer.html');
            ?>
        </div>
    </body>
</html>