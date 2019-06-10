<?php

    require_once("bd/conexao.php");
    $conexao = conexaoMySql();

    $statusProduto = null;
    $statusPromocao = null;
    $imagemProduto = null;

    $pesquisa = $_GET['pesquisa'];

    $texto = explode(" ", $pesquisa);

    $texto = array_filter($texto);

    $numPalavras = sizeof($texto);

    $pesquisa = "%";

    for($i = 0; $i < $numPalavras; $i++){        
        $pesquisa .= $texto[$i]."%";
    }

    $sql = "SELECT DISTINCT p.nome, p.*, pr.*, pr.status AS status_promocao FROM tbl_produto AS p
    LEFT JOIN tbl_promocao AS pr
    ON p.cod_produto = pr.cod_produto
    WHERE p.nome LIKE '".$pesquisa."' OR
    p.descricao LIKE '".$pesquisa."'";

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