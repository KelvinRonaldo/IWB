<?php
// VERIFICAÇÃO DE URL PARA MARCAÇÃO NO MENU DA PAGINA ATUAL
    $nomePagina =  basename($_SERVER["SCRIPT_FILENAME"]);

    $cmsConteudo = null;
    $cmsFaleConosco = null;
    $cmsProdutos = null;
    $cmsUsuarios = null;

    // VERIFICA QUAL A PÁGINA ATUAL PARA MARCA-LA NO MENU
    switch($nomePagina){
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
?>
                <!-- AREA DO MENU -->
                <nav id="container-menu" class="flexbox">
                    <div id="caixa-menu">
                        <!-- ITEM DO MENU QUE VAI PARA PAGINA DE ADMIN. DE CONTEUDO -->
                        <div class="item-menu" onclick="window.location.href='cmsConteudo.php';" <?php echo($cmsConteudo); ?>> 
                            <figure>
                                <img class="icone-menu" alt="Administrar Conteúdo" title="Administrar Conteúdo" src="icons/gears.png">
                            </figure>
                            <p class="legendas-icones">Adm. Conteúdo</p>
                        </div>
                        <!-- ITEM DO MENU QUE VAI PARA PAGINA DE ADMIN. DO FALE CONOSCO -->
                        <div class="item-menu" onclick="window.location.href='cmsFaleConosco.php';" <?php echo($cmsFaleConosco); ?>>
                            <figure>
                                <img class="icone-menu" alt="Administrar Fale Conosco" title="Administrar Fale Conosco" src="icons/contact.png">
                            </figure>
                            <p class="legendas-icones">Adm. Fale Conosco</p>
                        </div>
                        <!-- ITEM DO MENU QUE VAI PARA PAGINA DE ADMIN. DE PRODUTOS -->
                        <div class="item-menu" onclick="window.location.href='cmsProdutos.php';" <?php echo($cmsProdutos); ?>>
                            <figure>
                                <img class="icone-menu" alt="Administrar Produtos" title="Administrar Produtos" src="icons/product.png">
                            </figure>
                            <p class="legendas-icones">Adm. Produtos</p>
                        </div>
                        <!-- ITEM DO MENU QUE VAI PARA PAGINA DE ADMIN. DE USUARIOS -->
                        <div class="item-menu" onclick="window.location.href='cmsUsuarios.php';" <?php echo($cmsUsuarios); ?>>
                            <figure>
                                <img class="icone-menu" alt="Administrar Usuários" title="Administrar Usuários" src="icons/users.png">
                            </figure>
                            <p class="legendas-icones">Adm. Usuários</p>
                        </div>
                    </div>
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