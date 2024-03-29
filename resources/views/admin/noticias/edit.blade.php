@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
                <br>
                <h1 class="fixed">Editar Noticia</h1>
                <form action="/noticias/editar/{{$noticia->id}}" method="post" enctype="multipart/form-data">
                    <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="titulo"><strong>Titulo de la Noticia</strong></label>
                                <input type="text" class="form-control" name="titulo" id="titulo" value="{{$noticia->titulo}}" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="prioridad"><strong>Prioridad de la Noticia</strong></label>
                                <select class="form-control" name="prioridad" id="prioridad">
                                    <option value="1">1 - Mayor prioridad</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10 - Menor prioridad</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg">
                            <div class="form-group">
                                <label for=""><strong>Descripcion de la noticia</strong></label>
                                <textarea maxlength="255" type="text" class="form-control" onkeyup="countChar(this)" name="descripcion" id="descripcion" required>{{$noticia->descripcion}}</textarea>
                                <small class="float-left" id="counter">255</small>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                    <br>
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    <br>
                    @endif
                    <div class="row">
                    
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="image"><strong>Imagen de la Noticia</strong></label>
                                <div class="custom-file">
                                    <input name="image" id="inputFile2" type="file" class="custom-file-input" lang="es">
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                    <input hidden="" name="image" id="inputFiletext" type="text" class="custom-file-input" lang="es">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="307200" /> 
                                </div>
                                <br>
                                <br>
                                <div style="text-align:center;">
                                    <img id="img2" width="175" src="{{asset('img/'.$noticia->imagen)}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div style="text-align:center;">
                        <button  class="btn btn-primary" type="submit" id="editar_noticia">Editar Noticia</button>
                    </div>
                </form>
			</div>
	    </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script>
	$(function () {
		$(document).on('click', '.borrar', function (event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
	});
</script>
<script>
    $(document).ready(function(){
        $('#counter').text(255-$('#descripcion').val().length);
    });
    function countChar(val) {
        var len = val.value.length;
        if (len >= 256) {
        val.value = val.value.substring(0, 255);
        } else {
        $('#counter').text(255 - len);
        }
    };
</script>
@endsection