<?php
    require_once('modulo.php');

    $valor1 = null;
    $valor2 = null;
    $resultado = null;
    $operacao = (string) "";
    $verConta = (string) "";
    $erros = null;

    if(isset($_POST['btn_limpar'])){
        header('location: calculadoraIf.php');
    }

    if(isset($_POST['btn_calcular'])){
        
        $valor1 = $_POST['txt_valor1'];
        $valor2 = $_POST['txt_valor2'];

        if((!isset($_POST['txt_valor1']) || !isset($_POST['txt_valor2']) || !isset($_POST['rdo_operacao'])) || $valor1 == null || $valor2 == null) {
            $erros = "
                <div id='erros' class='center'>
                    <p>
                        <span id='title-erros'>ERROS</span><br><br>".VAZIO."
                    </p>
                </div>";
        }
        else{    
            if(!is_numeric($valor1) || !is_numeric($valor2)) {
                $erros = "
                    <div id='erros' class='center'>
                        <p>
                            <span id='title-erros'>ERROS</span><br><br>".INVALIDO."
                        </p>
                    </div>";
            }else{        
                $operacao = $_POST['rdo_operacao'];
                $resultado = calculadoraIf($valor1, $valor2, $operacao);
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" media="screen" type="text/css" href="css/style.css">
        <script>
            const validar = (caracter) =>{
                /* Verifica em qual padrão de navegador o caractér está sendo enviado
                se for pelo padrão 'event' então utilizamos 'charCode', caso contrátio, utilizamos 'which1' */
                if(window.event)
                    // Tranforma o caracter em ASCII
                    var letra = caracter.charCode;
                else
                    // Tranforma o caracter em ASCII
                    var letra = caracter.which
                //Verifica se o ASCII do caracter digitado esta entrew 48 e 57, que corresponde aos numeros de 0 até 9
                if(letra < 48 || letra > 57){
                    if(letra != 46 && letra != 44)
                    //FV
                    // Cancelando o evento 'keypress', ou seja, não deixa a tecla ir para a caixa
                    return false;
                    
                }
            }
        </script>
        <title>
            Calculadora com If
        </title>
    </head>
    <body>
        <header class="center">
            <h1>CALCULADORA COM 'IF'</h1>
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
                <form name="frm-calculator" method="post" action="">
                    <div id="conteudo-calcIf">
                        <div id="texts-calcIf">
                            <div id="titles-calcIf">
                                <h3>1º Valor:</h3>
                                <h3>2º Valor:</h3>
                            </div>
                            <div id="selects">
                                <input onkeypress="return validar(event);" type="text" id="txt-valor1" name="txt_valor1" value="<?php echo($valor1) ?>">
                                <input onkeypress="return validar(event);" type="text" id="txt-valor2" name="txt_valor2" value="<?php echo($valor2) ?>">    
                            </div>
                            <div id="button">
                                <input id="btn-calcular" type="submit" name="btn_calcular" value="CALCULAR">
                                <input id="btn-limpar" type="submit" name="btn_limpar" value="LIMPAR">
                            </div>
                        </div> 
                        <div id="radios">
                            <input type="radio" class="radios" name="rdo_operacao" <?php echo($operacao =='somar' ? "checked" : ""); ?> value="somar"><span class="title-radio">Somar</span><br>
                            <input type="radio" class="radios" name="rdo_operacao" <?php echo($operacao =='subtrair' ? "checked" : ""); ?> value="subtrair"><span class="title-radio">Subtrair</span><br>
                            <input type="radio" class="radios" name="rdo_operacao" <?php echo($operacao =='multiplicar' ? "checked" : ""); ?> value="multiplicar"><span class="title-radio">Multiplicar</span><br>
                            <input type="radio" class="radios" name="rdo_operacao" <?php echo($operacao =='dividir' ? "checked" : ""); ?> value="dividir"><span class="title-radio">Dividir</span>
                        </div>
                        <div id="resultado-calcIf">
                            <div id="right-box">
                                <p id="operacao"><?php echo($valor1 == 0 || $valor2 == 0 ? '' : strtoupper($operacao)); ?></p>
                                <p id="conta"><?php echo($resultado['conta']); ?>
                                </p>
                                <p id="txt-result"><?php echo($resultado['calculo']); ?></p>
                            </div>
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