@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Clientes </h1>
			<p>Aqui es donde comienza todo.</p>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<form action="{{ url('clientesFilt') }}" method="POST" class="form col-12">
					{{ csrf_field() }}
					<div class="input-group mb-3">
						<input name="buscador" type="text" class="form-control" placeholder="Buscar" id="buscador">
						<div class="input-group-append">
							<button class="btn btn-primary" type="submit">Buscar</button> 
						</div>
					</div>
				</form>
				<br>
				<br>
				<strong>Clientes totales: </strong> {{ $clientes_cantidad }}
				@if ($clientes->hasPages())
				<ul class="pagination justify-content-center">
					{{-- Previous Page Link --}}
					@if ($clientes->onFirstPage())
						<li class="page-item disabled"><span class="page-link"><</span></li>
					@else
						<li class="page-item"><a class="page-link" href="{{ $clientes->previousPageUrl() }}" rel="prev"><</a></li>
					@endif

					@if($clientes->currentPage() > 3)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $clientes->url(1) }}">1</a></li>
					@endif
					@if($clientes->currentPage() > 4)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@foreach(range(1, $clientes->lastPage()) as $i)
						@if($i >= $clientes->currentPage() - 2 && $i <= $clientes->currentPage() + 2)
							@if ($i == $clientes->currentPage())
								<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
							@else
								<li class="page-item"><a class="page-link" href="{{ $clientes->url($i) }}">{{ $i }}</a></li>
							@endif
						@endif
					@endforeach
					@if($clientes->currentPage() < $clientes->lastPage() - 3)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@if($clientes->currentPage() < $clientes->lastPage() - 2)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $clientes->url($clientes->lastPage()) }}">{{ $clientes->lastPage() }}</a></li>
					@endif

					{{-- Next Page Link --}}
					@if ($clientes->hasMorePages())
						<li class="page-item"><a class="page-link" href="{{ $clientes->nextPageUrl() }}" rel="next">></a></li>
					@else
						<li class="page-item disabled"><span class="page-link">></span></li>
					@endif
				</ul>
			@endif				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nombre</th>
								<th scope="col">Nickname</th>
								<th scope="col">Numero Contacto</th>
								<th scope="col">Email</th>
								<th scope="col">Nota</th>
								<th scope="col">Foto</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($clientes as $cliente)
							<tr>	
								<td><?php echo $i++; ?> </td>
								<td>	
									{{ $cliente->name }} {{ $cliente->lastname }}
								</td>
								<td>	
									{{ $cliente->nickname }}
								</td>
								<td>
									{{ $cliente->num_contact }}
								</td>
								<td>	
									{{ $cliente->email }}
								</td>
								<td>	
									{{ $cliente->note }}
								</td>
								<td>
									{{ $cliente->image }}	
								</td>
								<td>

									<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
										<form action="ver_articulos" method="post">
											{{ csrf_field() }}
											<input type="text" name="id" hidden="" value="{{ $cliente->id }}">
											<button type="submit" class="btn btn-secondary">Compras</button>
										</form>
										<button type="button" 
											class="btn btn-secondary" 
											data-toggle="modal" 
											data-target=".modal_mod_cliente" 
											value="{{$cliente->id}}" 
											
											Onclick='modificar_cliente_modal(
												{{ $cliente->id }},
												"{{$cliente->name}}",
												"{{ $cliente->lastname }}",
												"{{$cliente->nickname}}",
												"{{ $cliente->password }}",
												"{{$cliente->num_contact}}",
												"{{$cliente->note}}",
												"{{$cliente->email}}")'>
											Modificar
										</button>

										<button type="button" class="btn btn-primary" data-toggle="modal" Onclick="mandaridM({{ $cliente->id }});" data-target=".eliminar_cliente">Eliminar cliente</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if ($clientes->hasPages())
				<ul class="pagination justify-content-center">
					{{-- Previous Page Link --}}
					@if ($clientes->onFirstPage())
						<li class="page-item disabled"><span class="page-link"><</span></li>
					@else
						<li class="page-item"><a class="page-link" href="{{ $clientes->previousPageUrl() }}" rel="prev"><</a></li>
					@endif

					@if($clientes->currentPage() > 3)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $clientes->url(1) }}">1</a></li>
					@endif
					@if($clientes->currentPage() > 4)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@foreach(range(1, $clientes->lastPage()) as $i)
						@if($i >= $clientes->currentPage() - 2 && $i <= $clientes->currentPage() + 2)
							@if ($i == $clientes->currentPage())
								<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
							@else
								<li class="page-item"><a class="page-link" href="{{ $clientes->url($i) }}">{{ $i }}</a></li>
							@endif
						@endif
					@endforeach
					@if($clientes->currentPage() < $clientes->lastPage() - 3)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@if($clientes->currentPage() < $clientes->lastPage() - 2)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $clientes->url($clientes->lastPage()) }}">{{ $clientes->lastPage() }}</a></li>
					@endif

					{{-- Next Page Link --}}
					@if ($clientes->hasMorePages())
						<li class="page-item"><a class="page-link" href="{{ $clientes->nextPageUrl() }}" rel="next">></a></li>
					@else
						<li class="page-item disabled"><span class="page-link">></span></li>
					@endif
				</ul>
			@endif				</div>
			</div>
		</div>
	</div>
</main>
@include('modal.modcliente')
<div class="modal fade eliminar_cliente" tabindex="-15" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Eliminar cliente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label for="">CLIENTE A ELIMINAR</label>
				<input type="text" class="form-control" id="id_eliminar" readonly="">
				<br>
				<br>
				<label for="">CLAVE PARA ELIMINAR</label>
				<input type="password" class="form-control" id="password_eliminar">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="boton_eliminar_cliente">Eliminar cliente</button>
			</div>
		</div>
	</div>
</div>


@endsection
