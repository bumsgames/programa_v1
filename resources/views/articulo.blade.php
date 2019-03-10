@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Registrando articulo</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">Registrando articulo</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				{{-- comienzo dile --}}
				<div class="tile-body">El orden domina el negocio</div>
				<center>
					<br>
					<h1>ARTICULO</h1>
					<!-- 		enctype="multipart/form-data" files="true" action="/user" method="post" -->
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<br>
					<br>
					<div class="row">

						<div class="col">
							<div class="form-group">
								<label for=""><strong>ID_USUARIO DEL USUARIO QUE CREA</strong></label>
								<input class="form-control form-control-sm" 
								type="text" 
								placeholder=""
								name="id_creator" 
								value="{{ isset(Auth::user()->id) ? Auth::user()->id : 'USUARIO NO LOGUEADO' }}"
								readonly 
								id="id_creator" 
								>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Dueño Primero</strong></label>
								<select class="form-control form-control-sm cd" name="primary_owner" id="primary_owner">
									@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
									@endforeach
								</select>
							</div>
							<button id="agregarDuenno">Agregar</button>
							<br><br>
							<div id="xxx">
								
							</div>
							<br>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Nombre del Articulo</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="name" 
								id="name" 
								placeholder=""
								autocomplete="off">

							</div>
							{!!$errors->first('name','<span class="help-block">:message</span>')!!}
							{!!$errors->first('nickname','<span class="help-block">:message</span>')!!}
						</div>
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Descripcion</strong></label>
								<input type="text" 
								class="form-control" 
								name="description"
								id="description"
								autocomplete="off">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Categoria</strong></label>
								<select 
								class="form-control form-control-sm" name="category" 
								id="category">
								<option value="0">Sin categoria</option>
								@foreach($categories as $category)
								<option value="{{$category->id}}">{{$category->category}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col">
							<div class="form-group">
								<label for=""><strong>Oferta</strong></label>
								<select 
								class="form-control form-control-sm" name="category" 
								id="oferta">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
						</div>
					</div>
				</div>

				<hr>
				
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Precio en $</strong></label>
							<input class="form-control form-control-sm" 
							type="number"
							autocomplete="off" 
							name="price_in_dolar"
							id="price_in_dolar" 
							placeholder="">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Cantidad</strong></label>
							<input type="number"
							autocomplete="off"  
							class="form-control" 
							name="quantity"
							id="quantity">
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Correo</strong></label>
							<input class="form-control form-control-sm" 
							type="text" 
							name="email" 
							id="email" 
							placeholder=""
							autocomplete="off">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Password</strong></label>
							<input type="text" 
							class="form-control" 
							id="password" 
							name="password"
							autocomplete="off">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Nickname</strong></label>
							<input type="text" 
							class="form-control" 
							id="nickname" 
							name="nickname"
							autocomplete="off">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Boton reseteo</strong></label>
							<input type="date" 
							class="form-control" 
							name="reset_button"
							id="reset_button"
							autocomplete="off">
						</div>
					</div>
					

				</div>
				<div class="row">	
					<div class="col">	
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Nota del Articulo</strong></label>
								<textarea type="text" 
								class="form-control" 
								name="note"
								id="note"></textarea>
							</div>
						</div>
					</div>
					<div class="col">	
						<div class="form-group">
							<label for="image">
								<strong>
									<label for="image">Imagen de Articulo</label>
								</strong>
							</label>
							<div class="custom-file">
								<input name="image" id="inputFile1" type="file" class="custom-file-input" lang="es">
								<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
							</div>
							<img id="img1" width="175"><br/>
						</div>
					</div>
					<div class="col">	
						<div class="form-group">
							<label for="image">
								<strong>
									<label for="image">Imagen de Fondo</label>
								</strong>
							</label>
							<div class="custom-file">
								<input name="image" id="inputFile2" type="file" class="custom-file-input" lang="es">
								<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
							</div>
							<br>
							<br>
							<img id="img2" width="175"><br/>
						</div>
					</div>
				</div>



				
				<hr>



				<br>
			<!-- <div class="form-group">
				<label for="">Password</label>
				<input type="text" class="form-control" name="tal">
			</div> -->
			<button class="btn btn-primary" type="submit" id="registrar_articulo">Guardar</button>
			
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

@endsection