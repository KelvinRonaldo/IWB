<?php
    /*
        gettype - identifica o tipo de dados da variavel
        settype - converte o tipo de dados de uma variavel
        var_dump - retorna caracteristicas da variavel
        trim - retira os espaços do inicio e do fim de um string
        strtoupper - converte a string em maiusculo
        strtolower - converte a string em minusculo
    */
    
    //Declaração de CONSTANTES
    define("ERRO", "Erro no calculo!");
    define("INVALIDO", "Caractér Inválido para efetuar o cálculo!");
    define("VAZIO", "Preencha todas as caixas para efetuar o cálculo");
    $valor1 = null;
    $valor2 = null;
    $operacao = null;

    if(isset($_POST['btn-limpar']))
        header('Location: /inf3t20191/marlonSantos/calculadora/index.php');

    if(isset($_POST['btn-calcular'])){
        if(isset($_POST['txt-valor1']) && isset($_POST['txt-valor2']) && isset($_POST['operacao']) && $_POST['txt-valor1'] != null && $_POST['txt-valor2'] != null){
            $valor1 = trim($_POST['txt-valor1']);
            $valor2 = trim($_POST['txt-valor2']);
            $operacao = trim($_POST['operacao']);

            if(!is_numeric($valor1) || !is_numeric($valor2)){
                echo("<span style='color:red'>".INVALIDO."</span>");
            }else{
                if($operacao == 'somar'){
                    $soma = $valor1 + $valor2;
                    $resultado = "$valor1+$valor2 = ".$soma;
                }
                if($operacao == 'subtrair'){
                    $sub = $valor1 - $valor2;
                    $resultado = "$valor1-$valor2 = ".$sub;
                }
                if($operacao == 'multiplicar'){
                    $mult = $valor1 * $valor2;
                    $resultado = "$valor1*$valor2 = ".$mult;
                }
                if($operacao == 'dividir'){
                    if($valor2 == 0)
                        echo("<font color='red' size='5'>Erro!</font>");
                    else{
                        $div = round($valor1/$valor2, 2);
                        $resultado = "$valor1 ÷ $valor2 = ".$div;
                    }
                }
            }
            $valor1 = null;
            $valor2 = null;
        }else{
            echo("<font color='red' size='5'>".VAZIO."</font>");
        }
    }
?>
<html>
    <head>
        <title>
            Calculadora Simples PHP
        </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
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
    </head>
    <body>
        <div id="caixa-conteudo" class="center">
            <div id="card-titulo">
                Calculadora Simples
            </div>
            <form action="index.php" name="frm-calculadora" method="post">
                <div id="card-conteudo">
                    <div id="card-esquerdo">
                        <table id="table-esquerda">
                            <tr>
                                <td>Valor 1:</td>
                                <td><input onkeypress="return validar(event);" type="text" name="txt-valor1" value="<?php echo($valor1) ?>" id="txt-valor1"></td>
                            </tr>
                            <tr>
                                <td>Valor 2:</td>
                                <td><input onkeypress="return validar(event);" type="text" name="txt-valor2" value="<?php echo($valor2) ?>"id="txt-valor2"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="radio" name="operacao" <?php echo($operacao==1 ? "checked" : "") ?> value="1" id="op-somar">Somar
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="radio" name="operacao" <?php echo($operacao==2 ? "checked" : "") ?>  value="2" id="op-subtrair">Subtrair
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="radio" name="operacao" <?php echo($operacao==3 ? "checked" : "") ?>  value="3" id="op-multiplar">Multiplicar
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="radio" name="operacao" <?php echo($operacao==4 ? "checked" : "") ?>  value="4" id="op-dividir">Dividir
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="btn-calcular" value="Calcular">
                                </td>
                                <td>
                                    <form action="calculadora.php" method="post" name="frm-limpar">
                                        <input type="submit" name="btn-limpar" value="Limpar">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="card-direito">
                        <div id="caixa-resultado">
                            <div id="titulo-resultado">
                                Resultado
                            </div>
                            <div id="conteudo-resultado">
                                <?php echo(isset($resultado) ? $resultado : "") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>