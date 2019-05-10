<?php

    require_once ('./verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    // IMPORTANDO ARQUIVO COM FUNÇÕES DE GERENCIAMENTO DE ARQUIVOS UPADOS
    require_once('./uploadArquivo.php');

    // INSERÇÃO DE 'NOTICIA GERAL' NO BANCO
    if(isset($_POST['btn_enviar_gerais'])){
        if(isset($_POST['txt_titulo']) && isset($_POST['txt_autor']) && isset($_POST['txt_resumo'])){

            $erroImg = $_FILES['foto_noticia']['error'];

            if(!empty($_POST['txt_titulo']) && !empty($_POST['txt_autor']) && !empty($_POST['txt_resumo']) && $erroImg == 0){
                echo 'preenchidos';

                $titulo = $_POST['txt_titulo'];
                $autor = $_POST['txt_autor'];
                if(!empty($_POST['txt_data'])){
                    $dataTxt = explode("/", $_POST['txt_data']);
                    $data = $dataTxt[2]."-".$dataTxt[1]."-".$dataTxt[0];
                }else{
                    $data = date('Y-m-d', time());
                }
                $resumo = $_POST['txt_resumo'];

                $imagem = salvarArquivo($_FILES['foto_noticia'], 'inserir');

                if($imagem != 'sizeError' && $imagem != 'extensionError'){
                    $sql = "INSERT INTO tbl_noticia (titulo_noticia, autor, data, resumo, imagem, status)
                            VALUES ('".$titulo."','".$autor."','".$data."','".$resumo."','".$imagem."','desativado')";

                    if(mysqli_query($conexao, $sql)){
                        echo $imagem;
                        header('location: mngNoticias.php');
                    }else{
                        echo("<br>".$sql);
                        echo("<script>alert('NÃO FOI POSSÍVEL REALIZAR O REGISTRO')</script>");
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
            echo("<script>alert('NAO EXISTEM!')</script>");
        }

    }elseif(isset($_POST['btn_atualizar_gerais'])){ // ATUALIZAÇÃO DE 'NOTICIA GERAL' NO BANCO
        
        if(isset($_POST['txt_titulo']) && isset($_POST['txt_autor']) && isset($_POST['txt_resumo'])){

            if(!empty($_POST['txt_titulo']) && !empty($_POST['txt_autor']) && !empty($_POST['txt_resumo'])){

                $titulo = $_POST['txt_titulo'];
                $autor = $_POST['txt_autor'];
                if(!empty($_POST['txt_data'])){
                    $dataTxt = explode("/", $_POST['txt_data']);
                    $data = $dataTxt[2]."-".$dataTxt[1]."-".$dataTxt[0];
                }else{
                    $data = date('Y-m-d', time());
                }
                $resumo = $_POST['txt_resumo'];

                if($_FILES['foto_noticia']['name'] != null){
                    $imagem = salvarArquivo($_FILES['foto_noticia'], 'atualizar');

                    if($imagem != 'sizeError' && $imagem != 'extensionError'){
                        $sqlUp = "UPDATE tbl_noticia
                        SET titulo_noticia = '".$titulo."', autor = '".$autor."', data = '".$data."', imagem = '".$imagem."', resumo = '".$resumo."'
                        WHERE cod_noticia = ".$_SESSION['cod_noticia'];
                    }elseif($imagem == 'extensionError'){
                        echo("<script>alert('O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                    }elseif($imagem == 'sizeError'){
                        echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                    }
                }else{
                    $sqlUp = "UPDATE tbl_noticia
                    SET titulo_noticia = '".$titulo."', autor = '".$autor."', data = '".$data."', resumo = '".$resumo."'
                    WHERE cod_noticia = ".$_SESSION['cod_noticia'];
                }
                
                if(mysqli_query($conexao, $sqlUp)){
                    header('location: mngNoticias.php');
                }else{
                    echo("<script>alert('NÃO FOI POSSÍVEL ATUALIZAR O REGISTRO')</script>");
                }
                $_SESSION['img'] = null;
            }else{
                echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS.')</script>");
            }
        }else{
            echo("<script>alert('NAO EXISTEM!')</script>");
        }
    }

    // INSERÇÃO DE 'NOTICIA PRINCIPAL' NO BANCO
    if(isset($_POST['btn_enviar_principais'])){
        
        if(isset($_POST['txt_titulo']) && isset($_POST['txt_autor']) && isset($_POST['txt_resumo']) && isset($_POST['cmb_destaque'])){
            
            $erroImg = $_FILES['foto_noticia']['error'];

            if(!empty($_POST['txt_titulo']) && !empty($_POST['txt_autor']) && !empty($_POST['txt_resumo']) && !empty($_POST['cmb_destaque']) && $erroImg == 0){

                
                $titulo = $_POST['txt_titulo'];
                $autor = $_POST['txt_autor'];
                if(!empty($_POST['txt_data'])){
                    $dataTxt = explode("/", $_POST['txt_data']);
                    $data = $dataTxt[2]."-".$dataTxt[1]."-".$dataTxt[0];
                }else{
                    $data = date('Y-m-d', time());
                }
                $resumo = $_POST['txt_resumo'];
                $destaque = $_POST['cmb_destaque'];

                $imagem = salvarArquivo($_FILES['foto_noticia'], 'inserir');

                if($imagem != 'sizeError' && $imagem != 'extensionError'){
                    $sql = "INSERT INTO tbl_noticia_principal (titulo_noticia, autor, data, resumo, imagem, status, cod_destaque)
                    VALUES ('".$titulo."','".$autor."','".$data."','".$resumo."','".$imagem."', 'desativado', ".$destaque.")";

                    if(mysqli_query($conexao, $sql)){
                        header('location: mngNoticias.php');
                    }else{
                        echo("<br>".$sql);
                        echo("<script>alert('NÃO FOI POSSÍVEL REALIZAR O REGISTRO.')</script>");
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
    }elseif(isset($_POST['btn_atualizar_principais'])){// ATUALIZAÇÃO DE 'NOTICIA PRINCIPAL' NO BANCO
        
        if(isset($_POST['txt_titulo']) && isset($_POST['txt_autor']) && isset($_POST['txt_resumo']) && isset($_POST['cmb_destaque'])){

            if(!empty($_POST['txt_titulo']) && !empty($_POST['txt_autor']) && !empty($_POST['txt_resumo']) && !empty($_POST['cmb_destaque'])){
                
                $titulo = $_POST['txt_titulo'];
                $autor = $_POST['txt_autor'];
                if(!empty($_POST['txt_data'])){
                    $dataTxt = explode("/", $_POST['txt_data']);
                    $data = $dataTxt[2]."-".$dataTxt[1]."-".$dataTxt[0];
                }else{
                    $data = date('Y-m-d', time());
                }
                $resumo = $_POST['txt_resumo'];
                $destaque = $_POST['cmb_destaque']; 
                
                if($_FILES['foto_noticia']['name'] != null){
                    $imagem = salvarArquivo($_FILES['foto_noticia'], 'atualizar');
                    if($imagem != "extensionError" && $imagem != "sizeError"){
                        $sqlUp = "UPDATE tbl_noticia_principal
                        SET titulo_noticia = '".$titulo."', autor = '".$autor."', data = '".$data."', resumo = '".$resumo."', imagem = '".$imagem."',cod_destaque = '".$destaque."'
                        WHERE cod_noticia = ".$_SESSION['cod_noticia'];

                    }elseif($imagem == 'extensionError'){
                        echo("<script>alert('O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO')</script>");
                    }elseif($imagem == 'sizeError'){
                        echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO')</script>");
                    }
                }else{
                    $sqlUp = "UPDATE tbl_noticia_principal
                    SET titulo_noticia = '".$titulo."', autor = '".$autor."', data = '".$data."', resumo = '".$resumo."', cod_destaque = '".$destaque."'
                    WHERE cod_noticia = ".$_SESSION['cod_noticia'];
                }

                if(mysqli_query($conexao, $sqlUp)){
                    header('location: mngNoticias.php');
                }else{
                    echo $sqlUp;
                    echo("<script>alert('NÃO FOI POSSÍVEL ATUALIZAR O REGISTRO')</script>");
                }

                $_SESSION['img'] = null;
            }else{
                echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS.')</script>");
            }
        }else{
            echo("<script>alert('NAO EXISTEM!')</script>");
        }
    }


    
    // VERIFICA O TIPO DA NOTICIA E FAZ A EXCLUSÃO DA NOTICIA NO BANCO
    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'excluir'){
            if($_GET['tipo'] == 'principal'){ // SE PRINCIPAL FAZ A EXCLUSÃO
                $codNoticia = $_GET['codigo'];
                $imagem = $_GET['img'];
                require_once ('./uploadArquivo.php');
                excluirArquivo($imagem);

                $sql = "DELETE FROM tbl_noticia_principal WHERE cod_noticia = ".$codNoticia;

                if(mysqli_query($conexao, $sql)){
                    echo('EXCLUIU');
                    header('location: mngNoticias.php');
                }else{
                    echo('NAO EXCLUIU');
                }
            }elseif($_GET['tipo'] == 'geral'){ // SE GERAL FAZ A EXCLUSÃO
                $codNoticia = $_GET['codigo'];
                $imagem = $_GET['img'];
                require_once ('./uploadArquivo.php');
                $imgExcluida = excluirArquivo($imagem);
        
                $sql = "DELETE FROM tbl_noticia WHERE cod_noticia = ".$codNoticia;

                if(mysqli_query($conexao, $sql)){
                    echo('EXCLUIU');
                    header('location: mngNoticias.php');
                }else{
                    echo("<script>alert('NÃO EXLCUIU')</script>");
                }
            }else{
                echo("<br>nenhum");
            }
        }
    }   
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/fontes.css">

        <title>GERENCIAR NOTÍCIAS</title>
        <meta charset="utf-8">
        <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
        <script src="./js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#container').fadeIn(300);
                });
            });
            // FUNÇÃO QUE CHAMA MODAL DE PARA INSERIR OU ATUALIZAR UMA NOTICIA
            function inserirAtualizarNoticia(modo, codNoticia, tipoNoticia){
                if(tipoNoticia == 'geral'){ // SE O TIPO DA NOTICIA FOR GERAL, CHAMA O MODAL DE INSERIR OU ATUALIZAR NOTICIAS GERAIS
                    $.ajax({
                        type: "POST",
                        url: "./modais/inserirAtualizarNoticiaGeral.php",
                        data: {modo: modo, codigo: codNoticia},
                        success: function(dados){
                            $('#modal-noticia').html(dados);
                        }
                    });
                }else if(tipoNoticia == 'principal'){ // SE O TIPO DA NOTICIA FOR GERAL, CHAMA O MODAL DE INSERIR OU ATUALIZAR NOTICIAS PRINCIPAIS
                console.log(`${modo} ${codNoticia} ${tipoNoticia}`)
                    $.ajax({
                        type: "POST",
                        url: "./modais/inserirAtualizarNoticiaPrincipal.php",
                        data: {modo: modo, codigo: codNoticia},
                        success: function(dados){
                            $('#modal-noticia').html(dados);
                        },
                        erro: function(){
                            alert('Erro!');
                        }
                    });
                }
            }
            // FUNÇÃO QUE ATIVA OU DESATIVA NOTICIAS
            function ativarDesativarNoticia(tipo, status, codigo, destaque) {
                $.ajax({
                    url:'./status.php',
                    data: {pagina: 'noticias', noticia: tipo, status: status, codigo:codigo, nvl_destaque: destaque},
                    complete: function (response) {
                        alert(response.responseText);
                        location.reload();
                    },
                    error: function () {
                        alert('Erro');
                    }
                });  

                return false;
            }
            // FUNÇÃO QUE CONFIRMA  A EXCLUSÃO DE UMA NOTICIA GERAL
            const confirmarExclusaoGeral = (titulo) => {
                return confirm('Deseja mesmo excluir '+titulo+'?');
            }
            // FUNÇÃO QUE CONFIRMA  A EXCLUSÃO DE UMA NOTICIA PRINCIPAL
            const confirmarExclusaoPrincipal = (titulo) => {
                return confirm('Deseja mesmo excluir '+titulo+'?');
            }
        </script>
    </head>
    <body>
        <!-- CONTAINER DO MODAL -->
        <div id="container">
            <div id="modal-noticia" class="center">

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
            <div id="conteudo-noticias">
                <!-- BOTOES SELECAO DO TIPO DE NOTICIAS QUE SERAO VISUALIZADAS OU ADIIONADAS -->
                <div id="tipos-noticias" class="flexbox">
                    <!-- SELECIONAR NOTICIAS GERAIS -->
                    <div id="tipo-gerais" class="flexbox" onclick="mostrarGerais()">
                        <h2>Notícias Gerais</h2>
                    </div>
                    <!-- SELECIONAR NOTICIAS PRINCIPAIS -->
                    <div id="tipo-principais" class="flexbox" onclick="mostrarPrincipais()">
                        <h2>Notícias Principais</h2>
                    </div>
                </div>
                <div id="btns-add-noticias" class="flexbox">
                    <!-- BOTAO QUE CHAMA A MODAL DE ADICIONAR NOTICIAS GERAIS -->
                    <input type="button" value="ADICIONAR" class="visualizar btn-confirmacao" id="adicionar-geral" onclick="inserirAtualizarNoticia('inserir', 0, 'geral')">
                    <!-- BOTAO QUE CHAMA A MODAL DE ADICIONAR NOTICIAS PRINCIPAIS -->
                    <input type="button" value="ADICIONAR" class="visualizar btn-confirmacao" id="adicionar-principal" onclick="inserirAtualizarNoticia('inserir', 0, 'principal')">
                </div>
                <!-- AREA COM TABELA DE NOTICIAS GERAIS -->
                <div id="container-gerais">
                    <div id="tabela-gerais">
                        <table id="table-gerais">
                            <tr class="table-titles">
                                <th class="title-titulo">Título</th>
                                <th class="title-autor">Autor</th>
                                <th class="title-editar">Editar</th>
                                <th class="title-excluir">Excluir</th>
                                <th class="title-status">Status</th>
                            </tr>
                            <?php
                            // SCRIPT SLQ QUE TRAZ DO BANCO A LISTA DE NOTICIAS GERAIS ADICIONADAS
                                $sql = "SELECT * FROM tbl_noticia ORDER BY cod_noticia DESC";

                                $select = mysqli_query($conexao, $sql);
                                
                                while($rsNoticia = mysqli_fetch_array($select)){
                                    $titulo = $rsNoticia['titulo_noticia'];
                                    $status = $rsNoticia['status'] == 'ativado' ? "'desativado'" : "'ativado'";
                                    $codNoticia = $rsNoticia['cod_noticia'];
                                    $tipoNoticia = "'".'geral'."'";
                                    $imagemNoticia = $rsNoticia['imagem'];

                                    $alt = $rsNoticia['status'] == 'ativado' ? 'Ativar' : 'Desativar';
                                    $title = $rsNoticia['status']== 'ativado' ? 'Ativar' : 'Desativar';
                                    $img = $rsNoticia['status']== 'ativado' ? 'ativado.png' : 'desativado.png';
                            ?>
                            <tr class="tables-registers">
                                <td class="txt-titulo"><?php echo($rsNoticia['titulo_noticia']); ?></td>
                                <td class="txt-autor"><?php echo($rsNoticia['autor']); ?></td>
                                <td class="txt-editar">
                                    <figure>
                                        <!-- BOTAO QUE CHAMA MODAL PARA EDITAR NOTICIA -->
                                        <img onclick="inserirAtualizarNoticia('atualizar', <?php echo($codNoticia.', '.$tipoNoticia); ?>);" class="icon-edit visualizar" alt="Editar Registro <?php echo($codNoticia); ?>" title="Editar Registro <?php echo($codNoticia); ?>" src="icons/edit.png">
                                    </figure>
                                </td>
                                <td class="txt-excluir">
                                    <a href="?codigo=<?php echo($codNoticia); ?>&modo=excluir&tipo=geral&img=<?php echo($imagemNoticia); ?>">
                                        <figure>
                                            <!-- BOTAO QUE EXCLUI NOTICIA -->
                                            <img onclick="return confirmarExclusaoGeral('<?php echo($titulo); ?>');" class="icon-del" alt="Excluir Registro <?php echo($codNoticia); ?>" title="Excluir Registro <?php echo($codNoticia); ?>" src="icons/trash.png">
                                        </figure>
                                    </a>
                                </td>
                                <td class="txt-status">
                                    <figure>
                                        <!-- BOTAO QUE ATIVA OU DESATIVA NOTICIA -->
                                        <img onclick="ativarDesativarNoticia('geral', <?php echo($status.', '.$codNoticia.', 0');?>)" class="icon-status" alt="<?php echo($alt); ?> Registro" Registro" title="<?php echo($title); ?> Registro" src="icons/<?php echo($img); ?>">
                                    </figure>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <!-- AREA COM TABELA DE NOTICIAS GERAIS -->
                <div id="container-principais">
                    <select id="cmb-nivel" name="cmb_destaque">
                        <!-- SELECIONAR NOTICIAS QUE SERÃO MOSTRADAS NA TABELA DE NOTICIAS PRINCIPAIS -->
                        <?php  
                            // SE NÃO SELECIONADA NENHUMA NIVEL DE DESTAQUE DAS NOTICIAS, UMA VARIÁVEL RECEBE 0 
                            // E SERÁ USADA PARA TRAZA TODOS AS NOTICIAS CUJO cod_destaque É == 0
                            // E O select DE ESCOLHA FICARA COM UM option NULO
                            if(!isset($_GET['codDtq']) || $_GET['codDtq'] == 0){
                                $codUrlDestaque = 0;
                        ?>
                        <option selected value="0">Exibir Todos</option>
                        <?php
                            // SE UM NIVEL DE DESTAQUE FOR SELECIONADO, UMA VARIÁVEL RECEBERÁ O cod_destaque E OUTRA RECEBRA
                            // O destaque SELECIONADOS, PARA QUE DEPOIS, O BANCO TRAGA TODAS O OSTROS NIVEL DE DESTAQUE COM O CÓDIGO DIFERENTE
                            // DO SELECIONADO, O select MOSTRARÁ O option  SELECIONADO
                            }else{
                                $codUrlDestaque = $_GET['codDtq'];
                                $destaqueUrl = $_GET['destaque']
                        ?>
                        <option value="0">Exibir Todos</option>
                        <option selected value="<?php echo $codUrlDestaque ?>"><?php echo $destaqueUrl ?></option>
                        <?php
                            }
                        ?>
                        <?php
                            // SCRIPT SQL QUE TRARÁ OS NIVEIS DE DESTAQUE COM O cod_destaque DIFERENTE DO SELECIONA(SE ALGUM FOI SELECIONADO)
                            // OU TRARÁ TODO CUJO CÓDIGO É DIFERENTE DE 0(TODOS, SE NENHUM SELECIONADO)
                            $sql = "SELECT * FROM tbl_destaque_noticia_principal WHERE cod_destaque <> ".$codUrlDestaque;
                            $select = mysqli_query($conexao, $sql);

                            while($rsDestaque = mysqli_fetch_array($select)){
                                $codDestaque = $rsDestaque['cod_destaque'];
                                $nvlDestaque = $rsDestaque['destaque'];
                        ?>
                        <option value="<?php echo $codDestaque ?>"><?php echo $nvlDestaque; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <div id="tabela-principais">
                        <table id="table-principais">
                            <tr class="table-titles">
                                <th class="title-titulo">Título</th>
                                <th class="title-autor">Autor</th>
                                <th class="title-nivel">Nível</th>
                                <th class="title-editar">Editar</th>
                                <th class="title-excluir">Excluir</th>
                                <th class="title-status">Status</th>
                            </tr>
                            <?php
                                // SE UM NIVEL DE DESTAQUE FOI SELECIONADO, UMA VARIÁVEL RECEBE ESTE CODIGO,  E OUTRA RECEBE
                                // O PARÂMETRO WHERE DO SQL PARA QUE O SELECT DO SQL O RECEBA, E FAÇA UMA COMPARAÇÃO DE = COM O CÓDIGO SELECIONADO
                                if(isset($_GET['codDtq']) && $_GET['codDtq'] != 0){
                                    $codUrlDestaque = $_GET['codDtq'];
                                    $where = "WHERE np.cod_destaque = ".$codUrlDestaque;
                                }else{
                                    // SE UM NIVEL DE DESTAQUE NÃO FOI SELECIONADO, UMA VARIÁVEL RECEBE 0 E OUTRA E RECEBE O
                                    // PARÂMETRO WHERE DO SQL PARA QUE DEPOIS, O SELECT SQL O RECEBA E FAÇA UMA COMPARAÇÃO DE 
                                    // > COM O CODIGO QUE É 0 PARA QUE TRAGA TODOS OS REGISTRO EXISTENTES DO BANCO
                                    $codUrlDestaque = 0;
                                    $where = "WHERE np.cod_destaque > ".$codUrlDestaque;
                                }
                                
                                // SCRIPT SLQ QUE TRAZ DO BANCO A LISTA DE NOTICIAS GERAIS ADICIONADAS
                                $sql = "SELECT np.cod_noticia, np.titulo_noticia,
                                np.status, np.resumo, np.cod_destaque,
                                np.autor, np.cod_destaque, np.imagem, dnp.destaque
                                FROM tbl_noticia_principal AS np
                                INNER JOIN tbl_destaque_noticia_principal AS dnp 
                                ON np.cod_destaque = dnp.cod_destaque ".$where;
                                
                                $select = mysqli_query($conexao, $sql);
                                
                                while($rsNoticia = mysqli_fetch_array($select)){
                                    $titulo = $rsNoticia['titulo_noticia'];
                                    $status = "'".$rsNoticia['status']."'";
                                    $autor = $rsNoticia['autor'];
                                    $codNoticia = $rsNoticia['cod_noticia'];
                                    $destaque = "'".$rsNoticia['destaque']."'";
                                    $codDestaque = $rsNoticia['cod_destaque'];
                                    $tipoNoticia = "'".'principal'."'";
                                    $imagemNoticia = $rsNoticia['imagem'];

                                    $alt = $rsNoticia['status'] == 'ativado' ? 'Desativar' : 'Ativar';
                                    $title = $rsNoticia['status'] == 'ativado' ? 'Desativar' : 'Ativar';
                                    $img = $rsNoticia['status'] == 'ativado' ? 'ativado.png' : 'desativado.png';
                            ?>
                            <tr class="tables-registers">
                                <td class="txt-titulo"><?php echo($titulo); ?></td>
                                <td class="txt-autor"><?php echo($autor); ?></td>
                                <td class="txt-nivel">
                                    <figure>
                                        <img class="icon-lvl" alt="Notícia de <?php echo($destaque); ?>" title="Notícia de <?php echo($destaque); ?>" src="icons/nvl<?php echo($codDestaque); ?>.png">
                                    </figure>
                                </td>
                                <td class="txt-editar">
                                    <figure>
                                        <!-- BOTAO QUE CHAMA MODAL PARA EDITAR NOTICIA -->
                                        <img onclick="inserirAtualizarNoticia('atualizar', <?php echo($codNoticia.', '.$tipoNoticia); ?>);" class="icon-edit visualizar" alt="Editar Registro <?php echo($codNoticia); ?>" title="Editar Registro <?php echo($codNoticia); ?>" src="icons/edit.png">
                                    </figure>
                                </td>
                                <td class="txt-excluir">
                                    <a href="?codigo=<?php echo($codNoticia); ?>&modo=excluir&tipo=principal&img=<?php echo($imagemNoticia); ?>">
                                        <figure>
                                        <!-- BOTAO QUE EXCLUI NOTICIA -->
                                            <img onclick="return confirmarExclusaoPrincipal('<?php echo($titulo); ?>');" class="icon-del" alt="Excluir Registro <?php echo($codNoticia); ?>" title="Excluir Registro <?php echo($codNoticia); ?>" src="icons/trash.png">
                                        </figure>
                                    </a>
                                </td>
                                <td class="txt-status">
                                    <figure>
                                        <!-- BOTAO QUE ATIVA OU DESATIVA NOTICIA -->
                                        <img onclick="ativarDesativarNoticia('principal', <?php echo($status.', '.$codNoticia.', '.$destaque);?>)" class="icon-status" alt="<?php echo($alt); ?> Registro" title="<?php echo($title); ?> Registro" src="icons/<?php echo($img); ?>">
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
        </div>
        <script src="./js/tiposNoticias.js"></script>
        <script>
            // PEGANDO select  QUE SELECIONA O DESTAQUE DESEJADO
            const slcDestaque = document.getElementById('cmb-nivel');

            // FUNÇÃO QUE MANDA PELA URL O CODIGO E O DESTQUE SELECIONADO PARA QUE AS NOTICIAS
            // DESTE DESTAQUE SEJA CARREGADAS NA TABELA
            const carregarDestaqueSelecionado = () =>{
                // ATRIBUINDO COD_DESTAQUE DO ITEM SELECIONADO À UMA VARIÁVEL
                let codDestaque = slcDestaque.value;
                let destaqueSelecionado = slcDestaque.options[slcDestaque.selectedIndex].textContent;

                // SE NENHUM SELECIONADO, ENVIA O COD_DESTAQUE 0 PARA QUE TODAS AS NOTICIAS SEJAM CARREGADAS DO BANCO
                if(codDestaque == 0){
                    window.location.href = `?codDtq=0`;
                }else if(codDestaque > 0){// SE 1 SELECIONADO, ENVIA O COD_DESTAQUE 1 PARA QUE TODAS AS NOTICIAS DE COD_DESTAQUE 1 SEJAM CARREGADAS DO BANCO
                    window.location.href = `?codDtq=${codDestaque}&destaque=${destaqueSelecionado}`;
                }
            }

            slcDestaque.addEventListener('change', carregarDestaqueSelecionado);
        </script>
    </body>
</html>