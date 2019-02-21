<?php

//declaração de CONSTANTES as constantes devem ser declaradas com caixa alta
    define("ERRO", "Erro no calculo!");
    define("VAZIO", "Erro, preecha as caixas vazias!");
    define("CARACTER", "Erro, Não é possível a entrada de caracteres!");
    define("NUMERO", "Selecione algum número");
    define("ERRONUMERICO", "O número inicial deve ser menor que o número final");

// Função para calcular as operações matemáticas
    function Calcular($v1, $v2, $operacao)
    {
         $result = "";
         global $somaChecked;
         global $subtrairChecked;
         global $multChecked;
         global $divChecked;  
       switch ($operacao)
        {
            case "SOMA":
                $result = $v1 + $v2;
                $somaChecked = (string) 'checked';
                break;
                
            case "SUB":
                $result = $v1 - $v2;
                $subtrairChecked = (string) 'checked';
                break;
            case "MULT":
                $result = $v1 * $v2;
                $multChecked = (string) 'checked';
                break;
            case "DIVIDIR":
                $divChecked = (string) 'checked';
                if($v2 == 0)
                    echo(ERRO);
                else
                    $result = $v1 / $v2;
                break;
                
            default:
// Ação padrão que irá acontecer caso nenhuma das opções acima seja executada;     
        }
        
       return $result; 
    }

    
    function Calcular2($opcao, $valor1, $valor2){
        $opcao = strtoupper($_POST["rdocalc"]);
    
        
        if($opcao == "SOMA"){
            $resultado = $valor1 + $valor2;
            $somaChecked = (string) 'checked';
        }
        elseif($opcao == "SUB"){
            $resultado = $valor1 - $valor2;
            $subtrairChecked = (string) 'checked';
        }
        elseif($opcao == "MULT"){
            $resultado = $valor1 * $valor2;
            $multChecked = (string) 'checked';
        }
        elseif($opcao == "DIVIDIR"){
            $divChecked = (string) 'checked';
            if($valor2 == 0)
                echo(ERRO);
            else
                $resultado = $valor1 / $valor2;
            ;
            
        }
        
        return $resultado;
    }


    function ParImpar($inicial, $final){
        $par = null;
        $impar = null;
        global $contPares;
        global $contImpares;
        
        for($cont = $inicial; $cont <= $final; $cont++){
                if($cont % 2 == 0){
                 $par .= $cont.'<br>';
                 $contPares++;
                }else{
                $impar .= $cont.'<br>';
                $contImpares++;
             }
        }
        
        $paresImpares = array(
        'par' => $par,
        'impar' => $impar
        );
        
        return $paresImpares;
    }

    function Tabuada($valor1, $contador)
    {
        $result = "";
        $tabuada = "";
        
        for($cont1=0; $cont1<=$contador;$cont1++)
        {
            $result = $valor1*$cont1;
            $tabuada .= $valor1."x".$cont1."=".$result."<br>";
           
        }
        
         return $tabuada;
    }

?>