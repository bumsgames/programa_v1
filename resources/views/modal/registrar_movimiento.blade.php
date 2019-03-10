<form action="realizar_movimiento_financiero" method="post" id="frm">
	
	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg registrar_movimiento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Realizar Movimiento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<center>
						<div class="row">	
							<div class="col">
								<br>
								<label for="">Movimiento para usuario:</label>
								@if(auth()->user()->level >= 10)
								<select class="form-control form-control-sm"  name="" id="select_user">
									@foreach($usuarios as $usuario)
									<option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->lastname }}</option>
									@endforeach
								</select>
								@endif
								<br>
								<input class="form-control form-control-sm"  type="text" name="pertenece_user" id="pertenece_user" value="{{ Auth::user()->id }}" readonly="">
							</div>
						</div>
					</center>
					<div class="row">
						
						<input name="_token" id="token" value="{{ csrf_token() }}" hidden=""> 
						<div class="col">
							
							<hr>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Entidad</strong></label>
										<input class="form-control form-control-sm" 
										type="text"
										name="description_registrar" 
										id="description_registrar" 
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
										name="referencia" 
										id="referencia" 
										placeholder=""
										autocomplete="off"
										>

									</div>

								</div>
								
							</div>
							<input type="text" hidden="" name="comision_user" id="comision_user" value="{{ Auth::user()->id }}">
							<div class="row">
								<div class="col">
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
								<div class="col">
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
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Nota</strong></label>
										<textarea class="form-control form-control-sm" 
										type="text"
										name="note_movimiento" 
										id="note_movimiento" 
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
				id="realizar_movimiento"
				type="submit" 
				>Guardar Movimiento</button>
			</div>
		</div>
	</div>
</div>

</form>