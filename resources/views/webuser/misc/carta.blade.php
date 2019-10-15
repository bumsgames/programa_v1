<style>	

.content_fondo {
	line-height:280px;
	margin:0px auto;
	text-align:center;
	z-index: 9999;
}

.ligthbox{
	width: 100%;
	height: 100%;
	position: fixed;
	top: 0;
	background: rgba(0,0,0,0.85) !important;
	display: flex;
	justify-content: center;
	align-items: center;
	z-index: 9999;

}

.img_light{
	width: 600px ;
}

.btn-close{
	width: 50px;
	height: 50px;
	border: 1px solid #fff;
	border-radius: 100%;
	color: #fff;
	font-size: 15px;
	font-weight: bold;
	text-align: center;
	padding-top: 12px;
	position: absolute;
	top: 10px;
	right: 10px;
	cursor: pointer;
}

</style>
<div class="hijo contenedor cat_{{$articulo->category}}">
	<style>	
	.espaciom_img:hover .imagen {-webkit-transform:scale(1.1);transform:scale(1.1); transition: all 0.3s ease-in-out;}
	.espaciom_img {overflow:hidden;}
</style>

{{-- card --}}
<div class="cartaInicio	" style="overflow:hidden">	
	<center>
		<div class="espaciom_img">
			
			{{ csrf_field() }}
			<input type="" name="art_id" value="{{$articulo->id}}" hidden="">
			<button style="width:100%;border:none;background-color:unset;padding:0;cursor:zoom-in;text-align:unset" type="submit">
				<div class="content_fondo img_centro">
					<td><img class="img-top imagen newImg" src="{{ url('img/'.$articulo->fondo) }}" alt="Card image cap" style=""></td>
				</div>
			</button>

		</div>
	</center>

	@if($articulo->oferta > 0)
	{{-- http://www.diasa.com.mx/wp-content/uploads/2016/07/oferta.png --}}
	<div class="cartaEtiqueta_oferta">
		<img  src="{{ url('img/oferta.png') }}" alt="" class="oferta-img">
	</div>
	@endif

	<div class="card-body letraNegra">
		<div class="titulo_carta">
			<br>
			<center>

				<strong>{{ str_limit($articulo->name,40	) }}</strong>
				{{-- <strong>{{ $articulo->name }}</strong> --}}
			</center>
		</div>

		<br>

		<center>
			@if($articulo->category >= 1 && $articulo->category <= 7 )
			<img class="img_category" src="{{ url('img/playstation.png') }}" alt="" style="max-height: 20px;">
			@else
			@if($articulo->category >= 8 && $articulo->category <= 11 )
			<img class="img_category" src="{{ url('img/icono_xbox.png') }}" alt="" style="max-height: 20px;">

			@else
			@if($articulo->category >= 12 && $articulo->category <= 14 )
				<img class="img_category" src="{{ url('img/nintendo.png') }}" alt="" style="max-height: 20px;">
			@else
			@if($articulo->category >= 15 && $articulo->category <= 15 )
				<img class="img_category" src="{{ url('img/celular (2).png') }}" alt="" style="max-height: 20px;">
			@else
			@if($articulo->category >= 16 && $articulo->category <= 16)
				<img class="img_category" src="{{ url('img/otro (2).png') }}" alt="" style="max-height: 20px;">
			@endif
			@endif
			@endif
			@endif
			@endif




			@if($articulo->category == 4 || $articulo->category == 6 || $articulo->category == 11 || $articulo->category == 14 || $articulo->category == 15 || $articulo->category == 16 )
			<div style="font-size: 11px !important;"><b>Condicion: </b>{{ $articulo->estado }}</div>

			@else
			<div style="font-size: 11px !important;"><b>Condicion: </b>Digital</div>
			@endif
			<strong><p style='font-size: 13px;'>{{ $articulo->pertenece_category->category }}</p></strong>	
				{{-- @if($articulo->category == 4 || $articulo->category == 6 || $articulo->category == 11 || $articulo->category >= 14)	
				<p style='font-size:12px'>Envios al siguiente dia habil luego del pago.</p>
				@else
				<p style='font-size:12px;'>Peso: {{$articulo->peso}}GB</p>
				@endif --}}

			</center>	

			<center>
				<h5>
					@if($articulo->oferta==1) 
					<p style="display: none;">articulo_enoferta12</p>
					<del> 
						<strong class="precio_rebajado">
							{{ number_format($articulo->offer_price * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
						</strong>
					</del> 
					@endif
					<strong> {{ number_format($articulo->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }} </strong>
				</h5>
			</center>
		</div>

		
		<div class="row margin_top_cardButton">
			<div class="col-6">
				<form class="" action="ver_mas" method="POST">
					{{ csrf_field() }}
					<input type="" name="art_id" value="{{$articulo->id}}" hidden="">
					<button class="btn btn-primary botonCarta" style="height: 57px;">
						Ver mas
					</button>	
				</form>
			</div>
			<div class="col-6">
				<button class="btn btn-primary botonCarta"
				onclick="agregaCarro('{{ $articulo->id }}', '{{ $articulo->name }}', 
					'{{ $articulo->pertenece_category->category }}', 
					{{ $articulo->price_in_dolar }},
					'{{ $articulo->fondo }}', {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');">
					<img width="50" src="{{ url('img/carrito crash.png') }}">
				</button>
			</div>	
		</div>
	</div>
</div>
<script>
	$(".newImg").click(function(e){
		var enlaceImg = e.target.src;
		console.log(enlaceImg);
		var ligthbox = '<div class="ligthbox">'+
		'<img class="img_light" src="'+enlaceImg+'" alt="">' +
		'<div class="btn-close">X</div>' + 
		'</div>';

		$("body").append(ligthbox)
		$(".btn-close").click(function(){
			$(".ligthbox").remove();
		})


	})
</script>