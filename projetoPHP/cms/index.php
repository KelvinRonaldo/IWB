<?php

    require_once ('verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();
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
            <div id="conteudo-index" class="flexbox">
                <div id="caixa-boas-vindas" class="flexbox"><!-- TEXTO DE BOAS VINDAS -->
                    <h2>BEM-VINDO AO CMS<br>(SISTEMA DE GERENCIAMENTO DE CONTEÚDO)*</h2>
                    <p>Logo abaixo você pode ver algumas instruções que podem tornar a sua experiência no<br> gerenciamento do seu conteúdo mais rápida. Clique em "Detalhes" para ver mais detalhes.</p>
                </div>
                <!-- LEGENDAS, ORIENTAÇÕES SOBRE O CMS -->
                <div id="legendas-site">
                    <div id="legenda-adm-conteudo">
                        <!-- ORIENTAÇÕES SOBRE PAGINA DE ADMINISTRAÇÃO DE CONTEUDO -->
                        <div class="main-title-legenda">
                            <figure>
                                <img class="main-img-legenda" alt="Administrar Conteúdo" title="Administrar Conteúdo" src="icons/gears.png">
                            </figure>
                            <h3>Administrar Conteúdo do Site</h3>
                            <details class="detalhes">
                                <summary>Detalhes</summary>
                                <p>
                                    Nesta página você tem acesso à todo controle do conteúdo do seu site.
                                </p>
                            </details>
                        </div>

                        <!-- ORIENTAÇÕES DA PAGINA DE GERENCIAMENTO DE NOTICIAS-->
                        <div class="subtitle-legenda">
                            <figure>
                                <img class="sub-img-legenda" alt="Gerenciar Noticias" title="Gerenciar Noticias" src="icons/news.png">
                            </figure>
                            <h4>Gerenciamento de Notícias</h4>
                            <details class="detalhes">
                                <summary>Detalhes</summary>
                                <p>Cadastro de notícias do site. Nas notícias principais há <span class="negrito">3 níveis</span> de destaque de notícia.</p>
                                <ul>
                                    <li>&nbsp; Notícias de <span class="negrito">Alto Destaque</span> ficam no topo do site com o maior destaque possível.</li>
                                    <li>&nbsp; Notícias de <span class="negrito">Médio Destaque</span> no canto superior direito do o topo do site.</li>
                                    <li>&nbsp; Notícias de <span class="negrito">Baixo Destaque</span> no canto inferior direito do o topo do site.</li>
                                </ul>
                            </details>
                        </div>
                    <!-- LEGENDAS DAS IMAGENS DE NIVEL DE DESTAQUE DAS NOTICIAS PRINCIPAIS E VISUALIZAÇÃO DE IMAGEM -->
                        <a href="http://localhost/ativs/projetoPHP/cms/mngNoticias.php?codDtq=1&destaque=Alto%20Destaque">
                            <div class="sub-subtitle-legenda">
                                <figure>
                                    <img class="sub-sub-img-legenda" alt="Notícia de Alto Destaque" title="Notícia de Alto Destaque" src="icons/nvl1.png">
                                </figure>
                                <h5>Notícia de Alto Destaque</h5>
                            </div>
                        </a>
                        <a href="http://localhost/ativs/projetoPHP/cms/mngNoticias.php?codDtq=2&destaque=Médio%20Destaque">
                            <div class="sub-subtitle-legenda">
                                <figure>
                                    <img class="sub-sub-img-legenda" alt="Notícia de Médio Destaque" title="Notícia de Médio Destaque" src="icons/nvl2.png">
                                </figure>
                                <h5>Notícia de Médio Destaque</h5>
                            </div>
                        </a>
                        <a href="http://localhost/ativs/projetoPHP/cms/mngNoticias.php?codDtq=3&destaque=Baixo%20Destaque">
                            <div class="sub-subtitle-legenda">
                                <figure>
                                    <img class="sub-sub-img-legenda" alt="Notícia de Baixo Destaque" title="Notícia de Baixo Destaque" src="icons/nvl3.png">
                                </figure>
                                <h5>Notícia de Baixo Destaque</h5>
                            </div>
                        </a>
                        
                        <div class="sub-subtitle-legenda">
                            <figure>
                                <img class="sub-sub-img-legenda" alt="Visualizar Imagem" title="Visualizar Imagem" src="icons/img.png">
                            </figure>
                            <h5>Visualizar Imagem</h5>
                        </div>

                        <!-- ORIENTAÇÕES DA PAGINA DE GERENCIAMENTO DE PROMOÇÕES-->
                        <div class="subtitle-legenda">
                            <figure>
                                <img class="sub-img-legenda" alt="Gerenciar Promoções" title="Gerenciar Promoções" src="icons/sale.png">
                            </figure>
                            <h4>Gerenciamento de Promoções</h4>
                            <details class="detalhes">
                            <!-- DETALHES DA PÁGINA DE GERENCIAMENTO DE PROMOÇÕES-->
                                <summary>Detalhes</summary>
                                <p>
                                    Criar uma promoção para um determinados, definindo um percentual de desconto sobre seu preço
                                </p>
                            </details>
                        </div>
                        <!-- ORIENTAÇÕES DA PAGINA DE GERENCIAMENTO DE LOJAS-->
                        <div class="subtitle-legenda">
                            <figure>
                                <img class="sub-img-legenda" alt="Gerenciar Lojas" title="Gerenciar Lojas" src="icons/store.png">
                            </figure>
                            <h4>Gerenciamento de Lojas</h4>
                            <details class="detalhes">
                            <!-- DETALHES DA PÁGINA DE GERENCIAMENTO DE LOJAS-->
                                <summary>Detalhes</summary>
                                <p>
                                    Cadastro de uma loja a partir de seu endereço.
                                </p>
                            </details>
                        </div>
                        <!-- ORIENTAÇÕES DA PAGINA DE GERENCIAMENTO DE EVENTOS-->
                        <div class="subtitle-legenda">
                            <figure>
                                <img class="sub-img-legenda" alt="Gerenciar Eventos" title="Gerenciar Eventos" src="icons/events.png">
                            </figure>
                            <h4>Gerenciamento de Eventos</h4>
                            <details class="detalhes">
                            <!-- DETALHES DA PÁGINA DE GERENCIAMENTO DE EVENTOS-->
                                <summary>Detalhes</summary>
                                <p>&nbsp; Aqui você cadastra os eventos relacionados a sua loja. É possível colocar detalhes sobre o evento como:</p>
                                <ul>
                                    <li>Nome do Evento;</li>
                                    <li>Promotor;</li>
                                    <li>Valor da Entrada;</li>
                                    <li>Data;</li>
                                    <li>Imagem;</li>
                                    <li>Resumo;</li>
                                    <li>Descrição</li>
                                </ul>
                            </details>
                        </div>
                        <!-- ORIENTAÇÕES DA PAGINA DE GERENCIAMENTO DE SOBRE-->
                        <div class="subtitle-legenda">
                            <figure>
                                <img class="sub-img-legenda" alt="Gerenciar Sobre" title="Gerenciar Sobre" src="icons/about.png">
                            </figure>
                            <h4>Gerenciamento de Sobre</h4>
                            <details class="detalhes">
                            <!-- DETALHES DA PÁGINA GERENCIAMENTO DE SOBRE-->
                                <summary>Detalhes</summary>
                                <p>
                                    &nbsp;Nesta página você tem acesso à todo controle do conteúdo do seu site.
                                </p>
                            </details>
                        </div>
                    </div>
                    <!-- LEGENDAS, ORIENTAÇÕES GERAIS DO CMS -->
                    <div id="legendas-geral">
                        <!-- ORIENTAÇÕES SOBRE PAGINA DE ADMINISTRAÇÃO DE CONTEUDO -->
                        <div class="main-title-legenda">
                            <figure>
                                <img class="main-img-legenda" alt="Administrar Fale Conosco" title="Administrar Fale Conosco" src="icons/contact.png">
                            </figure>
                            <h3>Administrar Fale Conosco</h3>
                            <details class="detalhes">
                                <summary>Detalhes</summary>
                                <p>
                                    &nbsp;Permite a visualização das mensagens de clientes que foram enviadas na página "Fale Conosco" do site.
                                </p>
                            </details>
                        </div>
                        <!-- LEGANDA DO ICONE DE VISUALIZAÇÃO DEMENSAGEM DE CLIENTE -->
                        <div class="sub-subtitle-legenda">
                            <figure>
                                <img class="sub-sub-img-legenda" alt="Visualizar Mensagem de Cliente" title="Visualizar Mensagem de Cliente" src="icons/view.png">
                            </figure>
                            <h5>Visualizar detalhes da Mensagem</h5>
                        </div>

                        <!-- ORIENTAÇÕES SOBRE PAGINA DE ADMINISTRAÇÃO DE CONTEUDO -->
                        <div class="main-title-legenda">
                            <figure>
                                <img class="main-img-legenda" alt="Administrar Produtos" title="Administrar Produtos" src="icons/product.png">
                            </figure>
                            <h3>Administrar Produtos</h3>
                            <details class="detalhes">
                                <summary>Detalhes</summary>
                                <p>
                                    &nbsp;Página de visualização das mensagens de clientes que foram enviadas na página "Fale Conosco" do site.
                                </p>
                            </details>
                        </div>
                        <!-- ORIENTAÇÕES SOBRE PAGINA DE ADMINISTRAÇÃO DE CONTEUDO -->
                        <div class="main-title-legenda">
                            <figure>
                                <img class="main-img-legenda" alt="Administrar Usuários" title="Administrar Usuários" src="icons/users.png">
                            </figure>
                            <h3>Administrar Usuários</h3>
                            <details class="detalhes">
                                <summary>Detalhes</summary>
                                <p>
                                    &nbsp;Administração dos níveis de usuários com suas permissões, e o cadastro de novos usuários.
                                </p>
                            </details>
                        </div>

                    <!-- LEGENDA DE ICONES GERAIS DO CMS -->

                        <!-- LEGENDA DO ICONE DE EDITAR E VISUALIZAR REGISTRO -->
                        <div class="sub-subtitle-legenda">
                            <figure>
                                <img class="sub-sub-img-legenda" alt="Visualizar e Editar Registro" title="Visualizar e Editar Registro" src="icons/edit.png">
                            </figure>
                            <h5>Visualizar e Editar Registro</h5>
                        </div>
                        <!-- LEGENDA DO ICONE DE EXCLUIR REGISTRO -->
                        <div class="sub-subtitle-legenda">
                            <figure>
                                <img class="sub-sub-img-legenda" alt="Excluir Registro" title="Excluir Registro" src="icons/trash.png">
                            </figure>
                            <h5>Excluir Registro</h5>
                        </div>
                        <!-- LEGENDA DO ICONE DE QUE MOSTRA SE O REGISTRO ESTA ATIVADO -->
                        <div class="sub-subtitle-legenda">
                            <figure>
                                <img class="sub-sub-img-legenda" alt="Registro está Ativado" title="Registro está Ativo" src="icons/ativado.png">
                            </figure>
                            <h5>Registro está Ativado</h5>
                        </div>
                        <!-- LEGENDA DO ICONE DE QUE MOSTRA SE O REGISTRO ESTE DESATIVADO -->
                        <div class="sub-subtitle-legenda">
                            <figure>
                                <img class="sub-sub-img-legenda" alt="Registro está Desativado" title="Registro está Desativado" src="icons/desativado.png">
                            </figure>
                            <h5>Registro está Desativado</h5>
                        </div>
                        <!-- LEGENDA DO ICONE DE FECHAR A JANELA (MODAL) -->
                        <div class="sub-subtitle-legenda">
                            <figure>
                                <img class="sub-sub-img-legenda" alt="Fechar Janela" title="Fechar Janela" src="icons/close.png">
                            </figure>
                            <h5>Fechar Janela</h5>
                        </div>
                    </div>
                    <h3>*ESTA PÁGINA PODE SER ACESSADO A QUALQUER MOMENTO CLICANDO NA IMAGEM NO CABEÇALHO DA PÁGINA</h3>
                </div>
            </div>
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('footer.html');
            ?>
    </div>
    </body>
</html>