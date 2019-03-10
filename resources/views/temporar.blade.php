@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
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
				<button type="button" class="btn btn-success" onclick="window.location.href='{{ $url }}'">Movimientos tipo Banco</button>
				<button type="button"
				class="btn btn-success"
				data-toggle="modal" 
				data-target=".registrar_movimiento"
				id="prueba" 
				>Crear Nuevo movimiento</button>
				@include('modal.registrar_movimiento')
				<br>
				<br>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Informacion</th>
								<th scope="col">Transaccion</th>
								<th scope="col">Articulo</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($sales as $sale)
							@if(ends_with( $sale->movimiento->type , 'bums'))
							<tr>
								<th>
									
								</th>
								<td>
									@if(starts_with($sale->movimiento->description, 'Cuenta Agregada'))
									<strong>	
										Cuenta de:
									</strong>
									{{ $sale->usuario->name }} {{ $sale->usuario->lastname }}
									<br>	
									<br>

									<strong>	
										Entidad:
									</strong>
									{{ $sale->cuenta->entidad }} 
									<br>	
									<br>	

									@endif
									@if(starts_with($sale->movimiento->description, 'Saldo Agregado'))
									<strong>	
										De:
									</strong>
									{{ $sale->usuario->name }} {{ $sale->usuario->lastname }}
									<br>	
									<br>

									<strong>	
										Entidad:
									</strong>
									{{ $sale->movimiento->entidad }} 
									<br>	
									<br>	

									@endif

									@if(starts_with($sale->movimiento->description, 'Saldo Agregado'))
									<strong>	
										De:
									</strong>
									{{ $sale->usuario->name }} {{ $sale->usuario->lastname }}
									<br>	
									<br>

									<strong>	
										Entidad:
									</strong>
									{{ $sale->movimiento->entidad }} 
									<br>	
									<br>	

									@endif
									{{ $sale-> }}
									@if(starts_with($sale->movimiento->description, 'Venta Realizada'))
									Es venta

									@foreach( $sale->venta->articulo->duennos as $duenno)
									<br>
									<br>
									<strong>
										Duenno:
									</strong>
									{{ $duenno->name }} {{ $duenno->lastname }}

									
									@if($duenno->pivot->porcentaje != 100)
									<br>
									<strong>
										Acciones:
									</strong>
									{{ $duenno->pivot->porcentaje }} %

									@endif
									@endforeach
									<br>	
									<br>

									<strong>	
										Entidad:
									</strong>
									{{ $sale->movimiento->entidad }} 
									<br>	
									<br>	
									@endif
									{{-- <strong>
										Articulo de:
									</strong>
									
									<br>
									<br>
									<strong>
										Venta realizada por:
									</strong> --}}
									
									<br>
									<br>
									<strong>
										Nota:
									</strong>
									{{ $sale->movimiento->note }}
									
									

								</td>
								
								<td>
									<strong>
										Tipo: 
									</strong>
									{{ $sale->movimiento->description }} 
									<br>
									<br>

									{{-- <strong>
										Descripcion: 
									</strong>
									
									<br>
									<br>
									<strong>
										Cliente:
									</strong> --}}

									<br>
									<br>
									<strong>
										Monto:
									</strong>
									{{ $sale->movimiento->price }}
									{{ $sale->movimiento->moneda->sign }}
									

									


									
								</div>

							</td>
							<td>
								@if(starts_with($sale->movimiento->description, 'Cuenta Agregada'))
								NO APLICA
								@endif
								@if(starts_with($sale->movimiento->description, 'Saldo Agregado'))
								NO APLICA
								@endif


								






							</td>
							<td>
								
							</td>
							<td>
								


								<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" 
								data-target=".modificar_movimiento"
								Onclick='colocar_comision({{ $sale->id }});'>Modificar</button>
							</td>
						</tr>
						@endif
						@endforeach
					</tbody>

				</table>
			</div>


		</div>

	</div>
</div>

</main>

@include('modal.modificar_movimiento')

<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/bums.js"></script>

@endsection