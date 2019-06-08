<?php

    require_once ('./verificarUsuario.php');
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    if(isset($_POST['modoCategoria']) && $_GET['modoCategoria'] == 'editar'){
        $btnEnviarCategoria = "ATUALIZAR";
        $_SESSION['cod_categoria'] = $_POST['codigoCategoria'];
    }else{
        $btnEnviarCategoria = "ENVIAR";
    }

    if(isset($_POST['btn_add_categoria'])){
        if(isset($_POST['txt_nome_categoria']) && !empty($_POST['txt_nome_categoria'])){
            $categoria = $_POST['txt_nome_categoria'];

            if($_POST['btn_add_categoria'] == 'ENVIAR'){
                $sql = "INSERT INTO tbl_categoria (categoria) VALUES ('".strip_tags(addslashes($categoria))."')";

            }elseif($_POST['btn_add_categoria'] == 'ATUALIZAR'){
                $sql = "UPDATE tbl_categoria SET categoria = '".strip_tags(addslashes($categoria))."' WHERE cod_categoria = ".$_SESSION['cod_categoria'];
            }

            if(mysqli_query($conexao, $sql)){
                header("location: cmsProdutos.php?categorias");
            }else{
                echo ($sql);
                echo "<br>".mysqli_error($conexao);
            }
            $_SESSION['cod_categoria'] = null;
        }else{
            echo(
            "<script>
                alert('Campo do nome da categoria NÃO pode ser vazio');
            </script>");
        }
    }
    
    if(isset($_POST['modoSub']) && $_POST['modoSub'] == 'editar'){
        $btnEnviarSubcategoria = "ATUALIZAR";
        $_SESSION['cod_subcategoria'] = $_POST['codSub'];
        $_SESSION['cod_relacionamento'] = $_GET['codRelacao'];

    }else{
        $btnEnviarSubcategoria = "ENVIAR";
    }

    if(isset($_POST['btn_add_subcategoria'])){
        if((isset($_POST['txt_nome_subcategoria']) && !empty($_POST['txt_nome_subcategoria'])) &&
            (isset($_POST['slt_nome_categoria_sub']) && $_POST['slt_nome_categoria_sub'] != null)){
            $subcategoria = $_POST['txt_nome_subcategoria'];
            $codCategoriaSub = $_POST['slt_nome_categoria_sub'];

            if($_POST['btn_add_subcategoria'] == 'ENVIAR'){
                $sql = "INSERT INTO tbl_subcategoria (subcategoria) VALUES ('".strip_tags(addslashes($subcategoria))."')";
                
                if(mysqli_query($conexao, $sql)){
                    $codSubcategoria = mysqli_insert_id($conexao);
                    $sql = "INSERT INTO tbl_categoria_subcategoria (cod_categoria, cod_subcategoria)
                            VALUES ('".$codCategoriaSub."', '".$codSubcategoria."')";
                    if(mysqli_query($conexao, $sql)){
                        header("location: cmsProdutos.php?subcategorias");
                    }else{
                        echo ("relacionamento".$sql);
                        echo "<br>".mysqli_error($conexao);
                    }
                }else{
                    echo ("sub55555".$sql);
                    echo "<br>".mysqli_error($conexao);
                }

            }elseif($_POST['btn_add_subcategoria'] == 'ATUALIZAR'){
                $sql = "UPDATE tbl_subcategoria SET subcategoria = '".strip_tags(addslashes($subcategoria))."' WHERE cod_subcategoria = ".$_SESSION['cod_subcategoria'];
                
                if(mysqli_query($conexao, $sql)){
                    $sql = "UPDATE tbl_categoria_subcategoria SET cod_categoria = '".$codCategoriaSub ."', cod_subcategoria = '".$_SESSION['cod_subcategoria']."'
                            WHERE cod_categoria_subcategoria = ".$_SESSION['cod_relacionamento'];
                    if(mysqli_query($conexao, $sql)){
                        header("location: cmsProdutos.php?subcategorias");
                    }else{
                        echo ("relacionamento".$sql);
                        echo "<br>".mysqli_error($conexao);
                    }
                }else{
                    echo ("sub".$sql);
                    echo "<br>".mysqli_error($conexao);
                }
            }
            $_SESSION['cod_subcategoria'] = null;
            $_SESSION['cod_categoria_sub'] = null;
            $_SESSION['cod_relacionamento'] = null;

        }else{
            echo(
            "<script>
                alert('Campo do nome da subcategoria NÃO pode ser vazio');
            </script>");
        }
    }

    if(isset($_GET['modoProduto']) && $_GET['modoProduto'] == 'editar'){
        $btnEnviarProduto = "ATUALIZAR";
        $_SESSION['cod_produto'] = $_GET['codProduto'];
        $_SESSION['img'] = $_GET['imgProduto'];
    }else{
        $btnEnviarProduto = "ENVIAR";
    }

    if(isset($_POST['btn_add_produto'])){
        if((isset($_POST['txt_nome_produto']) && !empty($_POST['txt_nome_produto'])) &&
            (isset($_POST['txt_descricao_produto']) && $_POST['txt_descricao_produto'] != null) && 
            (isset($_POST['txt_preco_produto']) && $_POST['txt_preco_produto'] != null)){

            echo("............. -->".$_POST['btn_add_produto']."<br>");
            require_once('./uploadArquivo.php');

            $produto = $_POST['txt_nome_produto'];
            $descricaoProduto = $_POST['txt_descricao_produto'];
            $precoProduto = str_replace(",", ".", $_POST['txt_preco_produto']);

            if($_POST['btn_add_produto'] == 'ENVIAR'){
                if($_FILES['file_produto']['error'] == 0){
                    $imagem = salvarArquivo($_FILES['file_produto'], 'inserir');
        
                    if($imagem != 'sizeError' && $imagem != 'extensionError'){
                        $sql = "INSERT INTO tbl_produto (nome, descricao, imagem, preco)
                        VALUES ('".strip_tags(addslashes($produto))."', '".strip_tags(addslashes($descricaoProduto))."', '".$imagem."', ".strip_tags(addslashes($precoProduto)).")";
    
                        if(mysqli_query($conexao, $sql)){
                            header('location: cmsProdutos.php?produtos');
                        }else{
                            echo 'não inserido<br>'.$sql;
                        }
    
                    }elseif($imagem == 'extensionError'){
                        echo("<script>alert('O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO 1.')</script>");
                    }elseif($imagem == 'sizeError'){
                        echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO 1.')</script>");
                    }
                }else{
                    echo(
                    "<script>
                        alert('Não é possível inserir produto sem imagem.');
                    </script>");
                }
            }elseif($_POST['btn_add_produto'] == 'ATUALIZAR'){
                if($_FILES['file_produto']['error'] == 0){
                    $imagem = salvarArquivo($_FILES['file_produto'], 'atualizar');
        
                    if($imagem != 'sizeError' && $imagem != 'extensionError'){
                        $sql = "UPDATE tbl_produto SET nome = '".strip_tags(addslashes($produto))."', descricao = '".strip_tags(addslashes($descricaoProduto))."',
                        imagem = '".$imagem."', preco = ".strip_tags(addslashes($precoProduto))." WHERE cod_produto = ".$_SESSION['cod_produto'];
    
                    }elseif($imagem == 'extensionError'){
                        echo("<script>alert('O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO 2.')</script>");
                    }elseif($imagem == 'sizeError'){
                        echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO 2.')</script>");
                    }
                }else{
                    $sql = "UPDATE tbl_produto SET nome = '".strip_tags(addslashes($produto))."', descricao = '".strip_tags(addslashes($descricaoProduto))."', 
                    preco = ".strip_tags(addslashes($precoProduto))." WHERE cod_produto = ".$_SESSION['cod_produto'];
                }
                
                    
                if(mysqli_query($conexao, $sql)){
                    header('location: cmsProdutos.php?produtos');
                }else{
                    echo 'não inserido<br>'.$sql;
                }

            }
            $_SESSION['cod_produto'] = null;
            $_SESSION['img'] = null;
        }else{
            echo(
            "<script>
                alert('Campo do nome da produto NÃO pode ser vazio');
            </script>");
        }
    }

    if(isset($_GET['modoRelacao']) && $_GET['modoRelacao'] == 'editar'){
        $btnEnviarRelacao = "ATUALIZAR";
        $_SESSION['cod_relacao_produto'] = $_GET['codRelacaoProduto'];

        $_SESSION['cod_categoria_relacao'] = $_GET['codCategoriaRelacao'];
        $_SESSION['categoria_relacao'] = $_GET['categoriaRelacao'];

        $_SESSION['cod_produto_relacao'] = $_GET['codProdutoRelacao'];
        $_SESSION['produto_relacao'] = $_GET['produtoRelacao'];
    }else{
        $btnEnviarRelacao = "ENVIAR";
    }

    if(isset($_GET['btn_add_relacao'])){
        if(isset($_GET['slt_categoria_produto']) && isset($_GET['slt_subcategoria_produto']) && isset($_GET['slt_produto'])){
            $codCategoria = $_GET['slt_categoria_produto'];
            $codSubcategoria = $_GET['slt_subcategoria_produto'];
            $codProduto = $_GET['slt_produto'];

            if($_GET['btn_add_relacao'] == 'ENVIAR'){
                $sql = "INSERT INTO tbl_produto_subcategoria_categoria (cod_categoria, cod_subcategoria, cod_produto)
                VALUES ('".$codCategoria."', '".$codSubcategoria."', '".$codProduto."')";

            }elseif($_GET['btn_add_relacao'] == 'ATUALIZAR'){
                $sql = "UPDATE tbl_produto_subcategoria_categoria
                SET cod_categoria = '".$codCategoria."',
                cod_subcategoria = '".$codSubcategoria."', cod_produto = '".$codProduto."'
                WHERE cod_produto_subcategoria_categoria = ".$_SESSION['cod_relacao_produto'];
            }

            if(mysqli_query($conexao, $sql)){
                header("location: cmsProdutos.php?relacoes");
            }else{
                echo ($sql);
                echo "<br>".mysqli_error($conexao);
            }
            $_SESSION['cod_relacao_produto'] = null;
            $_SESSION['cod_categoria_relacao'] = null;
            $_SESSION['categoria_relacao'] = null;
        }else{
            echo(
            "<script>
                alert('Categoria, Subcategoria e Produto devem ser selecionados!');
            </script>");
        }
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/fontes.css">
    <title>GERENCIAR PRODUTOS</title>
    <meta charset="utf-8">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/cmsProdutos.js"></script>
    <script>
        function ativarDesativarCategoria(codCategoria, status){
            console.log(`${codCategoria} e ${status}`);
            $.ajax({
                type: 'GET',
                url: './status.php',
                data: {pagina: 'categoria', codigo: codCategoria, status: status},
                complete: function (response) {
                    location.href = "?categorias"
                },
                error: function(){

                }
            });
        }

        function ativarDesativarSubcategoria(codSubategoria, status){
            console.log(`${codSubategoria} e ${status}`);
            $.ajax({
                type: 'GET',
                url: './status.php',
                data: {pagina: 'subcategoria', codigo: codSubategoria, status: status},
                complete: function (response) {
                    location.href = "?subcategorias"
                },
                error: function(){

                }
            });
        }
        function ativarDesativarProduto(codProduto, status){
            console.log(`${codProduto} e ${status}`);
            $.ajax({
                type: 'GET',
                url: './status.php',
                data: {pagina: 'produto', codigo: codProduto, status: status},
                complete: function (response) {
                    location.href = "?produtos"
                },
                error: function(){

                }
            });
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
            <div id="conteudo-produtos">
                <div id="menu-selecao-produtos">
                    <div id="selecao-adm-categoria" class="item-selecionar-menu-produtos">Categorias</div>
                    <div id="selecao-adm-subcategoria" class="item-selecionar-menu-produtos">Subategorias</div>
                    <div id="selecao-adm-produto" class="item-selecionar-menu-produtos">Produtos</div>
                    <div id="selecao-adm-relacoes" class="item-selecionar-menu-produtos">Relações</div>
                </div>
                <div id="container-categorias-produtos">
                    <div id="container-categorias">
                        <form name="frm-categoria" method="POST" action="cmsProdutos.php?categorias">
                            <div id="nome-categoria">
                                <h3><label>Nome Categoria:</label></h3>
                                <input id="txt-nome-categoria" value="<?php echo(isset($_POST['nomeCategoria'])?$_POST['nomeCategoria']:''); ?>" class="inputs-produto" name="txt_nome_categoria" alt="Nome da Categoria" title="Nome da Categoria">
                            </div>
                            <div id="enviar-categoria" class="flexbox"> <!-- CAMPO DE BOTAO DE SUBMISSAO -->
                                <input type="submit" class="btn-confirmacao" name="btn_add_categoria" value="<?= $btnEnviarCategoria ?>">
                            </div>
                        </form>
                        <div id="tabela-categorias" class="flexbox">
                            <table id="table-categorias">
                                <tr class="table-titles">
                                    <th class="title-categorias">Categoria</th>
                                    <th class="title-editar">Editar</th>
                                    <!-- <th class="title-excluir">Excluir</th> -->
                                    <th class="title-status">Status</th>
                                </tr>
                                <?php
                                    // SCRIPT SQL QUE TRAZ TODOS SOBRE DO BANCO
                                    $sql = "SELECT * FROM tbl_categoria ORDER BY cod_categoria DESC";
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsCategoria = mysqli_fetch_array($select)) {
                                        // RESGATNO DADOS DO BANCO
                                        $codCategoria = $rsCategoria['cod_categoria'];
                                        $tituloCategoria = $rsCategoria['categoria'];
                                        $statusCategoria = $rsCategoria['status'] == "ativado" ? "'desativado'" : "'ativado'";


                                        $altTitleCategoria = $rsCategoria['status'] == 'ativado' ? 'Desativar Registro '.$codCategoria : 'Ativar Registro '.$codCategoria;
                                        $imgCategoria = $rsCategoria['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-titulo-categoria"><?php echo $tituloCategoria ?></td>
                                    <!-- BOTAO DE EDITAR -->
                                    <td class="txt-editar">
                                        <a href="?modo=editar&codigoCategoria=<?= $codCategoria ?>&nomeCategoria=<?= $tituloCategoria ?>">
                                            <figure>
                                                <img class="icon-edit visualizar" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codCategoria ?>" title="<?php echo 'Editar Registro '.$codCategoria ?>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td class="txt-status">
                                        <figure>
                                            <img onclick="ativarDesativarCategoria(<?php echo($codCategoria.', '.$statusCategoria); ?>)" class="icon-status" src="./icons/<?php echo $imgCategoria ?>" alt="<?php echo $altTitleCategoria ?>" title="<?php echo $altTitleCategoria ?>">
                                        </figure>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>

                    <div id="container-subcategorias">
                        <form name="frm-subcategoria" method="POST" action="cmsProdutos.php?subcategorias">
                            <div id="nome-subcategoria">
                                <h3><label>Nome Subategoria:</label></h3>
                                <input id="txt-nome-subcategoria" value="<?php echo(isset($_POST['nomeSub'])?$_POST['nomeSub']:''); ?>" class="inputs-produto" name="txt_nome_subcategoria" alt="Nome da Subcategoria" title="Nome da Subcategoria">
                            </div>
                            <div id="nome-categoria-sub">
                                <h3><label>Subcategoria:</label></h3>
                                <select id="slt-nome-categoria-sub" class="inputs-produto" name="slt_nome_categoria_sub" alt="Categoria da Subcategoria" title="Categoria da Subcategoria">
                                <?php
                                    $codCategoriaSub = isset($_POST['codCategoriaSub'])?$_POST['codCategoriaSub']:0;
                                    $categoriaSub = isset($_POST['nomeCategoriaSub'])?$_POST['nomeCategoriaSub']:0;
                                    if($codCategoriaSub != 0){
                                ?>
                                <option value="<?php echo $codCategoriaSub ?>"><?php echo $categoriaSub ?></option>
                                <?php
                                    }else{
                                ?>
                                <option value="">Escolha uma Categoria</option>
                                <?php
                                    }
                                ?>
                                <?php
                                    // SCRIPT SQL QUE TRAZ TODOS SOBRE DO BANCO
                                    $sql = "SELECT * FROM tbl_categoria WHERE cod_categoria <> ".$codCategoriaSub." ORDER BY cod_categoria DESC";
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsCategoria = mysqli_fetch_array($select)) {
                                        // RESGATNO DADOS DO BANCO
                                        $codCategoriaSub = $rsCategoria['cod_categoria'];
                                        $categoriaSub = $rsCategoria['categoria'];
                                ?>
                                    <option value="<?= $codCategoriaSub ?>"><?= $categoriaSub ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <div id="enviar-subcategoria" class="flexbox"> <!-- CAMPO DE BOTAO DE SUBMISSAO -->
                                <input type="submit" class="btn-confirmacao" name="btn_add_subcategoria" value="<?= $btnEnviarSubcategoria ?>">
                            </div>
                        </form>
                        <div id="tabela-subcategorias" class="flexbox">
                            <table id="table-subcategorias">
                                <tr class="table-titles">
                                    <th class="title-subcategorias">Subcategoria</th>
                                    <th class="title-categoria-sub">Categoria</th>
                                    <th class="title-editar">Editar</th>
                                    <th class="title-status">Status</th>
                                </tr>
                                <?php
                                    // SCRIPT SQL QUE TRAZ TODOS SOBRE DO BANCO
                                    $sql = "SELECT s.subcategoria, s.cod_subcategoria, s.status,
                                    c.cod_categoria, c.categoria, cs.cod_categoria_subcategoria
                                    FROM tbl_categoria AS c
                                    INNER JOIN tbl_categoria_subcategoria AS cs
                                    ON c.cod_categoria = cs.cod_categoria
                                    INNER JOIN tbl_subcategoria AS s
                                    ON cs.cod_subcategoria = s.cod_subcategoria
                                    ORDER BY c.cod_categoria DESC";

                                    $select = mysqli_query($conexao, $sql);
                                    while($rsSubcategoria = mysqli_fetch_array($select)) {
                                        // RESGATNO DADOS DO BANCO
                                        $codSubcategoria = $rsSubcategoria['cod_subcategoria'];
                                        $tituloSubcategoria = $rsSubcategoria['subcategoria'];

                                        $codCategoriaSub = $rsSubcategoria['cod_categoria'];
                                        $tituloCategoriaSub = $rsSubcategoria['categoria'];
                                        
                                        $codCategoriaSubcategoria = $rsSubcategoria['cod_categoria_subcategoria'];

                                        $statusSubcategoria = $rsSubcategoria['status'] == "ativado" ? "'desativado'" : "'ativado'";

                                        $altTitleSubcategoria = $rsSubcategoria['status'] == 'ativado' ? 'Desativar Registro '.$codSubcategoria : 'Ativar Registro '.$codSubcategoria;
                                        $imgSubcategoria = $rsSubcategoria['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-titulo-subcategoria"><?php echo $tituloSubcategoria ?></td>
                                    <td class="txt-titulo-categoria-sub"><?php echo $tituloCategoriaSub ?></td>
                                    <!-- BOTAO DE EDITAR -->
                                    <td class="txt-editar">
                                        <a href="?modoSub=editar&codSub=<?= $codSubcategoria ?>&nomeSub=<?= $tituloSubcategoria ?>&codCategoriaSub=<?= $codCategoriaSub ?>&nomeCategoriaSub=<?= $categoriaSub ?>&codRelacao=<?= $codCategoriaSubcategoria ?>">
                                            <figure>
                                                <img class="icon-edit visualizar" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codSubcategoria ?>" title="<?php echo 'Editar Registro '.$codSubcategoria ?>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td class="txt-status">
                                        <figure>
                                            <img onclick="ativarDesativarSubcategoria(<?php echo($codSubcategoria.', '.$statusSubcategoria); ?>)" class="icon-status" src="./icons/<?php echo $imgSubcategoria ?>" alt="<?php echo $altTitleSubcategoria ?>" title="<?php echo $altTitleSubcategoria ?>">
                                        </figure>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>

                    <div id="container-produtos">
                        <form enctype="multipart/form-data" name="frm_produto" method="POST" action="cmsProdutos.php?produtos">
                            <div id="nome-produto">
                                <h3><label>Nome Produto:</label></h3>
                                <input maxlength="50" id="txt-nome-produto" class="inputs-produto" name="txt_nome_produto" value="<?php echo(isset($_GET['nomeProduto'])?$_GET['nomeProduto']:'') ?>">
                            </div>
                            <div id="preco-img-produto">
                                <div id="preco-produto">
                                    <h3><label>Preço:</label></h3>
                                    <input maxlength="20" id="txt-preco-produto" class="inputs-produto" name="txt_preco_produto" value="<?php echo(isset($_GET['preco'])?$_GET['preco']:'') ?>">
                                </div>
                                <div id="img-produto">
                                    <h3><label>Imagem:</label></h3>
                                    <input type="file" id="file-produto" class="inputs-produto" name="file_produto">
                                </div>
                            </div>
                            <div id="descricao-produto">
                                <h3><label>Descrição:</label></h3>
                                <textarea maxlength="105" id="txt-descricao-produto" class="inputs-produto" name="txt_descricao_produto"><?php echo(isset($_GET['descricao'])?$_GET['descricao']:'') ?></textarea>
                            </div>
                            <div id="enviar-produto" class="flexbox"> <!-- CAMPO DE BOTAO DE SUBMISSAO -->
                                <input type="submit" class="btn-confirmacao" name="btn_add_produto" value="<?php echo $btnEnviarProduto ?>">
                            </div>
                        </form>
                        <div id="tabela-produtos" class="flexbox">
                            <table id="table-produtos">
                                <tr class="table-titles">
                                    <th class="title-produto">Produto</th>
                                    <th class="title-editar">Editar</th>
                                    <th class="title-status">Status</th>
                                </tr>
                                <?php
                                
                                    $sql = "SELECT * FROM tbl_produto ORDER BY cod_produto DESC";
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsProduto = mysqli_fetch_array($select)) {
                                        // RESGATNO DADOS DO BANCO

                                        $codProduto = $rsProduto['cod_produto'];
                                        $tituloProduto = $rsProduto['nome'];
                                        $precoProduto = $rsProduto['preco'];
                                        $descricaoProduto = $rsProduto['descricao'];
                                        $imagemProduto = $rsProduto['imagem'];
                                        
                                        $statusProduto = $rsProduto['status'] == "ativado" ? "'desativado'" : "'ativado'";

                                        $altTitleProduto = $rsProduto['status'] == 'ativado' ? 'Desativar Registro '.$codSubcategoria : 'Ativar Registro '.$codSubcategoria;
                                        $imgProduto = $rsProduto['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-titulo-produto"><?php echo $tituloProduto ?></td>
                                    <!-- BOTAO DE EDITAR -->
                                    <td class="txt-editar">
                                        <a href="?modoProduto=editar&codProduto=<?= $codProduto ?>&nomeProduto=<?= $tituloProduto ?>&preco=<?= $precoProduto?>&descricao=<?= $descricaoProduto?>&imgProduto=<?= $imagemProduto ?>">
                                            <figure>
                                                <img class="icon-edit visualizar" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codProduto ?>" title="<?php echo 'Editar Registro '.$codProduto ?>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td class="txt-status">
                                        <figure>
                                            <img onclick="ativarDesativarProduto(<?php echo($codProduto.', '.$statusProduto); ?>)" class="icon-status" src="./icons/<?php echo $imgProduto ?>" alt="<?php echo $altTitleProduto ?>" title="<?php echo $altTitleProduto ?>">
                                        </figure>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>

                    <div id="container-relacoes" class="flexbox">
                        <form name="frm-relacoes" method="GET" action="cmsProdutos.php">
                            <div id="categoria-subcategoria-produto" class="flexbox">
                                <div id="relacao-produto">
                                    <h3><label>Produto:</label></h3>
                                    <select id="slt-produto" class="inputs-produto" name="slt_produto">
                                    <!-- $_SESSION['cod_produto_relacao']
                                    $_SESSION['produto_relacao'] -->
                                        <?php
                                            if($_SESSION['cod_produto_relacao'] == null){
                                                $_SESSION['cod_produto_relacao'] = 0;
                                            }

                                            if($_SESSION['cod_produto_relacao'] != 0 || !isset($_SESSION['cod_produto_relacao'])){
                                        ?>
                                        <option value="<?php echo $_SESSION['cod_produto_relacao'] ?>"><?php echo $_SESSION['produto_relacao'] ?></option>
                                        <?php
                                            }else{
                                        ?>
                                        <option value="">Escolha uma Produto</option>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            echo $codProduto;
                                            // SCRIPT SQL QUE TRAZ TODOS SOBRE DO BANCO
                                            $sql = "SELECT * FROM tbl_produto WHERE cod_produto <> ".$_SESSION['cod_produto_relacao'];
                                            $select = mysqli_query($conexao, $sql);
                                            while($rsProduto = mysqli_fetch_array($select)) {
                                                // RESGATNO DADOS DO BANCO
                                                $codProduto = $rsProduto['cod_produto'];
                                                $nomeProduto = $rsProduto['nome'];
                                        ?>
                                            <option value="<?= $codProduto ?>"><?= $nomeProduto ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div id="relacao-categoria-produto">
                                    <h3><label>Categoria:</label></h3>
                                    <select id="slt-categoria-produto" class="inputs-produto" name="slt_categoria_produto" >
                                        <?php
                                            if($_SESSION['cod_categoria_relacao'] == null){
                                                $_SESSION['cod_categoria_relacao'] = 0;
                                            }

                                            if($_SESSION['cod_categoria_relacao'] != 0 || !isset($_SESSION['cod_categoria_relacao'])){
                                        ?>
                                        <option value="<?php echo $_SESSION['cod_categoria_relacao'] ?>"><?php echo $_SESSION['categoria_relacao'] ?></option>
                                        <?php
                                            }else{
                                        ?>
                                        <option value="">Escolha uma Categoria</option>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            // SCRIPT SQL QUE TRAZ TODOS SOBRE DO BANCO
                                            $sql = "SELECT * FROM tbl_categoria WHERE cod_categoria <> ".$_SESSION['cod_categoria_relacao']." ORDER BY categoria";
                                            echo $sql;
                                            $select = mysqli_query($conexao, $sql);
                                            while($rsCategoria = mysqli_fetch_array($select)) {
                                                // RESGATNO DADOS DO BANCO
                                                $codCategoria = $rsCategoria['cod_categoria'];
                                                $nomeCategoria = $rsCategoria['categoria'];
                                        ?>
                                            <option value="<?= $codCategoria ?>"><?= $nomeCategoria ?></option>
                                        <?php
                                            }
                                            $_SESSION['cod_categoria_relacao'] = null;
                                            $_SESSION['categoria_relacao'] = null;
                                        ?>
                                    </select>
                                </div>
                                <div id="relacao-subcategoria-produto">
                                    <h3><label>Subcategoria:</label></h3>
                                    <select disabled id="slt-subcategoria-produto" class="inputs-produto" name="slt_subcategoria_produto">
                                        <option value="">Escolha uma Subcategoria</option>
                                    </select>
                                </div>
                            </div>
                            <div id="enviar-relacao" class="flexbox"> 
                                <input type="submit" class="btn-confirmacao" name="btn_add_relacao" value="<?= $btnEnviarRelacao ?>">
                            </div>
                        </form>
                        <div id="tabela-relacoes" class="flexbox">
                            <table id="table-relacoes">
                                <tr class="table-titles">
                                    <th class="title-produto-relacao">Produto</th>
                                    <th class="title-categoria-relacao">Categoria</th>
                                    <th class="title-subcategoria-relacao">Subcategoria</th>
                                    <th class="title-editar">Editar</th>
                                </tr>
                                <?php
                                    // SCRIPT SQL QUE TRAZ TODOS SOBRE DO BANCO
                                    $sql = "SELECT * FROM tbl_produto AS p
                                    INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
                                    ON p.cod_produto = tpsc.cod_produto
                                    INNER JOIN tbl_subcategoria AS s
                                    ON tpsc.cod_subcategoria = s.cod_subcategoria
                                    INNER JOIN tbl_categoria AS c
                                    ON tpsc.cod_categoria = c.cod_categoria
                                    ORDER BY p.nome DESC";


                                    $select = mysqli_query($conexao, $sql);
                                    while($rsRelacoes = mysqli_fetch_array($select)) {
                                        // RESGATNO DADOS DO BANCO

                                        $codProdutoRelacao = $rsRelacoes['cod_produto'];
                                        $tituloProdutoRelacao = $rsRelacoes['nome'];

                                        $codCategoriaRelacao = $rsRelacoes['cod_categoria'];
                                        $tituloCategoriaRelacao = $rsRelacoes['categoria'];

                                        $codSubcategoriaRelacao = $rsRelacoes['cod_subcategoria'];
                                        $tituloSubcategoriaRelacao = $rsRelacoes['subcategoria'];
                                        
                                        $codRelacao = $rsRelacoes['cod_produto_subcategoria_categoria'];

                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-produto-relacao"><?php echo $tituloProdutoRelacao ?></td>
                                    <td class="txt-categoria-relacao"><?php echo $tituloCategoriaRelacao ?></td>
                                    <td class="txt-subcategoria-relacao"><?php echo $tituloSubcategoriaRelacao ?></td>
                                    <td class="txt-editar">
                                        <a href="?modoRelacao=editar&codRelacaoProduto=<?= $codRelacao ?>&codCategoriaRelacao=<?= $codCategoriaRelacao?>&categoriaRelacao=<?= $tituloCategoriaRelacao ?>&codSubCatRelacao=<?= $codSubcategoriaRelacao ?>&codProdutoRelacao=<?= $codProdutoRelacao ?>&produtoRelacao=<?=$tituloProdutoRelacao ?>">
                                            <figure>
                                                <img class="icon-edit visualizar" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codProdutoRelacao ?>" title="<?php echo 'Editar Registro '.$codProdutoRelacao ?>">
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
                </div>
            </div>
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('./footer.html');
            ?>
        </div>
    </body>
</html>