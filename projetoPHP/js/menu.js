$(document).ready(function(){    

    $("#menu-mobile").click(function(){
        if($("#caixa-menu-mobile").attr('class') == "menu-mobile-close"){
            $("#caixa-menu-mobile").removeClass("menu-mobile-close");
            $("#caixa-menu-mobile").addClass("menu-mobile-open");
            $("#container-menu").css({"opacity":1});
            $("#container-menu").css({"visibility":"visible"});
            $("#container-menu").css({"transition":".2s ease-in"});
            
            $("#abrir-menu").css({"opacity":0});
            $("#abrir-menu").css({"visibility":"hidden"});
            $("#abrir-menu").css({"transition":".2s ease-in"});
            $("html body").css({"overflow":"hidden"});

        }else if($("#caixa-menu-mobile").attr('class') == "menu-mobile-open"){
            setTimeout(()=>{
                $("#caixa-menu-mobile").removeClass("menu-mobile-open");
                $("#caixa-menu-mobile").addClass("menu-mobile-close");
                $("#container-menu").css({"opacity":0});
                $("#container-menu").css({"visibility":"hidden"});
                $("#container-menu").css({"transition":".2s ease-in"});

                $("#abrir-menu").css({"opacity":1});
                $("#abrir-menu").css({"visibility":"visible"});
                $("#abrir-menu").css({"transition":".2s ease-in"});
                $("html body").css({"overflow":"visible"});
            }, 250);
        }
    });
    
    
    $("#item-menu-noticia").click(function(){
        createStyleLi("noticia");
    });
    $("#item-menu-promocoes").click(function(){
        createStyleLi("promocoes");
    });
    $("#item-menu-lojas").click(function(){
        createStyleLi("lojas");
    });
    $("#item-menu-eventos").click(function(){
        createStyleLi("eventos");
    });
    $("#item-menu-contato").click(function(){
        createStyleLi("contato");
    });
    $("#item-menu-sobre").click(function(){
        createStyleLi("sobre");
    });

    const createStyleLi = (li) =>{
        $(`#item-menu-${li}`).css({"background-color":"#eeb518"});
        $(`#item-menu-${li}`).css({"color":"rgba(22, 33, 59)"});
        $(`#item-menu-${li}`).css({"transition":".2s ease-in"});
    }
});