<?php
    /* 
    *****metodos de inportação de arquivos
    include - 
    inclue_once - 
    require - 
    require_once - 
    */

    // Import do arquivo de funções
    require_once("modulo.php");

    $rdoSomar = "";
    $rdoSub = "";
    $rdoMulti = "";
    $rdoDiv = "";
    
    $valor1 = null;
    $valor2 = null;
    $operacao = null;

    /*
        gettype - identifica o tipo de dados da variavel
        settype - converte o tipo de dados de uma variavel
        var_dump - retorna caracteristicas da variavel
        trim - retira os espaços do inicio e do fim de um string
        strtoupper - converte a string em maiusculo
        strtolower - converte a string em minusculo
    */
    


        //↓Está modular
    // function calcular($v1, $v2, $opcao){
    //     global $rdoSomar;
    //     global $rdoSub;
    //     global $rdoMulti;
    //     global $rdoDiv;

    //     switch($opcao){
    //         case 'somar':
    //             $soma = $v1 + $v2;
    //             $result = "$v1+$v2 = ".$soma;
    //             break;

    //         case 'subtrair':
    //             $sub = $v1 - $v2;
    //             $result = "$v1-$v2 = ".$sub;
    //             break;

    //         case 'multiplicar':
    //             $mult = $v1 * $v2;
    //             $result = "$v1*$v2 = $mult";
    //             break;

    //         case 'dividir':
    //             if($v2 == 0)
    //                 echo("<font color='red' size='5'>".DIVZERO."</font>");
    //             else{
    //                 $div = round($v1/$v2, 2);
    //                 $result = "$v1 ÷ $v2 = ".$div;
    //             }
    //             break;

    //         default:
    //         // ↑ somente será interpretado quando nenhum dos 'case' for acionado
    //     }
    //     return isset($result) ? $result : "";
    // }

    
    if(isset($_POST['btn-limpar']))
        header('Location: /inf3t20191/kelvin/calculadora/index.php');

    if(isset($_POST['btn-calcular'])){
        if(isset($_POST['txt-valor1']) && isset($_POST['txt-valor2']) && isset($_POST['operacao']) && $_POST['txt-valor1'] != null && $_POST['txt-valor2'] != null){
            $valor1 = trim($_POST['txt-valor1']);
            $valor2 = trim($_POST['txt-valor2']);
            $operacao = trim($_POST['operacao']);

            if(!is_numeric($valor1) || !is_numeric($valor2)){
                echo("<span style='color:red'>".INVALIDO."</span>");
            }else{
                // Chamada para a função 'calcular()'
                $resultado = calcular($valor1, $valor2, $operacao);
            }
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
                                    <input type="radio" name="operacao" <?php echo($rdoSomar) ?> value="somar" id="op-somar">Somar
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="radio" name="operacao" <?php echo($rdoSub) ?>  value="subtrair" id="op-subtrair">Subtrair
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="radio" name="operacao" <?php echo($rdoMulti) ?>  value="multiplicar" id="op-multiplar">Multiplicar
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="radio" name="operacao" <?php echo($rdoDiv) ?>  value="dividir" id="op-dividir">Dividir
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