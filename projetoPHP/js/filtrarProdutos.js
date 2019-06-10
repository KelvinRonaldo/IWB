//TRAZ PRODUTOS FILTRADOS PELA CATEGORIA E/OU SUB CATEGORIA DO BANCO
const buscarPorProdutosFiltros = (codCategoria, codSubcategoria) =>{
    $.ajax({
        type: 'get',
        url: 'filtroCategorias.php',
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
    $('#produtos').empty();
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
            $('#produtos').append(`<div class='produto'> <figure> <div class='produto-img center'> <img src='arquivos/${catalogo[i].imagem_produto}' class='img-div' alt='#' title='#'> </div> </figure> <div class='nome-texts'> <p class='produto-nome'>${catalogo[i].nome_produto}</p> </div> <div class='descricao-texts'> <p class='produto-descricao'> ${catalogo[i].descricao_produto} </p> </div> <div class='preco-texts'> <p class='produto-preco'>R$${catalogo[i].preco_produto}</p> </div> <a class='detalhes visualizar' onclick="viewProduto(${catalogo[i].cod_produto})">Detalhes</a> </div>`);
        }
    }, 250);
}
buscarPorProdutosFiltros(0, 0);