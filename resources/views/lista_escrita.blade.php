@extends('layouts.plantillaWeb')
@extends('layouts.ultimos-v')

@section('content')
<br>
<br>

<div class="container">
	<div class="fondotituloEscrito2" >
		<h2 class="titulobumsEscrito2">Lista escrita</h2>
	</div>
	<div class="tile fondoBlanco" >
		<div class="row">	
			<div id="accordion" class="col-lg-3 col-12">
				<div class="card sticky menu_rev" style="top:150px;">
					<div class="card-header revendedor-header">
						<div style="padding:;">
							<center>
								<h3>
									<i class="fa fa-gear"></i> Herramientas para revendedores 
								</h3>
								<p>Aumenta el precio de la lista escrita a tu conveniencia.</p>
							</center>
						</div>
						<hr style="border: solid 1px gray; opacity: 0.7;">
						<form class="form" action="lista_escrita" method="post">
							<div class="form-group">
								<label for="pf">
									<strong>Precio unitario a aumentar (<span id="sign">{{$moneda_actual->sign}}</span>)</strong>
								</label>
								<input id="pf" class="form-control" type="number" name="precio_fijo" value="{{$precio_cliente}}">
							</div>

							<div class="form-group">
								<strong><label for="pp">Porcentaje de precio a aumentar (%)</label></strong>
								<input id="pp" class="form-control" type="number" name="precio_porcentaje" value="{{($precio_porcentaje*100)-100}}">
							</div>
							<center>
								
								<button id="herramientbtn" class="btn btn-primary" type="submit"><i class="fas fa-wrench"></i> Usar herramienta</button>
							</center>
							<br>
							<br>
							<br>
						</form> 

					</div>						
				</div>			
				<br>
				<br>		
				<h5 style="text-align:center;text-transform:uppercase;font-size:17px" id="precioherramienta"></h5>
				<br>
				<h5 style="text-align:center;text-transform:uppercase;font-size:17px" id="porcentajeherramienta"></h5>
				<br>
				<h5 style="text-align:center;text-transform:uppercase;font-size:17px" id="infoherramienta"></h5>

			</div>
			<div class="col-lg-6 col-12 tile_3">
				<h5>Ordenar por:</h5>

				<form class="form-inline" action="lista_escrita" method="post">
					
					
					<select class="form-control" onchange="this.form.submit()" name="filtro" style="font-size: 14px;">
						<option class="form-control" value="">Sin filtro de busqueda</option>
						<option value="1">Menor a mayor</option>
						<option value="2">Mayor a menor</option>
						<option value="4">Orden alfabetico ascendente</option>
						<option value="3">Orden alfabetico descendente</option>
					</select>
				</form> 	
				<br>

				<?php $i = 1; ?>
				<?php $categoria = ''; ?>
				<div class="row">
					<div class="col">
						@foreach($articulos as $articulo)
						@if($articulo->pertenece_category->category != $categoria)
						@if($i != 1)
					</div>
					@endif
					<?php $categoria = $articulo->pertenece_category->category; ?>
					<?php $i = 1; ?>
					<br>
					<br>
					<button type="button" onclick='CopyToClipboard("div_{{$articulo->pertenece_category->id}}","{{ $articulo->pertenece_category->category }}")' class="btn btnbums sticky copy" style="top:180px">Copiar</button>
					
					<div id="div_{{$articulo->pertenece_category->id}}">
						<h4><strong>{{ $categoria }}</strong></h4>
						<br>
						<br>
						@endif
						
						
						@if($articulo->category == 4 || $articulo->category == 6 || $articulo->category == 11 || $articulo->category == 14 || $articulo->category == 15 || $articulo->category == 16 )
						<strong><?php echo $i++; ?></strong>. {{$articulo->name }} - {{ $articulo->estado}}.
						
						@else
						<strong><?php echo $i++; ?></strong>. {{$articulo->name }}.
						@endif
						@if($articulo->oferta==1)
						{{ $articulo->price_offer }}
						<del>{{ number_format((($articulo->offer_price* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</del>
						<strong class="precio_oferta"> {{ number_format((($articulo->price_in_dolar* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</strong>
						@else    
						<strong> {{ number_format((($articulo->price_in_dolar* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</strong>
						@endif			    
						<br><br>	
						@endforeach
					</div>
				</div>
			</div>
			<br>
			<br>
			<h3>
				Articulos disponibles: {{ $articulos->count() }}
			</h3>
			
		</div>
		<div class="col-lg-3 col-12">
			<div class="container sticky2 masAncho">
				<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php $i = 0; ?>
						@foreach($portal3 as $imagen)
						@if($i == 0)
						<div class="carousel-item active">
							<img class="d-block w-100" height="auto" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
						</div>
						@else
						<div class="carousel-item">
							<img class="d-block w-100" height="auto" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
						</div>
						@endif
						<?php $i++; ?>
						@endforeach
					</div>
				</div>

			</div>
			<amp-auto-ads type="adsense"
			data-ad-client="ca-pub-2298464716816209">
		</amp-auto-ads>
	</div>
</div>
<br>
<br>
<br>
<br>
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	function CopyToClipboard(containerid, b) {
		if (document.selection) { 
			var range = document.body.createTextRange();
			range.moveToElementText(document.getElementById(containerid));
			range.select().createTextRange();
			document.execCommand("copy"); 

		} else if (window.getSelection) {
			var range = document.createRange();
			range.selectNode(document.getElementById(containerid));
			window.getSelection().removeAllRanges()
			window.getSelection().addRange(range);
			document.execCommand("copy");
			window.getSelection().removeAllRanges();
			alert("Usted ha copiado la categoria: "+b+".");
		}
	}
</script>
@endsection

