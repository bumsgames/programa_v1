@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
                <br>
                <h1 class="fixed">Agregar Noticia</h1>
                <form action="/noticias/crear" method="post" enctype="multipart/form-data">
                    <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="titulo"><strong>Titulo de la Noticia</strong></label>
                                <input type="text" class="form-control" name="titulo" id="titulo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg">
                            <div class="form-group">
                                <label for=""><strong>Descripcion de la noticia</strong></label>
                                <textarea maxlength="255" type="text" class="form-control" name="descripcion" onkeyup="countChar(this)" id="descripcion" required></textarea>
                                <small class="float-left" id="counter">255</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for=""><strong>Escrito por</strong></label>
                                <select class="form-control form-control-sm cd" name="autor" id="autor" required>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="image"><strong>Imagen de la Noticia</strong></label>
                                <div class="custom-file">
                                    <input name="image" id="inputFile2" type="file" class="custom-file-input" lang="es" required>
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                    <input hidden="" name="image" id="inputFiletext" type="text" class="custom-file-input" lang="es">
                                </div>
                                <br>
                                <br>
                                <div style="text-align:center;">
                                    <img id="img2" width="175">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div style="text-align:center;">
                        <button  class="btn btn-primary" type="submit" id="agregar_noticia">Agregar Noticia</button>
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