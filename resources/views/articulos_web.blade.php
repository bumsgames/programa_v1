@extends('layouts.plantillaWeb')
@section('ultimos-vendidos')
<style>
	.btn-categorias{
		margin: 20px;
		padding: 10px !important;
	}
	</style>
	<style>
	.vendido_img{
		border-radius: 250px;
		width: 150px;
		height: 150px;
	}
	</style>
	<div class="container-fluid">
		<div class="row justify-content-center ultimo-vendido-banner">
			<div class="col-1">
				<br>
				<img class="vendido_img" src="img/maxresdefault.jpg" alt="">
			</div>
			<div style="border-left-style: solid; margin: 0 40px;"></div>
			<div class="col-9">
				<div class="row">
					<div class="col-12">
						<h3 class="ultimo-vendido-title">Ultimos articulos vendidos</h3>
					</div>
				</div>
				<div class="row">
					@foreach($ultimos_vendidos as $uv)
					<div class="col-4">
						<div class="ultimo-vendido-content">
							<div class="ultimo-vendido-c-img">
								<img src="img/{{$uv->articulo->fondo}}" height="130" alt="">
							</div>
							<div class="ultimo-vendido-c-text">
								{{$uv->articulo->name}}
								<br>
								<strong>{{$uv->articulo->pertenece_category->category}}</strong>
								<br>
							</div>
						</div>
					</div>
					@endforeach
					
				</div>
				
			</div>
		</div>
	</div>
@endsection
@section('content')


<br>




<div class="container">
	<div class="fondotituloArticulos">
		<h2  class="titulobumsArticulos">{{ $title }}</h2>
	</div>
	<div id="mostrararticulos" class="tile">
		
		<div class="row">
			<div class="col-12 col-lg-2">
				<div class="container sticky responsive">	
					<br>	
					{{-- class="col-12 col-lg-6" --}}
					<h4>Articulos disponibles:  {{ $articulos->count() }}</h4>
					<br>
					<br>
					<div class="row">
						<div class="col-12 col-lg-6">
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
				</div>
			</div>
			<div class="col">
				<br>
				<center>

					<input type="text" placeholder="Buscar" class="form-control " id="buscador_articulo">
				</center>
				<br>
				<div class="padre">
					<?php $count=0?>
					@foreach($articulos as $articulo)
					<?php $count++?>
					@include('carta')
					@endforeach

				</div>


			</div>

		</div>
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