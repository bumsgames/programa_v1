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
				<a href="https://perfil.mercadolibre.com.ve/BUMSPLAYERS" target="_blank"  style="margin-left: 140px; border: none;" title="Mira nuestra reputacion en MercadoLibre, somos MercadoLideres"><img class="abc2" src="img/logo-m.png" alt=""></a>
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
			<div style="background-color: #000;">	

				<h2 class="colortitulo" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;">ULTIMOS ARTICULOS</h2>
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
	<div style="background-color: #000;">	

		<h2 class="colortitulo" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;">NOTICIAS</h2>
	</div>

	<!-- NOTICIA -->
	<style>	
.noticia{
	background-color: white;
	height: 230px;
}

.noticia-img {
  float: left;
}

.noticia-letras{
	color: black;
	margin-left: 250px ;
	padding-top: 20px;
}

.noticias-letras2{
	margin-left: 240px ;
}

</style>
	<div class="noticia">
	<img src="img/26batman lbp.png" class="noticia-img" width="230" height="230" alt="">	
		<strong><h4 class="noticia-letras">Oh! My God! Lego Batman Movie ya tiene una nueva pelicula</h4></strong>
		<p class="noticias-letras2">La nueva pelicula de Lego Batman Movie saldra el 05/12/2020. Wow, gran noticia para los fanaticos de Batman. </p>
	</div>

	
</div>
<div class="col-12 col-lg-2" style="font-size: 14px;">
	<div style="background-color: #000;">	
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

