@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Cuentas de {{ Auth::user()->name }} {{ Auth::user()->last }}</h1>
			<p>Aqui es donde comienza todo.</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">Cuentas de {{ Auth::user()->name }} {{ Auth::user()->last }}</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<button data-toggle="modal" data-target=".registrar_cuenta" class="btn">Crear envio a recibir</button>
				<br>
				<br>	
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Informacion</th>
								<th scope="col">Por donde</th>
								<th scope="col">Venta</th>
								<th scope="col">Botones</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($ordenes as $orden)
							@if($orden->type == 'Por recibir')
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
									{{ $orden->price }} 
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
								<strong>Empresa de envio: </strong>{{ $orden->empresa }}
								@endif
							</td>
							<td>	
							</td>
							<td>	
								<button class="btn">Modificar</button>
							</td>
							@endif
							@endforeach
						</tr>

					</tbody>
				</table>
			</div>


		</div>

	</div>
</div>

</main>



<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/bums.js"></script>

@endsection