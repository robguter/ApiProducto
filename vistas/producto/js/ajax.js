$(document).ready(function() {

    var msj = "";
    $("td.oEdit img").click(function(){
        $(this).blur();
        var IdPr = $(this).parent().prop("id");
        var dataString='IdPr='+IdPr;
        $.ajax({
            type: "POST",
            url: strDir+"prod/Obtener/",
            data: dataString,
            success: function(datos) {
                if ( JSON.parse(datos)!=="" ) {
                    console.log(JSON.parse(datos));
                }
            }
        });
    });

    $("td.oElim img").click(function() {
        $(this).blur();
        var IdPr = $(this).parent().prop("id");
        var dataString='IdPr='+IdPr;
        $.ajax({
            type: "POST",
            url: strDir+"prod/Eliminar/",
            data: dataString,
            success: function(datos) {
                if ( JSON.parse(datos)!=="" ) {
                    console.log("Los datos fueron ELIMINADOS satisfactoriamente.");
                }
                
            }
        });
    });

    $("input[name='EnviaForm']").click(function() {
        $(this).blur();
        var Envi = $("input[name='EnviaForm']").val();
        var IdPr = $("input[name='IdProd']").val();
        var Codi = $("input[name='Codigo']").val();
        var Desc = $("input[name='Descripcion']").val();
        var Marc = $("input[name='Marca']").val();
        var Mode = $("input[name='Modelo']").val();
        var Prec = $("input[name='PrecioU']").val();
        var Exis = $("input[name='Existencia']").val();
        var IdSu = $("input[name='IdSubCat']").val();
        var IdDt = $("input[name='IdDts']").val();
        var Imag = $("input[name='Imagen']").val();
        var dataString='Envi='+Envi+'&IdPr='+IdPr+'&Codi='+Codi+'&Desc='+Desc;
           dataString+='&Marc='+Marc+'&Mode='+Mode+'&Prec='+Prec+'&Exis='+Exis;
           dataString+='&IdSu='+IdSu+'&IdDt='+IdDt+'&Imag='+Imag;
        $.ajax({
            type: "POST",
            url: strDir+"prod/ingresa/",
            data: dataString,
            success: function(datos) {
                if ( JSON.parse(datos)!=="" ) {
                    
                    console.log("Los datos fueron Guardados satisfactoriamente.");
                }
            }
        });
    });
    
});