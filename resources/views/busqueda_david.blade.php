<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<center>Busqueda david</center>
	<strong>Inicio:</strong> {{ $inicio }} <strong>Final:</strong> {{ $fin }}
	<br> 
	<strong>USUARIO: </strong> 
	@if($usuario == 0)
	Todos los usuarios
	@else
	@foreach($usuarios as $persona)
	@if($persona->id == $usuario)
	{{ $persona->name }} {{ $persona->lastname }}
	@endif
	@endforeach
	@endif
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Venta externa</th>
				<th scope="col">Duennos</th>
				<th scope="col">Total</th>
				<th scope="col">Articulo</th>
			</tr>
		</thead>
		<?php $count_movimientos=0;?>
		<tbody>
			@foreach($movimientos as $movimiento)
			<?php $count_movimientos+=1?>
			<tr>
				<td> ({{ $count_movimientos }}) (ID: {{$movimiento->id}}) {{$movimiento->created_at}}</td>
				<td>
					@if($movimiento->movimiento->type == 'bums')
					<?php 
					$transaccion="";
					$contar_x=0;
					$alterno=0;
					?>
					@foreach($movimiento->movimiento->usuario as $x)
					@if($x->pivot->porcentaje == 0)
					<?php $alterno++; ?>
					<strong>Venta realizada por: </strong>{{$x->name}} {{$x->lastname}} (10% = {{number_format(((10 / 100) *  $movimiento->movimiento->price), 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}})
					@endif
					@endforeach
					@endif

					<br>
					<strong>Entidad: </strong>{{$movimiento->movimiento->entidad}} (<strong>Nota: </strong>{{$movimiento->movimiento->note_movimiento}})
				</td>
				<td>
					@if($movimiento->movimiento->type == 'bums')
					<?php 
					$transaccion="";
					$contar_x=0;
					?>
					@foreach($movimiento->movimiento->usuario as $x)
					@if($x->pivot->porcentaje != 0)
					@if($alterno == 0)
					<strong>Dueño:</strong> ({{$x->name}} {{$x->lastname}}) | {{number_format((($x->pivot->porcentaje / 100) *  $movimiento->movimiento->price), 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}} ({{$x->pivot->porcentaje}}%)
					<br>
					@else
					
					
					<strong>Dueño:</strong> ({{$x->name}} {{$x->lastname}}) | {{number_format((($x->pivot->porcentaje / 100) * ( $movimiento->movimiento->price - ($movimiento->movimiento->price * 0.10 ))), 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}} ({{$x->pivot->porcentaje}}%)
					<br>
					@endif
					@endif
					@endforeach
					@endif
				</td>
				<td>
					<strong>Total: </strong> {{number_format($movimiento->movimiento->price * $movimiento->movimiento->cantidad, 0, ',', '.')." ".$movimiento->movimiento->moneda->sign}}
					<br>
					<strong>Precio del dolar del día: </strong>{{number_format($movimiento->movimiento->dolardia, 0, ',', '.')}} Bs
				</td>
				<td>
					@if(starts_with($movimiento->movimiento->description, 'Venta Realizada'))
					@foreach($movimiento->movimiento->venta as $movimiento->movimiento->venta)
					<strong>Artículo: </strong>{{$movimiento->movimiento->venta->articulo->name}} | {{$movimiento->movimiento->venta->articulo->pertenece_category->category}} ({{$movimiento->movimiento->venta->articulo->email}})
					<br>
					<strong>Cliente: </strong>{{$movimiento->movimiento->venta->cliente->name}} {{$movimiento->movimiento->venta->cliente->lastname}}
					<?php break;?>
					@endforeach
					@else
					NO APLICA
					@endif
				</td>
			</tr>
			<?php $alterno=0; ?>
			@endforeach
		</tbody>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</table>
</body>
</html>