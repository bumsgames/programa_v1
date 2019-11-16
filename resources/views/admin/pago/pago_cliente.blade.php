@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Pago Cliente</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
				
				<div class="row">	
					<div class="col-12 col-lg-4">
						<h3>	
							Ultimos 20 pagos verificados.
						</h3>
						<hr>	
						<table class="table table-hover" id="tablaCarrito">
							<thead>	
								<tr>	
									<th>	
										N# Orden
									</th>
									<th>	
										Pago
									</th>
									<th>	
										Botones
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach($pago_v as $sin)

								<tbody>
									<tr>
										<td>	
											# {{ $sin->id }}
										</td>
										<td>	
											<strong>{{ $sin->name }} {{ $sin->lastname }}</strong>
											<br>	
											<br>	
											{{ $sin->banco }}
											<br>
											<br>		
											{{ $sin->monto }}
										</td>
										<td>
											@if($sin->verificado <= 0)
											<button id="verificar" class="btn btn-sm" onclick="verificar({{ $sin->id }})">Verificar</button>
											@else
											Verificado por: 
											@if(isset($sin->persona1->name))
											{{ $sin->persona1->name }} {{ $sin->persona1->lastname }}

											@endif{{-- {{ $sin->persona1->name }} {{ $sin->persona1->lastname }} --}}
											<br><br>
											@endif

											@if($sin->entregado <= 0)
											@else
											@if(isset($sin->persona2->name))
											Entregado: {{ $sin->persona2->name }} {{ $sin->persona2->lastname }}
											@endif
											{{-- Entregado por: {{ $sin->persona1->name }} {{ $sin->persona1->lastname }} --}}
											<br>
											<br>
											@endif

											@if($sin->verificado <= 0 && $sin->entregado <= 0)
											@endif
											<br>	
											{{-- <button data-toggle="modal" 
											data-target="#ver_detalle_compra" class="btn btn-sm" onclick="ver_detalle_compra({{ $sin->id }})">Ver mas detalles</button> --}}

											<button type="button" class="btn btn-sm" onclick="nuevo_detalle_compra({{$sin->id}})" data-toggle="modal" data-target="#modelId">
												Ver mas detalles
											</button>
										</td>
									</tr>
									@endforeach
								</tbody>

							</table>
						</div>
						<div class="col-12 col-lg-8">
							<h3>Pagos sin verificar.</h3>
							<hr>	
							<table class="table table-hover" id="tablaCarrito">
								<thead>	
									<tr>	
										<th>	
											N# Orden
										</th>
										<th>	
											Banco Emisor
										</th>
										<th>	
											Botones
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($pago_s as $sin)

									<tbody>
										<tr>
											<td>	
												# {{ $sin->id }}
											</td>
											<td>	
												<strong>{{ $sin->name }} {{ $sin->lastname }}</strong>
												<br>	
												<br>	
												{{ $sin->banco }}
												<br>
												<br>		
												{{ $sin->monto }}
											</td>
											<td>
												@if(!($sin->entregado <= 0))
												@if(isset($sin->persona2->name))
												Entregado: {{ $sin->persona2->name }} {{ $sin->persona2->lastname }} <br>
												@endif
												@endif

												@if($sin->verificado <= 0)
												<button id="verificar" class="btn btn-sm" onclick="verificar({{ $sin->id }})">Verificar</button>
												@else
												Verificado por: 
												@if(isset($sin->persona1->name))
												{{ $sin->persona1->name }} {{ $sin->persona1->lastname }} 

												@endif{{-- {{ $sin->persona1->name }} {{ $sin->persona1->lastname }} --}}
												<br><br>
												@endif
												
												@if($sin->entregado <= 0)
												<button id="entregar" class="btn btn-sm" onclick="entregar({{ $sin->id }})">Entregar </button>
												@endif
												{{-- Entregado por: {{ $sin->persona1->name }} {{ $sin->persona1->lastname }} --}}

												@if($sin->verificado <= 0 && $sin->entregado <= 0)
												<button id="verificar_entregar" class="btn btn-sm" onclick="verificar_entregar({{ $sin->id }})">Verificar y Entregar</button>
												@endif
												{{--<button data-toggle="modal" 
												data-target="#ver_detalle_compra" class="btn btn-sm" onclick="ver_detalle_compra({{ $sin->id }})">Ver mas detalles</button>--}}


												<button type="button" class="btn btn-sm" onclick="nuevo_detalle_compra({{$sin->id}})" data-toggle="modal" data-target="#modelId">
													Ver mas detalles
												</button>

												<button class="btn btn-danger" onclick="eliminar_orden({{ $sin->id }})">Eliminar</button>
												
											</td>
										</tr>
										@endforeach
									</tbody>
									<?php echo $pago_s->links(); ?>

								</table>
							</div>
						</div>
					</div>
				</div>
			</main>
			<style>
				.pagination li a, .pagination li span{
					background-color:white;
					border:1px solid #DDDDDD;	
					padding:5px 10px;
				}

				.pagination li.active span{
					background-color:#009688;
					color:white;
					
				}

				.pagination li:hover a{
					background-color:#007d71;
					color:white!important;
					text-decoration:none;
				}
			</style>
			{{-- 
			<div class="modal fade letraNegra" id="ver_detalle_compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Detalle de compras</h3>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">	
								<div class="col">	
									<h3>DATOS DEL CLIENTE</h3>
									<hr>
									<label for="">Numero de # Orden</label>
									<input type="" class="form-control form-control-sm" id="id" disabled="">
									<br>	

									<label for="">Nombre</label>
									<input type="" class="form-control form-control-sm" id="name" disabled="">
									<br>	

									<label for="">Apellido</label>
									<input type="" class="form-control form-control-sm" id="lastname" disabled="">
									<br>	

									<img src="img/ws.png" height="35" alt="">
									<label for="">What'sApp</label>
									<input type="" class="form-control form-control-sm" id="ws" disabled="">
									<br>
									<label for="">Nota adicional</label>
									<input type="" class="form-control form-control-sm" id="nota_adicional" disabled="">
									<br>
									<hr>	
									<h3>CODIGO DE DESCUENTO</h3>
									<label for="">ID del cupon aplicado</label>
									<input type="" id="cupon" class="form-control form-control-sm" disabled="">
									<br>	
									<label for="">Monto del cupon aplicado ($)</label>
									<input type="" id="descuento" class="form-control form-control-sm" disabled="">
									<br>
									<label for="">Creado por (ID DEL CREADOR):</label>
									<input type="" id="creado_por" class="form-control form-control-sm" disabled="">
									<br>
									<label for="">Codigo</label>
									<input type="" id="codigo" class="form-control form-control-sm" disabled="">
									<br>

									<hr>
									<h3>Pago</h3>
									<hr>	
									<br>
									<label for="">Tipo de pago</label>
									<input type="" id="tipo_trans" class="form-control form-control-sm" disabled="">
									<br>
									<label for="">Banco</label>
									<input type="" id="banco" class="form-control form-control-sm" disabled="">	
									<br>
									<label for="">Cedula</label>
									<input type="" id="cedula" class="form-control form-control-sm" disabled="">
									<br>
									<label for="">Referencia</label>
									<input type="" id="referencia" class="form-control form-control-sm" disabled="">	
									<br>
									<label for="">Monto</label>
									<input type="" id="monto" class="form-control form-control-sm" disabled="">
									<br>	
									<label for="">Fecha</label>
									<input type="" id="fecha" class="form-control form-control-sm" disabled="">
									<br>	
									<label for="">Verificado</label>
									<input type="" id="verificado" class="form-control form-control-sm" disabled="">	
									<br>	
									<label for="">Entregado</label>
									<input type="" id="entregado" class="form-control form-control-sm" disabled="">	
									<br>	
									<label for="">Capture</label>
									<br>	
									<img id="capture" src="img/ws.png" height="250" alt="">
									<hr>	
									<h3>DATOS DE ENVIO</h3>
									<hr>	
									<label for="">Empresa</label>
									<input type="" id="empresa" class="form-control form-control-sm" disabled="">
									<label for="">Destinario</label>
									<input type="" id="destinario" class="form-control form-control-sm" disabled="">
									<label for="">Cedula</label>
									<input type="" id="cedula_destinario" class="form-control form-control-sm" disabled="">
									<label for="">Direccion</label>
									<input type="" id="direccion" class="form-control form-control-sm" disabled="">
									<label for="">Telefono</label>
									<input type="" id="telefono" class="form-control form-control-sm" disabled="">
								</div>
								<div class="col">
									<h3>ARTICULOS DE LA ORDEN</h3>
									<hr>	
									<div id="puesto">
									</div>
								</div>
							</div>
							<br>
						</div>
					</div>
				</div>
			</div>
			 --}}
			<style>
	

			.pago_section{
				background-color:#009688;
				padding: 10px 5px;
				color:white;
				width: 80%;
				display: inline-block;
			}
			.right_triangle{
				margin-bottom: -14px;
				border-top: 45px solid #009688;
				border-right: 45px solid transparent;
				display: inline-block;
			}
			</style>
			<!-- Modal -->
			<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title"><span class="fa fa-shopping-cart"></span> Reporte de Pago</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true"><span class="fa fa-times"></span></span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-6">
									<h4 class="pago_section">DATOS DEL PAGO</h4><span class="right_triangle"></span>
									<hr>
									<div class="row">
										<div class="col-6">
											<span>ID del pago</span>
										</div>
										<div class="col-6">
											<span id="identificador"></span>
										</div>
									</div>
									<br>
									<h4 class="pago_section">ARTICULOS COMPRADOS</h4><span class="right_triangle"></span>
									<hr>
									<div class="row">
										<div class="col-12">
											<div id="articulos_div">
												
											</div>
										</div>
									</div>
									<div id="descuento_div">
										<h4 class="pago_section">CODIGO DE DESCUENTO</h4><span class="right_triangle"></span>
										<hr>
										<div class="row">
											<div class="col-5">
												<span>ID del cupon aplicado</span>
											</div>
											<div class="col-6">
												<span id="cupon_id"></span>
											</div>
										</div>
										<div class="row">
											<div class="col-5">
												<span>Monto del cupon aplicado ($)</span>
											</div>
											<div class="col-6">
												<span id="cupon_monto"></span>
											</div>
										</div>
										<div class="row">
											<div class="col-5">
												<span>Creado por</span>
											</div>
											<div class="col-6">
												<span id="cupon_creador"></span>
											</div>
										</div>
										<div class="row">
											<div class="col-5">
												<span>Codigo</span>
											</div>
											<div class="col-6">
												<span id="cupon_codigo"></span>
											</div>
										</div>
										<br>
									</div>
									<h4 class="pago_section">TOTAL COMPRA</h4><span class="right_triangle"></span>
									<hr>
									<div class="row">
										<div class="col-5">
											<h5>Total Pagado: ($)</h5>
											<br>
											<h5>Se debia pagar ($):</h5>
										</div>
										<div class="col-6">
											<h5 id="total_com"></h5>
											<br>
											<h5 id="total_se_debia_pagar"></h5>
										</div>
									</div>
								</div>
								<div class="col-6">
									<h4 class="pago_section">DATOS DEL CLIENTE</h4><span class="right_triangle"></span>
									<hr>
									<div class="row">
										<div class="col-4">
											<span>Nombre del cliente</span>
										</div>
										<div class="col-6">
											<span id="nombre_cli"></span>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-4">
											<span>WhatsApp</span>
										</div>
										<div class="col-6">
											<span id="whatsapp"></span>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-4">
											<span>Nota Adicional</span>
										</div>
										<div class="col-6">
											<span id="nota_ad"></span>
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
									<div class="row">
										<div class="col-4">
											<span>Pago Verificado</span>
										</div>
										<div class="col-6">
											<span style="text-transform: capitalize;" id="pago_ver"></span>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-4">
											<span>Orden Entregada</span>
										</div>
										<div class="col-6">
											<span style="text-transform: capitalize;" id="pago_ent"></span>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-4" style=" display: flex;
										justify-content: center;
										flex-direction: column;">
											<span >Capture</span>
										</div>
										<div class="col-6">
											<img id="pago_capture" src="img/ws.png" height="250" alt="">
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
						<div class="modal-footer">
							<a href="/reporte-pago/" id="a_ext" target="_blank" class="btn btn-primary">Enlace externo</a>
						</div>
					</div>
				</div>
			</div>
			@endsection

			<script type="text/javascript">
				
			</script>