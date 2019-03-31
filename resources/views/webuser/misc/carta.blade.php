<div class="hijo contenedor cat_{{$articulo->category}}">
	<style>	
	.contenedor:hover .imagen {-webkit-transform:scale(1.1);transform:scale(1.1); transition: all 0.3s ease-in-out;}
	.contenedor {overflow:hidden;}
</style>


<div class="card cartaInicio" style="overflow:hidden">
	{{-- <div id="image{{$count}}" style="overflow:hidden; " >
		<div  class="card-img-top imagen" style="background-image:url({{ url('img/'.$articulo->fondo) }}); background-size:cover" alt="Card image cap">
		</div>
	</div> --}}
		{{-- <script>
				$('#image{{$count}} .card-img-top').on('mouseover', function(){
					$('#image{{$count}}').children(".card-img-top").css({'transform': 'scale('+ 2 +')'});})
					.on('mouseout', function(){
						$('#image{{$count}}').children('.card-img-top').css({'transform': 'scale(1)'})
						.on('mousemove', function(e){
							$('#image{{$count}}').children('.card-img-top')
							.css({'transform-origin': ((e.pageX - $('#image{{$count}}').offset().left) / $('#image{{$count}}').width()) * 100 + '% ' + ((e.pageY - $('#image{{$count}}').offset().top) / $('#image{{$count}}').height()) * 100 +'%'});
						});
			});

		</script> --}}
		<style>	
		.img-top{
			/*	max-width: 180px;*/
			min-height: 260px;
			max-height: 260px;
		}
	</style>
	<center>
		<form class="" action="ver_mas" method="POST">
			<button style="width:100%;border:none;background-color:unset;padding:0;cursor:pointer;text-align:unset" type="submit" name="art_id" value="{{$articulo->id}}">
				<div class="" style="background-color: white;">
					<img class="img-top" src="{{ url('img/'.$articulo->fondo) }}" alt="Card image cap">
				</div>
			</button>
		</form>
	</center>


	@if($articulo->oferta > 0)
	{{-- http://www.diasa.com.mx/wp-content/uploads/2016/07/oferta.png --}}
	<div class="cartaEtiqueta_oferta">
		<img  src="{{ url('img/oferta.png') }}" alt="" class="oferta-img">
	</div>
	@endif

	<!-- <div class="cartaFoto_pequena"> 
			<img class="portada_articulo" src="{{ url('img/'.$articulo->image) }}"> 
		</div>  -->
		<div class="card-body letraNegra">
			<form class="" action="ver_mas" method="POST">
				<button style="border:none;background-color:unset;padding:0;cursor:pointer;text-align:unset" type="submit" name="art_id" value="{{$articulo->id}}">
					<div class="titulo_carta" style="color: red !important; font-size: 14px;">
						<strong>{{ $articulo->name }}</strong>
					</div>
				</button>
				<strong><p style='font-size: 12px;'>{{ $articulo->pertenece_category->category }}</p></strong>		
	{{-- 			@if( !in_array($articulo->category, array([4,6,11,14,15])))	
				<p style='font-size:12px;'>Peso: {{$articulo->peso}}GB</p>
				@endif --}}
				@if($articulo->category == 4 || $articulo->category == 6 || $articulo->category == 11 || $articulo->category >= 14)	
				<p style='font-size:12px'>Envios al siguiente dia habil luego del pago.</p>
				@else
				<p style='font-size:12px;'>Peso: {{$articulo->peso}}GB</p>
				@endif
			
			</form>
		</div>

		<div class="lightgray" style="background: #F1948A;">
			<div class="row nose">
				<div class="col">
					<button class="btn btn-primary btn-block botonCarta"
					onclick="agregaCarro('{{ $articulo->id }}', '{{ $articulo->name }}', 
						'{{ $articulo->pertenece_category->category }}', 
						{{ $articulo->price_in_dolar }},
						'{{ $articulo->fondo }}', {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');">
						<i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> 
					</button>
				</div>
				<div style='font-size: 11px;' class="col-8 cartaCifra mt-1 mb-1">
					@if($articulo->oferta==1) 
					<del> 
						<strong class="precio_rebajado">
							{{ number_format($articulo->offer_price * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
						</strong>
					</del> 
					@endif
					&nbsp;<strong> {{ number_format($articulo->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }} </strong>
				</div>
			</div>
		</div>
	</div>
</div>