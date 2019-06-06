<?php

    require_once("./verificarUsuario.php");//VERIFICA SE HÁ UM USUARIO LOGADO

    require_once("../bd/conexao.php");//CONEXAO COM O BANCO
    $conexao = conexaoMySql();

    if(isset($_GET['btn_enviar_promocao'])) {// SE O BOTÃO DE ENVIAR A PROMOÇÃO FOR CLICADO, ENTRA NA CONDIÇÃO DE INSERIR UMA PROMOÇÃO
        if (isset($_GET['slt_produto']) && isset($_GET['rng_percentual']) && isset($_GET['txt_preco_desconto'])) {//VERIFICA SE DADOS PARA INSERÇÃO DE PROMOCÃO EXISTEM
            if (!empty($_GET['slt_produto']) && !empty($_GET['rng_percentual']) && $_GET['rng_percentual'] != 0 && $_GET['txt_numero_parcelas'] != 0) {//VERIFICANDO SE DADOS NÃO SÃO NULOS
                $codProduto =$_GET['slt_produto'];
                $percentualDesconto = $_GET['rng_percentual'];
                $precoDesconto = $_GET['txt_preco_desconto'];
                $precoDesconto = str_replace(",", '.', $precoDesconto);
                $metodoPagamento = trim($_GET['txt_metodo_pagamento']);
//                SE O PERCENTUAL DE DESCONTO FOR DE 100%, OR VALORES DE PARCELAS SÃO ZERADOS
                if($percentualDesconto != 100){
                    $numeroParcelas = $_GET['txt_numero_parcelas'];
                    $precoParcelas = round($precoDesconto / $numeroParcelas, 2); // CALCULO DE PARCELAS
                }else{
                    $precoParcelas = 0.00;
                    $numeroParcelas = 0;
                }

//                SCRIPT DE INSERÇÃO DE DADOS NO BANCO
                 $sql = "INSERT INTO tbl_promocao (percentual_desconto, preco_desconto, numero_parcelas, metodo_pagamento, preco_parcelas, cod_produto)
                         VALUES (" . $percentualDesconto . ", " . $precoDesconto . ", ".$numeroParcelas.", '".addslashes($metodoPagamento)."', ".$precoParcelas."," . $codProduto . ")";

                 if (mysqli_query($conexao, $sql)) {
                     header("location: mngPromocoes.php");
                 } else {
                     echo "INSERSÃO FALHOU";
                 }
            } else {
                echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS OU ITENS NÃO SELECIONADOS OU ZERADOS.')</script>");
            }
        } else {
            echo("<script>alert('HÁ ALGO QUE NAO EXISTEM!')</script>");
        }
    }elseif(isset($_GET['btn_atualizar_promocao'])){// SE O BOTÃO DE ATUALIZAR A PROMOÇÃO FOR CLICADO, ENTRA NA CONDIÇÃO DE ATUALIZAR UMA PROMOÇÃO
        if (isset($_GET['slt_produto']) && isset($_GET['rng_percentual'])) {//VERIFICA SE DADOS PARA INSERÇÃO DE PROMOCÃO EXISTEM
            if (!empty($_GET['slt_produto']) && $_GET['rng_percentual'] != 0 && $_GET['txt_numero_parcelas'] != 0) {//VERIFICANDO SE DADOS NÃO SÃO NULOS
                $codProduto = $_GET['slt_produto'];
                $percentualDesconto = $_GET['rng_percentual'];
                $precoDesconto = $_GET['txt_preco_desconto'];
                $precoDesconto = str_replace(",", '.', $precoDesconto);
                $metodoPagamento = trim($_GET['txt_metodo_pagamento']);

//                SE O PERCENTUAL DE DESCONTO FOR DE 100%, OR VALORES DE PARCELAS SÃO ZERADOS
                if($percentualDesconto != 100){
                    $numeroParcelas = $_GET['txt_numero_parcelas'];
                    $precoParcelas = round($precoDesconto / $numeroParcelas, 2); // CALCULO DE PARCELAS
                }else{
                    $precoParcelas = 0.00;
                    $numeroParcelas = 0;
                }

//                SCRIPT DE ATUALIZAÇÃO DE DADOS NO BANCO
                $sql = "UPDATE tbl_promocao SET percentual_desconto = " . $percentualDesconto . ",
                        preco_desconto = " . $precoDesconto . ",
                        numero_parcelas = ".$numeroParcelas.",
                        metodo_pagamento = '".addslashes($metodoPagamento)."',
                        preco_parcelas = ".$precoParcelas.",
                        cod_produto = " . $codProduto . "
                        WHERE cod_promocao = ".$_SESSION['cod_promocao'];

                if (mysqli_query($conexao, $sql)) {
                    header("location: mngPromocoes.php");
                } else {
                    echo "ATUALIZAÇÃO FALHOU";
                }
                $_SESSION['cod_promocao'] = null;

            }else{
                echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS OU ITENS NÃO SELECIONADOS OU ZERADOS.')</script>");
            }
        } else {
            echo("<script>alert('HÁ ALGO QUE NAO EXISTEM!')</script>");
        }
    }
//    SCRIPT DE EXCLUSÃO DE PROMOÇÃO
    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'excluir'){
            $codPromocao = $_GET['codigo'];

//          SCRIPT DE EXCLUSÃO DE DADOS NO BANCO
            $sql = "DELETE FROM tbl_promocao WHERE cod_promocao = ".$codPromocao;
            if(mysqli_query($conexao, $sql)){
                header("location: mngPromocoes.php");
            }else{
                echo $sql;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/fontes.css">
    <title>GERENCIAR PROMOÇÕES</title>
    <meta charset="utf-8">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.visualizar').click(function(){
                $('#container').fadeIn(300);
            });
        });
        // FUNÇÃO QUE ATIVAR MODAL DE EDIÇÃO DE PROMOÇÃO
        const viewModalAtualizarPromocao = (codPromocao, codProduto, nomeProduto, precoProduto) =>{
            $.ajax({
                type: "GET",
                url: "./modais/atualizarPromocao.php",
                data: {cod_promocao: codPromocao, cod_produto: codProduto,
                    nome_produto: nomeProduto, preco_produto: precoProduto},
                success: function(dados){
                    $("#modal-promocoes").html(dados);
                }
            });
        }
        // FUNÇÃO QUE TROCA STATUS DA PROMOÇÃO
        const ativarDesativarPromocao = (codPromocao, status, codProduto) =>{
            $.ajax({
                type: "GET",
                url: "./status.php",
                data: {pagina: "promocao", codigo: codPromocao, status: status, cod_produto: codProduto},
                complete: function (response) {
                    location.reload();
                }
            });
        }
        // FUNÇÃO DE CONFIRMAÇÃO DE EXCLUSÃO DE LOJA
        const confirmarExclusaoPromocao = () =>{
            return confirm("Deseja mesmo excluir essa promoção?");
        }
    </script>
</head>
    <body>
        <!-- CONTAINER DO MODAL -->
        <div id="container">
            <div id="modal-promocoes" class="center">

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
            <div id="conteudo-promocoes">
                <form enctype="multipart/form-data" action="mngPromocoes.php" method="get" name="frm_promocoes">
                    <div id="container-promocoes">
                        <div id="produto-promocao">
                            <h3><label for="slt-produto">Produto:</label></h3>
                            <select id="slt-produto" name="slt_produto" required> <!-- SELEÇÃO DE PRODUTO DA PROMOÇÃO -->
                                <option value="">Escolher Produto</option>
                                <?php
                                    $sql = "SELECT cod_produto, nome, preco FROM tbl_produto";

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
                            <!-- AREA DE PRECO ATUAL DO PRODUTO -->
                            <div id="preco-atual">
                                <h5 id="txt-preco-atual">00</h5>
                            </div>
                        </div>
                        <!-- AREA DE ESCOLHA DO PERCENTUAL DE DESCONTO -->
                        <div id="percentual-promocao">
                            <h3><label>Percentual de Desconto:</label></h3>
                            <input type="range" id="rng-percentual" name="rng_percentual" min="0" max="100">
                            <h5 id="valor-desconto">__</h5>
                        </div>
                        <!-- AREA DO PRECO COM DESCONTO -->
                        <div id="preco-desconto">
                            <h3><label>Preço com Desconto(R$):</label></h3>
                            <input readonly type="text" id="txt-preco-desconto" name="txt_preco_desconto">
                        </div>
                        <!-- AREA COM DETALHES SOBRE O PAGAMENTO -->
                        <div id="descricao-pagamento">
                            <!-- CAMPO DE NUMERO DE PARCELAS A SERAM PAGAS -->
                            <div id="numero-parcelas" class="flexbox">
                                <h3><label>Nº de parcelas:</label></h3>
                                <input maxlength="3" type="text" id="txt-numero-parcelas" name="txt_numero_parcelas">
                            </div>
                            <!-- CAMPO DE METODO DE COMO O PRODUTO PODE SER PAGO -->
                            <div id="metodo-pagamento" class="flexbox">
                                <h3><label>Método de Pagamento:</label></h3>
                                <input maxlength="45" type="text" id="txt-metodo-pagamento" name="txt_metodo_pagamento">
                            </div>
                            <!-- PRÉ-VISUALIZAÇÃO DO TEXTO DO MÉTODO DE PAGAMENTO -->
                            <input readonly type="text" id="txt-descricao-pagamento" name="txt_descricao_pagamento">
                        </div>
                        <div id="caixa-btn-promocao" class="flexbox"> <!-- AREA COM BOTOES DE DE ENVIO E CANCELAMENTO DE FORMULARIO -->
                            <input type="submit" name="btn_enviar_promocao" id="btn-enviar-promocao" class="btn-confirmacao" value="ENVIAR"> <!-- CAMPO DO CEP -->
                            <input type="button" class="btn-cancelar" id="btn-cancelar" value="CANCELAR"> <!-- CANCELAR INSERÇÃO -->
                        </div>
                    </div>
                </form>
                <!-- BOTAO DE ATIVAÇÃO DE AREA DE CADASTRO DE PROMOÇÕES -->
                <input type="button" name="btn_add_promocao" class="btn-confirmacao" id="btn-add-promocao" value="ADICIONAR">
                <!-- AREA DA TABELA DE VISUALIZAÇÃO DE PROMOÇÕES -->
                <div id="container-table-promocao">
                    <div id="tabela-sobre">
                        <table id="table-promocao">
                            <tr class="table-titles">
                                <th class="title-produto-promocao">Produto</th>
                                <th class="title-porcentagem">Percentual de Desconto</th>
                                <th class="title-editar">Editar</th>
                                <th class="title-excluir">Excluir</th>
                                <th class="title-status">Status</th>
                            </tr>
                            <?php
//                            SCRIPT SQL QUE TRAZ TODAS AS PROMOÇÕES DO BANCO PARA VISUALIZAÇÃO NA TABELA
                                $sql = "SELECT promo.cod_promocao, promo.percentual_desconto, promo.status, promo.cod_produto,
                                        produto.nome, produto.preco
                                        FROM tbl_promocao AS promo
                                        INNER JOIN tbl_produto AS produto
                                        ON promo.cod_produto = produto.cod_produto
                                        ORDER BY promo.cod_promocao DESC";
                                $select = mysqli_query($conexao, $sql);

                                while($rsPromocao = mysqli_fetch_array($select)) {
//                                    COLOCANDO DADOS RESGATADOS DO BANCO EM VARIÁVEIS
                                    $codProduto = $rsPromocao['cod_produto'];
                                    $codPromocao = $rsPromocao['cod_promocao'];
                                    $percentual = $rsPromocao['percentual_desconto'];
                                    $nomeProduto = $rsPromocao['nome'];
                                    $precoProduto = $rsPromocao['preco'];
                                    $status = "'".$rsPromocao['status']."'";
                                    $nome = "'".$nomeProduto."'";

//                                        CRIANDO VARIÁVEL QUE SERÁ OS ATRIBUTOS alt E title NA IMAGEM(BOTAO) DE TROCA DE STATUS
                                    $altTitle = $rsPromocao['status'] == 'ativado' ? 'Desativar Registro '.$codPromocao : 'Ativar Registro '.$codPromocao;
                                    $img = $rsPromocao['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                            ?>
                            <tr class="tables-registers">
                                <td class="txt-produto-promocao"><?php echo $nomeProduto ?></td>
                                <td class="txt-porcentagem"><?php echo $percentual."% de Desconto" ?></td>
                                <!--BOTAO DE EDIÇÃO DA PROMOÇÃO -->
                                <td class="txt-editar">
                                    <figure>
                                        <img class="icon-edit visualizar" onclick="viewModalAtualizarPromocao(<?php echo $codPromocao.', '.$codProduto.', '.$nome.', '.$precoProduto ?>)" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codPromocao ?>" title="<?php echo 'Editar Registro '.$codPromocao ?>">
                                    </figure>
                                </td>
                                <!--BOTAO DE EXCLUSÃO DA PROMOÇÃO -->
                                <td class="txt-excluir">
                                    <a href="?modo=excluir&codigo=<?php echo $codPromocao ?>">
                                        <figure>
                                            <img class="icon-del" onclick="return confirmarExclusaoPromocao()" src="./icons/trash.png" alt="<?php echo 'Exluir Registro '.$codPromocao ?>" title="<?php echo 'Exluir Registro '.$codPromocao ?>">
                                        </figure>
                                    </a>
                                </td>
                                <!--BOTAO DE TROCA DE STATUS DA PROMOÇÃO -->
                                <td class="txt-status">
                                    <figure>
                                        <img onclick="ativarDesativarPromocao(<?php echo($codPromocao.', '.$status.', '.$codProduto); ?>)" class="icon-status" src="./icons/<?php echo $img ?>" alt="<?php echo $altTitle ?>" title="<?php echo $altTitle ?>">
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
        <script src="./js/mngPromocoes.js"></script><!-- SCRIPT QUE FAZ CALCULO DE NOVO PREÇO E O MOSTRA EM TEMPO REAL PARA O USUARIO -->
        <script>
            // SCRIPT QUE CONTROLA VISUALIZAÇÃO DO FORMULARIO DE CADASTRO DA PROMOÇÃO
            const btnSend = document.getElementById('btn-enviar-promocao');
            const btnCancel = document.getElementById('btn-cancelar');
            const btnAdd = document.getElementById('btn-add-promocao');
            const caixaAddPromocao = document.getElementById('container-promocoes');
            

            function showAddLoja(){
                caixaAddPromocao.style.display = "flex";
                btnAdd.style.display = "none";
            }
            function hiddenAddLoja(){
                caixaAddPromocao.style.display = "none";
                btnAdd.style.display = "inline";
            }

            btnAdd.addEventListener('click', showAddLoja);
            btnCancel.addEventListener('click', hiddenAddLoja);

        </script>
    </body>
</html>