<?php

    require_once ('verificarUsuario.php');// VERIFICAR SE USUARIO ESTA LOGADO

//    VERIFICAR SE O USUARIO LOGADO TEM PERMISSÃO PARA ACESSAR ESTA PÁGINA
    if($_SESSION['adm_fale_conosco'] == 'ativado'){
        //CONEXAO COM O BANCO
        require_once('../bd/conexao.php');
        $conexao = conexaoMySql();

        //EXCLUIR REGISTRO CUJO CODIGO FOI PEGO NA URL
        if(isset($_GET['codigo'])){
            if($_GET['modo'] == 'excluir'){
                $codMsg = $_GET['codigo'];

                $sql = "DELETE FROM tbl_fale_conosco WHERE cod_mensagem = ".$codMsg;

                if(mysqli_query($conexao, $sql)){
                    header('location: cmsFaleConosco.php');
                }else{
                    echo("<script>alert('Erro ao excluir contato!');</script>");
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/fontes.css">
        <title>CMS Road Runner</title>
        <meta charset="utf-8">
        <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){              
                $('.visualizar').click(function(){
                    $('#container').fadeIn(300);
                });
            });
            // FUNCAO DO AJAX DE ATIVA O MODAL DE VISUALIZAÇAO DO REGISTRO CLICADO 
            function visualizarDados(codContato){
                //↓ função do ajax para mandar informações para a modal de visualização de dados
                $.ajax({
                    type: "GET",
                    url: "modais/faleConosco.php",
                    data: {codigo:codContato},

                    success: function(dados){
                        $('#modal-fale-conosco').html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
        <!-- CONTAINER DO MODAL -->
        <div id="container">
            <div id="modal-fale-conosco" class="center">
            
            </div>
        </div>
        <!-- AREA DE TODO O CONTEUDO DA PAGINA -->
        <div id="tudo">
            <!-- IMPORTANDO ARQUIVO COM HEADER DA PAGINA -->
            <?php
                require_once('header.html');
            ?>
            <!-- AREA DO MENU DO SITE -->
            <div id="menu" class="center flexbox">
                <!-- IMPORTANDO ARQUIVO COM MENU DA PAGINA -->
                <?php
                    require_once('menu.php');
                ?>
            </div>
            <!-- AREA COM O CONTEUDO DA PAGINA -->
            <div id="conteudo-fale-conosco">
                <div id="container-fale-conosco">
                    <!-- TABELA COM OS REGISTRO DO BANCO -->
                    <table id="table-fale-conosco">
                        <tr class="table-titles">
                            <th id="title-nome">Nome</th>
                            <th id="title-email">E-mail</th>
                            <th id="title-cel">Assunto</th>
                            <th id="title-view">Visualizar</th>
                            <th class="title-excluir">Excluir</th>
                        </tr>
                        <?php
                            // SCRIPT SQL QUE TRAZ OS REGISTROS DE MENSAGENS DE CLIENTES DO BANCO
                            $sql = "SELECT * FROM tbl_fale_conosco
                                    INNER JOIN tbl_assunto 
                                    ON tbl_fale_conosco.cod_assunto = tbl_assunto.cod_assunto
                                    ORDER BY tbl_fale_conosco.cod_assunto DESC";

                            $select = mysqli_query($conexao, $sql);
                            
                            while($rsContato = mysqli_fetch_array($select)){
                        ?>
                        <tr class="tables-registers">
                            <td class="txt-nome"><?php echo($rsContato['nome']); ?></td>
                            <td class="txt-email"><?php echo($rsContato['email']); ?></td>
                            <td class="txt-assunto"><?php echo($rsContato['assunto']); ?></td>
                            <td class="txt-view">
                                <figure>
                                    <!-- BOTAO QUE ATIVA MODAL PARA VISUALIZAÇAO DE REGISTRO -->
                                    <img onclick="visualizarDados(<?php echo($rsContato['cod_mensagem']); ?>)" class="visualizar icon-view" alt="Visualizar Registro" title="Visualizar Registro" src="icons/view.png">
                                </figure>
                            </td>
                            <td class="txt-excluir">
                                <a href="?modo=excluir&codigo=<?php echo($rsContato['cod_mensagem']); ?>">
                                    <figure>
                                        <!-- BOTAO QUE EXCLUI O REGISTRO -->
                                        <img onclick="return confirm('Deseja excluir mensagem de <?php echo($rsContato['nome']); ?> permanentemente?')" class="icon-delete" alt="Excluir Registro" title="Excluir Registro" src="icons/trash.png">
                                    </figure>
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
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