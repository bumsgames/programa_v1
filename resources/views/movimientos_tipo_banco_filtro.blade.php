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
				@include('form_tipo_banco_busqueda')
				<div style="font-size: 12px;">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Fecha</th>
									<th scope="col">Vendedor</th>
									<th scope="col">Articulo</th>
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
								@foreach($sales as $venta)
								<tr>
									<td>
										{{ $venta->created_at->format('d - m - Y ') }}
										<br>
										{{ $venta->created_at->format('H:i:s') }}
									</td>
									<td>
										{{ $venta->user->name }} {{ $venta->user->lastname }}
									</td>
									<td>
										{{ $venta->articulo->name }} ||||| {{ $venta->articulo->pertenece_category->category }}
									</td>
									<td>
										{{ $venta->movimiento->price }} {{ $venta->movimiento->moneda->sign }}
										<?php $acumulador[ $venta->movimiento->moneda->id - 1] +=  $venta->movimiento->price;?>
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