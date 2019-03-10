<div class="modal fade modal_mod_cliente" tabindex="-1" id="modalmod" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="titulo_cliente" class="modal-title">Modificar Cliente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12 col-lg">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<input name="id_clientemod" id="id_clientemod" hidden="">

						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for="namemod"><strong>Nombre</strong></label>
									<input type="text" autocomplete="off" class="form-control" name="namemod" id="namemod">
								</div>					
							</div>
			
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for="lastnamemod"><strong>Apellido</strong></label>
									<input type="text" class="form-control" name="lastnamemod" value="" id="lastnamemod" autocomplete="off">
								</div>
							</div>		
						</div>
						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for="nickmod"><strong>Nickname</strong></label>
									<input type="text" autocomplete="off" class="form-control" name="nickmod" id="nickmod">
								</div>					
							</div>
			
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for="emailmod"><strong>Email</strong></label>
									<input type="text" class="form-control" name="emailmod" value="" id="emailmod" autocomplete="off">
								</div>
							</div>		
						</div>
						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for="passmod"><strong>Contraseña</strong></label>
									<input type="text" class="form-control" name="passmod" value="" id="passmod" autocomplete="off">
								</div>
							</div>	
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for="nummod"><strong>Numero de contacto</strong></label>
									<input type="text" autocomplete="off" class="form-control" name="nummod" id="nummod">
								</div>					
							</div>		
						</div>
						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for="notmod"><strong>Nota</strong></label>
									<input type="text" class="form-control" name="notmod" value="" id="notmod" autocomplete="off">
								</div>
							</div>	
						</div>
						
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="realizar_modificacion_cliente">Realizar Modificacion</button>
	</div>

		</div>
	</div>	
	

	



</div>