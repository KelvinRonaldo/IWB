<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" media="screen" type="text/css" href="css/style.css">
        <title>
            ATIVIDADE PHP
        </title>
    </head>
    <body>
        <header class="center">
            <h1>ATIVIDADE PHP</h1>
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
            </div>
            <div id="conteudo-dir">
                <a href="tabuada.php">
                    <div id="tab-home">
                        <div class="titles-home" id="title-tab">
                            <h1>Tabuada</h1>
                        </div>
                    </div>
                </a>
                <a href="parImpar.php">
                    <div id="parImpar-home">
                        <div class="titles-home" id="title-pi">
                            <h1>Par e Ímpar</h1>
                        </div>
                    </div>
                </a>
                <a href="media.php">
                    <div id="media-home">
                        <div class="titles-home" id="title-media">
                            <h1>Média</h1>
                        </div>
                    </div>
                </a>
                <a href="calculadoraIf.php">
                    <div id="calcIf-home">
                        <div class="titles-calc" id="title-if">
                            <h1>Calculadora com 'If'</h1>
                        </div>
                    </div>
                </a>
                <a href="calculadoraSwitch.php">
                    <div id="calcSw-home">
                        <div class="titles-calc" id="title-sw">
                            <h1>Calculadora com 'Switch'</h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <footer class="center">
            <!-- <h1>NADA</h1> -->
        </footer>
    </body>
</html>