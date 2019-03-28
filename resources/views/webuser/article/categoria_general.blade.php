@extends('layouts.plantillaWeb')

@section('content')
<br>
<br>
<style>
.btn-categorias{
	margin: 20px;
	padding: 10px !important;
}
</style>
<div class="container">
		<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">

	<div class="tile">
		<h2>{{ $title }}</h2>
		<hr>
		<div class="row">
			<div class="col-3">
				<div class="container sticky responsive">	
					<h4>Articulos disponibles: {{ $articulos->count() }}</h4>
					<br>	
					<br>	
					Ordenar por:
					<form class="form-inline" action="{{ $buscador_ruta }}" method="post">
						<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
						<select class="form-control se letraPe" onchange="this.form.submit()" name="filtro" style="font-size: 14px;">
							<option class="form-control letraPe" value="">Sin filtro de busqueda</option>
							<option value="1">Menor a mayor</option>
							<option value="2">Mayor a menor</option>
							<option value="4">Orden alfabetico ascendente</option>
							<option value="3">Orden alfabetico descendente</option>
						</select>
					</form>
				</div>
			</div>
			<div class="col">
				<br>

				<center>
					<input type="text" placeholder="Buscar" class="form-control masPe" id="buscador_articulo">
				</center>
				<br>
				<div class="padre">

					@foreach($articulos as $articulo)
					@include('carta2')
					@endforeach
				</div>


			</div>

		</div>
		<br>
		<br>
		<br>
		<br>

	</div>
</div>
<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

<script>
	$( "#buscador_articulo" ).on('keyup', function() {
		var rex = new RegExp($(this).val(), 'i');
		$('.hijo').hide();
		$('.hijo').filter(function () {
			return rex.test($(this).text());
		}).show();
	});
</script>

{{-- return rex.test($(".status", this).text()); --}}

@endsection