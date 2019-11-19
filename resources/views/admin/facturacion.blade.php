<head>
	<title>BumsGames Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Main CSS-->

	<link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ url('css/datatables.min.css') }}">

	<!-- Font-icon css-->

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="icon" href="{{ url('img/LOGO.ico') }}" /> {{--
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css"
  /> --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">

  </script>


</head>

<style type="text/css">
.shadow_ligero{
	-webkit-box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
	-moz-box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
	box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
}
</style>


<body>
	<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
	<style type="text/css">
	.container {max-width: 90% !important;}
</style>
<br>
<br>
<div class="container">
	<div class="card text-center shadow_ligero">
		<div class="card-header">

			<center>
				<form class="form-inline margin" action="{{  url('prueba') }}" method="get">
					<select class="form-control selectCoin" onchange="this.form.submit()" name="id_coin" id="id_coin" style="border: solid; border-color: #808080;">
						<option class="form-control" selected="" value="{{ $moneda_actual->id }}">{{ $moneda_actual->coin }}</option>
						@foreach($coins as $coin)
						<option class="form-control" value="{{ $coin->id }}">{{ $coin->coin }}</option>
						@endforeach
					</select>
					&nbsp;
					@if( $moneda_actual->id != 2)

					Tasa: {{ number_format($moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
					@endif
				</form>	
			</center>
			<h3>Facturacion de {{ Auth::user()->name }} {{ Auth::user()->lastname }}</h3>
			<a href="#" id="cancelarFacturacion" >Cancelar facturacion</a>

		</div>
		<div class="card-body">
			<table class="table" style="font-size: 10px;">
				<tbody id="tablaCarrito2">
					<?php $i = 1; ?>
					<?php $precio = 0; ?>
					<?php $inversion_total = 0; ?>
					<?php $items_cantidad = 0; ?>



					@foreach( $carrito as $item )
					<tr>
						<th>
							<?php echo $i++; ?>.
							<?php $precio += $item->articulo->price_in_dolar * $item->cantidad; ?>
							<?php $inversion_total += $item->articulo->costo * $item->cantidad; ?>
							<?php $items_cantidad++; ?>
						</th>
						<th>	
							<img class="img-top imagen newImg" src="{{ url('img/'.$item->articulo->images[0]->file) }}" alt="Card image cap" width="30">
						</th>
						<th>
							{{ $item->articulo->name }}
						</th>
						<th>
							@foreach($item->articulo->categorias as $categoria)
							{{ $categoria->category }}
							<br>
							<br>

							@endforeach
						</th>
						<th>	
							@foreach($item->articulo->duennos->sortBy('porcentaje') as $duenno)
							<strong>
								Dueño:
							</strong>
							<br>
							<div class="dufiltrar">{{ $duenno->name }} {{ $duenno->lastname }}</div>

							<br>
							<strong>
								Acciones:
							</strong>
							<br>
							{{ $duenno->pivot->porcentaje }} %


							<br>	
							<br>	
							@endforeach	
						</th>
						<th>
							{{ $item->cantidad }} Unidad(es)
						</th>
						<th>
							<div style="font-size: 15px;">
								{{ $item->articulo->price_in_dolar * $item->cantidad }} $ (Unidad: {{ $item->articulo->price_in_dolar }} $)
							</div>
							<br>
							<br>
							@if( $moneda_actual->id != 2)
							{{ number_format($item->articulo->price_in_dolar * $item->cantidad * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}

							({{ number_format($item->articulo->price_in_dolar * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }})
							@endif							
						</th>
					</tr>


					@endforeach

				</tbody>
			</table>
		</div>
		<div class="card-footer ">
			<table class="table" style="font-size: 15px;">
				<tbody>
					<tr>
						<th>

						</th>
						<th>
						</th>
						<th>	

						</th>
						<th>
						</th>
						<th>

						</th>
						<th>	
						</th>
						<th>

						</th>
						<th>

						</th>
						<th>

						</th>
						<th>

						</th>


						<th>
							TOTAL: {{ number_format($precio, 2, ',', '.') }} $
							<br>
							@if( $moneda_actual->id != 2)
							{{ number_format($precio * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
							@endif		
							<input type="" name="" id="inversion_total" value="{{ $inversion_total }}" hidden="">
							<input type="" value=" {{ $precio }}" name="" id="total" hidden="">
							<input type="" value="{{ $items_cantidad }}" id="items_cantidad" hidden="">				
						</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<br>
<div class="container">
	<div class="row">
		<div class="col-5">
			<div class="card text-center shadow_ligero">
				<div class="card-header">
					<center>
						DATOS DEL CLIENTE
					</center>
				</div>
				<div class="card-body">
					<div class="row">
						<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
						<input name="id_articulo" id="id_articulo" hidden="">
						<input type="text" id="articulo_venta" hidden>
						<input type="text" id="email_articulo_venta" hidden>
						<input type="text" id="password_articulo_venta" hidden>
						<input type="text" id="category_id_articulo_venta" hidden>
						<input name="id_user" id="id_user" value="{{ Auth::user()->id }}" hidden="">

						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>N# Cliente</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="id_client" 
								id="id_client" 
								placeholder=""
								autocomplete="off"
								readonly="">

							</div>

						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>N° Documento Identidad</strong></label>
								<input class="form-control form-control-sm" 
								id="cedula_cliente" 
								autocomplete="off"
								>
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Nickname</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="nickname" 
								id="nickname" 
								placeholder=""
								autocomplete="off"
								>
							</div>
						</div>		
					</div>
					<div class="row">
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Nombre</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								id="name_client" 
								placeholder=""
								autocomplete="off"
								>

							</div>

						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Apellido</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="lastname_client" 
								id="lastname_client" 
								placeholder=""
								autocomplete="off"
								>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Contacto</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="num_contact" 
								id="num_contact" 
								placeholder=""
								autocomplete="off"
								>
							</div>		
						</div>
							{{--
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Nota</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
							
									id="note_cliente" 
									placeholder=""
									autocomplete="off"
									>
								</div>		
							</div>--}}
						</div>

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Nombre y Apellido</th>
										<th scope="col">N° Identidad</th>
										<th scope="col">Nickname</th>
									</tr>
								</thead>
								<tbody id="table_client">

								</tbody>
							</table>
						</div>
						<button class="btn btn-primary" id="borrar_client_venta">Cliente Nuevo</button>
					</div>
					<div class="card-footer text-muted">
						<label>
							<input type="checkbox" value="checkbox" id="checked_envio" />
							Incluye envio.
						</label>	
						<div class="card" style="">
							<div class="container">
								<div class="row" id="zona_envio" style="display: none;">
									<br>
									<br>
									<center>
										<button id="copia_envio">Seleccionar mismos datos cliente</button>
									</center>
									<br>
									<br>
									<div class="col-12 col-lg">
										<div class="form-group">
											<label for="" ><strong>Empresa de encomienda</strong></label>
											<input class="form-control form-control-sm" 
											type="text"
											id="empresa" 

											placeholder=""
											autocomplete="off">
										</div>
									</div>
									<div class="col-12 col-lg">
										<div class="form-group">
											<label for=""><strong>Direccion de envio</strong></label>
											<input class="form-control form-control-sm" 
											type="text"
											id="direccion" 
											placeholder=""

											autocomplete="off">
										</div>
									</div>
									<div class="col-12 col-lg">
										<div class="form-group">
											<label for=""><strong>Destinario</strong></label>
											<input class="form-control form-control-sm" 
											type="text"
											id="destinario" 
											placeholder=""
											autocomplete="off">
										</div>
									</div>
									<div class="col-12 col-lg">
										<div class="form-group">
											<label for=""><strong>Cedula</strong></label>
											<input class="form-control form-control-sm" 
											type="text"
											id="cedula_destinario" 
											placeholder=""

											autocomplete="off">
										</div>
									</div>
									<div class="col-12 col-lg">
										<div class="form-group">
											<label for=""><strong>Telefono</strong></label>
											<input class="form-control form-control-sm" 
											type="text"
											id="telefono" 
											placeholder=""

											autocomplete="off">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-7">
				<div class="card text-center shadow_ligero">
					<div class="card-header">
						DATOS DE PAGO
					</div>
					<div class="card-body">
						<form id="opcionesVenta" hidden="">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="opciones_venta" id="exampleRadios1" value="1" checked>
								<label class="form-check-label" for="exampleRadios1">
									Metodo Estandar
								</label>
							</div>
							<div class="form-check" hidden="">
								<input class="form-check-input" type="radio" name="opciones_venta" id="exampleRadios2" value="2"{{--  checked="" --}}>
								<label class="form-check-label" for="exampleRadios2">
									Especificar pago de cada Articulo
								</label>
							</div>
						</form>
						TOTAL: {{ number_format($precio, 2, ',', '.') }} $
						<br>
						@if( $moneda_actual->id != 2)
						{{ number_format($precio * $moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}
						@endif	
						{{-- Zona unica --}}
						<div class="col-12 col-lg" id="zona_unica">
							<hr>
							<div class="form-check form-check-inline holaaas">
								<input class="form-check-input venta_tipo" type="radio" value="1"  name="OPCinvolucrado_-1" id="involucradoSelect1_-1" checked>
								<label class="form-check-label" for="involucradoSelect1_-1">Venta propia de: {{ Auth::user()->name }} {{ Auth::user()->lastname }} ({{ Auth::user()->porcentaje_ventaPropia * 100 }} %)</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input venta_tipo" type="radio" value="2" name="OPCinvolucrado_-1" id="involucradoSelect2_-1">
								<label class="form-check-label" for="involucradoSelect2_-1">Venta Parcial: {{ Auth::user()->name }} {{ Auth::user()->lastname }} ({{ Auth::user()->porcentaje_ventaParcial * 100 }} %)</label>
							</div>

							<div class="form-check form-check-inline">
								<input class="form-check-input venta_tipo" type="radio" value="3" name="OPCinvolucrado_-1" id="involucradoSelect3_-1">
								<label class="form-check-label" for="involucradoSelect3_-1">Venta Ajena: {{ Auth::user()->name }} {{ Auth::user()->lastname }} ({{ Auth::user()->porcentaje_ventaAjena * 100 }} %) </label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input venta_tipo" type="radio" value="4" name="OPCinvolucrado_-1" id="involucradoSelect4_-1">
								<label class="form-check-label" for="involucradoSelect4_-1">Porcentaje a voluntad: {{ Auth::user()->name }} {{ Auth::user()->lastname }} (Tu decides el %) </label>
							</div>
							<br>
							<br>
							<div style="font-size: 11px; display: none;" id="area_porcentaje_voluntad">
								<label>
									Porcentaje (%): 
									<input class="form-control form-control-sm" type="number" id="porcentaje_voluntad">
								</label>
							</div>
							<div id="area_involucradoAgenteSelect_-1">
								<div style="font-size: 11px; display: none;">Involucrado</div>
								<select class="form-control form-control-sm" id="involucradoAgenteSelect_-1">

									@foreach($users_opc as $user_opc)
									<option value="{{ $user_opc->id }}">{{ $user_opc->name }} {{ $user_opc->lastname }}</option>
									@endforeach
								</select>
							</div>
							<hr>
							<input type="text" hidden="" id="articulo_venta">
							<div class="row" hidden="">
								<div class="col-12 col-lg">
									<div class="form-group">
										<label for=""><strong>Tipo de Transaccion</strong></label>
										<select 
										class="form-control form-control-sm" 
										name="type" 
										id="type">
										<option value="Venta">Venta</option>
										<option value="Cambio">Cambio</option>
									</select>
								</div>
								<label for=""><strong>Si es cambio, dejar nota y anotar si hay diferencia.</strong>
								</label>	
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-lg-3">
								<div class="form-group">
									<label for=""><strong>Monto</strong></label>
									<input class="form-control form-control-sm numero_separador" 
									type="text"
									id="monto" 
									placeholder=""
									autocomplete="off">

								</div>
							</div>

							<div class="col-12 col-lg-3">
								<div class="form-group">
									<label for=""><strong>Moneda</strong></label>
									<select class="form-control form-control-sm" name="coin" id="coin_venta">
										<option class="form-control" selected="" value="{{ $moneda_actual->id }}">{{ $moneda_actual->coin }}</option>
										@foreach($coins as $coin)
										<option value="{{ $coin->id }}">{{ $coin->coin }} ({{ $coin->sign }})</option>
										@endforeach
									</select>

									{{-- <select class="form-control selectCoin" onchange="this.form.submit()" name="id_coin" id="id_coin" style="border: solid; border-color: #808080;">
										<option class="form-control" selected="" value="{{ $moneda_actual->id }}">{{ $moneda_actual->coin }}</option>
										@foreach($coins as $coin)
										<option class="form-control" value="{{ $coin->id }}">{{ $coin->coin }}</option>
										@endforeach
									</select> --}}
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="form-group">
									<label for=""><strong>Banco Emisor</strong></label>
{{-- 								<input class="form-control form-control-sm" 
								type="text"
								name="description" 
								id="description" 
								placeholder=""
								autocomplete="off"> --}}
								<select class="form-control form-control-sm" id="banco_emisor">
									@foreach($bancos as $banco)
									<option value="{{ $banco->id }}">{{ $banco->banco }} / {{ $banco->titular }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Referencia</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="reference" 
								id="reference" 
								placeholder=""
								autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-lg">
							<label for=""><strong>Nota</strong></label>
							<textarea class="form-control form-control-sm" 
							type="text"
							name="note_sale" 
							id="note_sale" 
							placeholder=""
							autocomplete="off" placeholder=""></textarea>

							<small class="text-danger" id="texto_parte_pago" style="display: none;">
								<strong>
									*En caso de recibir juego digital como parte de pago, colocar el correo del mismo y su respectiva categoria (primario, secundario...)*
									<br>
									<br>
									*En caso de recibir Juego Fisico como parte de Pago, especificar el nombre y el estado del Juego (Sellado, Destapado)...*
								</strong>
							</small>
						</div>

					</div>
					<br>
					<button id="agregarPago">REGISTRAR PAGO</button>
					<br>
					<br>
					<div id="ProSelected"></div>
					<div id="total_pagado_v2"></div>

					<div class="card-footer text-muted">
						<button type="button" class="btn btn-primary" style="margin-top: 10px; font-size: 18px;" id="realizarVenta_v2">Realizar venta</button>
					</div>
					<br>	
					
					<input type="text" hidden="" name="" id="moneda_{{ $moneda_actual->id }}" value="{{ $moneda_actual->valor }}">
					@foreach($coins as $coin)
					@if ($coin->active == 1)
						<input type="text" hidden="" name="" id="moneda_{{ $coin->id }}" value="{{ $coin->valor }}">
					@endif
					@endforeach


				</div>

				{{-- ZONA MULTIPLE --}}
				
			</div>
		</div>
	</div>	



	<hr>

	<br>
	<br>

					{{-- <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar carrito</button>
						<a href="{{ url('facturacion') }}"><button type="button" class="btn btn-primary">Proceder compra</button></a>

					</div> --}}

				</div>
				<hr>	
				
			</div>


			
		</div>



	</body>


	<script src="{{ url('js/jquery3.min.js') }}"></script>
	<script type="text/javascript">

		$('#cancelarFacturacion').click(function(){
			var opcion = confirm("¿Seguro que desea cancelar la facturación?.");
			if (opcion == true) {
				window.location.href='/allArticles';
			}else{
				return;
			}
		});

		$("#agregarPago").click(function(){
			monto_aux = (($("#monto").val()).split('.').join('')).split(',').join('.');
			var pagado = monto_aux / $("#moneda_"+$("#coin_venta").val()).val();
			if($("#banco_emisor").val() == null){
				swal(" Pago / Debe agregar el Banco Emisor.");
				return;
			}
			if($("#monto").val() == ""){
				swal("Pago / Debe ingresar el Monto.");
				return;
			}


			// Colocar otro Formulariobu,m
			var newtr = '<tr class="item"  data-id="0">';
			newtr = newtr + '<td>Pagado: <input readonly="" class="suma_pagado form-control" type="text" value="'+pagado+' $"></td>';
			newtr = newtr + '<td >Monto: <input readonly=""  class="form-control monto" value="'+$("#monto").val()+'" /></td>';
			newtr = newtr + '<td> <input readonly=""  class="form-control id_coin"  value="'+$("#coin_venta").val()+'" required hidden/></td>';
			newtr = newtr + '<td>Moneda: <input readonly=""  class="form-control"  value="'+$("#coin_venta").find('option:selected').text()+'" required /></td>';
			newtr = newtr + '<td> <input  readonly="" class="form-control bancoEmisor" hidden value="'+$("#banco_emisor").val()+'" required /></td>';
			newtr = newtr + '<td>Banco: <input readonly=""  class="form-control"  value="'+$("#banco_emisor").find('option:selected').text()+'" required /></td>';
			newtr = newtr + '<td>Referencia: <input readonly=""  class="form-control referencia"  value="'+$("#reference").val()+'" required /></td>';
			newtr = newtr + '<td>Nota: <input readonly=""  class="form-control nota_venta" id="mal"  value="'+$("#note_sale").val()+'" required /></td>';
			newtr = newtr + '<td>Eliminar:<button type="button" class="btn btn-danger btn-xs borrar"><i class="fa fa-times"></i></button></td></tr>';
			
			$('#ProSelected').append(newtr);

			suma_pagado();

		});

		function suma_pagado(){
			total_pagado = 0;
			let suma_pagado = document.querySelectorAll('.suma_pagado');
			
			for (var i = 0; i <suma_pagado.length; i++) {
				total_pagado += parseFloat(suma_pagado[i].value);
			}
			$("#total_pagado_v2 div").remove();
			$('#total_pagado_v2').append("<div><br> Total pagado: "+total_pagado+" $</div>");
		}


		$(function () {
			$(document).on('click', '.borrar', function (event) {
				event.preventDefault();
				$(this).closest('tr').remove();
				suma_pagado();
			});

			$(document).on('click', '.agregarPago_zonaMultiple', function (event) {
				event.preventDefault();
				numero = $(this).val();
				var newtr = '<tr class="item"  data-id="0">';
				newtr = newtr + '<td > <input  class="form-control monto_'+numero+'" value="'+$("#monto_"+numero).val()+'" /></td>';
				newtr = newtr + '<td> <input  class="form-control coin_'+numero+'"  value="'+$("#coin_"+numero).val()+'" required /></td>';
				newtr = newtr + '<td> <input  class="form-control bancoEmisor_'+numero+'"  value="'+$("#banco_emisor_"+numero).val()+'" required /></td>';
				newtr = newtr + '<td> <input  class="form-control referencia_'+numero+'"  value="'+$("#reference_"+numero).val()+'" required /></td>';
				newtr = newtr + '<td> <input  class="form-control nota_venta_'+numero+'" id="mal"  value="'+$("#note_sal_e+numero").val()+'" required /></td>';
				newtr = newtr + '<td><button type="button" class="btn btn-danger btn-xs borrar" ><i class="fa fa-times"></i></button></td></tr>';
				$("#zona_pega_"+$(this).val()).append(newtr);
			});

			$('#zona_multiple').hide();
		});




			// function quitar_pago(){
			// 	alert(1);
			// 	$(this).parent('td').parent('tr').remove();
			// }



			function cambiaBandera(algo){
                    // switch(algo){
                    //  case '1':
                    //  $('#my_image').attr('src','img/venezuela.jpg');
                    //  break;

                    //  case '2':
                    //  $('#my_image').attr('src','img/usa.png');
                    //  break;

                    //  case '3':
                    //  $('#my_image').attr('src','img/argentina.png');
                    //  break;
                    // }
                    var token = $('#token').val(); 
                    var form_data = new FormData();  
                    form_data.append('id_coin', algo);
                    var route = 'prueba';
                    $.ajax({
                    	url:        route,
                    	headers:    {'X-CSRF-TOKEN':token},
                    	type:       'POST',
                    	dataType:   'json',
                    	data:       form_data,
                    	contentType: false, 
                    	processData: false
                    });
                }
            </script>

            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('js/bums.js') }}"></script>
            <script src="{{ url('js/bums_v2.js') }}"></script>
            <script src="{{ asset('js/genesis.js') }}"></script>
            <!-- Essential javascripts for application to work-->
  {{--
  	<script src="js/jquery-3.2.1.min.js"></script> --}}
  	<script src="{{ url('js/popper.min.js') }}"></script>
  	<script src="{{ url('js/bootstrap.min.js') }}"></script>
  	<script src="{{ url('js/datatables.min.js') }}"></script>
  	<script src="{{ url('js/datatables-bootstrap.min.js') }}"></script>
  	<script src="{{ url('js/main.js') }}"></script>
  	<script src="{{ url('js/plugins/pace.min.js') }}"></script>
  	<script type="text/javascript">
  		$( ".venta_tipo" ).change(function(){
  			var opc = $("input:radio[name=OPCinvolucrado_-1 ]:checked").val();
  			switch(opc){
  				case "1":

  				$('#area_involucradoAgenteSelect_-1').css("display", "none");
  				$('#area_porcentaje_voluntad').css("display", "none");
  				break;

  				case "2":

  				$('#area_involucradoAgenteSelect_-1').css("display", "block");
  				$('#area_porcentaje_voluntad').css("display", "none");
  				break;

  				case "3":

  				$('#area_involucradoAgenteSelect_-1').css("display", "block");
  				$('#area_porcentaje_voluntad').css("display", "none");
  				break;

  				case "4":

  				$('#area_involucradoAgenteSelect_-1').css("display", "none");
  				$('#area_porcentaje_voluntad').css("display", "block");
  				break;
  			}
  		});
  	</script>
  {{--
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script> --}}
  <!-- The javascript plugin to display page loading on top-->
  {{--
  	<script src="js/plugins/pace.min.js"></script> --}}
  	<!-- Page specific javascripts-->
  	<!-- Google analytics script-->
  {{--
  <script type="text/javascript">
    if(document.location.hostname == 'pratikborsadiya.in') {
               (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
               })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
               ga('create', 'UA-72504830-1', 'auto');
               ga('send', 'pageview');
             }
         </script> --}}
         <script src="{{url('js/sweet.min.js')}}"></script>