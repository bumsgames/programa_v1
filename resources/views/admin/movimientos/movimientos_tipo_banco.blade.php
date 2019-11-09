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
								@foreach($sales as $movimiento)
								<tr>
									<td>
										<strong>{{ $movimiento->created_at->format('d - m - Y ') }}</strong>
										<br>
										{{ $movimiento->created_at->format('H:i:s') }}
									</td>
									<td>
										{{ $movimiento->entidad }} | {{ $movimiento->description }} | {{ $movimiento->note_movimiento }}
									</td>
									<td>
										{{ number_format($movimiento->price * $movimiento->cantidad, 0, ',', '.') }}

										{{ $movimiento->moneda->sign }}
										<?php $acumulador[ $movimiento->moneda->id - 1] +=  $movimiento->price * $movimiento->cantidad;?>
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