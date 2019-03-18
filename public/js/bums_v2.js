$('.dropdown-submenu > a').on("click", function(e) {
    var submenu = $(this);
    $('.dropdown-submenu .dropdown-menu').removeClass('show');
    submenu.next('.dropdown-menu').addClass('show');
    e.stopPropagation();
});

$('.dropdown').on("hidden.bs.dropdown", function() {
    // hide any open menus when parent closes
    $('.dropdown-menu.show').removeClass('show');
});

$(document).ready(function(){
    $(".carousel").carousel({
       interval: 6000
    });
 });

// dropdown categorias
$('#maindrop').hover(function(){
	$('#dropanchor').trigger('click');
	$("#down_icon").toggleClass('fa-chevron-down').toggleClass('fa-chevron-right');
})



$('#dropanchorps4').hover(function(){
	$('#dropps4').addClass(' show')
},function(){
	$('#dropps4').removeClass(' show')
})

$('#dropanchorps3').hover(function(){
	$('#dropps3').addClass(' show')
},function(){
	$('#dropps3').removeClass(' show')
})


$('#dropanchorone').hover(function(){
	$('#dropone').addClass(' show')
},function(){
	$('#dropone').removeClass(' show')
})

$('#dropanchornin').hover(function(){
	$('#dropnin').addClass(' show')
},function(){
	$('#dropnin').removeClass(' show')
})


















/* Experimental para el carousel de comentarios */


$( "#buscador" ).on('keyup', function() {

    $('.prod').filter(function () {
		return !($(this).find('.nombreafiltrar').text().toLowerCase().indexOf($("#buscador").val().toLowerCase()) != -1);
	}).hide();
    $('.prod').filter(function () {
		return ($(this).find('.nombreafiltrar').text().toLowerCase().indexOf($("#buscador").val().toLowerCase()) != -1);
	}).show();
});

$("#selcat").on( "change", function(){
    $('.prod').show();
    $('.prod').filter(function(){
        return !($( "#selcat option:selected" ).text() === $(this).find('.catefiltrar').text());
    }).hide();
    $('.prod').filter(function(){
        return ($( "#selcat option:selected" ).text() === $(this).find('.catefiltrar').text());
    }).show();
});

$("#seldu").on( "change", function(){
    $('.prod').filter(function(){
        return !($( "#seldu option:selected" ).text() === $(this).find('.dufiltrar').text());
    }).hide();
    $('.prod').filter(function(){
        return ($( "#seldu option:selected" ).text() === $(this).find('.dufiltrar').text());
    }).show();
});

$("#correofiltro").on('keyup', function() {
    var rex = new RegExp($(this).val(), 'i');
    $('.prod').filter(function () {
        return !rex.test($(this).find('.correofiltrar').text());
    }).hide();
    $('.prod').filter(function () {
        return rex.test($(this).find('.correofiltrar').text());
    }).show();
});

$('#disponible').on('change',function(){
    $('.prod').filter(function(){
        return ('0' === $(this).find('.disponibilidad').text());
    }).hide();
    $('.prod').filter(function(){
        return ('1' === $(this).find('.disponibilidad').text());
    }).show();
});

$('#nodisponible').on('change',function(){
    $('.prod').filter(function(){
        return ('1' === $(this).find('.disponibilidad').text());
    }).hide();
    $('.prod').filter(function(){
        return ('0' === $(this).find('.disponibilidad').text());
    }).show();
});

$("#creatorfilter").on( "change", function(){
    $('.prod').filter(function(){
        return !($( "#creatorfilter option:selected" ).text() === $(this).find('.crefiltrar').text());
    }).hide();
    $('.prod').filter(function(){
        return ($( "#creatorfilter option:selected" ).text() === $(this).find('.crefiltrar').text());
    }).show();
});

$("#nickfil").on('keyup', function() {
    var rex = new RegExp($(this).val(), 'i');
    $('.prod').filter(function () {
        return !rex.test($(this).find('.nickfiltrar').text());
    }).hide();
    $('.prod').filter(function () {
        return rex.test($(this).find('.nickfiltrar').text());
    }).show();
});

$("#preciorange").on( "change", function(){
    $('.prod').filter(function(){
        return ($( "#preciorange").val() > Number($(this).find('.preciofil').text()));
    }).hide();
    $('.prod').filter(function(){
        return ($("#preciorange").val() <= Number($(this).find('.preciofil').text()));
    }).show();
});

$("#ofertarange").on( "change", function(){
    $('.prod').filter(function(){
        return ($( "#ofertarange").val() > Number($(this).find('.ofertafil').text()));
    }).hide();
    $('.prod').filter(function(){
        return ($("#ofertarange").val() <= Number($(this).find('.ofertafil').text()));
    }).show();
});

$("#pesorange").on( "change", function(){
    $('.prod').filter(function(){
        return ($( "#pesorange").val() > Number($(this).find('.pesofil').text()));
    }).hide();
    $('.prod').filter(function(){
        return ($("#pesorange").val() <= Number($(this).find('.pesofil').text()));
    }).show();
});

/* Slider de precio */
var slider = document.getElementById("preciorange");
var output = document.getElementById("precioranget");
output.innerHTML = slider.value; // Muestra el valor de precio

slider.oninput = function() {
    output.innerHTML = this.value;
}

/* Slider de oferta */
var sliderof = document.getElementById("ofertarange");
var outputof = document.getElementById("ofertaranget");
outputof.innerHTML = sliderof.value; // Muestra el valor de oferta

sliderof.oninput = function() {
    outputof.innerHTML = this.value;
}

/* Slider de peso */
var sliderp = document.getElementById("pesorange");
var outputp = document.getElementById("pesoranget");
outputp.innerHTML = sliderp.value; // Muestra el valor de peso

sliderp.oninput = function() {
    outputp.innerHTML = this.value;
}

/* */
$('#order').on('change',function(){
if($('#order').val()==1 || $('#order').val()==2){
	$('#by option:first-child').text('Mayor a menor');
	$('#by option:last-child').text('Menor a mayor');
}

else if($('#order').val()==3 || $('#order').val()==4 || $('#order').val()==5){
	$('#by option:first-child').text('Alfabetico Z-A');
	$('#by option:last-child').text('Alfabetico A-Z');
}

else if($('#order').val()==6){
	$('#by option:first-child').text('Fecha ultima a primera');
	$('#by option:last-child').text('Fecha primera a ultima');
}
});


$(document).ready(function(){
    if($('#pf').val() != '0'){
        $('#precioherramienta').html('Usted esta aumentando '+'5'+' unidades');

    }
});


function aumentarMegusta(id){
    $.ajax({
        type: 'GET', 
        url: '/noticialike/'+id,
        success: function (data) {
            var likes = Number($('#likes_num_'+id).html());
            likes++;
             $("#likes_num_"+id).html(likes)   //// For replace with previous one
        },
        error: function() { 
             console.log(data);
        }
    });
}


function borrarElementoCarritoPago(a, e, f){
    var token = $('#token').val(); 
    var route = 'borrarElementoCarrito';
    var form_data = new FormData();  
    form_data.append('elemento', a);
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,
        success:function(data){
            var tablaDatos = $("#tablaCarrito");
            tablaDatos.empty();
            var i = 0;
            acumulado = 0;
            var numero = 0;

            precioAcumulado = 0;
            var badge = $("#badge");
            badge.empty();

            $.each(data, function(i, item) {
                numero++;
                i++;
                acumulado++;
                borrado = i;
                precioAcumulado+= Number(item.precio) * Number(e) ;
                tablaDatos.append("<tr><th>"+i+"</th><td><img src='img/"+item.imagen+"' width='40' height='45' alt=''></td><td class='text-left'><input type='text' class='id_articulo' value='"+item.id+"' hidden><strong>"+item.articulo+"</strong> <br> "+item.categoria+"</td><td class='text-right'>"+formatCurrency(item.precio * e)+" "+f+"</td><td><button type='button' class='close' onclick='borrarElementoCarrito("+borrado+", "+e+", \"" +f+ "\");'><span aria-hidden='true'>&times;</span></button></td></tr>");                      
            });
            tablaDatos.append("<tr><td colspan='2'></td><td class='text-left'>TOTAL</td><td class='text-right'><strong>"+formatCurrency(precioAcumulado) +" "+f+" </strong></td></tr>");
            $('#actualizar').html(formatCurrency(precioAcumulado) +" "+f);
            badge.append(acumulado);

        }
    });

}

function actualizarbarra(num){
    if(num!=100){
        $('#pago-bar').attr('style','width:'+num+'%;');
        if($('#pago-bar').hasClass('bg-success')){
            $('#pago-bar').removeClass('bg-success');
        }
    }
    else{
        $('#pago-bar').attr('style','width:'+num+'%;');
        $('#pago-bar').addClass('bg-success');
    }
    $('.breadcrumb-item.active').removeClass('active');
    $('#b_'+num).addClass('active');
}

function comprotodolleno60(){
    if($('#name').val().length >= 1 && $('#lastname').val().length >= 1 && $('#ws').val().length >= 1){
        if(!($("#gridCheck").is(':checked'))){
            return true;
        }
        else{
            if($('#destinario').val().length >= 1 &&
                $('#cedula_destinario').val().length >= 1 &&
                $('#direccion_destinario').val().length >= 1 &&
                $('#numero_destinario').val().length >= 1){
                return true;
            }
            else{
                return false;
            }
        }
    }
    else{
        return false;
    }
}

function comprodesbloqueo60(){
    if(comprotodolleno60()){
        $('#bs_60').removeClass('disabled');
    }
    else{
        if(!$('#bs_60').hasClass('disabled')){
            $('#bs_60').addClass('disabled');
        }
    }
}

function comprocontinuar60(){
    if(comprotodolleno60()){
        $('#carousel_pago').carousel('next');
        actualizarbarra(80);
        $('#campo1').val(
            $('#name').val()+" "+$('#lastname').val()
        );
        $('#campo2').val(
            $('#ws').val()
        );
        $('.alert-vacio').hide();
    }
    else{
        $('.alert-vacio').show();
    }
}






function isValidDate(s) {
    var bits = s.split('/');
    var d = new Date(bits[2] + '/' + bits[1] + '/' + bits[0]);
    return !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));
  }

function comprotodolleno80(){
    if($('#banco_emisor').val().length >= 1 
    && $('#cedula_titular').val().length >= 1 
    && $('#referencia').val().length >= 1 
    && Date.parse($('#fecha').val()) 
    && $('#image')[0].files.length != 0){
        return true;
    }
    else{
        return false;
    }
}

function comprodesbloqueo80(){
    if(comprotodolleno80()){
        $('#bs_80').removeClass('disabled');
    }
    else{
        if(!$('#bs_80').hasClass('disabled')){
            $('#bs_80').addClass('disabled');
        }
    }
}

function comprocontinuar80(){
    if(comprotodolleno80()){
        $('#carousel_pago').carousel('next');
        actualizarbarra(100);
        $('#campo3').val(
            $('#banco_emisor').val()
        );
        $('#campo4').val(
            $('#referencia').val()
        );
        $('.alert-vacio').hide();
    }
    else{
        $('.alert-vacio').show();
    }
}

$('#category_btn').click(function(){
    $('#dropanchor').trigger('click');
    $("#down_icon").toggleClass('fa-chevron-down').toggleClass('fa-chevron-up');
})
