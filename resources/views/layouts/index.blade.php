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
	</div>
</div>

<img class="badred" src="img/badred.jpg" alt="" height="170" width="2024">


{{-- <div class="redbannersocial">	
	<center>
		<a href="www.google.co.ve"><img src="img/logo-f.png" class="abc" alt=""></a>
		<a  style="margin-left: 140px; border: none;" href="www.google.co.ve"><img class="abc" src="img/logo-i.png" alt=""></a>
		<a  style="margin-left: 140px; border: none;" href="www.google.co.ve"><img class="abc2" src="img/logo-m.png" alt=""></a>
	</center>
</div> --}}

@endsection

@section('comment')
{{-- gen-container --}}
<div class="container ">
	<div class="row">
		<div class="col-5">
			<script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>
			<h2>ULTIMOS ARTICULOS</h2>
			<style>
			.marquee_articulos {
				width: 100%;
				overflow: hidden;
				background: rgba(40, 40, 40, 0.95) !important;
			}

			.marquee {
				width: 100%;
				height: 95%;
				max-height:590.891px;
				overflow: hidden;
				border: none;
				background: none;
			}
		</style>
		<div class='marquee_articulos'>
			<div class="padre">
				@foreach($articulos as $articulo)
				@include('webuser.misc.carta')
				@endforeach
			</div>
		</div>
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="padding: 10px">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="{{url('img/gamepad.jpg')}}" alt="First slide" height="120">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="{{url('img/gamepad.jpg')}}" alt="Second slide" height="120">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="{{url('img/gamepad.jpg')}}" alt="Third slide" height="120">
				</div>
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
<div class="col-3">

	<h2>COMENTARIOS</h2>
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
					else echo '<img src="img/logo-i.png" alt="Avatar">';
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
<div class="col-4">
	<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="padding: 10px">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="{{url('img/gamepad.jpg')}}" alt="First slide" height="120">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="{{url('img/gamepad.jpg')}}" alt="Second slide" height="120">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="{{url('img/gamepad.jpg')}}" alt="Third slide" height="120">
			</div>
		</div>
	</div>
	<div class="container top">	
		<br>
		<strong>	Articulos mas vendidos de la semana
		</strong>
		<hr style="background-color: white !important; border: 1px solid;">
		<?php $i=1; ?>
		@foreach($articulo_mas_vendido_semana as $articulo)	
		<?php echo $i++; ?>. {{ $articulo->name }} | {{ $articulo->category }}
		<br>
		<br>

		@endforeach
		<br>		
	</div>
</div>
</div>
</div>
{{-- <input type="checkbox" class="checkbox" id="check"> --}}
<div class="container">
	{{-- tile --}}
	<div class="">
		<h2>Bienvenido amig@</h2>
		<hr>
		<div class="row">
			<div class="col-8 escondite">
				<div class="container">
					<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php $i = 0; ?>
							@foreach($portal1 as $imagen)
							@if($i == 0)
							<div class="carousel-item active">
								<img class="d-block w-100" height="400" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
							</div>
							@else
							<div class="carousel-item">
								<img class="d-block w-100" height="400" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
							</div>
							@endif
							<?php $i++; ?>

							@endforeach
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="container">
					<h4>Opciones</h4>
					<hr style="background: white;">
					<button class="btn btn-block btn-sm" onclick="location.href = 'categorias';">Categorias</button>
					<button class="btn btn-block btn-sm" onclick="location.href = 'https://perfil.mercadolibre.com.ve/BUMSPLAYERS';">Revisa nuestra reputacion.</button>
					<br>



					<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">

							<?php $i = 0; ?>
							@foreach($portal2 as $imagen)
							@if($i == 0)
							<div class="carousel-item active">
								<img class="d-block w-100" height="200" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
							</div>
							@else
							<div class="carousel-item">
								<img class="d-block w-100" height="200" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
							</div>
							@endif
							<?php $i++; ?>

							@endforeach
						</div>
					</div>
					<br>
					<button class="btn btn-block" onclick="location.href = 'ayuda';">Como comprar con BumsGames?</button>
				</div>

			</div>
		</div>
		<br>
		<hr>
		<div class="row">

			<div class="col parte-izquierda">
				<h3>Ultimos articulos</h3>
				<hr>
				<div class="padre">
					@foreach($articulos as $articulo)
					@include('webuser.misc.carta')
					@endforeach
				</div>



			</div>
			<div class="col-3 parte-derecha">
				<style>
				.top{
					border: solid white 5px;
				}
			</style>
			<div class="container top">	
				<br>
				<strong>	Articulos mas vendidos de la semana
				</strong>
				<hr style="background-color: white !important; border: 1px solid;">
				<?php $i=1; ?>
				@foreach($articulo_mas_vendido_semana as $articulo)	
				<?php echo $i++; ?>. {{ $articulo->name }} | {{ $articulo->category }}
				<br>
				<br>

				@endforeach
				<br>		
			</div>
			<br>
			<br>
			<div class="container">
				<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php $i = 0; ?>
						@foreach($portal3 as $imagen)
						@if($i == 0)
						<div class="carousel-item active">
							<img class="d-block w-100" height="400" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
						</div>
						@else
						<div class="carousel-item">
							<img class="d-block w-100" height="400" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
						</div>
						@endif
						<?php $i++; ?>

						@endforeach
					</div>
				</div>

			</div>
			<br>
			<br>


		</div>

	</div>
</div>

</div>


</html> 
@endsection