<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style type="text/css">
	</style>
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
				<th scope="col">Articulo</th>
				<th scope="col">Duennos</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
		<?php $count_movimientos=0;?>
		<?php $ganancia_neta=0;?>
		<tbody>
			@foreach($movimientos as $movimiento)
			<?php $count_movimientos+=1?>
			<tr>
				<td> 
					<b>{{ $count_movimientos }}</b>. {{$movimiento->created_at}}
				</td>
				<td>
					@if(starts_with($movimiento->movimiento->description, 'Venta Realizada'))
					@foreach($movimiento->movimiento->venta as $movimiento->movimiento->venta)
					<strong>Artículo: </strong>{{$movimiento->movimiento->venta->articulo->name}} | {{$movimiento->movimiento->venta->articulo->pertenece_category->category}} <b>
						({{$movimiento->movimiento->venta->articulo->email}})
					</b>
					<br>
					<strong>Cantidad: </strong>{{$movimiento->movimiento->cantidad}}
					<br>
					<strong>Inversion: </strong>{{$movimiento->movimiento->inversion}} $
					<br>
					<strong>Cliente: </strong>{{$movimiento->movimiento->venta->cliente->name}} {{$movimiento->movimiento->venta->cliente->lastname}}
					<?php break;?>
					@endforeach
					@else
					NO APLICA
					@endif
				</td>
				<td>
					<b>{{ $count_movimientos }}</b>. <strong>Entidad: </strong>{{$movimiento->movimiento->entidad}}
					<br>
					<br>
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
					Acciones
					<br>
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
					<br>
					<br>
					NOTA: <b>{{$movimiento->movimiento->note_movimiento }} </b>
					<br>
					<br>
				</td>
				<td style="width: 300px;">
					<strong>Precio de venta: </strong> {{number_format($movimiento->movimiento->price * $movimiento->movimiento->cantidad, 0, ',', '.')." ".$movimiento->movimiento->moneda->sign}}
					<br>
					<strong>Precio del dolar del día: </strong>{{number_format($movimiento->movimiento->dolardia, 0, ',', '.')}} Bs
					<br>
					<b>Precio de venta ($): </b>
@if($movimiento->movimiento->moneda->valor != 0)
	{{ number_format(($movimiento->movimiento->price / $movimiento->movimiento->moneda->valor), 2, ',', '.') }} $
@endif
					<br>
					<b>Ganancia neta ($)</b>: 
@if($movimiento->movimiento->moneda->valor != 0)
	{{ number_format(($movimiento->movimiento->price / $movimiento->movimiento->moneda->valor) - $movimiento->movimiento->inversion, 2, ',', '.') }} $
@endif


@if($movimiento->movimiento->dolardia != 0)
	<?php $ganancia_neta+= (($movimiento->movimiento->price / $movimiento->movimiento->dolardia) - $movimiento->movimiento->inversion) ?>
@endif
					
				</td>
			</tr>
			<?php $alterno=0; ?>
			@endforeach
		</tbody>
	</table>

	<br>
	<div style="padding:0 20px;">
	<h4><strong>Inicio:</strong> {{ $inicio }} <strong>Final:</strong> {{ $fin }}</h4>
	<h6>
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
	</h6>
	<br>
		<h1>Ganancia neta total de la empresa: {{ number_format($ganancia_neta, 2, ',', '.') }} $</h1>
		<hr style="border-color: black; border: solid;">
		<h1>Total recibido por banco:</h1>
		<ul>
			@foreach ($movi_banco as $banco)
				<li><h4><strong>{{$banco->entidad}}:</strong> {{ number_format($banco->porbanco, 2, ',', '.') }} $</h4></li>
			@endforeach
		</ul>
		<hr style="border-color: black; border: solid;">
		<h1>Total recibido por categoria:</h1>
		<ul>
			@foreach ($movi_cat as $categoria)
				<li><h4><strong>{{$categoria->category}}:</strong> {{ number_format($categoria->porcate, 2, ',', '.') }} $</h4></li>
			@endforeach
		</ul>
	</div>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>