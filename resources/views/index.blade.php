@extends('layouts.plantillaWeb')

@section('content')

<div id="bannertop" class="carousel slide" data-ride="carousel" data-interval="1000">
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
				@include('carta')
				@endforeach
			</div>
		</div>
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

{{-- comentarios --}}
<div class="col-12 col-lg-5">
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
					@foreach($noticias as $noticia)
					<div class="carousel-item item-vertical @if($count == 0) active @endif">
							<?php $count=$count+1;?>

						<div class="noticia">
							<div class="noticia-img-container  mx-auto">
								<img src="img/{{$noticia->imagen}}" class="noticia-img" alt="">	
							</div>
							<div class="noticia-content">
								<strong><h4 class="noticia-letras">{{$noticia->titulo}}</h4></strong>
								<p class="noticias-letras2">{{$noticia->descripcion}}</p>
							</div>
							
							<span class="likes badge badge-red">Likes: <span class="badge bg-light text-dark" id="likes_num_{{$noticia->id}}">{{$noticia->likes}}</span> <i class="fas fa-heart"></i></span>
							<a href="javascript:void(0);" onclick="aumentarMegusta({{$noticia->id}})" class="btn btn-primary buttonLike">Me gusta <i class="far fa-thumbs-up"></i></a>
						</div>
					</div>
					@endforeach
					<a class="carousel-control-next carousel-control-next-vertical" href="#carouselNoticias" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						</a>
				</div>
			</div>
		</div>
	</section>
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



@endsection

