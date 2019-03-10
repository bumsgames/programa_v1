@extends('layouts.plantillaWeb')

@section('content')
<br>
<br>

<div class="container"><div class="fondotituloEscrito" >
	<h2 class="col-6 titulobumsEscrito">Lista escrita</h2>
</div>
<div class="tile fondoBlanco" >
	<div class="row">	
		<div id="accordion" class="col-lg-3 col-12">
			<div class="card">
				<div class="card-header revendedor-header">
					<h5 class="card-link ">
						<i class="fa fa-gear"></i> Herramientas para revendedores 
					</h5>

				</div>
				<div class="collapse show">
					<div class="card-body">
						<form class="form" action="lista_escrita" method="post">
							<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
							<div class="form-group">
								<label for="pf">
									Precio unitario a aumentar (<span id="sign">{{$moneda_actual->sign}}</span>)
								</label>
								<input id="pf" class="form-control" type="number" name="precio_fijo" value="{{$precio_cliente}}">
							</div>

							<div class="form-group">
								<label for="pp">Porcentaje de precio a aumentar (%)</label>
								<input id="pp" class="form-control" type="number" name="precio_porcentaje" value="{{($precio_porcentaje*100)-100}}">
							</div>
							<button id="herramientbtn" class="btn btnbums" type="submit">Ingresar</button>
						</form> 		
					</div>						
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
		<div class="col-lg-6 col-12">
			<h5>Ordenar por:</h5>

			<form class="form-inline" action="lista_escrita" method="post">
				
				
				<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
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
					<?php $categoria = $articulo->pertenece_category->category; ?>
					<?php $i = 1; ?>
					<br>
					<br>
					<h4><strong>{{ $categoria }}</strong></h4>
					<br>
					<br>
					@endif
					
					    <strong><?php echo $i++; ?></strong>. {{$articulo->name }}. 
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

<script>

	@endsection

