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
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
		 aria-expanded="false" aria-label="Toggle navigation" style="background: white;">
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
	<div class="container" style="width:80%">
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
						<li class="breadcrumb-item" id="b_40">Metodos de Pago</li>
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
									<h4>Carrito de Compras</h4>
								</div>
								<div class="card-body card-pago">
									<div class="container">
										<div class="row">
											<div class="col-12 col-xl-10 offset-xl-1">
												<!--<p>Modifique su compra en <a href="www.bumsgames.com.ve">www.bumsgames.com.ve</a></p>-->
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
																<button type="button" class="close" onclick="borrarElementoCarritoPago({{ $i - 1 }}, {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');">
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
												@if(!isset($coupon))
												<table class="table">
													<form method="post" action="/canjear/{{$precio}}">
														{{ csrf_field() }}
														<small>*Al canjear el cupon no podras quitar ningun producto del carrito</small>
														<tr>
															<td></td>
															<td class="cupon">Tengo un cupon:</td>
															<td>
																<div class="form-group"><input name="cupon" type="text" class="form-control cuponinput" id="cupon" maxlength="12" autocomplete="off"
																	 placeholder="Codigo del cupon"> </div>
															</td>
															<td><button disabled id="cuponbtn" type="submit" class="btn btn-success">Canjear</button></td>
														</tr>
													</form>
												</table>
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
												<br>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">
									<a href="#carousel_pago" data-slide="next" class="btn btn-info btn-pago float-right" onclick="actualizarbarra(40)">Siguiente <span class="fa fa-lg fa-arrow-circle-right"></span></a>
								</div>
							</div>
						</div>
						<!--Carrito de compras-->
						<div class="carousel-item">
							<div class="card text-center card-main-pago">
								<div class="card-header">
									<h4>Metodos de Pago</h4>
								</div>
								<div class="card-body card-pago">
									<div class="container">
										<div class="row">
											<div class="col-12 col-xl-10 offset-xl-1">
												<p>Esta orden expira en 30 minutos. (Los contactaremos via What'sApp lo antes posible una vez procesado su pago).</p>
												<h4>Opciones de pago</h4>
												<div id="accordianId" role="tablist" aria-multiselectable="true">
													<div class="card">
														<div class="card-header" role="tab" id="section1HeaderId">
															<h5 class="mb-0">
																<a data-toggle="collapse" data-parent="#accordianId" href="#section1ContentId" aria-expanded="true" aria-controls="section1ContentId">
																	Cuentas Bancarias
																</a>
															</h5>
														</div>
														<div id="section1ContentId" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
															<div class="card-body card-pago">
																<div class="row">
																	<div class="col-4">
																		<div class="card">
																			<center>
																				<img width="218" src="{{asset('img/provincial.png')}}" alt="">
																			</center>
																			<div class="card-body card-pago">
																				<h4 class="card-title">Provincial</h4>
																				<p class="card-text">
																					Titular: Angel Duarte <br> CI: 24559480 <br> Cuenta: Corriente <br> Numero de cuenta: 01080093510100154126
																				</p>
																			</div>
																		</div>
																	</div>
																	<div class="col-4">
																		<div class="card">
																			<center>
																				<img width="218" src="{{asset('img/banesco logo.jpg')}}" alt="">
																			</center>
																			<div class="card-body">
																				<h4 class="card-title">Banesco</h4>
																				<p class="card-text">
																					Titular: David Salazar <br> CI: 24559480 <br> Cuenta: Corriente <br> Numero de cuenta: 01340946310001457909
																				</p>
																			</div>
																		</div>
																	</div>
																	<div class="col-4">
																		<div class="card">
																			<center>
																				<img width="218" src="{{asset('img/mercantil.png')}}" alt="">
																			</center>
																			<div class="card-body">
																				<h4 class="card-title">Mercantil</h4>
																				<p class="card-text">
																					Titular: Sulay Salazar <br> CI: 10388731 <br> Cuenta: Corriente <br> Numero de cuenta: 01050047801047427362
																				</p>
																			</div>
																		</div>
																	</div>
																	<div class="col-4 offset-1">
																		<div class="card">
																			<center>
																				<img width="218" src="{{asset('img/bdv.png')}}" alt="">
																			</center>
																			<div class="card-body">
																				<h4 class="card-title">Banco de Venezuela</h4>
																				<p class="card-text">
																					Titular: Sulay Salazar CI: 10388731 Cuenta: Corriente Numero de cuenta: 01020427570000222668
																				</p>
																			</div>
																		</div>
																	</div>
																	<div class="col-4 offset-2">
																		<div class="card">
																			<center>
																				<img width="218" src="{{asset('img/bnc.png')}}" alt="">
																			</center>
																			<div class="card-body">
																				<h4 class="card-title">BNC</h4>
																				<p class="card-text">
																					Titular: Alejandro Duarte CI: 28530657 Cuenta: Ahorro Numero de cuenta: 01910047261047026977
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" role="tab" id="section2HeaderId">
															<h5 class="mb-0">
																<a data-toggle="collapse" data-parent="#accordianId" href="#section2ContentId" aria-expanded="true" aria-controls="section2ContentId">
																Otros metodos de pagos
																</a>
															</h5>
														</div>
														<div id="section2ContentId" class="collapse in" role="tabpanel" aria-labelledby="section2HeaderId">
															<div class="card-body card-pago">
																<h5>
																	PUEDE REALIZAR EL PAGO MEDIANTE OTROS MEDIOS (CONTACTE UN AGENTE BUMSGAMES) <br>
																	<img src="{{asset('img/paypal.png')}}" alt="" height="30"> <img src="img/mp.jpg" alt="" height="30">
																	<img src="{{asset('img/airtm.png')}}" alt="" height="30">
																	<img src="{{asset('img/localbitcoins.png')}}" alt="" height="30">
																</h5>
															</div>
														</div>
													</div>
												</div>
												<center>
													Total a Pagar <strong id="actualizar"> {{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</strong>
												</center>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">
									<a href="#carousel_pago" data-slide="prev" class="btn btn-info btn-pago float-left" onclick="actualizarbarra(20)"><span class="fa fa-lg fa-arrow-circle-left"></span> Anterior</a>
									<a href="#carousel_pago" data-slide="next" class="btn btn-info btn-pago float-right" onclick="actualizarbarra(60)">Siguiente <span class="fa fa-lg fa-arrow-circle-right"></span></a>
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
												<small class="form-text text-muted">*Entrega de juegos digitales 10 mins a 90 mins luego del pago - Entregas personales colocarlo en nota.</small>
												<br>

												<div class="form-row">
													<div class="form-group col-lg-4">
														<label for="inputEmail4"><strong>Nombre</strong></label>
														<input type="text" onkeyup="comprodesbloqueo60()" class="form-control letras" id="name" maxlength="30" autocomplete="off">
													</div>
													<div class="form-group col-lg-4">
														<label for="inputPassword4"><strong>Apellido</strong></label>
														<input type="text" onkeyup="comprodesbloqueo60()" class="form-control letras" id="lastname" maxlength="30" autocomplete="off">
													</div>
													<div class="form-group col-lg-4">
														<img src="{{asset('img/ws.png')}}" height="35" alt="">
														<label for="inputPassword4"><strong>Numero de WhatsApp</strong></label>
														<input type="text" onkeyup="comprodesbloqueo60()" class="form-control ws" id="ws" maxlength="25" autocomplete="off">
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
															<input class="form-check-input" onchange="comprodesbloqueo60()" type="checkbox" id="gridCheck">
															<label class="form-check-label" for="gridCheck">
																Incluye envio (Solo articulos fisicos).
															</label>
															<small class="form-text text-muted">Solo hacemos envios en Venezuela - Los envios se hacen 1 o 2 dias habiles luego de su respectivo pago.</small>
														</div>
													</div>
													<div id="form-envio">
														<br>
														<h4>Datos de envio</h4>
														<br>
														<br>
														<strong><label for="">Empresa para realizar el envio:</label></strong>
														<select class="form-control form-control-sm" id="select1">
															<option value="1">Tealca</option>
															<option value="2">Domesa</option>
														</select>
														<small class="form-text text-muted">Los envios solo se realizan mediante estas 2 empresas.</small>
														<br>
														<div class="form-row">
															<div class="form-group col-lg-3">
																<label for="inputEmail4"><strong>Destinatario</strong></label>
																<input onkeyup="comprodesbloqueo60()" type="text" class="form-control letras" id="destinario">
																<small class="form-text text-muted">Obligatorio</small>
															</div>
															<div class="form-group col-lg-3">
																<label for="inputPassword4"><strong>Documento de Identidad</strong></label>
																<input onkeyup="comprodesbloqueo60()" type="number" class="form-control" id="cedula_destinario">
																<small class="form-text text-muted">Obligatorio</small>
															</div>
															<div class="form-group col-lg-3">
																<label for="inputPassword4"><strong>Oficina o Direccion</strong></label>
																<input onkeyup="comprodesbloqueo60()" type="textarea" class="form-control" id="direccion_destinario">
																<small class="form-text text-muted">Obligatorio</small>
															</div>
															<div class="form-group col-lg-3">
																<label for="inputPassword4"><strong>Numero Telefonico</strong></label>
																<input onkeyup="comprodesbloqueo60()" type="text" class="form-control ws" id="numero_destinario">
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
									<a href="javascript:void(0)" onclick="comprocontinuar60()" id="bs_60" class="btn btn-info btn-pago float-right disabled">Siguiente <span class="fa fa-lg fa-arrow-circle-right"></span></a>
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
												<select class="form-control form-control-sm" id="select2">
													<option value="1">Transferencia del mismo Banco</option>
													<option value="2">Transferencia de otro Banco</option>
												</select>
												<br>

												<div class="form-row">
													<div class="form-group col-lg-4">
														<label for="exampleInputEmail1"><strong>Banco Emisor:</strong></label>
														<input onkeyup="comprodesbloqueo80()" type="text" class="form-control" id="banco_emisor">
														<small id="emailHelp" class="form-text text-muted">Obligatorio</small>
													</div>
													<div class="form-group col-lg-4">
														<label for="exampleInputEmail1"><strong>Cedula del titular</strong></label>
														<input onkeyup="comprodesbloqueo80()" type="text" class="form-control" id="cedula_titular">
														<small id="emailHelp" class="form-text text-muted">Obligatorio.</small>
													</div>
													<div class="form-group col-lg-4">
														<label for="exampleInputEmail1"><strong>Numero de Referencia</strong></label>
														<input onkeyup="comprodesbloqueo80()" type="number" class="form-control" id="referencia">
														<small id="emailHelp" class="form-text text-muted">Ogligatorio.</small>
													</div>
												</div>



												<div class="form-group">
													<label for="exampleInputEmail1"><strong>Fecha:</strong></label>
													<input onchange="comprodesbloqueo80()" type="date" class="form-control" id="fecha">
													<small id="emailHelp" class="form-text text-muted">Ogligatorio.</small>
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
									<a href="javascript:void(0)" onclick="comprocontinuar80()" id="bs_80" class="btn btn-info btn-pago float-right disabled">Siguiente <span class="fa fa-lg fa-arrow-circle-right"></span></a>
								</div>
							</div>
						</div>
						<!--Datos del comprador-->
						<div class="carousel-item">
							<div class="card text-center card-main-pago">
								<div class="card-header">
									<h4>Resumen de Pago</h4>
								</div>
								<div class="card-body card-pago">
									<div class="container">
										<div class="row">
											<div class="col-12 col-xl-8 offset-xl-2">
												<h6>*Confirme sus datos antes de continuar</h6>

												{{--<br>
												<label for="exampleInputEmail1"><strong>Comprador:</strong></label>
												<input type="text" class="form-control" id="campo1" disabled="">
												<small id="emailHelp" class="form-text text-muted">Obligatorio</small>
												<br>

												<img src="{{asset('img/ws.png')}}" height="35" alt="">
												<label for="inputPassword4"><strong>Numero de What'sApp:</strong></label>
												<input type="text" class="form-control" id="campo2" maxlength="30" autocomplete="off" disabled="">
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
												</div>--}}
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
													.reporte-container{
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
																					<img src="{{asset('img/'.$x['imagen'])}}" class="card-img" alt="...">
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
																	<div class="col-4">
																		<span>Monto del cupon aplicado ($)</span>
																	</div>
																	<div class="col-6">
																		{{$coupon->descuento}}
																	</div>
																</div>
																<br>
																<div class="row">
																	<div class="col-4">
																		<span>Codigo</span>
																	</div>
																	<div class="col-6">
																		{{$coupon->codigo}}
																	</div>
																</div>
																<br>
																 @endif
																<h4 class="pago_section">TOTAL COMPRA</h4><span class="right_triangle"></span>
																<hr>
																<div class="row">
																	<div class="col-4">
																		<h5>Total</h5>
																	</div>
																	<div class="col-6">
																		<h5>{{ number_format($precio * $moneda_actual->valor, 2, ',', '.')}} {{ $moneda_actual->sign }}</h5>
																	</div>
																</div>
																<br>
																<h4 class="pago_section">DATOS DEL CLIENTE</h4><span class="right_triangle"></span>
																<hr>
																<div class="row">
																	<div class="col-4">
																		<span>Nombre del cliente</span>
																	</div>
																	<div class="col-6">
																		<span id="conf_nombre"></span>
																	</div>
																</div>
																<br>
																<div class="row">
																	<div class="col-4">
																		<span>WhatsApp</span>
																	</div>
																	<div class="col-6">
																		<span id="conf_ws"></span>
																	</div>
																</div>
																<br>
																<div class="row">
																	<div class="col-4">
																		<span>Nota Adicional</span>
																	</div>
																	<div class="col-6">
																		<span id="conf_nota"></span>
																	</div>
																</div>
																<br>
																<h4 class="pago_section">DATOS DEL PAGO</h4><span class="right_triangle"></span>
																<hr>
																<div class="row">
																	<div class="col-4">
																		<span>Tipo de pago</span>
																	</div>
																	<div class="col-6">
																		<span style="text-transform: capitalize;" id="tipo_pago"></span>
																	</div>
																</div>
																<br>
																<div class="row">
																	<div class="col-4">
																		<span>Banco</span>
																	</div>
																	<div class="col-6">
																		<span style="text-transform: capitalize;" id="pago_banco"></span>
																	</div>
																</div>
																<br>
																<div class="row">
																	<div class="col-4">
																		<span>Cedula</span>
																	</div>
																	<div class="col-6">
																		<span style="text-transform: capitalize;" id="pago_cedula"></span>
																	</div>
																</div>
																<br>
																<div class="row">
																	<div class="col-4">
																		<span># de referencia</span>
																	</div>
																	<div class="col-6">
																		<span style="text-transform: capitalize;" id="pago_referencia"></span>
																	</div>
																</div>
																<br>
																<div class="row">
																	<div class="col-4">
																		<span>Monto</span>
																	</div>
																	<div class="col-6">
																		<span style="text-transform: capitalize;" id="pago_monto"></span>
																	</div>
																</div>
																<br>
																<div class="row">
																	<div class="col-4">
																		<span>Fecha</span>
																	</div>
																	<div class="col-6">
																		<span style="text-transform: capitalize;" id="pago_fecha"></span>
																	</div>
																</div>
																<br>
																<div id="envio_div">
																	<h4 class="pago_section">DATOS DE ENVIO</h4><span class="right_triangle"></span>
																	<hr>
																	<div class="row">
																		<div class="col-4">
																			<span>Empresa</span>
																		</div>
																		<div class="col-6">
																			<span style="text-transform: capitalize;" id="envio_emp"></span>
																		</div>
																	</div>
																	<br>
																	<div class="row">
																		<div class="col-4">
																			<span>Destinatario</span>
																		</div>
																		<div class="col-6">
																			<span style="text-transform: capitalize;" id="envio_des"></span>
																		</div>
																	</div>
																	<br>
																	<div class="row">
																		<div class="col-4">
																			<span>Cedula</span>
																		</div>
																		<div class="col-6">
																			<span style="text-transform: capitalize;" id="envio_ced"></span>
																		</div>
																	</div>
																	<br>
																	<div class="row">
																		<div class="col-4">
																			<span>Dirección</span>
																		</div>
																		<div class="col-6">
																			<span style="text-transform: capitalize;" id="envio_dir"></span>
																		</div>
																	</div>
																	<br>
																	<div class="row">
																		<div class="col-4">
																			<span>Teléfono</span>
																		</div>
																		<div class="col-6">
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
								</div>
								<div class="card-footer text-muted">
									<a href="#carousel_pago" data-slide="prev" class="btn btn-info btn-pago float-left" onclick="actualizarbarra(80)"><span class="fa fa-lg fa-arrow-circle-left"></span> Anterior</a>
									<a href="javascript:void(0)" id="bs_100" class="btn btn-success btn-pago float-right">Pagar <span class="fa fa-lg fa-cart-arrow-down"></span></a>
									<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
								</div>
							</div>
						</div>
						<!--Parte Final-->
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

	<footer class="page-footer font-small cyan darken-3 foot1 pagonav" style="color: white !important;">
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
				<div class="col">
					<h5>CONTACTO</h5>
					<hr>
					<div class="row">
						<div class="col">
							David Salazar.
							<br>
							<i class="fab fa-whatsapp fa-2x"></i> (+58) 0414-987-50-29

							<br>
							<br> Genesis Moreno.
							<br>
							<i class="fab fa-whatsapp fa-2x"></i> (+58) 0412-796-43-49
							<br>
							<br> Daniel Duarte.
							<br>
							<i class="fab fa-whatsapp fa-2x"></i> (+58) 0412-119-23-79
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
							<i class="fab fa-whatsapp fa-2x"></i> (+54) 9 11-3359-36-81

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
                if ($('#cupon').val().length == 12) {
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
			swal({ 
				title: "Enviando Reporte", 
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
					else{
						swal('Su pago se ha enviado con exito amig@: '+$('#name').val()+" "+$('#lastname').val());
						setTimeout(function() {
							window.close();	
						}, 4000);
					}
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



	<script>

	</script>
</body>

</html>