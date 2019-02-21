<?php

    require_once('modulo.php');

    // define('VAZIO', 'Selecione os dois números para a verificaçam de pares e ímpares!');
    define('MENORMAIOR', 'Não é possível realizar e verificação de pares e ímpares com o número inical maior ou igual ao número final!');

    $optionsInicial = '';
    $optionsFinal = '';
    $pares = (string) null;
    $impares = (string) null;
    $contPar = null;
    $contImpar = null;
    $num = null;
    $erros = null;
    

    if(isset($_POST['btn_limpar'])){
        header('location: parImpar.php');
    }

    if(isset($_GET['btn_calcular'])){
        $numInicial = $_GET['slt_inicial'];
        $numFinal = $_GET['slt_final'];

        if($numInicial == '' || $numFinal == ''){
            $erros = "
                <div id='erros' class='center'>
                    <p>
                        <span id='title-erros'>ERROS</span><br><br>".VAZIO."
                    </p>
                </div>";
        }else{
            if($numInicial >= $numFinal){
                $erros = "
                    <div id='erros' class='center'>
                        <p>
                            <span id='title-erros'>ERROS</span><br>".MENORMAIOR."
                        </p>
                    </div>";
            }else{
                $num = parImpar($numInicial, $numFinal);
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" media="screen" type="text/css" href="css/style.css">
        <title>
            Par e Ímpar
        </title>
    </head>
    <body>
        <header class="center">
            <h1>PAR E ÍMPAR</h1>
        </header>
        <div id="conteudo" class="center">
            <div id="conteudo-esq">
                <nav id="menu" class="center">
                    <figure id="icon-menu">
                        <img id="img-menu" src="icons/iconMenu.png" alt="Ícone Menu" title="Ícone Menu"> 
                    </figure>
                    <ul id="caixa-menu" class="center">
                        <li class="item-menu">
                            <a  href="tabuada.php">TABUADA</a>
                        </li>
                        <li class="item-menu">
                            <a  href="parImpar.php">PAR E ÍMPAR</a>
                        </li>
                        <li class="item-menu">
                            <a  href="media.php">MÉDIA</a>
                        </li>
                        <li class="item-menu" id="calc">
                            <span>CALCULADORA</span>
                            <ul id="menu-calc" class="center">
                                <li>
                            <a  href="calculadoraIf.php">If</a>
                                </li>
                                <li>
                            <a  href="calculadoraSwitch.php">Switch</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id='caixa-erros' class='center'>
                    <?php echo($erros); ?>
                </div>
                <div id="home" class="center">
                    <figure>
                        <a href="index.php"><img src="icons/home.png" id="icone-home" alt="Ícone Home" title="Ícone Home"></a>
                    </figure>
                </div>
            </div>
            <div id="conteudo-dir">
                <form name="frm_formulario" method="get" action="parImpar.php">
                    <div id="conteudo-parImpar">
                        <div id="texts-parImpar">
                            <div id="titles-parImpar">
                                <h3>Número Inicial:</h3>
                                <h3>Número Final:</h3>
                            </div>
                            <div id="selects">
                                <select name="slt_inicial" id="slt-inicial">
                                    <option selected value=''>Por favor selecione um número</option> 
                                    <?php
                                        for($cont = 0; $cont <= 500; $cont++){
                                            $optionsInicial .= "<option value='$cont'>$cont</option> ";
                                        }
                                        echo($optionsInicial);
                                    ?>
                                </select>
                                <select name="slt_final" id="slt-final">
                                    <option selected value=''>Por favor selecione um número</option> 
                                    <?php
                                        for($cont = 100; $cont <= 1000; $cont++){
                                            $optionsFinal .= "<option value='$cont'>$cont</option> ";
                                        }
                                        echo($optionsFinal);
                                    ?>
                                </select>
                            </div>
                            <div id="button">
                                <input type="submit" value="CALCULAR" name="btn_calcular" id="btn-calcular">
                                <input id="btn-limpar" type="submit" name="btn_limpar" value="LIMPAR">
                            </div>
                        </div> 
                        <div id="pares">
                            <p> <?php echo($num['pares']); ?> </p>
                        </div>
                        <div id="impares">
                            <p> <?php echo($num['impares']); ?> </p>
                        </div>
                        <div id="total-pares">
                            <p><?php echo($contPar != null ? $contPar.' Números' : ""); ?> </p>
                        </div>
                        <div id="total-impares">
                            <p><?php echo($contImpar != null ? $contImpar.' Números' : ""); ?> </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer class="center">
            <!-- <h1>NADA</h1> -->
        </footer>
    </body>
</html>