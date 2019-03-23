@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')


<?php $contadores_moneda = 0; ?>

@foreach($coins as $i)
<?php $contadores_moneda++; ?>
@endforeach
<?php echo $contadores_moneda; 
$acumulador = array();
for ($i=0; $i < $contadores_moneda; $i++) { 
	$acumulador[$i] = 0;
}
$i = 0;

?>

<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> {{ $title }}</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<form action="movimientos_tipo_banco_personal_filtro" method="post">
					<br>
					{{ csrf_field() }}
					<input type="text" name="type" value="{{ $movement }}" hidden="">
					<div class="form-row align-items-center">
						<div class="col-md-4">
							<label for="validationCustomUsername">Fecha de comienzo</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend">Comienzo: </span>
								</div>
								<input type="date" class="form-control" name="fecha_inicio" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required="">
								<div class="invalid-feedback">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<label for="validationCustomUsername">Fecha final</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend">Final: </span>
								</div>
								<input type="date" class="form-control" id="validationCustomUsername" name="fecha_final" placeholder="Username" aria-describedby="inputGroupPrepend" required="">
								<div class="invalid-feedback">

								</div>
							</div>
						</div>
						<div class="col-md-4">
							<label for="validationCustomUsername">Usuario</label>
							<select class="form-control" name="id_usuario" id="">
								@foreach($usuarios as $usuario)
								<option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->lastname }}</option>
								@endforeach
							</select>

						</div>
					</div>	
					<br>	
					<center>
						<button class="btn btn-primary">Buscar</button>
					</center>
					<br>	

				</form>
				<input type="text" id="movement" value="{{ $movement }}" hidden="">
				<button type="button" class="btn btn-success"
				onclick="window.location.href='{{ $url }}'">Movimientos tipo Standar</button>
				<button type="button"
				class="btn btn-success"
				data-toggle="modal" 
				data-target=".registrar_movimiento"
				id="prueba" 
				>Crear Nuevo movimiento</button>
				<br>
				<br>
				<div style="font-size: 12px;">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Fecha</th>
									<th scope="col">Descripcion</th>
									<th scope="col">Monto</th>
									<th scope="col">N# operacion</th>
									<th scope="col">Saldo</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$bs = 0;
								$dolar = 0;
								$pesoA = 0;
								?>
								<?php $i = 1; ?>
								@foreach($movimientos as $movimiento)
								<tr>
									<td>
										<strong>{{ $movimiento->created_at->format('d - m - Y ') }}</strong>
										<br>
										{{ $movimiento->created_at->format('H:i:s') }}
									</td>
									<td>
										{{ $movimiento->movimiento->description }} || {{ $movimiento->descripcion_movimiento }} ||  {{ $movimiento->movimiento->note_movimiento }}
										
									</td>
									<td>
										@if($movimiento->porcentaje != 0)
										<strong>Acciones:</strong> {{ $movimiento->porcentaje }} % |	
										<strong>Total:</strong> {{ number_format(($movimiento->movimiento->price * ($movimiento->porcentaje / 100) - ($movimiento->comision * ($movimiento->porcentaje / 100))), 0, ',', '.')	 }} 
										{{  $movimiento->movimiento->moneda->sign }}
										<?php $acumulador[ $movimiento->movimiento->moneda->id - 1] +=  ($movimiento->movimiento->price * ($movimiento->porcentaje / 100)) - ($movimiento->comision * ($movimiento->porcentaje / 100) );?>
										@else
										@if( $movimiento->comision == 0)
										<p style="color: red;">VENTA REALIZADA | LE DEBEN COLOCAR LA COMISION</p>
										@else
										<strong>Total: </strong> {{ number_format($movimiento->comision * $movimiento->cantidad, 0, ',', '.')	 }} {{  $movimiento->movimiento->moneda->sign }}
										<?php $acumulador[ $movimiento->movimiento->moneda->id - 1] +=  $movimiento->comision;?>
										@endif
										@endif
									</td>
									<td>
										<strong>
											{{ $movimiento->movimiento->id }}
										</strong>
									</td>
									<td>
										@foreach($coins as $i)
										<?php echo number_format($acumulador[$i->id - 1], 0, ',', '.')." ".$i->sign." | ";?>
										@endforeach
									</td>
									
									
									
								</tr>
								@endforeach

							</tbody>

						</table>
					</div>
				</div>
			</div>

		</div>
	</div>

</main>

@include('modal.registrar_movimiento')

@endsection