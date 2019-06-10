<?php
    require_once("bd/conexao.php");
    $conexao = conexaoMySql();

        $codCategoria = $_GET['cod_categoria'];
        $codSubcategoria = $_GET['cod_subcategoria'];

        if($codCategoria == 0){
            $filtro = " ORDER BY RAND()";
        }elseif($codCategoria != 0 && $codSubcategoria == 0){
            $filtro = " AND c.cod_categoria = ".$codCategoria." AND s.cod_subcategoria > ".$codSubcategoria;
        }elseif($codCategoria != 0 && $codSubcategoria != 0){
            $filtro = " AND c.cod_categoria = ".$codCategoria." AND s.cod_subcategoria = ".$codSubcategoria;
        }

    $sql = "SELECT DISTINCT p.nome, p.preco, p.cod_produto, p.imagem,
            pr.cod_promocao, pr.percentual_desconto,
            pr.preco_desconto, pr.status AS status_promocao, 
            pr.numero_parcelas, pr.metodo_pagamento, pr.preco_parcelas,
            c.cod_categoria
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
            AND c.status = 'ativado' 
            AND pr.status = 'ativado'".$filtro;

    $promocoes[] = (array) null;
    $arrayPromocao[] = (array) null;

    $select = mysqli_query($conexao, $sql);

    while($rsPromocaoFiltrada = mysqli_fetch_array($select)){        
        $codProduto = $rsPromocaoFiltrada['cod_produto'];
        $nomeProduto = $rsPromocaoFiltrada['nome'];
        $precoProduto = $rsPromocaoFiltrada['preco'];
        $imagemProduto = $rsPromocaoFiltrada['imagem'];

        $codPromocao= $rsPromocaoFiltrada['cod_promocao'];
        $percentual = $rsPromocaoFiltrada['percentual_desconto'];
        $precoDesconto = $rsPromocaoFiltrada['preco_desconto'];
        $statusPromocao = $rsPromocaoFiltrada['status_promocao'];
        $numParcelas = $rsPromocaoFiltrada['numero_parcelas'];
        $metodoPagamento = $rsPromocaoFiltrada['metodo_pagamento'];
        $precoParcelas = $rsPromocaoFiltrada['preco_parcelas'];

        $arrayPromocao = array(
            "cod_produto" => $codProduto,
            "nome_produto" => $nomeProduto,
            "preco_produto" => number_format($precoProduto, 2, ',', '.'),
            "imagem_produto" => $imagemProduto,
            "cod_promocao" => $codPromocao,
            "percentual_desconto" => $percentual,
            "preco_desconto" => number_format($precoDesconto, 2, ',', '.'),
            "status_promocao" => $statusPromocao,
            "numero_parcelas" => $numParcelas,
            "metodo_pagamento" => $metodoPagamento,
            "preco_parcelas" => number_format($precoParcelas, 2, ',', '.')
        );
        array_unshift($promocoes, $arrayPromocao);
    }
    print_r(json_encode(array_filter($promocoes)));
?>