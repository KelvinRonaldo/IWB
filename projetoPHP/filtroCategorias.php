<?php
    require_once("bd/conexao.php");
    $conexao = conexaoMySql();

    $codCategoria = $_GET['cod_categoria'];
    $codSubcategoria = $_GET['cod_subcategoria'];

    if($codCategoria == 0 && $codSubcategoria == 0){
        $filtro = "ORDER BY RAND()";
    }elseif($codCategoria != 0 && $codSubcategoria == 0){
        $filtro = "AND c.cod_categoria = ".$codCategoria." AND s.cod_subcategoria > ".$codSubcategoria;
    }elseif($codCategoria != 0 && $codSubcategoria != 0){
        $filtro = "AND c.cod_categoria = ".$codCategoria." AND s.cod_subcategoria = ".$codSubcategoria;
    }

    
    $sql = "SELECT DISTINCT p.nome, p.*, pr.preco_desconto, pr.status AS status_promocao, c.cod_categoria
    FROM tbl_promocao AS pr
    RIGHT JOIN tbl_produto AS p
    ON pr.cod_produto = p.cod_produto
    INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
    ON p.cod_produto = tpsc.cod_produto
    INNER JOIN tbl_subcategoria AS s
    ON tpsc.cod_subcategoria = s.cod_subcategoria
    INNER JOIN tbl_categoria AS c
    ON tpsc.cod_categoria = c.cod_categoria
    WHERE p.status = 'ativado' 
    AND s.status = 'ativado'
    AND c.status = 'ativado'".$filtro;

    $produtos[] = (array) null;
    $arrayProduto[] = (array) null;

    $select = mysqli_query($conexao, $sql);

    while($rsProdutoFiltrado = mysqli_fetch_array($select)){
        $codProduto = $rsProdutoFiltrado['cod_produto'];
        $nomeProduto = $rsProdutoFiltrado['nome'];
        $descricaoProduto = $rsProdutoFiltrado['descricao'];

        if($rsProdutoFiltrado['preco_desconto'] == null){
            $precoProduto = number_format($rsProdutoFiltrado['preco'], 2, ',', '.');
        }else{
            $precoProduto = number_format($rsProdutoFiltrado['preco_desconto'], 2, ',', '.');
        }

        $statusProduto = $rsProdutoFiltrado['status'];
        $statusPromocao = $rsProdutoFiltrado['status_promocao'];
        $imagemProduto = $rsProdutoFiltrado['imagem'];

        $arrayProduto = array(
            "cod_produto" => $codProduto,
            "nome_produto" => $nomeProduto,
            "descricao_produto" => $descricaoProduto,
            "preco_produto" => $precoProduto,
            "status_produto" => $statusProduto,
            "imagem_produto" => $imagemProduto,
            "status_promocao" => $statusPromocao
        );
        array_unshift($produtos, $arrayProduto);
    }
    print_r(json_encode(array_filter($produtos)));
?>