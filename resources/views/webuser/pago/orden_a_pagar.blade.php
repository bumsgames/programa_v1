<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BumsGames.com.ve</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
	crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="icon" href="img/logo_circular.ico" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ url('css/bums.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/bums_v2.css') }}">
	<script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">

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
	body {
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
		background: url('https://www.cognizant.com/content/dam/cognizant_foundation/images/loading.gif') 50% 50% no-repeat rgb(255, 255, 255);
		opacity: .8;
	}
</style>

</head>

<body class="pago_carrito">
	<nav class="navbar navbar-expand-lg navbar-light bg-light menu navBums fixed-top pagonav">
		<a class="navbar-brand" href="/">
			<img alt="Brand" src="{{ url('img/logo.png') }}" width="100">
		</a>


		<center>
			<h1 class="escondite" style="color: white;">Reporte de Pago</h1>
		</center>
	</nav>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>	
	<br>	
	<br>	
	<div class="container shadow_ligero border_ligero" style="width:80%; border-radius: 20px; ">
		<br>	
		<div class="row">
			<div class="col">
				<?php $i = 1; ?>
				<?php $precio = 0; ?> 
				@if(Session::has('carrito')) 
				@foreach( Session::get('carrito') as $x )
				<?php $precio += $x['precio']; ?> 
				@endforeach 
				@endif
				<?php 
				if(isset($coupon))
					$precio -= $coupon->descuento; 
				?>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active" id="b_20" aria-current="page">Carrito</li>
						<li class="breadcrumb-item" id="b_40">Opciones de pago</li>
						<li class="breadcrumb-item" id="b_60">Datos del Comprador</li>
						<li class="breadcrumb-item" id="b_80">Reportar pago</li>
						<li class="breadcrumb-item" id="b_100">Resumen de Pago</li>
					</ol>
				</nav>
				<div id="carousel_pago" class="carousel slide" data-ride="carousel">
					<div class="progress">
						<div class="progress-bar" id="pago-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<div class="card text-center card-main-pago">
								<div class="card-header">
									<h2>Carrito de Compras</h2>
								</div>	
								
								<div class="card-body card-pago">
									<div class="container">
										<div class="row">
											<div class="col-12 col-xl-10 offset-xl-1 table-responsive">
												<p>Modifique su compra en <a href="www.bumsgames.com.ve">www.bumsgames.com.ve</a></p>
												<table class="table" id="tablaCarrito" style="border: none !important;">
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
																<img src="{{asset('img/'.$x['imagen'])}}" width="40" height="45" alt="">
															</td>
															<td class="text-left">
																<input type='text' class='id_articulo' value='{{ $x['id'] }}' hidden="">
																<strong>{{ $x['articulo'] }}</strong> <br> {{ $x['categoria'] }}
															</td>
															<td class="text-right">
																{{ number_format($x['precio'] * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
																<?php $precio += $x['precio']; ?>
															</td>
															<td>
																<button type="button" style="color:black;" class="close" onclick="borrarElementoCarritoPago({{ $i - 1 }}, {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');">
																	<span aria-hidden="true">&times;</span>
																</button>
															</td>
														</tr>
														@endforeach
														<?php 
														if(isset($coupon) && ($coupon->descuento < $precio))
															$precio -= $coupon->descuento; ?> 
														@endif
														<tr>
															<td colspan="2"></td>
															<td class="text-left">
																TOTAL
															</td>
															<td class="text-right">
																<strong> {{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</strong>
															</td>
														</tr>
													</tbody>
												</table>
												
												<br>
											</div>
										</div>
									</div>
								</div>
								@if(!isset($coupon))
								<center>	
									<form method="post" action="/canjear/{{$precio}}">
										{{ csrf_field() }}
										<small>*Al canjear el cupon no podras quitar ningun producto del carrito</small>
										<div class="col-12 col-lg-2">
											<div class="cupon">Tengo un cupon:</div>

										</div>
										<div class="col-12 col-lg-2">
											<div class="form-group"><input name="cupon" type="text" class="form-control cuponinput border_ligero" id="cupon" maxlength="12" autocomplete="off"
												placeholder="Codigo del cupon"> </div>

											</div>
											<div class="col-12 col-lg-2">
												<button id="cuponbtn" type="submit" class="btn btn-success">Canjear</button>
											</div>

										</form>
									</center>
									<br>	
									@endif 
									@if(isset($coupon) )
									<div>
										<div class="alert alert-success" role="alert">
											Cupon canjeado con exito por la cantidad de: {{ number_format($coupon->descuento * $moneda_actual->valor, 2, ',', '.')}}
											{{ $moneda_actual->sign }}
											<button style="color:black" type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									</div>
									<input id="coupon" type="hidden" value="{{$coupon->id}}"> 
									@endif {!!$errors->first( 'cupon', '
										<div class="alert alert-danger" role="alert">
										:message
										<button style="color:black" type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>') !!}
									<div class="card-footer text-muted">
										<a href="#carousel_pago" data-slide="next" class="btn btn-info btn-pago float-right mt-responsive" onclick="actualizarbarra(40)">Siguiente <span class="fa fa-lg fa-arrow-circle-right"></span></a>
									</div>
								</div>
							</div>
							<!--Carrito de compras-->
							<div class="carousel-item">
								<div class="card text-center card-main-pago">
									<div class="card-header">
										<h2>Opciones de Pago</h2>
										<p>Esta orden expira en 30 minutos. (Los contactaremos via What'sApp lo antes posible una vez procesado su pago).</p>
									</div>
									<div class="clase_que_no_existe card-pago">
										<div class="clase_que_no_existe">
											<div class="clase_que_no_existe">
												<div class="clase_que_no_existe">
													<div id="accordianId" role="tablist" aria-multiselectable="true">
														@foreach ($todas_las_monedas as $moneda)
														<a data-toggle="collapse" data-parent="#accordianId" href="#{{$moneda->coin }}" aria-expanded="true" aria-controls="{{ $moneda->coin }}">
															<div class="card-header border_ligero card-cuentas" role="tab" id="section1HeaderId">
																<h3 class="mb-0">
																	Opciones de pago en {{ $moneda->coin }} ({{ $moneda->sign }})
																</h3>
															</div>
														</a>
														<br>	
														<br>	
														<div id="{{$moneda->coin}}" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
															<div class="card-body card-pago">
																<div class="row">
																	@foreach (	$moneda->cuentas_bancarias as $cuentas_bancaria)
																	<div class="col-12 col-lg-6">
																		<div class="card">
																			<center>
																				<img class="escondite" width="170" 
																				src="{{asset('img/bums'.$cuentas_bancaria->banco)}}" alt="">
																			</center>
																			<h2 class="card-title">{{ $cuentas_bancaria->banco }}</h2>
																			<h4>	
																				{{--  --}}
																				@if ($cuentas_bancaria->tipo_cuenta)
																				Tipo de cuenta: {{ $cuentas_bancaria->tipo_cuenta }}
																				@endif
																				<br>
																				<br>
																				{{--  --}}
																				@if ($cuentas_bancaria->titular)
																				Titular: {{ $cuentas_bancaria->titular }}
																				@endif
																				<br>
																					<br>
																				@if ($cuentas_bancaria->cedula)
																				Cedula: {{ $cuentas_bancaria->cedula }}
																				@endif

																				<br>
																				<br>	
																				@if ($cuentas_bancaria->cuentaBancaria)
																				{{ $cuentas_bancaria->cuentaBancaria	 }}
																				@endif
																				<br>	
																				<br>
																				@if ($cuentas_bancaria->nota)
																				Nota: {{ $cuentas_bancaria->nota	 }}
																				@endif
																			</h4>

																		</div>
																	</div>

																	@endforeach
																	
																</div>
															</div>
														</div>
														@endforeach
														<div class="card" >
															<a data-toggle="collapse" data-parent="#accordianId" href="#section2ContentId" aria-expanded="true" aria-controls="section2ContentId" >
																<div class="card-header border_ligero card-cuentas" role="tab" id="section2HeaderId">
																	<h4 class="mb-0">
																		Otros metodos de pagos
																	</h4>
																</div>
															</a>
															<div id="section2ContentId" class="collapse in" role="tabpanel" aria-labelledby="section2HeaderId">
																<div class="card-body card-pago">
																	<h5 class="h5-responsive">
																		PUEDE REALIZAR EL PAGO MEDIANTE OTROS MEDIOS (CONTACTE UN AGENTE BUMSGAMES) <br>
																		<br>	
																		<img src="{{asset('img/paypal.png')}}" alt="" height="30"> <img src="img/mp.jpg" alt="" height="30">
																		<img src="{{asset('img/airtm.png')}}" alt="" height="30">
																		<img src="{{asset('img/localbitcoins.png')}}" alt="" height="30">
																	</h5>
																</div>
															</div>
														</div>
													</div>
													<h3>	
														<center>
															Total a Pagar <strong id="actualizar"> {{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</strong>
														</center>
													</h3>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer text-muted">
										<a href="#carousel_pago" data-slide="prev" class="btn btn-info btn-pago float-left" onclick="actualizarbarra(20)"><span class="fa fa-lg fa-arrow-circle-left"></span> Anterior</a>
										<a href="#carousel_pago" data-slide="next" class="btn btn-info btn-pago float-right mt-responsive" onclick="actualizarbarra(60)">Siguiente <span class="fa fa-lg fa-arrow-circle-right"></span></a>
									</div>
								</div>
							</div>
							<!--Metodos de pago-->
							<div class="carousel-item">
								<div class="card text-center card-main-pago">
									<div class="card-header">
										<h4>Datos del Comprador</h4>
									</div>
									<div class="card-body card-pago">
										<div class="container">
											<div class="row">
												<div class="col-12 col-xl-10 offset-xl-1">
													<div class="alert alert-warning alert-dismissible fade show alert-vacio" role="alert" style="display:none">
														<strong>Campo vacio!</strong> Has dejado un campo vacio.
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<p style="font-size: 20px;" class="form-text text-muted">*Entrega de juegos digitales 10 mins a 90 mins luego del pago* - Entregas personales colocarlo en nota.</p>
													<br>

													<div class="form-row">
														<div class="form-group col-lg-4">
															<label for="inputEmail4"><strong>Nombre</strong></label>
															<input type="text" onkeyup="comprodesbloqueo60()" class="form-control letras border_ligero" id="name" maxlength="30" autocomplete="off">
														</div>
														<div class="form-group col-lg-4">
															<label for="inputPassword4"><strong>Apellido</strong></label>
															<input type="text" onkeyup="comprodesbloqueo60()" class="form-control letras border_ligero" id="lastname" maxlength="30" autocomplete="off">
														</div>
														<div class="form-group col-lg-4">
															<img src="{{asset('img/ws.png')}}" height="35" alt="">
															<label for="inputPassword4"><strong>Numero de WhatsApp</strong></label>
															<input type="text" onkeyup="comprodesbloqueo60()" class="form-control ws border_ligero" id="ws" maxlength="25" autocomplete="off">
															<small class="form-text text-muted">Solo nos comunicamos a traves de WhatsApp.</small>
														</div>
													</div>
													<div class="form-group">
														<label for="exampleFormControlTextarea1"><strong>Nota adicional.</strong></label>
														<textarea id="nota_adicional" class="form-control border_ligero rounded-0" id="exampleFormControlTextarea1" rows="3"></textarea>
													</div>
													<div id="envio">
														<div class="form-group">
															<div class="form-check" style="font-size: 25px;">
																<input class="form-check-input" onchange="comprodesbloqueo60()" type="checkbox" id="gridCheck">
																<label class="form-check-label" for="gridCheck">
																	Incluye envio (Solo articulos fisicos).
																</label>
																<small class="form-text text-muted">Solo hacemos envios en Venezuela.</small>
															</div>
														</div>
														<div id="form-envio">
															<br>
															<h4>Datos de envio</h4>
															<br>
															<br>
															<strong><label for="">Empresa para realizar el envio:</label></strong>
															<select class="form-control border_ligero" id="select1">
																<option value="1">Tealca</option>
																<option value="2">Domesa</option>
																<option value="3">Zoom</option>
															</select>
															<small class="form-text text-muted" style="font-size: 20px;">Cualquier informacion adicional, coloquela en la parte de nota.</small>
															<br>
															<div class="form-row">
																<div class="form-group col-lg-6">
																	<label for="inputEmail4"><strong>Destinatario</strong></label>
																	<input onkeyup="comprodesbloqueo60()" type="text" class="form-control letras border_ligero" id="destinario">
																	<small class="form-text text-muted">Obligatorio</small>
																</div>
																<div class="form-group col-lg-6">
																	<label for="inputPassword4"><strong>Documento de Identidad</strong></label>
																	<input onkeyup="comprodesbloqueo60()" type="number" class="form-control border_ligero" id="cedula_destinario">
																	<small class="form-text text-muted">Obligatorio</small>
																</div>
																<div class="form-group col-lg-6">
																	<label for="inputPassword4"><strong>Oficina o Direccion</strong></label>
																	<input onkeyup="comprodesbloqueo60()" type="textarea" class="form-control border_ligero" id="direccion_destinario">
																	<small class="form-text text-muted">Obligatorio</small>
																</div>
																<div class="form-group col-lg-6">
																	<label for="inputPassword4"><strong>Numero Telefonico</strong></label>
																	<input onkeyup="comprodesbloqueo60()" type="text" class="form-control ws border_ligero" id="numero_destinario">
																	<small class="form-text text-muted">Obligatorio</small>
																</div>
															</div>
														</div>
													</div>
													<div class="alert alert-warning alert-dismissible fade show alert-vacio" role="alert" style="display:none">
														<strong>Campo vacio!</strong> Has dejado un campo vacio.
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer text-muted">
										<a href="#carousel_pago" data-slide="prev" class="btn btn-info btn-pago float-left" onclick="actualizarbarra(40)"><span class="fa fa-lg fa-arrow-circle-left"></span> Anterior</a>
										<a href="javascript:void(0)" onclick="comprocontinuar60()" id="bs_60" class="btn btn-info btn-pago float-right mt-responsive disabled">Siguiente <span class="fa fa-lg fa-arrow-circle-right"></span></a>
									</div>
								</div>
							</div>
							<!--Datos del comprador-->
							<div class="carousel-item">
								<div class="card text-center card-main-pago">
									<div class="card-header">
										<h4>Reportar Pago</h4>
									</div>
									<div class="card-body card-pago">
										<div class="container">
											<div class="row">
												<div class="col-12 col-xl-10 offset-xl-1">
													<div class="alert alert-warning alert-dismissible fade show alert-vacio" role="alert" style="display:none">
														<strong>Campo vacio!</strong> Has dejado un campo vacio.
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<br>
													<br>
													<strong>Tipo de Pago:</strong>
													<select class="form-control border_ligero" id="select2">
														<option value="1">Transferencia del mismo Banco</option>
														<option value="2">Transferencia de otro Banco</option>
													</select>
													<br>

													<div class="form-row">
														<div class="form-group col-lg-12">
															<label for="exampleInputEmail1"><strong>Banco Emisor:</strong></label>
															<input onkeyup="comprodesbloqueo80()" type="text" class="form-control border_ligero" id="banco_emisor">
															<small id="emailHelp" class="form-text text-muted " style="color: red !important;">Obligatorio</small>
														</div>
														<div class="form-group col-lg-12">
															<label for="exampleInputEmail1"><strong>Cedula del titular</strong></label>
															<input onkeyup="comprodesbloqueo80()" type="text" class="form-control border_ligero" id="cedula_titular">
															<small id="emailHelp" class="form-text text-muted" style="color: red !important;">Obligatorio.</small>
														</div>
														<div class="form-group col-lg-12">
															<label for="exampleInputEmail1"><strong>Numero de Referencia</strong></label>
															<input onkeyup="comprodesbloqueo80()" type="number" class="form-control border_ligero" id="referencia">
															<small id="emailHelp" class="form-text text-muted" style="color: red !important;">Obligatorio.</small>
														</div>
													</div>



													<div class="form-group">
														<label for="exampleInputEmail1"><strong>Fecha:</strong></label>
														<input onchange="comprodesbloqueo80()" type="date" class="form-control border_ligero" id="fecha">
														<small id="emailHelp" class="form-text text-muted" style="color: red !important;">Obligatorio.</small>
													</div>

													<div class="form-group">
														<label for="exampleFormControlFile1"><strong>Capture de la transferencia</strong></label>
														<input onchange="comprodesbloqueo80()" type="file" class="form-control-file" id="image">
														
													</div>




													<div class="form-group">
														<label for="exampleInputEmail1"><strong>Monto:</strong></label>

														<input type="text" class="form-control" disabled="" id="monto" value="{{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}">
													</div>
													<br>

													<div class="alert alert-warning alert-dismissible fade show alert-vacio" role="alert" style="display:none">
														<strong>Campo vacio!</strong> Has dejado un campo vacio.
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer text-muted">
										<a href="#carousel_pago" data-slide="prev" class="btn btn-info btn-pago float-left" onclick="actualizarbarra(60)"><span class="fa fa-lg fa-arrow-circle-left"></span> Anterior</a>
										<a href="javascript:void(0)" onclick="comprocontinuar80()" id="bs_80" class="btn btn-info btn-pago float-right mt-responsive disabled">Siguiente <span class="fa fa-lg fa-arrow-circle-right"></span></a>
									</div>
								</div>
							</div>
							<!--Datos del comprador-->
							<div class="carousel-item">
								<div class="card text-center card-main-pago">
									<div class="card-header">
										<h4>Resumen de Pago</h4>
									</div>

									<div class="row">
										<div class="col-12 col-xl-8 offset-xl-2">
											<h6 style="color: gray;">*Confirme sus datos antes de continuar*</h6>

											<style>
											.pago_section {
												background-color: #009688;
												padding: 10px 10px;
												color: white;
												width: 90%;
												margin-bottom: 0;
												display: inline-block;
											}

											.pago_section_title {
												background-color: #009688;
												padding: 10px 5px;
												color: white;
												width: 100%;
												display: inline-block;
											}

											.right_triangle {
												margin-bottom: -14px;
												border-top: 47px solid #009688;
												border-right: 45px solid transparent;
												display: inline-block;
											}

											.reporte-container {
												border-radius: 5px;
												border: 2px solid #009688;
											}
										</style>
										<div class="container-fluid text-left">
											<div class="row">
												<div class="col-12 reporte-container">
													<h4 class="pago_section mt-2">ARTICULOS COMPRADOS</h4><span class="right_triangle"></span>
													<hr>
													<div class="row">
														<div class="col-12">
															<div id="articulos_div">

																@foreach(Session::get('carrito') as $x)
																<div class="card mb-3" style="max-width: 100%;max-height:510px">
																	<div class="row no-gutters">
																		<div class="col-md-4">
																			<img src="{{asset('img/'.$x['imagen'])}}" class="card-img" alt="..." >
																		</div>
																		<div class="col-md-8">
																			<div class="card-body">
																				<h5 style="margin-bottom:0" class="card-title">
																					{{$x['articulo']}}
																				</h5>
																				<p style="margin-bottom:0" class="card-text">
																					{{$x['categoria']}}
																				</p>
																				<p class="card-text">
																					<span>
																						Precio: {{ number_format($x['precio'] * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
																					</span>
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
																@endforeach
															</div>
														</div>
													</div>
													@if(isset($coupon) && ($coupon->descuento
														< $precio)) <h4 class="pago_section">CODIGO DE DESCUENTO</h4><span class="right_triangle"></span>
														<hr>
														<div class="row">
															<div class="col-12 col-lg-4">
																<span>Monto del cupon aplicado ($)</span>
															</div>
															<div class="col-12 col-lg-6">
																{{$coupon->descuento}}
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-12 col-lg-4">
																<span>Codigo</span>
															</div>
															<div class="col-12 col-lg-6">
																{{$coupon->codigo}}
															</div>
														</div>
														<br> 
														@endif
														<h4 class="pago_section">TOTAL COMPRA</h4><span class="right_triangle"></span>
														<hr>
														<div class="row">
															<div style="font-weight: bold;" class="col-12 col-lg-4">
																<h5 >Total</h5>
															</div>
															<div class="col-12 col-lg-6">
																<h5>{{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</h5>
															</div>
														</div>
														<br>
														<h4 class="pago_section">DATOS DEL CLIENTE</h4><span class="right_triangle"></span>
														<hr>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span>Nombre del cliente</span>
															</div>
															<div class="col-12 col-lg-6">
																<span id="conf_nombre"></span>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span>WhatsApp</span>
															</div>
															<div class="col-12 col-lg-6">
																<span id="conf_ws"></span>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span>Nota Adicional</span>
															</div>
															<div class="col-12 col-lg-6">
																<span id="conf_nota"></span>
															</div>
														</div>
														<br>
														<h4 class="pago_section">DATOS DEL PAGO</h4><span class="right_triangle"></span>
														<hr>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span>Tipo de pago</span>
															</div>
															<div class="col-12 col-lg-6">
																<span style="text-transform: capitalize;" id="tipo_pago"></span>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span>Banco</span>
															</div>
															<div class="col-12 col-lg-6">
																<span style="text-transform: capitalize;" id="pago_banco"></span>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span>Cedula</span>
															</div>
															<div class="col-12 col-lg-6">
																<span style="text-transform: capitalize;" id="pago_cedula"></span>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span># de referencia</span>
															</div>
															<div class="col-12 col-lg-6">
																<span style="text-transform: capitalize;" id="pago_referencia"></span>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span>Monto</span>
															</div>
															<div class="col-12 col-lg-6">
																<span style="text-transform: capitalize;" id="pago_monto"></span>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-12 col-lg-4" style="font-weight: bold;">
																<span>Fecha</span>
															</div>
															<div class="col-12 col-lg-6">
																<span style="text-transform: capitalize;" id="pago_fecha"></span>
															</div>
														</div>
														<br>
														<div id="envio_div">
															<h4 class="pago_section">DATOS DE ENVIO</h4><span class="right_triangle"></span>
															<hr>
															<div class="row">
																<div class="col-12 col-lg-4" style="font-weight: bold;">
																	<span>Empresa</span>
																</div>
																<div class="col-12 col-lg-6">
																	<span style="text-transform: capitalize;" id="envio_emp"></span>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-12 col-lg-4" style="font-weight: bold;">
																	<span>Destinatario</span>
																</div>
																<div class="col-12 col-lg-6">
																	<span style="text-transform: capitalize;" id="envio_des"></span>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-12 col-lg-4" style="font-weight: bold;">
																	<span>Cedula</span>
																</div>
																<div class="col-12 col-lg-6">
																	<span style="text-transform: capitalize;" id="envio_ced"></span>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-12 col-lg-4" style="font-weight: bold;">
																	<span>Dirección</span>
																</div>
																<div class="col-12 col-lg-6">
																	<span style="text-transform: capitalize;" id="envio_dir"></span>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-12 col-lg-4" style="font-weight: bold;">
																	<span>Teléfono</span>
																</div>
																<div class="col-12 col-lg-6">
																	<span style="text-transform: capitalize;" id="envio_tel"></span>
																</div>
															</div>
															<br>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
								<br>	

								<div class="card-footer text-muted" style="background: rgba(0,10,0,0.4); height: 80px;">
									<a href="#carousel_pago" data-slide="prev" class="btn btn-info btn-pago float-left" onclick="actualizarbarra(80)"><span class="fa fa-lg fa-arrow-circle-left"></span> Anterior</a>
									<a href="javascript:void(0)" id="bs_100" class="btn btn-success btn-pago float-right mt-responsive">Pagar <span class="fa fa-lg fa-cart-arrow-down"></span></a>
									<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
								</div>
								<br>	
							</div>
						</div>
						<!--Parte Final-->
					</div>
				</div>
			</div>
		</div>
	</div>

{{-- 
	<div class="card-footer text-muted" style="background: rgba(0,10,0,0.4); height: 80px;">
		<a href="#carousel_pago" data-slide="prev" class="btn btn-info btn-pago float-left" onclick="actualizarbarra(80)"><span class="fa fa-lg fa-arrow-circle-left"></span> Anterior</a>
		<a href="javascript:void(0)" id="bs_100" class="btn btn-success btn-pago float-right mt-responsive">Pagar <span class="fa fa-lg fa-cart-arrow-down"></span></a>
		<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
	</div> --}}


	{{-- <div class="card-footer text-muted" style="background: rgba(0,10,0,0.4); height: 80px;">
		<a href="#carousel_pago" data-slide="prev" class="btn btn-info btn-pago float-left" onclick="actualizarbarra(80)"><span class="fa fa-lg fa-arrow-circle-left"></span> Anterior</a>
		<a href="javascript:void(0)" id="bs_100" class="btn btn-success btn-pago float-right mt-responsive">Pagar <span class="fa fa-lg fa-cart-arrow-down"></span></a>
		<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
	</div> --}}

	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	crossorigin="anonymous"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{ url('js/bums.js') }}"></script>
	<script src="{{ url('js/bums_v2.js') }}"></script>

	<script>
		$(document).ready(function(){
			$('#form-envio').hide();
			$('#envio_div').hide();

			$('.ws').on('input', function () { 
				this.value = this.value.replace(/[^0-9+]/g,'');
			});

			$('.letras').keyup(function(){
				var nombre = $(this);
				nombre.val( nombre.val().replace(/[0-9]/g, function(str) { return ''; } ) );
			});

		});

		$('#gridCheck').on('change',function(){
			if (this.checked) {
				$('#form-envio').show();
				$('#envio_div').show();
			} else {
				$('#form-envio').hide();
				$('#envio_div').hide();
			}  
		});

		$('#cupon').keyup(function () {
			if ($('#cupon').val().length <= 12) {
				$('#cuponbtn').prop('disabled', false);
			} else {
				$('#cuponbtn').prop('disabled', true);
			}
		});

		$("#bs_80").on("click",function(){
			$("#conf_nombre").html($('#name').val()+" "+$('#lastname').val());
			$("#conf_ws").html($('#ws').val());
			$("#conf_nota").html($('#nota_adicional').val());
			$("#tipo_pago").html($( "#select2 option:selected" ).text());
			$("#pago_banco").html($('#banco_emisor').val());
			$("#pago_cedula").html($('#cedula_titular').val());
			$("#pago_referencia").html($('#referencia').val());
			$("#pago_monto").html($('#monto').val());
			$("#pago_fecha").html($('#fecha').val());
			$("#envio_emp").html($( "#select1 option:selected" ).text());
			$("#envio_des").html($('#destinario').val());
			$("#envio_ced").html($('#cedula_destinario').val());
			$("#envio_dir").html($('#direccion_destinario').val());
			$("#envio_tel").html($('#numero_destinario').val());



		});
		$("#bs_100").on("click", function(){
			alert(1);
			window.swal({
				title: "Enviando reporte.",   
				text: "Estamos enviando su Pago \n\n\n\n",   
				type: "warning",   
				showCancelButton: false,    
				closeOnConfirm: false,   
				closeOnCancel: false,
				buttons: [""],
				timer: 2000,
			});

			
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

			alert(5);

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

			});

		});
	</script>



	<script>

	</script>
</body>

</html>