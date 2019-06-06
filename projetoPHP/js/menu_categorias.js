$(document).ready(function(){
    
    $('.icon-subcategorias').click(function(){
        if($(this).parent().find('ul').hasClass('mostrar')){
            $(this).parent().find('ul').removeClass('mostrar');
            $(this).parent().find('ul').addClass('esconder');

        }else if($(this).parent().find('ul').hasClass('esconder')){
            $(this).parent().find('ul').removeClass('esconder');
            $(this).parent().find('ul').addClass('mostrar');
        }
    });
    
    $("html").click(function(e){
        if(!$(e.target).hasClass('icon-show-categories') && !$(e.target).hasClass('subitem-menu-esq-h3')
        && !$(e.target).hasClass('subitem-menu-esq')){
            
            $(".icon-subcategorias").parent().find('ul').removeClass('mostrar');
            $(".icon-subcategorias").parent().find('ul').addClass('esconder');
        }
    });

    if($("#header-mobile").css("display") != "none"){
        
        $("#abrir-menu").click(function(){

            if($("#menu-esq").attr('class') == "menu-categoria-close"){

                $("#menu-esq").removeClass("menu-categoria-close");
                $("#menu-esq").addClass("menu-categoria-open");
                $("#container-categoria-menu").css({"opacity":1});
                $("#container-categoria-menu").css({"visibility":"visible"});
                $("#container-categoria-menu").css({"transition":".2s ease-in"});
                
                $("#abrir-menu").css({"opacity":0});
                $("#abrir-menu").css({"visibility":"hidden"});
                $("#abrir-menu").css({"transition":".2s ease-in"});
                $("html body").css({"overflow":"hidden"});
    
            }else if($("#menu-esq").attr('class') == "menu-categoria-open"){
                fecharContainerMenuCategorias();
            }
        });
    
        $("html").click(function(e){
            if($(e.target).hasClass('container-categoria-menu')){
                fecharContainerMenuCategorias();
            }
        });
    
        $(".subitem-menu-esq").click(function(){
            fecharContainerMenuCategorias();
        });
        $(".item-menu-esq").find('h3').click(function(){
            fecharContainerMenuCategorias();
        });
    
        
        const fecharContainerMenuCategorias = () =>{
            $("#menu-esq").removeClass("menu-categoria-open");
            $("#menu-esq").addClass("menu-categoria-close");
            setTimeout(() => {
                $("#container-categoria-menu").css({"opacity":0});
                $("#container-categoria-menu").css({"visibility":"hidden"});
                $("#container-categoria-menu").css({"transition":".2s ease-in"});
            }, 400);
            $("#abrir-menu").css({"opacity":1});
            $("#abrir-menu").css({"visibility":"visible"});
            $("#abrir-menu").css({"transition":".2s ease-in"});
            $("html body").css({"overflow":"visible"});
        }
    }

});

