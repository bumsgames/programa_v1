@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Creando articulo</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">Creando articulo</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				{{-- comienzo dile --}}
				<center>
					<br>
					<h1>Modificando articulo: {{ $articulo->name }}</h1>
					<p>(Registrado el: {{ $articulo->created_at->format('d M Y ') }})</p>
					<br>
					<br>
					<!-- 		enctype="multipart/form-data" files="true" action="/user" method="post" -->
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<input type="text" value="{{ $articulo->id }}" id="id_articulo" hidden="">
					<br>
					<br>
					<div class="row">

						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Creado por:</strong></label>
								<input class="form-control form-control-sm" 
								type="text" 
								placeholder=""
								name="id_creator" 
								value="{{ $articulo->pertenece_id_creator->name }} {{ $articulo->pertenece_id_creator->lastname }}"
								readonly 
								id="id_creator" 
								>
							</div>
						</div>
						<div class="col-12 col-lg">
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
							<table>
								
								@foreach($articulo->duennos->sortBy('porcentaje') as $duenno)
								<tr><td><input type="text" class='form-control form-control-sm id_duenno' readonly value="{{ $duenno->id }}"></td>
									<td><input type="text" class='form-control form-control-sm' readonly value="{{ $duenno->name }} {{ $duenno->lastname }}"></td>
									<td><div class="col-auto"><div class="input-group mb-2"><div class="input-group-prepend"><div class="input-group-text">%</div></div><input type="text" class='form-control form-control-sm duenno_porcentaje' id="inlineFormInputGroup" value="{{ $duenno->pivot->porcentaje }}"></div></div></td><td><button type="button" class='btn btn-danger btn-sm borrar' id="abc" onclick="myFunction({{ $duenno->id }}, '{{ $duenno->name }} {{ $duenno->lastname }}')">Quitar</button></td></tr>
									@endforeach
								</table>
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
									<input class="form-control form-control-sm" 
									type="text"
									name="name" 
									id="name"
									value="{{ $articulo->name }}" 
									placeholder=""
									autocomplete="off"
									maxlength="80"
									onkeyup="countChar(this)">
									<small class="float-left" id="counter">0</small>
								</div>
								{!!$errors->first('name','<span class="help-block">:message</span>')!!}
								{!!$errors->first('nickname','<span class="help-block">:message</span>')!!}
							</div>
							
							<div class="col-12 col-lg">
								{{-- <div class="form-group">
									<label for=""><strong>Categoria</strong></label>
									<select 
									class="form-control form-control-sm" name="category" 
									id="category">


									<option value="{{$articulo->category}}">{{ $articulo->pertenece_category->category}}</option>

									@foreach($categories as $category)
										<option value="{{$category->id}}">{{$category->category}}</option>
									@endforeach

								</select>

								<button class="btn btn-primary mt-3" id="agregarCategoria">Agregar categoria</button>

								<div id="esribir_categoria">

								</div> --}}

								<div class="form-group">
									<label for=""><strong>Categoria</strong></label>
									<select class="form-control form-control-sm cd" name="categoria_opc" id="categoria_opc">
										@foreach($categories as $category)
											<option value="{{$category->id}}">{{$category->category}}</option>
										@endforeach
									</select>

								</select>

								<button class="btn btn-primary mt-3 mb-4" id="agregarCategoria">Agregar categoria</button>

								<div>
									@foreach ($categoriesArt as $category)
										<table>
											<tr>
												<td>
													<input type="text" class="form-control form-control-sm categoria_marca num_cat" readonly value='{{$category->id}}'>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" readonly value='{{$category->category}}'>
												</td>
												<td>
													<button type="button" class="btn btn-danger btn-sm borrar" id="quitar_categoria" 
													onclick="quitar_categoria('{{$category->id}}', '{{$category->category}}');">Quitar</button>
												</td>
											</tr>
										</table>
									@endforeach
								</div>


								<div id="esribir_categoria"></div> 
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Oferta</strong></label>
								<select 
									class="form-control form-control-sm" name="category" 
									id="oferta">
									@if($articulo->oferta == '0')
									<option value="{{$articulo->oferta}}">No</option>
									<option value="1">Si</option>
									@else
									<option value="{{$articulo->oferta}}">Si</option>
									<option value="0">No</option>
									@endif
								</select>
							</div>
						</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for="costo"><strong>Costo de Inversión ($)</strong></label>
							<input class="form-control form-control-sm" type="number" autocomplete="off" name="costo" id="costo"
							value="{{$articulo->costo}}" placeholder="" min="0">
						</div>
					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Precio de SubRayado en $</strong></label>
							<input class="form-control form-control-sm" 
							type="number"
							autocomplete="off" 
							name="offer_price"
							value="{{ $articulo->offer_price }}" 
							id="offer_price" 
							placeholder="">
						</div>
					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Precio en $</strong></label>
							<input class="form-control form-control-sm" 
							type="number"
							autocomplete="off" 
							name="price_in_dolar"
							value="{{ $articulo->price_in_dolar }}" 
							id="price_in_dolar" 
							placeholder="">
						</div>
					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Cantidad</strong></label>
							<input type="number"
							autocomplete="off"  
							class="form-control" 
							value="{{ $articulo->quantity }}" 
							name="quantity"
							id="quantity">
						</div>
					</div>
					@if(!in_array($articulo->category,array(4,6,11,14,15)))
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Peso</strong></label>
							<input type="number"
							autocomplete="off"  
							class="form-control" 
							value="{{ $articulo->peso }}" 
							name="peso"
							id="peso"
							min="0">
						</div>
					</div>
					@endif
				</div>
				<hr>
				<div class="row" id="tohide" @if(in_array($articulo->category,array(3,4,6,7,10,11,13,14,15))) style="display:none" @endif>
				<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Correo</strong></label>
							<input type="text" id="email_viejo" value="{{ $articulo->email }}" hidden="">
							<input class="form-control form-control-sm" 
							type="text" 
							name="email" 
							id="email"
							value="{{ $articulo->email }}" 
							placeholder=""
							autocomplete="off">
						</div>
					</div>
					@if(Auth::user()->level >= 7)
					<div class="col-12 col-lg">
						<input id="password_viejo" type="text" value="{{ $articulo->password }}" hidden="">
						<div class="form-group">
							<label for=""><strong>Password</strong></label>
							<input type="text" 
							class="form-control" 
							id="password" 
							name="password"
							value="{{ $articulo->password }}" 
							autocomplete="off">
						</div>
					</div>
					@else
					<div class="col-12 col-lg" hidden="">
						<input id="password_viejo" type="text" value="{{ $articulo->password }}" hidden="">
						<div class="form-group">
							<label for=""><strong>Password</strong></label>
							<input type="text" 
							class="form-control" 
							id="password" 
							name="password"
							value="{{ $articulo->password }}" 
							autocomplete="off">
						</div>
					</div>
					@endif
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Nickname</strong></label>
							<input type="text" 
							class="form-control" 
							id="nickname" 
							value="{{ $articulo->nickname }}" 
							name="nickname"
							autocomplete="off">
						</div>
					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Boton reseteo</strong></label>
							<input type="date" 
							class="form-control" 
							name="reset_button"
							value="{{ $articulo->reset_button }}" 
							id="reset_button"
							autocomplete="off">
						</div>
					</div>


				</div>
				<div class="row">
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for="estado"><strong>Condición</strong></label>
							<input class="form-control form-control-sm" type="text" value="{{$articulo->estado}}" name="estado" id="estado">
						</div>
					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for="trailer"><strong>Trailer del juego</strong></label>
							<input class="form-control form-control-sm" type="text" value="{{$articulo->trailer}}" name="trailer" id="trailer">
						</div>
					</div>
					<div class="col-12 col-lg-12">
						<div class="form-group">
							<label for="description"><strong>Descripción</strong></label>
							<textarea type="text" class="form-control" name="description" id="description">{{$articulo->description}}</textarea>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">	
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Nota del Articulo</strong></label>
							<textarea type="text" 
							class="form-control" 
							name="note"
							id="note">{{ $articulo->note }}</textarea>
						</div>
					</div>
				</div>
				<!--<div class="row">
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
							<br>
							<br>
							<img id="img1" width="175" src="img/{{ $articulo->image }}"><br/>
						</div>
					</div>
				</div>-->
				<div class="row">
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
							</div>
							<br>
							<br>
							<img id="img2" width="175" src="img/{{ $articulo->fondo }}"><br/>
						</div>
					</div>
				</div>


				<hr>



				<br>
			<!-- <div class="form-group">
				<label for="">Password</label>
				<input type="text" class="form-control" name="tal">
			</div> -->
			<button class="btn btn-primary" type="submit" id="modificar_articulo">Modificar articulo</button>
			
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
				if(!$('#tohide').is(':visible')){
					$('#email').val('');
					$('password').val('');
				}
				$('#tohide').show();
			}
			else{
				$('#tohide').hide();
				$('#email').val('');
				$('password').val('');
			}
		});
	</script>
   <script>
	    $(document).ready(function(){
        	$('#counter').text($('#name').val().length);
    	});
	function countChar(val) {
	  var len = val.value.length;
	  if (len >= 81) {
		val.value = val.value.substring(0, 80);
	  } else {
		$('#counter').text(len);
	  }
	};
  </script>



@endsection