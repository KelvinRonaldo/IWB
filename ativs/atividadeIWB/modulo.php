<?php

    define('VAZIO', 'Preenchas os campos para efetuar o(s) cálculo(s)!');
    define('INVALIDO', "Não é possível efetuar o cálculo com esse(s) caractér(es)");
    define('DIVZERO', "Impossível realizar divisão por 0 !");

    function tabuada($tab, $conta){
        //↓ ???????????????????
       $result = (string) "";

        for($cont = 1; $cont <= $conta; $cont++){
            $result .= $tab . ' x ' . $cont . ' = '  . $tab*$cont . '<br>';
        }
        return $result;
    }
    
    function parImpar($inicial, $final){

        $pares = null;
        $impares = null;
        global $contPar;
        global $contImpar;
        
        for($cont = $inicial; $cont <= $final; $cont++){
            if($cont % 2 == 0){
                $pares .= $cont.'<br>';
                $contPar++;
            }else{
                $impares .= $cont.'<br>';
                $contImpar++;
            }
        }
        $paresImpares = array(
            'pares' => $pares,
            'impares' => $impares
        );
        return $paresImpares;
    }


    function media($n1, $n2, $n3, $n4){

        $media=($n1+$n2+$n3+$n4)/4;
        
        if($media >= 7){
            $situacao = "<span class='aprovado'>Aprovado</span>";
        }else{
            $situacao = "<span class='reprovado'>Reprovado</span>";
        }
        if($media == null){
            $situacao = "";
        }
        $situacaoMedia = array(
            'media' => $media,
            'situacao' => $situacao
        );
        return $situacaoMedia;
    }

    function calculadoraIf($v1, $v2, $opcao){

        $conta = null;
        $calculo = null;
        global $checkSoma;
        global $checkSub;
        global $checkMulti;
        global $checkDiv;
        global $erros;

        if($opcao == 'somar'){
            $calculo = $v1+$v2;
            $checkSoma = 'checked';
            $conta = $v1." + ".$v2." =";
        }
        elseif($opcao == 'subtrair'){
            $calculo = $v1-$v2;
            $checkSub = 'checked';
            $conta = $v1." - ".$v2." =";
        }
        elseif($opcao == 'multiplicar'){
            $calculo = round($v1*$v2);
            $checkMulti = 'checked';
            $conta = $v1." x ".$v2." =";
        }
        elseif($opcao == 'dividir'){
            if($v2 == 0){
                $erros = "
                    <div id='erros' class='center'>
                        <p>
                            <span id='title-erros'>ERROS</span><br><br>".DIVZERO."
                        </p>
                    </div>";
                $checkDiv = 'checked';
                }   
            else{
                $calculo = round($v1/$v2);
                $checkDiv = 'checked';
                $conta = $v1." ÷ ".$v2." =";
            }
        }
        
        $result = array(
            'calculo' => $calculo,
            'conta' => $conta
        );

        return $result;
    }

    function calculadoraSwitch($v1, $v2, $opcao){
        
        $conta = null;
        $calculo = null;
        global $checkSoma;
        global $checkSub;
        global $checkMulti;
        global $checkDiv;
        global $erros;

        switch($opcao){
            case 'somar':
                $calculo = $v1+$v2;
                $checkSoma = 'checked';
                $conta = $v1." + ".$v2."=";
                break;

            case 'subtrair':
                $calculo = $v1-$v2;
                $checkSub = 'checked';
                $conta = $v1." - ".$v2."=";
                break;

            case 'multiplicar':
                $calculo = round($v1*$v2);
                $checkMulti = 'checked';
                $conta = $v1." x ".$v2."=";
                break;

            case 'dividir':
                if($v2 == 0){
                    $erros = "
                        <div id='erros' class='center'>
                            <p>
                                <span id='title-erros'>ERROS</span><br><br>".DIVZERO."
                            </p>
                        </div>";
                }else{
                    $calculo = round($v1/$v2, 2);
                    $checkDiv = 'checked';
                    $conta = $v1." ÷ ".$v2."=";
                }
                break;

            default:
            // ↑ somente será interpretado quando nenhum dos 'case' for acionado
        }
        $result = array(
            'calculo' => $calculo,
            'conta' => $conta
        );

        return $result;
    }
?>