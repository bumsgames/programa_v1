@extends('layouts.bums', ['tutoriales' => $tutoriales]) 
@section('content')
<main class="app-content">
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<center>
					<br>
					<h1 class="fixed">REGISTRANDO ARTICULO</h1>
					<!-- 		enctype="multipart/form-data" files="true" action="/user" method="post" -->
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<br>
					<br>
					<div class="row">

						<div class="form-group" hidden="">
							<label for=""><strong>ID_USUARIO DEL USUARIO QUE CREA</strong></label>
							<input class="form-control form-control-sm" type="text" placeholder="" name="id_creator" value="{{ isset(Auth::user()->id) ? Auth::user()->id : 'USUARIO NO LOGUEADO' }}"
							 readonly id="id_creator">
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Dueño(s) del Articulo</strong></label>
								<select class="form-control form-control-sm cd" name="primary_owner" id="primary_owner">
									@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
									@endforeach
								</select>
							</div>
							<button class="btn btn-primary" id="agregarDuenno">Agregar dueño</button>
							<br><br>
							<div id="xxx">

							</div>
							<br>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Nombre del Articulo</strong></label>
								<input class="form-control form-control-sm" type="text" name="name" id="name" placeholder="" autocomplete="off">

							</div>
							{!!$errors->first('name','<span class="help-block">:message</span>')!!} {!!$errors->first('nickname','
							<span class="help-block">:message</span>')!!}
						</div>
						<div class="col-12 col-lg" hidden="">
							<div class="form-group">
								<label for=""><strong>Descripcion</strong></label>
								<input type="text" class="form-control" name="description" id="description" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Categoria</strong></label>
								<select class="form-control form-control-sm" name="category" id="category">
								<option value="0">Sin categoria</option>
								@foreach($categories as $category)
								<option value="{{$category->id}}">{{$category->category}}</option>
								@endforeach
							</select>
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Activar Oferta</strong></label>
								<select class="form-control form-control-sm" name="category" id="oferta">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							</div>
						</div>
					</div>
					<div id="tablacoincidenciaart" class="table-responsive" style="display:none">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Nombre del articulo</th>
									<th scope="col">Categoria</th>
									<th scope="col">Boton</th>
								</tr>
							</thead>
							<tbody id="table_article">

							</tbody>
						</table>
					</div>
					<hr>
					<hr>
					<div class="row">
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for="costo"><strong>Costo de Inversión ($)</strong></label>
								<input value="0" class="form-control form-control-sm" type="number" autocomplete="off" name="costo" id="costo"
								 value="100" placeholder="" min="0">
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Precio Subrayado ($)</strong></label>
								<input value="0" class="form-control form-control-sm" type="number" autocomplete="off" name="offer_price" id="offer_price"
								 value="100" placeholder="">
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Precio Unitario ($)</strong></label>
								<input class="form-control form-control-sm" type="number" autocomplete="off" name="price_in_dolar" id="price_in_dolar" placeholder="">
							</div>
						</div>

						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Cantidad</strong></label>
								<input type="number" autocomplete="off" class="form-control form-control-sm" name="quantity" id="quantity">
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Peso del juego (Gb)</strong></label>
								<input type="number" autocomplete="off" class="form-control form-control-sm" name="peso" id="peso" min="0" value="0">
							</div>
						</div>
					</div>
					<hr>
					<div class="row" id="tohide">
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Correo</strong></label>
								<input class="form-control form-control-sm" type="text" name="email" id="email" placeholder="" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Password</strong></label>
								<input type="text" class="form-control" id="password" name="password" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Nickname</strong></label>
								<input type="text" class="form-control" id="nickname" name="nickname" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Boton reseteo</strong></label>
								<input type="date" class="form-control" name="reset_button" id="reset_button" autocomplete="off">
							</div>
						</div>


					</div>
					<div class="row">
						<div class="col-12 col-lg">
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Nota del Articulo</strong></label>
									<textarea type="text" class="form-control" name="note" id="note"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for="image">
							<strong>
								<label for="image">Imagen del Articulo</label>
							</strong>
							</label>
							<div class="custom-file">
								<input name="image" id="inputFile2" type="file" class="custom-file-input" lang="es">
								<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>

								<input hidden="" name="image" id="inputFiletext" type="text" class="custom-file-input" lang="es">
							</div>
							<br>
							<br>
							<img id="img2" width="175"><br/>
						</div>
					</div>
					<hr>
					<br>
					<!-- <div class="form-group">
					<label for="">Password</label>
					<input type="text" class="form-control" name="tal">
				</div> -->
					<div style="text-align: center;">
						<button class="btn btn-primary" type="submit" id="registrar_articulo">Registrar articulo</button>
					</div>
			</div>
			</center>
			{{-- fin tile --}}
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
	$('#category').change(function(){
		if($.inArray($('#category option:selected').val(),['3','4','6','7','10','11','13','14','15']) === -1 ){
			$('#tohide').show();
		}
		else{
			$('#tohide').hide();
		}
	});

</script>
@endsection