	<!-- Modal -->
	<input type="text" id="id_sale_m" name="id_sale_m">
	<div class="modal fade bd-example-modal-lg modificar_movimiento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modificar Movimiento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<input type="text" hidden="" name="id_user_duenno_articulo" id="id_user_duenno_articulo" value="{{ Auth::user()->id }}">
						<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
						<input type="text" id="type" name="type" value="Pago Agregado" hidden=""> 
						<input type="text" id="id_sale_m" name="id_sale_m" hidden="">
						<div class="col">
							<center>
								MODIFICANDO MOVIMIENTO
							</center>
							<hr>
							<div class="row">
								<div class="col">
									<div class="form-group">

										<label for=""><strong>Por donde es el pago?</strong></label>
										<input class="form-control form-control-sm" 
										type="text"
										name="description_m" 
										id="description" 
										placeholder=""
										autocomplete="off"
										>

									</div>

								</div>
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Referencia</strong></label>
										<input class="form-control form-control-sm" 
										type="text"
										name="reference_m" 
										id="reference" 
										placeholder=""
										autocomplete="off"
										>

									</div>

								</div>

							</div>
							<input type="text" hidden="" name="id_user_que_vende" id="id_user_que_vende" value="{{ Auth::user()->id }}">
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Monto</strong></label>
										<input class="form-control form-control-sm" 
										type="text"
										name="price_m" 
										id="price" 
										placeholder=""
										autocomplete="off"
										>

									</div>

								</div>
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Moneda</strong></label>
										<select class="form-control form-control-sm" name="coin_m" id="coin">
											<option value="Bolivares">Bolivares</option>
											<option value="Dolares">Dolares</option>
											<option value="Pesos Argentinos">Pesos Argentinos</option>
										</select>
									</div>

								</div>

							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Tipo</strong></label>
										<input class="form-control form-control-sm" 
										type="text"
										name="type_m" 
										id="type" 
										placeholder=""
										autocomplete="off"
										readonly="" 
										>

									</div>
									
								</div>
								
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Nota</strong></label>
										<textarea class="form-control form-control-sm" 
										type="text"
										name="note_sale"
										id="note_sale_modificar" 
										placeholder=""
										autocomplete="off"
										>
									</textarea>
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
				id="modificar_movimiento"
				type="button" 
				>Guardar Movimiento</button>
			</div>
		</div>
	</div>
</div>