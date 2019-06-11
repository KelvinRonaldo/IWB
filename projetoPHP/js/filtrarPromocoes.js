/*const buscarPorPromocoesFiltros = (codCategoria, codSubcategoria) =>{
    console.log(`${codCategoria} e ${codSubcategoria}`);
    $.ajax({
        type: 'get',
        url: 'filtroCategorias.php',
        data: {cod_categoria: codCategoria, cod_subcategoria: codSubcategoria},
        complete: function(response){
            let produtos = JSON.parse(response.responseText);
            console.log(produtos);
            $('#produtos').empty();
            inserirProdutosFiltrados(produtos);
        },
        error: function(){
            
        }
    });
}

const inserirProdutosFiltrados = (produtos) =>{    
    for(let i = 0; i < produtos.length; i++){
        $('#produtos').append(`<div class='produto'>
                                    <!-- IMAGEM DO PRODUTO -->
                                    <figure>
                                        <div class='produto-img center'>
                                            <img src='arquivos/${produtos[i].imagem_produto}' class='img-div' alt='#' title='#'>
                                        </div>
                                    </figure>
                                    <!-- NOME DO PRODUTO -->
                                    <div class='nome-texts'>
                                        <p class='produto-nome'>${produtos[i].nome_produto}</p>
                                    </div>
                                    <!-- DESCRIÇÃO DO PRODUTO -->
                                    <div class='descricao-texts'>
                                        <p class='produto-descricao'>
                                            ${produtos[i].descricao_produto}
                                        </p>
                                    </div>
                                    <!-- PREÇO DO PRODUTO -->
                                    <div class='preco-texts'>
                                        <p class='produto-preco'>${produtos[i].preco_produto}</p>
                                    </div>
                                    <!-- LINK PARA ACESSAR OS DETALHES DO PRODUTO -->
                                    <a class='detalhes' href='#'>Detalhes</a>
                                </div>`);
    }
}
buscarPorFiltros(0, 0);*/
//TRAZ PRODUTOS FILTRADOS PELA CATEGORIA E/OU SUB CATEGORIA DO BANCO
const buscarPorProdutosFiltros = (codCategoria, codSubcategoria) =>{
    $.ajax({
        type: 'get',
        url: 'filtroPromocoes.php',
        data: {cod_categoria: codCategoria, cod_subcategoria: codSubcategoria},
        complete: function(response){
            let produtos = JSON.parse(response.responseText);
            inserirProdutosFiltrados(produtos);
        },
        error: function(){
            
        }
    });
}

const inserirProdutosFiltrados = (catalogo) =>{    
    //LIMPA AREA DE PRODUTOS
    $('#promocoes-dir').empty();
    let desativado = 0;
    //ACHA PRODUTO EM PROMOCÃO, CUJA PROMOÇÃO ESTA DESATIVADA
    desativado = catalogo.findIndex(produto => produto.status_promocao == 'desativado');
    // PRODUTO DO COM PROMOÇÃO DESATIVADA DO CATÁLOGO
    if(desativado != -1){
        catalogo.splice(desativado, 1);
    }

    setTimeout(() => {//ESPERA A AREA SER LIMPRA PARA REALIZAR O PROEENCHIMENTO PARA NÃO HAVER CONFLITO 
        for(let i = 0; i < catalogo.length; i++){
            //PREENCHE REA DE PRODUTOS COM PRODUTOS VINDO DO BANCO
            $('#promocoes-dir').append(`<div class="promocoes">
                                            <figure>
                                                <!-- IMAGEM DO PRODUTO EM PROMOÇÃO -->
                                                <div class="promocoes-img center">
                                                    <img src="arquivos/${catalogo[i].imagem_produto}" class="img-div" alt="${catalogo[i].nome_produto}" title="${catalogo[i].nome_produto}">
                                                </div>
                                            </figure>
                                            <!-- NOME DO PRODUTO EM PROMOÇÃO -->
                                            <div class="promocoes-nome">
                                                <p>${catalogo[i].nome_produto}</p>
                                            </div>
                                            <!-- % DE DESCONTO DO PRODUTO EM PROMOÇÃO -->
                                            <div class="porcentagem-desconto">
                                                <h4>${catalogo[i].percentual_desconto}% DE DESCONTO</h4>
                                            </div>
                                            <!-- PREÇO INICIAL DO PRODUTO EM PROMOÇÃO -->
                                            <div class="promocoes-inicial">
                                                <p>DE R$${catalogo[i].preco_produto}</p>
                                            </div>
                                            <!-- VALOR DO PRODUTO EM PROMOÇÃO COM O DESCONTO -->
                                            <div class="promocoes-com-desconto">
                                                <p><span class="por">POR </span>R$${catalogo[i].preco_desconto}</p>
                                            </div>
                                            <!-- INFORMAÇÕES DE PAGAMENTO  -->
                                            <div class="tipo-pagamento">
                                            <?php
                                                if(($numeroParcelas != null && $metodoPagamento != null) || $percentualDesconto != 100) {
                                            ?>
                                                <p>
                                                    <span class="negrito">${catalogo[i].numero_parcelas} x de R$${catalogo[i].preco_parcelas} </span>${catalogo[i].metodo_pagamento}
                                                </p>
                                            <?php
                                                }
                                            ?>
                                            </div>
                                            <!-- BOTÃO PARA IR A PAGINA DE COMPRA DO PRODUTO EM PROMOÇÃO -->
                                            <div class="caixa-btn-comprar">
                                                <input onclick="location.href(promocoes.php)" type="button" class="btn-comprar" value="COMPRAR">
                                            </div>
                                        </div>`);
        }
    }, 150);
}
// buscarPorProdutosFiltros(0, 0);