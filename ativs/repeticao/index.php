<?php
    if(isset($_POST['btn_calcular'])){
        $valor = $_POST['txt_numero'];
        
        echo("-----USANDO WHILE-------<br>");
        $cont = 0;
        $resultado = (string) "";

        while($cont <= $valor){
            // $resultado = $resultado.$cont.'<br>';
            $resultado .= $cont.'<br>';
            // $cont = $cont + 1;
            // $cont += 1;
            $cont++;
        }
        echo($resultado);


        echo("<br>======USANDO FOR======<br>");
        $resultado = (string) "";

        for($cont = 0; $cont <= $valor; $cont++){
            $resultado .= $cont.'<br>';
        }
        echo($resultado);

    }
?>


<html>
    <head>
        <meta charset="utf-8" />
        <title>Repetição</title>
    </head>
    <body>
        <form name="frm_repeticao" method="post" action="index.php">
            <input type="text" name="txt_numero">
            <input type="submit" name="btn_calcular" value="CALCULAR">
        </form>
    </body>
</html>