@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> {{ $title }} 
				@if($title != 'Todas las cuentas')
				({{ Auth::user()->name }} {{ Auth::user()->lastname }})</h1>
				@endif
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">{{ $title }} </a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<button data-toggle="modal" class="btn btn-primary" data-target=".registrar_cuenta">Crear nueva cuenta</button>
				<br>	
				<br>
				<input type="text" placeholder="Buscar" class="form-control" id="buscador">
				<br>

				@include('modal.registrar_cuenta')
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Informacion</th>
								<th scope="col">Saldo</th>
								<th scope="col">Botones</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($cuentas_tuyas as $cuenta)
							<tr>
								<td>
									<?php echo $i; $i++; ?>	
								</td>
								<td>
									<strong>	
										Entidad:
									</strong>
									{{ $cuenta->entidad }}	
									<br>	
									<br>	
									<strong>	
										Correo:
									</strong>
									{{ $cuenta->correo }}

									<br>	
									<br>	
									<strong>	
										Password:
									</strong>
									{{ $cuenta->password }}
									<br>	
									<br>	
									<strong>	
										Nota:
									</strong>
									{{ $cuenta->note_cuenta }}
								</td>	
								<td>
									<?php $saldo = 0; $coin = ''; ?>
									@foreach($cuenta->ordenes as $orden)	
									<?php $saldo += $orden->movimiento->price; ?>
									<?php $coin = $orden->movimiento->moneda->sign;?>
									@endforeach
									{{ number_format($saldo, 0, ',', '.') }} {{ $cuenta->moneda->coin }}
								</td>
								<td>
									<button class="btn btn-primary" data-toggle="modal" data-target=".modificar-cuent" Onclick="buscar_cuent({{$cuenta->id}});">Modificar</button>

									<button class="btn btn-primary price" data-toggle="modal" data-target=".registrar_orden" onclick="modal_orden({{ $cuenta->id }}, '{{ $cuenta->correo }}', '{{ $cuenta->entidad }}')">Crear orden</button>
									 <button class="btn btn-primary " data-toggle="modal" data-target=".eliminar-cuent" Onclick="mandaridM({{$cuenta->id}});">Eliminar</button>
										<br>
										<br>		
									    <form action="ordenes_cuenta" method="post">
										{{ csrf_field() }}
										{{-- <input type="text" name="moneda" value="{{ $x->moneda->coin }}" hidden=""> --}}
										<input type="text" name="id" value="{{ $cuenta->id }}" hidden="">
                                         <button class="btn btn-secondary" type="submit">Ver ordenes</button></a>
									</form>	
									
									@include('modal.registrar_orden')
									@include('modal.eliminar-cuenta')
									@include('modal.modificar_cuenta')
									
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


@endsection