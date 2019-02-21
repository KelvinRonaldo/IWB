<?php 
    
    $resultado = "";
    
    require_once('modulo.php');

    if(isset($_POST["btncalc"])){
     
    $valor1 = $_POST["txtvalor1"];
    $contador = $_POST["cont1"];
    
        
    
     $resultado = Tabuada($valor1, $contador);
    }

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <title>
            Atividade 01 - Tabuada
        </title>
        <meta charset="utf-8">
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
    <form name="frmtabuada" method="post" action="tabuada.php">
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
            <div id="tabuada" class="center">
                Tabuada: 
                <input type="text" onkeypress="return Validar(event);" name="txtvalor1" >
            </div>
        </div>
        <br>
        <div>
             Contador: 
            <input type="text" onkeypress="return Validar(event);" name="cont1" >
        </div>
        
        <input type="submit" name="btncalc" value="Calcular">
        
        <div>
            <span> <?php  echo($resultado); ?> </span>
        </div>
        </div>
    </div>
       
    </form>
</body>

</html>