<div class="modal fade modal_rapido" tabindex="-1" id="modalmod" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="titulo_modificacion" class="modal-title">Modificacion Rapida</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
				<div class="col-12 col-lg">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<input name="id_articulomod" id="id_articulomod" hidden="">

						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Cantidad</strong></label>
									<input type="number" autocomplete="off" class="form-control" name="quantity" id="quantity">
								</div>					
							</div>
			
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Boton reseteo</strong></label>
									<input type="date" class="form-control" name="reset_button" value="" id="reset_button" autocomplete="off">
								</div>
							</div>		
						</div>
						<div class="row">
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Contraseña del Articulo</strong></label>
								<input type="text" autocomplete="off" class="form-control" value="" name="passmod" id="passmod">
							</div>	
						</div>
					
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Nota del Articulo</strong></label>
								<textarea type="text" autocomplete="off" class="form-control" value="" name="notemod" id="notemod"></textarea>
							</div>	
							</div>
						</div>
						
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="realizar_modificacion">Realizar Modificacion</button>
	</div>

		</div>
	</div>	
	

	



</div>