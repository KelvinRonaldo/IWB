<?php

    require_once('modulo.php');
    $resultados = (string) null;
    $erros = (string) null;
    $tabuada = null;
    $contador = null;

    define('TABZERO', 'Não exite tabuada do zero!');

    if(isset($_POST['btn_limpar'])){
        header('location: tabuada.php');
    }

    if(isset($_POST['btn_calcular'])){
        $tabuada = $_POST['txt_tabuada'];
        $contador = $_POST['txt_contador'];

        if((isset($_POST['txt_tabuada']) && isset($_POST['txt_contador'])) && $tabuada != null && $contador != null){
            if(is_numeric($tabuada) && is_numeric($contador)){
                if($tabuada == 0){
                    $erros = "
                        <div id='erros' class='center'>
                            <p>
                                <span id='title-erros'>ERROS</span><br><br>".TABZERO."
                            </p>
                        </div>";
                }else{
                    $resultados = tabuada($tabuada, $contador);
                }
            }else{
                $erros = "
                    <div id='erros' class='center'>
                        <p>
                            <span id='title-erros'>ERROS</span><br><br>".INVALIDO."
                        </p>
                    </div>";
            }
        }else{
            $erros = "
                <div id='erros' class='center'>
                    <p>
                        <span id='title-erros'>ERROS</span><br><br>".VAZIO."
                    </p>
                </div>";
        }

    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" media="screen" type="text/css" href="css/style.css">
        <script>
            const validar = (caracter, campo) =>{
                /* Verifica em qual padrão de navegador o caractér está sendo enviado
                se for pelo padrão 'event' então utilizamos 'charCode', caso contrátio, utilizamos 'which1' */
                if(window.event)
                    // Tranforma o caracter em ASCII
                    var letra = caracter.charCode;
                else
                    // Tranforma o caracter em ASCII
                    var letra = caracter.which
                //Verifica se o ASCII do caracter digitado esta entrew 48 e 57, que corresponde aos numeros de 0 até 9
                if(letra < 48 || letra > 57){
                    if(campo == 'contador'){
                        return false;
                    }else{
                        if(letra != 46 && letra != 44)
                        //FV
                        // Cancelando o evento 'keypress', ou seja, não deixa a tecla ir para a caixa
                        return false;
                    }
                }
            }
        </script>
        <title>
            Tabuada
        </title>
    </head>
    <body>
        <header class="center">
            <h1>TABUADA</h1>
        </header>
        <div id="conteudo" class="center">
            <div id="conteudo-esq">
                <nav id="menu" class="center">
                    <figure id="icon-menu">
                        <img id="img-menu" src="icons/iconMenu.png" alt="Ícone Menu" title="Ícone Menu"> 
                    </figure>
                    <ul id="caixa-menu" class="center">
                        <li class="item-menu">
                            <a  href="tabuada.php">TABUADA</a>
                        </li>
                        <li class="item-menu">
                            <a  href="parImpar.php">PAR E ÍMPAR</a>
                        </li>
                        <li class="item-menu">
                            <a  href="media.php">MÉDIA</a>
                        </li>
                        <li class="item-menu" id="calc">
                            <span>CALCULADORA</span>
                            <ul id="menu-calc" class="center">
                                <li>
                            <a  href="calculadoraIf.php">If</a>
                                </li>
                                <li>
                            <a  href="calculadoraSwitch.php">Switch</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id='caixa-erros' class='center'>
                    <?php echo($erros); ?>
                </div>
                <div id="home" class="center">
                    <figure>
                        <a href="index.php"><img src="icons/home.png" id="icone-home" alt="Ícone Home" title="Ícone Home"></a>
                    </figure>
                </div>
            </div>
            <div id="conteudo-dir">
                <form name="frm_formulario" method="post" action="tabuada.php">
                    <div id="conteudo-tabuada">
                        <div id="texts-tabuadas">
                            <div id="titles-tabuada">
                                <h3>Tabuada:</h3>
                                <h3>Contador:</h3>
                            </div>
                            <div id="inputs">
                                <input onkeypress="return validar(event, 'tabuada');" name="txt_tabuada" id="txt-tabuada" value=<?php echo($tabuada); ?> >
                                <input onkeypress="return validar(event, 'contador');" name="txt_contador" id="txt-contador" value=<?php echo($contador); ?> >
                            </div>
                            <div id="button">
                                <input type="submit" value="CALCULAR" name="btn_calcular" id="btn-calcular">
                                <input id="btn-limpar" type="submit" name="btn_limpar" value="LIMPAR">
                            </div>
                        </div> 
                        <div id="resultados-tabuada" class="center">
                            <p><?php echo($resultados); ?></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer class="center">
            <!-- <h1>NADA</h1> -->
        </footer>
    </body>
</html>