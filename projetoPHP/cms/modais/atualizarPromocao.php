<?php

//    FAZER ATUALIZAR E ESQUEMA DE DO SELECT NO PRODUTO DO MODAL

    require_once("../verificarUsuario.php");

    require_once("../../bd/conexao.php");
    $conexao = conexaoMySql();

    $_SESSION['cod_promocao'] = $_GET['cod_promocao'];
    $codProduto = $_GET['cod_produto'];
    $preco_Produto = $_GET['preco_produto'];
    $nomeProduto = $_GET['nome_produto'];

    $sql = "SELECT * FROM tbl_promocao WHERE cod_promocao = ".$_SESSION['cod_promocao'];

    $select = mysqli_query($conexao, $sql);
    if($rsPromocao = mysqli_fetch_array($select)){
        $percentual = $rsPromocao['percentual_desconto'];
        $precoDesconto = $rsPromocao['preco_desconto'];
        $numeroParcelas = $rsPromocao['numero_parcelas'];
        $metodoPagamento = $rsPromocao['metodo_pagamento'];
    }

?>

<script src="./js/jquery-3.3.1.min.js"></script>
<!-- SCRIPT PARA FECHAR A MODAL -->
<script>
    $(document).ready(function(){
        $('#fechar-modal-promocao').click(function(){
            $('#container').fadeOut(300);
        });
    });
</script>
<!-- BOTAO DE FECHAR O MODAL -->
<div id="fechar-modal-promocao">
    <img class="icon-close" alt="Fechar" title="Fechar" src="icons/close.png">
</div>
<form enctype="multipart/form-data" action="mngPromocoes.php" method="get" name="frm_promocoes">
    <div id="container-modal-promocoes">
        <div id="produto-promocao">
            <h3><label for="slt-produto">Produto:</label></h3>
            <select id="slt-produto" name="slt_produto">
                <?php
                    if($codProduto == 0){
                ?>
                <option value="">Escolher Produto</option>
                <?php
                    }else {
                ?>
                <option data-preco="<?php echo $preco_Produto ?>" value="<?php echo $codProduto ?>"><?php echo $nomeProduto ?></option>
                <?php
                    }


                $sql = "SELECT cod_produto, nome, preco FROM tbl_produto
                        WHERE cod_produto <> ".$codProduto;

                $select = mysqli_query($conexao, $sql);

                while($rsProduto = mysqli_fetch_array($select)){
                    $codProduto = $rsProduto['cod_produto'];
                    $nomeProduto = $rsProduto['nome'];
                    $precoProduto = $rsProduto['preco'];
                ?>
                <option data-preco="<?php echo $precoProduto ?>" value="<?php echo $codProduto ?>"><?php echo $nomeProduto ?></option>
                <?php
                }
                ?>
            </select>
            <div id="preco-atual">
                <h5 id="txt-preco-atual">00</h5>
            </div>
        </div>
        <div id="percentual-promocao">
            <h3><label>Percentual de Desconto (Atual = <?php echo $percentual.'%' ?>): </label></h3>
            <input type="range" min="0" max="100" id="rng-percentual" name="rng_percentual" >
            <h5 id="valor-desconto"></h5>
        </div>
        <div id="preco-desconto">
            <h3><label>Preço com Desconto (Atual = <?php echo 'R$'.$precoDesconto ?>):</label></h3>
            <input readonly type="text" id="txt-preco-desconto" name="txt_preco_desconto">
        </div>
        <div id="descricao-pagamento">
            <div id="numero-parcelas" class="flexbox">
                <h3><label>Nº de parcelas:</label></h3>
                <input type="text" id="txt-numero-parcelas" name="txt_numero_parcelas" value="<?php echo $numeroParcelas ?>">
            </div>
            <div id="metodo-pagamento" class="flexbox">
                <h3><label>Método de Pagamento:</label></h3>
                <input maxlength="45" type="text" id="txt-metodo-pagamento" name="txt_metodo_pagamento" value="<?php echo $metodoPagamento ?>">
            </div>
            <input readonly type="text" id="txt-descricao-pagamento" name="txt_descricao_pagamento">
        </div>
        <div id="caixa-btn-promocao" class="flexbox">
            <input type="submit" name="btn_atualizar_promocao" class="btn-confirmacao" value="ATUALIZAR"> <!-- CAMPO DO CEP -->
        </div>
    </div>
</form>
<script src="./js/mngPromocoes.js"></script>
<script>
    var caixaPrecoAtual = document.getElementById("txt-preco-atual");
    caixaPrecoAtual.textContent = "R$"+parseFloat(<?php echo $preco_Produto; ?>).toFixed(2);
</script>