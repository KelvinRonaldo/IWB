<?php
// VERIFICAÇÃO DE URL PARA MARCAÇÃO NO MENU DA PAGINA ATUAL
    $url = $_SERVER["REQUEST_URI"];

    $paginaAtual = explode("/", $url);
    for($cont = 0; $cont < count($paginaAtual); $cont++){
        // echo($paginaAtual[$cont]."<br>");
        switch($paginaAtual[$cont]){
            case "cmsConteudo.php": case "mngNoticias.php": case "mngPromocoes.php":
            case "mngLojas.php": case "mngEventos.php": case "mngSobre.php":
                $cmsConteudo = "style='background-color: rgba(26, 20, 105, 0.103);'";
                break;
            case "cmsFaleConosco.php":
                $cmsFaleConosco = "style='background-color: rgba(26, 20, 105, 0.103);'";
                break;
            case "cmsProdutos.php":
                $cmsProdutos = "style='background-color: rgba(26, 20, 105, 0.103);'";
                break;
            case "cmsUsuarios.php":
                $cmsUsuarios = "style='background-color: rgba(26, 20, 105, 0.103);'";
                break;
            default:
                $cmsConteudo = "";
                $cmsFaleConosco = "";
                $cmsProdutos = "";
                $cmsUsuarios = "";
                break;
        }
    }
?>
                <!-- AREA DO MENU -->
                <nav id="container-menu" class="flexbox">
                    <ul id="caixa-menu">
                        <!-- ITEM DO MENU QUE VAI PARA PAGINA DE ADMIN. DE CONTEUDO -->
                        <li class="item-menu" onclick="window.location.href='cmsConteudo.php';" <?php echo($cmsConteudo); ?>> 
                            <figure>
                                <img class="icone-menu" alt="Administrar Conteúdo" title="Administrar Conteúdo" src="icons/gears.png">
                            </figure>
                            <figcaption class="legendas-icones">Adm. Conteúdo</figcaption>
                        </li>
                        <!-- ITEM DO MENU QUE VAI PARA PAGINA DE ADMIN. DO FALE CONOSCO -->
                        <li class="item-menu" onclick="window.location.href='cmsFaleConosco.php';" <?php echo($cmsFaleConosco); ?>>
                            <figure>
                                <img class="icone-menu" alt="Administrar Fale Conosco" title="Administrar Fale Conosco" src="icons/contact.png">
                            </figure>
                            <figcaption class="legendas-icones">Adm. Fale Conosco</figcaption>
                        </li>
                        <!-- ITEM DO MENU QUE VAI PARA PAGINA DE ADMIN. DE PRODUTOS -->
                        <li class="item-menu" onclick="window.location.href='cmsConteudo.php';" <?php echo($cmsProdutos); ?>>
                            <figure>
                                <img class="icone-menu" alt="Administrar Produtos" title="Administrar Produtos" src="icons/product.png">
                            </figure>
                            <figcaption class="legendas-icones">Adm. Produtos</figcaption>
                        </li>
                        <!-- ITEM DO MENU QUE VAI PARA PAGINA DE ADMIN. DE USUARIOS -->
                        <li class="item-menu" onclick="window.location.href='cmsUsuarios.php';" <?php echo($cmsUsuarios); ?>>
                            <figure>
                                <img class="icone-menu" alt="Administrar Usuários" title="Administrar Usuários" src="icons/users.png">
                            </figure>
                            <figcaption class="legendas-icones">Adm. Usuários</figcaption>
                        </li>
                    </ul>
                </nav>
                <!-- AREA COM NOME DO USUARIO E LINK PARA DESLOGAR -->
                <form action="../login.php" method="post" name="frm-logout">
                    <div id="container-usuario" class="flexbox">
                        <div id="container-bem-vindo">
                            <h4 id="bem-vindo">Bem-Vindo, </h4><a class="user"><?php echo(' '.$_SESSION['user']); ?></a>
                        </div>
                        <div id="logout">
                            <input type="submit" name="logout" id="btn-logoff" value="LOGOUT">
                        </div>
                    </div>
                </form>