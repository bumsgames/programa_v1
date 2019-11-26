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

a {
    color: black !important;
    text-decoration: none;
}

a:hover {
    color: black !important;
    text-decoration: none;
}


.espaciom_img:hover .imagen {-webkit-transform:scale(1.03);transform:scale(1.03); transition: all 0.2s ease-in-out;}

.shadow_ligero{
	-webkit-box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.3);
	-moz-box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.3);
	box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.3);
}
</style>

<div class="hijo contenedor shadow_ligero" style=" width: 500px;border-radius: 40px 40px 40px 40px; margin-right: 20px; margin-bottom: 20px;">
	
	{{-- card --}}
	<div class="cartaInicio	" style="overflow:hidden; margin-top: -30px;">	
		<div class="carta_titulo" style="font-size: 40px; color: black;">
			<br>
			<center>
				@if ( strlen($articulo->name) >= 10)
				<a href="{{url('ver_mas/'.$articulo->id)}}">
					<h3><strong>{{ strtoupper ( str_limit($articulo->name,80)	) }} 
						@if (strpos($articulo->categorias[0]->category,'Digital') !== false)

							({{ $articulo->peso }} GB)
						@endif
						</strong>
					</h3>
				</a>
				@else
				<a href="{{url('ver_mas/'.$articulo->id)}}">
					<h2><strong>
						{{ strtoupper ( str_limit($articulo->name,80)	) }} 
						@if (strpos($articulo->categorias[0]->category,'Digital') !== false)
						({{ $articulo->peso }} GB)
						@endif
					</strong>
					</h2>
				</a>
				@endif


				
				{{-- <strong>{{ $articulo->name }}</strong> --}}
			</center>
			<span hidden>({{ $articulo->quantity }})</span> 
		</div>

		<div class="carta_categoria" style="color: black !important;">
			@if (isset($articulo->categorias[0]))
				@if($articulo->categorias[0]->id >= 1 && $articulo->categorias[0]->id <= 7 )
			<div>
				<img src="{{ url('img/playstation.png') }}" alt="" style="max-height: 20px;" />
			</div>
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
			@endif

		</div>

		
			
			<p style="color: black;">{{ $articulo->categorias[0]->category }}</p>

		
		<center>
			<div class="espaciom_img">

				{{ csrf_field() }}
				<input type="" name="art_id" value="{{$articulo->id}}" hidden="">
				<button style="width:100%;border:none;background-color:unset;padding:0;cursor:zoom-in;text-align:unset" type="submit">
					<div class="content_fondo img_centro">
						<td><img class="img-top imagen newImg" src="{{ url('img/'.$articulo->file) }}" alt="Card image cap" style="border-radius: 10px 10px 10px 10px;"></td>
					</div>
				</button>

			</div>
		</center>

		@if($articulo->oferta == 1)
		<div class="cartaEtiqueta_oferta">
			<img  src="{{ url('img/oferta.png') }}" alt="" class="oferta-img">
		</div>
		@endif

		

		
		<div class="row margin_top_cardButton">
			<div class="col-5">
				{{-- <form class="" action="ver_mas" method="POST">
					{{ csrf_field() }}
					<input type="" name="art_id" value="{{$articulo->id}}" hidden="">
					<button class="btn btn-primary botonCarta" style="height: 57px;">
						Ver mas
					</button>	
				</form> --}}

				@if (strlen($articulo->price_in_dolar * $moneda_actual->valor) < 4)
				<h3 style="color: black; margin-top: -15px;">
					<div style=";">
						@if($articulo->oferta==1) 
						<del> 
							<strong class="precio_rebajado">
								{{ number_format($articulo->offer_price * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
							</strong>
						</del> 
						@else
						<del> 
							<strong class="precio_rebajado">
								
							</strong>
						</del>
						@endif
						<br>
						<strong> {{ number_format($articulo->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }} </strong>
					</div>
				</h3>
				@else
				@if (strlen($articulo->price_in_dolar * $moneda_actual->valor) < 6)
				<h4 style="color: black; margin-top: -8px;">
					<div style=";">
						@if($articulo->oferta==1) 
						<del> 
							<strong class="precio_rebajado">
								{{ number_format($articulo->offer_price * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
							</strong>
						</del> 
						@else
						<br>
						@endif
						<strong> {{ number_format($articulo->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }} </strong>
					</div>
				</h4>
				@else
				<h5 style="color: black; margin-top: -5px;">
					<div style=";">
						@if($articulo->oferta==1) 
						<del> 
							<strong class="precio_rebajado">
								{{ number_format($articulo->offer_price * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
							</strong>
						</del> 
						@else
						<br>
						@endif
						
						<strong> {{ number_format($articulo->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }} </strong>
					</div>
				</h5>
				@endif
				@endif
			</div>
			<div class="col-7">
				<button class="btn btn-primary botonCarta"
				onclick="agregaCarro('{{ $articulo->id }}', '{{ $articulo->name }}', 
					{{ $articulo->categorias[0]->id }}, 
					{{ $articulo->price_in_dolar }},
					'{{ $articulo->fondo }}', {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}','{{ $articulo->cantidad }}');">
					AGREGA AL CARRITO
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