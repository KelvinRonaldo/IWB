<?php 

    /* Criamos essa variável para resolver o bug na saída da variável quando
    a página é inicializada, poderiamos usar o isset na variável ou o "@" antes do echo  = "@cho"*/
    $media = null;
    $situacao = null;
    $valor1 = null;  
    $valor2 = null;
    $valor3 = null;
    $valor4 = null;

    /* ISSET permite verificar a existência de uma variável ou um objeto */
    if(isset($_GET["btncalcular"]))
    {
      
    
    
        
    $valor1 = $_GET["txtvalor1"];
    $valor2 = $_GET["txtvalor2"];
    $valor3 = $_GET["txtvalor3"];
    $valor4 = $_GET["txtvalor4"];
        
    
    if($valor1 == "" || $valor2 == "" || $valor3 == "" || $valor4 == ""){
        echo("Preencha os campos vazios");}
        
    else{
       $media = ($valor1 + $valor2 + $valor3 + $valor4)/4;
        
        
        
        //destroi as variaveis do servidor
        /*
        unset($valor1);
        unset($valor2);
        unset($valor3);
        unset($valor4);
        */
        
         if($media < 7)
             $situacao = "<span class='reprovado'>Aluno Reprovado </span>";
         else
             $situacao = "<span class='aprovado'>Aluno Aprovado </span>";  
    }
        
    /* COMANDO DO PHP empty() checa se está vazio */
        
    
    }
      
     
    
// o "@" é uma forma de omitir os erros na tela, mas não é uma boa alternativa, O certo é resolver o problema.
    
          
?>

<html>
    <head>
        <title>
        Calculando a média
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
        <form name="frmcalcular" method="get" action="media.php">
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
            <table width="1300px" border="0">
                <tr>
                    <td class="titulo">
                        Cálculo de Média
                    </td>
                </tr>
                <tr>
                    <td class="nota">
                        Nota 1:
                        <input class="inputs" type="text" onkeypress="return Validar(event);" name="txtvalor1" value="<?php echo($valor1); ?>">
                    </td>
                    
                </tr>
                <tr>
                    <td class="nota">
                        Nota 2:
                        <input class="inputs" type="text" onkeypress="return Validar(event);" name="txtvalor2" value="<?php echo($valor2); ?>">
                    </td>
                    
                </tr>
                <tr>
                    <td class="nota">
                        Nota 3:
                        <input class="inputs" type="text" onkeypress="return Validar(event);" name="txtvalor3" value="<?php echo($valor3); ?>">
                    </td>
                    
                </tr>
                <tr>
                    <td class="nota">
                        Nota 4:
                        <input class="inputs" type="text" onkeypress="return Validar(event);" name="txtvalor4" value="<?php echo($valor4); ?>">
                    </td>
                </tr>
                <tr>
                    <td class="botoes">
                        <input class="botao" type="reset" name="btnlimpar" value="Limpar">
                        <input class="botao" type="submit" name="btncalcular" value="Calcular">
                    </td>
                </tr>
            </table>
        </form>
            
            <span class="mensagem">A média é <?php echo($media); ?> </span><br>
            <span class="mensagem">O aluno esta: <?php echo($situacao); ?> </span> <br>
            
        </div>
    </div>
            
        
            
    </body>
    
</html>