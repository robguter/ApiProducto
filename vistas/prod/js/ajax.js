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
                    $.each(JSON.parse(datos), function(i, oProd) {
                        $("input[name='IdProd']").val(oProd.IdProd);
                        $("input[name='Codigo']").val(oProd.Codigo);
                        $("input[name='Descripcion']").val(oProd.Descripcion);
                        $("input[name='Marca']").val(oProd.Marca);
                        $("input[name='Modelo']").val(oProd.Modelo);
                        $("input[name='PrecioU']").val(oProd.PrecioU);
                        $("input[name='Existencia']").val(oProd.Existencia);
                        $("input[name='Imagen']").val(oProd.Imagen);

                        msj = "Los datos fueron RECUPERADOS satisfactoriamente.";
                        $("#mensaje").children("p").html(msj);
                        $("#mensaje").fadeIn(500);
                        setTimeout(function() {
                            $("#mensaje").fadeOut(1000);
                        },2000);
                    });
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
                    var sImgDir = 'pubs/img/formup/thumb/';
                    var sCadE = 'pubs/img/Editar.png';
                    var sCadB = 'pubs/img/Eliminar.png';
                    $(".produt").html("");
                    var sfils="";
                    sfils="<thead><tr>";
                    sfils+="<th>Codigo</th>";
                    sfils+="<th>Descripcion</th>";
                    sfils+="<th>Marca</th>";
                    sfils+="<th>Modelo</th>";
                    sfils+="<th>PrecioU</th>";
                    sfils+="<th>Existencia</th>";
                    sfils+="<th>Imagen</th>";
                    sfils+="<th class='oEdit'><img src='" + sCadE + "' title='" + sCadE + "'>  </th>";
                    sfils+="<th class='oElim'><img src='" + sCadB + "' title='" + sCadB + "'></th>";
                    sfils+="</tr>";
                    sfils+="</thead>";
                    
                    $.each(JSON.parse(datos), function(i, item) {
                        sfils+="<tr>";
                        sfils+="<td>" + item.Codigo + "</td>";
                        sfils+="<td>" + item.Descripcion + "</td>";
                        sfils+="<td>" + item.Marca + "</td>";
                        sfils+="<td>" + item.Modelo + "</td>";
                        sfils+="<td>" + item.PrecioU + "</td>";
                        sfils+="<td>" + item.Existencia + "</td>";
                        sfils+="<td>" + "<img class='imgCld' src='" + sImgDir + item.Imagen + ".jpg'/></td>";
                        sfils+="<td class='oEdit' id='" + item.IdProd + "'><img src='" + sCadE + "' ></td>";
                        sfils+="<td class='oElim' id='" + item.IdProd + "'><img src='" + sCadB + "' ></td>";
                        sfils+="</tr>";
                    });
                    $(".produt").append(sfils);
                }
                var msj = "Los datos fueron ELIMINADOS satisfactoriamente. Por favor revise su correo para activar su cuanta";
                $("#mensaje").children("p").html(msj);
                $("#mensaje").fadeIn(500);
                setTimeout(function() {
                    $("#mensaje").fadeOut(1000);
                },2000);
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
        var Imag = $("input[name='Imagen']").val();
        var dataString='Envi='+Envi+'&IdPr='+IdPr+'&Codi='+Codi+'&Desc='+Desc;
           dataString+='&Marc='+Marc+'&Mode='+Mode+'&Prec='+Prec+'&Exis='+Exis;
           dataString+='&Imag='+Imag;
        $.ajax({
            type: "POST",
            url: strDir+"prod/ingresa/",
            data: dataString,
            success: function(datos) {
                if ( JSON.parse(datos)!=="" ) {
                    var sImgDir = 'pubs/img/formup/thumb/';
                    var sCadE = 'pubs/img/Editar.png';
                    var sCadB = 'pubs/img/Eliminar.png';
                    $(".produt").html("");
                    var sfils="";
                    sfils="<thead><tr>";
                    sfils+="<th>Codigo</th>";
                    sfils+="<th>Descripcion</th>";
                    sfils+="<th>Marca</th>";
                    sfils+="<th>Modelo</th>";
                    sfils+="<th>PrecioU</th>";
                    sfils+="<th>Existencia</th>";
                    sfils+="<th>Imagen</th>";
                    sfils+="<th class='oEdit'><img src='" + sCadE + "' title='" + sCadE + "'>  </th>";
                    sfils+="<th class='oElim'><img src='" + sCadB + "' title='" + sCadB + "'></th>";
                    sfils+="</tr>";
                    sfils+="</thead>";
                    
                    $.each(JSON.parse(datos), function(i, item) {
                        sfils+="<tr>";
                        sfils+="<td>" + item.Codigo + "</td>";
                        sfils+="<td>" + item.Descripcion + "</td>";
                        sfils+="<td>" + item.Marca + "</td>";
                        sfils+="<td>" + item.Modelo + "</td>";
                        sfils+="<td>" + item.PrecioU + "</td>";
                        sfils+="<td>" + item.Existencia + "</td>";
                        sfils+="<td>" + "<img class='imgCld' src='" + sImgDir + item.Imagen + ".jpg'/></td>";
                        sfils+="<td class='oEdit' id='" + item.IdProd + "'><img src='" + sCadE + "' ></td>";
                        sfils+="<td class='oElim' id='" + item.IdProd + "'><img src='" + sCadB + "' ></td>";
                        sfils+="</tr>";
                    });
                    $(".produt").append(sfils);
                }
                var msj = "Los datos fueron guardados satisfactoriamente. Por favor revise su correo para activar su cuanta";
                $("#mensaje").children("p").html(msj);
                $("#mensaje").fadeIn(500);
                setTimeout(function() {
                    $("#mensaje").fadeOut(1000);
                },2000);
            }
        });
    });
    
});