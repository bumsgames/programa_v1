<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width"/>
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

	<div class="layer">
<ul class="nav justify-content-end" style="background-color: black !important;">

				<marquee style="padding: 2px;" bgcolor="#FFFFFF" scrolldelay="100" scrollamount="5" direction="left" loop="infinite">Estás viendo el ejemplo que hemos hecho nosotros.

</marquee>

		
			
		</ul>

		<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
   <div class="container">
        <button class="navbar-toggler navbar-toggler-right align-self-center mt-3" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
       
        
        <div class="collapse navbar-collapse flex-column ml-lg-0 ml-3 " id="navbarCollapse">
        	<ul class="navbar-nav" style="padding: 20px;">
        		<center>
        	<a class="navbar-brand" href="/" >
				<img alt="Brand" src="{{ url('img/logo.png') }}" width="90">
			</a>
        <form class="form-inline ml-auto mr-auto" action="/buscar_articulo_bums" method="get">
							<div id="searchnavgroup" class="input-group">
								<input autocomplete="off" type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Simplifica tu compra utilizando el buscador." style="border: solid 1px; opacity: 0.7;">

								<div class="input-group-append">
									<button id="searchbtn" class="btn btn-danger btnbuscar"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
							</div>
						</form>
        	
        </center>
        	</ul>
            <ul class="navbar-nav justify-content-end" style="font-size: 15px;">
            	
                <li class="nav-item">
				<form class="form-inline margin" action="{{ url('prueba') }}" method="get">
					{{-- onchange="cambiaBandera(this.options[this.selectedIndex].value)" --}}
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
			      <li class="nav-item">
			        <a class="nav-link link_bums" href="{{ url('login') }}"><i class="fas fa-user"></i> Login <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link link_bums" href="{{ url('ayuda') }}"><i class="fas fa-question"></i> Ayuda</a>
			      </li>
			      <li class="nav-item">
			      	<a class="nav-link link_bums" href="#" data-toggle="modal" data-target="#contactModal"><i class="fab fa-whatsapp"></i> Contáctanos</a>
			      </li>
			      <li class="nav-item menunav active">	
						<label class="menu car" for="check"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-light" id="badge" style="color: black !important;">{{ count(Session::get('carrito')) }}</span>	</label>
					</li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
				<a class="nav-link dropbtn linkBums2" id="category_btn"><b>CATEGORIAS</b></a>
			</li>

			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" href="/lista_escrita"><b>LISTA ESCRITA</b></a>
			</li>
            </ul>
           
        </div>
    </div>
</nav>


		
	<style type="text/css">
		.area_foto{
			width: 250px;
			height: 150px;
		}
	</style>
	

		

		
		

		

		<div class="dropdown-content2" id="dropdown-content2">
		<div class="tile_3">
			<center>
				<h1 class="background_categoria">CATEGORIAS</h1>
				<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
				<div class="padre">
					<form action="articulos" @method('POST') name="formulario_category">
						<a href="#" class="submit-link" >
							<input type="text" name="category" hidden="" value="{{-- {{ $categoria->id}} --}}">
							<div class="area_categoria">
								<div class="area_foto">
									<center>
										<img class="img_category" src="{{ url('img/logo ps2.png') }}" width="220" alt="">
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
							<td>
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
</div>


	<!-- FIN FOOTER -->
	@include('modal.registrarse')

	<footer class="page-footer font-small cyan darken-3 foot1">
	<div class="container">
		<br>
		<br>
		<div class="row">

			<div class="col-2">

				<a class="navbar-brand" href="/">
					<img alt="Brand" src="{{ url('img/lo2.png') }}" width="160">
				</a>
			</div>
			<div class="col escondite">
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
			<div class="col escondite">
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
			<div class="col escondite">
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

<ul class="nav">
		<div class="marquee">
		@foreach($comentarios as $comentario)
        
<b>{{$comentario->nombre}}: </b> {{$comentario->texto}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{-- <span class="span_space"></span> --}}
        @endforeach
    </div>

	</ul>


	function articulos(Request $request)
	{
		if (isset($request->category)) {
			$categoria = $request->category;
			$categoria_Buscada = \Bumsgames\Category::find($categoria);
			Session::put('categoria', $categoria_Buscada->category);
			Session::put('id_category', $categoria_Buscada['id']);
		}

		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
			->where('category', Session::get('id_category'))
			->where('id', '!=', '2')
			->groupBy('name', 'category')
			->busca($request->all())
			->orderBy('updated_at', 'desc')
			->get();

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		$comprofilt = 1;
		$buscador_ruta = 'articulos';

		$title = Session::get('categoria');
		\Bumsgames\Visita::create(['tipo' => 'General']);

		$ultimos_vendidos = \Bumsgames\Sales::join('articles', 'id_article', '=', 'articles.id')
			->join('categories', 'articles.category', '=', 'categories.id')
			->orderby('sales.created_at', 'desc')
			->limit(4)
			->get();

		return view('webuser.article.articulos_web', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos','comprofilt'));
	}

	<div class="container">
			<div class="row">
				<div class="col-3">
					<center>
						<i class="fas fa-question"></i>
						
						<br>
						<h2>Juegos Digitales</h2>

						<h5>Juego completo al igual que un juego en formato físico (no tiene diferencias), el juego quedara guardado en su Disco Duro.
							</h5>
							</center>
					</div>
				<div class="col-3">
					<center>
						<i class="fas fa-question"></i>
						
						<br>
						<h2>Juegos Digitales</h2>
						<h4>Tipo Cuenta</h4>

						<h6>La diferencia es que el juego digital está contenido en una cuenta desde la cual se podrá ejecutar la descarga del mismo. El juego quedará en el disco duro de la consola, estos juegos son 100% originales, a pesar de ello la consola no debe estar chipeada, para poder descargar los juegos digitales. 
							<br>
							<br>

							Ofrecemos garantía de la compra permanente (PS4, Xbox y Switch), pero para ello se debe acatar nuestras normativas obligatoriamente, en caso de faltar a nuestras políticas el comprador irrumpe en la garantía.

							<br>
							<br>

							<b>LOS JUEGOS DESCARGADOS MEDIANTE CUENTAS SON SOLO PARA UNA Y SOLO UNA CONSOLA</b></h6>
							</center>


					</div>
					<div class="col-3">
					<center>
						<i class="fas fa-question"></i>
						
						<br>
						<h2>Juego Digital Primario, Secundario y Codigo</h2>

						<center>
									<h3 class="titulo-ayuda-MINI">
										Juego Digital Primario
									</h3>
								</center>
								<br>
								<br>
								<ul>
									<li>Se comienza la descarga del juego mediante una cuenta alterna.</li>
									<li>Podrás jugar desde tu usuario personal u otro de tu preferencia.</li>
									<li>No necesitas internet para jugar una vez descargado.</li>
									<li>Los trofeos son agregados a tu perfil.</li>
									<li>Totalmente igual a un juego en formato físico.</li>
								</ul>
								<br>
								<br>
								<center>
									<h3 class="titulo-ayuda-MINI">
										Juego Digital Secundario
									</h3>
								</center>
								<br>
								<br>
								<ul>
									<li>Se comienza la descarga del juego mediante una cuenta alterna.</li>
									<li>Se juega mediante el usuario desde donde se realizó la descarga.</li>
									<li>En algunos casos en PS4 podrás jugar desde tu usuario y en Xbox One podrás jugar siempre desde cualquier usuario.</li>
									<li>Necesitas internet obligatoriamente para jugar.</li>
									<li>Totalmente igual a un juego en formato físico.</li>
								</ul>
								<br>
								<br>
								<center>
									<h3 class="titulo-ayuda-MINI">
										Juego digital por código
									</h3>
								</center>
								<br>
								<br>
								<p>
									Es un juego completo al igual que un juego en formato físico, los juegos por códigos son canjeados en la 
									cuenta del comprador, por lo cual una vez comprados los juegos quedan vinculados para siempre a dicha cuenta.
								</p>
								<br>
							</center>


					</div>
				</div>
			</div>