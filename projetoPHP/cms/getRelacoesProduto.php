<?php

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();



    $codCategoria = $_GET['codCategoria'];
    $codSubcategoria = $_GET['codSubcategoria'];
    $codProduto = $_GET['codProduto'];

    if($codProduto != 0){
        $filtroProduto = " AND s.cod_subcategoria NOT IN 
        (SELECT cod_subcategoria FROM tbl_produto_subcategoria_categoria
        WHERE cod_produto = 6 AND cod_subcategoria <>".$codSubcategoria.")";
    }else{
        $filtroProduto = ";";
    }

    $sql = "SELECT s.subcategoria, s.cod_subcategoria, 
    c.cod_categoria, c.categoria
    FROM tbl_categoria AS c
    INNER JOIN tbl_categoria_subcategoria AS cs
    ON c.cod_categoria = cs.cod_categoria
    INNER JOIN tbl_subcategoria AS s
    ON cs.cod_subcategoria = s.cod_subcategoria
    WHERE c.cod_categoria = ".$codCategoria.$filtroProduto;

    $select = mysqli_query($conexao, $sql);

    $subcategorias = (array) null;
    $arraySubcategoria = (array) null;

    while($rsSubcategorias = mysqli_fetch_array($select)){
        $codSubcategoria = $rsSubcategorias['cod_subcategoria'];
        $subcategoria = $rsSubcategorias['subcategoria'];

        $arraySubcategoria = array(
            "codSubcategoria" => $codSubcategoria,
            "subcategoria" => $subcategoria
        );

        array_unshift($subcategorias, $arraySubcategoria);
    }
    print_r(json_encode(array_filter($subcategorias)));
?>