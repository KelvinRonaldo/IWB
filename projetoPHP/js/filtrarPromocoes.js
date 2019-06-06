const buscarPorPromocoesFiltros = (codCategoria, codSubcategoria) =>{
    console.log(`${codCategoria} e ${codSubcategoria}`);
    $.ajax({
        type: 'get',
        url: './filtroCategorias.php',
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
                                            <img src='./arquivos/${produtos[i].imagem_produto}' class='img-div' alt='#' title='#'>
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
buscarPorFiltros(0, 0);