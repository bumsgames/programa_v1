@extends('layouts.bums')

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Envios</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">

				<div class="tile-body"> </div>
				<div class="table-responsive">
					<br>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" 
						class="btn btn-primary" 
						data-toggle="modal" data-target=".bd-example-modal-lg"	
						value=""
						Onclick=''>
						Agregar nuevo envio
					</button>
				</div>
				<br>
				<br>
				<input type="text" placeholder="Buscar" class="form-control" id="buscador">
				<!-- Modal -->
				<div aria-hidden="true" class="modal fade bd-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Agregar datos del envio</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="row">
							</div>
							<div class="container">

								<form action="">

									<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="">Registrado por:</label>
												<input type="text" name="de_usuario" id="de_usuario" class="form-control" value="{{ Auth::user()->id }}" hidden="">
												<input type="text" class="form-control" value="{{ Auth::user()->name }} {{ Auth::user()->lastname }}" readonly="" >
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for=""><strong>Tracking de envio</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="tracking" 
												id="tracking" 
												placeholder=""
												autocomplete="nope">

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
												name="nombre" 
												id="nombre" 
												
												autocomplete="nodsadsfdaspe">

											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for=""><strong>Precio del articulo</strong></label>
												<input class="form-control form-control-sm" 
												type="text"
												name="price" 
												id="price"
												placeholder=""
												autocomplete="nope">

											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for=""><strong>Tipo de Orden</strong></label>
												<select 
												class="form-control form-control-sm" name="orden" 
												id="orden">
												<option value="Por Enviar.">Por Enviar</option>
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
											name="empresa" 
											id="empresa" 
											placeholder=""
											autocomplete="nope">

										</div>
										
									</div>
									<div class="col">
										<div class="form-group">
											<label for=""><strong>Direccion de envio</strong></label>
											<input class="form-control form-control-sm" 
											type="text"
											name="direccion" 
											id="direccion" 
											placeholder=""
											autocomplete="nope">

										</div>
										
									</div>
									<div class="col">
										<div class="form-group">
											<label for=""><strong>Status de Envio</strong></label>
											<select 
											class="form-control form-control-sm" name="status"
											id="status">
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
										name="recibe" 
										id="recibe" 
										placeholder=""
										autocomplete="nope">

									</div>

								</div>
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Cedula de identidad</strong></label>
										<input class="form-control form-control-sm" 
										type="text"
										name="cedula" 
										id="cedula" 
										placeholder=""
										autocomplete="nope">

									</div>

								</div>
								<div class="col">
									<div class="form-group">
										<label for=""><strong>Numero telefonico</strong></label>
										<input class="form-control form-control-sm" 
										type="text"
										name="telefono" 
										id="telefono" 
										placeholder=""
										autocomplete="nope">

									</div>


								</div>
							</div>
							<div class="modal-footer">
								<button type="button" id="xxx" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" id="agregar_envio">Guardar</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="select" class="panel-body">

		<table class="table">
			<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
			<br>
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Articulo</th>
					<th scope="col">Tipo de Orden</th>
					<th scope="col">Precio del articulo</th>
					<th scope="col">Fecha</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				@foreach($Envios as $envios)

				<tr>
					<th scope="row"><?php echo $i++; ?></th>
					<td>	
						<strong>
							Nombre:
						</strong>
						{{ $envios->articulo}} 

						<br>
						<br>
						<strong>
							Empresa:
						</strong>

						{{ $envios->empresa}}
						<br>
						<br>

						<strong>
							Direccion de envio: 
						</strong>
						{{ $envios->direccion}} 
						<br>
						<br>
						<strong>
							Persona que recibe:
						</strong>
						@if($envios->id_recibeUsuario)
						{{ $envios->recibe_usuario->name }}
						{{ $envios->recibe_usuario->lastname }}
						@else
						{{ $envios->recibe }}
						@endif
						<br>
						<br>
						<strong>
							Cedula:
						</strong>
						{{ $envios->cedula}} 
						<br>
						<br>
						<strong>
							Telefono:
						</strong>
						{{ $envios->num_telefono}} 
						<br>
						<br>
						<strong>
							Status del envio:
						</strong>
						{{ $envios->status}} 
						<br>
						<br>
					</td>

					<td>
						{{ $envios->type_orden}} 
						<br>
						<br>	
						<strong>Tracking: </strong>
						<br>	
						{{ $envios->tracking }}
						<br> 
					</td>
					<td>
						{{ number_format($envios->price, 0, ',', '.') }}
						@if(isset($envios->cuenta))
						{{ $envios->cuenta->moneda->coin }}
						@endif
						<br>
						<br>


					</td>
					<td>
						<strong>Fecha: </strong>
						{{ $envios->created_at->format('d M Y ')}}
						<br>
						<br>
						{{ $envios->created_at->diffForHumans()}}
					</td>
					<td>
						<div class="btn-group" role="group" aria-label="Basic example">
							<button type="button" 
							class="btn btn-secondary" 
							data-toggle="modal" data-target=".bd-example-modal-lg3"	
							value="{{ $envios->id }}"
							Onclick="mostrar_orden({{ $envios->id }},'{{ $envios->creado_Usuario->name }}', '{{$envios->creado_Usuario->lastname }}')">
						Modificar</button>

						<button type="button" 
						class="btn btn-secondary" 
						data-toggle="modal" data-target=".bd-example-modal-lg4" Onclick="mandarid({{ $envios->id }});">Eliminar</button>
					</div>
				</td>
			</tr>
			@endforeach
		</tr>
	</tbody>
</table>
</div>


</div>

</div>
</div>
</main>

@include('modal.modificar_envio')
@include('modal.Eliminar_envios')


@endsection