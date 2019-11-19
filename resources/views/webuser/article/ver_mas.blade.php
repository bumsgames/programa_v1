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
<div class="container">	
	<div >
		<div id="mostrararticulos" class="tile">
			<div class="row">
				<div class="col-12 col-lg-5">
					<div class="container responsive bg-dark" style="top:100px;border-radius:50px; background: white !important; border: solid 20px gray;">
						<br>
						@foreach($imagenes_articulo as $imagen)
						<center>
<<<<<<< HEAD
							<img class="img_vermas" src="{{ url('img/'.$imagen->file) }}" style="height: 350px;">
=======
							<img class="img_vermas" src="{{ url('img/'.$imagen->file) }}" style="height: 240px;">
>>>>>>> 73e3ede248e8fba6269e0c46fac04fe3c71bb58f
						</center>
						<br>	
						@endforeach
						
						<br>
					</div>
					<br>
					<div class="row">	
						<div class="col">	
							<div class="container sticky responsive" style="top:100px;border-radius:3px; background: white; color: black;font-family: 'Poppins', sans-serif;padding:2rem; border: solid 20px rgba(219, 219, 219, 1);">
								<div class="row">	
									<div class="col">
										<h4>Ventas: {{ $ventas }}</h4>
									</div>
									<div class="col">
										<h4>Clientes: {{ $clientes }}</h4>
									</div>
									<div class="col">
										<h4>Articulos Vendidos: {{ $articulos_vendidos[0]->cantidad }}</h4>
									</div>
								</div>	
								<br>
								<br>
								<b>Descripcion: </b>
								<br>	
								<br>	

								<br>	
								<div style="border: 2px solid rgba(0,10,0,0.3);">
									<br>	
									<div class="row">	
										<div class="col" style="margin-left: 20px;"><b>Envios:</b> Los envios salen el mismo dia, si el pago es realizado antes de las 11 AM, puede haber casos que salga al siguiente dia habil.
										</div>	
									</div>	
									<br>	
									<div class="row">	
										<div class="col" style="margin-left: 20px;"><b>Entregas personales:</b> Puede realizar el pago para apartar el articulo y luego retirarlo por nuestra tienda o puede realizar el Pago en nuestra Tienda (Puerto Ordaz), recuerde preguntar si el Articulo se encuentra en Tienda.
										</div>	
									</div>	
									<br>	
									<div class="row">	
										<div class="col" style="margin-left: 20px;"><b>Dudas:</b> Cualquier duda puede contactar al What'sApp a cualquier agente BumsGames, lo datos de contacto estan arriba en la Seccion contactanos.
										</div>	
									</div>	
									<br>
								</div>

							</div>
						</div>			
					</div>


				</div>
				<div class="col">
					<br>
					<div class="container sticky responsive" style="top:100px;border-radius:3px; background: white; color: black;font-family: 'Poppins', sans-serif;padding:2rem; border: solid 20px rgba(219, 219, 219, 1);">
						@if($articulo_part->category == 4 || $articulo_part->category == 6 || $articulo_part->category == 11 || $articulo_part->category == 14 || $articulo_part->category == 15 || $articulo_part->category == 16 )
						<h6><b>Condicion:</b> {{ $articulo_part->estado}}</h6>

						@else
						<h6><b>Condicion:</b> Digital</h6>
						@endif
						{{-- TITULO --}}
						<h1 style="font-size: 50px;"><strong>{{$articulo_part->name}}</strong></h1>
						<input type="" id="art_ofer" value="{{$articulo_part->id}}" hidden="">
						{{-- CATEGORIA --}}
						@isset($articulo_part->categorias[0])
<h4><b>Categoria:</b> {{ $articulo_part->categorias[0]->category }}</h4>
						@if (strpos($articulo_part->categorias[0]->category,'Cuenta') !== false) 
						<a href="{{ url('ayuda') }}"><h5>Si no sabes que significa esto, clickea aqui :)</h5></a>
						@endif
						@endisset
						

						@if($articulo_part->quantity == 0)
						<span style="font-size: 1rem;padding: .375rem .75rem;" class="badge badge-danger">Agotado</span>
						@else
						<span style="font-size: 1rem;padding: .375rem .75rem;"  class="badge badge-success">Disponible</span>
						@endif
						


						@if($articulo_part->description != 0)
						<br>
						<h6><b>Descripcion:</b></h6> <?php echo $articulo_part->description ?>
						<br>
						<br>

						@endif

						<br>	
						<br>	
						<br>	
						<div style="background: rgba(0,10,0,0.2); padding: 20px;"><br>
							
							<div class="row">	
								<div class="col">
									@if($articulo_part->oferta >= 1)
									<div class="cartaEtiqueta_oferta" style="top:60px;right:10px;width:18%">
										<img style="width:100%!important"  src="{{ url('img/oferta.png') }}" alt="" class="oferta-img">
									</div>
									<h5>
										<del>{{ number_format($articulo_part->offer_price * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}</del>
									</h5>
									@endif
									<h2>
										<strong>{{ number_format($articulo_part->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }} </strong>
									</h2>
									<br>	

									<p></p>
									
									@if (Auth::guard('client')->user())
						
										<button id="btnFav" class="btn btn-sm btn-primary"
										@if (count(Auth::guard('client')->user()->favorites->where('article_id',$articulo_part->id))==0)
											onclick="add_favorite('{{ $articulo_part->id }}', {{count(Auth::guard('client')->user()->favorites)}})" 
										@endif
											
										style="">
											Agregar a favoritos
											<i class="fa fa-heart ml-2" 
											@if (count(Auth::guard('client')->user()->favorites->where('article_id',$articulo_part->id))>0)
												style="color:red"
											@endif  aria-hidden="true"></i>
										</button>

									@endif

									@if (empty(Auth::guard('client')->user()))
										<button class="btn btn-primary" type="button" onclick="messageLogin()">
											Agregar a favoritos<i class="fa fa-heart ml-2" aria-hidden="true"></i>
										</button>
									@endif
									
								</div>

								<div class="col">
									@isset($articulo_part->categorias[0])
										<button style="border-radius:5px!important;padding:0.5rem" class="btn btn-primary btn-block botonCarta" 
										@if($articulo_part->quantity == 0) 
											disabled 
										@else 
											onclick="agregaCarro('{{ $articulo_part->id }}', '{{ $articulo_part->name }}', 
<<<<<<< HEAD
											{{ $articulo_part->categorias[0]->id }}, 
											{{ $articulo_part->price_in_dolar }},
											'{{ $articulo_part->fondo }}', {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}','{{$cantidad_de_articulos->quantity}}');" 
=======
											'{{ $articulo_part->categorias[0]->category }}', 
											{{ $articulo_part->price_in_dolar }},
											'{{ $articulo_part->fondo }}', {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}','{{$articulo_part->quantity}}');" 
>>>>>>> 73e3ede248e8fba6269e0c46fac04fe3c71bb58f
										@endif>
										<i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Agregar al carrito
									</button>
									
									<button style="border-radius:5px!important;padding:0.5rem; background: white !important; color: blue; border: solid 1px blue !important;" class="btn btn-primary btn-block botonCarta" data-toggle="modal" data-target="#modal_realizarOferta">
										Realizar oferta
									</button>

@endisset
									
									<!-- Modal -->

								</div>
							</div>
						</div>
						<div style="padding: 20px; border: solid 2px rgba(0,10,0,0.2);">	
							<div class="row">	
								<div class="col" style="border-right: solid 2px rgba(0,10,0,0.2);">	
									<center><h5>Rapida atencion</h5></center>
								</div>	
								<div class="col" style="border-right: solid 2px rgba(0,10,0,0.2);">	
									<center><h5>Realizamos envios</h5></center>
								</div>
								<div class="col">	
									<center><h5>Ofrecemos garantia</h5></center>
								</div>
							</div>	
						</div>
						

						<br>

						{{-- @if(($articulo_part->trailer))
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
<<<<<<< HEAD
						@endif --}}
=======
						@endif


						<div>
>>>>>>> 73e3ede248e8fba6269e0c46fac04fe3c71bb58f


						<div>

<<<<<<< HEAD


=======
>>>>>>> 73e3ede248e8fba6269e0c46fac04fe3c71bb58f
						</div>


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
</div>

<div class="modal fade" id="modal_realizarOferta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Realizar oferta</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">	
					<div class="col">
						<center>	
							<h4><b>Precio:</b></h4>

							<input id="client_id" type="text" hidden value="{{Auth::guard('client')->user()->id}}">

							<h4 style="color: gray; opacity: 0.9;">	Tu oferta: <input type="text" name="oferta" id="oferta_ofer" placeholder="$"></h4>
							<br>	
							<br>	
							<h4 style="color: gray; opacity: 0.9;">	Tu contacto: <input type="text" name="oferta" id="telefono_ofer" placeholder="Correo o What'sApp"></h4>
							<br>	
							<br>	
							<button id="dejar_mensaje">
								
								<h4>Dejar mensaje a BumsGames</h4>
							</button>
							<br>	
							<div id="esconder_mensaje" style="display: none;">	
								<button id="btn_esonder">Esconder</button>
								<br>	
								<br>	
								<textarea class="form-control txt_bums" name="oferta_ofer" id="mensaje_cliente" cols="30" rows="3"></textarea>
							</div>
						</center>	
					</div>
					{{-- <div class="col">	
					</div> --}}
				</div>	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="send_oferta">Enviar oferta</button>
			</div>
		</div>
	</div>
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
	$("#dejar_mensaje").click(function (){
		
        // oferta_ofer   
        $("#dejar_mensaje").css("display", "none");
        $("#esconder_mensaje").css("display", "block");
    });

	$("#btn_esonder").click(function (){
		
        // oferta_ofer   
        $("#dejar_mensaje").css("display", "block");
        $("#esconder_mensaje").css("display", "none");
    });



	// $("#dejar_mensaje").click(function (){
	// 	$("#dejar_mensaje").css("display", "block");
	// 	$(this).css("display", "none");
 //        // oferta_ofer    
 //        $('#oferta_ofer').css("display", "none");    
 //    });

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

	function messageLogin() {
		swal('Necesitar iniciar sesión.');
	}
	
	function add_favorite(article_id, cantFavorites) {
		
		console.log('cant de Favorites', cantFavorites);
		if(cantFavorites>=20){
			swal('No puedes añadir mas de 20 productos a favoritos');
			return;
		}
		console.log('article_id', article_id);
		console.log('client_id', $("#client_id").val());

		var route = '/api/favorite';

		var form_data = new FormData();  
		form_data.append('client_id', $("#client_id").val());
		form_data.append('article_id', article_id);
		
		$.ajax({
			url:        route,
			type:       'POST',
			data:       form_data,
			contentType: false, 
			processData: false,

			success:function(data){

				console.log("response", data);
				$("#btnFav").prop( "disabled", true );
				swal("Agregado a favoritos!");
			},				    
			error:function(msj){
				swal("Error!", "Ha sucedido un error, recargue e intente de nuevo", "error");
			}
		});
	}

	$("#send_oferta").click(function(){ 

		var route = '/ofertas_cliente';

		// if( $("#nombre_ofer").val() == ""){
		// 	swal({
		// 		title: "Error!",
		// 		text: "Debes indicar tu nombre en la oferta!",
		// 		icon: "warning",
		// 	});
		// 	return;
		// }
		if( $("#oferta_ofer").val() == ""){
			swal({
				title: "Error!",
				text: "Debes indicar tu oferta!",
				icon: "warning",
			});
			return;
		}
		if( $("#telefono_ofer").val() == ""){
			swal({
				title: "Error!",
				text: "Debes indicar como podemos contactarnos contigo!",
				icon: "warning",
			});
			return;
		}
		
		//alert($("#mensaje_cliente").val());

		var form_data = new FormData();  
		form_data.append('art_ofer', $("#art_ofer").val());
		form_data.append('nombre_ofer', $("#nombre_ofer").val());
		form_data.append('telefono_ofer', $("#telefono_ofer").val());
		form_data.append('oferta_ofer', $("#oferta_ofer").val());
		form_data.append('mensaje_cliente', $("#mensaje_cliente").val());
		form_data.append('client_id', $("#client_id").val());
		
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
					$(".modal-backdrop").remove(); 
					$(".modal").hide();
					$(".modal").trigger("click");
					$("#telefono_ofer").val("");
					$("#oferta_ofer").val("");
					$("#mensaje_cliente").val("");
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