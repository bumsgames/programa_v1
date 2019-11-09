@extends('layouts.plantillaWeb')

@section('content')

<div id="bannertop" class="carousel slide" data-ride="carousel" data-interval="50000">
	<div class="carousel-inner">

		@php $count=0; @endphp
				@foreach($portal1 as $portal)
				@php $count++;@endphp
				<div class="carousel-item <?php if($count==1) echo 'active';?>">
					<img style="width: 100%;height: 180px;" class="" src="img/{{$portal->imagen}}" alt="First slide">
				</div>
			@endforeach

	</div>
</div>

<img class="badred" src="img/badred.jpg" alt="" height="170" width="2024">


<div class="redbannersocial">	
	<center>
		<a href="https://www.facebook.com/bumsgamesoficial" target="_blank"><img src="img/logo-f.png" class="abc" alt=""></a>
		<a href="https://www.instagram.com/bumsgames/" target="_blank" style="margin-left: 140px; border: none;" href="www.google.co.ve"><img class="abc" src="img/logo-i.png" alt=""></a>
		<a href="https://perfil.mercadolibre.com.ve/BUMSGAMES_OFICIAL" target="_blank"  style="margin-left: 140px; border: none;" href="www.google.co.ve"><img class="abc2" src="img/logo-m.png" alt=""></a>
	</center>
</div>

@endsection


@section('comment')
<div class="container">
<div class="fondotitulo"><h2 class="titulobums">Bienvenido amig@</h2></div>
</div>
{{-- gen-container --}}
<div class="container maincont">
	<div class="row">
		<div class="col-12 col-lg-5 ">
			<script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>
			<h2 class="colortitulo">ULTIMOS ARTICULOS</h2>
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
<div class="col-12 col-lg-3">

	<h2 class="colortitulo">COMENTARIOS</h2>
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
</div>
<div class="col-12 col-lg-4">
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
{{-- <input type="checkbox" class="checkbox" id="check"> --}}



@endsection

