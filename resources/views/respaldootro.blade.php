@extends('layouts.plantillaWeb')

@section('content')

<div id="bannertop" class="carousel slide" data-ride="carousel" data-interval="5000">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="img/family.jpg" alt="First slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="img/gamepad.jpg" alt="Second slide">
		</div>
		<!-- @php $count=0; @endphp
				@foreach($portal1 as $portal)
				@php $count++;@endphp
				<div class="carousel-item <?php if($count==1) echo 'active';?>">
					<img style="width: 100%;height: 180px;" class="" src="img/{{$portal->imagen}}" alt="First slide">
				</div>
				@endforeach -->

			</div>
		</div>

		<img class="badred" src="img/badred.jpg" alt="" height="170" width="2024">


		<div class="redbannersocial">	
			<center>
				<a href="https://www.facebook.com/bumsgamesoficial" target="_blank" title="Vista nuestro facebook, que esperas?"><img src="img/logo-f.png" class="abc" alt=""></a>
				<a href="https://www.instagram.com/bumsgames/" target="_blank" style="margin-left: 140px; border: none;" href="www.google.co.ve" title="Unete a nuestra comunidad en Instagram, tenemos muchas sorpresas"><img class="abc" src="img/logo-i.png" alt=""></a>
				<a href="https://perfil.mercadolibre.com.ve/BUMSGAMES_OFICIAL" target="_blank"  style="margin-left: 140px; border: none;" title="Mira nuestra reputacion en MercadoLibre, somos MercadoLideres"><img class="abc2" src="img/logo-m.png" alt=""></a>
			</center>
		</div>

		@endsection


		@section('comment')
		<!-- container -->
		<!-- style="background:rgba(0,0,0,0.5)" -->
		<div class="patron"> 
<!-- <div class="fondotitulo"><h2 class="titulobums">Bienvenido amig@</h2></div>
</div> -->
<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
{{-- gen-container --}}
<div class="container maincont">
	<div class="row">
		<div class="col-12 col-lg-5 ">
			<script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>
			<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="padding: 10px">
				<div class="carousel-inner">
					@php $count=0; @endphp
					@foreach($portal3 as $portal)
					@php $count++;@endphp
					<div class="carousel-item <?php if($count==1) echo 'active';?>">
						<img class="d-block w-100" src="img/{{$portal->imagen}}" alt="First slide" height="120px">
					</div>
					@endforeach

				</div>
			</div>
			<div class="colorBackground_Titulo">	

				<h2 class="colortitulo" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;"><i class="fas fa-newspaper"></i> ARTICULOS RECIENTES</h2>
			</div>
			<hr>
			<style>
			.marquee_articulos {
				width: 100%;
				overflow: hidden;
				background: rgba(40, 40, 40, 0.95) ;
			}

			.marquee {
				width: 100%;
				height: 95%;
				max-height:480px;
				min-height:480px;
				overflow: hidden;
				border: none;
				background: none;
			}
		</style>
		<div class='marquee_articulos'>
			<div class="padre">
				<?php $count=0?>
				@foreach($articulos as $articulo)
				<?php $count++?>
				@include('webuser.misc.carta')
				@endforeach
			</div>
		</div>
		<br>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Anuncio 1 -->
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-2298464716816209"
		     data-ad-slot="1602129934"
		     data-ad-format="auto"
		     data-full-width-responsive="true"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>


		<script>
			$('.marquee_articulos').marquee({
//speed in milliseconds of the marquee
duration: 20000,
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
</div>

{{-- Encuestas y Noticias --}}
	<div class="col-12 col-lg-5">
		{{-- Encuestas --}}
		@if(isset($encuesta))
		<div class="row">
			<div class="col-12">
				<div class="colorBackground_Titulo">	
					<h2 class="colortitulo" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;"><i class="fa fa-poll-h"></i> ENCUESTA</h2>
				</div>
				<section>
					<div style="width:70%" class="mx-auto">
						<div class="card encuesta-card">
							@if(isset($encuesta))
							<form action="" method="POST">
								<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
								<div class="card-header">
								<h5>{{$encuesta->nombre}}</h5>
								</div>
								<div class="card-body">
									<h5 class="card-title"><strong>{{$encuesta->nombre}}</strong></h5>
									<div id="encuesta-section">
										@include('admin.encuestas.section')
									</div>
								</div>
								<div class="card-footer text-muted">
									@if(Session::get('poll_voted') != $encuesta->id)
									<button type="button" id="votar_btn" class="btn btn-dark text-center btn-block">Votar</button>
									<button type="button" id="mostrar_btn" class="btn text-center btn-light border border-dark btn-block">Ver resultados</button>
									@else
									Gracias por votar amig@ :)
									@endif

									<button style="display:none" type="button" id="regresar_btn" class="btn text-center btn-light border border-dark btn-block">Regresar</button>
								</div>
							</form>
							@else
							<div class="card-header">
								No hay encuesta
							</div>
							<div class="card-body">
								<h4 class="card-title">No hay encuesta actualmente</h4>
							</div>
							<div class="card-footer text-muted">
							</div>
							@endif
						</div>
					</div>
				</section>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-12" style="margin-bottom:40px">
				<div class="colorBackground_Titulo">	
					<h2 class="colortitulo" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;"><i class="fas fa-exclamation-circle"></i> NOTICIAS</h2>
				</div>
				<!-- NOTICIA -->
			
				<section class="slide-wrapper slide-vertical">
					<div class="container cont-vertical">
						<div id="carouselNoticias" class="carousel slide carousel-vertical" data-ride="carousel">
							<ol class="carousel-indicators indicator-vertical">
								<?php $count=0;?>
								@foreach($noticias as $noticia)
									<li data-target="#carouselNoticias" data-slide-to="{{$count}}" @if($count==0) class="active" @endif></li>
									<?php $count=$count+1;?>
								@endforeach
							</ol>
							<div class="carousel-inner inner-vertical ">
								<a class="carousel-control-prev carousel-control-prev-vertical" href="#carouselNoticias" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								</a>
								<?php $count=0;?>
								@forelse($noticias as $noticia)
								<div class="carousel-item item-vertical @if($count == 0) active @endif">
										<?php $count=$count+1;?>
			
									<div class="noticia">
										<div class="row">
											<div class="col-4" style="padding-righ:0">
												<div class="noticia-img-container  mx-auto">
													<img src="img/{{$noticia->imagen}}" class="noticia-img" alt="">	
												</div>
											</div>
											<div class="col-8">
												<div class="noticia-content break-word">
													<strong><h4 class="noticia-letras">{{$noticia->titulo}}</h4></strong>
													<p class="noticias-letras2">{{$noticia->descripcion}}</p>
												</div>
												<div class="noticia-likes">
													<span class="likes badge badge-red">Likes: <span class="badge bg-light text-dark" id="likes_num_{{$noticia->id}}">{{$noticia->likes}}</span> <i class="fas fa-heart"></i></span>
													<a href="javascript:void(0);" onclick="aumentarMegusta({{$noticia->id}})" class="btn btn-primary buttonLike">Me gusta <i class="far fa-thumbs-up"></i></a>
												</div>
											</div>

										</div>
										
										
									</div>
								</div>

								@empty
								<div class="carousel-item item-vertical active">
									<div class="noticia">
										<div class="row">
											<div class="col-12 text-center">
												<div class="noticia-content">
													<br>
													<br>
													<br>
													<br>
													<strong><h3>No hay noticias actualmente</h3></strong>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforelse
								<a class="carousel-control-next carousel-control-next-vertical" href="#carouselNoticias" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
								</a>
							</div>
						</div>
					</div>
				</section>
			</div>
	</div>
	
	
	<script>
	$('#carouselNoticias').carousel({
				interval: false
			});	
			$("#carouselNoticias").on("touchstart", function(event){
	
				var yClick = event.originalEvent.touches[0].pageY;
				$(this).one("touchmove", function(event){
	
					var yMove = event.originalEvent.touches[0].pageY;
					if( Math.floor(yClick - yMove) > 1 ){
						$(".carousel-vertical").carousel('next');
					}
					else if( Math.floor(yClick - yMove) < -1 ){
						$(".carousel-vertical").carousel('prev');
					}
				});
				$(".carousel-vertical").on("touchend", function(){
					$(this).off("touchmove");
				});
			});
	</script>

</div>
<div class="col-12 col-lg-2" style="font-size: 14px;">
	<div class="colorBackground_Titulo">	
		<strong>
			<h5 class="colortitulo" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;"><i class="fas fa-address-card"></i> QUE OPINAN NUESTROS CLIENTES?</h5>
		</strong>


	</div>
	<hr>
	<div class='marquee' style="color: white;">
		<?php $count =0?>
		@foreach($comentarios as $comentario)
		<div class="comcontainer darker">
			<div class="row">
				<div class="col-3">
					<?php 
					if(!is_null($comentario->image)) 
						echo'<img src="img/'.$comentario->image.'" alt="Avatar">';
					else echo '<img src="img/pelota.png" alt="Avatar">';
					?>
				</div>
				<div class="col">
					<h5>{{$comentario->nombre}}</h5>
					<p>{{$comentario->texto}}</p>
				</div>
			</div>
		</div>

		@endforeach
	</div>

	<script>
		$('.marquee').marquee({
//speed in milliseconds of the marquee
duration: 10000,
    //gap in pixels between the tickers
    //gap: 50,
    //time in milliseconds before the marquee will start animating
    delayBeforeStart: 0,
    //'left' or 'right'
    direction: 'down',
    //true or false - should the marquee be duplicated to show an effect of continues flow
    duplicated: true ,
    pauseOnHover: true
});
</script>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="padding: 10px">
	<div class="carousel-inner">

		@php $count=0; @endphp
		@foreach($portal2 as $portal)
		@php $count++;@endphp
		<div class="carousel-item <?php if($count==1) echo 'active';?>">
			<img class="d-block w-100" src="img/{{$portal->imagen}}" alt="First slide" height="120px">
		</div>
		@endforeach

	</div>
</div>
<div class="container top">	
	<br>
	<strong>	Articulos mas vendidos del dia
	</strong>
	<hr style="background-color: white !important; border: 1px solid;">
	<?php $i=1; ?>
	@foreach($articulo_mas_vendido_semana as $articulo)	
	<strong><?php echo $i++; ?> </strong>. {{ $articulo->name }} | {{ $articulo->category }}
	<br>
	<br>
	@endforeach
	<br>		
</div>
</div>
</div>
<br>	
</div>
</div>
{{-- <input type="checkbox" class="checkbox" id="check"> --}}

<script>

$("#votar_btn").click(function(){
    var CSRF_TOKEN = $('#token').val();
    $.ajax({
        url: '/encuestas/votar/'+$('input[name="respuesta"]:checked').val(),
        type: 'POST',
        data: {
            _token: CSRF_TOKEN, 
            id:$('input[name="respuesta"]:checked').val(),
        },
        dataType: 'JSON',
        success: function (data) { 
            if(data.success){
				$('#encuesta-section').fadeOut();
				$('#encuesta-section').load('/encuestas/user/show', function() {
					$('#encuesta-section').fadeIn();
					$('.encuesta-option').hide();
				$('.encuesta-resultado').show();
				});
				$("#votar_btn").attr("disabled", true);;	
				$('#regresar_btn').show();
				$('#votar_btn').hide();
				$('#mostrar_btn').hide();
            }

            $("#message").text(data.msg); 

        },
        error: function (data){
            $("#message").text(data.msg); 
        }
        
    }); 
});
$("#mostrar_btn").click(function(){
	$('.encuesta-option').hide();
	$('.encuesta-resultado').show();
	$('#regresar_btn').show();
	$('#votar_btn').hide();
	$('#mostrar_btn').hide();
});
$("#regresar_btn").click(function(){
	$('.encuesta-option').show();
	$('.encuesta-resultado').hide();
	$('#regresar_btn').hide();
	$('#votar_btn').show();
	$('#mostrar_btn').show();
});
</script>


@endsection



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width"/>
	<title>BumsGames.com.ve</title>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js" type="text/javascript"></script>
	<script src='{{ asset("js/jquery.zoom.js") }}'></script>
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
		{{-- 	<div class="social-bar">
			<a href="https://www.facebook.com/bumsgamesoficial/" class="icon icon-facebook" target="_blank"></a>
			<a href="https://www.instagram.com/bumsgames/" class="icon icon-instagram" target="_blank"></a>
			<a href="https://www.youtube.com/channel/UC5vd9oCSYHhoPIypaaZb6UQ?view_as=subscriber" class="icon icon-youtube" target="_blank"></a>
		</div> --}}
		<nav id="mainnavbar" style="background: white !important;" class="navbar navbar-expand-xl navbar-light bg-light menu navBums fixed-top">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" style="background: white;">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="/">
				<img alt="Brand" src="{{ url('img/lo2.png') }}" width="160">
			</a>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<br>
				<div class="row">
					
				</div>
				<ul id="searchnav" class="navbar-nav mr-auto">
					<li>		
						<form class="form-inline" action="/buscar_articulo_bums" method="get">
							<div id="searchnavgroup" class="input-group">
								<input autocomplete="off" type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Simplifica tu compra utilizando el buscador.">

								<div class="input-group-append">
									<button id="searchbtn" class="btn btn-danger btnbuscar"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
								</div>
							</div>
						</form>
					</li>
				</ul>

				<ul class="navbar-nav ml-auto menubuttons">
					<li class="nav-item active">
						<div class="dropdown">
							<strong><a class="nav-link dropbtn" id="category_btn" style="background-color: rgba(170, 170, 170, 1); color: white;"><i id="down_icon" class="fas fa-chevron-down"></i> CATEGORIAS</a></strong>
						</div>
					</li>

					
					<li class="nav-item menunav active">
						<a class="nav-link" id="login_us" href="/ayuda"><i class="fa fa-users" aria-hidden="true" title="texto al pasar el raton"></i> AYUDA</a>
					</li>
					@if (Auth::guard('client')->guest())
					<li class="nav-item menunav active">
						<strong>
							<button style="border:none" type="button" class="btn btn-primary nav-link" id="login_us" data-toggle="modal" data-target="#modalregistro">
								<i class="fa fa-user-circle" aria-hidden="true"></i> REGISTRARSE
							</button>
						</strong>
					</li>
					@endif
					@if (Auth::guard('client')->guest())
					<li class="nav-item menunav active">	
						<a class="nav-link " href="/login" id="login_us"><i class="fas fa-user"></i> INICIAR SESION</a>
					</li>
					@endif
					@if (Auth::guard('client')->check())
					<li class="nav-item menunav active dropicon casolog">
						<a class="nav-link " href="/adminpaneluser" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> MI CUENTA</a>
						<div class="dropdown-content">
							<a href="/adminpaneluser">Panel Personal</a>
							<a href="/logout_user">Cerrar Sesion</a>

						</div>
					</li>
					<li style="display:none" class="nav-item menunav active casolog">
						<a class="nav-link " href="/adminpaneluser" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> PANEL PERSONAL</a>
					</li>
					<li style="display:none" class="nav-item menunav active casolog">
						<a class="nav-link " href="/logout_user" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> CERRAR SESION</a>
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
					<li class="nav-item menunav active">	
						<label class="menu car" for="check"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-light rojoBlanco" id="badge">{{ count(Session::get('carrito')) }}</span>	</label>
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
	

	<div class="dropdown-content2" id="dropdown-content2">
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

			{{-- <a href="#">Link 1</a>
			<a href="#">Link 2</a>
			<a href="#">Link 3</a> --}}
		</div>

		

		<div class="dropdown-content">
			
		</style>
		<div class="area_categoria">
			<center>
				<div class="margen_top">
					<img src="img/logops.png" width="50" alt="">
					<h2>
						PS4 PRIMARIO
					</h2>
					<p>Juego digital que juegas de cualquier usuario y no necesitas internet para jugar.</p>
				</div>
			</center>
		</div>

			{{-- <a href="#">Link 1</a>
			<a href="#">Link 2</a>
			<a href="#">Link 3</a> --}}
		</div>

		<nav class="navbar navbar-expand-lg navbar-light bg-light menu navBums fixed-top" hidden="">

			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<a class="navbar-brand" href="/">

					<img alt="Brand" src="{{ url('img/logobums2.png') }}" width="150">

				</a>
			</div>

			<form class="form-inline" action="/buscar_articulo_bums" method="get">
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
				<a class="nav-link letraBlanca" href="/articulos_web">ARTICULOS RECIENTES</a>
			</li>
			<!-- <li class="nav-item">
				<a class="nav-link letraBlanca" href="/agotados">ARTICULOS AGOTADOS</a>
			</li> -->
			<li>
				<span class="nav-link letraBlanca">Cambia tu moneda <span class="fa fa-arrow-right"></span> </span>
			</li>
			<li>
				<form class="form-inline margin" action="{{ url('prueba') }}" method="get">
					{{-- onchange="cambiaBandera(this.options[this.selectedIndex].value)" --}}
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
		Contáctanos <i class="fab fa-whatsapp fa-lg align-middle float-right"></i>
	</button>
	<button type="button" class="btn btn-primary commentbutton" data-toggle="modal" data-target="#commentModal">
			DEJANOS TU COMENTARIO <i class="far fa-lg fa-comment-dots float-right align-middle"></i>	
	</button>
	<input type="checkbox" class="checkbox" id="check">


	<div class="carrito_compra" style="overflow-y: auto;" >
		<div style="margin-top: 115px;">			
			<h1 class="titulo-carrito"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>	CARRITO DE COMPRAS</h1>	

			<div class="container contcarrito" style="color: black;">	
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
								<strong>Total:<br> {{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</strong>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>	
			<input type="number" id="nArt" value="{{ $i - 1}}" hidden="">
			<div class="modal-footer">
				<button type="button" id="cerrarCarro" class="btn btn-secondary"><i class="fa fa-chevron-right" aria-hidden="true"></i> Cerrar</button>
				<button id="comprarCarrito" class="btn btn-danger"><i class="fas fa-cash-register"></i> Comprar</button>
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
			<div class="col escondite">
				<div class="cartica">
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
					</center>	
				</div>
			</div>
			<div class="col escondite">
				<div class="cartica">
					<center style="padding: 10px;"><h5>REDES SOCIALES</h5></center>
					<hr>	
					<center>	
						<a href="https://www.facebook.com/bumsgamesoficial" target="_blank" title="Vista nuestro facebook, que esperas?"><img src="img/logo-f.png" class="abc" alt=""> @BumsGames</a>
						<br>
						<br>
						<a href="https://www.instagram.com/bumsgames/" target="_blank" href="www.google.co.ve" title="Unete a nuestra comunidad en Instagram, tenemos muchas sorpresas"><img class="abc" src="img/logo-i.png" alt=""> @BumsGames</a>
						<br>
						<br>
						<a href="https://perfil.mercadolibre.com.ve/BUMSGAMES_OFICIAL" target="_blank" title="Mira nuestra reputacion en MercadoLibre, somos MercadoLideres"><img class="abc2" src="img/logo-m.png" alt=""> BumsGames_OFICIAL</a>
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
	<!-- FIN FOOTER -->
	@include('modal.registrarse')

	
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

<nav id="mainnavbar" style="background: white;" class="navbar sticky-top navbar-expand-xl navbar-light bg-light menu navBums" >

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" style="background: white;">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="/" >
				<img alt="Brand" src="{{ url('img/logo.png') }}" width="90">
			</a>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<br>
				<div class="row">
					
				</div>
				<ul id="searchnav" class="navbar-nav mr-auto" style="margin-left:30px;" style="background-color: black !important;">
					<li>		
						<form class="form-inline" action="/buscar_articulo_bums" method="get">
							<div id="searchnavgroup" class="input-group">
								<input autocomplete="off" type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Simplifica tu compra utilizando el buscador." style="border: solid 1px; opacity: 0.7;">

								<div class="input-group-append">
									<button id="searchbtn" class="btn btn-danger btnbuscar"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
							</div>
						</form>
					</li>
				</ul>

				
					
						<ul class="nav justify-content-end" style="font-size: 16px; margin-top: -10px;">
					<li>
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

			    <br>

			    <ul class="nav justify-content-end s1 sticky-top" style="background-color: white; color: black; font-size: 18px;">
			{{-- /articulos_web --}}
			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" id="category_btn"><b>CATEGORIAS</b></a>
			</li>

			<li class="nav-item">
				<a class="nav-link linkBums2" href="/lista_escrita"><b>LISTA ESCRITA</b></a>
			</li>
			<li>	
{{-- <strong><a class="nav-link dropbtn" id="category_btn" style="background-color: rgba(170, 170, 170, 1); color: white;"><i id="down_icon" class="fas fa-chevron-down"></i> CATEGORIAS</a></strong> --}}
			</li>
			
			
		</ul>
			    
					
					
				
		</nav>


		<nav id="mainnavbar" style="background: white;" class="navbar sticky-top navbar-expand-xl navbar-light bg-light menu navBums" >

			 <div class="container">
        <button class="navbar-toggler navbar-toggler-right align-self-center mt-3" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="py-2 ml-lg-2 mx-3"><a href="#"><i class="fa fa-envelope-o fa-lg mt-2" aria-hidden="true"></i></a></h1>
        <div class="collapse navbar-collapse flex-column ml-lg-0 ml-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Events</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-row mb-2">
            	<li class="nav-item">
                    <a class="nav-link py-1 pr-3" href="#"><i class="fa fa-facebook"></i> JOLLL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-1 pr-3" href="#"><i class="fa fa-facebook"></i> JOLLL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-1 pr-3" href="#"><i class="fa fa-facebook"></i> JOLLL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-1 pr-3" href="#"><i class="fa fa-facebook"></i> JOLLL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-1 pr-3" href="#"><i class="fa fa-instagram">DFFJGFHS</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-1 pr-3" href="#"><i class="fa fa-twitter">FDSFFDS</i></a>
                </li>
            </ul>
        </div>
    </div>

			
			    
					
					
				
		</nav>

		<div class="row">
						<div class="col-12" style="padding-left:0;padding-right:0; margin-top: 20px;">
							<h5 style="margin-left: 5px;"><i class="fas fa-bars"></i> Filtrar por oferta</h5>
							<label class="btn text-left" style="margin-bottom:0;font-size:0.8rem;width:100%">
								<input type="checkbox" name="oferta_filt" autocomplete="off" value="oferta_1">
								<span style="width:100%">ARTICULOS EN OFERTA</span>
							</label>
						</div>
					</div>

		$('input[name="oferta_filt"]').change(function(){
		//desaparece cartas
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
		$('#count_art').text($('.hijo:visible').length);
	});

	
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
	<link rel="stylesheet" type="text/css" href="http://localhost:8000/css/bums.css"/>
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link href="http://localhost:8000/css/bums_v2.css"  rel="stylesheet"/>
	<script async custom-element="amp-auto-ads"
	src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>




</head>



<body style="background-color: white;">
	<div class="bg-image">
	</div>

	

		<nav class="navbar sticky-top navbar-expand-md navbar-light bg-light s1" style="z-index: 100">
			
			
    <h3 class="my-auto" style="margin-left: 20px;"><a class="navbar-brand" href="/" >
				<img alt="Brand" src="http://localhost:8000/img/logo.png" width="120">
			</a></h3>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100 flex-md-column" id="navbarCollapse">
    	 
        <ul class="navbar-nav small mb-2 mb-md-0 ml-auto" style="font-size: 15px !important;">
        	<form class="form-inline" action="/buscar_articulo_bums" method="get" style="padding: 20px;">
							<div id="searchnavgroup" class="input-group">
								<input autocomplete="off" type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Simplifica tu compra utilizando el buscador." style="border: solid 1px; opacity: 0.7;">

								<div class="input-group-append">
									<button id="searchbtn" class="btn btn-danger btnbuscar"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
							</div>
						</form>
        	
            <li class="nav-item ">
				<form class="form-inline margin" action="http://localhost:8000/prueba" method="get">
					
					<select class="form-control selectCoin" onchange="this.form.submit()" name="id_coin" id="id_coin" style="border: solid; border-color: #808080;">
						<option class="form-control" selected="" value="2">Dolares</option>
												<option class="form-control" value="1">Bolivares</option>
												<option class="form-control" value="3">Peso Argentinos</option>
												<option class="form-control" value="4">Reais</option>
											</select>
					&nbsp;
					
					<img id="my_image" src="http://localhost:8000/img/usa.png" alt="" width="40">
				</form>
			</li>
								<li class="nav-item">
			        <a class="nav-link link_bums" href="http://localhost:8000/login"><i class="fas fa-user"></i> Login <span class="sr-only">(current)</span></a>
			      </li>
														
			      
			      <li class="nav-item">
			        <a class="nav-link link_bums" href="http://localhost:8000/ayuda"><i class="fas fa-question"></i> Ayuda</a>
			      </li>
			      <li class="nav-item">
			      	<a class="nav-link link_bums" href="#" data-toggle="modal" data-target="#contactModal"><i class="fab fa-whatsapp"></i> Contáctanos</a>
			      </li>
			      <li class="nav-item menunav active">	
						<label class="menu car" for="check"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-light" id="badge" style="color: black !important;">6</span>	</label>
					</li>
        </ul>

        

        <ul class="navbar-nav ml-auto small mb-2 mb-md-0" style="font-size: 16px;">
            <li class="nav-item">
				<a class="nav-link dropbtn linkBums2" id="category_btn"><b>CATEGORIAS</b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" href="http://localhost:8000/articulos_oferta"><b>OFERTAS</b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" href="http://localhost:8000/lista_escrita"><b>LISTA ESCRITA</b></a>
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
				<input name="_token" id="token" value="MilgKp0ln1HUPNMdx6d8fMapyZaSw6UxnvktDgxw" hidden="">
				<div class="padre">
					<form action="articulos2" @method('POST') name="formulario_category">
						<a href="#" class="submit-link" >
							<input type="text" name="category" hidden="" value="1">
							<div class="area_categoria">
								<div class="area_foto">
									<center>
										<img class="img_category" src="http://localhost:8000/img/playstation.png" alt="" style="max-height: 200px;">
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
										<img class="img_category" src="http://localhost:8000/img/icono_xbox.png" alt="" style="max-height: 200px;">
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
										<img class="img_category" src="http://localhost:8000/img/nintendo.png" alt="" style="max-height: 200px;">
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
										<img class="img_category" src="http://localhost:8000/img/celular (2).png" alt="" style="max-height: 200px;">
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
										<img class="img_category" src="http://localhost:8000/img/otro (2).png" alt="" style="max-height: 200px;">
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
							<input type="text" name="category" hidden="" value="">
							<div class="area_categoria">
								<div class="area_foto">
									<center>
										<img class="img_category" src="http://localhost:8000/img/reciente (1).png" alt="" style="max-height: 200px;">
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

		
		<amp-auto-ads type="adsense"
		data-ad-client="ca-pub-2298464716816209">
	</amp-auto-ads>



	<div class="modal fade" id="contactModal">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">

      <img src="img/61a25413-e695-49bc-b739-12c23c5b0e1c.jpg" alt="">


    </div>
  </div>
</div>

	<div class="modal fade" id="commentModal">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header headerComment" style="background-color: black;">
        <h3 class="commentTitle" style="color: #0080c7;"> Tu opinion vale mucho para nosotros</h3>

      </div>
      <div class="modal-body bodyComment" id='comentariosmodal'>
        <center>
          <h5 style="color: #0080c7;">TU COMENTARIO SERA MOSTRADO UNA VEZ SEA APROBADO.</h5>
        
        <form method="POST" action="http://localhost:8000/postComment" accept-charset="UTF-8"><input name="_token" type="hidden" value="MilgKp0ln1HUPNMdx6d8fMapyZaSw6UxnvktDgxw">
                </center>
        <br>
        
        <div class="form-group">
          
          <label for="nombre">Escribe el nombre a mostrar (Dejalo vacio para comentar como anonimo)</label>  
          <input class="form-control" placeholder="Nombre" autocomplete="off" name="nombre" type="text" value="" id="nombre">
        </div>
                <div class="form-group">
          <textarea class="form-control" placeholder="Dejanos tu opinion, tambien puedes reportar alguna falla en sistema..." name="comentario" cols="50" rows="10"></textarea>
        </div>
        <input class="btn btn-primary btnmodal btn-standar" id="idcomentariobtn" type="submit" value="Enviar comentario">
        </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnmodal btn-standar" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>



	
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
																		

												<tr>
							<th>
								1							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(1, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								2							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(2, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								3							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(3, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								4							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(4, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								5							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 1 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								2.000,00 $
															</td>
							<td>
								<img src="img/19rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(5, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								6							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 1 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								2.000,00 $
															</td>
							<td>
								<img src="img/19rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(6, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

						
												<tr>
							<td>	
							</td>
							<td>	
							</td>

							<td>
																<strong>Total:<br> 4.240,00 $</strong>
																
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>	
			<input type="number" id="nArt" value="6" hidden="">
			<div class="modal-footer">
				<button type="button" id="comprarCarrito" class="btn back"><img src="img/caja3.png" width="100"></button>
				<button type="button" id="cerrarCarro" class="btn back"><img src="img/back.png" width="100"></button>
			</div>
		</div>
	</div>
		
	
<div class="container">
	<div class="row">
	<div class="col-12 col-lg-4">
		<br>

		<div class="portada">
			<div class="text">
			<h1 style="font-size: 70px;">
			<b>Llegamos</b>
		</h1>
		<h1>
			Para hacer la diferencia
			
		</h1>
		</div>
		</div>
<div class="container top" style="width: 500px;">	
	<br>
	<center>
		<div style="background-color: black;">
		<img alt="Brand" src="http://localhost:8000/img/top10 mas vendidos del dia.png" width="400">
	</div>
	</center>
	<hr style="background-color: white !important; border: 1px solid;">
			<br>
	<br>
	<br>
	<br>		
</div>

</div>
	<div class="col-12 col-lg-4">
		<center>
			<br>
		<br>
		<img alt="Brand" src="http://localhost:8000/img/ip6s.png" width="400">
		<br>
		<br>
		</center>
	</div>

	<div class="col-12 col-lg-4">
		
		</div>
		<br>
	</div>

		
	</div>
</div>

</div>
	

	<div class="bumscontent">
		<div style="background:rgba(0,0,0,0.5)">
					</div>
	</div>


	<script>
		function cerrarCarro(){
			$('.menu.car').trigger('click');
		};
		$("#cerrarCarro").click(cerrarCarro);
	</script>

	<div class="modal fade letraNegra" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content" >
			<div class="modal-header" >
				<h3 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Carrito de compras</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover" id="tablaCarrito">
					<tbody>
																		

												<tr>
							<th>
								1							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(1, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								2							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(2, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								3							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(3, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								4							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(4, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								5							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 1 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								2000,00 $
															</td>
							<td>
								<img src="img/19rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(5, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								6							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 1 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								2000,00 $
															</td>
							<td>
								<img src="img/19rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(6, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

						
												<tr>
							<td>
								<strong>Total: 4240,00 $</strong>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="number" id="nArt" value="6" hidden="">
			<div class="modal-footer">
				<button id="comprarCarrito" class="btn btn-danger"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Comprar</button>
			</div>
		</div>
	</div>
</div></div>


	<!-- FIN FOOTER -->
	<!-- Modal -->
	<div class="modal fade" id="modalregistro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <a href="#" data-dismiss="modal">
                <div class="modal-content" style="border-radius:5px">
                    <div class="modal-body">
                        <h5><strong>En estos momentos los agentes BumsGames crean las cuentas de los usuario luego de la primera compra</strong></h5>
                    </div>
                </div>
            </a>
        </div>
	</div>

    
	<footer class="page-footer font-small cyan darken-3 foot1">
	<div class="container">
		<br>
		<br>
		<div class="row">

			<div class="col-12 col-lg-2">

				<center>
					<h3 class="my-auto"><a class="navbar-brand" href="/" >
				<img alt="Brand" src="http://localhost:8000/img/logo-fuego.png" width="200">
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

	
	


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script src="http://localhost:8000/js/bums.js"></script>
	<script src="http://localhost:8000/js/bums_v2.js"></script>

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="http://localhost:8000/js/bootstrap.min.js"></script>

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
	<link rel="stylesheet" type="text/css" href="http://localhost:8000/css/bums.css"/>
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link href="http://localhost:8000/css/bums_v2.css"  rel="stylesheet"/>
	<script async custom-element="amp-auto-ads"
	src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>




</head>



<body style="background-color: white;">
	<div class="bg-image">
	</div>

	

		<nav class="navbar sticky-top navbar-expand-md navbar-light bg-light s1" style="z-index: 100">
			
			
    <h3 class="my-auto" style="margin-left: 20px;"><a class="navbar-brand" href="/" >
				<img alt="Brand" src="http://localhost:8000/img/logo.png" width="120">
			</a></h3>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100 flex-md-column" id="navbarCollapse">
    	 
        <ul class="navbar-nav small mb-2 mb-md-0 ml-auto" style="font-size: 15px !important;">
        	<form class="form-inline" action="/buscar_articulo_bums" method="get" style="padding: 20px;">
							<div id="searchnavgroup" class="input-group">
								<input autocomplete="off" type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Simplifica tu compra utilizando el buscador." style="border: solid 1px; opacity: 0.7;">

								<div class="input-group-append">
									<button id="searchbtn" class="btn btn-danger btnbuscar"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
							</div>
						</form>
        	
            <li class="nav-item ">
				<form class="form-inline margin" action="http://localhost:8000/prueba" method="get">
					
					<select class="form-control selectCoin" onchange="this.form.submit()" name="id_coin" id="id_coin" style="border: solid; border-color: #808080;">
						<option class="form-control" selected="" value="2">Dolares</option>
												<option class="form-control" value="1">Bolivares</option>
												<option class="form-control" value="3">Peso Argentinos</option>
												<option class="form-control" value="4">Reais</option>
											</select>
					&nbsp;
					
					<img id="my_image" src="http://localhost:8000/img/usa.png" alt="" width="40">
				</form>
			</li>
								<li class="nav-item">
			        <a class="nav-link link_bums" href="http://localhost:8000/login"><i class="fas fa-user"></i> Login <span class="sr-only">(current)</span></a>
			      </li>
														
			      
			      <li class="nav-item">
			        <a class="nav-link link_bums" href="http://localhost:8000/ayuda"><i class="fas fa-question"></i> Ayuda</a>
			      </li>
			      <li class="nav-item">
			      	<a class="nav-link link_bums" href="#" data-toggle="modal" data-target="#contactModal"><i class="fab fa-whatsapp"></i> Contáctanos</a>
			      </li>
			      <li class="nav-item menunav active">	
						<label class="menu car" for="check"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-light" id="badge" style="color: black !important;">6</span>	</label>
					</li>
        </ul>

        

        <ul class="navbar-nav ml-auto small mb-2 mb-md-0" style="font-size: 16px;">
            <li class="nav-item">
				<a class="nav-link dropbtn linkBums2" id="category_btn"><b>CATEGORIAS</b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" href="http://localhost:8000/articulos_oferta"><b>OFERTAS</b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link dropbtn linkBums2" href="http://localhost:8000/lista_escrita"><b>LISTA ESCRITA</b></a>
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
				<input name="_token" id="token" value="MilgKp0ln1HUPNMdx6d8fMapyZaSw6UxnvktDgxw" hidden="">
				<div class="padre">
					<form action="articulos2" @method('POST') name="formulario_category">
						<a href="#" class="submit-link" >
							<input type="text" name="category" hidden="" value="1">
							<div class="area_categoria">
								<div class="area_foto">
									<center>
										<img class="img_category" src="http://localhost:8000/img/playstation.png" alt="" style="max-height: 200px;">
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
										<img class="img_category" src="http://localhost:8000/img/icono_xbox.png" alt="" style="max-height: 200px;">
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
										<img class="img_category" src="http://localhost:8000/img/nintendo.png" alt="" style="max-height: 200px;">
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
										<img class="img_category" src="http://localhost:8000/img/celular (2).png" alt="" style="max-height: 200px;">
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
										<img class="img_category" src="http://localhost:8000/img/otro (2).png" alt="" style="max-height: 200px;">
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
							<input type="text" name="category" hidden="" value="">
							<div class="area_categoria">
								<div class="area_foto">
									<center>
										<img class="img_category" src="http://localhost:8000/img/reciente (1).png" alt="" style="max-height: 200px;">
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

		
		<amp-auto-ads type="adsense"
		data-ad-client="ca-pub-2298464716816209">
	</amp-auto-ads>



	<div class="modal fade" id="contactModal">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">

      <img src="img/61a25413-e695-49bc-b739-12c23c5b0e1c.jpg" alt="">


    </div>
  </div>
</div>

	<div class="modal fade" id="commentModal">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header headerComment" style="background-color: black;">
        <h3 class="commentTitle" style="color: #0080c7;"> Tu opinion vale mucho para nosotros</h3>

      </div>
      <div class="modal-body bodyComment" id='comentariosmodal'>
        <center>
          <h5 style="color: #0080c7;">TU COMENTARIO SERA MOSTRADO UNA VEZ SEA APROBADO.</h5>
        
        <form method="POST" action="http://localhost:8000/postComment" accept-charset="UTF-8"><input name="_token" type="hidden" value="MilgKp0ln1HUPNMdx6d8fMapyZaSw6UxnvktDgxw">
                </center>
        <br>
        
        <div class="form-group">
          
          <label for="nombre">Escribe el nombre a mostrar (Dejalo vacio para comentar como anonimo)</label>  
          <input class="form-control" placeholder="Nombre" autocomplete="off" name="nombre" type="text" value="" id="nombre">
        </div>
                <div class="form-group">
          <textarea class="form-control" placeholder="Dejanos tu opinion, tambien puedes reportar alguna falla en sistema..." name="comentario" cols="50" rows="10"></textarea>
        </div>
        <input class="btn btn-primary btnmodal btn-standar" id="idcomentariobtn" type="submit" value="Enviar comentario">
        </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnmodal btn-standar" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>



	
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
																		

												<tr>
							<th>
								1							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(1, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								2							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(2, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								3							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(3, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								4							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(4, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								5							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 1 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								2.000,00 $
															</td>
							<td>
								<img src="img/19rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(5, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								6							</th>
							<td>
								<input autocomplete="off" type='text' class='id_articulo' value='6384' hidden="">
								Rage 1 || PlayStation 4 | Articulo Fisico
							</td>
							<td class="columna_precio">
								2.000,00 $
															</td>
							<td>
								<img src="img/19rage 2.jpg" width="40" height="45" alt="">

							</td>
							<td>
								<button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito(6, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

						
												<tr>
							<td>	
							</td>
							<td>	
							</td>

							<td>
																<strong>Total:<br> 4.240,00 $</strong>
																
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>	
			<input type="number" id="nArt" value="6" hidden="">
			<div class="modal-footer">
				<button type="button" id="comprarCarrito" class="btn back"><img src="img/caja3.png" width="100"></button>
				<button type="button" id="cerrarCarro" class="btn back"><img src="img/back.png" width="100"></button>
			</div>
		</div>
	</div>
		
	
<div class="container">
	<div class="row">
	<div class="col-12 col-lg-4">
		<br>

		<div class="portada">
			<div class="text">
			<h1 style="font-size: 70px;">
			<b>Llegamos</b>
		</h1>
		<h1>
			Para hacer la diferencia
			
		</h1>
		</div>
		</div>
<div class="container top" style="width: 500px;">	
	<br>
	<center>
		<div style="background-color: black;">
		<img alt="Brand" src="http://localhost:8000/img/top10 mas vendidos del dia.png" width="400">
	</div>
	</center>
	<hr style="background-color: white !important; border: 1px solid;">
			<br>
	<br>
	<br>
	<br>		
</div>

</div>
	<div class="col-12 col-lg-4">
		<center>
			<br>
		<br>
		<img alt="Brand" src="http://localhost:8000/img/ip6s.png" width="400">
		<br>
		<br>
		</center>
	</div>

	<div class="col-12 col-lg-4">
		
		</div>
		<br>
	</div>

		
	</div>
</div>

</div>
	

	<div class="bumscontent">
		<div style="background:rgba(0,0,0,0.5)">
					</div>
	</div>


	<script>
		function cerrarCarro(){
			$('.menu.car').trigger('click');
		};
		$("#cerrarCarro").click(cerrarCarro);
	</script>

	<div class="modal fade letraNegra" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content" >
			<div class="modal-header" >
				<h3 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Carrito de compras</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover" id="tablaCarrito">
					<tbody>
																		

												<tr>
							<th>
								1							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(1, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								2							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(2, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								3							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(3, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								4							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 2 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								60,00 $
															</td>
							<td>
								<img src="img/13rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(4, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								5							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 1 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								2000,00 $
															</td>
							<td>
								<img src="img/19rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(5, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

												<tr>
							<th>
								6							</th>
							<td>
								<input type='text' class='id_articulo' value='6384' hidden="">
								Rage 1 || PlayStation 4 | Articulo Fisico
							</td>
							<td>
								2000,00 $
															</td>
							<td>
								<img src="img/19rage 2.jpg" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito(6, 1, '$');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

						
												<tr>
							<td>
								<strong>Total: 4240,00 $</strong>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="number" id="nArt" value="6" hidden="">
			<div class="modal-footer">
				<button id="comprarCarrito" class="btn btn-danger"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Comprar</button>
			</div>
		</div>
	</div>
</div></div>


	<!-- FIN FOOTER -->
	<!-- Modal -->
	<div class="modal fade" id="modalregistro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <a href="#" data-dismiss="modal">
                <div class="modal-content" style="border-radius:5px">
                    <div class="modal-body">
                        <h5><strong>En estos momentos los agentes BumsGames crean las cuentas de los usuario luego de la primera compra</strong></h5>
                    </div>
                </div>
            </a>
        </div>
	</div>

    
	<footer class="page-footer font-small cyan darken-3 foot1">
	<div class="container">
		<br>
		<br>
		<div class="row">

			<div class="col-12 col-lg-2">

				<center>
					<h3 class="my-auto"><a class="navbar-brand" href="/" >
				<img alt="Brand" src="http://localhost:8000/img/logo-fuego.png" width="200">
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

	
	


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script src="http://localhost:8000/js/bums.js"></script>
	<script src="http://localhost:8000/js/bums_v2.js"></script>

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="http://localhost:8000/js/bootstrap.min.js"></script>

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