@extends('layouts.bums', ['tutoriales' => $tutoriales]) 
@section('content')


<main class="app-content">
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<center>
					<br>
					<h1 class="fixed">REGISTRANDO ARTICULO.</h1>
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

						<div class="col-6 col-lg">
							<h3 class="fixed">DUENNO(S)</h3>
							<div class="form-group">
								{{-- <label for=""><strong>Dueño(s) del Articulo</strong></label> --}}
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
						<div class="col-6 col-lg">
							<h3 class="fixed">DATOS DE ARTICULO</h3>

							<div class="col-12 col-lg">
								<div class="form-group">
									<label for="image">
										<strong>
											<label for="image">- Imagen del Articulo (Maximo 100 KB)</label>
										</strong>
									</label>
									<div class="custom-file">
										<input name="image" id="inputFileMod" {{-- id="uploadedfile" --}} type="file" class="custom-file-input" lang="es" accept="image/*" multiple="multiple">
										<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
										<input hidden="" name="image" id="inputFiletext" type="text" class="custom-file-input" lang="es">
									</div>

									



									{{-- <div id="images">
										<img id="img2" width="175"><br/> 
									</div> --}}



									<div class="row" id="images_mod">

									</div>

									
								</div>
							</div>

							<div class="col-12 col-lg-12">
								<div class="form-group">
									<label for=""><strong>- Nombre del Articulo</strong></label>
									<input maxlength="80" class="form-control form-control-sm" type="text" name="name" id="name" placeholder="" autocomplete="off" 
									onkeyup="countChar(this)">
									<small class="float-left" id="counter">0</small>

								</div>
								{!!$errors->first('name','<span class="help-block">:message</span>')!!} 
								{!!$errors->first('nickname','<span class="help-block">:message</span>')!!}
							</div>

							{{-- <div class="col-12 col-lg-12">
								<div class="form-group">
									<label for=""><strong>- Categoria</strong></label>
									<select class="form-control form-control-sm" name="category" id="category">
										<option value="0">Sin categoria</option>
										@foreach($categories as $category)
											<option value="{{$category->id}}">{{$category->category}}</option>
										@endforeach
									</select>
								</div>
							</div> --}}
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
					{{-- <h1>Zona de prueba</h1> --}}
					
					<div class="row">

						<div class="col-6">
							<h3 class="fixed">CATEGORIA(S)</h3>
							<div class="form-group">
								<select class="form-control form-control-sm cd" name="categoria_opc" id="categoria_opc">
									@foreach($categories as $category)
									<option value="{{$category->id}}">{{$category->category}}</option>
									@endforeach
								</select>
							</div>
							<button class="btn btn-primary" id="agregarCategoria">Agregar categoria</button>

							<div id="esribir_categoria">

							</div>
						</div>

						<div class="col-6">
							<h3>Ubicación Del Articulo</h3>
							<div class="form-group">
								{{-- <label for=""><strong>- Ubicacion del Articulo</strong></label> --}}
								<select class="form-control form-control-sm" name="ubicacion" id="ubicacion">
									@foreach ($ubicaciones as $ubicacion)
									<option value="{{$ubicacion->id}}">{{$ubicacion->nombre_ubicacion}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-4 col-lg">
							<h3 class="fixed">DATOS DE VENTA</h3>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>- Cantidad</strong></label>
									<input type="number" autocomplete="off" class="form-control form-control-sm" name="quantity" id="quantity">
								</div>
							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for="costo"><strong>- Costo de Inversión ($)</strong></label>
									<input value="0" class="form-control form-control-sm numero_separador" type="text" autocomplete="off" name="costo" id="costo"
									value="100" placeholder="" min="0" required>
								</div>
							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>- Precio Venta ($)</strong></label>
									<input class="form-control form-control-sm numero_separador" type="text" autocomplete="off" name="price_in_dolar" id="price_in_dolar" placeholder="">
								</div>
							</div>
							<br>
							<br>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Activar Oferta</strong></label>
									<select class="form-control form-control-sm" name="category" id="oferta">
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
								</div>
							</div>
							<div class="col-12 col-lg" style="display:none;" id="offer_price_div">
								<div class="form-group" >
									<label for=""><strong> Precio Subrayado ($). SOLO OFERTA</strong></label>
									<input value="0" class="form-control form-control-sm numero_separador" type="text" autocomplete="off" name="offer_price" id="offer_price"
									value="100" placeholder="">
								</div>
							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Nota del Articulo</strong></label>
									<textarea type="text" class="form-control" name="note" id="note"></textarea>
								</div>
							</div>
							<br>
							<br>
							
						</div>
						<div class="col-4 col-lg">
							<div id="zona_cuenta_digital">	
								<h3 class="fixed">DATOS DE CUENTA DIGITAL</h3>
								<div class="col-12 col-lg">
									<div class="form-group">
										<label for=""><strong>- Correo</strong></label>
										<input class="form-control form-control-sm" type="text" name="email" id="email" placeholder="" autocomplete="off">
									</div>
								</div>
								<div class="col-12 col-lg">
									<div class="form-group">
										<label for=""><strong>- Password</strong></label>
										<input type="text" class="form-control form-control-sm" id="password" name="password" autocomplete="off">
									</div>
								</div>
								<div class="col-12 col-lg">
									<div class="form-group">
										<label for=""><strong>- Nickname </strong> </label>
										<input type="text" class="form-control form-control-sm" id="nickname" name="nickname" autocomplete="off">
									</div>
								</div>

								<br>
								<br>
								<div class="col-12 col-lg">
									<div class="form-group">
										<label for=""><strong>Boton reseteo</strong></label>
										<input type="date" class="form-control form-control-sm" name="reset_button" id="reset_button" autocomplete="off">
									</div>
								</div>
							</div>
							<br>	
							<h3 class="fixed">DATOS DE ARTICULO DIGITAL</h3>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>- Peso del juego (Gb)</strong></label>
									<input type="number" autocomplete="off" class="form-control form-control-sm" name="peso" id="peso" min="0" value="0">
								</div>
							</div>

							{{-- <div class="col-12 col-lg">
								<div class="form-group">
									<label for="image">
										<strong>
											<label for="image">- Imagen del Articulo (Maximo 100 KB)</label>
										</strong>
									</label>
									<div class="custom-file">
										<input name="image" id="inputFile2" type="file" class="custom-file-input" lang="es">
										<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>

										<input hidden="" name="image" id="inputFiletext" type="text" class="custom-file-input" lang="es">
									</div>
									<img id="img2" width="175"><br/>
								</div>
							</div> --}}
						</div>
						
						<div class="col-4">	
							<p class="fixed"> NO OBLIGATORIOS</p>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for="estado"><strong>Condición (Nuevo, Usado, Digital...)</strong></label>
									<input class="form-control form-control-sm" type="text" name="estado" id="estado">
								</div>
							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for="trailer"><strong>Trailer del juego</strong></label>
									<input class="form-control form-control-sm" type="text" name="trailer" id="trailer">
								</div>
							</div>
							<div class="col-12 col-lg-12">
								<div class="form-group">
									<label for="description"><strong>Descripción</strong></label>
									<textarea type="text" class="form-control" name="description" id="description"></textarea>
								</div>
							</div>
						</div>
						
					</div>

					
					
					<hr>
					<br>
					<!-- <div class="form-group">
					<label for="">Password</label>
					<input type="text" class="form-control" name="tal">
				</div> -->
				<div style="text-align: center;">
					<button class="btn btn-primary" type="submit" id="registrar_articulo" id="">Registrar articulo</button>
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
<script>
	function countChar(val) {
		var len = val.value.length;
		if (len >= 81) {
			val.value = val.value.substring(0, 80);
		} else {
			$('#counter').text(len);
		}
	};

	 var inputFileMod = document.getElementById('inputFileMod');
    if(inputFileMod){
    	
        inputFileMod.addEventListener('change', mostrarImagenMod, false);
    }

    function mostrarImagenMod(event) {

    //Obtengo el file del input
    var file = event.target.files[0];
    console.log("file", file);

    //Creo un objeto de la nueva foto que coloque e ira en memoria
    let image = {
        index:$("#images_mod")[0].childElementCount,
        name:file.name
    }

    //Guardo en memoria la foto nueva que agrego
    fotosMod.push(image);
    console.log('fotos guardada en memoria', fotosMod);
    
    //Agrego la nueva foto en el Front
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = (event) => { 
        //console.log(event);    
        prueba = event.target.result
        
        let indexImage=$("#images_mod")[0].childElementCount;
        console.log('el index de la imagen debe ser', indexImage);



        var htmlTagImage = 
        '<div class="col" id="div_'+indexImage+'">' +

'<img id="img_'+indexImage+'" class="img row text-center fotos" src="'+ event.target.result+ '" height="100" style="object-fit: cover;">'+
'<button class="btn btn-warning mt-2 deletePhoto" type="button" style="position: relative;"  Onclick="removePhotoDiv('+indexImage+');" >'+
'Eliminar'+
'</button>'+
'</div>';
$('#images_mod').append(htmlTagImage);
}
}
</script>
@endsection