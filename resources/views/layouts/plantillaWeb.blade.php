<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BumsGames.com.ve</title>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet"/>
	<link rel="icon" href="img/logo_circular.ico" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
	<link rel="stylesheet" type="text/css" href="{{ url('css/bums.css') }}"/>
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link href="{{ url('css/bums_v2.css') }}"  rel="stylesheet"/>
	<script async custom-element="amp-auto-ads"
	src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>


</head>



<body style="background-color: white;">
	<div class="bg-image">
	</div>
	<style>
	.fondo_blanco{
		background-color: white !important;
		
	}
	.marquee_articulos2 {
		width: 100%;
		background-color: rgba(0,0,0,0.85);;
		color: white;
		padding: 5px;
		
	}

	.marquee_articulos2:hover{
		cursor: pointer;
	}

	
</style>



<div style="background-color: rgba(0,0,0,0.85); padding: 1px;">	
@if(isset($comentarios))
<marquee style="color: white; padding: 2px;">
	@foreach($comentarios as $comentario)
	<b>{{$comentario->nombre}}: </b> {{$comentario->texto}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="span_space"></span> 
	@endforeach
</marquee>
@endif

</div>
	{{-- <div class="marquee_articulos2">
		@foreach($comentarios as $comentario)

		<b>{{$comentario->nombre}}: </b> {{$comentario->texto}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="span_space"></span> 
		@endforeach
	</div> --}}
	<script>
		$('.marquee_articulos2').marquee({
//speed in milliseconds of the marquee
duration: 450000,
    //gap in pixels between the tickers
    //gap: 50,
    //time in milliseconds before the marquee will start animating
    delayBeforeStart: 0,
    //'left' or 'right'
    direction: 'left',
    //true or false - should the marquee be duplicated to show an effect of continues flow
    duplicated: true ,
    pauseOnHover: true
});
</script>

<nav class="navbar sticky-top navbar-expand-md navbar-light bg-light s1" style="z-index: 100">


	<h3 class="my-auto" style="margin-left: 20px;"><a class="navbar-brand" href="/" >
		<img alt="Brand" src="{{ url('img/logo.png') }}" width="120">
	</a></h3>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse w-100 flex-md-column" id="navbarCollapse">

		<ul class="navbar-nav small mb-2 mb-md-0 ml-auto" style="font-size: 15px !important;">
			<form class="form-inline" action="/buscar_articulo_bums" method="get" style="padding: 20px;">
				<div id="searchnavgroup" class="input-group">
					<input autocomplete="off" type="text" class="form-control input-buscar" id="exampleInputEmail1" name="name" placeholder="Simplifica tu compra utilizando el buscador." style="border: solid 1px; opacity: 0.7;">

					<div class="input-group-append">
						<button id="searchbtn" class="btn btnbuscar"><i class="fa fa-search" aria-hidden="true"></i></button>
					</div>
				</div>
			</form>

			<li class="nav-item ">
				<form class="form-inline margin" action="{{  url('prueba') }}" method="get">
					<select class="form-control selectCoin" onchange="this.form.submit()" name="id_coin" id="id_coin" style="border: solid; border-color: #808080;">
						<option class="form-control" selected="" value="{{ $moneda_actual->id }}">{{ $moneda_actual->coin }}</option>
						@foreach($coins as $coin)
						<option class="form-control" value="{{ $coin->id }}">{{ $coin->coin }}</option>
						@endforeach
					</select>
					&nbsp;

					<img id="my_image" src="{{  url('img/'.$moneda_actual->imagen) }}" alt="" width="40">
				</form>
			</li>
			@if (Auth::guard('client')->guest())
			<li class="nav-item">
				<a class="nav-link link_bums" href="{{ url('login') }}"><i class="fas fa-user"></i> Login <span class="sr-only">(current)</span></a>
			</li>
			@endif
			@if (Auth::guard('client')->check())
			<li class="nav-item menunav active dropicon casolog">
				<a class="nav-link " href="/adminpaneluser" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> MI CUENTA</a>
				<div class="dropdown-content">
					<a href="/adminpaneluser" class="opc_log">Panel Personal</a>
					<a href="/logout_user" class="opc_log">Cerrar Sesion</a>
				</div>
			</li>
			<li style="display:none" class="nav-item menunav active casolog">
				<a class="nav-link " href="/adminpaneluser" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> PANEL PERSONAL</a>
			</li>
			<br>
			<li style="display:none" class="nav-item menunav active casolog">
				<a class="nav-link " href="/logout_user" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> CERRAR SESION</a>
			</li>
			@endif	


			<li class="nav-item">
				<a class="nav-link link_bums" href="{{ url('ayuda') }}"><i class="fas fa-question"></i> Ayuda</a>
			</li>
			<li class="nav-item">
				<a class="nav-link link_bums" href="#" data-toggle="modal" data-target="#contactModal"><i class="fab fa-whatsapp"></i> Contáctanos</a>
			</li>
			<li class="nav-item" >	
				<!-- <label class="menu car" for="check">
					<i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> 
					<span class="badge badge-light" id="badge" style="color: black !important;">{{ count(Session::get('carrito')) }}</span>	
				</label> -->
			</li>
		</ul>



		<ul class="navbar-nav ml-auto small mb-2 mb-md-0" style="font-size: 16px;">
			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" id="category_btn" href="#category_btn"><b>CATEGORIAS</b></a>

			</li>
			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" href="{{  url('articulos_oferta') }}"><b>OFERTAS</b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" href="{{  url('lista_escrita') }}"><b>LISTA ESCRITA</b></a>
			</li>
		</ul>
	</div>

</nav>





<style type="text/css">
.area_foto{
	width: 250px;
	height: 150px;
}
</style>









<div class="dropdown-content2" id="dropdown-content2" style="z-index: 99; ">
	<div class="tile_3">
		<center>
			<h1 class="background_categoria">CATEGORIAS</h1>
			<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
			<div class="padre">
				<form action="articulos2" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="1">
						<div class="area_categoria">
							<div class="area_foto">
								<center>
									<img class="img_category" src="{{ url('img/playstation.png') }}" alt="" style="max-height: 200px;">
								</center>
							</div>
							<div class="categoria_padding">
								<h1>
									PlayStation
								</h1>
							</div>
						</div>

					</a>
				</form>	
				<form action="articulos2" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="2">
						<div class="area_categoria">
							<div class="area_foto">
								<center>
									<img class="img_category" src="{{ url('img/icono_xbox.png') }}" alt="" style="max-height: 200px;">
								</center>
							</div>
							<div class="categoria_padding">
								<h1>
									Xbox One
								</h1>
							</div>
						</div>

					</a>
				</form>	
				<form action="articulos2" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="3">
						<div class="area_categoria">
							<div class="area_foto">
								<center>
									<img class="img_category" src="{{ url('img/nintendo.png') }}" alt="" style="max-height: 200px;">
								</center>
							</div>
							<div class="categoria_padding">
								<h1>
									Nintendo
								</h1>
							</div>
						</div>

					</a>
				</form>	
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="15">
						<div class="area_categoria">
							<div class="area_foto">
								<center>
									<img class="img_category" src="{{ url('img/celular (2).png') }}" alt="" style="max-height: 200px;">
								</center>
							</div>
							<div class="categoria_padding">
								<h1>
									Celulares
								</h1>
							</div>
						</div>

					</a>
				</form>	
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="16">
						<div class="area_categoria">
							<div class="area_foto">
								<center>
									<img class="img_category" src="{{ url('img/otro (2).png') }}" alt="" style="max-height: 200px;">
								</center>
							</div>
							<div class="categoria_padding">
								<h1>
									Otros
								</h1>
							</div>
						</div>

					</a>
				</form>

				<a href="/articulos_web" class="submit-link" >
					<input type="text" name="category" hidden="" value="{{-- {{ $categoria->id}} --}}">
					<div class="area_categoria">
						<div class="area_foto">
							<center>
								<img class="img_category" src="{{ url('img/reciente (1).png') }}" alt="" style="max-height: 200px;">
							</center>
						</div>
						<div class="categoria_padding">
							<h1>
								Recientes
							</h1>
						</div>
					</div>

				</a>

			</div>
		</center>

	</div>
</div>

		{{-- DROPDOWN CATEGORIA DINAMICO <div class="dropdown-content2" id="dropdown-content2">
		<div class="tile_3">
			<center>
				<h1 class="background_categoria">CATEGORIAS</h1>
				<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
				<div class="padre">
					@foreach($categorias as $categoria)
					<form action="articulos" @method('POST') name="formulario_category">
						<a href="#" class="submit-link" >
							<input type="text" name="category" hidden="" value="{{ $categoria->id}}">
							<div class="area_categoria">
								<div class="area_foto">
									<center>
										<img class="img_category" src="{{ url('img/'.$categoria->image) }}" alt="">
									</center>
								</div>
								<div class="categoria_padding">
									<h6>
										{{ $categoria->category }}
									</h6>
									<hr class="hr_black">	
									<p>{{ $categoria->description }}</p>
								</div>
							</div>
						</a>
					</form>	
					@endforeach
				</div>
			</center>
		</div>
	</div> --}}
	<amp-auto-ads type="adsense"
	data-ad-client="ca-pub-2298464716816209">
</amp-auto-ads>



@include('modal.contacto')

@include('modal.comment')


<input type="checkbox" class="checkbox" id="check">


<div class="carrito_compra" style="overflow-y: auto;">
	<div style="margin-top: 115px;"> 			
		<div class="titulo-carrito">	
			<h1><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>	CARRITO DE COMPRAS</h1>	
		</div>

		<div class="container contcarrito">	
			<br>	
			<table class="table table-hover">
				<tbody id="tablaCarrito">
					<?php $i = 1; ?>
					<?php $precio = 0; ?>
					@if(Session::has('carrito'))


					@foreach( Session::get('carrito') as $x )
					<tr>
						<th>
							<?php echo $i++; ?>
						</th>
						<td>
							<input autocomplete="off" type='text' class='id_articulo' value='{{ $x['id'] }}' hidden="">
							{{ $x['articulo'] }} || {{ $x['categoria'] }}
						</td>
						<td class="columna_precio">
							{{  number_format($x['precio'] * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
							<?php $precio += $x['precio']; ?>
						</td>
						<td>
							<img src="img/{{ $x['imagen'] }}" width="40" height="45" alt="">

						</td>
						<td>
							<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito({{ $i - 1 }}, {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');">
								<span aria-hidden="true">&times;</span>
							</button>
						</td>

					</tr>

					@endforeach

					@endif
					<tr>
						<td>	
						</td>
						<td>	
						</td>

						<td>
							@if($precio != 0)
							<strong>Total:<br> {{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</strong>
							@endif

						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<br>	
		<input type="number" id="nArt" value="{{ $i - 1}}" hidden="">
		<div class="modal-footer">
			<button type="button" id="comprarCarrito" class="btn back"><img src="img/caja3.png" width="100"></button>
			<button type="button" id="cerrarCarro" class="btn back"><img src="img/back.png" width="100"></button>
		</div>
	</div>
</div>
@yield('ultimos-vendidos')
{{-- CARROUSEL CON REDES SOCIALES INICIO --}}
@yield('content')
{{-- CARROUSEL CON REDES SOCIALES FIN --}}

<div class="bumscontent">
	<div style="background:rgba(0,0,0,0.5)">
		@yield('comment')
	</div>
</div>


<script>
	function cerrarCarro(){
		$('.menu.car').trigger('click');
	};
	$("#cerrarCarro").click(cerrarCarro);
</script>

@include('modal.carrito')


<!-- FIN FOOTER -->
@include('modal.registrarse')
<br>
<br>

<footer class="page-footer font-small cyan darken-3 foot1">
	<div class="container">
		<br>
		<br>
		<div class="row">

			<div class="col-12 col-lg-2">

				<center>
					<h3 class="my-auto"><a class="navbar-brand" href="/" >
						<img alt="Brand" src="{{ url('img/logo-fuego.png') }}" width="200">
					</a></h3>
				</center>
			</div>
			<div class="col-12 col-lg-4 escondite">
				<div class="cartica">
					<center style="padding: 10px;"><h5>DIRECCION</h5></center>
					<hr>	
					<center>
						<img class="foto_tienda" src="img/tienda2.jpg" width="210" height="210" alt="Avatar">
						<br>
						<br>	
						PUERTO ORDAZ, Estado Bolivar <br>	
						C.C. Alta Vista II, segundo Piso <br>
						Local #22 frente a la Sala de Juegos <br>	
						<br>	
					</center>	
				</div>
			</div>
			<div class="col-12 col-lg-3 escondite">
				<div class="cartica">
					<center style="padding: 10px;"><h5>REDES SOCIALES</h5></center>
					<hr>	
					<center>	
						<a href="https://www.facebook.com/bumsgamesoficial" class="link_bums" target="_blank" title="Vista nuestro facebook, que esperas?"><img src="img/logo-f.png" class="abc" alt=""> @BumsGames</a>
						<br>
						<br>
						<a href="https://www.instagram.com/bumsgames/" class="link_bums" target="_blank" href="www.google.co.ve" title="Unete a nuestra comunidad en Instagram, tenemos muchas sorpresas"><img class="abc" src="img/logo-i.png" alt=""> @BumsGames</a>
						<br>
						<br>
						<a href="https://perfil.mercadolibre.com.ve/BUMSGAMES_OFICIAL" class="link_bums" target="_blank" title="Mira nuestra reputacion en MercadoLibre, somos MercadoLideres"><img class="abc2" src="img/logo-m.png" alt=""> BumsGames_OFICIAL</a>
					</center>


					<br>
				</div>
			</div>
			<div class="col-12 col-lg-3 escondite">
				<div class="cartica">
					<center style="padding: 10px;"><h5>CONTACTANOS</h5>
						<hr>	
						David Salazar.
						<br>	
						<i class="fab fa-whatsapp fa-2x"></i> 
						(+58) 0414-987-50-29

						<br>
						<br>			
						Genesis Moreno.
						<br>	
						<i class="fab fa-whatsapp fa-2x"></i> 
						(+58) 0412-796-43-49
						<br>	
						<br>	
						Daniel Duarte.
						<br>	
						<i class="fab fa-whatsapp fa-2x"></i> 
						(+58) 0412-119-23-79
						<br>	
						<br>
					</center>
				</div>
			</div>
		</div>
		<br>	
		
		<div class="footer-copyright text-center py-3 foot2">Llegamos para hacer la diferencia.
			<a href="https://mdbootstrap.com/bootstrap-tutorial/"> BumsGames.com.ve</a>
		</div>
	</footer>	

	
	{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script> --}}


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script src="{{ url('js/bums.js') }}"></script>
	<script src="{{ url('js/bums_v2.js') }}"></script>

	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>

	<script>
		var margen_carrito = $(".carrito_compra").outerWidth(true) - $(".carrito_compra").outerWidth();
		$( ".checkbox").change(function(e) {
			if($(".checkbox").is(":checked")){
				goRight();
			}
			else{
				goLeft();
			}
		});


		function goRight(){ // inner stuff slides left
			var initalLeftMargin = $( ".carrito_compra" ).css('margin-left').replace("px", "")*1;
			var newLeftMargin = (initalLeftMargin - margen_carrito); // extra 2 for border
			$( ".carrito_compra" ).animate({marginLeft: newLeftMargin}, 500);
		}
		function goLeft(){ // inner stuff slides right
			var initalLeftMargin = $( ".carrito_compra" ).css('margin-left').replace("px", "")*1;
			var newLeftMargin = (initalLeftMargin + margen_carrito); // extra 2 for border
			$( ".carrito_compra" ).animate({marginLeft: newLeftMargin}, 500);
		}

		$('form .submit-link').on({
			click: function (event) {
				event.preventDefault();
				$(this).closest('form').submit();
			}
		});


	</script>

	<!-- Footer -->

</body>






</html>