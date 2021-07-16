
var iId = 0;
$(document).ready(function() {
    var iItem=0;
    
    $(".col-lg-3").click(function() {
        //alert( $(this).children("div").children("a").attr("href")  );
        var coordd = $(this).position();
        var Tope = coordd.top;
        $(".imgGrnd").attr( "src",$(this).children("div").children("img").prop("className") ).fadeIn();
    });
    
    $('.col-lg-3m').mouseenter(function() {
        if ( iItem===0 && iId !== $(this).attr("id") ) {
            iItem=1;
            iId = $(this).attr("id");
            var dataString='Id='+iId;
            $.ajax({
                type: "POST",
                url: strDir+"index/DtsPrd/",
                data: dataString,
                success: function(datos) {
                    if ( JSON.parse(datos)!=="" ) {
                        $('.capa3.'+iId).html("");
                        var Activo;
                        $.each(JSON.parse(datos), function(i, item) {
                            filas =  '<div>' + item.Descripcion + '</div>';
                            filas += '<div>Pais: ' + item.Pais + '</div>';
                            filas += '<div>Ciudad: ' + item.Ciudad + '</div>';
                            $('.capa3.'+iId).append(filas);
                            $('.capa3').css({'top':'10px','left':'16.00%','position':'absolute'});
                            $('.capa3.'+iId).fadeOut().css('display','block').fadeIn(500);
                        });
                    }
                }
            });
        }
    });
    $(".imgGrnd").click(function() {
        $(this).fadeOut();
    });
    $('.col-lg-3').mouseleave(function() {
        /*if ( iItem===1 ) {
            $('.capa3.'+iId).fadeOut(500);
            iItem=0;
            iId = 0;
        }*/
        
    });
});