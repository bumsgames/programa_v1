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
			<div class="col-12 col-xl-2 text-center">
				<br>
				<img class="vendido_img" src="img/maxresdefault.jpg" alt="">
			</div>
			<div style="border-left-style: solid; margin: 0 40px;"></div>
			<div class="col-12 col-xl-9">
				<div class="row">
					<div class="col-12">
						<h3 class="ultimo-vendido-title" style="width:100%">Ultimos articulos vendidos</h3>
					</div>
				</div>
				<div class="row">
					@foreach($ultimos_vendidos as $uv)
					<div class="col-12 col-xl-4">
						<br>
						<div class="ultimo-vendido-content">
							<div class="ultimo-vendido-c-img text-center" style="overflow:hidden;max-width:50%">
								<img src="img/{{$uv->articulo->fondo}}" height="130" style="width:auto" alt="">
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
			<div class="col-12 col-lg-3">
				<div class="container sticky responsive bg-dark" style="top:100px;border-radius:3px">	
					<br>	
					{{-- class="col-12 col-lg-6" --}}
					<h4>Articulos disponibles:  <span id="count_art">{{ $articulos->count() }}</span></h4>
					<br>
					<div class="row">
						<div class="col-12">
							Ordenar por:
							<form class="form-inline" action="{{ $buscador_ruta }}" method="get">
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
					<br>
					@if(!isset($comprofilt))
					@if(!isset($no_filter))
					<div class="row">
						<div class="col-12" style="padding-left:0;padding-right:0">
							<h5>&nbsp;&nbsp;&nbsp;Filtrar por categoria</h5>
							@foreach($categorias as $categoria)
							<label class="btn btn-dark text-left" style="margin-bottom:0;font-size:0.8rem;width:100%">
								<input type="checkbox" name="cat_filt" id="cat_{{$categoria->id}}" autocomplete="off">
								<span style="width:100%">{{$categoria->category}}</span>
							</label>
							@endforeach
						</div>
					</div>
					@endif
					@endif
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
					@include('webuser.misc.carta')
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
		filter_cat_hide();
		$('#count_art').text($('.hijo:visible').length);
	});

	$('input[name="cat_filt"]').change(function(){
		$('.hijo').hide();
		var rex = new RegExp($("#buscador_articulo").val(), 'i');
		$('.hijo').filter(function () {
			return rex.test($(this).text());
		}).show();
		filter_cat_hide();
		if(!$('input[name="cat_filt"]').is(':checked')){
			$('.hijo').filter(function () {
				return rex.test($(this).text());
			}).show();
		}
		$('#count_art').text($('.hijo:visible').length);
	});
</script>
{{-- return rex.test($(".status", this).text()); --}}

@endsection