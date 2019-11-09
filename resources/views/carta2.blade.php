<div class="hijo">
	<div class="card cartaInicio">
		<div class="position:absolute; visibility:visible; z-index:0; ">
			<img class="card-img-top" src="{{ url('img/'.$articulo->fondo) }}" alt="Card image cap" height="120px">
		</div>
		@if($articulo->oferta >= 1)
		<div class="cartaEtiqueta_oferta"> 
			<img src="http://www.diasa.com.mx/wp-content/uploads/2016/07/oferta.png" alt="" class="oferta-img" width="90">
		</div>
		@endif

		<div class="cartaFoto_pequena"> 
			<IMG class="portada_articulo" SRC="{{ url('img/'.$articulo->image) }}"> 
		</div>
		<div class="card-body letraNegra">
			<strong>{{ $articulo->name }}</strong>
			<hr class="hr_negro">
			<p  style='font-size: 13px;'>{{ $articulo->category }}</p>
		</div>
		<div class="lightgray">
			<div class="row nose">
				<div class="col">
					<button class="btn btn-primary btn-block botonCarta"
					onclick="agregaCarro('{{ $articulo->name }}', 
						'{{ $articulo->category }}', 
						{{ $articulo->price_in_dolar }},
						'{{ $articulo->image }}', {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');"><i class="fa fa-shopping-bag" aria-hidden="true" 
						></i></button>
					</div>
					<div style='font-size: 12px;' class="col-8 cartaCifra mt-1 mb-1">
						<strong>{{ number_format($articulo->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}</strong>
					</div>
				</div>
			</div>
		</div>
	</div>