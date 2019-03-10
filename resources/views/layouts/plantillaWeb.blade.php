<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width"/>
	<title>BumsGames.com.ve</title>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js" type="text/javascript"></script>
	<script src='{{ asset("js/jquery.zoom.js") }}'></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"/>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet"/>
	<link rel="icon" href="img/logo_circular.ico" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
	<link rel="stylesheet" type="text/css" href="{{ url('css/bums.css') }}"/>
	<link href="{{ url('css/bums_v2.css') }}"  rel="stylesheet"/>
	<script async custom-element="amp-auto-ads"
	src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>




</head>

<body style="background-color: white;">
	<div class="layer">
		{{-- 	<div class="social-bar">
			<a href="https://www.facebook.com/bumsgamesoficial/" class="icon icon-facebook" target="_blank"></a>
			<a href="https://www.instagram.com/bumsgames/" class="icon icon-instagram" target="_blank"></a>
			<a href="https://www.youtube.com/channel/UC5vd9oCSYHhoPIypaaZb6UQ?view_as=subscriber" class="icon icon-youtube" target="_blank"></a>
		</div> --}}
		<nav id="mainnavbar" style="background: white !important;" class="navbar navbar-expand-lg navbar-light bg-light menu navBums fixed-top">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" style="background: white;">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="/">
				<img alt="Brand" src="{{ url('img/lo2.png') }}" width="160">
			</a>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<br>

				<ul id="searchnav" class="navbar-nav mr-auto">
					<li>		
						<form class="form-inline" action="/buscar_articulo_bums" method="post">
							{{ csrf_field() }}
							<div id="searchnavgroup" class="input-group">
								<input autocomplete="off" type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Simplifica tu compra utilizando el buscador.">

								<div class="input-group-append">
									<button id="searchbtn" class="btn btn-danger btnbuscar"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
								</div>
							</div>
						</form>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<li class="nav-item dropdown" id="maindrop">
							{{-- dropdown-toggle --}}
							<a id="dropanchor" class="nav-link letraNegra" data-toggle="dropdown" href="#">CATEGORIAS <i id="down_icon" class="fas fa-chevron-down"></i></a>
							<div id="main-dropdown" class="dropdown-menu">
								<?php $count=0?>
								@foreach($categorias as $categoria)
								<?php if(++$count == 1) 
								echo '<div id="dropanchorps4" class="dropdown-submenu">
								<a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle">PlayStation 4 <i style="float:right" class="fa fa-caret-right"></i></a>
								<div id="dropps4" class="dropdown-menu">';

								elseif($count == 5)
									echo '<div id="dropanchorps3" class="dropdown-submenu">
								<a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle">PlayStation 3 <i style="float:right" class="fa fa-caret-right"></i></a>
								<div id="dropps3" class="dropdown-menu">';
								elseif($count == 8)
									echo '<div id="dropanchorone" class="dropdown-submenu">
								<a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle">Xbox One <i style="float:right" class="fa fa-caret-right"></i></a>
								<div id="dropone" class="dropdown-menu">';
								elseif($count == 12)
									echo '<div id="dropanchornin" class="dropdown-submenu">
								<a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle">Nintendo <i style="float:right" class="fa fa-caret-right"></i></a>
								<div  id="dropnin" class="dropdown-menu">';
								?>
								<form action="articulos" method="POST">
									{{ csrf_field() }}
									<button type="submit" name="category" value="{{$categoria->id}}" class="dropdown-item">{{$categoria->category}}</button>
									<!--<a class="" href="#">{{$categoria->category}}</a>-->
								</form>
								<?php
								if(($count == 4)||($count == 7)||($count == 11)||($count == 14)) echo '</div> </div>'
									?>
								@endforeach			
							</div>
						</li>

						<li stlye="display:none" class="nav-item dropdown" id="mainresponsivedrop">
							{{-- dropdown-toggle --}}
							<a id="dropanchor" class="nav-link letraBlanca" data-toggle="dropdown" href="#">CATEGORIAS <i id="down_icon" class="fas fa-chevron-down"></i></a>
							<div id="main-dropdown" class="dropdown-menu">
								<?php $count=0?>
								@foreach($categorias as $categoria)

								<form action="articulos" method="POST">
									{{ csrf_field() }}
									<button type="submit" name="category" value="{{$categoria->id}}" class="dropdown-item">{{$categoria->category}}</button>
									<!--<a class="" href="#">{{$categoria->category}}</a>-->
								</form>
								<?php
								if(($count == 4)||($count == 7)||($count == 11)||($count == 14)) echo '</div> </div>'
									?>
								@endforeach			
							</div>
						</li>

						{{-- <form id="category_Playstation3_form" action="categoria_general" method="post">	
							{{ csrf_field() }}
							<input name='categoria' value="PlayStation 3" hidden="">		
							<li name="category" class="nav-item">
								<a class="nav-link active" href="#" onclick="document.getElementById('category_Playstation3_form').submit();">PlayStation 3</a>
							</li>
						</form> --}}
						{{-- <form id="category_Playstation4_form" action="categoria_general" method="post">	
							{{ csrf_field() }}
							<input name='categoria' value="PlayStation 4" hidden="">		
							<li name="category" class="nav-item">
								<a class="nav-link active" href="#" onclick="document.getElementById('category_Playstation4_form').submit();">PlayStation 4</a>
							</li>
						</form> --}}

					</li>
					<li class="nav-item active">
						<strong><a class="nav-link" id="login_us" href="/ayuda"><i class="fa fa-users" aria-hidden="true" title="texto al pasar el raton"></i> AYUDA</a></strong>
					</li>
					<li class="nav-item active">	
						<strong><a class="nav-link " href="/login" id="login_us"><i class="fa fa-user-circle-o" aria-hidden="true"></i> REGISTRARSE</a></strong>
					</li>
					@if (Auth::guard('client')->guest())
					<li class="nav-item active">	
						<strong><a class="nav-link " href="/login" id="login_us"><i class="fa fa-user-circle-o" aria-hidden="true"></i> INICIAR SESION</a></strong>
					</li>
					@endif
					@if (Auth::guard('client')->check())
					<li class="nav-item active dropicon casolog">
						<strong><a class="nav-link " href="/adminpaneluser" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> MI CUENTA</a></strong>	
						<div class="dropdown-content">
							<a href="/adminpaneluser">Panel Personal</a>
							<a href="/logout_user">Cerrar Sesion</a>

						</div>
					</li>
					<li style="display:none" class="nav-item active casolog">
						<strong><a class="nav-link " href="/adminpaneluser" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> PANEL PERSONAL</a></strong>	
					</li>
					<li style="display:none" class="nav-item active casolog">
						<strong><a class="nav-link " href="/logout_user" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> CERRAR SESION</a></strong>	
					</li>
					@endif		

					{{-- <li>
						<button class="btn botonCarrito"
						data-toggle="modal" 
						data-target="#exampleModalLong"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-light rojoBlanco" id="badge">{{ count(Session::get('carrito')) }}</span></button>
					</li> --}}
					{{-- @if(Session::get('carrito'))
					<li>
						<button class="btn botonCarrito"
						data-toggle="modal" 
						data-target="#exampleModalLong"><i class="fa fa-shopping-cart f	a-lg" aria-hidden="true"></i> <span class="badge badge-light rojoBlanco" id="badge">{{ count(Session::get('carrito')) }}</span></button>
					</li>
					@endif --}}
					<li class="nav-item active">	
						<label class="menu car" for="check"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-light rojoBlanco" id="badge">{{ count(Session::get('carrito')) }}</span>	</label>
					</li>
				</ul>

			</div>
		</nav>

		<nav class="navbar navbar-expand-lg navbar-light bg-light menu navBums fixed-top" hidden="">

			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<a class="navbar-brand" href="/">

					<img alt="Brand" src="{{ url('img/logobums2.png') }}" width="150">

				</a>
			</div>

			<form class="form-inline" action="/buscar_articulo_bums" method="post">
				{{ csrf_field() }}
				<input class="form-control buscador_bums" name="name" type="search" placeholder="Buscar articulo" aria-label="Search" autocomplete="off">
				<button class="btn btn-outline-success my-2 my-sm-0 boton botonBuscador_bums"  type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav ml-auto">

					<li class="nav-item active">
						<strong><a class="nav-link a_Bums" href="/ayuda"><i class="fa fa-users" aria-hidden="true"></i> AYUDA</a></strong>
					</li>
					{{-- 				<li class="nav-item active">
						<strong><a class="nav-link a_Bums" href="" id="login_us"><i class="fa fa-user-circle-o" aria-hidden="true"></i> LOGIN</a></strong>
					</li> --}}
					{{-- @if(Session::get('carrito'))
					<li>
						<button class="btn botonCarrito"
						data-toggle="modal" 
						data-target="#exampleModalLong"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-light rojoBlanco" id="badge">{{ count(Session::get('carrito')) }}</span></button>
					</li>
					@endif --}}
				</ul>		
			</div>
		</nav>

		<ul class="nav justify-content-center ulBums1 navNormal	" style="background-color: black !important; padding: 5px;">

			<li class="nav-item">
				<a class="nav-link letraBlanca" href="lista_escrita">LISTA ESCRITA</a>
			</li>
			<li class="nav-item marcaOferta">
				<a class="nav-link letraBlanca" href="/articulos_oferta">OFERTAS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link letraBlanca" href="/articulos_web">TODOS LOS ARTICULOS</a>
			</li>
			<li>
				<form class="form-inline margin" action="{{ url('prueba') }}" method="post">
					{{-- onchange="cambiaBandera(this.options[this.selectedIndex].value)" --}}
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<select class="form-control selectCoin" onchange="this.form.submit()" name="id_coin" id="id_coin">
						<option class="form-control" selected="" value="{{ $moneda_actual->id }}">{{ $moneda_actual->coin }}</option>
						@foreach($coins as $coin)
						<option class="form-control" value="{{ $coin->id }}">{{ $coin->coin }}</option>
						@endforeach
					</select>
					&nbsp;
					&nbsp;&nbsp;
					<img id="my_image" src="{{  url('img/'.$moneda_actual->imagen) }}" alt="" width="60">
				</form>
			</li>
		</ul>
		<amp-auto-ads type="adsense"
		data-ad-client="ca-pub-2298464716816209">
	</amp-auto-ads>



	@include('modal.contacto')

	@include('modal.comment')

	<button type="button" class="btn btn-primary contactbutton" data-toggle="modal" data-target="#contactModal">
		Contáctanos <i class="fab fa-whatsapp"></i>
	</button>
	<button type="button" class="btn btn-primary commentbutton" data-toggle="modal" data-target="#commentModal" style="width: 250px;">
		DEJANOS TU COMENTARIO <i class="far fa-comment-dots"></i>
	</button>
	<input type="checkbox" class="checkbox" id="check">


	<div class="carrito_compra" style="overflow-y: auto;">
		<div style="margin-top: 115px;">			<h1 class="titulo-carrito"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>	CARRITO DE COMPRAS</h1>	

			<div class="container contcarrito">	
				<br>	
				<table class="table table-hover" >
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
								<button type="button" class="close" onclick="borrarElementoCarrito({{ $i - 1 }}, {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');">
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
								<strong>Total: {{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</strong>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>	
			<input type="number" id="nArt" value="{{ $i - 1}}" hidden="">
			<div class="modal-footer">
				<button type="button" id="cerrarCarro" class="btn btn-secondary"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Cerrar</button>
				<button id="comprarCarrito" class="btn btn-danger"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Comprar</button>
			</div>
		</div>
	</div>

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

<!-- INICIO FOOTER -->
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
			<div class="col escondite" style="background-color: black;">
				<center style="padding: 10px;"><h5>DIRECCION</h5></center>
				<hr>	
				<center>
					<img src="img/pelota.png" width="150" alt="Avatar">
					<br>
					<br>	
					PUERTO ORDAZ, Estado Bolivar <br>	
					C.C. Alta Vista II, segundo Piso <br>
					Local #22 frente a la Sala de Juegos <br>	
					<br>	

					<!-- <a class="fb-ic" href="https://www.instagram.com/bumsgames/" target="_blank">
						<i class="fa fa-facebook fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<a class="gplus-ic" href="https://www.instagram.com/bumsgames/" target="_blank"> 
						<i class="fa fa-google-plus fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!--Instagram-->
					<!-- <a class="ins-ic" href="https://www.instagram.com/bumsgames/" target="_blank">
						<i class="fa fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a> --> 
				</center>	
			</div>
			<div class="col escondite" style="background-color: black;">
				<h5>REDES SOCIALES</h5>
				<hr>	
				<center>
					<a class="fb-ic" href="https://www.instagram.com/bumsgames/" target="_blank">
						<i class="fa fa-facebook fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<a class="gplus-ic" href="https://www.instagram.com/bumsgames/" target="_blank"> 
						<i class="fa fa-google-plus fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!--Instagram-->
					<a class="ins-ic" href="https://www.instagram.com/bumsgames/" target="_blank">
						<i class="fa fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
				</center>	
			</div>
			<div class="col"><h5>CONTACTO</h5>
				<hr>
				<div class="row">	
					<div class="col">
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

					</div>
					<div class="col">	
					</div>
				</div>
			</div>
		</div>
		<br>	

		<div class="footer-copyright text-center py-3 foot2">Llegamos para hacer la diferencia.
			<a href="https://mdbootstrap.com/bootstrap-tutorial/"> BumsGames.com.ve</a>
		</div>
	</footer>
	<!-- FIN FOOTER -->


	{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script> --}}


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{ url('js/bums.js') }}"></script>
	<script src="{{ url('js/bums_v2.js') }}"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>



	<!-- Footer -->

</body>






</html>