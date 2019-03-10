@extends('layouts.bums')

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Sesion de Tareas</h1>
			<p>Este atento, es posible que se le haya asignado alguna tarea.</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="/homework">Tareas generales</a></li>
			<li class="breadcrumb-item"><a href="/individual_duties">Mis tareas</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body"> <h5 class="modal-title">El orden domina el negocio</h5> </div>
				<div class="table-responsive">
					<br>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" 
						class="btn btn-primary" 
						data-toggle="modal" data-target=".bd-example-modal-lg"	
						value=""
						Onclick=''>
						Agregar nueva tarea
					</button>
				</div>
				<!-- Modal -->
				<div aria-hidden="true" class="modal fade bd-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Asignar actividad</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="row">
							</div>
							<div class="container">

								<form action="">
									<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
										<strong> Genero Agregado Correctamente.</strong>
									</div>
									<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
									<div class="form-group">
										<label for="">De:</label>
										<input type="text" name="de_usuario" id="de_usuario" class="form-control" value="{{ Auth::user()->id }}" hidden="">
										<input type="text" class="form-control" value="{{ Auth::user()->name }} {{ Auth::user()->lastname }}" readonly="" >
									</div>
									<div class="form-group">
										
										@if(auth()->user()->level >= 7)
										<label for="">Para:</label>
										<select class="form-control form-control-sm" name="para_usuario" id="para_usuario">
											@foreach($users as $user)
											<option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
											@endforeach
										</select>
										@else
										<input type="text" id="para_usuario" class="fomr-control" readonly="" value="{{ Auth::id() }}" hidden="">
										@endif
										<!--<input type="text" name="para_usuario" id="para_usuario" class="form-control" >-->
									</div>
									
									<div class="form-group">
										<label for="">Mensaje:</label>
										<input type="text" name="mensaje" id="mensaje" class="form-control" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="">Status</label>
										<select class="form-control form-control-sm" name="status" id="status">
											@foreach($Status as $status)
											<option value="{{$status->id}}">{{$status->name}}</option>
											@endforeach
										</select>
										<!--<input type="text" name="status" id="status" class="form-control" hidden="" value=1> -->
									</div>
									<div class="modal-footer">
										<button type="button" id="xxx" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" id="agregar_tarea">Agregar tarea</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
			<br>
			<div id="select" class="panel-body">
				<div class="item form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Status">Categoría <span
						class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select required="required" class="form-control" name="Statuses" id="statuses"
							value="{{ old('Status') }}">
							<option value=""> Todos los status</option>
							@foreach ($Status as $status)
							<option value="{{$status->name}}">{{$status->name}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<table class="table">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<br>
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Quien Asigna</th>
							<th scope="col">A Realizar por:</th>
							<th scope="col">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						@foreach($Homeworks as $homeworks)
						
						<tr>
							<th scope="row"><?php echo $i++; ?></th>
							<td>	
								<strong>
									Usuario
								</strong>
								{{ $homeworks->enviado_de->name}} {{ $homeworks->enviado_de->lastname}} 
								<br>
								<br>
								<div class="form-group">
									<label for="">Fecha: {{ $homeworks->created_at->diffForHumans() }}</label>
								</div>

								<br>
								<label for="exampleFormControlTextarea1"><strong>Mensaje:</strong></label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly="">{{ $homeworks ->mensaje }}</textarea>
								<br>
								<br>

							</td>

							@if( $homeworks->enviado_de->name ==$homeworks->recibido_por->name )
							<td>
								
								La misma persona
								<br>
								<br> 
								@else
								<td>
									
									{{ $homeworks->recibido_por->name }} {{ $homeworks->recibido_por->lastname }}
									<br>
									<br> 
									@endif

								</td>
								<td class="status">

									{{ $homeworks->nombre_status->name}} 
									<br>
									<br>


								</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic example">
										@if(auth()->user()->level >= 9 || ($homeworks->de_usuario == $homeworks->para_usuario))
										<button type="button" 
										class="btn btn-secondary" 
										data-toggle="modal" data-target=".bd-example-modal-lg2"	
										value="{{ $homeworks->id }} "
										Onclick="mostrar_actuales({{ $homeworks->id }}, '{{ $homeworks->enviado_de->name }}', '{{ $homeworks->enviado_de->lastname }}');">
										Modificar

										
										<button type="button" 
										class="btn btn-secondary" 
										data-toggle="modal" data-target=".bd-example-modal-lg3" Onclick="mandarid({{ $homeworks->id }});">Eliminar</button>
										@endif
									</button>
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
<!-- Modal 2 -->
<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg2">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modificar actividad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="row">
			</div>
			<div class="container">

				<form action="">
					<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
						<strong>Agregado Correctamente.</strong>
					</div>
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<input hidden="" id="id" value="" type="text">

					<div class="form-group">
						<label for="">De:</label>
						<input type="text" name="de_usuarioM" id="de_usuarioM" class="form-control" readonly="">
					</div>
					<div class="form-group">
						<label for="">Para:</label>
						<select class="form-control form-control-sm" name="para_usuarioM" id="para_usuarioM" disabled="true">
							@foreach($users as $user)
							<option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
							@endforeach
						</select>
						<!--<input type="text" name="para_usuario" id="para_usuario" class="form-control" >-->
					</div>
					<div class="form-group">
						<label for="">Mensaje:</label>
						<input type="text" name="mensajeM" id="mensajeM" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Status</label>
						<select class="form-control form-control-sm" name="statusM" id="statusM">
							@foreach($Status as $status)
							<option value="{{$status->id}}">{{$status->name}}</option>
							@endforeach
						</select>
						<!--<input type="text" name="status" id="status" class="form-control" hidden="" value=1> -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="modificar_tarea">Modificar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
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
						<button type="button" class="btn btn-primary" id="" value=" " Onclick='Eliminar_nota();'>Eliminar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>



<script>
	$( "#statuses" ).change(function() {
		var rex = new RegExp($(this).val(), 'i');
		$('tr').hide();
		$('tr').filter(function () {
			return rex.test($(".status", this).text());
		}).show();
	});
</script>

@endsection