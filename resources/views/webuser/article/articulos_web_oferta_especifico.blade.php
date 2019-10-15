@extends('layouts.plantillaWeb')

@extends('layouts.ultimos-v')

@section('content')
<br>
<div class="container">
	<div class="fondotituloArticulos">
		<h2  class="titulobumsArticulos">{{ $title }}</h2>
	</div>
	<div id="mostrararticulos" class="tile">
		
		<div class="row">
			<div class="col-12 col-lg-3">
				<div class="container sticky responsive filtros" style="top:100px;border-radius:3px">	
					<br>	
					{{-- class="col-12 col-lg-6" --}}
					<div class="text2">
						<h4>Articulos disponibles:  <span id="count_art">{{ $articulos->count() }}</span></h4>
					</div>
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
							<h5 style="margin-left: 5px;"><i class="fas fa-bars"></i> Filtrar por categoria</h5>
							@foreach($categorias as $categoria)
							<label class="btn text-left" style="margin-bottom:0;font-size:0.8rem;width:100%">
								<input type="checkbox" name="cat_filt" id="cat_{{$categoria->id}}" autocomplete="off">
								<span style="width:100%">{{$categoria->category}}</span>
							</label>
							@endforeach
						</div>
					</div>
					@endif
					@endif
				</div>
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-2298464716816209"
     data-ad-slot="1878057917"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
			<div class="col" style="background-color: white;">

				{{-- PUBLICIDAD GOOGLE --}}
				<br>
				<center>

					<input type="text" placeholder="Buscar palabra especifica en los resultados" class="form-control " id="buscador_articulo" style="border: solid 3px gray;">
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