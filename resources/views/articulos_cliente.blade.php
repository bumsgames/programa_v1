@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Clientes </h1>
			<p>Aqui es donde comienza todo.</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">Ventas</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<input type="text" placeholder="Buscar" class="form-control" id="buscador">
				<br>
				<br>
				<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Cliente</th>
								<th scope="col">Articulo</th>
								<th scope="col">Informacion</th>
							</tr>
						</thead>
						{{ csrf_field() }}
						<?php $i = 1; ?>
						@foreach($articulos as $x)
						<tr>	
							<td>	
								<?php echo $i++; ?>
								<br>	
								<br>	


								
							</td>
							<td>	
								<strong>	Cliente: </strong>
								{{ $x->cliente->name }}
								{{ $x->cliente->lastname }}

								<br>	
								<br>

							</td>
							<td>

								@if(!(ends_with($x->articulo->name,'DEVUELTO')))
								{{ $x->articulo->name }} | {{ $x->articulo->pertenece_category->category }}
								<br>
								{{ $x->articulo->email }} | {{ $x->articulo->password }} | {{ $x->articulo->nickname }}
								@else
								ARTICULO DEVUELTO
								@endif
								<br>
								<br>
								<br>
								@if(isset($x->venta->user->name))
								<strong>Comprado a: </strong> {{ $x->venta->user->name }} {{ $x->venta->user->lastname }}
								@else
								Colocado manualmente, colocar reporte si tiene una idea de mejora.
								@endif
								
							</td>
							<td>	
								<?php echo $x->informacion;?>
								<br>
								<br>
								<strong>	
									Dia de compra:
								</strong>
								{{ $x->created_at->format('d M Y ')}}
								{{-- {{ $x->created_at->format("Y-m-d")}} --}}
								<br>
								<br>
								{{ $x->created_at->diffForHumans() }}
								<br>
								<br>
								@if(ends_with($x->articulo->name,'DEVUELTO'))
								<br>
								<strong>	
									Dia de devolucion:
								</strong>
								{{ $x->updated_at->format('d M Y ')}}
								{{-- {{ $x->updated_at->format("Y-m-d")}} --}}
								<br>
								<br>
								{{ $x->updated_at->diffForHumans() }}
								<br>

								@endif
							</td>
							<td>
								<button class="btn btn-primary" onclick="devolver({{ $x->articulo->id }},{{ $x->id }}, '{{ $x->cliente->name }} {{ $x->cliente->lastname }}', '{{ $x->articulo->name }}','{{ $x->articulo->pertenece_category->category }}');">Devolver articulo</button>
							</td>
						</tr>


						@endforeach
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