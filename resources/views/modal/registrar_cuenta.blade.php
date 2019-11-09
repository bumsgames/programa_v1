

<!-- Modal -->
<div class="modal fade bd-example-modal-lg registrar_cuenta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Registrar cuenta ({{ Auth::user()->name }} {{ Auth::user()->lastname }})</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden=""> 
					<div class="col">
						<center>
							PARTE CUENTA
						</center>
						<hr>
						<div class="row">
							{{-- PARTE CUENTA --}}
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Entidad</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="entidad" 
									id="entidad" 
									placeholder=""
									autocomplete="off"
									>

								</div>

							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Correo</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="Correo" 
									id="Correo" 
									placeholder=""
									autocomplete="off"
									>

								</div>

							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Password</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="Password" 
									id="Password" 
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
									<label for=""><strong>Monto</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="price" 
									id="price" 
									placeholder=""
									autocomplete="off"
									>
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
								<div class="form-group">
									<label for=""><strong>Nota</strong></label>
									<textarea class="form-control form-control-sm" 
									type="text"
									name="note_cuenta" 
									id="note_cuenta" 
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
			id="registrar_cuenta"
			type="BUTTON" 
			>Guardar Cuenta {{ Auth::user()->name }} {{ Auth::user()->last }}</button>
		</div>
	</div>
</div>
</div>