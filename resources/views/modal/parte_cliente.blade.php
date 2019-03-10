<div class="modal fade modal_cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="titulo_cliente_articulo"></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<br>	
			<div class="container">	
				<input type="text" id="id_articulo2" hidden="">
				<div class="row">
				<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>N# Cliente</strong></label>
							<input class="form-control form-control-sm" 
							type="text"
							name="id_client" 
							id="id_client2" 
							placeholder=""
							autocomplete="off"
							readonly="">
						</div>							
					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Nombre</strong></label>
							<input class="form-control form-control-sm" 
							type="text"
							id="name_client2" 
							placeholder=""
							autocomplete="off"
							>

						</div>

					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Apellido</strong></label>
							<input class="form-control form-control-sm" 
							type="text"
							name="lastname_client" 
							id="lastname_client2" 
							placeholder=""
							autocomplete="off"
							>
						</div>
					</div>
					<div class="col-12 col-lg">
						<div class="form-group">
							<label for=""><strong>Num Contacto</strong></label>
							<input class="form-control form-control-sm" 
							type="text"
							id="num_contact2" 
							placeholder=""
							autocomplete="off"
							>
						</div>
					</div>
				</div>

				<br>
				<center>
					<button class="btn" id="borrar_campos">Borrar campos</button>	
					<button class="btn btn-primary" id="agregar_cliente_articulo">Agregar cliente</button>
				</center>
				<br>
				<table class="table table-hover table-responsive" id="table_client2">

				</table>
				<strong>A que cliente(s) pertenece este articulo?</strong>	
				<div class="modal-body">
					<table class="table table-hover table-responsive" id="tabla">
						<thead>	
							<tr>
								<td>#</td>
								<td>Cliente</td>
								<td>Contacto</td>
								<td></td>
							</tr>
						</thead>
						<tbody>	

						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>