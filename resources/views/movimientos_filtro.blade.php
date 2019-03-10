@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
</head>


<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> {{ $title }}</h1>
			<p>Llegamos para hacer la diferencia.</p>
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
				{{-- 				<button type="button" class="btn btn-success" onclick="window.location.href='{{ $url }}'">Movimientos tipo Banco</button> --}}
				<?php $contadores_moneda = 0; ?>

				@foreach($coins as $i)
				<?php $contadores_moneda++; ?>
				@endforeach
				<?php 
				$acumulador = array();
				for ($i=0; $i < $contadores_moneda; $i++) { 
					$acumulador[$i] = 0;
				}
				$i = 0;

				?>
				@include('form_busqueda_venta')
				<br>	
				<input type="text" placeholder="Buscar" class="form-control" id="buscador">
				<br>
				<br>
				<strong>Total de ventas:</strong> {{ $sales->count() }}
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Informacion</th>
								<th scope="col">Transaccion</th>
								<th scope="col">Articulo</th>
								<th scope="col">Sumatoria</th>
								<th scope="col">Fecha</th>

							</tr>
						</thead>
						<tbody>
							<?php $j = 1; ?>
							
							@foreach($sales as $sale)
							<tr>
								<td>
									<?php echo $j++; ?>
								</td>
								<td>
									Entidad: {{ $sale->movimiento->entidad }}
									<br>
									Entidad: {{ $sale->movimiento->descripcion }}
									<br>
									Vendedor: {{$sale->user->name}} {{$sale->user->lastname}}
								</td>
								<td>

									@foreach($sale->movimiento->usuario as $x )
									@if( $x->pivot->porcentaje == 0)
									Comision
									{{ $x->name }} {{ $x->lastname }}

									@if($sale->movimiento->comision)
									<br>
									{{ $sale->movimiento->comision }} {{ $sale->movimiento->moneda->sign }}
									@else
									<br>
									<br>
									FALTA COLOCARLE LA COMISION POR VENDER
									@endif
									<br>	
									<br>

									@else
									Duenno: ({{ $x->name }} {{ $x->lastname }})
									<br>	
									{{ number_format((($x->pivot->porcentaje / 100) *  $sale->movimiento->price) - ($sale->movimiento->comision * ($x->pivot->porcentaje / 100) ), 0, ',', '.')}} {{ $sale->movimiento->moneda->sign }}  ({{ $x->pivot->porcentaje }} %)
									<br>	
									@if($x->pivot->permiso == 1)
									<br>
									@if(starts_with($sale->movimiento->description, 'Venta Realizada'))	
									Este usuario modifica la comision
									<br>
									<br>
									@endif
									@endif
									<br>	
									@endif

									@endforeach
									<br>
									<br>
									<strong>
										Total: 
									</strong>
									{{ number_format($sale->movimiento->price, 0, ',', '.') }}
									{{ $sale->movimiento->moneda->sign }}
								</td>
								<td>
									{{ $sale->articulo->name }} | 
									Categoria: {{ $sale->articulo->pertenece_category->category }}
									<br>
									<br>
									{{ $sale->articulo->email }} | {{ $sale->articulo->password }} | {{ $sale->articulo->password }}
									<br>	
									<br>	
									<strong>Cliente: </strong>{{ $sale->cliente->name }}	{{ $sale->cliente->lastname }}	
									<br>
									<strong>Cantidad:</strong> {{  $sale->movimiento->cantidad }}
									<br>	
									<strong>Precio Unitario:</strong> {{ $sale->movimiento->price }}
									<br>	
									<br>	
									<strong>Total: </strong>{{ number_format($sale->movimiento->price * $sale->movimiento->cantidad, 0, ',', '.') }} |
									{{ $sale->movimiento->moneda->coin }} | {{ $sale->movimiento->entidad }}

									<?php $acumulador[ $sale->movimiento->moneda->id - 1] +=  $sale->movimiento->price * $sale->movimiento->cantidad;?>


								</td>
								<td>
									@foreach($coins as $i)
									<?php echo number_format($acumulador[$i->id - 1], 0, ',', '.')." ".$i->sign." | <br><br>";?>
									@endforeach

								</td>
								<td>
									<strong>	
										Fecha:
									</strong>
									<br>			
									{{ $sale->updated_at->format('d M Y ')}}
									{{-- {{ $sale->updated_at->format("Y-m-d")}} --}}
									<br>
									<br>
									{{ $sale->updated_at->diffForHumans() }}



								</td>
							</tr>
							
							
							
							@endforeach


						</tbody>

					</table>
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
							<button type="button" class="btn btn-primary" id="" value=" " Onclick='Eliminar_mov2();'>Eliminar</button>
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
							<button type="button" class="btn btn-primary" id="" value=" " Onclick='Eliminar_mov();'>Eliminar</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>


</main>

@endsection