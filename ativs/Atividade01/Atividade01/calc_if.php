<?php
    //ou vc deixa o php decidir qual o tipo da variavel ou voce pode colocar antes da variavel entre () com a identificação dentro
    //gettype retorna qual o tipo de dado da variável
    //settype converte a variável para qualquer tipo que voce quiser ex: int,double,string
    //strtoupper transforma a string em maiusculo
    //strtolower transforma a string em minusculo

//    $valor1 = (string) "";
//    $valor2 = null;
//    
//
//    echo(gettype($valor1));
//    // o var_dump te da as informações da variavel 
//    var_dump($valor1);
//    
//    echo("<br>".gettype($valor1));
//    settype($valor1, 'int');

    //declaração de variaveis
    $resultado = (float) 0;
    $valor1 = (float) null;
    $valor2 = (float) null;
    $opcao = (string) null;
    $somaChecked = (string) null;
    $subtrairChecked = (string) null;
    $multChecked = (string) null;
    $divChecked = (string) null;


    //declaração de CONSTANTES as constantes devem ser declaradas com caixa alta
    define("ERRO", "Erro no calculo!");
    define("VAZIO", "Erro, preecha as caixas vazias!");
    

    //verifica se o botao foi clicado
    if(isset($_POST["btncalcular"])){
                    
        $valor1 = $_POST["txtvalor1"];
        $valor2 = $_POST["txtvalor2"];
        
        //!isset($_POST["rdocalc"]) já vem como false então ele entra no else, então coloca o "!" para mudar o sentido e ele entrar no if, e ele foi colocado para testar 
        // se o rdo havia sido selecionado
        if($valor1 == null || $valor2 == null || !isset($_POST["rdocalc"])){
            echo(VAZIO);
        }else
        {
         //strtoupper transforma a string em maiusculo
        //strtolower transforma a string em minusculo
        
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
        
        
        
        
//    if($_POST["rdo"])
            
//        $soma = ($valor1 + $valor2);
//        $subtrair = ($valor1 - $valor2);
//        $multiplicar = ($valor1 * $valor2);
//        $dividir = ($valor1 / $valor2);   
        }
        
        
        
    }
    
    
  

?>
<html>
    <head>
        <title>
            Calculadora Simples
        </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <form name="frmcalcular" method="post" action="calc_if.php">
        <div id="caixa_principal" class="center">
            <div id="titulo">
                Calculadora Simples
            </div>
        
            <div id="calculo">
                <div>
                    Valor 1:
                    <input type="text" name="txtvalor1" value="<?php echo($valor1) ?>" >
                    
                </div>
                <div>
                    Valor 2:
                    <input type="text" name="txtvalor2" value="<?php echo($valor2) ?>">
                </div>
                
                <div id="caixa_radio">
                    <div>
                        <input type="radio" name="rdocalc" value="soma" <?php echo($somaChecked) ?>> Somar
                    </div>
                    <div>
                        <input type="radio" name="rdocalc" value="sub" <?php echo($subtrairChecked) ?>> Subtrair
                    </div>
                    <div>
                        <input type="radio" name="rdocalc" value="mult" <?php echo($multChecked) ?>> Multiplicar
                    </div>
                    <div>
                        <input type="radio" name="rdocalc" value="dividir" <?php echo($divChecked) ?>> Dividir
                    </div>
                </div>
                
                
                <div>
                    <input type="submit" name="btncalcular" value="Calcular"> 
                </div>
                
                
                
            </div>
            <div id="resultado">
                <div id="titulo_resultado">
                    Resultado
                </div>
                <div id="caixa_resultado">
                    <?php echo($resultado); ?>
                    
                </div>
            </div>
            
        </div>
        
        </form>
        
    </body>
</html>