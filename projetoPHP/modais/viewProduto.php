<?php

    require_once("../bd/conexao.php");
    $conexao = conexaoMySql();

    $nome = null;
    $descricao = null;
    $imagem = null;
    $categoria = null;
    $subcategoria = null;
    $precoProduto = null;
    $codPromocao = null;
    $percentual = null;
    $numParcelas = null;
    $metodoPagamento = null;
    $pagamento = null;
    $precoParcela = null;

    $codProduto = $_GET['codProduto'];

    $sql = "SELECT p.*, pr.*, c.*, s.*
    FROM tbl_promocao AS pr
    RIGHT JOIN tbl_produto AS p
    ON pr.cod_produto = p.cod_produto
    INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
    ON p.cod_produto = tpsc.cod_produto
    INNER JOIN tbl_subcategoria AS s
    ON tpsc.cod_subcategoria = s.cod_subcategoria
    INNER JOIN tbl_categoria AS c
    ON tpsc.cod_categoria = c.cod_categoria
    WHERE p.cod_produto = ".$codProduto;

    $select = mysqli_query($conexao, $sql);

    if($rsProduto = mysqli_fetch_array($select)){
        $nome = $rsProduto['nome'];
        $descricao = $rsProduto['descricao'];
        $imagem = $rsProduto['imagem'];
        $categoria = $rsProduto['categoria'];
        $subcategoria = $rsProduto['subcategoria'];
        if($rsProduto['cod_promocao'] == null){
            $precoProduto = number_format($rsProduto['preco'], 2, ",", ".");
        }else{
            $codPromocao = $rsProduto['cod_promocao'];
            $precoDesconto = number_format($rsProduto['preco_desconto'], 2, ",", ".");
            $precoProduto = number_format($rsProduto['preco'], 2, ",", ".")."*";
            $percentual = $rsProduto['percentual_desconto'];
            $numParcelas = $rsProduto['numero_parcelas'];
            $pagamento = $rsProduto['metodo_pagamento'];
            $precoParcela = number_format($rsProduto['preco_parcelas'], 2, ",", ".");
            
            $metodoPagamento = "Com ".$percentual."% de desconto sai por R$".$precoDesconto." á vista ou em até ".$numParcelas."x de R$".$precoParcela." ".$pagamento;
        }
    }

?>
<script src="cms/js/jquery-3.3.1.min.js"></script>
<!-- SCRIPT PARA FECHAR A MODAL -->
<script>
    $(document).ready(function(){
        $('#fechar-modal-index').click(function(){
            $('#container').fadeOut(300);
        });
        // $("#src-view-produto")
        //     .wrap('<span style="display:inline-block"></span>')
        //     .css('display', 'block')
        //     .parent()
        //     .zoom();
    });
</script>
<!-- BOTAO DE FECHAR O MODAL -->
<div id="fechar-modal-index">
    <img class="icon-close-index" alt="Fechar" title="Fechar" src="imgs/close.png">
</div>
<div id="container-modal-produto">
    <div id="titulo-produto">
        <h1><?= $nome ?></h1>
    </div>
    <div id="conteudo-view-produto">
        <div id="img-view-produto">
            <figure>
                <img id="src-view-produto" alt="<?= $nome ?>" title="<?= $nome ?>" src="arquivos/<?= $imagem ?>">
            </figure>
        </div>
        <div id="info-view-produto">
            <div id="preco-view-produto">
                <h3><span class='cifrao'>R$</span><?= $precoProduto ?></h3>
            </div>
            <div id="descricao-view-produto">
                <p class="teste"><?= nl2br($descricao); ?></p>
            </div>
            <div id="categoria-view-produto">
                <h3><?= $categoria ?></h3>
            </div>
            <div id="subcategoria-view-produto">
                <h4><?= $subcategoria ?></h4>
            </div>
            <div id="btns-compra">
                <button id="add-carrinho">
                    +<img id="img-carrinho" src="imgs/cart.png" alt="Add ao Carrinho" Title="Add ao Carrinho">
                </button>
                <button id="comprar">
                    <img id="img-comprar" src="imgs/basket.png" alt="Comprar" Title="Comprar">
                </button>
            </div>
        </div>
    </div>
    <?php
        if($codPromocao != null){
    ?>
    <div id="promocao-view-produto">
        <p><?= $metodoPagamento ?></p>
    </div>
    <?php
        }
    ?>
</div>
