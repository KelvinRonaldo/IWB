<?php

    //Declaração de CONSTANTES
    define("ERRO", "Erro no calculo!");
    define("INVALIDO", "Caractér Inválido para efetuar o cálculo!");
    define("VAZIO", "Preencha todas as caixas para efetuar o cálculo");
    define("DIVZERO", "Não é possível realizar divisões por 0!");

    function calcular($v1, $v2, $opcao){
        //↓ permite deixar uma variávelç visível fora da function
        global $rdoSomar;
        global $rdoSub;
        global $rdoMulti;
        global $rdoDiv;

        switch($opcao){
            case 'somar':
                $soma = $v1 + $v2;
                $result = "$v1+$v2 = ".$soma;
                $rdoSomar = 'checked';
                break;

            case 'subtrair':
                $sub = $v1 - $v2;
                $result = "$v1-$v2 = ".$sub;
                $rdoSub = 'checked';
                break;

            case 'multiplicar':
                $mult = $v1 * $v2;
                $result = "$v1*$v2 = $mult";
                $rdoMulti = 'checked';
                break;

            case 'dividir':
                if($v2 == 0)
                    echo("<font color='red' size='5'>".DIVZERO."</font>");
                else{
                    $div = round($v1/$v2, 2);
                    $result = "$v1 ÷ $v2 = ".$div;
                    $rdoDiv = 'checked';
                }
                break;

            default:
            // ↑ somente será interpretado quando nenhum dos 'case' for acionado
        }
        return isset($result) ? $result : "";
    }
?>