@extends('layouts.plantillaWeb') 
@extends('layouts.ultimos-v')

@section('content')

<style type="text/css">
.img_vermas {
	max-width: 100%;
	height: auto;
}
</style>

<br>
<br><br>
<div >
	<div id="mostrararticulos" class="tile">
		<div class="row">
			<div class="col-12 col-lg-5">
				<div class="container sticky responsive bg-dark" style="top:100px;border-radius:50px; background: white !important; border: solid 20px gray;">
					<br>
					<center>
						<img class="img_vermas" src="{{ url('img/'.$articulo_part->fondo) }}" style="width: 400px;">
					</center>
					<br>
				</div>
			</div>
			<div class="col">
				<br>
				<div class="container sticky responsive" style="top:100px;border-radius:3px; background: white; color: black;font-family: 'Poppins', sans-serif;padding:2rem; border: solid 20px rgba(219, 219, 219, 1);">
					<h2><strong>{{$articulo_part->name}}</strong></h2>
					<div>
						<br>
						@if($articulo_part->oferta >= 1)
						<div class="cartaEtiqueta_oferta" style="top:60px;right:10px;width:18%">
							<img style="width:100%!important"  src="{{ url('img/oferta.png') }}" alt="" class="oferta-img">
						</div>
						<h5>
							<del>{{ number_format($articulo_part->offer_price * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}</del>
						</h5>
						@endif
						<h4>
							<strong>{{ number_format($articulo_part->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }} </strong>
						</h4>
					</div>
					<br>
					@if($articulo_part->quantity == 0)
					<span style="font-size: 1rem;padding: .375rem .75rem;" class="badge badge-danger">Agotado</span>
					@else
					<span style="font-size: 1rem;padding: .375rem .75rem;"  class="badge badge-success">Disponible</span>
					@endif
					<br>
					<br>
					<h4><b>Categoria:</b> {{ $articulo_part->pertenece_category->category }}</h4>
					<br>
					@if($articulo_part->category == 4 || $articulo_part->category == 6 || $articulo_part->category == 11 || $articulo_part->category == 14 || $articulo_part->category == 15 || $articulo_part->category == 16 )
					<h6><b>Condicion:</b> {{ $articulo_part->estado}}</h6>

					@else
					<h6><b>Condicion:</b> Digital</h6>
					@endif
					

					@if($articulo_part->description != 0)
					<br>
					<h6><b>Descripcion:</b></h6> <?php echo $articulo_part->description ?>
					<br>
					<br>
					@endif
					@if(($articulo_part->trailer))
					<style>
					.embed-container { 
						position: relative; 
						padding-bottom: 56.25%;
						height: 0; 
						overflow: hidden; 
						max-width: 100%; 
					} 
					.embed-container iframe, .embed-container object, .embed-container embed { 
						position: absolute; 
						top: 0; 
						left: 0; 
						width: 100%; 
						height: 100%; 
					}
				</style>
				<div class='embed-container'>
					<iframe src='{{$articulo_part->trailer}}' frameborder='0' allowfullscreen></iframe>
				</div>
				@endif

				<br>
				<br>



				<center>
					<button style="border-radius:5px!important;padding:0.5rem" class="btn btn-primary botonCarta" @if($articulo_part->quantity == 0) disabled @else onclick="agregaCarro('{{ $articulo_part->id }}', '{{ $articulo_part->name }}', 
						'{{ $articulo_part->pertenece_category->category }}', 
						{{ $articulo_part->price_in_dolar }},
						'{{ $articulo_part->fondo }}', {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');" @endif>
						<i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Agregar al carrito
					</button>
					<br>
					<br>
					<br>
					<img class="lbp_oferta" src="img/oferta2.png" width="500">
				</center>
				<br>

				<div class="row">

					<div class="col">
						<button class="btn btn-primary btn-block botonCarta dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false" style="background-color: rgba(50, 0, 0, 0.8) !important;">
						Realizar oferta.
					</button>






					<div class="dropdown-menu oferta p-4" style="width:90%; position: relative !important; z-index: 10 !important; border: solid 30px gray !important;;">
						<input type="text" hidden="" name="art_ofer" id="art_ofer" value="{{$articulo_part->id}}">
						<div class="form-group">
							<label for="nombre_ofer"><b>Nombre y apellido</b></label>
							<input type="text" class="form-control txt_bums" id="nombre_ofer" required>
						</div>
						<div class="form-group">
							<label for="telefono_ofer"><b>Correo electronico o WhatsApp</b></label>
							<input type="text" class="form-control  txt_bums" id="telefono_ofer" placeholder="Nos comunicaremos con usted a la brevedad" required>
						</div>
						<div class="form-group">
							<label for="oferta_ofer"><b>Comentario con su respectiva oferta</b></label>
							<textarea class="form-control txt_bums" name="oferta_ofer" id="oferta_ofer" cols="30" rows="3"></textarea>
						</div>
						<button type="submit" id="send_oferta" class="btn btn-primary btn-block botonCarta">Enviar oferta</button>

					</div>


				</div>
			</div>

			<br>
			<br>
			<div>



			</div>
{{-- 					<br>
					<br> Usted puede realizar una oferta en cualquiera de nuestros productos, si su oferta es aceptada un agente BumsGames se pondra en contacto con usted.
					<br>
					<br> --}}

				</div>
				<br>


			</div>

		</div>
		
		<br>
		<br>
		<br>
		<br>
		<br>


	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
</div>
<style type="text/css">
.recomendados{
	background-color: rgba(210, 210, 210, 0.9);
	padding: 30px;
}
</style>
{{--  --}}
<br><br><br><br>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script>
	$( "#buscador_articulo" ).on('keyup', function() {
		var rex = new RegExp($(this).val(), 'i');
		$('.hijo').hide();
		$('.hijo').filter(function () {
			return rex.test($(this).text());
		}).show();
		filter_cat_hide();
		$('#count_art').text($('.hijo:visible').length);
	});

	$('input[name="cat_filt"]').change(function(){
		$('.hijo').hide();
		var rex = new RegExp($("#buscador_articulo").val(), 'i');
		$('.hijo').filter(function () {
			return rex.test($(this).text());
		}).show();
		filter_cat_hide();
		if(!$('input[name="cat_filt"]').is(':checked')){
			$('.hijo').filter(function () {
				return rex.test($(this).text());
			}).show();
		}
		$('#count_art').text($('.hijo:visible').length);
	});

</script>
<script>

	$("#send_oferta").click(function(){ 

		var route = '/ofertas_cliente';

		if( $("#nombre_ofer").val() == ""){
			swal({
				title: "Error!",
				text: "Debes indicar tu nombre en la oferta!",
				icon: "warning",
			});
			return;
		}
		if( $("#telefono_ofer").val() == ""){
			swal({
				title: "Error!",
				text: "Debes indicar tu número de WhatsApp para que podamos contactarte!",
				icon: "warning",
			});
			return;
		}
		if( $("#oferta_ofer").val() == ""){
			swal({
				title: "Error!",
				text: "Debes indicar cual es tu oferta!",
				icon: "warning",
			});
			return;
		}

		var form_data = new FormData();  
		form_data.append('art_ofer', $("#art_ofer").val());
		form_data.append('nombre_ofer', $("#nombre_ofer").val());
		form_data.append('telefono_ofer', $("#telefono_ofer").val());
		form_data.append('oferta_ofer', $("#oferta_ofer").val());

		$.ajax({
			url:        route,
			type:       'POST',
			data:       form_data,
			contentType: false, 
			processData: false,

			success:function(data){
				if(data.tipo == 1){
					swal(data.data);  
				}else{
					swal("Oferta enviada!","Su oferta ha sido enviada con exito. Si su oferta es aprobada, un agente BumsGames se pondra en contacto con usted.",'success');
				}     
			},
			error:function(msj){
				swal("Error!", "Ha sucedido un error, recargue e intente de nuevo", "error");
			}
		});

	});

</script>
{{-- return rex.test($(".status", this).text()); --}}
@endsection