			
<div class="row">
	<div class="col-12 col-xl-8 offset-xl-2">
		<h6 style="color: gray;">*Confirme sus datos antes de continuar*</h6>
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