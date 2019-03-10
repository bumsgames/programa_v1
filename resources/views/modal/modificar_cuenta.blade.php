
	
	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg modificar-cuent" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modificar cuenta ({{ Auth::user()->name }} {{ Auth::user()->lastname }})</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<input name="_token" id="token" value="{{ csrf_token() }}" hidden=""> 
						<input hidden="" id="idM" value="" type="text"></input>
						<input hidden="" id="id_bumsuserM" value="" type="text"></input>
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
										name="entidadM" 
										id="entidadM" 
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
										name="correoM" 
										id="correoM" 
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
										name="passwordM" 
										id="passwordM" 
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
										<label for=""><strong>Saldo</strong></label>
										<input class="form-control form-control-sm" 
										type="text"
										name="" 
										id="" placeholder="Cree una orden con saldo negativo para agregar saldo" 
										readonly="" 
										autocomplete="off"
										>
									</div>
								</div>
								<div class="col-12 col-lg">
									<div class="form-group">
										<label hidden="" for=""><strong>Moneda</strong></label>
										<select hidden="" class="form-control form-control-sm" name="coinM" id="coinM">
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
										name="note_cuentaM" 
										id="note_cuentaM" 
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
				id="modificar_cuenta"
				type="BUTTON">Modificar</button>
			</div>
		</div>
	</div>
</div>