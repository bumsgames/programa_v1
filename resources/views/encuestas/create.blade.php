@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
                <br>
                <h1 class="fixed">Agregar Encuesta</h1>
                <form action="/encuestas/crear" method="post" enctype="multipart/form-data">
                    <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12 offset-lg-4 col-lg-4">
                            <div class="form-group">
                                <label for="titulo"><strong>Nombre de la Encuesta</strong></label>
                                <input type="text" class="form-control" name="titulo" id="titulo" required>
                            </div>
                            <div class="form-group poll_options_add">
                                <label for=""></label>
                                <div id="opciones">

                                </div>
                                <div class="input-group mb-3 input-group-lg">
                                    <input placeholder="Nueva opción..." id="opcion_nueva" type="text" class="form-control">
                                    <input id="color_selec" type="color" style="height:auto;">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-dark" id="agregar"><span class="fa fa-plus"></span></button>
                                    </div>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                        
                        </div>
                    </div>
                    <hr>
                    <div style="text-align:center;">
                        <button  class="btn btn-primary" type="submit" id="agregar_encuesta">Agregar Encuesta</button>
                    </div>
                </form>
			</div>
	    </div>
    </div>
</main>
<div class="input-group input-group-lg">
        <input type="text" class="form-control" readonly>
        <div class="input-group-append">
            <button class="btn btn-outline-danger"><span class="fa fa-times"></span></button>
        </div>
    </div>     
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
    var contador = 0;
    $('#agregar').click(function(){
        
        if($('#opcion_nueva').val() != ''){
            contador++;
            var nombre_opcion = $('#opcion_nueva').val();
            var color = $('#color_selec').val();
            $('#opciones').append('<div class="input-group input-group-lg" id="opcion_'+contador+'"><input type="text" name="opcion['+contador+']" value="'+nombre_opcion+'" class="form-control" readonly><input type="color" name="col_nom['+contador+']" value="'+color+'" style="height:auto;" ><div class="input-group-append"><button type="button" onclick="borraropcion('+contador+')" class="btn btn-outline-danger"><span class="fa fa-times"></span></button></div></div>');
            $('#opcion_nueva').val('');
        }
    });

    function borraropcion(numero){
        $('#opcion_'+numero).remove();
    }
</script>
@endsection