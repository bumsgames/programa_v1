
<head>
	<title>BumsGames Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Main CSS-->

	<link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ url('css/datatables.min.css') }}">

	<!-- Font-icon css-->

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="icon" href="{{ url('img/LOGO.ico') }}" /> {{--
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css"
  /> --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">

  </script>


</head>

<body>
	<hr>

	<hr>
	<table class="table" style="font-size: 10px;">
		<tbody id="tablaCarrito2">
			<?php $i = 1; ?>
			<?php $precio = 0; ?>
			<?php $acumuladoTotal = 0; ?>
			<?php $inversion_total = 0; ?>
			<?php $acumulado_venta = 0; ?>
			<?php $ganancia_usuario = 0; ?>
			<?php $ganancia_usuario_sincobrar = 0; ?>
			<?php $j = 0; ?>


			@foreach( $ventas as $venta )
			<tr>
				<td>
					venta numero: {{ $venta->id }}
					<br>
					

					Cliente: {{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }}
					<br>
					<br>
					Vendedor:  {{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}
					<br>
					<br>
					@isset ($venta->ventaEnvio->empresa)
					Envio: {{ $venta->ventaEnvio->empresa }}
					@else
					Sin envio
					@endisset
					<br>
					<hr>
					Articulos de esta venta:
					<br>
					<br>
					<?php $inversionArticulo = 0; ?>
					@foreach ( $venta->ventaArticulo as $articulo)
					<?php $j += 1; ?>
					{{ $j }}. {{ $articulo->articulo->name }}
					<br>
					Cantidad: {{ $articulo->cantidad }}
					<br>
					Dueños:
					@foreach ($articulo->articulo->duennos->where('id',Auth::id()) as $dueño)
					{{ $dueño->name }}
					{{ $dueño->lastname }}
					{{$dueño->pivot->porcentaje }} %
					@endforeach
					{{-- @isset ($articulo->duennos->where('id',Auth::id()))
					    {{ $articulo->duennos->where('id',Auth::id()) }} %
					    @endisset --}}

					    <br>
					    Inversion: {{  number_format($articulo->inversionIndividual, 2, ',', '.') }} $
					    {{-- {{ $articulo }} --}}
					    <br>

					    <?php $inversionArticulo = 0;  ?>
					    <hr>
					    @endforeach

					    <?php $j = 0; ?>




					</td>
					<td>
						PAGO COMPLETO
						<br>
						<br>

						@foreach ( $venta->ventaPagoCompleto as $pagoCompleto)

						<hr>
						<h6>{{ $pagoCompleto->bancoEmisor }}</h6>
						{{ number_format($pagoCompleto->monto, 2, ',', '.') }}
						{{ $pagoCompleto->moneda->sign }}
						{{ $pagoCompleto->referencia }}
						<br>
						<br>

						@if ($pagoCompleto->id_coin != 2)  
						Pago ($): {{ number_format($pagoCompleto->monto / $pagoCompleto->dolardia, 2, ',', '.') }} $
						<br>
						Tasa: {{ $pagoCompleto->dolardia }} {{ $pagoCompleto->moneda->sign }}

						@else
						Pago ($): {{ number_format($pagoCompleto->monto / $pagoCompleto->dolardia, 2, ',', '.') }} $
						<br>

						@endif

						<?php $acumulado_venta += $pagoCompleto->monto / $pagoCompleto->dolardia  ; ?>
						<br>
						<br>

						@endforeach
						<hr>


						Total pagado: {{ number_format($acumulado_venta, 2, ',', '.') }} $
						<?php $acumuladoTotal += $acumulado_venta ; ?> 
						<br> 
						Inversion: {{ number_format($venta->inversion_total, 2, ',', '.') }} $
						<?php $inversion_total += $venta->inversion_total ; ?>
						<br>
						Ganancia: {{ number_format($acumulado_venta - $venta->inversion_total, 2, ',', '.') }} $
						<?php $acumulado_venta = 0; ?>
					</td>

					<td>
						<?php $inversionArticulo = 0; ?>
						<?php $pago_sum = 0; ?>
						@foreach ( $venta->ventaArticulo as $articulo)
						{{ $articulo->articulo->name }}
						<br>
						Cantidad: {{ $articulo->cantidad }}
						<br>
						<br>
						Inversion: {{  number_format($articulo->inversionIndividual, 2, ',', '.') }} $
						{{-- {{ $articulo }} --}}
						<br>
						@foreach ( $articulo->pagoArticulo  as $pago)
						<hr>
						@if ($pago->moneda->id !=2)
						{{ $pago->bancoEmisor }}
						<br>
						<br>
						{{number_format($pago->monto, 2, ',', '.')  }} {{ $pago->moneda->sign }} 
						<br>
						Equivalente: {{ number_format($pago->monto / $pago->dolardia, 2, ',', '.') }} $
						@else
						{{ number_format($pago->monto, 2, ',', '.') }} {{ $pago->moneda->sign }} 

						@endif
						<?php $inversionArticulo += $pago->monto / $pago->dolardia;  ?>
						<br>




						<br>
						<br>
						<?php $pago_sum++; ?>
						@endforeach
						suma: {{ $pago_sum }}
						<br>
						PAGO TOTAL DE ESTE PRODUCTO: {{ $articulo->articulo->name }}
						<hr>
						Pago Total: {{  number_format($inversionArticulo, 2, ',', '.') }} $
						<br>
						Inversion: {{  number_format($articulo->inversionIndividual, 2, ',', '.') }} $
						<br>
						<?php $inversionArticulo = 0;  ?>
						<hr>
						@endforeach
					</td>
{{-- 
				<td>
					@foreach ( $venta->ventaArticulo as $articulo)
					{{ $articulo->pagoArticulo }}
					@endforeach
				</td> --}}
				<td >	
					@foreach ( $venta->ventaArticulo as $articulo)
					@foreach ( $articulo->pagoArticulo  as $pago)
					@if ($pago->moneda->id !=2)
					{{ $pago->bancoEmisor }}

					<br>
					{{number_format($pago->monto, 2, ',', '.')  }} {{ $pago->moneda->sign }} 
					<br>
					<br>
					Equivalente: {{ number_format($pago->monto / $pago->dolardia, 2, ',', '.') }} $
					@else
					{{ number_format($pago->monto, 2, ',', '.') }} {{ $pago->moneda->sign }} 

					@endif
					<?php $inversionArticulo += $pago->monto / $pago->dolardia;  ?>
					<br>
					{{-- {{ $pago }} --}}
					<hr>
					@foreach ($pago->pagoInvolucrados as $aux)
					{{ $aux->persona->name }} {{ $aux->persona->lastname }}
					<br>
					@if ($aux->descripcionInvolucrado == 3)
					<p>Dueño o Socio de Producto: {{ $aux->porcentajeInversion * 100}} %</p>
					@endif
					@if ($aux->descripcionInvolucrado == 1)
					<p>Vendedor (Venta Propia)</p>
					@endif

					@if ($aux->descripcionInvolucrado == 2)
					<p>Venta Parcial</p>
					@endif

					@if ($aux->descripcionInvolucrado == 4)
					<p>Venta Ajena</p>
					@endif

					@if ($aux->descripcionInvolucrado == 5)
					<p>Venta Propia / Otra Persona facturo</p>
					@endif
					{{-- {{ $aux }} --}}
					@if (Auth::id() == $aux->id_agente)
					<p style="color: green;">Dinero a favor</p>
					@if( $aux->cobrado_boolean == 1)
					<p style="color: red;">Este pago ha sido cobrado, no se tomara en cuenta</p>
					@else
					<?php $ganancia_usuario_sincobrar += ( $pago->monto * number_format($aux->porcentajeInvolucrado, 2) / $pago->dolardia) ?>
					@endif
					<?php $ganancia_usuario += ( $pago->monto * number_format($aux->porcentajeInvolucrado, 2) / $pago->dolardia) ?>
					@endif

					{{ number_format($aux->porcentajeInvolucrado, 2) * 100 }} %
					<br>
					<?php $monto_aux = $pago->monto * number_format($aux->porcentajeInvolucrado, 2); ?>
					{{number_format($monto_aux, 2, ',', '.') }}
					{{ $pago->moneda->sign }}
					<br>

					Equivalente: {{  number_format($monto_aux / $pago->dolardia, 2, ',', '.') }} $
					<br>
					<br>
					<?php $inversion_para_este_pago = $articulo->inversionIndividual ?>
					Inversion de este articulo: {{  number_format($inversion_para_este_pago, 2, ',', '.') }} $
					<br>
					<?php $inversion_para_este_pago_individual = ($articulo->inversionIndividual * $aux->porcentajeInversion)/ $pago_sum ?>
					Inversion para este pago: {{  number_format($inversion_para_este_pago_individual / $pago_sum, 2, ',', '.') }} $
					<br>
					<br>
					Inversion de usuario: {{  number_format(($articulo->inversionIndividual * ($aux->porcentajeInversion))/ $pago_sum, 2, ',', '.') }} $
					<br>
					Ganancia de este pago: {{  number_format((($articulo->inversionIndividual) - ($articulo->inversionIndividual * ($aux->porcentajeInversion)))/ $pago_sum, 2, ',', '.') }} $

					<br>
					<hr>
					@endforeach
					<br>
					<br>
					@endforeach
					<hr>
					@endforeach
				</td>

			</tr>


			@endforeach

			{{-- @foreach ($pagoCompletos as $element)
			{{ $element }}
			@endforeach --}}

			@foreach ($ventaArticulo as $element)
			{{ $element }}
			@endforeach
			<h1> INVERSION TOTAL (Empresa):  {{  number_format($inversion_total, 2, ',', '.') }} $</h1>
			<h1> ACUMULADO TOTAL (Empresa):  {{  number_format($acumuladoTotal, 2, ',', '.') }} $</h1>
			<br>
			<h1> GANANCIA TOTAL (Empresa):  {{  number_format($acumuladoTotal - $inversion_total, 2, ',', '.') }} $</h1>
			<br>
			<h1>GANACIA DEL USUARIO (TOTAL): {{  number_format($ganancia_usuario, 2, ',', '.') }} $</h1>
			<h1>GANACIA DEL USUARIO SIN COBRAR: {{  number_format($ganancia_usuario_sincobrar, 2, ',', '.') }} $</h1>
		</tbody>
	</table>
	<hr>
	Recibido por el tipo de Banco:
	@foreach ($pagoCompletos as $element)
	{{ $element }}
	{{ $element->monto }}
	{{ $element->sign }}
	{{ $element->coin }}

	{{ $element->bancoEmisor }}
	@endforeach
	<hr>
</body>


<script src="{{ url('js/jquery3.min.js') }}"></script>


<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bums.js') }}"></script>
<script src="{{ url('js/bums_v2.js') }}"></script>
<script src="{{ asset('js/genesis.js') }}"></script>

<script src="{{ url('js/popper.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/datatables.min.js') }}"></script>
<script src="{{ url('js/datatables-bootstrap.min.js') }}"></script>
<script src="{{ url('js/main.js') }}"></script>
<script src="{{ url('js/plugins/pace.min.js') }}"></script>
<script src="{{url('js/sweet.min.js')}}"></script>