@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Ordenes de cuenta en espeficifico.</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<a href="../cuentas">Volver a cuentas</a>
				<br>
				<br>
				<input type="text" placeholder="Buscar" class="form-control" id="buscador">
				<br>
	
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Informacion</th>
								<th scope="col">Por donde</th>
								<th scope="col">Botones</th>
							</tr>
						</thead>
						<tbody>
							
							<?php $i=1; ?>
							@foreach($ordenes as $orden)
							<tr>
								<td>
									<?php echo $i; $i++; ?>	
								</td>
								<td><strong>Articulo: </strong>
									{{ $orden->articulo }}
									<br>	
									<br>
									<strong>Status: </strong>
									{{ $orden->status }}
									<br>	
									<br>
									<strong>Precio: </strong>
									{{ number_format($orden->price, 0, ',', '.') }} {{ $orden->cuenta->moneda->coin }} ({{ $orden->cuenta->moneda->sign }})
									<br>	
									<br>	

									<strong>Recibe: </strong>
									{{ $orden->recibe_usuario->name }} {{ $orden->recibe_usuario->lastname }}
									@if(!($orden->venta))
									@if($orden->creado_Usuario != $orden->recibe_usuario)
									<strong>Creado por: {{ $orden->creado_Usuario }}</strong>
									@endif
									@endif
									
									@if($orden->venta){
									<strong>Articulo: </strong>
									{{ $orden->venta }}
								}
								@endif
								
							</td>

							<td>	
								@if($orden->cuenta->entidad)
								<strong>Informacion: </strong>{{ $orden->cuenta->entidad }} || {{ $orden->cuenta->correo }}
								<br>	
								<br>	
								<strong>Fecha: </strong>{{ $orden->created_at->format('d/m/Y') }}
								<br>	
								<br>	
								{{ $orden->created_at->diffForHumans() }}
								@if( $orden->empresa)
								<br>	
								<br>	
								<strong>Empresa de envio: </strong>{{ $orden->empresa }}
								@endif
								
								@endif
								<br>
								<br>	
								<strong>Nota: </strong>{{ $orden->cuenta->note_cuenta }}
							</td>
							<td>
									<div class="btn-group" role="group" aria-label="Basic example">
										<button type="button" 
										class="btn btn-secondary" 
										data-toggle="modal" data-target=".bd-example-modal-lg3"	
										value="{{ $orden->id }}"
										Onclick="mostrar_orden({{ $orden->id }},'{{ $orden->creado_Usuario->name }}', '{{$orden->creado_Usuario->lastname }}')">
									Modificar</button>

									<button type="button" 
									class="btn btn-secondary" 
									data-toggle="modal" data-target=".bd-example-modal-lg4" Onclick="mandarid({{ $orden->id }});">Eliminar</button>
								</div>
							</td>
							@endforeach
							
						</tr>

					</tbody>

				</table>
				@if($ordenes->count() == 0)
				No hay ordenes registradas en esta cuenta
				@endif
			</div>


		</div>

	</div>
</div>

</main>


@include('modal.modificar_orden')
@include('modal.Eliminar_orden')



<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/bums.js"></script>

@endsection