@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
                <br>
                <h1 class="fixed">Modificando Encuesta</h1>
                <form action="/encuestas/editar/{{$encuesta->id}}" method="post" enctype="multipart/form-data">
                    <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12 offset-lg-4 col-lg-4">
                            <div class="form-group">
                                <label for="titulo"><strong>Nombre de la Encuesta</strong></label>
                                <input autocomplete="off" type="text" value="{{$encuesta->nombre}}" class="form-control" name="titulo" id="titulo" required>
                            </div>
                            <div class="form-group poll_options_add">
                                <label for=""></label>
                                <div id="opciones">
                                    @foreach($encuesta->Options as $option)
                                    <div class="input-group input-group-lg ref_op" id="opcion_v{{$option->id}}">
                                        <input type="text" name="opcion_v" value="{{$option->nombre}}" class="form-control" readonly>
                                        <input type="color" name="col_nom_v" value="{{$option->color}}" style="height:auto;" disabled autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="button" onclick="borraropcion('{{'v'.$option->id}}',{{$option->id}})" class="btn btn-outline-danger">
                                                <span class="fa fa-times"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="input-group mb-3 input-group-lg">
                                    <input autocomplete="off" placeholder="Nueva opción..." id="opcion_nueva" type="text" class="form-control">
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
                        <button  class="btn btn-primary" type="submit" id="agregar_encuesta">Guardar Encuesta</button>
                    </div>
                </form>
			</div>
	    </div>
    </div>
</main>
  
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
    var contador = 0;
    var ref = $('.ref_op').length;
    $(document).ready(function(){
        if(ref<2){
            $('#agregar_encuesta').attr('disabled',true);
        }
    });
    $('#agregar').click(function(){
        
        if($('#opcion_nueva').val() != ''){
            contador++;
            ref++;
            var nombre_opcion = $('#opcion_nueva').val();
            var color = $('#color_selec').val();
            $('#opciones').append('<div class="input-group input-group-lg" id="opcion_'+contador+'"><input autocomplete="off" type="text" name="opcion['+contador+']" value="'+nombre_opcion+'" class="form-control" readonly><input type="color" name="col_nom['+contador+']" value="'+color+'" style="height:auto;" ><div class="input-group-append"><button type="button" onclick="borraropcion('+contador+')" class="btn btn-outline-danger"><span class="fa fa-times"></span></button></div></div>');
            $('#opcion_nueva').val('');
            if(ref>=2){
                $('#agregar_encuesta').attr('disabled',false);
            }
        }
    });

    function borraropcion(numero, id){
        ref--;
        $('#opcion_'+numero).remove();
        if(id != null){
            $.get('/encuestas/eliminar/opcion/'+id);
        }
        if(ref<2){
            $('#agregar_encuesta').attr('disabled',true);
        }
    }


</script>
@endsection