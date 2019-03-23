<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="titulo_venta" class="modal-title">Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
				<div class="col-12 col-lg">
						
						<center>
							PARTE CLIENTE
						</center>
						<hr>
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
									<label for=""><strong>Nickname</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="nickname" 
									id="nickname" 
									placeholder=""
									autocomplete="off"
									readonly="">
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
									name="note" 
									id="note" 
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
										<th scope="col">Nickname</th>
										<th scope="col">Boton</th>
									</tr>
								</thead>
								<tbody id="table_client">

								</tbody>
							</table>
						</div>
						<button class="btn btn-primary" id="borrar_client_venta">Cliente Nuevo</button>
					</div>
					<div class="col-12 col-lg">
						<center>
							PARTE PAGO
						</center>
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
					<br>	
					<br>
					<div class="row">
					<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Cantidad</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="cantidad" 
								id="cantidad" 
								placeholder=""
								autocomplete="off">

							</div>
						</div>
						<div class="col-12 col-lg-9">
							<div class="form-group">
								<label for=""><strong>Banco Emisor</strong></label>
{{-- 								<input class="form-control form-control-sm" 
								type="text"
								name="description" 
								id="description" 
								placeholder=""
								autocomplete="off"> --}}
								<select class="form-control form-control-sm" name="description" id="description">
									@foreach($bancos as $banco)
									<option value="{{ $banco->banco }}">{{ $banco->banco }}</option>
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
					</div>
					<div class="row">
					<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Monto</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="price" 
								id="price" 
								placeholder=""
								autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Moneda</strong></label>
								<select class="form-control form-control-sm" name="coin" id="coin">
									@foreach($coins as $coin)
									<option value="{{ $coin->id }}">{{ $coin->coin }} ({{ $coin->sign }})</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-12 col-lg">
							<label for=""><strong>Nota (Parte de pago o algo especial)</strong></label>
							<textarea class="form-control form-control-sm" 
							type="text"
							name="note_sale" 
							id="note_sale" 
							placeholder=""
							autocomplete="off">
						</textarea>
						<small class="text-danger">
							<strong>
								*En caso de recibir juego digital como parte de pago, colocar el correo del mismo
								<br>
								*En caso de que sea doble pago (bancos diferentes ) o recibir articulo fisico como parte de pago hacerlo saber en la nota
							</strong>
						</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>

	<div class="container" >	
		<label>
			<input type="checkbox" value="checkbox" name="CheckboxGroup1" id="boxchecked" />
		Incluye envio.</label>	
		<div class="row" id="hidden">
		<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Empresa</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="empresa" 
					id="empresa" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Direccion</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="direccion" 
					id="direccion" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Cedula</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="cedula" 
					id="cedula" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Numero de telefono</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="num_telefono" 
					id="num_telefono" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Quien recibe?</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="recibe" 
					id="recibe" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="realizar_venta">Realizar venta</button>
	</div>
</div>
</div>
</div>