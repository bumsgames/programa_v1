	<!-- Modal -->
	<input type="text" id="id_sale_m" name="id_sale_m">
	<div class="modal fade bd-example-modal-lg modificar_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modificar Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="row">
						<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">

								<div class="col-12 col-lg">
							<label for="">
								<strong>ID USUARIO</strong>
							</label>
							<input class="form-control form-control-sm" 
							type="text" id="id_usuario" readonly="" 
							placeholder=""
							autocomplete="off"
							>
						</div>
						<div class="col-12 col-lg">
							<label for=""><strong>Nombre</strong></label>
							<input class="form-control form-control-sm" 
							type="text" id="name_modificar" 
							placeholder=""
							autocomplete="off"
							>
						</div>
						<div class="col-12 col-lg">
							<label for=""><strong>Apellido</strong></label>
							<input class="form-control form-control-sm" 
							type="text"
							type="text" id="last_modificar" 
							placeholder=""
							autocomplete="off"
							></div>
						</div>
						<br>
						<div class="row">
							<div class="col-12 col-lg">
								<label for=""><strong>Correo</strong></label>
								<input class="form-control form-control-sm" 
								type="text" id="email_modificar"
								placeholder=""
								autocomplete="off"
								>
							</div>
							<div class="col-12 col-lg">
								<label for=""><strong>Nickname</strong></label>
								<input class="form-control form-control-sm" 
								type="text" id="nickname_modificar"
								placeholder=""
								autocomplete="off"
								>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col">
								<div class="form-group">
									<label for=""> <strong>¿Activo?</strong></label>
									<select id="activeMod" class="form-control" name="active">
										<option value="1">Si</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>

							<div class="col">
								<div class="form-group">
									<label for=""> <strong>Teléfono</strong></label>
									<input type="text" pattern="^[0-9]+" id="telefonoMod"
									class="form-control" 
									name="telefono" 
									autocomplete="off">
								</div>
							</div>
						</div>

						
						<div class="row">
							<div class="col-12 col-lg">
								<label for=""><strong>Nivel</strong></label>
								<input class="form-control form-control-sm" 
								type="text" id="nivel_modificar"
								placeholder=""
								autocomplete="off"
								>
							</div>
							<div class="col-12 col-lg">
								<label for=""><strong>Password</strong></label>
								<input class="form-control form-control-sm" 
								type="text" id="password_modificar"
								autocomplete="off"
								>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-3">
								<div class="form-group">
								<label for=""> <strong>Venta Propia %</strong></label>
								<input class="form-control" type="number" name="porcentaje_ventaPropia" 
								id="porcentaje_ventaPropiaMod">
								</div>
							</div>
			
							<div class="col-3">
								<div class="form-group">
								<label for=""> <strong>Venta Parcial %</strong></label>
								<input class="form-control" type="number" name="porcentaje_ventaParcial" id="porcentaje_ventaParcialMod">
								</div>
							</div>
			
							<div class="col-3">
								<div class="form-group">
								<label for=""> <strong>Venta Ajena %</strong></label>
								<input class="form-control" type="number" name="porcentaje_ventaAjena" id="porcentaje_ventaAjenaMod">
								</div>
							</div>
			
							<div class="col-3">
								<div class="form-group">
								<label for=""> <strong>Venta Otra Persona %</strong></label>
								<input class="form-control" type="number" name="porcentaje_ventaPorOtraPersona" id="porcentaje_ventaPorOtraPersonaMod">
								</div>
							</div>
						</div>

						<br>

						<div class="container">	
							<br>	
							<br>	
							<center>
								
								<div class="row">
									<div class="form-group">
										<div class="custom-file">
											<input name="image" id="inputFile2" type="file" class="custom-file-input" lang="es">
											<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
										</div>
										<br> 
										<br>   
										<img id="img2" width="150"><br/>
									</div>
								</div>
							</center>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button 
							class="btn btn-primary" 
							id="actualizar_uss"
							type="button" 
						>
							Actualizar usuario
						</button>
					</div>
				</div>
			</div>
		</div>