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
				@if($articulo->pertenece_category->category != $categoria)
				<?php $categoria = $articulo->pertenece_category->category; ?>
				<?php $i = 1; ?>
				<br>
				<br>
				<h4><strong>{{ $categoria }}</strong></h4>
				<br>
				<br>
				@endif

				<strong><?php echo $i++; ?></strong>. {{$articulo->name }}. 
				<strong> {{ number_format((($articulo->price_in_dolar) )	, 2, ',', '.') }} $</strong>	
				<br><br>	
				@endforeach

				@foreach($articles_price as $aprice)
				<?php $cuenta += $aprice->price_in_dolar*$aprice->porcentaje/100; ?>	    
				@endforeach

			</div>
 
		</div>
		<br>
		<br>
		<h3>
			Articulos disponibles: {{ $articles_mios->count() }}
			<br>
			Valor aproximado de la lista escrita: {{ number_format((($cuenta) )	, 2, ',', '.') }} $
			<br>
			<br>
			<small>
				Esta actualizacion no es exacta.
			</small>
		</h3>
	</div>

</body>
</html>