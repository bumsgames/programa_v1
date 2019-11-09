@extends('layouts.plantillaWeb')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12 col-lg-4">
			<br>

			<div class="portada">
				<div class="text">
					<h1 class="text-llegamos">
						<b>Llegamos</b>
					</h1>
					<h1 >
						Para hacer la diferencia

					</h1>
				</div>
			</div>
			<div class="container top" style="width: 500px;">	
				<br>
				<center>
					<div style="background-color: black;">
						<img class="img_top10" alt="Brand" src="{{ url('img/top10 mas vendidos del dia.png') }}">
					</div>
				</center>
				<hr style="background-color: white !important; border: 1px solid;">
				<?php $i=1; ?>
				@foreach($articulo_mas_vendido_semana as $articulo)	
				<strong><?php echo $i++; ?> </strong>. {{ $articulo->name }} | <b>{{ $articulo->category }}</b>
				<br>
				<br>
				@endforeach
				<br>
				<br>
				<br>
				<br>		
			</div>
			<br>
			<br>
			<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- index bums 1 -->
			<ins class="adsbygoogle"
			style="display:block"
			data-ad-client="ca-pub-2298464716816209"
			data-ad-slot="5282998185"
			data-ad-format="auto"
			data-full-width-responsive="true"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>

		</div>
		<div class="col-12 col-lg-4">
			<a href="https://www.instagram.com/bumsgames/">
				<center>
				<br>
				<br>
				<img class="img_ig" alt="Brand" src="{{ url('img/ip6s.png') }}" width="500">
				<br>
				<br>
			</center>
			</a>
		</div>

		<div class="col-12 col-lg-4">
			<style type="">
			.contenedor5{
				position: relative;
				display: inline-block;
				text-align: center;
				margin-top: -63px;
				z-index: 1;
			}

			.etiqueta-crash{
				/*position: absolute;
				z-index: -1;
				left: 45%;
				transform: translate(-50%, -50%);
				width: 200px;*/
				width: 200px;
			}

			.encuesta2{
				position: relative;
				margin-bottom: 0;
				z-index: 2;
				/*position: absolute;*/
				/*top: 210px;
				z-index: 4;
				left: 45%;
				transform: translate(-50%, -50%);
				width: 400px;
				z-index: 2;*/
			}
		</style>
		<br>	
		<br>	
		<br>	
		<br>	
		<center>	
			<div class="">
				<div class="mx-auto encuesta2">
					<div class="card encuesta-card">
						@if(isset($encuesta))
						<form action="" method="POST">
							<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
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
				<div class="contenedor5">	
					<img class="etiqueta-crash" alt="Brand" src="{{ url('img/en2.png') }}" width="500">
				</div>
			</div>
		</center>
		

	</div>
	<br>
</div>
</div>
<br>				
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

