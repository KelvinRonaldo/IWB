<?php

    require_once ('verificarUsuario.php'); // VERIFICAR SE USUARIO ESTA LOGADO

//    VERIFICAR SE O USUARIO LOGADO TEM PERMISSÃO PARA ACESSAR ESTA PÁGINA
    if($_SESSION['adm_conteudo'] == 'ativado'){
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/fontes.css">
        <title>CMS Road Runner</title>
        <meta charset="utf-8">
        <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <!-- AREA DE TODO O CONTEUDO DA PAGINA -->
        <div id="tudo">
            <!-- IMPORTANDO ARQUIVO COM HEADER DA PAGINA -->
            <?php
                require_once('header.html');
            ?>
            <div id="menu" class="center flexbox">
                <!-- IMPORTANDO ARQUIVO COM MENU DA PAGINA -->
                <?php
                    require_once('menu.php');
                ?>
            </div>
            <!-- AREA COM O CONTEUDO DA PAGINA -->
            <div id="conteudo">
                <!-- AREA QUE LEVA À PAGINA DE GERENCIAMENTO DE NOTICIAS -->
                <a href="mngNoticias.php">
                    <div class="mng-conteudo">
                        <div class="img-conteudo">
                            <figure>
                                <img class="icon-mng-conteudo" alt="Gerenciar Noticias" title="Gerenciar Noticias" src="icons/news.png">
                            </figure>
                        </div>
                        <div class="txt-mng-conteudo">
                            <h3>Gerenciar Notícias</h3>
                        </div>
                    </div>
                </a>
                <!-- AREA QUE LEVA À PAGINA DE GERENCIAMENTO DE PROMOÇÕES -->
                <a href="mngPromocoes.php">
                    <div class="mng-conteudo">
                        <div class="img-conteudo">
                            <figure>
                                <img class="icon-mng-conteudo" alt="Gerenciar Promoções" title="Gerenciar Promoções" src="icons/sale.png">
                            </figure>
                        </div>
                        <div class="txt-mng-conteudo">
                            <h3>Gerenciar Promoções</h3>
                        </div>
                    </div>
                </a>
                <!-- AREA QUE LEVA À PAGINA DE GERENCIAMENTO DE LOJAS -->
                <a href="mngLojas.php">
                    <div class="mng-conteudo">
                        <div class="img-conteudo">
                            <figure>
                                <img class="icon-mng-conteudo" alt="Gerenciar Lojas" title="Gerenciar Lojas" src="icons/store.png">
                            </figure>
                        </div>
                        <div class="txt-mng-conteudo">
                            <h3>Gerenciar Lojas</h3>
                        </div>
                    </div>
                </a>
                <!-- AREA QUE LEVA À PAGINA DE GERENCIAMENTO DE EVENTOS -->
                <a href="mngEventos.php">
                    <div class="mng-conteudo">
                        <div class="img-conteudo">
                            <figure>
                                <img class="icon-mng-conteudo" alt="Gerenciar Eventos" title="Gerenciar Eventos" src="icons/events.png">
                            </figure>
                        </div>
                        <div class="txt-mng-conteudo">
                            <h3>Gerenciar Eventos</h3>
                        </div>
                    </div>
                </a>
                <!-- AREA QUE LEVA À PAGINA DE GERENCIAMENTO DE SOBRE -->
                <a href="mngSobre.php">
                    <div class="mng-conteudo">
                        <div class="img-conteudo">
                            <figure>
                                <img class="icon-mng-conteudo" alt="Gerenciar Sobre" title="Gerenciar Sobre" src="icons/about.png">
                            </figure>
                        </div>
                        <div class="txt-mng-conteudo">
                            <h3>Gerenciar Sobre</h3>
                        </div>
                    </div>
                </a>
            </div>
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('footer.html');
            ?>
        </div>
    </body>
</html>
<?php
    }else{
        $userName = $_SESSION['user_name'];
        echo
        "<script>
            alert('Usuário $userName não tem permissão de acesso à esta página.');
            window.history.back();
        </script>";
    }
?>