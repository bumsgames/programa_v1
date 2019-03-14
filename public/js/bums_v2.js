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