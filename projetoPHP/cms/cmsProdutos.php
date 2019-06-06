<?php

    require_once ('./verificarUsuario.php');
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    if(isset($_POST['modoCategoria']) && $_POST['modoCategoria'] == 'editar'){
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
        $_SESSION['cod_relacionamento'] = $_POST['codRelacao'];

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
                        header("location: cmsProdutos.php");
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

    if(isset($_POST['modoProduto']) && $_POST['modoProduto'] == 'editar'){
        $btnEnviarProduto = "ATUALIZAR";
        $_SESSION['cod_produto'] = $_POST['codProduto'];

    }else{
        $btnEnviarProduto = "ENVIAR";
    }

    if(isset($_POST['btn_add_produto'])){
        if((isset($_POST['txt_nome_produto']) && !empty($_POST['txt_nome_produto'])) &&
            (isset($_POST['txt_descricao_produto']) && $_POST['txt_descricao_produto'] != null) && 
            (isset($_POST['txt_preco_produto']) && $_POST['txt_preco_produto'] != null) &&
            $_FILES['file_produto']['error'] == 0){

            echo(".............".$_FILES['file_produto']['error']);
            require_once('./uploadArquivo.php');

            $produto = $_POST['txt_nome_produto'];
            $descricaoProduto = $_POST['txt_descricao_produto'];
            $precoProduto = str_replace(",", ".", $_POST['txt_preco_produto']);
            $imagem = salvarArquivo($_FILES['file_produto'], 'inserir');

            if($_POST['btn_add_produto'] == 'ENVIAR'){
                if($imagem != 'sizeError' && $imagem != 'extensionError'){
                    $sql = "INSERT INTO tbl_produto (nome, descricao, preco, imagem)
                    VALUES ('".$produto."', '".$descricaoProduto."', ".$precoProduto.", '".$imagem."')";

                    if(mysqli_query($conexao, $sql)){
                        header('location: cmsProdutos.php');
                    }else{
                        echo 'não inserido<br>'.$sql;
                    }

                }elseif($imagem == 'extensionError'){
                    echo("<script>alert('O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                }elseif($imagem == 'sizeError'){
                    echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                }
            }elseif($_POST['btn_add_produto'] == 'ATUALIZAR'){
                $sql = "UPDATE tbl_produto SET produto = '".strip_tags(addslashes($produto))."' WHERE cod_produto = ".$_SESSION['cod_produto'];
                
                if(mysqli_query($conexao, $sql)){
                    $sql = "UPDATE tbl_produto_subcategoria_categoria SET cod_categoria = '".$codCategoriaProduto."', cod_subcategoria = '".$codSubcategoriaProduto."', cod_produto = '".$_SESSION['cod_produto']."'
                            WHERE cod_categoria_subcategoria = ".$_SESSION['cod_relacionamento'];
                    if(mysqli_query($conexao, $sql)){
                        header("location: cmsProdutos.php?produtos");
                    }else{
                        echo ("relacionamento".$sql);
                    }
                }else{
                    echo ("sub".$sql);
                }
            }
            $_SESSION['cod_subcategoria'] = null;
            $_SESSION['cod_categoria_sub'] = null;
            $_SESSION['cod_relacionamento'] = null;

        }else{
            echo(
            "<script>
                alert('Campo do nome da produto NÃO pode ser vazio');
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
                                <input maxlength="50" id="txt-nome-produto" class="inputs-produto" name="txt_nome_produto">
                            </div>
                            <div id="preco-img-produto">
                                <div id="preco-produto">
                                    <h3><label>Preço:</label></h3>
                                    <input maxlength="20" id="txt-preco-produto" class="inputs-produto" name="txt_preco_produto">
                                </div>
                                <div id="img-produto">
                                    <h3><label>Imagem:</label></h3>
                                    <input type="file" id="file-produto" class="inputs-produto" name="file_produto">
                                </div>
                            </div>
                            <div id="descricao-produto">
                                <h3><label>Descrição:</label></h3>
                                <textarea maxlength="105" id="txt-descricao-produto" class="inputs-produto" name="txt_descricao_produto"></textarea>
                            </div>
                            <div id="enviar-produto" class="flexbox"> <!-- CAMPO DE BOTAO DE SUBMISSAO -->
                                <input type="submit" class="btn-confirmacao" name="btn_add_produto" value="<?= $btnEnviarProduto ?>">
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
                                        
                                        $statusProduto = $rsProduto['status'] == "ativado" ? "'desativado'" : "'ativado'";

                                        $altTitleProduto = $rsProduto['status'] == 'ativado' ? 'Desativar Registro '.$codSubcategoria : 'Ativar Registro '.$codSubcategoria;
                                        $imgProduto = $rsProduto['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-titulo-produto"><?php echo $tituloProduto ?></td>
                                    <!-- BOTAO DE EDITAR -->
                                    <td class="txt-editar">
                                        <a href="?modoProduto=editar&codProduto=<?= $codProduto ?>&nomeProduto=<?= $tituloProduto ?>">
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

                    <!-- <div id="container-relacoes">
                        <form name="frm-relacoes" method="POST" action="cmsProdutos.php">
                            <div id="nome-produto">
                                <h3><label>Nome Produto:</label></h3>
                                <input id="txt-nome-produto" class="inputs-produto" name="txt_nome_produto">
                            </div>
                            <div id="categoria-img-produto">
                                <div id="categoria-produto">
                                    <h3><label>Categoria:</label></h3>
                                    <select id="slt-nome-categoria-produto" class="inputs-produto" name="slt_nome_categoria_produto" >
                                        <?php
                                            $codCategoriaProduto = isset($_POST['codCategoriaProduto'])?$_POST['codCategoriaProduto']:0;
                                            $categoriaProduto = isset($_POST['nomeCategoriaProduto'])?$_POST['nomeCategoriaProduto']:0;
                                            if($codCategoriaProduto != 0){
                                        ?>
                                        <option value="<?php echo $codCategoriaProduto ?>"><?php echo $categoriaProduto?></option>
                                        <?php
                                            }else{
                                        ?>
                                        <option value="">Escolha uma Categoria</option>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            echo $codCategoriaProduto;
                                            // SCRIPT SQL QUE TRAZ TODOS SOBRE DO BANCO
                                            $sql = "SELECT * FROM tbl_categoria WHERE cod_categoria <> ".$codCategoriaProduto." ORDER BY cod_categoria DESC";
                                            $select = mysqli_query($conexao, $sql);
                                            while($rsCategoriaProduto = mysqli_fetch_array($select)) {
                                                // RESGATNO DADOS DO BANCO
                                                $codCategoriaProduto = $rsCategoriaProduto['cod_categoria'];
                                                $categoriaProduto = $rsCategoriaProduto['categoria'];
                                        ?>
                                            <option value="<?= $codCategoriaProduto ?>"><?= $categoriaProduto ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div id="img-produto">
                                    <h3><label>Imagem:</label></h3>
                                    <input type="file" id="file-produto" class="inputs-produto" name="file_produto">
                                </div>
                            </div>
                            <div id="subcategorias-descricao-produto">
                                <div id="subcategorias-produto">
                                    <h3><label>Subcategorias:</label></h3>
                                    <div id="chks-subcategorias"></div>
                                </div>
                                <div id="descricao-produto">
                                    <h3><label>Descrição:</label></h3>
                                    <textarea id="txt-descricao-produto" class="inputs-produto" name="txt_descricao_produto"></textarea>
                                </div>
                            </div>
                            <div id="preco-produto">
                                <h3><label>Preço:</label></h3>
                                <input id="txt-preco-produto" class="inputs-produto" name="txt_preco_produto">
                            </div>
                            <div id="enviar-produto" class="flexbox"> 
                                <input type="submit" class="btn-confirmacao" name="btn_add_produto" value="<?= $btnEnviarProduto ?>">
                            </div>
                        </form>
                        <div id="tabela-produtos" class="flexbox">
                            <table id="table-produtos">
                                <tr class="table-titles">
                                    <th class="title-produto">Produto</th>
                                    <th class="title-categoria-produto">Categoria</th>
                                    <th class="title-subcategoria-produto">Subcategoria</th>
                                    <th class="title-editar">Editar</th>
                                    <th class="title-status">Status</th>
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
                                    ORDER BY c.cod_categoria DESC";

                                    $select = mysqli_query($conexao, $sql);
                                    while($rsProduto = mysqli_fetch_array($select)) {
                                        // RESGATNO DADOS DO BANCO

                                        $codProduto = $rsProduto['cod_produto'];
                                        $tituloProduto = $rsProduto['nome'];


                                        $codCategoriaProduto = $rsProduto['cod_categoria'];
                                        $tituloCategoriaProduto = $rsProduto['categoria'];

                                        $codSubcategoriaProduto = $rsProduto['cod_subcategoria'];
                                        $tituloSubcategoriaProduto = $rsProduto['subcategoria'];
                                        
                                        $codProdutoCategoriaSub = $rsProduto['cod_produto_subcategoria_categoria'];

                                        $statusProduto = $rsProduto['status'] == "ativado" ? "'desativado'" : "'ativado'";

                                        $altTitleProduto = $rsProduto['status'] == 'ativado' ? 'Desativar Registro '.$codSubcategoria : 'Ativar Registro '.$codSubcategoria;
                                        $imgProduto = $rsProduto['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-titulo-produto"><?php echo $tituloProduto ?></td>
                                    <td class="txt-titulo-categoria-produto"><?php echo $tituloCategoriaProduto ?></td>
                                    <td class="txt-titulo-subcategoria-produto"><?php echo $tituloSubcategoriaProduto ?></td>
                                    <td class="txt-editar">
                                        <a href="?modoProduto=editar&codProduto=<?= $codProduto ?>&nomeProduto=<?= $tituloProduto ?>
                                        &codCategoriaProduto=<?= $codCategoriaProduto ?>&nomeCategoriaProduto=<?= $tituloCategoriaProduto ?>
                                        &codSubcategoriaProduto=<?= $codSubcategoriaProduto ?>&nomeSubcategoriaProduto=<?= $tituloSubcategoriaProduto ?>
                                        &codRelacaoProduto=<?= $codProdutoCategoriaSub ?>">
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
                    </div> -->
                </div>
            </div>
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('./footer.html');
            ?>
        </div>
    </body>
</html>