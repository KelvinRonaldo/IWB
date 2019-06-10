<?php

    require_once('bd/conexao.php');    
    $conexao = conexaoMySql();

    $local = null;
    if(isset($_GET['local'])){
        $local = $_GET['local'];
    }else{
        $local = '-23.584875,-46.680168';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <title>NOSSAS LOJAS</title>
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
                    <h1>NOSSAS LOJAS</h1>
                </div>

                <!-- AREA DO MAPA DA LOJA ACESSADA -->
                <div id="map">
                    <iframe id='iframe-mapa' src='https://maps.google.com/maps?width=1300&amp;height=501&amp;hl=en&amp;q=<?php echo($local);?>&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=B&amp;output=embed'></iframe>                       
                </div>

                <!-- AREA QUE SEGURA TODO CONTEUDO DA PAGINA -->
                <div id="conteudo-lojas">

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

                    <?php

                        $sql = "SELECT l.cod_loja, l.status, e.logradouro, e.numero, e.bairro, e.cep, cd.cidade, et.uf
                        FROM tbl_loja AS l INNER JOIN tbl_endereco AS e ON l.cod_endereco = e.cod_endereco
                        INNER JOIN tbl_cidade AS cd ON e.cod_cidade = cd.cod_cidade
                        INNER JOIN tbl_estado AS et ON cd.cod_estado = et.cod_estado
                        WHERE l.status = 'ativado'";

                        $select = mysqli_query($conexao, $sql);

                        while($rsLojas = mysqli_fetch_array($select)){
                            $link = (string) null;

                            $logradouro = $rsLojas['logradouro'];
                            $numero = $rsLojas['numero'];
                            $bairro = $rsLojas['bairro'];
                            $cidade = $rsLojas['cidade'];
                            $uf = $rsLojas['uf'];
                            $cep = $rsLojas['cep'];
                            
                            $cidade = strtolower($cidade);
                            $cidade = ucwords($cidade);

                            $endereco = $logradouro.$numero.$bairro.$cidade.$uf;
                            $endereco = explode(" ", $endereco);
                            for($cont = 0; $cont < count($endereco); $cont++){
                                $link .= $endereco[$cont];
                            }

                    ?>
                    <!-- AREA/LINK COM O ENDEREÇO DE UMA DAS LOJAS -->
                    <a class="localizacao-loja" href="?local=<?php echo $link;?>">
                        <div class="local-loja center">
                            <!-- ENDEREÇO DA LOJA -->
                            <div class="endereco-loja">
                                <p><?php echo("<span class='negrito'>".$logradouro."</span> ".$numero.", ".$bairro.", ".$cidade." - <span class='negrito'>".$uf."</span>"); ?></p>
                            </div>
                            <!-- ICONE DE LOCAL -->
                            <div class="local-icon">
                                <figure>
                                    <img class="local-img" alt="Icone Local" src="imgs/local.png">
                                </figure>
                            </div>
                        </div>
                    </a>

                    <?php
                        }
                    ?>
                </div>
            </div>
            <!-- IMPORTANDO FOOTER DA PAGINA -->
            <?php 
                require_once('footer.html');
            ?>
        </div>
    </body>
</html>