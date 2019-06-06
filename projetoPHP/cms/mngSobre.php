<?php

//    FAZER EXCLUIR

    require_once ('./verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();
    
    // IMPORTANDO ARQUIVO COM FUNÇÕES DE GERENCIAMENTO DE ARQUIVOS UPADOS
    require_once('./uploadArquivo.php');

    if(isset($_POST['btn_enviar_sobre'])){//SCRIPT DE INSERIR SOBRE
        if(isset($_POST['txt_assinatura']) && isset($_POST['txt_sobre'])){//VERICANDO CAMPOS OBRIGATORIOS
            $errorImg = $_FILES['file_sobre']['error'];
            if(!empty($_POST['txt_assinatura']) && !empty($_POST['txt_sobre']) && $errorImg == 0){//VENDO SE CAMPOS NÃAO SAO NULOS
               
                $imagem = salvarArquivo($_FILES['file_sobre'], 'inserir');
                $tituloSobre = trim($_POST['txt_titulo_sobre']);
                $txtSobre = trim($_POST['txt_sobre']);
                $assinatura = trim($_POST['txt_assinatura']);

                // NÃO DEIXA INSERIR CASO HAJA UM ERRO NO UPLOAD DA IMGAGEM, SE TIVEWR ENVI MENSAGENS DE ERRO
                if($imagem != 'sizeError' && $imagem != 'extensionError'){
                    $sql = "INSERT INTO tbl_sobre (titulo_sobre, sobre, assinatura, imagem, status)
                            VALUES ('".addslashes($tituloSobre)."','".addslashes($txtSobre)."', '".addslashes($assinatura)."', '".addslashes($imagem)."', 'desativado')";
                    if(mysqli_query($conexao, $sql)){
                        header('location: mngSobre.php');
                    }else{
                        echo 'não inserido<br>'.$sql;
                    }

                }elseif($imagem == 'extensionError'){
                    echo("<script>alert('O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                }elseif($imagem == 'sizeError'){
                    echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                }
            }else{
                echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS OU ITENS NÃO SELECIONADOS.')</script>");
            }
        }else{
            echo("<script>alert('HÁ ALGO QUE NAO EXISTEM!')</script>");
        }
    }elseif(isset($_POST['btn_atualizar_sobre'])){//SCRIPT DE ATUALIZAR SOBRE
        echo 'atualizar';
        if(isset($_POST['txt_assinatura']) && isset($_POST['txt_sobre'])){//VERICANDO CAMPOS OBRIGATORIOS
            echo 'tudo existe';
            if(!empty($_POST['txt_assinatura']) && !empty($_POST['txt_sobre'])){//VENDO SE CAMPOS NÃAO SAO NULOS
                echo 'tudo preenchido';

                $tituloSobre = trim($_POST['txt_titulo_sobre']);
                $txtSobre = trim($_POST['txt_sobre']);
                $assinatura = trim($_POST['txt_assinatura']);

                // NÃO DEIXA INSERIR CASO HAJA UM ERRO NO UPLOAD DA IMGAGEM, SE TIVER ENVIA MENSAGENS DE ERRO, E ESE NÃO HA IMAGEM, ATUALIZAR SEM UMA
                if(isset($_FILES['file_sobre']) && $_FILES['file_sobre']['name'] != null){
                    $imagem = salvarArquivo($_FILES['file_sobre'], 'atualizar');
                    if($imagem != 'sizeError' && $imagem != 'extensionError'){
                        $sql = "UPDATE tbl_sobre SET titulo_sobre = '".addslashes($tituloSobre)."', sobre = '".addslashes($txtSobre)."', assinatura = '".addslashes($assinatura)."', imagem = '".addslashes($imagem)."' WHERE cod_sobre = ".$_SESSION['cod_sobre'];
                    }elseif($imagem == 'extensionError'){
                        echo("<script>alert('O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                    }elseif($imagem == 'sizeError'){
                        echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                    }
                }else{
                    $sql = "UPDATE tbl_sobre SET titulo_sobre = '".addslashes($tituloSobre)."', sobre = '".addslashes($txtSobre)."', assinatura = '".addslashes($assinatura)."' WHERE cod_sobre = ".$_SESSION['cod_sobre'];
                }

                if(mysqli_query($conexao, $sql)){
                    header('location: mngSobre.php');
                }else{
                    echo 'não inserido<br>'.$sql;
                }
                $_SESSION['img'] == null;

            }else{
                echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS OU ITENS NÃO SELECIONADOS.')</script>");
            }
        }else{
            echo("<script>alert('HÁ ALGO QUE NAO EXISTEM!')</script>");
        }
    }

    if(isset($_GET['modo']) && $_GET['modo'] == 'excluir'){//SCRIPT DE EXCLUSAO DE SOBRE NO BANCO
        $codSobre = $_GET['codigo'];
        $img = $_GET['imgSobre'];
        excluirArquivo($img);

        $sql = "DELETE FROM tbl_sobre WHERE cod_sobre = ".$codSobre;
        if(mysqli_query($conexao, $sql)){
            header('location: mngSobre.php');
        }else{
            echo 'deu ruim';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/fontes.css">
        <title>GERENCIAR SOBRE</title>
        <meta charset="utf-8">
        <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
        <script src="./js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#container').fadeIn(300);
                });
            });
            // FUNÇÃO DE VISUALIZAR MODAL DE EDIÇÃO DE SOBRE
            function viewModalAtualizarSobre(codSobre){
                $.ajax({
                    type: 'GET',
                    url: './modais/atualizarSobre.php',
                    data: {codSobre: codSobre},
                    success: function(dados){
                        $('#modal-sobre').html(dados);
                    },
                });
            }
            // FUNLÇÃO DE TROCA DE STATUS DO SOBNRE
            const ativarDesativarSobre = (codSobre, status) =>{
                $.ajax({
                    type: 'GET',
                    url: './status.php',
                    data: {pagina: 'sobre', status: status, codigo: codSobre},
                    complete: function(response){
                        location.reload();
                    },
                    error: function(response){
                        alert(response.responseText);
                    }
                });

            }

            // FUNÇAÕ DE CONFIRMAÇÃO DE EXCLUSAO DE SOBRE
            const confirmarExclusaoSobre = (tituloSobre) =>{
                return confirm(`Deseja mesmo exluir ${tituloSobre}?`);
            }
        </script>
    </head>
    <body>
        <!-- CONTAINER DO MODAL -->
        <div id="container">
            <div id="modal-sobre" class="center">

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
            <div id="conteudo-sobre">
                <form action="mngSobre.php" method="POST" enctype="multipart/form-data" name="frm-sobre">
                    <div id="container-sobre" class="flexbox">
                        <div id="titulo-sobre" class="flexbox">
                            <h3><label for="txt-titulo-sobre">Título da Página Sobre:</label></h3> <!-- CAMPO TITULO -->
                            <input maxlength="25" type="text" name="txt_titulo_sobre" id="txt-titulo-sobre">
                        </div>
                        <div id="imagem-sobre" class="flexbox">
                            <h3><label for="txt-sobre">Imagem da Página Sobre:</label></h3> <!-- CAMPO IMAGEM -->
                            <input type="file" name="file_sobre" id="file-sobre">
                        </div>
                        <div id="assinatura-sobre" class="flexbox">
                            <h3><label for="txt-sobre">Assinatura:</label></h3>
                            <input maxlength="50" type="text" id="txt-assinatura" name="txt_assinatura"> <!-- CAMPO ASSINATURA -->
                        </div>
                        <div id="texto-sobre" class="flexbox">
                            <h3><label for="txt-sobre">Sobre A Road Runner:</label></h3>
                            <textarea maxlength="60000" id="txt-sobre" name="txt_sobre"></textarea> <!-- CAMPO TEXTO -->
                        </div>
                        <div id="caixa-btn-sobre" class="flexbox"> <!-- AREA DE BOTOES DE ENVIOP E CANCELAMENTOP DE FORMULARIO -->
                            <input type="submit" name="btn_enviar_sobre" id="btn-enviar-sobre" class="btn-confirmacao" value="ENVIAR"> 
                            <input type="button" class="btn-cancelar" id="btn-cancelar" value="CANCELAR">
                        </div>
                    </div>
                </form>
                <input type="button" id="btn-add-sobre" class="btn-confirmacao" name="btn_add_sobre" value="ADICIONAR">
                <!-- AREA DE TABELA DE VISUALIZAÇLÃO DE SOBRE -->
                <div id="container-table-sobre">
                    <div id="tabela-sobre">
                        <table id="table-sobre">
                            <tr class="table-titles">
                                <th class="title-titulo-sobre">Título da Página</th>
                                <th class="title-assinatura">Assinatura</th>
                                <th class="title-editar">Editar</th>
                                <th class="title-excluir">Excluir</th>
                                <th class="title-status">Status</th>
                            </tr>
                            <?php
                                // SCRIPT SQL QUE TRAZ TODOS SOBRE DO BANCO
                                $sql = "SELECT * FROM tbl_sobre ORDER BY cod_sobre DESC";
                                $select = mysqli_query($conexao, $sql);
                                while($rsSobre = mysqli_fetch_array($select)) {
                                    // RESGATNO DADOS DO BANCO
                                    $codSobre = $rsSobre['cod_sobre'];
                                    $tituloSobre = $rsSobre['titulo_sobre'];
                                    $assinatura = $rsSobre['assinatura'];
                                    $imagemSobre = $rsSobre['imagem'];
                                    $status = "'".$rsSobre['status']."'";

                                    $altTitle = $rsSobre['status'] == 'ativado' ? 'Desativar Registro '.$codSobre : 'Ativar Registro '.$codSobre;
                                    $img = $rsSobre['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                            ?>
                            <tr class="tables-registers">
                                <td class="txt-titulo-sobre"><?php echo $tituloSobre ?></td>
                                <td class="txt-assinatura"><?php echo $assinatura ?></td>
                                <!-- BOTAO DE EDITAR -->
                                <td class="txt-editar">
                                    <figure>
                                        <img class="icon-edit visualizar" onclick="viewModalAtualizarSobre(<?php echo $codSobre ?>)" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codSobre ?>" title="<?php echo 'Editar Registro '.$codSobre ?>">
                                    </figure>
                                </td>
                                <!-- BOTAO DE EXCLUIR -->
                                <td class="txt-excluir">
                                    <a href="?modo=excluir&codigo=<?php echo $codSobre ?>&imgSobre=<?php echo $imagemSobre ?>">
                                        <figure>
                                            <img class="icon-del" onclick="return confirmarExclusaoSobre(<?php echo "'".$tituloSobre."'" ?>)" src="./icons/trash.png" alt="<?php echo 'Exluir Registro '.$codSobre ?>" title="<?php echo 'Exluir Registro '.$codSobre ?>">
                                        </figure>
                                    </a>
                                </td>
                                <!-- BOTAO DE TROCA DE STATSU -->
                                <td class="txt-status">
                                    <figure>
                                        <img onclick="ativarDesativarSobre(<?php echo($codSobre.', '.$status); ?>)" class="icon-status" src="./icons/<?php echo $img ?>" alt="<?php echo $altTitle ?>" title="<?php echo $altTitle ?>">
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
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('./footer.html');
            ?>
            <script>
                // FUNÇÃO QQUE CONTROLA VISUALIZAÇÃO DE AREA DE ADDICAO DE SOBRE
                const btnAddSobre = document.getElementById('btn-add-sobre');
                const btnCancelar = document.getElementById('btn-cancelar');
                const caixaAddSobre = document.getElementById('container-sobre');

                const showCaixaAddSobre = () =>{
                    caixaAddSobre.style.display = "flex";
                    btnAddSobre.style.display = "none";
                }

                const hiddeCaixaAddSobre = () =>{
                    caixaAddSobre.style.display = "none";
                    btnAddSobre.style.display = "inline";
                }

                btnAddSobre.addEventListener('click', showCaixaAddSobre);
                btnCancelar.addEventListener('click', hiddeCaixaAddSobre);
            </script>
        </div>
    </body>
</html>