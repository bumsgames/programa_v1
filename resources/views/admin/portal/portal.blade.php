@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Imagenes</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">

				<div class="tile-body"> </div>
				<form enctype="multipart/form-data" files="true" action="{{ url('portal') }}" method="POST" class="form-inline">
					{{ csrf_field() }}
					<input type="" name="id_creator" value="{{ Auth::id() }}" hidden="">
					<input type="number" class="form-control form-control-sm" name="portal" required="" placeholder="Numero de portal" autocomplete="off">
					<input type="file" name="imagen" id="inputFile1" required>
					<button class="btn btn-primary">Agregar imagen de portal</button>
				</form>
				<br>
				<img style="border: 1px solid;" id="img1" width="100%" height="auto"><br/>
				<div class="table-responsive">
					<br>
					<br>
					<!-- Modal -->
					<div aria-hidden="true" class="modal fade bd-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Agregar imagenes</h5>
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
										</div>

										<div class="col">	
											<div class="form-group">
												<label for="image">
													<strong>
														<label for="image">Imagen de Articulo</label>
													</strong>
												</label>

												<div class="custom-file">
													<input name="image" id="inputFile1" type="file" class="custom-file-input" id="customFileLang" lang="es">
													<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
												</div>
												<br> 
												<br>   
												<center>
													<img style="border: 1px solid;" id="img1" height="200"><br/>
												</center>


											</div>
										</div>
										<div class="modal-footer">
											<button type="button" id="xxx" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary" id="agregar_imagenes">Guardar</button>
										</div>
									</form>
								</div>

							</div>
						</div>
					</div>
				</div>
				<br>
				<div id="select" class="panel-body">
					<strong>Imagenes totales: </strong>{{ $imagenes_cantidad }}
					<table class="table table-responsive">
						<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
						<br>
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Subido por:</th>
								<th scope="col">Imagen</th>
								<th scope="col">Opcion</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							@foreach($imagenes as $imagen)
							<tr>

								<th scope="row"><?php echo $i++; ?></th>

								<td>
									{{ $imagen->pertenece_id_creator->name}} {{ $imagen->pertenece_id_creator->lastname}} 

									<br>
									<br>
									<strong>Creada: </strong> {{ $imagen->created_at->diffForHumans()}}
									<br>	
									<br>	
									<strong>Imagen del portal: </strong> {{ $imagen->portal}}
								</td>
								<td>
									<strong>Imagen del portal: </strong> {{ $imagen->portal}}
									<br>	
									<br>	
									@if($imagen->portal == 3)
									<center>
										<img style="border: 1px solid;" width="250" src="img/{{ $imagen->imagen}}" alt="" >
									</center>
									@else
									<center>
										<img style="border: 1px solid;" width="250" src="img/{{ $imagen->imagen}}" alt="" >
									</center>
									@endif

								</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic example">

										<button type="button" 
										class="btn btn-secondary" ml-auto=""
										Onclick="mandaridMM({{$imagen->id}},{{Auth::user()->level}});">Eliminar</button>

										<button class="btn btn-primary modal" data-toggle="modal" data-target=".eliminar-imagen" type="button" hidden>Text</button>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>


			</div>

		</div>
	</div>
</main>
@include('modal.eliminar-imagen')

@endsection