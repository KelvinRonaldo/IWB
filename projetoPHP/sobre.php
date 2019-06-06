<?php

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('./bd/conexao.php');
    $conexao = conexaoMySql();

    $sql = "SELECT * FROM tbl_sobre WHERE status = 'ativado'";

    $select = mysqli_query($conexao, $sql);

    if($rsSobre = mysqli_fetch_array($select)){
        $titulo = $rsSobre['titulo_sobre'];
        $imagem = $rsSobre['imagem'];
        $texto = $rsSobre['sobre'];
        $assinatura = $rsSobre['assinatura'];
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <title>SOBRE</title>
        <meta charset="utf-8">
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <!-- DIV QUE SEGURADO TODA A PAGINA -->
        <div id="pagina">
            <?php
                require_once('header.html');
            ?>
            <!-- AREA ONDE ESTÁ TODA ESTRUTURA DO SITE, EXCETO HEADER E FOOTER -->
            <div id="tudo" class="center">
                <!-- AREA COM TITULO DA PAGINA -->
                <div id="titulo-pagina">
                    <h1><?php echo(!empty($titulo) ? $titulo : 'Não Disponível'); ?></h1>
                </div>
                <div id="conteudo-sobre">
                    <!-- AREA QUE CONTEM IMAGEM DA LOJA E TEXTO INFORMATIVO -->
                    <div id="container-sobre">
                        <div id="img-sobre" class="flexbox">
                            <!-- IMAGEM DA LOJA -->
                            <figure>
                                <img alt="Bicicletas" id="img-src-sobre" src="./arquivos/<?php echo(!empty($imagem) ? $imagem : 'naoDisponivel.jpg'); ?>">
                            </figure>
                        </div>
                        <!-- TEXTO SOBRE A LOJA -->
                        <?php
                            if(!empty($texto)){
                        ?>
                        <div id="txt-sobre">
                            <?php echo nl2br($texto); ?>
<!--                            <p>-->
<!--                                A Road Runner Cross Bikes SA é uma loja de bicicletas, peças e acessórios especializada em bikes de passeio, mountain bike Cross Country, freeride e downhill.-->
<!--                            </p>-->
<!--                            <p>-->
<!--                                Fundada em 2004, conquistou nestes mais de 10 anos de atuação uma reputação de confiança e comprometimento com o cliente,trabalhando com marcas de alta qualidade que proporcionam aos ciclistas de passeio e de performance uma melhor experiência com suas bicicletas, para qualquer que seja o terreno.-->
<!--                            </p>-->
<!--                            <p>-->
<!--                                A Road Runner Cross Bikes SA também dispõe de oficina especializada, com mecânicos treinados e experientes em diversas modalidades do ciclismo, oferecendo assim toda gama de serviços de manutenção de bicicletas e seus componentes.-->
<!--                            </p>-->
<!--                            <p>-->
<!--                                Em 2014, a gestão da Road Runner Cross Bikes SA mudou. Assumiram dois novos (‘velhos’) apaixonados por bikes (desde sempre), ampliando ainda mais a relação da Road Runner Cross Bikes SA com propósito de uso da bike para melhorar a sensação de bem estar e qualidade de vida, seja pelo simples fato de se locomover com a bike, quanto pela prática das modalidades mais intensas do ciclismo.-->
<!--                            </p>-->
<!--                            <p>-->
<!--                                “Somos loucos por bikes e esperamos transmitir nossa paixão através do que fazemos.”-->
<!--                            </p>-->
                            <?php
                                if(!empty($assinatura)){
                            ?>
                            <p id="assinatura">
                                <?php echo $assinatura; ?>
                            </p>
                            <?php
                                }
                            ?>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- IMPORTANDO O FOOTER -->
            <?php 
                require_once('footer.html');
            ?>
        </div>
    </body>
</html>