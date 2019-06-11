$(document).ready(function(){
    $("html").click(function(e){
        if($(e.target).hasClass('icone-pesquisa')){
        
            if( $("#caixa-de-pesquisa").css("opacity") == 0){
                $("#caixa-de-pesquisa").css({'transform':'translate(-58%, 0)'});
                $("#caixa-de-pesquisa").css({'opacity':1});
                $("#caixa-de-pesquisa").css({'visibility':'visible'});
                $("#caixa-de-pesquisa").css({'transition' : 'all 0.4s ease-in-out'});
            }else{
                $("#caixa-de-pesquisa").css({'transform':'translate(60%, 0)'});
                $("#caixa-de-pesquisa").css({'opacity':0});
                $("#caixa-de-pesquisa").css({'visibility':'hidden'});
                $("#caixa-de-pesquisa").css({'transition' : 'all 0.4s ease-in-out'});
            }
        }
    });

    $("#txt-pesquisa-mobile").on("input", function(){
        let numLetras = $("#txt-pesquisa-mobile").val().length;
        let texto = "";

        if(numLetras > 3){
            texto = $("#txt-pesquisa-mobile").val();
            $.ajax({
                type: 'get',
                url: 'filtroPesquisa.php',
                data: {pesquisa: texto},
                complete: function(response){
                    let produtos = JSON.parse(response.responseText);
                    // console.log(produtos);
                    inserirProdutosFiltrados(produtos);
                },
                error: function(){
                    
                }
            });
        }else if(numLetras == 0){
            texto = "";
            $.ajax({
                type: 'get',
                url: 'filtroPesquisa.php',
                data: {pesquisa: texto},
                complete: function(response){
                    let produtos = JSON.parse(response.responseText);
                    console.log(produtos);
                    inserirProdutosFiltrados(produtos);
                },
                error: function(){
                    
                }
            });
        }
    });
    const inserirProdutosFiltrados = (catalogo) =>{   
        console.log(catalogo);
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
        }, 0);
    }
    // buscarPorProdutosFiltros(0, 0);
});