$(document).ready(function(){
    $("#selecao-adm-categoria").click(function(){
        abreContainer('categorias');
        fechaContainer('subcategorias');
        fechaContainer('produtos');
        fechaContainer('relacoes');
    });
    $("#selecao-adm-subcategoria").click(function(){
        fechaContainer('categorias');
        abreContainer('subcategorias');
        fechaContainer('produtos');
        fechaContainer('relacoes');
    });
    $("#selecao-adm-produto").click(function(){
        fechaContainer('categorias');
        fechaContainer('subcategorias');
        abreContainer('produtos');
        fechaContainer('relacoes');
    });
    $("#selecao-adm-relacoes").click(function(){
        fechaContainer('categorias');
        fechaContainer('subcategorias');
        fechaContainer('produtos');
        abreContainer('relacoes');
    });


    function abreContainer(area){
        $(`#container-${area}`).css({"display":"flex"});
    }
    function fechaContainer(area){
        $(`#container-${area}`).css({"display":"none"});
    }

    fechaContainer('categorias');
    fechaContainer('subcategorias');
    fechaContainer('produtos');
    fechaContainer('relacoes');
    
    let abrirContainerCategorias = "";
    let abrirContainerSubcategorias = "";
    let abrirContainerProdutos = "";
    let abrirContainerRelacoes = "";
    let editarRelacoes = "";
    let codSubcategoriaRelacao = "";
    let codProdutoRelacao = "";

    function getUrlVars(){
        let variaveis = [];
        let valores = [];
        let jsonVars = [];
        let varsUrl = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(let i = 0; i < varsUrl.length; i++)
        {
            varUrl = varsUrl[i].split('=');
            variaveis.push(varUrl[0]);
            valores.push(varUrl[1]);
            variaveis[varUrl[0]] = varUrl[1];

            aux = {"nome": variaveis[i], "valor": valores[i]};
            jsonVars.push(aux);
        }

        abrirContainerCategorias = variaveis.filter(campos => campos == "categorias");
        abrirContainerSubcategorias = variaveis.filter(campos => campos == "subcategorias");
        abrirContainerProdutos = variaveis.filter(campos => campos == "produtos");
        abrirContainerRelacoes = variaveis.filter(campos => campos == "relacoes");
        
        editarRelacoes = variaveis.filter(campos => campos == "modoRelacao");

        codSubcategoriaRelacao = jsonVars.filter(valores => valores.nome == "codSubCatRelacao");
        codProdutoRelacao = jsonVars.filter(valores => valores.nome == "codProdutoRelacao");
        
        if(codSubcategoriaRelacao != ""){
            codSubcategoriaRelacao = codSubcategoriaRelacao[0].valor;
        }else{
            codSubcategoriaRelacao = 0;
        }

        if(codProdutoRelacao != ""){
            codProdutoRelacao = codProdutoRelacao[0].valor;
        }else{
            codProdutoRelacao = 0;
        }
        // console.log(codProdutoRelacao);

    }

    getUrlVars();

    if(abrirContainerCategorias == "categorias"){
        abreContainer('categorias');
        fechaContainer('subcategorias');
        fechaContainer('produtos');
        fechaContainer('relacoes');
    }else if(abrirContainerSubcategorias == "subcategorias"){
        fechaContainer('categorias');
        abreContainer('subcategorias');
        fechaContainer('produtos');
        fechaContainer('relacoes');
    }else if(abrirContainerProdutos == "produtos"){
        fechaContainer('categorias');
        fechaContainer('subcategorias');
        abreContainer('produtos');
        fechaContainer('relacoes');
    }else if(abrirContainerRelacoes == "relacoes"){
        fechaContainer('categorias');
        fechaContainer('subcategorias');
        fechaContainer('produtos');
        abreContainer('relacoes');
    }

    const preencherSelectSubcategorias = (jsonSubcategorias) =>{
        let subcategoria = 0;
        let codSubcategoria = 0;
        $("#slt-subcategoria-produto").empty();
        $("#slt-subcategoria-produto").prop("disabled", false);
        $("#slt-subcategoria-produto").append(`<option value="">Escolha uma Subcategoria</option>`);
        for(let i = 0; i < jsonSubcategorias.length; i++){
            subcategoria = jsonSubcategorias[i].subcategoria;
            codSubcategoria = jsonSubcategorias[i].codSubcategoria;
            let selecionado = codSubcategoria==codSubcategoriaRelacao?'selected':'';
            $("#slt-subcategoria-produto").append(
                `<option ${selecionado} value="${codSubcategoria}">${subcategoria}</option>`);
        }
    }

    function trazerSubs(){
        let codCategoriaProduto = $("#slt-categoria-produto option:selected").val();
        $.ajax({
            type: "GET",
            url: "getRelacoesProduto.php",
            data: {codCategoria: codCategoriaProduto, codProduto: codProdutoRelacao, codSubcategoria: codSubcategoriaRelacao},
            complete: function(response){
                let jsonSubcategorias = JSON.parse(response.responseText);
                preencherSelectSubcategorias(jsonSubcategorias);
                // console.log(jsonSubcategorias);
            },
            error: function(){

            }
        });
    }

    if(editarRelacoes != ""){
        trazerSubs();    
    }else{
        $("#slt-categoria-produto").on("change", function(){
            trazerSubs();            
        });
    }
});