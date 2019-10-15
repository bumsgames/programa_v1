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
						<h4>Articulos disponibles:  <span id="count_art">{{ $articulos->total() }}</span></h4>
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
					<button type="button" onclick='CopyToClipboard("copia_resultado","1")' class="btn btn-block btnbums copy" style="background-color: rgb(180,180,180);">Copiar resultado</button>
					<br>
					<br>
					<br>
					<style type="text/css">
				</style>
				<div >
					<?php $i = 1; ?>

					<span id="copia_resultado" style="display:none">
						@foreach($articulos as $articulo)
						<strong><?php echo $i++; ?></strong>. {{$articulo->name }} - {{ $articulo->pertenece_category->category }} - <strong> {{ number_format($articulo->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }} </strong>
						<br>
						<br>
						@endforeach
					</span>
				</div>

				@if(!isset($comprofilt))
				@if(!isset($no_filter))
				<div class="row" style="overflow-y: auto;">
					<div class="col-12" style="padding-left:0;padding-right:0; overflow-y: auto;">
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
				<div class="row">
					<div class="col-12" style="padding-left:0;padding-right:0; margin-top: 20px;">
						<h5 style="margin-left: 5px;"><i class="fas fa-bars"></i> Filtrar por oferta</h5>
						<label class="btn text-left" style="margin-bottom:0;font-size:0.8rem;width:100%">
							<input type="checkbox" name="oferta_filt" autocomplete="off" value="articulo_enoferta12">
							<span style="width:100%">ARTICULOS EN OFERTA</span>
						</label>
					</div>
				</div>
				<br>
				<br>	
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
			
		</div>

		<div class="col" style="background-color: white; margin-top: 5px;">
<center>	
		@if ($articulos->hasPages())
		<ul class="pagination justify-content-center">
			{{-- Previous Page Link --}}
			@if ($articulos->onFirstPage())
			<li class="page-item disabled"><span class="page-link"><</span></li>
			@else
			<li class="page-item"><a class="page-link" href="{{ $articulos->previousPageUrl() }}" rel="prev"><</a></li>
			@endif

			@if($articulos->currentPage() > 3)
			<li class="page-item hidden-xs"><a class="page-link" href="{{ $articulos->url(1) }}">1</a></li>
			@endif
			@if($articulos->currentPage() > 4)
			<li class="page-item"><span class="page-link">...</span></li>
			@endif
			@foreach(range(1, $articulos->lastPage()) as $i)
			@if($i >= $articulos->currentPage() - 2 && $i <= $articulos->currentPage() + 2)
			@if ($i == $articulos->currentPage())
			<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
			@else
			<li class="page-item"><a class="page-link" href="{{ $articulos->url($i) }}">{{ $i }}</a></li>
			@endif
			@endif
			@endforeach
			@if($articulos->currentPage() < $articulos->lastPage() - 3)
			<li class="page-item"><span class="page-link">...</span></li>
			@endif
			@if($articulos->currentPage() < $articulos->lastPage() - 2)
			<li class="page-item hidden-xs"><a class="page-link" href="{{ $articulos->url($articulos->lastPage()) }}">{{ $articulos->lastPage() }}</a></li>
			@endif

			{{-- Next Page Link --}}
			@if ($articulos->hasMorePages())
			<li class="page-item"><a class="page-link" href="{{ $articulos->nextPageUrl() }}" rel="next">></a></li>
			@else
			<li class="page-item disabled"><span class="page-link">></span></li>
			@endif
		</ul>
		@endif
	</center>
			{{-- PUBLICIDAD GOOGLE --}}
			<br>
			<center>

				<input type="text" placeholder="Buscar palabra especifica en los resultados" class="form-control " id="buscador_articulo" style="border: solid 3px gray;">
			</center>
			<br>
			
			<center>
				<div class="padre">
					<?php $count=0?>
					@foreach($articulos as $articulo)
					<?php $count++?>
					@include('webuser.misc.carta')
					@endforeach

				</div>
			</center>
			<br>	
			<br>	
			<center>	
		@if ($articulos->hasPages())
		<ul class="pagination justify-content-center">
			{{-- Previous Page Link --}}
			@if ($articulos->onFirstPage())
			<li class="page-item disabled"><span class="page-link"><</span></li>
			@else
			<li class="page-item"><a class="page-link" href="{{ $articulos->previousPageUrl() }}" rel="prev"><</a></li>
			@endif

			@if($articulos->currentPage() > 3)
			<li class="page-item hidden-xs"><a class="page-link" href="{{ $articulos->url(1) }}">1</a></li>
			@endif
			@if($articulos->currentPage() > 4)
			<li class="page-item"><span class="page-link">...</span></li>
			@endif
			@foreach(range(1, $articulos->lastPage()) as $i)
			@if($i >= $articulos->currentPage() - 2 && $i <= $articulos->currentPage() + 2)
			@if ($i == $articulos->currentPage())
			<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
			@else
			<li class="page-item"><a class="page-link" href="{{ $articulos->url($i) }}">{{ $i }}</a></li>
			@endif
			@endif
			@endforeach
			@if($articulos->currentPage() < $articulos->lastPage() - 3)
			<li class="page-item"><span class="page-link">...</span></li>
			@endif
			@if($articulos->currentPage() < $articulos->lastPage() - 2)
			<li class="page-item hidden-xs"><a class="page-link" href="{{ $articulos->url($articulos->lastPage()) }}">{{ $articulos->lastPage() }}</a></li>
			@endif

			{{-- Next Page Link --}}
			@if ($articulos->hasMorePages())
			<li class="page-item"><a class="page-link" href="{{ $articulos->nextPageUrl() }}" rel="next">></a></li>
			@else
			<li class="page-item disabled"><span class="page-link">></span></li>
			@endif
		</ul>
		@endif
	</center>
		</div>

	</div>
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
		// $('#count_art').text($('.hijo:visible').length);
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
		// $('#count_art').text($('.hijo:visible').length);
	});

	$('input[name="oferta_filt"]').change(function(){
		$("#buscador_articulo").val('');
		$( 'input[name="cat_filt"]' ).prop( "checked", false );
		// desaparece cartas
		$('.hijo').hide();
		//toma el value
		var rex = new RegExp($('input[name="oferta_filt"]').val(), 'i');

		$('.hijo').filter(function () {
			return rex.test($(this).text());
		}).show();

		oferta_filt_hide();
		//cuando este check el oferta filt
		if(!$('input[name="oferta_filt"]').is(':checked')){
			var rex = new RegExp('', 'i');
			$('.hijo').filter(function () {
				return rex.test($(this).text());
			}).show();
		}
		//numero de resultados
		// $('#count_art').text($('.hijo:visible').length);
	});

	// function CopyToClipboard2(containerid, b) {
	// 	if (document.selection) { 
	// 		var range = document.body.createTextRange();
	// 		range.moveToElementText(document.getElementById(containerid));
	// 		range.select().createTextRange();
	// 		document.execCommand("Copy");

	// 	} else if (window.getSelection) {
	// 		var range = document.createRange();
	// 		document.getElementById(containerid).style.display = "block";
	// 		range.selectNode(document.getElementById(containerid));
	// 		window.getSelection().addRange(range);
	// 		document.execCommand("Copy");
	// 		document.getElementById(containerid).style.display = "none";
	// 		alert("Usted ha copiado el Resultado escrito, presione 'CTRL' + 'V' para pegar. ")
	// 	}
	// }

	function CopyToClipboard(containerid, b) {
		if (document.selection) { 
			var range = document.body.createTextRange();
			range.moveToElementText(document.getElementById(containerid));
			range.select().createTextRange();
			document.execCommand("copy"); 

		} else if (window.getSelection) {
			var range = document.createRange();
			document.getElementById(containerid).style.display = "block";
			range.selectNode(document.getElementById(containerid));
			window.getSelection().removeAllRanges();
			window.getSelection().addRange(range);
			document.execCommand("copy");
			window.getSelection().removeAllRanges();
			document.getElementById(containerid).style.display = "none";
			alert("Usted ha copiado el Resultado escrito, presione 'CTRL' + 'V' para pegar. ");
		}
	}

</script>


{{-- return rex.test($(".status", this).text()); --}}

@endsection