<?php

    /*require_once('modulo.php');
*/
    define('VAZIO', 'Selecione os dois números para a verificaçam de pares e ímpares!');
    define('MENORMAIOR', 'Não é possível realizar e verificação de pares e ímpares com o número inical maior ou igual ao número final!');
    $optionsInicial = '';
    $optionsFinal = '';
    $pares = (string) null;
    $impares = (string) null;
    $contPar = null;
    $contImpar = null;

    if(isset($_POST['btn_calcular'])){
        $numInicial = $_POST['slt_inicial'];
        $numFinal = $_POST['slt_final'];

        if($numInicial == '' || $numFinal == ''){
            echo(VAZIO);
        }else{
            if($numInicial >= $numFinal){
                echo(MENORMAIOR);
            }else{
                for($cont = $numInicial; $cont <= $numFinal; $cont++){
                    if($cont % 2 == 0){
                        $pares .= $cont.'<br>';
                        $contPar++;
                    }else{
                        $impares .= $cont.'<br>';
                        $contImpar++;
                    }
                }
            }
        }

    }
?>

<html>
    <head>
        <!-- <script>
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
        </script> -->
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <title>
            Par e Ímpar
        </title>
    </head>
    <body>
        <form name="frm_formulario" method="post" action="index.php">
            <div id="conteudo">
                <div id="texts">
                    <div id="titles">
                        <h3>Número Inicial:</h3>
                        <h3>Número Final:</h3>
                    </div>
                    <div id="selects">
                        <select name="slt_inicial" id="slt-inicial">
                            <option <?php echo(isset($_POST['slt_inicial'])? '' : 'selected'); ?> value='vazio'>Por favor selecione um número</option> 
                            <?php
                                for($cont = 0; $cont <= 500; $cont++){
                                    $optionsInicial .= "<option value='$cont'>$cont</option> ";
                                }
                                echo($optionsInicial);
                            ?>
                        </select>
                        <select name="slt_final" id="slt-final" value=<?php echo(isset($_POST['slt_final'])? $_POST['slt_final'] : ''); ?>>
                            <option <?php echo(isset($_POST['slt_inicial'])? '' : 'selected'); ?> value=''>Por favor selecione um número</option> 
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
                    </div>
                </div> 
                <div id="pares" style="float:left; width:200px; height:200px; border:solid 1px black;">
                    <p> <?php echo($pares); ?> </p>
                </div>
                <div id="impares" style="float:left; width:200px; height: 200px; border:solid 1px black;">
                    <p> <?php echo($impares); ?> </p>
                </div>
                <div id="total-pares" style="clear: both; float:left; width:200px; height:50px; border:solid 1px black;">
                    <p><?php echo($contPar); ?></p>
                </div>
                <div id="total-impares" style="float:left; width:200px; height:50px; border:solid 1px black;">
                    <p><?php echo($contImpar); ?></p>
                </div>
            </div>
        </form>
    </body>
</html>