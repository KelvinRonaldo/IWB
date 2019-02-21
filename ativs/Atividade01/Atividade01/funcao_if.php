<?php

    /*
        Formas de importar arquivos externos em php na página local
        
        require();
        require_once();
        indluce();
        include_once();
    */

    require_once('modulo.php');


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
   
    $somaChecked="";
    $subtrairChecked="";
    $multChecked="";
    $divChecked="";

    
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
            /*
                is_numeric() - verifica se é um número
                is_string() - verifica se é caracter
                is_int - verifica se é inteiro
                is_float - verifica se é numero flutuante
                is_double - verifica se é numero do tipo double
                is_bool - verifica se é verdadeiro ou falso
                is_array - verifica se é um vetor/matriz
                is_objetct - verifica se é um objeto
                
            */
            //VALIDA A ENTRADA DE APENAS NUMEROS NAS CAIXAS
            if(is_numeric($valor1) && is_numeric($valor2)){
              
                //strtoupper transforma a string em maiusculo
                //strtolower transforma a string em minusculo
        
            $opcao = strtoupper($_POST["rdocalc"]);
            $resultado = Calcular($valor1, $valor2, $opcao);
            
        
        
 
            }else{
                echo(CARACTER);
            }
            
            
        
        }
            
    }

?>
<html>
    <head>
        <title>
            Calculadora Simples
        </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script>
            function Validar(caracter){
                
                /* Verifica se o evento da tecla digita é proveniente de uma ação de janela(navegador) */
                
                if(window.event)
                    //transforma a tecla digitada para Ascii
                    var letra = caracter.charCode;
                else
                    //transforma a tecla digitada para Ascii
                    var letra = caracter.which;
                
                /* Verifica atraves da tabela ascii se a digitação está entre 48 e 57, que corresponde apenas aos numeros de 0 a 9 */
                if(letra < 48 || letra > 57){
                    //return false ele vai cancelar a ação
                      if(letra != 46)
                          //libera apenas o ponto para digitação
                         return false;
                   }
            }
        </script>
    </head>
    <body>
        <form name="frmcalcular" method="post" action="funcao_if.php">
            <header>
        Já dizia que a aritmética 
    </header>
    
        <nav id="menu">
            <figure>
                <img src="imagem/menu_mobile.jpg">
            </figure>
            <ul class="menu_dois">
                <li><a href="media.php">Média</a></li>
                <li class="sub_menu_calc"><a>Calculadora</a>
                    <ul class="sub_menu">
                        <li><a href="funcao_if.php">IF</a></li>
                        <li><a href="switch.php">Switch</a></li>
                    </ul>
                </li>
                    
                <li><a href="tabuada.php">Tabuada</a></li>
                <li><a href="parimpar.php">Pares e ímpares</a></li>
            </ul>
        </nav>
    <div id="conteudo">
        <div id="caixa_centralizada">
            <div id="caixa_principal" class="center">
            <div id="titulo">
                Calculadora Simples
            </div>
            
            <div id="calculo">
                <div class="valor">
                    Valor 1:
                    <input class="input" type="text" name="txtvalor1" value="<?php echo($valor1) ?>" onkeypress="return Validar(event);"> 
                    
                </div>
                <div class="valor">
                    Valor 2:
                    <input class="input" type="text" name="txtvalor2" value="<?php echo($valor2) ?>" onkeypress="return Validar(event);">
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
                    <input class="btn" type="submit" name="btncalcular" value="Calcular"> 
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
        </div>
    </div>
        
        
        </form>
        
    </body>
</html>