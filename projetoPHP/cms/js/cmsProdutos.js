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

    function getUrlVars()
    {
        var variaveis = [], hash;
        var varsUrl = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < varsUrl.length; i++)
        {
            varUrl = varsUrl[i].split('=');
            variaveis.push(varUrl[0]);
            variaveis[varUrl[0]] = varUrl[1];
        }
        let abrirContainerCategorias = variaveis.filter(campos => campos == "categorias");
        let abrirContainerSubcategorias = variaveis.filter(campos => campos == "subcategorias");
        let abrirContainerProdutos = variaveis.filter(campos => campos == "produtos");
        let abrirContainerRelacoes = variaveis.filter(campos => campos == "relacoes");

        console.log(`${abrirContainerCategorias},.${abrirContainerSubcategorias},.${abrirContainerProdutos}`);
        if(abrirContainerCategorias != ""){
            abreContainer('categorias');
            fechaContainer('subcategorias');
            fechaContainer('produto');
            fechaContainer('relacoes');
        }else if(abrirContainerSubcategorias != ""){
            fechaContainer('categorias');
            abreContainer('subcategorias');
            fechaContainer('produto');
            fechaContainer('relacoes');
        }else if(abrirContainerProdutos != ""){
            fechaContainer('categorias');
            fechaContainer('subcategorias');
            abreContainer('produto');
            fechaContainer('relacoes');
        }else if(abrirContainerRelacoes != ""){
            fechaContainer('categorias');
            fechaContainer('subcategorias');
            fechaContainer('produto');
            abreContainer('relacoes');
        }
    }

    $("#slt-categoria-produto").on("change", function(){
        let codCategoriaProduto = $("#slt-categoria-produto option:selected").val();
        $.ajax({
            type: "GET",
            url: "./getSubcategoriasProduto.php",
            data: {codSubcategoria: codCategoriaProduto},
            complete: function(response){
                let jsonSubcategorias = JSON.parse(response.responseText);
                preencherSelectSubcategorias(jsonSubcategorias);
                console.log(jsonSubcategorias);
            },
            error: function(){

            }
        });
    });

    const preencherSelectSubcategorias = (jsonSubcategorias) =>{
        let subcategoria = 0;
        let codSubcategoria = 0;
        $("#slt-subcategoria-produto").empty();
        $("#slt-subcategoria-produto").prop("disabled", false);
        for(let i = 0; i < jsonSubcategorias.length; i++){
            subcategoria = jsonSubcategorias[i].subcategoria;
            codSubcategoria = jsonSubcategorias[i].codSubcategoria;
            $("#slt-subcategoria-produto").append(
                `<option value="${codSubcategoria}">${subcategoria}</option>`);
        }
    }


    fechaContainer('categorias');
    fechaContainer('subcategorias');
    fechaContainer('produtos');
    // fechaContainer('relacoes');
    getUrlVars();

});