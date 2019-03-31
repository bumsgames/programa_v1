<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Prueba</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
</head>
<body>
	<div class="container">
		<h1>LISTA DE ARTICULOS DISPONIBLES DE: {{ Auth::user()->name }} {{ Auth::user()->lastname }}</h1>
		<?php $i = 1; ?>
		<?php $categoria = ''; ?>
		<div class="row">
			<div class="col">
				<?php $cuenta = 0; ?>
				@foreach($articles_mios as $articulo)
					@foreach($articles_mios as $articulo2)
						@if(($articulo->id != $articulo2->id) && ($articulo->name == $articulo2->name) && ($articulo->porcentaje == $articulo2->porcentaje) && ($articulo->category == $articulo2->category))
						@endif
					@endforeach
				@endforeach
				@foreach($articles_mios as $articulo)
				@if($articulo->pertenece_category->category != $categoria)
				<?php $categoria = $articulo->pertenece_category->category; ?>
				<?php $i = 1; ?>
				<br>
				<br>
				<h4><strong>{{ $categoria }}</strong></h4>
				<br>
				<br>
				@endif

				<strong><?php echo $i++; ?></strong>. {{$articulo->name }}. <strong>Cantidad:</strong> {{$articulo->quantity}}. <strong>Acción:</strong> {{$articulo->porcentaje}}%,
				<strong> {{ number_format((($articulo->price_in_dolar)*$articulo->quantity*$articulo->porcentaje/100 )	, 2, ',', '.') }} $</strong>	
				<br><br>	
				@endforeach

				@foreach($articles_price as $aprice)
				<?php $cuenta += $aprice->price_in_dolar*$aprice->quantity*$aprice->porcentaje/100; ?>	    
				@endforeach

			</div>
 
		</div>
		<br>
		<br>
		<h3>
			Articulos disponibles: {{ $articles_price->count() }}
			<br>
			Valor en Articulos de {{$user->name}} {{$user->lastname}}: {{ number_format((($cuenta) )	, 2, ',', '.') }} $
			<br>
			<br>

		</h3>
	</div>

</body>
</html>