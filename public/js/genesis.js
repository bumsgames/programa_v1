

function mandaridM(id){
    $("#id_eliminar").val(id);
}

function mandaridMM(id, level_user){
    if(level_user>=8){
        $("#id_eliminar").val(id);
        $(".modal").trigger("click");
    }else{
        swal('No tienes permisos suficientes para eliminar esta imagen');
    }
}

function ventaDirect(){
    swal('Para eliminar una venta debe dirigirse a movimientos');
}

function Eliminar_mov2(){
    var id = $("#id_eliminar").val();
    var clave = $("#clave").val();
    if(clave!='caca1995'){
        swal('Clave no autorizada.');
        return;
    }
    var route = "/delete_mov/"+id+"";
    var token = $('#token').val();
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        contentType: false, 
        processData: false,
        success:function(data){
            swal("Movimiento eliminado.");
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

$("#boton_eliminar_cliente").click(function(){
    var route = '/eliminar_cliente';
    var token = $('#token').val();
    var id = $("#id_eliminar").val();
    var password = $("#password_eliminar").val();

    if(password != 'spiderman1995'){
        swal('Clave incorrecta');
        return;
    }

    var form_data = new FormData();  
    form_data.append('id', id);
    form_data.append('password', password);

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
            if(data.error=="reservado"){
                swal(data.mensaje);
            }
            else if(data.error=="duenno"){
                swal(data.mensaje)
            }
            else{
                swal("Cliente eliminado.");
                $("#password_eliminar").val('');
                setTimeout(function(){
                    location.reload(); 
                }, 2000);
            }
        },
        error:function(msj){
            swal("Error.", "Revisa los datos suministrados.", "error");
        }
    });
});


function Eliminar_usuario(){
    var id = $("#id_eliminar").val();
    var clave = $("#clave").val();
    if(clave!='spiderman1995'){
        swal('Clave no autorizada');
        return;
    }
    var route = "/delete_uss/"+id+"";
    var token = $('#token').val();
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        contentType: false, 
        processData: false,
        success:function(data){
            swal("Usuario eliminado.");
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
function eliminar_reporte(){
    var id = $("#id_eliminar").val();
    var route = "/eliminar_reporte/"+id+"";
    var clave = $("#clave").val();
    var token = $('#token').val();
    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        contentType: false, 
        processData: false,
        success:function(data){
            swal("Solicitud Procesada");
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
function Eliminar_articulo(){
    var id = $("#id_eliminar").val();
    var clave = $("#clave").val();

    var route = "/verifyPass";
    var token = $('#token').val();
    var form_data = new FormData;
    form_data.append('password', clave);

    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,
        success:function(data){
            console.log(data);
            if(data.data==true){

                var route = "/delete_articulo/"+id+"";
                var token = $('#token').val();
                $.ajax({
                    url:        route,
                    headers:    {'X-CSRF-TOKEN':token},
                    type:       'post',
                    dataType:   'json',
                    contentType: false, 
                    processData: false,
                    success:function(data){
                        swal("Articulo eliminado.");
                        setTimeout(function() 
                        {
                            location.reload(); 
                        }, 2000);
                    },
                    error:function(msj){
                        var errormessages = "";
                        $.each(msj.responseJSON, function(i, field){
                            errormessages+="\n"+field+"\n";
                        });
                        swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
                    }
                });

            }else{
                swal(data.error);
                return;
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
}
function Eliminar_envios(){
    var id = $("#id_eliminar").val();
    var clave = $("#clave").val();
    if(clave=='spiderman1995'){
       var route = "/delete_envios/"+id+"";
       var token = $('#token').val();
       $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        contentType: false, 
        processData: false,
        success:function(data){
            swal("Envio u orden eliminado.");
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
    swal('Clave no autorizada');
}
}
function Eliminar_cuenta(){
    var id = $("#id_eliminar").val();
    var clave = $("#clave").val();
    if(clave=='spiderman1995'){
       var route = "/delete_account/"+id+"";
       var token = $('#token').val();
       $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        contentType: false, 
        processData: false,
        success:function(data){
            swal("Articulo eliminado.");
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
    swal('Clave no autorizada');
}
}
function Eliminar_imagen(){
    var id = $("#id_eliminar").val();
    var clave = $("#clave").val();


    var route = "/verifyPass";
    var token = $('#token').val();
    var form_data = new FormData;
    form_data.append('password', clave);

    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'post',
        dataType:   'json',
        data:       form_data,
        contentType: false, 
        processData: false,
        success:function(data){
            console.log(data);
            if(data.data==true){
                
                console.log("paso data true");
                var route = "/delete_imagen/"+id+"";
                var token = $('#token').val();
                
                $.ajax({
                    url:        route,
                    headers:    {'X-CSRF-TOKEN':token},
                    type:       'post',
                    dataType:   'json',
                    contentType: false, 
                    processData: false,
                    success:function(data){

                        console.log(data);
                        swal("Imagen eliminada.");
                        // setTimeout(function() 
                        // {
                        //     location.reload(); 
                        // }, 2000);

                    },
                    error:function(msj){
                        swal("Error.", "Revisa los datos suministrados.", "error");
                    }
                });

            }

            if(data.data==false){
                console.log("paso data false");
                swal(data.error);
                return;
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
}


function mostrar_orden(id, a, b){
    var de = a;
    de += ' ';
    de += b;
    var route = "/actualesOrden/"+id+"";
    $.get(route, function(data){
     $("#id").val(data.id);
     $("#de_usuarioM").val(de);
     $("#trackingM").val(data.tracking);
     $("#nameM").val(data.articulo);
     $("#Costo").val(data.price);
     $("#ordenM").val(data.type_orden);
     $("#empresaM").val(data.empresa);
     $("#direccionM").val(data.direccion);
     $("#statusM").val(data.status);
     $("#cedulaM").val(data.cedula);
     $("#recibeM").val(data.recibe);
     $("#numM").val(data.num_telefono);
     console.log('este es el numer de telefono', data.num_telefono);
 });

}
$("#modificar_envio").click(function(){
    var value = $("#id").val();
    var route = "/modificarEnvio/"+value+"";
    var token = $('#token').val();
    var form_data = new FormData();  
    form_data.append('de_usuario', $("#de_usuarioM").val());
    form_data.append('tracking', $("#trackingM").val());
    form_data.append('articulo', $("#nameM").val());
    form_data.append('price', $("#Costo").val().split('.').join(''));
    form_data.append('type_orden', $("#ordenM").val());
    form_data.append('empresa', $("#empresaM").val());
    form_data.append('direccion', $("#direccionM").val());
    form_data.append('status', $("#statusM").val());
    form_data.append('recibe', $("#recibeM").val());
    form_data.append('cedula', $("#cedulaM").val());
    form_data.append('num_telefono', $("#numM").val());

    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:  form_data,
        contentType: false, 
        processData: false,
        success:function(data){
            swal("Envio u orden modificado.");
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
function buscar_cuent(id){
    var route = "/actualCuent/"+id+"";
    $.get(route, function(data){
     $("#idM").val(data.id);
     $("#entidadM").val(data.entidad);
     $("#correoM").val(data.correo);
     $("#passwordM").val(data.password);
     $("#id_bumsuserM").val(data.id_bumsuser);
     $("#note_cuentaM").val(data.note_cuenta);
     $("#coinM").val(data.id_coin);
     $("#priceM").val(data.price);

 });
}

$("#modificar_cuenta").click(function(){
    var value = $("#idM").val();
    var route = "/modificarCuenta/"+value+"";
    var token = $('#token').val();
    var form_data = new FormData();  
    form_data.append('entidad', $("#entidadM").val());
    form_data.append('correo', $("#correoM").val());
    form_data.append('articulo', $("#nameM").val());
    form_data.append('password', $("#passwordM").val());
    form_data.append('id_bumsuser', $("#id_bumsuserM").val());
    form_data.append('note_cuenta', $("#note_cuentaM").val());
    form_data.append('price', $("#priceM").val());
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

$("#agregar_envio").click(function(){

 var route = '/add_envios';
 console.log("pasamos aca");
 var token = $('#token').val();
 var form_data = new FormData();  

 form_data.append('articulo', $("#nombre").val());   
 form_data.append('type_orden', $("#orden").val());
 form_data.append('status', $("#status").val());
 form_data.append('price', $("#price").val().split('.').join(''));
 form_data.append('empresa', $("#empresa").val());   
 form_data.append('direccion', $("#direccion").val());
 form_data.append('num_telefono', $("#telefono").val());
 form_data.append('cedula', $("#cedula").val());
 form_data.append('recibe', $("#recibe").val());
 form_data.append('tracking', $("#tracking").val());
 form_data.append('id_creadoUsuario', $("#de_usuario").val());

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
        swal("Envio registrado.");
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
$("#agregar_imagenes").click(function(){

 var route = '/add_imagenes';
 console.log("pasamos aca");
 var token = $('#token').val();
 var form_data = new FormData();  

 form_data.append('id_creator', $("#de_usuario").val());   
 if($('#inputFile1').prop('files')[0]){
    form_data.append('imagen', $('#inputFile1').prop('files')[0]);
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
        $(".modal-backdrop").remove(); 
        $(".modal").hide();
        $(".modal").trigger("click");
        swal("Imagen registrada.");
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