@extends('layouts.bums')

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
				<div class="table-responsive">
					<br>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" 
						class="btn btn-primary" 
						data-toggle="modal" data-target=".bd-example-modal-lg"	
						value=""
						Onclick=''>
						Agregar imagenes nuevas
					</button>
				</div>
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
												<img id="img1" width="175" height="200"><br/>
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
				@if ($imagenes->hasPages())
				<ul class="pagination justify-content-center">
					{{-- Previous Page Link --}}
					@if ($imagenes->onFirstPage())
						<li class="page-item disabled"><span class="page-link"><</span></li>
					@else
						<li class="page-item"><a class="page-link" href="{{ $imagenes->previousPageUrl() }}" rel="prev"><</a></li>
					@endif

					@if($imagenes->currentPage() > 3)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $imagenes->url(1) }}">1</a></li>
					@endif
					@if($imagenes->currentPage() > 4)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@foreach(range(1, $imagenes->lastPage()) as $i)
						@if($i >= $imagenes->currentPage() - 2 && $i <= $imagenes->currentPage() + 2)
							@if ($i == $imagenes->currentPage())
								<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
							@else
								<li class="page-item"><a class="page-link" href="{{ $imagenes->url($i) }}">{{ $i }}</a></li>
							@endif
						@endif
					@endforeach
					@if($imagenes->currentPage() < $imagenes->lastPage() - 3)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@if($imagenes->currentPage() < $imagenes->lastPage() - 2)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $imagenes->url($imagenes->lastPage()) }}">{{ $imagenes->lastPage() }}</a></li>
					@endif

					{{-- Next Page Link --}}
					@if ($imagenes->hasMorePages())
						<li class="page-item"><a class="page-link" href="{{ $imagenes->nextPageUrl() }}" rel="next">></a></li>
					@else
						<li class="page-item disabled"><span class="page-link">></span></li>
					@endif
				</ul>
			@endif
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
							</td>
							<td>
								<center>
									<img width="450" src="img/{{ $imagen->imagen}}" alt="" >
								</center>
							</td>
							<td>
								<div class="btn-group" role="group" aria-label="Basic example">

									<button type="button" 
									class="btn btn-secondary" ml-auto=""
									data-toggle="modal" data-target=".eliminar-imagen" Onclick="mandaridM({{$imagen->id}});">Eliminar</button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@if ($imagenes->hasPages())
				<ul class="pagination justify-content-center">
					{{-- Previous Page Link --}}
					@if ($imagenes->onFirstPage())
						<li class="page-item disabled"><span class="page-link"><</span></li>
					@else
						<li class="page-item"><a class="page-link" href="{{ $imagenes->previousPageUrl() }}" rel="prev"><</a></li>
					@endif

					@if($imagenes->currentPage() > 3)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $imagenes->url(1) }}">1</a></li>
					@endif
					@if($imagenes->currentPage() > 4)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@foreach(range(1, $imagenes->lastPage()) as $i)
						@if($i >= $imagenes->currentPage() - 2 && $i <= $imagenes->currentPage() + 2)
							@if ($i == $imagenes->currentPage())
								<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
							@else
								<li class="page-item"><a class="page-link" href="{{ $imagenes->url($i) }}">{{ $i }}</a></li>
							@endif
						@endif
					@endforeach
					@if($imagenes->currentPage() < $imagenes->lastPage() - 3)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@if($imagenes->currentPage() < $imagenes->lastPage() - 2)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $imagenes->url($imagenes->lastPage()) }}">{{ $imagenes->lastPage() }}</a></li>
					@endif

					{{-- Next Page Link --}}
					@if ($imagenes->hasMorePages())
						<li class="page-item"><a class="page-link" href="{{ $imagenes->nextPageUrl() }}" rel="next">></a></li>
					@else
						<li class="page-item disabled"><span class="page-link">></span></li>
					@endif
				</ul>
			@endif			</div>


		</div>

	</div>
</div>
</main>
@include('modal.eliminar-imagen')
<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

@endsection