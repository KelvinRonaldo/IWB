<?php
    require_once("./bd/conexao.php");
    $conexao = conexaoMySql();

        $codCategoria = $_GET['cod_categoria'];
        $codSubcategoria = $_GET['cod_subcategoria'];

        if($codCategoria == 0){
            $where = " ORDER BY RAND()";
        }elseif($codCategoria != 0 && $codSubcategoria == 0){
            $where = "AND c.cod_categoria = ".$codCategoria." AND s.cod_subcategoria > ".$codSubcategoria;
        }elseif($codCategoria != 0 && $codSubcategoria != 0){
            $where = "AND c.cod_categoria = ".$codCategoria." AND s.cod_subcategoria = ".$codSubcategoria;
        }

    $sql = "SELECT DISTINCT p.nome, p.*, c.cod_categoria FROM tbl_produto AS p
    INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
    ON p.cod_produto = tpsc.cod_produto
    INNER JOIN tbl_subcategoria AS s
    ON tpsc.cod_subcategoria = s.cod_subcategoria
    INNER JOIN tbl_categoria AS c
    ON tpsc.cod_categoria = c.cod_categoria
    WHERE p.status = 'ativado' ".$where;

    $produtos[] = (array) null;
    $arrayProduto[] = (array) null;

    $select = mysqli_query($conexao, $sql);

    while($rsProdutoFiltrado = mysqli_fetch_array($select)){        
        $codProduto = $rsProdutoFiltrado['cod_produto'];
        $nomeProduto = $rsProdutoFiltrado['nome'];
        $descricaoProduto = $rsProdutoFiltrado['descricao'];
        $precoProduto = $rsProdutoFiltrado['preco'];
        $statusProduto = $rsProdutoFiltrado['status'];
        $imagemProduto = $rsProdutoFiltrado['imagem'];

        $arrayProduto = array(
            "cod_produto" => $codProduto,
            "nome_produto" => $nomeProduto,
            "descricao_produto" => $descricaoProduto,
            "preco_produto" => $precoProduto,
            "status_produto" => $statusProduto,
            "imagem_produto" => $imagemProduto
        );
        array_unshift($produtos, $arrayProduto);
    }
    print_r(json_encode(array_filter($produtos)));
?>