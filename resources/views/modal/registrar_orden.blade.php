

<!-- Modal -->
<div class="modal fade bd-example-modal-lg registrar_orden" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titulo">Registrar Orden (Cuenta de: {{ Auth::user()->name }} {{ Auth::user()->lastname }})</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden=""> 
					<div class="col">
						<center>
							PARTE ORDEN
						</center>
						<hr>
						<label for=""><strong>ID de cuenta</strong></label>
						<input class="form-control form-control-sm" 
						type="text"
						name="id_cuenta" 
						id="id_cuenta" 
						placeholder=""
						autocomplete="off"
						readonly="">
						<br>	
						<div class="row">
							{{-- PARTE CUENTA --}}
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Articulo</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="Articulo" 
									id="articulo" 
									placeholder=""
									autocomplete="off"
									>

								</div>

							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Costo</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="Costo" 
									id="Costo" 
									placeholder=""
									autocomplete="off"
									>
								</div>

							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Tracking</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="Tracking" 
									id="Tracking" 
									placeholder=""
									autocomplete="off"
									>
								</div>

							</div>


						</div>
						{{-- FIN PARTE CUENTA --}}
						<hr>	
						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Empresa de Envio</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="empresa" 
									id="empresa" 
									placeholder=""
									autocomplete="off"
									>
								</div>
							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Status</strong></label>
									<select class="form-control form-control-sm" name="status" id="status">
										<option value="Enviado">Recibido</option>
										<option value="Enviado">Enviado</option>
										
										
									</select>
								</div>

							</div>

						</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button 
			class="btn btn-primary" 
			id="registrar_orden"
			type="BUTTON" 
			>Registrar Orden {{ Auth::user()->name }} {{ Auth::user()->lastname }}</button>
		</div>
	</div>
</div>
</div>