<?php
    // Declaração de CONSTANTES
    define('DIVZERO', "<span style='font-size: 45px;'>Impossível realizar divisão por 0!</span>");
    define('VAZIO', "<span style='font-size: 45px;'>Preencha todos os campos para efetuar o cálculo desejado!</span>");
    define('INVALIDO', "<span style='font-size: 45px;'>Não é possível efetuar o cálculo com esse(s) caractér(es)</span>");

        function calcular($v1, $v2, $opcao) {
            
            global $verConta;
            
            switch($opcao){
                case 'somar':
                    $result = $v1+$v2;
                    $checkSoma = 'checked';
                    $verConta = $v1." + ".$v2." =";
                    break;

                case 'subtrair':
                    $result = $v1-$v2;
                    $checkSub = 'checked';
                    $verConta = $v1." - ".$v2." =";
                    break;

                case 'multiplicar':
                    $result = $v1*$v2;
                    $checkMulti = 'checked';
                    $verConta = $v1." x ".$v2." =";
                    break;

                case 'dividir':
                    if($v2 == 0)
                        $result = DIVZERO;
                    else{
                        $result = $v1/$v2;
                        $checkDiv = 'checked';
                        $verConta = $v1." ÷ ".$v2." =";
                    }
                    break;

                default:
                // ↑ somente será interpretado quando nenhum dos 'case' for acionado
            }
            return isset($result) ? $result : ""; 
        }

?>