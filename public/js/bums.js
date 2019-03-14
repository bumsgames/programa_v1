$("#comprarCarrito").click(function(){
    if($("#nArt").val() >= 1){
        window.open("orden_a_pagar", "_blank");
    }else{
        swal('Usted tiene el carrito vacio.');
    }
    // swal("Gracias por su compra amig@!",
    //     "Para concretar su compra debe comunicarse con nosotros a nuestro What'sApp y proceder al pago de sus articulos, una vez verificado su pago se le hará el envio del producto o los productos comprados. \n  \n Puede comunicarse con nosotros al: \n\n (David Salazar)+58-0414-987-50-29 \n\n (Genesis Moreno)+58-0412-796-43-49\n\n (Daniel Duarte)+58-0412-11-92-379 \n\n (Brazil)+58-414-772-74-21 \n\n(Argentina)+54 9 11 3359-3681 \n\n\n Estamos a su orden.");
});

// function comprar(i){
//     if((i - 1) == 0){
//         swal('Su carrito esta vacio.');
//     }else{
//         window.open("orden_a_pagar", "_blank");
//     }
// }



// function quitar(id_duenno, nombre_duenno, apellido_duenno){
//     alert(apellido_duenno);
// }
function myFunction2(a, b, c){
    $('#primary_owner').append('<option selected value='+a+'>'+b+' '+c+'</option>');
}

function myFunction(a, b){
    $('#primary_owner').append('<option selected value='+a+'>'+b+'</option>');
}


function init() {  
    var inputFile2 = document.getElementById('inputFile2');
    inputFile2.addEventListener('change', mostrarImagen2, false);

    var inputFile = document.getElementById('inputFile1');
    inputFile.addEventListener('change', mostrarImagen, false);


    
}

function mostrarImagen2(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(event) {
        var img2 = document.getElementById('img2');
        img2.src= event.target.result;
    }
    reader.readAsDataURL(file);
}

function mostrarImagen(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(event) {
        var img = document.getElementById('img1');
        img.src= event.target.result;
    }
    reader.readAsDataURL(file);
}

//ready ready ready
$( document ).ready(function() {
    $('.carousel').carousel({
        interval: 5000
    });

    $("#hidden").hide();
    window.addEventListener('load', init, false);

    var monto = document.querySelector('#price');
    var options = {
        minimumFractionDigits:0
    };
    monto.addEventListener('input',function(){
      var separador = (this.value.substr(this.value.length - 1,1)===',')?',':''; 
      var negativo = (this.value.substr(this.value.length - 1,1)==='-')?'-':''; 
      var monto1 = this.value
      .replace(/[^\d,]/g,"")
      .replace("-", "-") 
      .replace(",","."); 
      this.value = negativo + Intl.NumberFormat('es-AR',options).format(monto1)
      + separador; 
  });

    var monto_otro = document.querySelector('#Costo');
    var options = {
        minimumFractionDigits:0
    };
    monto_otro.addEventListener('input',function(){
      var separador = (this.value.substr(this.value.length - 1,1)===',')?',':''; 
      var negativo = (this.value.substr(this.value.length - 1,1)==='-')?'-':''; 
      var monto1 = this.value
      .replace(/[^\d,]/g,"") 
      .replace(",","."); 
      this.value = negativo + Intl.NumberFormat('es-AR',options).format(monto1)
      + separador; 
  });
});

$("#boxchecked").click(function (){
    if ($("#boxchecked").prop("checked")){

        $("#hidden").show();
    }else{
        $("#hidden").hide();
    }              
});
/* */



$( "#buscador1" ).on('keyup', function() {
    var rex = new RegExp($(this).val(), 'i');
    $('tr').hide();
    $('tr').filter(function () {
        return rex.test($(this).text());
    }).show();
});

$( "#buscador2" ).on('keyup', function() {
    var rex = new RegExp($(this).val(), 'i');
    $('tr').hide();
    $('tr').filter(function () {
        return rex.test($(this).text());
    }).show();
});

$('#inputFile1').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });

$('#inputFile2').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });

$('#select_user').on('change',function(){
 $("#pertenece_user").val($("#select_user").find('option:selected').val());
});

$("#agregar_tarea").click(function(){
 var route = '/homeworkAdd';
 var token = $('#token').val();
 var form_data = new FormData();  
 form_data.append('de_usuario', $("#de_usuario").val());   
 form_data.append('para_usuario', $("#para_usuario").val());
 form_data.append('mensaje', $("#mensaje").val());
 form_data.append('status', $("#status").val());

 $.ajax({
    url:        route,
    headers:    {'X-CSRF-TOKEN':token},
    type:       'POST',
    dataType:   'json',
    data:       form_data,
    contentType: false, 
    processData: false,
    success:function(data){
        $(".modal-backdrop").remove(); 
        $(".modal").hide();
        $(".modal").trigger("click");
        swal("Tarea registrada.");
        $("#de_usuario").val('');
        $("#para_usuario").val('');
        $("#mensaje").val('');
        $("#status").val('');
        setTimeout(function() 
        {
            location.reload(); 
        }, 2000);
        // $("#xxx").trigger("click");
            // setTimeout(function () {
            //     $('#modal1').modal("hide");
            //     $('.modal-backdrop').remove();
            // }, 1000);
        },
        error:function(msj){
            swal("Error.", "Revisa los datos suministrados.", "error");
        }
    });
 console.log("Estamos aca");
});

$("#modificar_tarea").click(function(){
    var value = $("#id").val();
    var route = "/homeworkEdit/"+value+"";
    var token = $('#token').val();
    var form_data = new FormData();  
    // form_data.append('de_usuario', $("#de_usuarioM").val());
    // form_data.append('para_usuario', $("#para_usuarioM").val());
    form_data.append('mensaje', $("#mensajeM").val());
    form_data.append('status', $("#statusM").val());
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:  form_data,
        contentType: false, 
        processData: false,
        success:function(data){
            swal("Tarea modificada.");
            setTimeout(function() 
            {
                location.reload(); 
            }, 2000);
        },
        error:function(msj){
            swal("Error.", "Revisa los datos suministrados.", "error");
        }
    });
});

function devolver(id_articulo, id_pertenece, cliente, articulo, categoria){
    if(id_articulo == 2){
        swal('No se puede devolver un articulo devuelto');
        return;
    }

    swal({
        title: "Estas seguro de devolver este producto de "+cliente+"?",
        text: "Una vez devuelto, no se podra revertir esta accion",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var route = "/devolver_articulo";

        var token = $('#token').val();
        var form_data = new FormData();  
        form_data.append('id_articulo', id_articulo);
        form_data.append('id', id_pertenece);
        form_data.append('articulo', articulo);
        form_data.append('categoria', categoria);

        $.ajax({
            url:        route,
            headers:    {'X-CSRF-TOKEN':token},
            type:       'POST',
            dataType:   'json',
            data:  form_data,
            contentType: false, 
            processData: false,
            success:function(data){
                swal("Devolucion concretada.");
                setTimeout(function() 
                {
                    location.reload(); 
                }, 2000);
            },
            error:function(msj){
                swal("Error.", "No se pudo devolver.", "error");
            }
        });
    } else {

        return;
    }
});
    
}

function devolverA(id_pertenece, id_articulo){
    swal({
        title: "Estas seguro de devolver este articulo?",
        text: "Una vez devuelto, no se podra revertir esta accion",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var route = "devolverA";
        var token = $('#token').val();
        var form_data = new FormData();  
        form_data.append('id_pertenece', id_pertenece);

        $.ajax({
            url:        route,
            headers:    {'X-CSRF-TOKEN':token},
            type:       'POST',
            dataType:   'json',
            data:  form_data,
            contentType: false, 
            processData: false,
            success:function(data){
                swal("Devolucion concretada.");
                mostrar_articulo_cliente(id_articulo);
            },
            error:function(msj){
                var errormessages = "";

                $.each(msj.responseJSON, function(i, field){
                    errormessages+="\n"+field+"\n";
                });

                swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
            }
        });
    }
});
};


function eliminar_nota(){
    var id = $("#id_eliminar").val();
    var clave = $("#clave").val();
    if(clave=='spiderman1995'){
       var route = "/delete_duties/"+id+"";

       var token = $('#token').val();
       $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        contentType: false, 
        processData: false,
        success:function(data){
            swal("Tarea eliminada.");
            setTimeout(function() 
            {
                location.reload(); 
            }, 2000);
        },
        error:function(msj){
            swal("Error.", "Revisa los datos suministrados.", "error");
        }
    });
   }else{
    alert('Clave no autorizada');
}
}

function mandarid(id){
    $("#id_eliminar").val(id);
}

function mostrar_actuales(id, a, b){
    var de = a;
    de += ' ';
    de += b;
    var route = "/actuales/"+id+"";
    $.get(route, function(data){
       $("#id").val(data.id);
       $("#de_usuarioM").val(de);
       $("#para_usuarioM").val(data.para_usuario);
       $("#mensajeM").val(data.mensaje);
       $("#statusM").val(data.status);
   });
}

function modal_orden(id, cuenta, entidad){
    $("#id_cuenta").val(id);
    $("#titulo").text("Cuenta: "+cuenta+"("+entidad+")");
}

function modificar_user(){
    alert('fsdfds');
}

function modificar_user(id){
    $("#id_usuario").val(id);
    var route = "/buscar_usuario/"+id+"";
    $.get(route, function(data){
        var tabla
        $.each(data, function(i, item) {
            $("#name_modificar").val(item.name);
            $("#last_modificar").val(item.lastname);
            $("#email_modificar").val(item.email);
            $("#nickname_modificar").val(item.nickname);
            $("#nivel_modificar").val(item.level);
            $("#img2").attr("src","img/"+item.image);
        });
    });
}


$("#actualizar_usuario").click(function(){
    $("#name_modificar").val();
    $("#last_modificar").val();
    $("#email_modificar").val();
    $("#nickname_modificar").val();
    $("#nivel_modificar").val();
    $("#password_modificar").val();
    $("#image_modificar").val();
});

$("#actualizar_usuario").click(function(){
    var id = $("#id_usuario").val();
    console.log('estamos antes del token');
    var token = $('#token').val();
    var id = $("#id_usuario").val();
    var route = '/actualizar_usuario';

    var form_data = new FormData();  
    form_data.append('description',  $("#name_modificar").val());
    form_data.append('reference',  $("#last_modificar").val());
    form_data.append('note_sale',  $("#email_modificar").val());
    form_data.append('price',  $("#nickname_modificar").val());
    form_data.append('coin',  $("#nivel_modificar").val());
    form_data.append('coin',  bcrypt($("#password_modificar").val()));
    form_data.append('coin',  $("#inputFile2").val());

    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,

        success:function(data){
            swal("Usuario modificado.");
            $(".modal-backdrop").remove(); 
            $(".modal").hide();
            $(".modal").trigger("click");

        },
        error:function(msj){
            var errormessages = "";

            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });

            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
});

$("#registrar_orden").click(function(){

// id_creadoUsuario, id_recibeUsuario
var route = '/registrar_orden';
var token = $('#token').val();

var form_data = new FormData();  

form_data.append('id_cuenta',  $("#id_cuenta").val());   
form_data.append('articulo', $("#articulo").val());
form_data.append('type_orden', 'Por recibir');
form_data.append('status', $("#status").val());
form_data.append('price', $("#Costo").val().split('.').join(''));
form_data.append('empresa', $("#empresa").val());

$.ajax({
    url:        route,
    headers:    {'X-CSRF-TOKEN':token},
    type:       'POST',
    dataType:   'json',
    data:       form_data,
    contentType: false, 
    processData: false,
    success:function(data){
        if(data.tipo == 1){
            swal(data.data);
        }else{
            $(".modal-backdrop").remove(); 
            $(".modal").hide();
            $(".modal").trigger("click");
            
            swal('Orden registrada correctamente.');

            setTimeout(function() 
            {
                location.reload(); 
            }, 2000);
        }
    }
});



});

$("#agregarDuenno").click(function(){

    id = $("#primary_owner").val();
    var nombre = $("#primary_owner").find('option:selected').text();
    if($("#primary_owner").find('option:selected').text() == ''){
        return;
    }
    nombre_html=nombre.trim().replace(/ /g, '&nbsp;');
    
    $("#primary_owner").find('option:selected').remove();
    $( "#xxx" ).append('<tr><td><input type="text" class="form-control form-control-sm id_duenno" readonly value='+id+'></td><td><input type="text" class="form-control form-control-sm" readonly value='+nombre_html+'></td><td><div class="col-auto"><div class="input-group mb-2"><div class="input-group-prepend"><div class="input-group-text">%</div></div><input placeholder="Coloque su porcentaje" type="text" class="form-control form-control-sm duenno_porcentaje" id="inlineFormInputGroup" ></div></div></td><td><button type="button" class="btn btn-danger btn-sm borrar" id="abc" onclick="myFunction('+id+', \'' + nombre + '\');">Quitar</button></td></tr>"');

    //     +'"+
    //     +"</td><td><button type='button' class='btn btn-danger btn-sm borrar' id='abc' onclick='myFunction("+id+", '"+nombre+"', '"+nombre+"');'>Quitar</button></td></tr>");

});

function quitar(id){
    $( ".x" ).remove();
}

$("#modificar_articulo").click(function(){ 
    let duenno = document.querySelectorAll('.id_duenno');
    let porcentaje = document.querySelectorAll('.duenno_porcentaje');
    var temp_porcentaje = 0;
    var duenno_array = new Array();
    var porcentaje_array = new Array();
    if(porcentaje.length == 0){
        swal('El articulo no tiene dueño, por favor colocarlo');
        return;
    }

    for (var i = 0; i <porcentaje.length; i++) {
        temp_porcentaje += Number(porcentaje[i].value);

        duenno_array.push(duenno[i].value);
        porcentaje_array.push(Number(porcentaje[i].value));

        if((porcentaje[i].value) == '' ){
            swal('Hay un campo de porcentaje vacio');
            return;
        }

        if((porcentaje[i].value) == '0' ){
            swal('El porcentaje no puede ser 0');
            return;
        }
    }

    if(temp_porcentaje != 100){
        swal('La suma de los porcentajes debe ser igual a 100% \n Porcentaje = '+temp_porcentaje+' %');
        return;
    }

//ARTICLE CONTROLLER
var route = '/modificar_Articulo';
var token = $('#token').val(); 

if( $("#category").val() == 0){
    swal('El articulo debe pertenecer a una categoria');
    return;
}

var form_data = new FormData();  
categoria_nombre = $("#category").find('option:selected').text();  
form_data.append('primary_owner', $("#primary_owner").val());
form_data.append('name', $("#name").val());
form_data.append('id_articulo', $("#id_articulo").val());
form_data.append('description', $("#description").val());
form_data.append('category', $("#category").val());
form_data.append('oferta', $("#oferta").val());
form_data.append('category_nombre', categoria_nombre);
form_data.append('price_in_dolar', $("#price_in_dolar").val());
form_data.append('offer_price', $("#offer_price").val());
form_data.append('quantity', $("#quantity").val());
form_data.append('peso', $("#peso").val());
form_data.append('email', $("#email").val());
form_data.append('password', $("#password").val());
form_data.append('nickname', $("#nickname").val());
form_data.append('reset_button', $("#reset_button").val());
form_data.append('note', $("#note").val());
if($('#inputFile2').prop('files')[0]){
    form_data.append('fondo', $('#inputFile2').prop('files')[0]);
    
}   
var cambio_email_o_category = 0;
var cambio_password = 0;
a = ($("#email").val() != $("#email_viejo").val());
b = ($("#category").val() != $("#category_viejo").val());  
c = ($("#password").val() != $("#password_viejo").val());
if(a || b){
    cambio_email_o_category++;
}

if(c){
    cambio_password++;
}
form_data.append('cambio_email_o_category', cambio_email_o_category);
form_data.append('cambio_password', cambio_password);
form_data.append('id_bumsuser', JSON.stringify(duenno_array));
form_data.append('porcentaje', JSON.stringify(porcentaje_array));


$.ajax({
    url:        route,
    headers:    {'X-CSRF-TOKEN':token},
    type:       'POST',
    data:       form_data,
    contentType: false, 
    processData: false,

    success:function(data){
        if(data.tipo == 1){
            swal(data.data);  
        }else{
            $("#password_viejo").val($("#password").val());
            swal("El articulo: "+$("#name").val()+" || "+categoria_nombre+". \n\n\nFue modificado con exito.");
            // setTimeout(function() 
            // {
            //     location.reload(); 
            // }, 2000);
        }     
    },
    error:function(msj){
        var errormessages = "";

        $.each(msj.responseJSON, function(i, field){
            errormessages+="\n"+field+"\n";
        });

        swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
    }
});

});


$("#registrar_articulo").click(function(){
    let duenno = document.querySelectorAll('.id_duenno');
    let porcentaje = document.querySelectorAll('.duenno_porcentaje');
    var temp_porcentaje = 0;
    var duenno_array = new Array();
    var porcentaje_array = new Array();

    if(porcentaje.length == 0){
        swal('El articulo no tiene dueño, por favor colocarlo');
        return;
    }

    // Verifica los duennos y porcentajes y los guarda en 2 array
    for (var i = 0; i <porcentaje.length; i++) {
        temp_porcentaje += Number(porcentaje[i].value);

        duenno_array.push(duenno[i].value);
        porcentaje_array.push(Number(porcentaje[i].value));

        if((porcentaje[i].value) == ''){
            swal('Hay un campo de porcentaje vacio');
            return;
        }

        if((porcentaje[i].value) == '0' ){
            swal('El porcentaje no puede ser 0');
            return;
        }
    }

    if(temp_porcentaje != 100){
        swal('La suma de los porcentajes debe ser igual a 100% \n Porcentaje = '+temp_porcentaje+' %');
        return;

    }

    if( $("#category").val() == 0){
        swal('El articulo debe pertenecer a una categoria');
        return;
    }

    // article controller
    var route = '/registrar_articulo';
    var token = $('#token').val(); 
    var form_data = new FormData();  

    form_data.append('id_creator', $("#id_creator").val());   
    form_data.append('primary_owner', $("#primary_owner").val());
    form_data.append('secondary_owner', $("#secondary_owner").val());
    form_data.append('name', $("#name").val());
    form_data.append('description', $("#description").val());
    form_data.append('category', $("#category").val());
    form_data.append('oferta', $("#oferta").val());
    categoria_nombre = $("#category").find('option:selected').text();
    form_data.append('category_nombre', categoria_nombre);
    form_data.append('price_in_dolar', $("#price_in_dolar").val());
    form_data.append('offer_price', $("#offer_price").val());
    form_data.append('quantity', $("#quantity").val());
    form_data.append('peso', $("#peso").val());
    form_data.append('email', $("#email").val());
    form_data.append('password', $("#password").val());
    form_data.append('nickname', $("#nickname").val());
    form_data.append('reset_button', $("#reset_button").val());
    form_data.append('note', $("#note").val());
    //form_data.append('fondo', $('#inputFiletext').val());

    /* Comentado en caso que se quiera volver a tratar con 2 imagenes
    if($('#inputFile1').prop('files')[0]){
        form_data.append('image', $('#inputFile1').prop('files')[0]);
    }  */

    if($('#inputFile2').prop('files')[0]){
        form_data.append('fondo', $('#inputFile2').prop('files')[0]);      
    }  

        //form_data.append('fondo', "$('#inputFiletext').val()");



        form_data.append('id_bumsuser', JSON.stringify(duenno_array));
        form_data.append('porcentaje', JSON.stringify(porcentaje_array));

        $.ajax({
            url:        route,
            headers:    {'X-CSRF-TOKEN':token},
            type:       'POST',
            data:       form_data,
            contentType: false, 
            processData: false,

            success:function(data){
                if(data.tipo == 1){
                    swal(data.data);  
                }else{
                    swal("El articulo: "+$("#name").val()+" | "+categoria_nombre+". Fue registrado con exito.");
                }
            },
            error:function(msj){
                var errormessages = "";
                $.each(msj.responseJSON, function(i, field){
                    errormessages+="\n"+field+"\n";
                });

                swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
            }
        });

    });

//ventana tipo lista
$("#actualizar_uss").click(function(){
    var token = $('#token').val();
    var id = $("#id_usuario").val();
    var route = "/actualizar_uss";
    var form_data = new FormData();  
    form_data.append('id',  id);
    form_data.append('name',  $("#name_modificar").val());
    form_data.append('lastname',  $("#last_modificar").val());
    form_data.append('email',  $("#email_modificar").val());
    form_data.append('nickname',  $("#nickname_modificar").val());

    if($("#password_modificar").val()){
        form_data.append('password',  $("#password_modificar").val());
    }  
    if($('#nivel_modificar').val()){
        form_data.append('level',  $("#nivel_modificar").val());
    }  

    if($('#inputFile2').prop('files')[0]){
        form_data.append('image', $('#inputFile2').prop('files')[0]);

    }
    // if($('#inputFile1').prop('files')[0]){
    //     form_data.append('image', $('#inputFile1').prop('files')[0]);
    // }
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,

        success:function(data){
            swal("Usuario modificado.");
            $(".modal-backdrop").remove(); 
            $(".modal").hide();
            $(".modal").trigger("click");
        },
        error:function(msj){
            var errormessages = "";

            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });

            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
});

//configurar tu user
$("#actualizar_uss2").click(function(){
    var token = $('#token').val();
    var id = $("#id_usuario").val();
    var route = "/actualizar_uss";
    var form_data = new FormData();  
    form_data.append('id',  id);
    form_data.append('name',  $("#name_modificar").val());
    form_data.append('lastname',  $("#last_modificar").val());
    form_data.append('email',  $("#email_modificar").val());
    form_data.append('nickname',  $("#nickname_modificar").val());

    if($("#password_modificar").val()){
        form_data.append('password',  $("#password_modificar").val());
    }  
    if($('#nivel_modificar').val()){
        form_data.append('level',  $("#nivel_modificar").val());
    }  
    
    if($('#inputFile1').prop('files')[0]){
        form_data.append('image', $('#inputFile1').prop('files')[0]);
    }
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,

        success:function(data){
            swal("Usuario modificado.");
            setTimeout(function() 
            {
                location.reload(); 
            }, 1000);
        },
        error:function(msj){
            var errormessages = "";

            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });

            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
});

$("#name_client2").on('keyup', function(){
    if($("#name_client2").val().length > 0 && ($("#name_client2").val().length % 3) == 0){
        var token = $('#token').val(); 
        var form_data = new FormData();  
        form_data.append('name_client', $("#name_client2").val());
        form_data.append('lastname_client', $("#lastname_client2").val());
        var route = '/coincidencia';
        $.ajax({
            url:        route,
            headers:    {'X-CSRF-TOKEN':token},
            type:       'POST',
            dataType:   'json',
            data:       form_data,
            contentType: false, 
            processData: false,

            success:function(data){
                $("#table_client2 td").remove();
                var nuevaFila;
                contador = 0;
                $.each(data.mensaje, function(i, item) {
                    contador++;
                    console.log(item.name);
                    var angel = item.name;
                    nuevaFila+="<tr><td>"+contador+"</td><td>"+item.name+" "+item.lastname+"</td><td>"+item.nickname+" ||| "+item.num_contact+"</td><td><button class='btn btn-dark' id='bat' onclick='divFunction2(\""+item.id+"\",\""+item.name+"\",\""+item.lastname+"\",\""+item.num_contact+"\");'>Seleccionar</button></td></tr>";
                });
                $("#table_client2").append(nuevaFila);
            }
        });
    }
});

$("#lastname_client2").on('keyup', function(){
    if(($("#lastname_client2").val().length > 0) && ($("#lastname_client2").val().length % 3) == 0){    
        var token = $('#token').val(); 
        var form_data = new FormData();  
        form_data.append('name_client', $("#name_client2").val());
        form_data.append('lastname_client', $("#lastname_client2").val());
        var route = '/coincidencia';
        $.ajax({
            url:        route,
            headers:    {'X-CSRF-TOKEN':token},
            type:       'POST',
            dataType:   'json',
            data:       form_data,
            contentType: false, 
            processData: false,

            success:function(data){
                $("#table_client2 td").remove();
                var nuevaFila;
                contador = 0;
                $.each(data.mensaje, function(i, item) {
                    contador++;
                    console.log(item.name);
                    var angel = item.name;
                    nuevaFila+="<tr><td>"+contador+"</td><td>"+item.name+" "+item.lastname+"</td><td>"+item.nickname+" ||| "+item.num_contact+"</td><td><button class='btn btn-dark' id='bat' onclick='divFunction2(\""+item.id+"\",\""+item.name+"\",\""+item.lastname+"\",\""+item.num_contact+"\");'>Seleccionar</button></td></tr>";
                });
                $("#table_client2").append(nuevaFila);
            }
        });
    }
});


$("#name_client").on('keyup', function(){
    if($("#name_client").val().length > 0 && ($("#name_client").val().length % 2) == 0){
        var token = $('#token').val(); 
        var form_data = new FormData();  
        form_data.append('name_client', $("#name_client").val());
        form_data.append('lastname_client', $("#lastname_client").val());
        var route = '/coincidencia';
        $.ajax({
            url:        route,
            headers:    {'X-CSRF-TOKEN':token},
            type:       'POST',
            dataType:   'json',
            data:       form_data,
            contentType: false, 
            processData: false,
            success:function(data){
                $("#table_client td").remove();
                var nuevaFila;
                $.each(data.mensaje, function(i, item) {
                    nuevaFila+="<tr><td>"+item.name+" "+item.lastname+"</td><td>"+item.nickname+"</td><td><button id='bat' onclick='divFunction(\""+item.id+"\",\""+item.nickname+"\",\""+item.name+"\",\""+item.lastname+"\",\""+item.num_contact+"\",\""+item.note+"\",);'>Seleccionar</button></td></tr>";
                });
                $("#table_client").append(nuevaFila);
            }
        });
    }
});

$("#lastname_client").on('keyup', function(){
    if(($("#lastname_client").val().length > 0) && ($("#lastname_client").val().length % 2) == 0){    
        var token = $('#token').val(); 
        var form_data = new FormData();  
        form_data.append('name_client', $("#name_client").val());
        form_data.append('lastname_client', $("#lastname_client").val());
        var route = '/coincidencia';
        $.ajax({
            url:        route,
            headers:    {'X-CSRF-TOKEN':token},
            type:       'POST',
            dataType:   'json',
            data:       form_data,
            contentType: false, 
            processData: false,
            success:function(data){
                $("#table_client td").remove();
                var nuevaFila;
                $.each(data.mensaje, function(i, item) {
                    nuevaFila+="<tr><td>"+item.name+" "+item.lastname+"</td><td>"+item.nickname+"</td><td><button id='bat' onclick='divFunction(\""+item.id+"\",\""+item.nickname+"\",\""+item.name+"\",\""+item.lastname+"\",\""+item.num_contact+"\",\""+item.note+"\",);'>Seleccionar</button></td></tr>";
                });
                $("#table_client").append(nuevaFila);
            }
        });
    }
});



$("#borrar_client_venta").click(function(){
    $("#id_client").val('');
    $("#nickname").val('');
    $("#name_client").val('');
    $("#lastname_client").val('');
    $("#num_contact").val('');
    $("#note").val('');
});
$("#name").on('keyup', function(){
    if($("#name").val().length > 2){
        var token = $('#token').val(); 
        var form_data = new FormData();  
        form_data.append('name', $("#name").val());
        var route = '/coincidenciaArticulo';
        $.ajax({
            url:        route,
            headers:    {'X-CSRF-TOKEN':token},
            type:       'POST',
            dataType:   'json',
            data:       form_data,
            contentType: false, 
            processData: false,
            success:function(data){
                $("#tablacoincidenciaart").show();

                $("#table_article td").remove();
                var nuevaFila;
                $.each(data.mensaje, function(i, item) {
                    nuevaFila+="<tr><td>"+item.name+"</td><td class='cat"+item.category+"'></td><td><button id='bat' onclick='divFunctionArt(\""+item.name+"\",\""+item.category+"\",\""+item.oferta+"\",\""+item.price_in_dolar+"\",\""+item.offer_price+"\",\""+item.peso+"\",\""+item.fondo+"\",);'>Seleccionar</button></td></tr>";
                });
                $("#table_article").append(nuevaFila);
                $.each(data.cat,function(i,item){
                    $(".cat"+item.id).text(item.category);
                });
            }
        });
    }
});
function divFunctionArt(){
    alert('name');
}

function divFunctionArt(name, category, oferta, price_in_dolar, offer_price, peso, fondo){

    $("#name").val(name);
    $("#category").val(category);
    $("#oferta").val(oferta);
    $("#price_in_dolar").val(price_in_dolar);
    $("#offer_price").val(offer_price);
    $("#peso").val(peso);
    $("#inputFiletext").val(fondo);
    $("#img2").attr( 'src', 'img/'+fondo );

    $("#tablacoincidenciaart").hide();
}


function divFunction(){
    alert('name');
}

function divFunction(id, nickname, name, lastname, contact, note){
    $("#id_client").val(id);
    $("#nickname").val(nickname);
    $("#name_client").val(name);
    $("#lastname_client").val(lastname);
    $("#num_contact").val(contact);
    $("#note").val(note);
    $("#table_client td").remove();
}

function divFunction2(id, name, lastname, contact){
    $("#id_client2").val(id);
    $("#name_client2").val(name);
    $("#lastname_client2").val(lastname);
    $("#num_contact2").val(contact);
    $("#table_client2 td").remove();
}

// vender_articulo
$("#realizar_venta").click(function(){
    var route = '/realizar_venta';
    var token = $('#token').val();

    nombre_cliente   = $("#name_client").val();
    apellido_cliente = $("#lastname_client").val();
    //CLIENTE
    var form_data = new FormData();  
    form_data.append('id', $("#id_client").val());   
    form_data.append('name', nombre_cliente);
    form_data.append('lastname', apellido_cliente);
    if( $("#nickname").val() ){
     form_data.append('nickname', $("#nickname").val());
 }else{
    var nickname = $("#name_client").val()+""+$("#lastname_client").val()+""+Math.floor(Math.random() * (999 - 100 + 1));
    form_data.append('nickname', nickname);
}
form_data.append('num_contact', $("#num_contact").val());
form_data.append('note', $("#note").val());


//parte pago
form_data.append('type', 'bums');
form_data.append('entidad', $("#description").val());
form_data.append('description', 'Venta Realizada');
form_data.append('cantidad', $("#cantidad").val());

if($("#reference").val()){
    form_data.append('referencia', $("#reference").val());
}

form_data.append('id_coin', $("#coin").val());
form_data.append('price', $("#price").val().split('.').join(''));

//venta
if($("#note_sale").val()){
    form_data.append('note_sale', $("#note_sale").val());
}
id_articulo = $("#id_articulo").val();
form_data.append('id_article', id_articulo);
 
//ENVIO
if ($("#boxchecked").prop("checked")){
    form_data.append('empresa', $("#empresa").val());
    form_data.append('direccion', $("#direccion").val());
    form_data.append('cedula', $("#cedula").val());
    form_data.append('num_telefono', $("#num_telefono").val());
    form_data.append('recibe', $("#recibe").val());
    form_data.append('type_orden', "Por enviar.");
    form_data.append('articulo', $("#articulo_venta").val());
    form_data.append('envio', 'si');
}   else{
    form_data.append('envio', 'no');
} 

$.ajax({
    url:        route,
    headers:    {'X-CSRF-TOKEN':token},
    type:       'POST',
    dataType:   'json',
    data:       form_data,
    contentType: false, 
    processData: false,
    success: function(data){
        if(data.tipo == 1){
            swal(data.data);
        }else{
            $("#description").val('');
            $("#reference").val('');
            $("#price").val('');
            $("#note_sale").val('');
            $("#id_client").val('');
            $("#nickname").val('');
            $("#name_client").val('');
            $("#lastname_client").val('');
            $("#num_contact").val('');
            $("#note").val('');
            $("#table_client td").remove();
            swal('Venta registrada.');
            $(".modal-backdrop").remove(); 
            $(".modal").hide();
            $(".modal").trigger("click");

            email = $("#email_articulo_venta").val();
            if($("#email_articulo_venta").val() != ''){
                email = '_';
            }
            
            password = $("#password_articulo_venta").val();
            if($("#password_articulo_venta").val() != ''){
                password = '_';
            }
            
            window.open("entrega/"+id_articulo+
                '/'+nombre_cliente
                +'/'+apellido_cliente, "_blank");
        }       
    },
    error:function(msj){
        var errormessages = "";
        $.each(msj.responseJSON, function(i, field){
            errormessages+="\n"+field+"\n";
        });
        swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
    }
});

});

$("#btn-entrega").click(function(){
    id_articulo      = $("#entega_idArticulo").val();
    nombre_cliente   = $("#entega_nombreCliente").val();
    apellido_cliente = $("#entega_apellidoCliente").val();
    if(id_articulo == '' || nombre_cliente == '' || apellido_cliente == ''){
        swal('Algun campo de texto esta vacio, verifique por favor');
        return;
    }
    
    window.open("entrega/"+id_articulo+
        '/'+nombre_cliente
        +'/'+apellido_cliente, "_blank");
});

$("#tal2").click(function(){
    alert('dfsfds');
});

function vender_articulo(id, name, email, password, categoria, categoria_id){
    $('#titulo_cliente_articulo').empty();
    $("#id_articulo").val(id);
    $("#articulo_venta").val(name);
    $("#email_articulo_venta").val(email);
    $("#password_articulo_venta").val(password);
    $("#category_id_articulo_venta").val(categoria_id);
    $("#titulo_venta").empty();
    $("#titulo_venta").append("VENTA \n Articulo: "+name
        +". Correo: "+email+". Password: "+password+"\n\n\n\nCategoria: "+categoria);
}
//Modificacion rapida
function modicacion_rapida(id, name, categoria, cantidad, note, reset){
    var form_data = new FormData();  

    form_data.append('id', id);
    var token = $('#token').val();

    var route = '/modificacion_rapida';
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,
        success:function(data){


            $('#titulo_cliente_articulo').empty();
            $("#id_articulomod").val(data.data.id);
            $("#quantity").val(data.data.quantity);
            $("#notemod").val(data.data.note);
            $("#passmod").val(data.data.password);
            $("#reset_button").val(data.data.reset_button);
            $("#titulo_modificacion").empty();
            $("#titulo_modificacion").append("Modificar \n Articulo: "+data.data.name
                +"\n\n\n\nCategoria: "+categoria);
        },
        error:function(msj){
            var errormessages = "";
            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });
            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
};


/* Modificar cliente */ 

function modificar_cliente_modal(id, name, lastname, nickname, password, num_contact,note, email){
    $('#titulo_cliente_articulo').empty();
    $("#id_clientemod").val(id);
    $("#namemod").val(name);
    $("#lastnamemod").val(lastname);
    $("#nickmod").val(nickname);
    $("#passmod").val(password);
    $("#nummod").val(num_contact);
    $("#notmod").val(note);
    $("#emailmod").val(email);
    $("#titulo_cliente").empty();
    $("#titulo_cliente").append("Modificar \n Cliente: "+name+" "+lastname
        +"\n\n\n\nNickname: "+nickname);
}

function colocar_comision(id){
    $("#id_sale").val(id);
    $("input[name=id_sale]").val(id);
    $("#description").val('bien');
    var route = "/buscar_sale/"+id+"";
    $.get(route, function(data){
        $.each(data, function(i, item) {
            $("input[name=id_sale_m]").val(item.id);
            $("input[name=type_m]").val(item.type);
            $("input[name=description_m]").val(item.description);
            $("input[name=reference_m]").val(item.reference);
            $("input[name=price_m]").val(item.price);
            $("select[name=coin_m]").val(item.coin);
            $("input[name=commission_m]").val(item.commission);
            $("input[name=reference_m]").val(item.reference);
            $("#note_sale_modificar").val(item.note_sale);
            $("#type").val(item.type);
            $("#description").val(item.description);
            $("#reference").val(item.reference);
            $("#price").val(item.price).split('.').join('');
            $("#coin").val(item.coin);
            $("#note_sale").val(item.note_sale);
            $("#commission").val(item.commission);
            $("#reference").val(item.reference);
        });
    });
}

$("#colocar_comision").click(function(){
   var route = '/colocar_comision';
   var token = $('#token').val();

   var form_data = new FormData();  
   form_data.append('id',  $("#id_sale").val());   
   form_data.append('commission', $("#commission").val());

   $.ajax({
    url:        route,
    headers:    {'X-CSRF-TOKEN':token},
    type:       'POST',
    dataType:   'json',
    data:       form_data,
    contentType: false, 
    processData: false,

    success:function(data){
        console.log('funcion superada');
    }
});

});

$("#realizar_modificacion").click(function(){
    var route = '/realizar_modificacion';
    var token = $('#token').val();

    var form_data = new FormData();
    if($('#id_articulomod').val()){
        form_data.append('id', $("#id_articulomod").val());
    }
    if($('#quantity').val()){
        form_data.append('quantity', $("#quantity").val());
    }
    if($('#reset_button').val()){
        form_data.append('reset_button', $("#reset_button").val());
    }
    if($('#notemod').val()){
        form_data.append('note', $("#notemod").val());
    }
    if($('#passmod').val()){
        form_data.append('password', $("#passmod").val());
    }
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,

        success:function(data){
            if(data.tipo == 1){
                swal('Se ha modificado exitosamente');
                $('#modalmod').modal('hide');

            }
            else{
                $("#id_articulomod").val('');
                $("#quantity").val('');
                $("#reset_button").val('');
                $("#notemod").val('');

                swal('Se ha modificado exitosamente');
                $('#modalmod').modal('hide');

            }
        },
        error:function(msj){
            var errormessages = "";
            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });
            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
    
});

$("#realizar_modificacion_cliente").click(function(){
    var route = '/realizar_modificacion_cliente';
    var token = $('#token').val();

    var form_data = new FormData();
    if($('#id_clientemod').val()){
        form_data.append('id', $("#id_clientemod").val());
    }
    if($('#namemod').val()){
        form_data.append('name', $("#namemod").val());
    }
    if($('#lastnamemod').val()){
        form_data.append('lastname', $("#lastnamemod").val());
    }
    if($('#nickmod').val()){
        form_data.append('nickname', $("#nickmod").val());
    }
    if($('#passmod').val()){
        form_data.append('password', $("#passmod").val());
    }
    if($('#nummod').val()){
        form_data.append('num_contact', $("#nummod").val());
    }
    if($('#notmod').val()){
        form_data.append('note', $("#notmod").val());
    }
    if($('#emailmod').val()){
        form_data.append('email', $("#emailmod").val());
    }
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,

        success:function(data){
            if(data.tipo == 1){
                swal('Se ha modificado exitosamente');
                $('#modalmod').modal('hide');

            }
            else{
                $("#id_clientemod").val('');
                $("#namemod").val('');
                $("#lastnamemod").val('');
                $("#nickmod").val('');
                $("#passmod").val('');
                $("#nummod").val('');
                $("#notmod").val('');
                $("#emailmod").val('');
                swal('Se ha modificado exitosamente');
                $('#modalmod').modal('hide');

            }
        },
        error:function(msj){
            var errormessages = "";
            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });
            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
    
});


$("#registrar_cuenta").click(function(){
    var route = '/registrar_cuenta';
    var token = $('#token').val();

    var form_data = new FormData(); 
    if(!($("#entidad").val())){
        swal('Falta la entidad');
        return;
    }
    if(!($("#Correo").val())){
        swal('Falta el correo');
        return;
    }
    form_data.append('entidad', $("#entidad").val());
    form_data.append('correo', $("#Correo").val());   
    form_data.append('password', $("#Password").val());   

    //parte pago
    form_data.append('price', $("#price").val().split('.').join(''));
    form_data.append('id_coin', $("#coin").val());
    form_data.append('note_cuenta', $("#note_cuenta").val());

    console.log(form_data);

    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,
        success: function(data){
            if(data.tipo == 1){

                swal(data.data);

            }else{
                $(".modal-backdrop").remove(); 
                $(".modal").hide();
                $(".modal").trigger("click");


                swal('Cuenta registrada exitosamente');

                setTimeout(function() 
                {
                    location.reload(); 
                }, 2000);
            }
        },error:function(data){
            swal('Error');
        }
    });
});


$("#modificar_movimiento").click(function(){
    var route = '/colocar_comision';
    var token = $('input[name=_token]').val();

    var form_data = new FormData();  
    form_data.append('id',  $("input[name=id_sale_m]").val());
    form_data.append('description',  $("input[name=description_m]").val());
    form_data.append('reference',  $("input[name=reference_m]").val());
    form_data.append('note_sale',  $("#note_sale_modificar").val());
    form_data.append('price',  $("input[name=price_m]").val());
    form_data.append('coin',  $("select[name=coin_m]").val());

    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,

        success:function(data){
            console.log('funcion superada');
        }
    });
});



//registrar_movimiento
$( "#frm" ).on( "submit", function( event ) {
  event.preventDefault();
  var form_data = new FormData();  
  form_data.append('entidad', $("#description_registrar").val());
  form_data.append('description', 'Saldo Agregado');
  form_data.append('price', $("#price").val().split('.').join(''));
  form_data.append('id_coin', $("#coin").val());
  form_data.append('note_movimiento', $("#note_movimiento").val());  
  form_data.append('type', $("#movement").val());
  form_data.append('referencia', $("#referencia").val());
  form_data.append('pertenece_user',$("#pertenece_user").val())
// realizar_movimiento_financiero
$.ajax({
    url:        $("#frm").attr("action"),
    headers:    {'X-CSRF-TOKEN':$("#token").val()},
    type:       $("#frm").attr("method"),
    dataType:   'json',
    data:      form_data,
    contentType: false, 
    processData: false,

    success:function(data){
        swal("Movimiento registrado con exito.");
        setTimeout(function() 
        {
            location.reload(); 
        }, 1000);
    },
    error:function(msj){
        swal("Error.", "Hubo un error y no pudo ser guardado su movimiento.", "error");
    }
});
});



 // $( "#xxx" ).append( "<div class='row x'>"+
 //        "<div class='col'>"+
 //        "<input type='text' class='id_duenno form-control form-control-sm'  placeholder='ID' value="+id+" readonly>"+
 //        "</div>"+
 //        "<div class='col'><input type='text' value="+nombre+" class='form-control form-control-sm' readonly placeholder='Nombre y Apellido'></div><div class='col'><input type='text' class='duenno_porcentaje form-control form-control-sm'  placeholder='Porcentaje %' value='100'>%</div><br><button type='button' class='btn btn-danger btn-sm' onclick='quitar(1);'>Quitar</button><br></div><br><br>" );

 function borrarElementoCarrito(a, e, f){
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
                tablaDatos.append("<tr><td>"+i+"</td><td><input type='text' class='id_articulo' value='"+item.id+"' hidden>"+item.articulo+" || "+item.categoria+"</td><td>"+formatCurrency(item.precio * e)+" "+f+"</td><td><img src='img/"+item.imagen+"' width='40' height='45' alt=''></td><td><button type='button' class='close' onclick='borrarElementoCarrito("+borrado+", "+e+", \"" +f+ "\");'><span aria-hidden='true'>&times;</span></button></td></tr>");                      
            });
            $("#nArt").val(numero);
            tablaDatos.append("<tr><td></td><td><strong>Total: "+formatCurrency(precioAcumulado) +" "+f+" </strong></td></tr>");
            badge.append(acumulado);

        }
    });

}


function agregaCarro(id,a,b,c,d, e, f){

    var token = $('#token').val(); 
    var form_data = new FormData();  
    form_data.append('id', id);
    form_data.append('articulo', a);
    form_data.append('categoria', b);
    form_data.append('precio', c);
    form_data.append('imagen', d);
    var route = 'agregaCarro';
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
            var numero = 0;
            acumulado = 0;

            precioAcumulado = 0;
            var badge = $("#badge");
            badge.empty();

            $.each(data, function(i, item) {
                numero++;
                i++;
                acumulado++;
                borrado = i;
                precioAcumulado+= Number(item.precio) * Number(e) ;
                tablaDatos.append("<tr><td>"+i+"</td><td><input type='text' class='id_articulo' value='"+item.id+"' hidden=''>"+item.articulo+" || "+item.categoria+"</td><td>"+formatCurrency(item.precio * e)+" "+f+"</td><td><img src='img/"+item.imagen+"' width='40' height='45' alt=''></td><td><button type='button' class='close' onclick='borrarElementoCarrito("+borrado+", "+e+", \"" +f+ "\");'><span aria-hidden='true'>&times;</span></button></td></tr>");                      
            });
            $("#nArt").val(numero);
            tablaDatos.append("<tr><td></td><td></td><td><strong>Total: "+formatCurrency(precioAcumulado)+" "+f+" </strong></td></tr>");
            badge.append(acumulado);
            

        }
    });
}

function nicknameAleatorio(nombre_cliente, apellido_cliente){
    var nickname = nombre_cliente+""+apellido_cliente+""+Math.floor(Math.random() * (999 - 100 + 1));
    return nickname;
}
function formatCurrency(amount, symbol, groupDigits, preFixed, exchangeCommas){
    var result = amount.toFixed(2);
    


    var decimalIndex = result.lastIndexOf(".");
    result = result.replace(".", ",");

    result = result.substring(0, decimalIndex) + "," + result.substring(decimalIndex + 1);
    result = result.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    return result;
}
$("#borrar_campos").click(function(){
    id_cliente       = $("#id_client2").val('')
    nombre_cliente   = $("#name_client2").val('');
    apellido_cliente = $("#lastname_client2").val('');
    num_cliente      = $("#num_contact2").val('');
});

$("#botonagregartutorial").click(function(){
    titulo = $("#tituloTutorialmodal").val();
    texto = $("#contenidoTutorialmodal").val();
    var token = $('#token').val();
    var form_data = new FormData();

    form_data.append('titulo', titulo);
    form_data.append('texto', texto);

    var route = '/agregar_tutorial_modal';
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,
        success:function(data){
            titulo  = $("#tituloTutorialmodal").val('')
            texto   = $("#contenidoTutorialmodal").val('');
            swal('Tutorial agregado con exito!');
        },
        error:function(msj){
            var errormessages = "";
            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });
            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
});

$("#agregar_cliente_articulo").click(function(){ 
    id_articulo      = $("#id_articulo2").val();
    id_cliente       = $("#id_client2").val()
    nombre_cliente   = $("#name_client2").val();
    apellido_cliente = $("#lastname_client2").val();
    num_cliente      = $("#num_contact2").val();
    informacion      = "Pertenencia de articulo colocado manualmente";
    var token = $('#token').val(); 
    var form_data = new FormData(); 

    //cliente
    form_data.append('id_cliente', id_cliente);
    form_data.append('name', nombre_cliente);
    form_data.append('lastname', apellido_cliente);
    form_data.append('num_contact', num_cliente);
    if(!(id_cliente)){
        form_data.append('nickname', nicknameAleatorio(nombre_cliente, apellido_cliente));
    }
    //pertenece cliente 
    form_data.append('id_cliente', id_cliente);
    form_data.append('id_article', id_articulo);
    form_data.append('informacion', informacion);
    var route = '/agregar_cliente_articulo';
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,
        success:function(data){
            id_cliente       = $("#id_client2").val('')
            nombre_cliente   = $("#name_client2").val('');
            apellido_cliente = $("#lastname_client2").val('');
            num_cliente      = $("#num_contact2").val('');
            mostrar_articulo_cliente(id_articulo);
        },
        error:function(msj){
            var errormessages = "";
            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });
            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
});

$(document).ready(function(){
    if($('#pf').val() != '0'){
        if($('#pf').val()>0){
            $('#precioherramienta').html('Usted esta aumentando '+$('#pf').val()+$('#sign').text()+' en los precios');
        }
        else{
            $('#precioherramienta').html('Usted esta disminuyendo '+$('#pf').val()+$('#sign').text()+' en los precios');
        }
        $('#infoherramienta').html('Con la herramienta de revendedor');
    }
    if($('#pp').val() != '0'){
        if($('#pp').val()>0){
            $('#porcentajeherramienta').html('Usted esta aumentando un '+$('#pp').val()+'% en los precios');
        }
        else{
            $('#porcentajeherramienta').html('Usted esta disminuyendo un '+$('#pp').val()+'% en los precios');
        }
        $('#infoherramienta').html('Con la herramienta de revendedor');

    }
});

function formatNumber(num) {
    var parts = num.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
    // if (!num || num == 'NaN') return '0';
    // if (num == 'Infinity') return '&#x221e;';
    // num = num.toString().replace(/\$|\,/g, '');
    // if (isNaN(num))
    //     num = "0";
    // sign = (num == (num = Math.abs(num)));
    // num = Math.floor(num * 100 + 0.50000000001);
    // cents = num % 100;
    // num = Math.floor(num / 100).toString();
    // for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
    //     num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
    // return (((sign) ? '' : '-') + num);
}

function rand() {
    return Math.random().toString(36).substr(2); // remove `0.`
};

function borrar_tutorial_modal(id){
    var route ="/tutorial/eliminarmodal/"+id+"";
    var token = $('#token').val();
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        contentType: false, 
        processData: false,
        success:function(data){
            swal('Tutorial eliminado');

        },
        error:function(msj){
            var errormessages = "";

            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });

            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
}

function eliminaRelacion(id, id_articulo){
    var route = "/elimina_cliente_articulo/"+id+"";
    var token = $('#token').val();
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        contentType: false, 
        processData: false,
        success:function(data){
            swal('Relacion de pertenencia eliminada');
            mostrar_articulo_cliente(id_articulo);
            // swal("Movimiento eliminado.");
            // setTimeout(function() 
            // {
            //     location.reload(); 
            // }, 2000);
        },
        error:function(msj){
            var errormessages = "";

            $.each(msj.responseJSON, function(i, field){
                errormessages+="\n"+field+"\n";
            });

            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
        }
    });
}


// function eliminaRelacion(){

//     swal('Para eliminar la pertenencia se debe eliminar el movimiento desde el modulo movimiento');
// }

function mostrar_articulo_cliente(id_articulo){
    var route = "/mostrar_articulo_cliente/"+id_articulo+"";
    $.get(route, function(data){
        $( "#tabla tbody tr" ).remove();
        $('#titulo_cliente_articulo').empty();
        var titulo = '';
        contador = 0;
        $.each(data, function(i, item) {
            contador++;
            titulo = 'Juego: '+item.nombre_articulo+'. Correo: '+item.correo_articulo+'<br> Categoria: '+item.nombre_categoria;
            $( "#tabla tbody" ).append('<tr><td>'
                +contador+ '</td><td>'
                +item.name+' '+item.lastname+ '</td><td>'+item.num_contact+' ||| '
                +item.email+'</td><td><button class="btn btn-dark" onclick="eliminaRelacion('+item.id_pertenece+','+id_articulo+');">Elimina relacion</button><button onclick="devolverA('+item.id_pertenece+','+id_articulo+');" class="btn btn-dark">Devolver articulo</button></td></tr>"');
        });
        $('#titulo_cliente_articulo').append(titulo);
        $('#id_articulo2').val(id_articulo);
    });
}



function cambiaBandera(algo){
                    // switch(algo){
                    //  case '1':
                    //  $('#my_image').attr('src','img/venezuela.jpg');
                    //  break;

                    //  case '2':
                    //  $('#my_image').attr('src','img/usa.png');
                    //  break;

                    //  case '3':
                    //  $('#my_image').attr('src','img/argentina.png');
                    //  break;
                    // }
                    var token = $('#token').val(); 
                    var form_data = new FormData();  
                    form_data.append('id_coin', algo);
                    var route = 'prueba';
                    $.ajax({
                        url:        route,
                        headers:    {'X-CSRF-TOKEN':token},
                        type:       'POST',
                        dataType:   'json',
                        data:       form_data,
                        contentType: false, 
                        processData: false
                    });
                }

                function verificar(id){
                    var token = $('#token').val(); 
                    var form_data = new FormData(); 

                    form_data.append('verificar', 1);
                    form_data.append('entregar', 0);
                    form_data.append('verificar_entregar', 0);
                    form_data.append('id', id);
                    var route = '/m_pago';
                    $.ajax({
                        url:        route,
                        headers:    {'X-CSRF-TOKEN':token},
                        type:       'POST',
                        dataType:   'json',
                        data:       form_data,
                        contentType: false, 
                        processData: false,
                        success:function(data){
                            swal('Exito. Verificado.');
                        },
                        error:function(msj){
                            var errormessages = "";
                            $.each(msj.responseJSON, function(i, field){
                                errormessages+="\n"+field+"\n";
                            });
                            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
                        }
                    });
                }

                function entregar(id){
                    var token = $('#token').val(); 
                    var form_data = new FormData(); 
                    form_data.append('verificar', 0);
                    form_data.append('entregar', 1);
                    form_data.append('verificar_entregar', 0);
                    form_data.append('id', id);
                    var route = '/m_pago';
                    $.ajax({
                        url:        route,
                        headers:    {'X-CSRF-TOKEN':token},
                        type:       'POST',
                        dataType:   'json',
                        data:       form_data,
                        contentType: false, 
                        processData: false,
                        success:function(data){
                            swal('Exito. Entregado.');
                        },
                        error:function(msj){
                            var errormessages = "";
                            $.each(msj.responseJSON, function(i, field){
                                errormessages+="\n"+field+"\n";
                            });
                            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
                        }
                    });
                }

                function verificar_entregar(id){
                    var token = $('#token').val(); 
                    var form_data = new FormData(); 
                    form_data.append('verificar', 0);
                    form_data.append('entregar', 0);
                    form_data.append('verificar_entregar', 1);
                    form_data.append('id', id);
                    var route = '/m_pago';
                    $.ajax({
                        url:        route,
                        headers:    {'X-CSRF-TOKEN':token},
                        type:       'POST',
                        dataType:   'json',
                        data:       form_data,
                        contentType: false, 
                        processData: false,
                        success:function(data){
                            swal('Exito. Verificado y Entregado.');
                        },
                        error:function(msj){
                            var errormessages = "";
                            $.each(msj.responseJSON, function(i, field){
                                errormessages+="\n"+field+"\n";
                            });
                            swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
                        }
                    });
                }

                function ver_detalle_compra(id){
                    var route = "/ver_detalle_compra/"+id+"";
                    $.get(route, function(data){
                        $.each(data, function(i, item) {
                            $("#id").val(item.id);
                            $("#name").val(item.name);
                            $("#lastname").val(item.lastname);
                            $("#ws").val(item.ws);
                            $("#tipo_trans").val(item.tipo_trans);
                            $("#banco").val(item.banco);
                            $("#cedula").val(item.cedula);
                            $("#referencia").val(item.referencia);
                            $("#monto").val(item.monto);
                            $("#cupon").val(item.cupon_id);
                            $("#descuento").val(item.descuento);
                            $("#fecha").val(item.fecha);
                            $("#verificado").val(item.verificado);
                            $("#entregado").val(item.entregado);
                            $("#cedula").val(item.cedula);
                            $("#referencia").val(item.referencia);
                            $("#capture").attr("src","img/"+item.image);
                            $("#empresa").val(item.empresa);
                            $("#destinario").val(item.destinario);
                            $("#cedula_destinario").val(item.cedula_destinario);
                            $("#direccion").val(item.direccion);
                            $("#telefono").val(item.telefono);
                        });
                    });

                    var route = "/ver_articulo_compra/"+id+"";
                    var numero = 0;
                    $.get(route, function(data){
                        $("#puesto").empty();

                        $.each(data, function(i, item) {
                            numero++;
                            // alert(item.name);
                            $( "#puesto" ).append('<input type="text" class="form-control form-control-sm" disabled="" value="Articulo: '+numero+'"></input><br>');
                            $( "#puesto" ).append('<input type="text" class="form-control form-control-sm" disabled="" value="Articulo: '+item.name+'"></input><br>');
                            switch(item.category){
                                case 1:
                                $( "#puesto" ).append('<input type="text" class="form-control form-control-sm" disabled="" value="Categoria: PlayStation 4 Primario"></input><br>');
                                break;

                                case 2:
                                $( "#puesto" ).append('<input type="text" class="form-control form-control-sm" disabled="" value="Categoria: PlayStation 4 Secundario"></input><br>');
                                break;
                            }
                            $( "#puesto" ).append('<input type="text" class="form-control form-control-sm" disabled="" value="Precio: '+item.price_in_dolar+' Dolares"></input><br><br><br>');
                            $( "#puesto" ).append('<hr>');
                        });
                    });
                }

                function eliminar_orden(id){
                   var route = "/eliminar_orden/"+id+"";

                   var token = $('#token').val();
                   $.ajax({
                    url:        route,
                    headers:    {'X-CSRF-TOKEN':token},
                    type:       'post',
                    dataType:   'json',
                    contentType: false, 
                    processData: false,
                    success:function(data){
                        swal("Orden eliminada.");
                        setTimeout(function() 
                        {
                            location.reload(); 
                        }, 2000);
                    },
                    error:function(msj){
                        swal("Error.", "Revisa los datos suministrados.", "error");
                    }
                });

               }



               function AvoidSpace(event) {
                var k = event ? event.which : window.event.keyCode;
                if (k == 32) return false;
            }
