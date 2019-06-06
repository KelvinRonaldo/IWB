<?php

    require_once ('./verificarUsuario.php');// VERIFICAR SE USUARIO ESTA LOGADO

//    VERIFICAR SE O USUARIO LOGADO TEM PERMISSÃO PARA ACESSAR ESTA PÁGINA
    if($_SESSION['adm_usuario'] == 'ativado'){

        // FAZENDO CONEXAO COM BANCO DE DADOS
        require_once('../bd/conexao.php');
        $conexao = conexaoMySql();

        if(isset($_GET['btn_enviar_nivel'])){// SE O BOTÃO DE ENVIAR O NIVEL DE USUARIO FOR CLICADO, ENTRA NA CONDIÇÃO DE INSERIR UM NOVO NÍVEL
            if(isset($_GET['txt_nome_nivel'])){ // O NOME DO NÍVEL DEVE EXISTIR
                if($_GET['txt_nome_nivel'] != null){ // O NOME DO NÍVEL NÃO PODE SER NULO
                    if(isset($_GET['itr_conteudo']) || isset($_GET['itr_fale_conosco']) ||
                        isset($_GET['itr_produtos']) || isset($_GET['itr_usuarios'])){ // O NÍVEL DEVE POSSUIR PELO MENOS UMA PERMISSÃO
                        $nomeNivel = $_GET['txt_nome_nivel'];
                        // SE VERIFICA QUAL PERMISSÃO EXISTE, ONDE O RESULTADO FOR POSITIVO, INSERE ativado NA VARIÁVEL
                        // CASO CONTRÁRIO INSERE desativado
                        $permissaoConteudos = isset($_GET['itr_conteudo']) ? 'ativado' : 'desativado';
                        $permissaoFaleConosco = isset($_GET['itr_fale_conosco']) ? 'ativado' : 'desativado';
                        $permissaoProdutos = isset($_GET['itr_produtos']) ? 'ativado' : 'desativado';
                        $permissaoUsuarios = isset($_GET['itr_usuarios']) ? 'ativado' : 'desativado';

//                        SCRIPT SQL QUE INSERE OS DADOS RESGATADOS DA REQUISIÇÃO NO BANCO
                        $sql = "INSERT INTO tbl_nivel_usuario (nivel, adm_conteudo, adm_fale_conosco, adm_produto, adm_usuario)
                                VALUES ('".addslashes($nomeNivel)."', '".$permissaoConteudos."', '".$permissaoFaleConosco."', '".$permissaoProdutos."', '".$permissaoUsuarios."')";

//                        CASO HAJA ALGUM ERRO NO CÓDIGO SQL, EXPORTA O SCRIPT SQL PARA VERIFICAÇÃO DO ERRO
                        if(mysqli_query($conexao, $sql)){
                            header("location: cmsUsuarios.php");
                        }else{
                            echo $sql;
                        }
                    }else{
                        echo("<script>alert('AO MENOS UMA PERMISSÃO DEVE SER ATRIBUÍDA AO NÍVEL.')</script>");
                    }
                }else{
                    echo("<script>alert('O NÍVEL DE USUÁRIO DEVE TER UMA DENOMINAÇÃO.')</script>");
                }
            }
        }
        if(isset($_GET['btn_atualizar_nivel'])){// SE O BOTÃO DE ENVIAR O NIVEL DE USUARIO FOR CLICADO, ENTRA NA CONDIÇÃO DE ATUALIZAR O NÍVEL
            if(isset($_GET['txt_nome_nivel'])){ // O NOME DO NÍVEL DEVE EXISTIR
                if($_GET['txt_nome_nivel'] != null){ // O NOME DO NÍVEL NÃO PODE SER NULO
                    if(isset($_GET['itr_conteudo']) || isset($_GET['itr_fale_conosco']) ||
                        isset($_GET['itr_produtos']) || isset($_GET['itr_usuarios'])){ // O NIVEL DEVE TER AO MENOS UMA PERMISSÃO
                        $nomeNivel = $_GET['txt_nome_nivel'];
                        // SE VERIFICA QUAL PERMISSÃO EXISTE, ONDE O RESULTADO FOR POSITIVO, INSERE ativado NA VARIÁVEL
                        // CASO CONTRÁRIO INSERE desativado
                        $permissaoConteudos = isset($_GET['itr_conteudo']) ? 'ativado' : 'desativado';
                        $permissaoFaleConosco = isset($_GET['itr_fale_conosco']) ? 'ativado' : 'desativado';
                        $permissaoProdutos = isset($_GET['itr_produtos']) ? 'ativado' : 'desativado';
                        $permissaoUsuarios = isset($_GET['itr_usuarios']) ? 'ativado' : 'desativado';

//                        SCRIPT SQL QUE INSERE OS DADOS RESGATADOS DA REQUISIÇÃO NO BANCO
                        $sql = "UPDATE tbl_nivel_usuario SET nivel = '".addslashes($nomeNivel)."', adm_conteudo = '".$permissaoConteudos."', 
                                        adm_fale_conosco = '".$permissaoFaleConosco."', adm_produto = '".$permissaoProdutos."', 
                                        adm_usuario = '".$permissaoUsuarios."' 
                                WHERE cod_nivel_usuario = ".$_SESSION['cod_nivel_usuario_atual'];

//                        CASO HAJA ALGUM ERRO NO CÓDIGO SQL, EXPORTA O SCRIPT SQL PARA VERIFICAÇÃO DO ERRO
                        if(mysqli_query($conexao, $sql)){
                             header("location: cmsUsuarios.php");
                        }else{
                            echo 'erro'. $sql;
                        }
                    }else{
                        echo("<script>alert('AO MENOS UMA PERMISSÃO DEVE SER ATRIBUÍDA AO NÍVEL.')</script>");
                    }
                }else{
                    echo("<script>alert('O NÍVEL DE USUÁRIO DEVE TER UMA DENOMINAÇÃO.')</script>");
                }
            }
        }

        if(isset($_POST['btn_enviar_user'])){// SE O BOTÃO DE ENVIAR O USUARIO FOR CLICADO, ENTRA NA CONDIÇÃO DE INSERIR UM NOVO USUARIO
            if(isset($_POST['txt_username_user']) && isset($_POST['txt_nome_user']) &&
                isset($_POST['txt_email_user']) && isset($_POST['txt_senha_user']) &&
                isset($_POST['slt_nivel_user'])){ // DADOS OBRIGATÓRIOS PARA CADASTRO DE USUÁRIO

                if(!empty($_POST['txt_username_user']) && !empty($_POST['txt_nome_user']) &&
                    !empty($_POST['txt_email_user']) && !empty($_POST['txt_senha_user']) &&
                    !empty($_POST['slt_nivel_user'])){ // DADOS DE CADASTRO DE USUÁRIO NÃO PODE SER NULOS

                    $userName = trim($_POST['txt_username_user']);
                    $nome = trim($_POST['txt_nome_user']);
                    $email = trim($_POST['txt_email_user']);
                    $senha = trim(hash('sha512', $_POST['txt_senha_user']));
                    $codNivelUsuario = $_POST['slt_nivel_user'];

//                        SCRIPT SQL QUE INSERE OS DADOS RESGATADOS DA REQUISIÇÃO NO BANCO
                    $sql = "INSERT INTO tbl_usuario (nome_usuario, nome, email, senha, cod_nivel_usuario)
                            VALUES ('".addslashes($userName)."', '".addslashes($nome)."', '".addslashes($email)."', '".addslashes($senha)."', '".$codNivelUsuario."')";

//                        CASO HAJA ALGUM ERRO NO CÓDIGO SQL, EXPORTA O SCRIPT SQL PARA VERIFICAÇÃO DO ERRO
                    if(mysqli_query($conexao, $sql)){
                        header("location: cmsUsuarios.php");
                    }else{
                        echo 'erro '.$sql;
                    }
                }else{
                    echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS OU ITENS NÃO SELECIONADOS.')</script>");
                }
            }else{
                echo("<script>alert('HÁ ALGO QUE NAO EXISTEM!')</script>");
            }
        }

        if(isset($_POST['btn_atualizar_user'])){// SE O BOTÃO DE ENVIAR  USUARIO FOR CLICADO, ENTRA NA CONDIÇÃO DE ATUALIZAR O USUARIO
            if(isset($_POST['txt_username_user']) && isset($_POST['txt_nome_user']) &&
                isset($_POST['txt_email_user']) && isset($_POST['txt_senha_user']) &&
                isset($_POST['slt_nivel_user'])){// DADOS OBRIGATÓRIOS PARA CADASTRO DE USUÁRIO

                if(!empty($_POST['txt_username_user']) && !empty($_POST['txt_nome_user']) &&
                    !empty($_POST['txt_email_user']) && !empty($_POST['txt_senha_user']) &&
                    !empty($_POST['slt_nivel_user'])){// DADOS DE CADASTRO DE USUÁRIO NÃO PODE SER NULOS

                    $userName = trim($_POST['txt_username_user']);
                    $nome = trim($_POST['txt_nome_user']);
                    $email = trim($_POST['txt_email_user']);
                    $senha = trim(hash('sha512', $_POST['txt_senha_user']));
                    $codNivelUsuario = $_POST['slt_nivel_user'];

//                        SCRIPT SQL QUE INSERE OS DADOS RESGATADOS DA REQUISIÇÃO NO BANCO
                    $sql = "UPDATE tbl_usuario SET nome_usuario = '".addslashes($userName)."', nome = '".addslashes($nome)."',
                    email = '".addslashes($email)."', senha = '".addslashes($senha)."', cod_nivel_usuario = '".$codNivelUsuario."'
                    WHERE cod_usuario = ".$_SESSION['cod_usuario_atual'];

                }elseif(!empty($_POST['txt_username_user']) && !empty($_POST['txt_nome_user']) &&
                    !empty($_POST['txt_email_user']) && empty($_POST['txt_senha_user']) &&
                    !empty($_POST['slt_nivel_user'])){

                    $userName = trim($_POST['txt_username_user']);
                    $nome = trim($_POST['txt_nome_user']);
                    $email = trim($_POST['txt_email_user']);
                    $codNivelUsuario = $_POST['slt_nivel_user'];

                    $sql = "UPDATE tbl_usuario SET nome_usuario = '".addslashes($userName)."', nome = '".addslashes($nome)."',
                    email = '".addslashes($email)."', cod_nivel_usuario = '".$codNivelUsuario."'
                    WHERE cod_usuario = ".$_SESSION['cod_usuario_atual'];

                }else{
                    echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS OU ITENS NÃO SELECIONADOS.')</script>");
                }

//                        CASO HAJA ALGUM ERRO NO CÓDIGO SQL, EXPORTA O SCRIPT SQL PARA VERIFICAÇÃO DO ERRO
                if(mysqli_query($conexao, $sql)){
                    header("location: cmsUsuarios.php");
                }else{
                    echo '<br>erro '.$sql;
                }
                $_SESSION['cod_usuario_atual'] = null;
            }else{
                echo("<script>alert('HÁ ALGO QUE NAO EXISTE!')</script>");
            }
        }


        if(isset($_GET['modo'])){// SE A VARIÁVEL MODO EXISTIR, ENTRA NO CÓDIGO DE EXCLUIR NÍVEL OU USUÁRIO
            if($_GET['modo'] == 'excluirUser'){ //SE modo FOR IGUAL A excluirUser ENTRA NO CÓDIGO DE EXCLUIR O USUARIO
                if($_GET['codigo'] != $_SESSION['cod_usuario'] && $_GET['codigo'] != 1){// O CODIGO DO USER A SER EXCLUIDO NÃO PODE SER O CODIGO DO USUARIO LOGADO OU DO ADM MASTER
                    $codUsuario = $_GET['codigo'];

//                    SCRIPT SQL QUE EXCLUI USUARIO DO BANCO
                    $sql = "DELETE FROM tbl_usuario WHERE cod_usuario = ".$codUsuario;


                    if(mysqli_query($conexao, $sql)){
                        header("location: cmsUsuarios.php");
                        echo $sql;
                    }else{
                        echo 'erro --> '.$sql;
                    }
                }elseif($_GET['codigo'] == 1){ //SE O CODIGO DO USUARIO FOR 1(CODIGO DO ADM MASTER) RETORNA UMA MENSAGEM DE ERRO E ENCERRA O SCRIPT
                    echo
                    "<script>
                        alert('USUÁRIO ADMINISTRADOR NÃO PODE SER EXCLUÍDO.');
                        window.history.back();
                    </script>";
                    exit(0);
                }else{// CASO O CODIGO DE USUARIO SEJA O CODIGO DO USUARIO LOGADO,RETORNA UMA MENSAGEM DE ERRO E ENCERRA O SCRIPT
                    echo
                    "<script>
                        alert('USUÁRIO ATUALMENTO LOGADO, PORTANTO NÃO PODE SER EXCLUÍDO.');
                        window.history.back();
                    </script>";
                    exit(0);
                }
            }elseif($_GET['modo'] == 'excluirNivel'){//SE modo FOR IGUAL A excluirNivel ENTRA NO CÓDIGO DE EXCLUIR O NIVEL
                if ($_GET['codigo'] != $_SESSION['cod_nivel_usuario'] && $_GET['codigo'] != 1) {// O CODIGO DO NÍVEL A SER EXCLUIDO NÃO PODE SER O CODIGO DO NIVEL DE USUARIO DO USUARIO LOGADO OU DO ADM MASTER
                    $codNivelUsuario = $_GET['codigo'];
//                    SCRIPT SQL QUE EXCLUI USUARIO DO BANCO
                    $sql = "DELETE FROM tbl_nivel_usuario WHERE cod_nivel_usuario = ".$codNivelUsuario;

//                        CASO HAJA ALGUM ERRO NO CÓDIGO SQL, EXPORTA O SCRIPT SQL PARA VERIFICAÇÃO DO ERRO
                    if(mysqli_query($conexao, $sql)){
                        header('location: cmsUsuarios.php');
                    }else{
                        "<script>
                            alert('HÁ USUÁRIOS COM ESTE NÍVEL, PARA EXCLUÍ-LO, EXCLUA O USUÁRIO PRIMEIRO.');
//                            location.reload();
                        </script>";
                    }
                }elseif ($_GET['codigo'] == 1){ //SE O CODIGO DO NIVEL DE USUARIO FOR 1(CODIGO DO ADM MASTER) RETORNA UMA MENSAGEM DE ERRO E ENCERRA O SCRIPT
                    echo
                    "<script>
                        alert('NÍVEL DE USUÁRIO ADMINISTRADOR NÃO PODE SER EXCLUÍDO.');
                        window.history.back();
                    </script>";
                    exit(0);
                }elseif($_GET['codigo'] == $_SESSION['cod_nivel_usuario']){ // CASO O CODIGO DE NIVEL DE USUARIO SEJA O CODIGO DO USUARIO LOGADO,RETORNA UMA MENSAGEM DE ERRO E ENCERRA O SCRIPT
                    echo
                    "<script>
                        alert('USUÁRIO ATUALMENTE LOGADO POSSUI ESSE NÍVEL, PORTANTO NÃO PODE SER EXCLUÍDO');
                        window.history.back();
                    </script>";
                    exit(0);
                }
            }
        }
        ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/fontes.css">
        <title>ADMINISTRAR USUÁRIOS </title>
        <meta charset="utf-8">
        <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
        <script src="./js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.visualizar-nivel').click(function(){
                    $('#container-nivel').fadeIn(300);
                });
                $('.visualizar-user').click(function(){
                    $('#container-user').fadeIn(300);
                });
            });

            // FUNÇÃO DE VISUALIZAÇÃO DA MODAL DE ATUALIZAR O NIVEL DE USUÁRIO
            function viewModalAtualizarNivel(codNivelUsuario){
                $.ajax({
                    type: 'Get',
                    url: './modais/atualizarNivel.php',
                    data: {codigo: codNivelUsuario},
                    success: function(dados){
                        $('#modal-nivel-usuario').html(dados);
                    }
                });
            }
            // FUNÇÃO DE VISUALIZAÇÃO DA MODAL DE ATUALIZAR O USUÁRIO
            function viewModalAtualizarUser(codUsuario, codNivelUsuario){
                $.ajax({
                    type: 'Get',
                    url: './modais/atualizarUser.php',
                    data: {codUsuario: codUsuario, codNivelUsuario: codNivelUsuario},
                    success: function(dados){
                        $('#modal-user').html(dados);
                    }
                });
            }
            // FUNÇÃO DE TROCA DE STATUS DE NIVEL DE USUARIO
            function ativarDesativarNivel(codNivelUsuario, status, nivel){
                $.ajax({
                    type: 'Get',
                    url: './status.php',
                    data: {pagina: 'nivel_usuario', codigo: codNivelUsuario, status: status, nivel: nivel},
                    complete: function (response) {
                        location.reload();
                    },
                    error: function(){

                    }
                });
            }
            // FUNÇÃO QUE TROCA O STATUS DO USUARIO
            function ativarDesativarUser(codUsuario, status){
                $.ajax({
                    type: 'Get',
                    url: './status.php',
                    data: {pagina: 'usuario', codigo: codUsuario, status: status},
                    complete: function (response) {
                        alert(response.responseText);
                        location.reload();
                    },
                    error: function(){

                    }
                });
            }

            // FUNÇÃO DE CONFIRMAÇÃO DE EXCLUSÃO DO NÍVEL DE USUARIO
            function confirmarExclusaoNivel(nivelUsuario){
                return confirm(`Deseja mesmo excluir ${nivelUsuario}?`);
            }
            // FUNÇÃO DE CONFIRMAÇÃO DE EXCLUSÃO DO USUARIO
            function confirmarExclusaoUser(userName){
                return confirm(`Deseja mesmo excluir ${userName}?`);
            }

        </script>
    </head>
    <body>
    <!-- CONTAINER DE MODAIS DE ATUALIZAÇÃO DE USUARIO E NIVEL DE USUARIO -->
        <div id="container-nivel">
            <div id="modal-nivel-usuario" class="center">

            </div>
        </div>
        <div id="container-user">
            <div id="modal-user" class="center">

            </div>
        </div>
        <!-- AREA DE TODO O CONTEUDO DA PAGINA -->
        <div id="tudo">
            <!-- IMPORTANDO ARQUIVO COM HEADER DA PAGINA -->
            <?php
                require_once('./header.html');
            ?>
            <div id="menu" class="center flexbox">
                <!-- IMPORTANDO ARQUIVO COM MENU DA PAGINA -->
                <?php
                    require_once('./menu.php');
                ?>
            </div>
            <!-- AREA COM O CONTEUDO DA PAGINA -->
            <div id="conteudo-usuario">
<!--                BOTOES DE SELEÇÃO DO QUE SERÁ CADASTRADO (NIVEL DE USUARIO E USUARIO)-->
                <div id="menu-usuario">
                    <ul id="caixa-menu-usuario" class="flexbox">
                        <li id="selecao-nivel" class="item-menu-usuario flexbox">Níveis de Usuário</li>
                        <li id="selecao-usuario" class="item-menu-usuario flexbox">Usuários</li>
                    </ul>
                </div>
<!--                AREA DE CADASTRO E VISUALIZAÇÃO DE NIVEIS DE USUARIO-->
                <div id="container-nivel-usuario">
                    <form name="frm_niveis" method="get" action="cmsUsuarios.php">
                        <div id="container-add-nivel">
                            <div id="nome-nivel" class="flexbox">
                                <h3><label>Nome Nível:</label></h3>
                                <input maxlength="30" type="text" id="txt-nome-nivel" name="txt_nome_nivel" required> <!-- CAMPO DE NOME DO NÍVEL -->
                            </div>
                            <h3><label>PERMISSÕES:</label></h3>
                            <hr>
<!--                            AREA DE SELEÇÃO DE PERMISSÕES DO NIVEL DE USUARIO-->
                            <div id="container-permissoes">
                                <div class="caixas-permissoes flexbox">
                                    <h3><label>Conteúdos:</label></h3>
                                    <div class="on-off-adm-conteudos"> <!-- ATIVAR PERMISSÃO DE GERENCIAMENTO DE CONTEÚDO -->
                                        <input type="checkbox" name="itr_conteudo" class="interruptores" id="on-off-conteudos">
                                        <label class="lbl-interruptores" for="on-off-conteudos"></label>
                                    </div>
                                </div>
                                <div class="caixas-permissoes flexbox">
                                    <h3><label>Fale Conosco:</label></h3>
                                    <div class="on-off-adm-conteudos"> <!-- ATIVAR PERMISSÃO DE GERENCIAMENTO DDO FALE CONOSCO -->
                                        <input type="checkbox" name="itr_fale_conosco" class="interruptores" id="on-off-fale-conosco">
                                        <label class="lbl-interruptores" for="on-off-fale-conosco"></label>
                                    </div>
                                </div>
                                <div class="caixas-permissoes flexbox">
                                    <h3><label>Produtos:</label></h3>
                                    <div class="on-off-adm-conteudos"> <!-- ATIVAR PERMISSÃO DE GERENCIAMENTO DE PRODUTOS -->
                                        <input type="checkbox" name="itr_produtos" class="interruptores" id="on-off-produtos">
                                        <label class="lbl-interruptores" for="on-off-produtos"></label>
                                    </div>
                                </div>
                                <div class="caixas-permissoes flexbox">
                                    <h3><label>Usuários:</label></h3>
                                    <div class="on-off-adm-conteudos"> <!-- ATIVAR PERMISSÃO DE GERENCIAMENTO DE USUÁRIOS -->
                                        <input type="checkbox" name="itr_usuarios" class="interruptores" id="on-off-usuarios">
                                        <label class="lbl-interruptores" for="on-off-usuarios"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="caixa-btn-nivel" class="flexbox">  <!-- BOTÕES DE ENVIO E CANCELAMENTO DO FORMULÁRIO -->
                                <input type="submit" name="btn_enviar_nivel" class="btn-confirmacao" id="btn-enviar-nivel" value="ENVIAR"><!-- CAMPO DO CEP -->
                                <input type="button" class="btn-cancelar" id="btn-cancelar-nivel" value="CANCELAR"> <!-- CANCELAR INSERÇÃO -->
                            </div>
                        </div>
                    </form>
                    <!-- BOTAO ATIVAÇÃO DA CAIXA DE ADICIONAR USUARIO -->
                    <input type="button" name="btn_add_nivel" class="btn-confirmacao" id="btn-add-nivel" value="ADICIONAR">
                    <!-- AREA DA TABELA DE NIVEIS DE USUARIO -->
                    <div id="container-table-nivel">
                        <div id="tabela-nivel">
                            <table id="table-nivel">
                                <tr class="table-titles">
                                    <th class="title-vazio"></th>
                                    <th colspan="4" id="title-permissoes">PERMISSÕES</th>
                                    <th colspan="3" class="title-vazio"></th>
                                </tr>
                                <tr class="table-titles">
                                    <th class="title-nome-nivel">Nível</th>
                                    <th class="title-conteudo">Conteúdos</th>
                                    <th class="title-fale-conosco">Fale Conosco</th>
                                    <th class="title-produto">Produtos</th>
                                    <th class="title-usuarios">Usuários</th>
                                    <th class="title-editar">Editar</th>
                                    <th class="title-excluir">Excluir</th>
                                    <th class="title-status">Status</th>
                                </tr>
                                <?php
                                //SCRIPT SQL QUE TRAZ TODOS OS NÍVES JA ADICIONADOS NO BANCO
                                $sql = "SELECT * FROM tbl_nivel_usuario ORDER BY cod_nivel_usuario DESC";
                                $select = mysqli_query($conexao, $sql);

                                while($rsNivel = mysqli_fetch_array($select)) {
                                    $codNivelUsuario = $rsNivel['cod_nivel_usuario'];
                                    $nomeNivel = $rsNivel['nivel'];
                                    $nivel = "'".$rsNivel['nivel']."'";
                                    $nivelExcluir = "'".$nomeNivel."'";
                                    $admConteudo = $rsNivel['adm_conteudo'];
                                    $admFaleConosco = $rsNivel['adm_fale_conosco'];
                                    $admProdutos = $rsNivel['adm_produto'];
                                    $admUsuarios = $rsNivel['adm_usuario'];
//                                    AO TRAZER DO BANCO, VERIFICA-SE SE O STATUS É ATIVADO, SE SIM, A VARIÁVEL RECEBE DESATVADO PARA
//                                    QUE QUANDO SEU STATUS SEJA MODIFICADO, ELE SE TORNE DESATIVADO
                                    $nextStatus = $rsNivel['status'] == 'ativado' ? "'desativado'" : "'ativado'";

//                                    CRIANDO VARIÁVEL QUE SERÁ O ATRIBUTO alt E title DOS ICOS DE ativado E dasativado NA VISUALIZAÇÃO DE PERMISSÕES NA TABELA
                                    $altTitle = $rsNivel['status'] == 'ativado' ? 'Desativar Registro '.$codNivelUsuario : 'Ativar Registro '.$codNivelUsuario;
                                    $altTitleConteudo = 'Gerenciamento de Conteúdo '.strtoupper($admConteudo).' para '.$nomeNivel;
                                    $altTitleFaleConosco = 'Gerenciamento de Fale Conosco '.strtoupper($admFaleConosco).' para '.$nomeNivel;
                                    $altTitleProdutos = 'Gerenciamento de Produtos '.strtoupper($admProdutos).' para '.$nomeNivel;
                                    $altTitleUsuarios = 'Gerenciamento de Usuários '.strtoupper($admUsuarios).' para '.$nomeNivel;
                                    $img = $rsNivel['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-nome-nivel"><?php echo $nomeNivel; ?></td>
                                    <td class="txt-conteudo">
                                        <img alt="<?php echo $altTitleConteudo ?>" title="<?php echo $altTitleConteudo ?>" class="on-off-nivel" src="./icons/<?php echo($admConteudo.".png"); ?>">
                                    </td>
                                    <td class="txt-fale-conosco">
                                        <img alt="<?php echo $altTitleFaleConosco ?>" title="<?php echo $altTitleFaleConosco ?>" class="on-off-nivel" src="./icons/<?php echo($admFaleConosco.".png"); ?>">
                                    </td>
                                    <td class="txt-produto">
                                        <img alt="<?php echo $altTitleProdutos ?>" title="<?php echo $altTitleProdutos ?>" class="on-off-nivel" src="./icons/<?php echo($admProdutos.".png"); ?>">
                                    </td>
                                    <td class="txt-usuarios">
                                        <img alt="<?php echo $altTitleUsuarios ?>" title="<?php echo $altTitleUsuarios ?>" class="on-off-nivel" src="./icons/<?php echo($admUsuarios.".png"); ?>">
                                    </td>
                                    <!-- BOTAO DE EDIÇÃO DE NIVEL DE USUARIO -->
                                    <td class="txt-editar">
                                        <figure>
                                            <img class="icon-edit visualizar-nivel" onclick="viewModalAtualizarNivel(<?php echo $codNivelUsuario; ?>)" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codNivelUsuario ?>" title="<?php echo 'Editar Registro '.$codNivelUsuario ?>">
                                        </figure>
                                    </td>
                                    <!-- BOTAO DE EXCLUSAO DE NIVEL DE USUARIO -->
                                    <td class="txt-excluir">
                                        <a href="?modo=excluirNivel&codigo=<?php echo $codNivelUsuario ?>">
                                            <figure>
                                                <img class="icon-del" onclick="return confirmarExclusaoNivel(<?php echo $nivelExcluir; ?>)" src="./icons/trash.png" alt="<?php echo 'Exluir Registro '.$codNivelUsuario ?>" title="<?php echo 'Exluir Registro '.$codNivelUsuario ?>">
                                            </figure>
                                        </a>
                                    </td>
                                    <!-- BOTAO DE TROCA DE STATUS DE NIVEL DE USUARIO -->
                                    <td class="txt-status">
                                        <figure>
                                            <img onclick="ativarDesativarNivel(<?php echo($codNivelUsuario.', '.$nextStatus.', '.$nivel); ?>)" class="icon-status" src="./icons/<?php echo $img ?>" alt="<?php echo $altTitle ?>" title="<?php echo $altTitle ?>">
                                        </figure>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>

<!--                AREA DE CADASTRO E TABELA DE VISUALIZAÇÃO DE USUÁRIOS-->
                <div id="container-users">
                    <form name="frm_user" action="cmsUsuarios.php" method="post">
                        <div id="container-add-user" class="flexbox">
                            <div id="username-user" class="flexbox">
                                <h3><label>Nome de Usuário (Login):</label></h3>
                                <input maxlength="30" required type="text" id="txt-username-user" name="txt_username_user"><!-- CAMPO NOME DE USUARIO -->
                            </div>
                            <div id="nome-user" class="flexbox">
                                <h3><label>Nome:</label></h3>
                                <input maxlength="45" required type="text" id="txt-nome-user" name="txt_nome_user"><!-- CAMPOS NOME -->
                            </div>
                            <div id="email-user" class="flexbox">
                                <h3><label>E-mail:</label></h3>
                                <input maxlength="100" required type="email" id="txt-email-user" name="txt_email_user"><!-- CAMPO EMAIL -->
                            </div>
                            <div id="senha-user" class="flexbox">
                                <h3><label>Senha:</label></h3>
                                <input minlength="5" required type="password" id="txt-senha-user" name="txt_senha_user"><!-- CAMPO SENHA -->
                            </div>
                            <div id="confirmar-senha-user" class="flexbox">
                                <h3><label>Confirmar Senha:</label></h3>
                                <input minlength="5" required type="password" id="txt-confirmar-senha-user"><!-- CAMPO CONFIRMAR SENHA -->
                            </div>
                            <div id="nivel-user" class="flexbox">
                                <h3><label>Nível de Usuário:</label></h3>
                                <select required id="slt-nivel-user" name="slt_nivel_user"><!-- CAMPO SELECAO DE NIVEL DE USUARIO -->
                                    <option value="">Escolher Nível</option>
                                    <?php
                                    //SCRIPT SQL QUE TRAZ TODOS NIVEL USUARIOS PARA A SELEÇÃO
                                        $sql = "SELECT * FROM tbl_nivel_usuario;";

                                        $select = mysqli_query($conexao, $sql);

                                        while($rsUsers = mysqli_fetch_array($select)) {
                                            $nomeNivelUser = $rsUsers['nivel'];
                                            $codNivelUser = $rsUsers['cod_nivel_usuario'];
                                    ?>
                                    <option value="<?php echo $codNivelUser ?>"><?php echo $nomeNivelUser ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div id="caixa-btn-user" class="flexbox"><!-- BOTOES DE ENVIO E CANCELAMENTO DE USUARIO -->
                                <input type="submit" onclick="return confirmarSenha()" name="btn_enviar_user" class="btn-confirmacao" id="btn-enviar-user" value="ENVIAR">
                                <input type="button" class="btn-cancelar" id="btn-cancelar-user" value="CANCELAR">
                            </div>
                        </div>
                    </form>
                    <!-- BOTAO DE ATIVAÇÃO DO FORMULARIO DE CADASTRO DE USUARIO -->
                    <input type="button" name="btn_add_user" class="btn-confirmacao" id="btn-add-user" value="ADICIONAR">
                    <!-- AREA DE TABELA DE VISUALIZAÇÃO DE USUARIOS -->
                    <div id="container-table-user">
                        <div id="tabela-user">
                            <table id="table-user">
                                <tr class="table-titles">
                                    <th class="title-username">Nome de Usuário (Login)</th>
                                    <th class="title-email">E-mail</th>
                                    <th class="title-editar">Editar</th>
                                    <th class="title-excluir">Excluir</th>
                                    <th class="title-status">Status</th>
                                </tr>
                                <?php
                                //SCRIPT SQL QUE TRAZ TODOS USUARIO DO BANCO PARA VISUALIZAÇÃO NA TABELA
                                    $sql = "SELECT * FROM tbl_usuario ORDER BY cod_usuario DESC";
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsUser = mysqli_fetch_array($select)) {
                                        $codUsuario = $rsUser['cod_usuario'];
                                        $codNivelUser = $rsUser['cod_nivel_usuario'];
                                        $userName = $rsUser['nome_usuario'];
                                        $email = $rsUser['email'];
//                                        SE O STATUS VIER ATIVADO, A VARIÁVEL RECEBE O CONTRARIO, PARA QUE QUANDO O BOTAO DE TROCA DE STATUS SEJA CLICADO,
//                                        ENVIE O O NOVO STATUS PARA O SCRIPT DE TROCA
                                        $status = $rsUser['status'] == 'ativado' ? "'desativado'" : "'ativado'";

//                                        CRIANDO VARIÁVEL QUE SERÁ OS ATRIBUTOS alt E title NA IMAGEM(BOTAO) DE TROCA DE STATUS
                                        $altTitle = $rsUser['status'] == 'ativado' ? 'Desativar Registro '.$codUsuario : 'Ativar Registro '.$codUsuario;
                                        $img = $rsUser['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-username"><?php echo $userName ?></td>
                                    <td class="txt-email"><?php echo $email ?></td>
                                    <!-- BOTAO DE EDIÇÃO DO USUARIO -->
                                    <td class="txt-editar">
                                        <figure>
                                            <img class="icon-edit visualizar-user" onclick="viewModalAtualizarUser(<?php echo $codUsuario.', '.$codNivelUser ?>)" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codUsuario ?>" title="<?php echo 'Editar Registro '.$codUsuario ?>">
                                        </figure>
                                    </td>
                                    <!-- BOTAO DE EXCLUSAO DE USUARIO -->
                                    <td class="txt-excluir">
                                        <a href="?modo=excluirUser&codigo=<?php echo $codUsuario ?>">
                                            <figure>
                                                <img class="icon-del" onclick="return confirmarExclusaoUser(<?php echo "'".$userName."'" ?>)" src="./icons/trash.png" alt="<?php echo 'Exluir Registro '.$codUsuario ?>" title="<?php echo 'Exluir Registro '.$codUsuario ?>">
                                            </figure>
                                        </a>
                                    </td>
                                    <!-- BOTAO DE TROCA DE STATUS DE USUARIO -->
                                    <td class="txt-status">
                                        <figure>
                                            <img onclick="ativarDesativarUser(<?php echo($codUsuario.', '.$status); ?>)" class="icon-status" src="./icons/<?php echo $img ?>" alt="<?php echo $altTitle ?>" title="<?php echo $altTitle ?>">
                                        </figure>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('./footer.html');
            ?>
        </div>
        <script src="./js/cmsUsuario.js"></script><!-- SCRIPT QUE GERENCIA TROCA DE TELAS DE CASDASTRO DE NIVEL DE USUARIO E USUARIO -->
        <script src="./js/confirmarSenha.js"></script><!-- SCRIPT QUE GERENCIA CONFIRMAÇÃO DE SENHA -->
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