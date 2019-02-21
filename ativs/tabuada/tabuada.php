<?php

    require_once('modulo.php');

    define('VAZIO', 'Preenchas os campos para visualizar a tabuada!');

    if(isset($_POST['btn_calcular'])){
        $tabuada = $_POST['txt_tabuada'];
        $contador = $_POST['txt_contador'];
        $resultados = (string) null;

        if((isset($_POST['txt_tabuada']) && isset($_POST['txt_contador'])) && $tabuada != null && $contador != null){
            $resultados = tabuada($tabuada, $contador);
        }else{
            $resultados = VAZIO;
        }

    }
    // echo($resultados);
?>

<html>
    <head>
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
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <title>
            TABUADA
        </title>
    </head>
    <body>
        <form name="frm_formulario" method="post" action="index.php">
            <div id="conteudo">
                <div id="texts">
                    <div id="titles">
                        <h3>Tabuada:</h3>
                        <h3>Contador:</h3>
                    </div>
                    <div id="inputs">
                        <input onkeypress="return validar(event);" name="txt_tabuada" id="txt-tabuada">
                        <input onkeypress="return validar(event);" name="txt_contador" id="txt-contador">
                    </div>
                    <div id="button">
                        <input type="submit" value="CALCULAR" name="btn_calcular" id="btn-calcular">
                    </div>
                </div> 
                <div id="resultados" style="width:250px; height: 200px; border:solid 1px black;">
                    <p><?php echo($resultados); ?></p>
                </div>
            </div>
        </form>
    </body>
</html>