<div aria-hidden="true" class="modal fade bd-example-modal-lg3 " id="modal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg3">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modificar envio</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="row">
							</div>
							<div class="container">

								<form action="">

									<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
									<input hidden="" id="id" value="" type="text">
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="">Registrado por:</label>
												<input type="text" name="de_usuarioM" id="de_usuarioM" class="form-control" value="" readonly="" >
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for=""><strong>Traking de envio</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="trackingM" 
												id="trackingM" 
												placeholder=""
												autocomplete="off">

											</div>
										</div>
									</div>

									<hr>
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for=""><strong>Nombre del Articulo</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="nameM" 
												id="nameM" 
												placeholder=""
												autocomplete="off">

											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for=""><strong>Precio del articulo</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="precioM" 
												id="Costo" 
												placeholder=""
												autocomplete="off">

											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for=""><strong>Tipo de Orden</strong></label>
												<select 
												class="form-control form-control-sm" name="ordenM" 
												id="ordenM">
												<option value="Por Enviar.">Por enviar</option>
												<option value="Por recibir">Por recibir</option>

											</select>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col">
										<div class="form-group">
												<label for=""><strong>Empresa</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="empresaM" 
												id="empresaM" 
												placeholder=""
												autocomplete="off">

											</div>
										
									</div>
									<div class="col">
										<div class="form-group">
												<label for=""><strong>Direccion de envio</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="direccionM" 
												id="direccionM" 
												placeholder=""
												autocomplete="off">

											</div>
										
									</div>
									<div class="col">
										<div class="form-group">
												<label for=""><strong>Estatus de Envio</strong></label>
												<select 
												class="form-control form-control-sm" name="statusM" 
												id="statusM">Seleccione una opcion
												<option value="Enviado">Enviado</option>
												<option value="Recibido">Recibido</option>

											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="form-group">
												<label for=""><strong>Persona que Recibe</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="recibeM" 
												id="recibeM" 
												placeholder=""
												autocomplete="off">

											</div>
										
									</div>
									<div class="col">
										<div class="form-group">
												<label for=""><strong>Cedula de identidad</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="cedulaM" 
												id="cedulaM" 
												placeholder=""
												autocomplete="off">

											</div>
										
									</div>
									<div class="col">
										<div class="form-group">
												<label for=""><strong>Numero telefonico</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="numM" 
												id="numM" 
												placeholder=""
												autocomplete="off">

											</div>
										
										
									</div>
								</div>
									<div class="modal-footer">
										<button type="button" id="xxx" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" id="modificar_envio">Guardar</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>