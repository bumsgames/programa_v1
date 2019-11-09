<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BumsGames.com.ve</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="icon" href="img/logo_circular.ico" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ url('css/bums.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/bums_v2.css') }}">
	<script async custom-element="amp-auto-ads"
	src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
	(adsbygoogle = window.adsbygoogle || []).push({
		google_ad_client: "ca-pub-2298464716816209",
		enable_page_level_ads: true
	});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body{
	color: black !important;
	background: white;
}
hr { 
	display: block;
	margin-top: 0.5em;
	margin-bottom: 0.5em;
	margin-left: auto;
	margin-right: auto;
	border-style: inset;
	border-width: 1px;
}

.loader {
	position: fixed;
	left: 40%;
	top: 40%;
	width: 35%;
	height: 30%;
	z-index: 9999;
	background: url('https://www.cognizant.com/content/dam/cognizant_foundation/images/loading.gif') 50% 50% no-repeat rgb(255,255,255);
	opacity: .8;
}


</style>

</head>
<body class="pago_carrito">
	<nav class="navbar navbar-expand-lg navbar-light bg-light menu navBums fixed-top pagonav">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" style="background: white;">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<br>
			<a class="navbar-brand" href="/">
				<img alt="Brand" src="{{ url('img/logobums2.png') }}" width="150">
			</a>
			<br>
			<br>
			
			
		</div>
		<center>
			<h1 style="color: white;">Reporte de Pago.</h1>
		</center>
	</nav>
	<br>
	<br>
	<br>
	<br>	
	<br>	
	<div>
		<div class="box">
			<div class="row">
				<div class="col">
					<div class="container">
						<?php $i = 1; ?>
						<?php $precio = 0; ?>
						@if(Session::has('carrito'))


						@foreach( Session::get('carrito') as $x )

						<?php $precio += $x['precio']; ?>
						

						@endforeach
						@endif
						<?php 
						if(isset($coupon))
							$precio -= $coupon->descuento; ?>
						<div id="1">
							<h1>Facturacion</h1>
							<hr>
							<p>Esta orden expira en 30 minutos. (Los contactaremos via What'sApp lo antes posible una vez procesado su pago).</p>

							<h2>OPCIONES DE PAGO</h2>

							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
										<div class="panel-heading">
											<h4 class="panel-title">
												
												Banesco <img src="img/banesco logo.jpg" alt="" height="30">
											</h4>
										</div>
									</a>
									<div id="collapse1" class="panel-collapse collapse in">
										<div class="panel-body">
											<table class="table">
												<thead>
													<tr>
														<th>Titular</th>
														<th>CI</th>
														<th>Cuenta</th>
														<th>Numero de cuenta</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>David Salazar</th>
														<th>24559480</th>
														<th>Corriente</th>
														<th>01340946310001457909</th>
													</tr>

												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
										<div class="panel-heading">
											<h4 class="panel-title">
												Provincial <img src="img/provincial.png" alt="" height="60">
											</h4>
										</div>
									</a>
									<div id="collapse2" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table">
												<thead>
													<tr>
														<th>Titular</th>
														<th>CI</th>
														<th>Cuenta</th>
														<th>Numero de cuenta</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>Angel Duarte</th>
														<th>24559480</th>
														<th>Corriente</th>
														<th>01080093510100154126</th>
													</tr>

												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
										<div class="panel-heading">
											<h4 class="panel-title">
												Mercantil <img src="img/mercantil.png" alt="" height="30">
											</h4>
										</div>
									</a>
									<div id="collapse3" class="panel-collapse collapse">
										<div class="panel-body">	
											<table class="table">
												<thead>
													<tr>
														<th>Titular</th>
														<th>CI</th>
														<th>Cuenta</th>
														<th>Numero de cuenta</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>Sulay Salazar</th>
														<th>10388731</th>
														<th>Corriente</th>
														<th>01050047801047427362</th>
													</tr>

												</tbody>
											</table></div>
										</div>
									</div>
									<div class="panel panel-default">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
											<div class="panel-heading">
												<h4 class="panel-title">										
													Banco de Venezuela <img src="img/bdv.png" alt="" height="30">
												</h4>
											</div>
										</a>
										<div id="collapse4" class="panel-collapse collapse">
											<div class="panel-body">	
												<table class="table">
													<thead>
														<tr>
															<th>Titular</th>
															<th>CI</th>
															<th>Cuenta</th>
															<th>Numero de cuenta</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th>Sulay Salazar</th>
															<th>10388731</th>
															<th>Corriente</th>
															<th>01020427570000222668</th>
														</tr>

													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
											<div class="panel-heading">
												<h4 class="panel-title">										
													BNC <img src="img/bnc.png" alt="" height="30">
												</h4>
											</div>
										</a>
										<div id="collapse5" class="panel-collapse collapse">
											<div class="panel-body">	
												<table class="table">
													<thead>
														<tr>
															<th>Titular</th>
															<th>CI</th>
															<th>Cuenta</th>
															<th>Numero de cuenta</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th>Alejandro Duarte</th>
															<th>28530657</th>
															<th>Ahorro</th>
															<th>01910047261047026977</th>
														</tr>

													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<a data-toggle="collapse">
											<div class="panel-heading">
												<h5 class="panel-title">										
													PUEDE REALIZAR EL PAGO MEDIANTE OTROS MEDIOS (CONTACTE UN AGENTE BUMSGAMES)
													<img src="img/paypal.png" alt="" height="30"> <img src="img/mp.jpg" alt="" height="30">
													<img src="img/airtm.png" alt="" height="30">
													<img src="img/localbitcoins.png" alt="" height="30">
												</h5>
											</div>
										</a>
									</div>
								</div>
								<br>
								<br>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col"># Orden</th>
											<th scope="col">Creada</th>
											<th scope="col">Vence</th>
											<th scope="col">Monto</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td># {{ $ultimo_pago + 1 }}</td>
											<td>{{ $date->day }} / {{ $date->month }} / {{ $date->year }}</td>
											<td>{{ $date->day }} / {{ $date->month }} / {{ $date->year }}</td>
											<td id="total"><strong>{{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</strong></td>
										</tr>
										@if(!isset($coupon))

										<form method="post" action="/canjear/{{$precio}}">
											{{ csrf_field() }}
											<tr>
												<td></td>
												<td class="cupon">Tengo un cupon:</td>
												<td> <div class="form-group"><input name="cupon" type="text" class="form-control cuponinput" id="cupon" maxlength="12" autocomplete="off" placeholder="Codigo del cupon"> </div>    </td>
												<td><button disabled id="cuponbtn" type="submit" class="btn btn-success">Canjear</button></td>
											</tr>	
										</form>
										@endif

									</tbody>

								</table>
								@if(isset($coupon) )
								<div>
									<h4>Cupon canjeado con exito por la cantidad de: {{ number_format($coupon->descuento * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</h4>
								</div>
								<input id="coupon" type="hidden" value="{{$coupon->id}}">
								@endif
								{!!$errors->first('cupon','<h4 class="help-block">:message</h4>')!!}

							</div>
							<div id="2">
								<h1>Datos del Comprador</h1>
								<hr>
								<small class="form-text text-muted">Entrega de juegos digitales 10 mins a 90 mins luego del pago - Entregas personales colocarlo en nota.</small>
								<br>	

								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="inputEmail4"><strong>Nombre</strong></label>
										<input type="text" class="form-control letras" id="name" maxlength="30" autocomplete="off">
									</div>
									<div class="form-group col-md-4">
										<label for="inputPassword4"><strong>Apellido</strong></label>
										<input type="text" class="form-control letras" id="lastname" maxlength="30" autocomplete="off">
									</div>
									<div class="form-group col-md-4">
										<img src="img/ws.png" height="35" alt="">
										<label for="inputPassword4"><strong>Numero de WhatsApp</strong></label>
										<input type="text" class="form-control ws"	id="ws" maxlength="25" autocomplete="off">
										<small class="form-text text-muted">Solo nos comunicamos a traves de WhatsApp.</small>
									</div>
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1"><strong>Nota adicional.</strong></label>
									<textarea id="nota_adicional" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="3"></textarea>
								</div>
								<div id="envio">
									<div class="form-group">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="gridCheck">
											<label class="form-check-label" for="gridCheck">
												Incluye envio (Solo articulos fisicos).
											</label>
											<small class="form-text text-muted">Solo hacemos envios en Venezuela - Los envios se hacen 1 o 2 dias habiles luego de su respectivo pago.</small>
										</div>
									</div>
									<div id="form-envio">
										<hr>	
										<h4>Datos de envio</h4>
										<hr>
										<br>	
									{{-- <div class="form-group">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="gridCheck">
											<label class="form-check-label" for="gridCheck">
												Envio premium (El envio sale al siguiente dia habil), 0.5$
											</label>
										</div>
									</div> --}}
									<strong><label for="">Empresa para realizar el envio:</label></strong>
									<select class="form-control form-control-sm" id="select1">
										<option value="1">Tealca</option>
										<option value="2">Domesa</option>
									</select>
									<small class="form-text text-muted">Los envios solo se realizan mediante estas 2 empresas.</small>
									<br>
									<div class="form-row">
										<div class="form-group col-md-3">
											<label for="inputEmail4"><strong>Destinario</strong></label>
											<input type="text" class="form-control letras" id="destinario">
											<small class="form-text text-muted">Obligatorio</small>
										</div>
										<div class="form-group col-md-3">
											<label for="inputPassword4"><strong>Documento de Identidad</strong></label>
											<input type="number" class="form-control" id="cedula_destinario">
											<small class="form-text text-muted">Obligatorio</small>
										</div>
										<div class="form-group col-md-3">
											<label for="inputPassword4"><strong>Oficina o Direccion</strong></label>
											<input type="textarea" class="form-control" id="direccion_destinario">
											<small class="form-text text-muted">Obligatorio</small>
										</div>
										<div class="form-group col-md-3">
											<label for="inputPassword4"><strong>Numero Telefonico</strong></label>
											<input type="text" class="form-control ws" id="numero_destinario">
											<small class="form-text text-muted">Obligatorio</small>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="3">
							<h1>Reportar pago</h1>
							<hr>
							
							<br>
							<br>				
							<strong>Tipo de Pago:</strong> 
							<select class="form-control form-control-sm" id="select2">
								<option value="1">Transferencia del mismo Banco</option>
								<option value="2">Transferencia de otro Banco</option>
							</select>
							<br>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="exampleInputEmail1"><strong>Banco Emisor:</strong></label>
									<input type="text" class="form-control" id="banco_emisor">
									<small id="emailHelp" class="form-text text-muted">Obligatorio</small>
								</div>
								<div class="form-group col-md-4">
									<label for="exampleInputEmail1"><strong>Cedula del titular</strong></label>
									<input type="text" class="form-control" id="cedula_titular">
									<small id="emailHelp" class="form-text text-muted">Obligatorio.</small>
								</div>
								<div class="form-group col-md-4">
									<label for="exampleInputEmail1"><strong>Numero de Referencia</strong></label>
									<input type="number" class="form-control" id="referencia">
									<small id="emailHelp" class="form-text text-muted">Ogligatorio.</small>
								</div>
							</div>



							<div class="form-group">
								<label for="exampleInputEmail1"><strong>Fecha:</strong></label>
								<input type="date" class="form-control" id="fecha">
								<small id="emailHelp" class="form-text text-muted">Ogligatorio.</small>
							</div>

							<div class="form-group">
								<label for="exampleFormControlFile1"><strong>Capture de la transferencia</strong></label>
								<input type="file" class="form-control-file" id="image">
							</div>



							<div class="form-group">
								<label for="exampleInputEmail1"><strong>Monto:</strong></label>

								<input type="text" class="form-control" disabled="" id="monto" value="{{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}">
							</div>
							<br>


						</div>

						<div id="4">
							<h1>Parte Final</h1>
							<hr>

							<br>
							<label for="exampleInputEmail1"><strong>Comprador:</strong></label>
							<input type="text" class="form-control" id="campo1" disabled="">
							<small id="emailHelp" class="form-text text-muted">Obligatorio</small>
							<br>

							<img src="img/ws.png" height="35" alt="">
							<label for="inputPassword4"><strong>Numero de What'sApp:</strong></label>
							<input type="text" class="form-control"	id="campo2" maxlength="30" autocomplete="off" disabled="">
							<small id="emailHelp" class="form-text text-muted">Solo nos comunicamos a traves de WhatsApp.</small>

							<br>
							<label for="exampleInputEmail1"><strong>Banco Emisor:</strong></label>
							<input type="text" class="form-control" id="campo3" disabled="">

							<br>
							<label for="exampleInputEmail1"><strong>Numero de referencia:</strong></label>
							<input type="text" class="form-control" id="campo4" disabled="">

							<br>
							<div class="form-group">
								<label for="exampleInputEmail1"><strong>Monto:</strong></label>
								<input type="text" class="form-control" disabled="" value="{{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}">
							</div>


						</div>
						<br>	
						<center>

							<button type="button" class="btn btn-success" id="b1">Siguiente <i class="fa fa-angle-right" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-dark" id="a2"><i class="fa fa-angle-left" aria-hidden="true"></i> Atras</button>
							<button type="button" class="btn btn-success" id="b2">Siguiente <i class="fa fa-angle-right" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-dark" id="a3"><i class="fa fa-angle-left" aria-hidden="true"></i> Atras</button>
							<button type="button" class="btn btn-success" id="b3">Siguiente <i class="fa fa-angle-right" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-dark" id="a4"><i class="fa fa-angle-left" aria-hidden="true"></i> Atras</button>
							<div class="loader" style="display: none;"></div>
							{{-- <button type="button" class="btn btn-success" id="b4">PAGAR <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button> --}}

							<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">

						</center>
						<br>
						<br>
					</div>	
				</div>
				<div class="col-12 col-lg-5">
					<div class="container">
						<h1>Factura</h1>
						<hr>
						<p>Modifique su compra en <a href="www.bumsgames.com.ve">www.bumsgames.com.ve</a></p>

						<table class="table table-hover" id="tablaCarrito">
							<tbody>
								<?php $i = 1; ?>
								<?php $precio = 0; ?>
								@if(Session::has('carrito'))


								@foreach( Session::get('carrito') as $x )
								<tr>
									<th>
										<?php echo $i++; ?>
									</th>
									<td>
										<input type='text' class='id_articulo' value='{{ $x['id'] }}' hidden="">
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
											{{-- <span aria-hidden="true">&times;</span> --}}
										</button>
									</td>

								</tr>

								@endforeach
								<?php 
								if(isset($coupon) && ($coupon->descuento < $precio))
									$precio -= $coupon->descuento; ?>
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
						<br>
					</div>
				</div>
			</div>

		</div>


	</div>
	<br>	
	<br>
	<br>	
	<br>
	<br>	
	<br>	
	<br>	
	<br>
	<br>	
	<br>

	<button type="button" class="btn btn-success" id="b4">PAGAR <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>

	<footer class="page-footer font-small cyan darken-3 foot1" style="color: white !important;">
		<div class="container">
			<br>
			<br>
			<div class="row">
				<a href="/pagina">

					<div class="col">

						<img alt="Brand" src="{{ url('img/logobums2.png') }}" width="175">
					</div>
				</a>
				<div class="col escondite">
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
							<!--Yohan Franco (Brasil).-->
							<!--<br>-->
							<!--<i class="fab fa-whatsapp fa-2x"></i> -->
							<!--(+58) 414-772-74-21-->
							<!--<br>	-->
							<!--<br>-->
							Nestor Rojas (Argentina).
							<br>
							<i class="fab fa-whatsapp fa-2x"></i> 
							(+54) 9 11-3359-36-81

							<br>
							<br>
						</div>
					</div>



				</div>
			</div>
		</div>

		<div class="footer-copyright text-center py-3 foot2">Llegamos para hacer la diferencia.
			<a href="https://mdbootstrap.com/bootstrap-tutorial/"> BumsGames.com.ve</a>
		</div>
	</footer>
	<script
	src="https://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{ url('js/bums.js') }}"></script>

	<script>
		$(document).ready(function(){

			$('#2').hide();
			$('#3').hide();
			$('#4').hide();
			$('#b2').hide();
			$('#b3').hide();
			$('#b4').hide();
			$('#b5').hide();
			$('#a2').hide();
			$('#a3').hide();
			$('#a4').hide();
			$('#form-envio').hide();

			$('.ws').on('input', function () { 
				this.value = this.value.replace(/[^0-9+]/g,'');
			});

			$("#b1").on( "click", function() {
				$('#1').hide();
				$('#1').hide();
				$('#b1').hide();
				$('#2').show();
				$('#a2').show();
				$('#b2').show();
			});

			$('.letras').keyup(function(){
				var nombre = $(this);
				nombre.val( nombre.val().replace(/[0-9]/g, function(str) { return ''; } ) );
			});

			$("#b2").on( "click", function() {
				if($('#name').val().length >= 1 && $('#lastname').val().length >= 1 && $('#ws').val().length >= 1){
					if(!($("#gridCheck").is(':checked'))){
						$('#2').hide();
						$('#a2').hide();
						$('#b2').hide();
						$('#a3').show();
						$("#3").show();
						$('#b3').show();
					}else{
						if($('#destinario').val().length >= 1 &&
							$('#cedula_destinario').val().length >= 1 &&
							$('#direccion_destinario').val().length >= 1 &&
							$('#numero_destinario').val().length >= 1){

							$('#2').hide();
						$('#a2').hide();
						$('#b2').hide();
						$('#a3').show();
						$("#3").show();
						$('#b3').show();

					}else{
						alert('Tiene un campo vacio en la parte de Envio.');
					}

				}
			}else{
				swal('Tiene un campo vacio en sus Datos de Personales.');
			}
		});

			$("#b3").on( "click", function() {
				if($('#banco_emisor').val().length >= 1 && 
					$('#cedula_titular').val().length >= 1 && 
					$('#referencia').val().length >= 1){

					if(!($('#image').prop('files')[0])){
						alert("Por favor, colocar el capture del Pago.");
						return;
					}

					if(($("#fecha").val() == '')){
						alert("Coloque la fecha en la que realizo el Pago.");
						return;
					}

					$('#3').hide();
					$('#a3').hide();
					$('#b3').hide();
					$('#a4').show();
					$("#4").show();
					$('#b4').show();
					$("#campo1").val($('#name').val()+" "+$('#lastname').val());
					$("#campo2").val($('#ws').val());
				//banco emisor
				$("#campo3").val($('#banco_emisor').val());
				//numero de referencia
				$("#campo4").val($('#referencia').val());

			}else{
				alert('Tiene un campo vacio');
			}
		});

			$("#a2").on( "click", function() {
				$('#2').hide();
				$('#b2').hide();
				$('#a2').hide();
				$('#1').show();
				$('#b1').show();
			});

			$("#a3").on( "click", function() {
				$('#3').hide();
				$('#b3').hide();
				$('#a3').hide();
				$('#a2').show();
				$('#2').show();
				$('#b2').show();
			});

			$("#a4").on( "click", function() {
				$('#4').hide();
				$('#b4').hide();
				$('#a4').hide();
				$('#a3').show();
				$('#3').show();
				$('#b3').show();
			});
		});

		$('#gridCheck').on('change',function(){
			if (this.checked) {
				$('#form-envio').show();
			} else {
				$('#form-envio').hide();
			}  
		});
		$('#cupon').keyup(function () {
			if ($('#cupon').val().length == 12) {
				$('#cuponbtn').prop('disabled', false);
			} else {
				$('#cuponbtn').prop('disabled', true);
			}
		});
		$("#b4").on("click", function(){
			var token = $('#token').val(); 
			var form_data = new FormData();
			var temp_id = 0;
			let id_articulo = document.querySelectorAll('.id_articulo');
			var id_array = new Array();

			for (var i = 0; i <id_articulo.length; i++) {
				id_array.push(Number(id_articulo[i].value));
			}


			form_data.append('id_articulo', JSON.stringify(id_array));


			// alert(token);
			// // cliente
			form_data.append('name', $('#name').val());
			form_data.append('lastname', $('#lastname').val());
			form_data.append('ws', $('#ws').val());
			form_data.append('nota_adicional', $('#nota_adicional').val());
			

			// alert(form_data);

			// envio
			if($("#gridCheck").is(':checked')){
				form_data.append('envio', 1);
				form_data.append('empresa', $( "#select1 option:selected" ).text());
				form_data.append('destinario', $('#destinario').val());
				form_data.append('cedula_destinario', $('#cedula_destinario').val());
				form_data.append('direccion', $('#direccion_destinario').val());
				form_data.append('telefono', $('#numero_destinario').val());
			}





			// pago
			form_data.append('tipo_trans', $( "#select2 option:selected" ).text());
			form_data.append('banco', $('#banco_emisor').val());
			form_data.append('cedula', $('#cedula_titular').val());
			form_data.append('referencia', $('#referencia').val());
			form_data.append('fecha', $('#fecha').val());
			form_data.append('image', $('#image').prop('files')[0]);
			form_data.append('monto', $('#monto').val());

			if($('#coupon').val() > 0){
				form_data.append('id_cupon',$('#coupon').attr('value'));
			}


			var route = '/reportar_pago';

			$.ajax({
				url:        route,
				headers:    {'X-CSRF-TOKEN':token},
				type:       'POST',
				enctype: 'multipart/form-data',
				dataType:   'json',
				data:       form_data,
				contentType: false, 
				processData: false,

				beforeSend: function() {
					$(".loader").show();
				},
				success:function(data){
					if(data.tipo == 1){
						swal(data.data);  
					}
					alert('bien');
					// else{
					// 	swal('Su pago se ha enviado con exito amig@: '+$('#name').val()+" "+$('#lastname').val());
					// 	setTimeout(function() {
					// 		window.close();	
					// 	}, 4000);
					// }
				},
				error:function(msj){
					var errormessages = "";
					$.each(msj.responseJSON, function(i, field){
						errormessages+="\n"+field+"\n";
					});
					swal("Error.", "Revisa los datos suministrados. \n\n"+errormessages+"\n\n", "error");
					
				},

			});

		});
	</script>

</body>






</html>

