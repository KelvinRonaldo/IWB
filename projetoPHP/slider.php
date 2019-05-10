<?php
    // DECLARAÇÃO DE VARIÁVEIS
    $imagensSlider = (array) null;  // ARRAY ONDE ESTÃO AS IMAGENS DO SLIDER VINDAS DO DIRETORIO 
    $numImgs = (int) null;  // VARIÁVEL QUE VAI GUARDAR O NUMERO DE DE IMAGENS CONTIDAS NO ARRAY
    $loadingImage = null;   // VARIAVEL ONDE FICARA O INDICE DO SVG DE LOADING QUE SERA EXCLUIDO

    $caminho = "./imgs_slider"; // VARIAVEL QUE GUARDA O CAMINHO DO DIRETORIO ONDE ESTÃO GUARDADADAS AS IMAGENS DO LIDER
    $diretorio = dir($caminho); // VARIAVEL QUE GUARDA A EXECUÇÃO DO COMANDO DIR NO CAMINHO ESPECIFICADO NA VARIAVEL DO CAMINHO
    
    while($arquivo = $diretorio -> read()){ // A CADA RODADA DO WHILE, A $arquivo RECEBE UM ITEM OBTIDO SEQUENCIALMENTE DA EXECUÇÃO DO COMANDO dir() NO DIRETORIO
        // $numDir++;
        array_push($imagensSlider, $arquivo); // POPULA O UM ARRAY COM OS ITEM OBTIDOS DO DIRETORIO
    };

    $loadingImage = array_search("spin.svg", $imagensSlider); //ACHA O INDICE ONDE ESTA A IMAGEM DE LOADING DO SLIDER
    unset($imagensSlider[$loadingImage]);   // EXCLUI DO ARRAY O INDICE DO LOADING DO ARRAY
    $imagensSlider = array_slice($imagensSlider, 2);    // FAZ COM QUE O ARRAY TENHA APENAS OS ITENS A SEREM USADOS E COMANDOS DE DIRETORIO(./ E ../)
    $numImgs = count($imagensSlider);   // CONTA O NUMERO DE INDICE DO ARRAY QUE CONTEM AS IMAGENS

    $diretorio -> close();  // FECHA O DIRETORIO
?>

    <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Maker -->
    <!-- Source: https://www.jssor.com -->
    <div id="jssor_1" style="position:relative;margin-top:-20px;top:0px;left:0px;width:1290px;height:600px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img alt="loading" style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="imgs_slider/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1290px;height:500px;overflow:hidden;">
            <?php
                // ADICIONA AS IMAGENS AO SLIDER AUTOMATICAMENTE
                for($cont = 0; $cont < $numImgs; $cont++){            
            ?>
            <div>
                <img alt="Slider Image <?php echo($cont+1); ?>" data-u="image" src="imgs_slider/<?php echo($imagensSlider[$cont]) //ASSOCIA SEQUENCIALMENTE A PARTIR DO for() A IMAGEM DA TAG <img> DAS IMAGENS DO SLIDER?>" />
                <div data-u="thumb">
                    <img alt="Slider Thumb <?php echo($cont+1); ?>" data-u="thumb" src="imgs_slider/<?php echo($imagensSlider[$cont]) //ASSOCIA SEQUENCIALMENTE A PARTIR DO for() A IMAGEM DA TAG <img> DAS THUMBS DO SLIDER ?>" />
                    <div class="ti">Bicicleta <?php echo($cont+1); ?></div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort111" style="position:absolute;left:0px;bottom:0px;width:1300px;height:100px;cursor:default;" data-autocenter="1" data-scale-bottom="0.75">
            <div data-u="slides">
                <div data-u="prototype" class="p">
                    <div data-u="thumbnailtemplate" class="t"></div>
                </div>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:162px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:162px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
    </div>
    <script>jssor_1_slider_init();</script>