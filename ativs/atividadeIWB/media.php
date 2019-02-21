<?php
    require_once('modulo.php');

	$nota1 = null;
	$nota2 = null;
	$nota3 = null;
    $nota4 = null;
    $resultado = null;
    $erros = (string) null;
    
    if(isset($_POST['btn_limpar'])){
        header('location: media.php');
    }

	if(isset($_POST['btn_calcular'])){
		$nota1=$_POST['txt_n1'];
		$nota2=$_POST['txt_n2'];
		$nota3=$_POST['txt_n3'];
		$nota4=$_POST['txt_n4'];
		
		if($nota1 == null || $nota2 == null || $nota3 == null || $nota4 == null){
            $erros = "
                <div id='erros' class='center'>
                    <p>
                        <span id='title-erros'>ERROS</span><br><br>".VAZIO."
                    </p>
                </div>";
		}else if(!(is_numeric($nota1) && is_numeric($nota2) && is_numeric($nota3) && is_numeric($nota4))){
            $erros = "
                <div id='erros' class='center'>
                    <p>
                        <span id='title-erros'>ERROS</span><br><br>".INVALIDO."
                    </p>
                </div>";
		}else{
			$resultado = media($nota1, $nota2, $nota3, $nota4);
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
                    if(letra != 46 && letra != 44){
                        //FV
                        // Cancelando o evento 'keypress', ou seja, não deixa a tecla ir para a caixa
                        return false;
                    }
                }
            }
        </script>
        <title>
            Média
        </title>
    </head>
    <body>
        <header class="center">
            <h1>CÁLCULO DE MÉDIA</h1>
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
                <form name="frmmedia" method="post" action="media.php">
                    <div id="conteudo-media">
                        <div id="texts-media">
                            <div id="titles-media">
                                <h3>Nota 1:</h3>
                                <h3>Nota 2:</h3>
                                <h3>Nota 3:</h3>
                                <h3>Nota 4:</h3>
                            </div>
                            <div id="inputs-media">
                                <input onkeypress="return validar(event, 'tabuada');" type="text" name="txt_n1" id="txt-n1" value="<?php echo($nota1); ?>" >
                                <input onkeypress="return validar(event, 'tabuada');" type="text" name="txt_n2" id="txt-n2" value="<?php echo($nota2); ?>" >
                                <input onkeypress="return validar(event, 'tabuada');" type="text" name="txt_n3" id="txt-n3" value="<?php echo($nota3); ?>" >
                                <input onkeypress="return validar(event, 'tabuada');" type="text" name="txt_n4" id="txt-n4" value="<?php echo($nota4); ?>" >
                            </div>
                            <div id="button-media">
                                <input type="submit" value="CALCULAR" name="btn_calcular" id="btn-calcular">
                                <input id="btn-limpar" type="submit" name="btn_limpar" value="LIMPAR">
                            </div>
                        </div>
                        <div id="result-media">
                            <p><?php echo($resultado != null ? 'A média é: '.$resultado['media'] :''); ?><p>
                        </div>
                        <div id="situacao">
                            <p><?php echo($resultado != null ? 'O aluno esta: '.$resultado['situacao']: ''); ?></p>
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