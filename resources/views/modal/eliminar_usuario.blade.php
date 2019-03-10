<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModal" aria-hidden="true">
					<div class="modal-dialog modal-lg3">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Debe ingresar la clave autorizada para eliminar</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="row">
							</div>
							<div class="container">

								<form action="">
									<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
									<input readonly="" id="id_eliminar" value="" type="text" hidden="">

									<div class="form-group">
										<label for="">CLAVE</label>
										<input type="password" name="clave" id="clave" class="form-control">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" id="" value=" " Onclick='Eliminar_usuario();'>Eliminar</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>