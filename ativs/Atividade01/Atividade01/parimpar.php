<?php 
    
    require_once('modulo.php');

    
    $par = null;
    $impar = null;
    $contPares = null;
    $contImpares = null;
    $numero = null;
    
    if(isset($_POST["btncalc"])){
        $numInicial = $_POST["combo1"];
        $numFinal = $_POST["combo2"];
        
    //função que checa se o numero inicial é menor que o número final
           if($numInicial <= $numFinal){
                
                $numero = ParImpar($numInicial, $numFinal);
            }else{
               echo(ERRONUMERICO); 
            } 
        
        
            
      
    }
   
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <title>
            Atividade 01 - Par e Impar
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
<body>
    <form name="frmpar" method="post" action="parimpar.php">
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
            <div>
            N° Inicial: 
            <select name="combo1">
                

            <?php 
                for($cont=0;$cont<=500;$cont++){
                echo("<option value='".$cont."'>".$cont."</option>");
            } ?>

               
            </select>
        </div>
        <br>
        <div>
            N° Final: 
            <select name="combo2">
                

            <?php 
                for($cont=100;$cont<=1000;$cont++){
                echo("<option value='".$cont."'>".$cont."</option>");
            } ?>

               
            </select>
            
        </div>
        
        <input type="submit" name="btncalc" value="Calcular">
        
        <div>
            <div><p><?php echo($numero['par']); ?></p>
            
            </div>
            <div><p><?php echo($numero['impar']); ?></p></div>
            <div><p><?php echo($contImpares); ?></p></div>
            <div><p><?php echo($contPares); ?></p></div>
        </div>
        </div>
    </div>
        
    </form>
</body>

</html>