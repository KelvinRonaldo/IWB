<?php

//    TERMINAR ESQUEMA DOS STUS, E FAZER CRUD DO USUARIO


    require_once ('./verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    if(isset($_GET['btn_enviar_nivel'])){
        if(isset($_GET['txt_nome_nivel'])){
            if($_GET['txt_nome_nivel'] != null){
                if(isset($_GET['itr_conteudo']) || isset($_GET['itr_fale_conosco']) ||
                    isset($_GET['itr_produtos']) || isset($_GET['itr_usuarios'])){
                    $nomeNivel = $_GET['txt_nome_nivel'];
                    $permissaoConteudos = isset($_GET['itr_conteudo']) ? 'ativado' : 'desativado';
                    $permissaoFaleConosco = isset($_GET['itr_fale_conosco']) ? 'ativado' : 'desativado';
                    $permissaoProdutos = isset($_GET['itr_produtos']) ? 'ativado' : 'desativado';
                    $permissaoUsuarios = isset($_GET['itr_usuarios']) ? 'ativado' : 'desativado';

                    $sql = "INSERT INTO tbl_nivel_usuario (nivel, adm_conteudo, adm_fale_conosco, adm_produto, adm_usuario)
                            VALUES ('".addslashes($nomeNivel)."', '".$permissaoConteudos."', '".$permissaoFaleConosco."', '".$permissaoProdutos."', '".$permissaoUsuarios."')";

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
    if(isset($_GET['btn_atualizar_nivel'])){
        if(isset($_GET['txt_nome_nivel'])){
            if($_GET['txt_nome_nivel'] != null){
                if(isset($_GET['itr_conteudo']) || isset($_GET['itr_fale_conosco']) ||
                    isset($_GET['itr_produtos']) || isset($_GET['itr_usuarios'])){
                    $nomeNivel = $_GET['txt_nome_nivel'];
                    $permissaoConteudos = isset($_GET['itr_conteudo']) ? 'ativado' : 'desativado';
                    $permissaoFaleConosco = isset($_GET['itr_fale_conosco']) ? 'ativado' : 'desativado';
                    $permissaoProdutos = isset($_GET['itr_produtos']) ? 'ativado' : 'desativado';
                    $permissaoUsuarios = isset($_GET['itr_usuarios']) ? 'ativado' : 'desativado';

                    $sql = "UPDATE tbl_nivel_usuario SET nivel = '".addslashes($nomeNivel)."', adm_conteudo = '".$permissaoConteudos."', 
                                    adm_fale_conosco = '".$permissaoFaleConosco."', adm_produto = '".$permissaoProdutos."', 
                                    adm_usuario = '".$permissaoUsuarios."' 
                            WHERE cod_nivel_usuario = ".$_SESSION['cod_nivel_usuario'];

                    if(mysqli_query($conexao, $sql)){
                         header("location: cmsUsuarios.php");
                        echo $sql;
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
    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'excluir'){
            $codNivelUsuario = $_GET['codigo'];

            $sql = "DELETE FROM tbl_nivel_usuario WHERE cod_nivel_usuario = ".$codNivelUsuario;

            if(mysqli_query($conexao, $sql)){
                header('location: cmsUsuarios.php');
            }else{
                echo $sql;
            }
        }
    }

    if(isset($_POST['btn_enviar_user'])){
        if(isset($_POST['txt_username_user']) && isset($_POST['txt_nome_user']) &&
            isset($_POST['txt_email_user']) && isset($_POST['txt_senha_user']) &&
            isset($_POST['slt_nivel_user'])){
            if(!empty($_POST['txt_username_user']) && !empty($_POST['txt_nome_user']) &&
                !empty($_POST['txt_email_user']) && !empty($_POST['txt_senha_user']) &&
                !empty($_POST['slt_nivel_user'])){
                $userName = $_POST['txt_username_user'];
                $nome = $_POST['txt_nome_user'];
                $email = $_POST['txt_email_user'];
                $senha = hash('sha512', $_POST['txt_senha_user']);
                $codNivelUsuario = $_POST['slt_nivel_user'];

                $sql = "INSERT INTO tbl_usuario (nome_usuario, nome, email, senha, cod_nivel_usuario)
                        VALUES ('".$userName."', '".$nome."', '".$email."', '".$senha."', '".$codNivelUsuario."')";

                if(mysqli_query($conexao, $sql)){
                    echo $sql;
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
                $('.visualizar').click(function(){
                    $('#container').fadeIn(300);
                });
            });

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
            function ativarDesativarNivel(codNivelUsuario, status){
                if(status == ""){

                }
                $.ajax({
                    type: 'Get',
                    url: './status.php',
                    data: {pagina: 'nivel_usuario', codigo: codNivelUsuario, status: status},
                    complete: function (response) {
                        alert(response.responseText);
                        location.reload();
                    },
                    error: function(){

                    }
                });
            }

            function confirmarExclusaoNivel(nivelUsuario){
                return confirm(`Deseja mesmo excluir ${nivelUsuario}?`);
            }
        </script>
    </head>
    <body>
    <!-- CONTAINER DO MODAL -->
        <div id="container">
            <div id="modal-nivel-usuario" class="center">

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
                <div id="menu-usuario">
                    <ul id="caixa-menu-usuario" class="flexbox">
                        <li id="selecao-nivel" class="item-menu-usuario flexbox">Níveis de Usuário</li>
                        <li id="selecao-usuario" class="item-menu-usuario flexbox">Usuários</li>
                    </ul>
                </div>
                <div id="container-nivel-usuario">
                    <form name="frm_niveis" method="get" action="cmsUsuarios.php">
                        <div id="container-add-nivel">
                            <div id="nome-nivel" class="flexbox">
                                <h3><label>Nome Nível:</label></h3>
                                <input type="text" id="txt-nome-nivel" name="txt_nome_nivel" required>
                            </div>
                            <h3><label>PERMISSÕES:</label></h3>
                            <hr>
                            <div id="container-permissoes">
                                <div class="caixas-permissoes flexbox">
                                    <h3><label>Conteúdos:</label></h3>
                                    <div class="on-off-adm-conteudos">
                                        <input type="checkbox" name="itr_conteudo" class="interruptores" id="on-off-conteudos">
                                        <label class="lbl-interruptores" for="on-off-conteudos"></label>
                                    </div>
                                </div>
                                <div class="caixas-permissoes flexbox">
                                    <h3><label>Fale Conosco:</label></h3>
                                    <div class="on-off-adm-conteudos">
                                        <input type="checkbox" name="itr_fale_conosco" class="interruptores" id="on-off-fale-conosco">
                                        <label class="lbl-interruptores" for="on-off-fale-conosco"></label>
                                    </div>
                                </div>
                                <div class="caixas-permissoes flexbox">
                                    <h3><label>Produtos:</label></h3>
                                    <div class="on-off-adm-conteudos">
                                        <input type="checkbox" name="itr_produtos" class="interruptores" id="on-off-produtos">
                                        <label class="lbl-interruptores" for="on-off-produtos"></label>
                                    </div>
                                </div>
                                <div class="caixas-permissoes flexbox">
                                    <h3><label>Usuários:</label></h3>
                                    <div class="on-off-adm-conteudos">
                                        <input type="checkbox" name="itr_usuarios" class="interruptores" id="on-off-usuarios">
                                        <label class="lbl-interruptores" for="on-off-usuarios"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="caixa-btn-nivel" class="flexbox">
                                <input type="submit" name="btn_enviar_nivel" class="btn-confirmacao" id="btn-enviar-nivel" value="ENVIAR"><!-- CAMPO DO CEP -->
                                <input type="button" class="btn-cancelar" id="btn-cancelar-nivel" value="CANCELAR"> <!-- CANCELAR INSERÇÃO -->
                            </div>
                        </div>
                    </form>
                    <input type="button" name="btn_add_nivel" class="btn-confirmacao" id="btn-add-nivel" value="ADICIONAR">
                    <div id="container-table-nivel">
                        <div id="tabela-nivel">
                            <table id="table-nivel">
                                <tr class="table-titles">
                                    <th id="title-vazio"></th>
                                    <th colspan="4" id="title-permissoes">PERMISSÕES</th>
                                    <th colspan="3" id="title-vazio"></th>
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
                                $sql = "SELECT * FROM tbl_nivel_usuario ORDER BY cod_nivel_usuario DESC";
                                $select = mysqli_query($conexao, $sql);

                                while($rsNivel = mysqli_fetch_array($select)) {
                                    $codNivelUsuario = $rsNivel['cod_nivel_usuario'];
                                    $nomeNivel = $rsNivel['nivel'];
                                    $nivelExcluir = "'".$nomeNivel."'";
                                    $admConteudo = $rsNivel['adm_conteudo'];
                                    $admFaleConosco = $rsNivel['adm_fale_conosco'];
                                    $admProdutos = $rsNivel['adm_produto'];
                                    $admUsuarios = $rsNivel['adm_usuario'];
//                                    AO TRAZER DO BANCO, VERIFICA-SE SE O STATUS É ATIVADO, SE SIM, A VARIÁVEL RECEBE DESATVADO PARA
//                                    QUE QUANDO SEU STATUS SEJA MODIFICADO, ELE SE TORNE DESATIVADO
                                    $nextStatus = $rsNivel['status'] == 'ativado' ? "'desativado'" : "'ativado'";


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
                                    <td class="txt-editar">
                                        <figure>
                                            <img class="icon-edit visualizar" onclick="viewModalAtualizarNivel(<?php echo $codNivelUsuario; ?>)" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codPromocao ?>" title="<?php echo 'Editar Registro '.$codPromocao ?>">
                                        </figure>
                                    </td>
                                    <td class="txt-excluir">
                                        <a href="?modo=excluir&codigo=<?php echo $codNivelUsuario ?>"
                                            <figure>
                                                <img class="icon-del" onclick="return confirmarExclusaoNivel(<?php echo $nivelExcluir; ?>)" src="./icons/trash.png" alt="<?php echo 'Exluir Registro '.$codNivelUsuario ?>" title="<?php echo 'Exluir Registro '.$codNivelUsuario ?>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td class="txt-status">
                                        <figure>
                                            <img onclick="ativarDesativarNivel(<?php echo($codNivelUsuario.', '.$nextStatus); ?>)" class="icon-status" src="./icons/<?php echo $img ?>" alt="<?php echo $altTitle ?>" title="<?php echo $altTitle ?>">
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
                <div id="container-users">
                    <form name="frm_user" action="cmsUsuarios.php" method="post">
                        <div id="container-add-user" class="flexbox">
                            <div id="username-user" class="flexbox">
                                <h3><label>Nome de Usuário (Login):</label></h3>
                                <input required type="text" id="txt-username-user" name="txt_username_user">
                            </div>
                            <div id="nome-user" class="flexbox">
                                <h3><label>Nome:</label></h3>
                                <input required type="text" id="txt-nome-user" name="txt_nome_user">
                            </div>
                            <div id="email-user" class="flexbox">
                                <h3><label>E-mail:</label></h3>
                                <input required type="text" id="txt-email-user" name="txt_email_user">
                            </div>
                            <div id="senha-user" class="flexbox">
                                <h3><label>Senha:</label></h3>
                                <input required type="text" id="txt-senha-user" name="txt_senha_user">
                            </div>
                            <div id="confirmar-senha-user" class="flexbox">
                                <h3><label>Confirmar Senha:</label></h3>
                                <input required type="text" id="txt-confirmar-senha-user">
                            </div>
                            <div id="nivel-user" class="flexbox">
                                <h3><label>Nível de Usuário:</label></h3>
                                <select required id="slt-nivel-user" name="slt_nivel_user">
                                    <option value="">Escolher Nível</option>
                                    <?php
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
                            <div id="caixa-btn-user" class="flexbox">
                                <input type="submit" name="btn_enviar_user" class="btn-confirmacao" id="btn-enviar-user" value="ENVIAR"><!-- CAMPO DO CEP -->
                                <input type="button" class="btn-cancelar" id="btn-cancelar-user" value="CANCELAR"> <!-- CANCELAR INSERÇÃO -->
                            </div>
                        </div>
                    </form>
                    <input type="button" name="btn_add_user" class="btn-confirmacao" id="btn-add-user" value="ADICIONAR">
                    <div id="container-table-user">

                    </div>
                </div>
            </div>
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('./footer.html');
            ?>
        </div>
        <script src="./js/cmsUsuario.js"></script>
    </body>
</html>
