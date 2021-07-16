var strDir='';
var cmpo="";
var ActClase="o-No";


// EVENTOS DEL DOM
$(window).on('load',function(){
    $('.toggle-nav').click(toggleNavigation);
});
$(document).ready(function(){
    //$('footer').fadeOut(1000);
    //alert( $(window).width() );
    $("#bCrrar").click(function() {
        $(this).blur();
        //$('#'+$(this).parent().attr("id")+' p').html("");
        $(this).parent()
            .fadeOut(1000)
            .css('display','none');
    });
    $(window).scroll(function(){
        var iAlto = $(window).height();
        var windowHeight = $(window).scrollTop();
        var contenido2 = $("body").innerHeight();
        //contenido2 = parseInt(contenido2.top);
        //alert("windowHeight:"+windowHeight +", iAlto:"+ iAlto +", contenido2:"+ contenido2);
        
        if((windowHeight) <55 ){
            $('footer').fadeOut(1000);
        }else{
            if((windowHeight+iAlto) >= contenido2 ){
                $('footer').fadeIn(1000);
            }else{
                $('footer').fadeOut(1000);
            }
        }
    });
    $(".InfoM").click(function() {
        $("footer .CpCntP").toggle("3000");
    });
    $('.account').click(function() {
        $(".dropdown-menu").toggle("1000").css("z-index",1000);
        $(".dropdown-menu li").css("z-index",2000);
    });
});
// DECLARACIÓN DE LA FUNCION
function toggleNavigation(){
    $('.page-header').toggleClass('menu-expanded');
    $('.page-nav').toggleClass('collapse');
}