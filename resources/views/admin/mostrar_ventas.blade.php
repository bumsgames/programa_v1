
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
	@foreach ($usuarios_sistema as $usuario)
	@php
	$total_usuario[$usuario->id] = 0;
	$invertido_u[$usuario->id] = 0;
	$por_cobrar[$usuario->id] = 0;
	@endphp

	@foreach ($bancos as $banco)
	@php
	$total_usuario_banco[$usuario->id][$banco->id] = 0;
	$por_cobrar_banco[$usuario->id][$banco->id] = 0;
	@endphp

	@endforeach
	
	@endforeach
	<table class="table" style="font-size: 10px;">
		<tbody>
			@foreach ($ventas as $venta)
			<tr>
				<td>

				</td>

				<td>
					@php $precio_carrito = 0; @endphp
					@php $suma_inversion = 0; @endphp
					@foreach($venta->articulos as $articulo)
					{{-- Muestra los articulos {{ $articulo }} --}}
					@php 
					$suma_inversion += $articulo->costo_individual * $articulo->cantidad; 
					$precio_carrito += $articulo->precio_venta * $articulo->cantidad;
					@endphp
					@endforeach
					<br>
					<br>


				</td>
				<td>
					<hr>
					Pagos
					<hr>
					@php $total_pagado = 0; @endphp
					@foreach ($venta->pagos as $pago)
					<br>
					{{ $pago->bancoEmisor }}
					<br>
					Monto: {{ $pago->monto }}
					<br>
					Tasa: {{ $pago->dolardia }}
					<br>
					Equivalente: {{ $pago->monto / $pago->dolardia }} $
					@php $total_pagado += $pago->monto / $pago->dolardia; @endphp
					<br>
					@endforeach
					<br>
					Se debia pagar: {{ $precio_carrito }}
					<br>
					<br>
					Total Inversion: {{ $suma_inversion }}
					<br>
					Total pagado: {{ $total_pagado }} $
					<br>
					Total ganancia: {{ $total_pagado - $suma_inversion }} $
					<br>
				</td>
				{{-- precio total de lo que se pago por todo --}}
				<td>
					<hr>
					Division de pagos 
					<hr>
					{{-- {{ $venta->ventaArticulo }} --}}
					@foreach($venta->articulos as $articulo)
					{{-- donde va el 1 va precio carrito --}}

					@php $pago_articulo =  ($articulo->precio_venta / $precio_carrito)  * $total_pagado @endphp
					<hr>
					Otro articulo
					<br>
					<br>
					Nombre (id): {{ $articulo->id }}
					<br>
					Cantidad: {{ $articulo->cantidad }}
					<br>
					<br>
					Cada unidad de este articulo se lleva: {{ $pago_articulo }} $
					<br>
					<b></b>
					@php $contador = 1; @endphp
					@foreach ($venta->pagos as $pago)
					<div style="background-color: gray;">
						<br>
						<br>
						{{ $contador }}.
						{{-- Descripcion del pago --}}
						{{ $pago->bancoEmisor }}
						<br>
						Monto de este Pago: {{ $pago->monto }}
						<br>
						@php $equivale_monto = $pago->monto / $pago->dolardia @endphp
						Equivale: {{$equivale_monto }} $
						<br>
						Pago articulo unidad: {{  $pago_articulo   }} $
						<br>
						@php $porcentaje_se_lleva_unidad = $pago_articulo / $total_pagado @endphp
						Representa: {{   $porcentaje_se_lleva_unidad * 100  }} % 
						<br>
						Representa unidades ({{ $articulo->cantidad }}): {{ $articulo->cantidad *  $porcentaje_se_lleva_unidad * 100  }} % 
						<br>
						Tasa: {{ $pago->dolardia }}
						<br>
						<br>
						@php $total_del_articulo = $pago->monto * ( $pago_articulo / $total_pagado ) @endphp
						Lo que se lleva cada articulo del monto {{  $total_del_articulo   }}
						<br>
						Total por cada articulo por unidades ({{ $articulo->cantidad }}): {{ $total_del_articulo * $articulo->cantidad }}
						<br>
					</div>
					<br>

					@foreach ($articulo->involucrados as $involucrado)
					<hr>
					<h6>{{ $involucrado->persona->name }} {{ $involucrado->persona->lastname }}</h6>
					@if ($involucrado->descripcionInvolucrado == 1)
					<p>Vendedor (Venta Propia)</p>
					@endif

					@if ($involucrado->descripcionInvolucrado == 2)
					<p>Venta Parcial</p>
					@endif

					@if ($involucrado->descripcionInvolucrado == 3)
					<p>Dueño o Socio de Producto: {{ $involucrado->porcentajeInversion * 100}} %</p>
					@endif

					@if ($involucrado->descripcionInvolucrado == 4)
					<p>Venta Ajena</p>
					@endif

					@if ($involucrado->descripcionInvolucrado == 5)
					<p>Venta Propia / Otra Persona facturo</p>
					@endif

					{{-- Si el pago tiene el mismo id que la Persona buscada --}}

					@php $monto_por_usuario = $total_del_articulo * $involucrado->porcentajeInvolucrado * $articulo->cantidad @endphp

					@if ( $involucrado->cobrado_boolean == 0)

					<p style="color: green;">Pago no cobrado</p>

					@php
					$por_cobrar[$involucrado->persona->id] += $monto_por_usuario  / $pago->dolardia;
					$por_cobrar_banco[$involucrado->persona->id][$pago->id_bancoEmisor] +=  $monto_por_usuario  / $pago->dolardia;
					@endphp
					
					@else
					<p style="color: red;">Pago cobrado</p>

					@endif



					
					Lo que se lleva este usuario del monto: {{ $monto_por_usuario }} 
					<br>
					Conversion a Dolar:  {{  $monto_por_usuario_dolar = $monto_por_usuario  / $pago->dolardia }}
					<br>
					Invertido en este monto: {{ $invertido_usuario = ($articulo->costo_individual * $involucrado->porcentajeInversion * ($pago_articulo / $total_pagado) * (($pago->monto / $pago->dolardia) / $pago_articulo) * $articulo->cantidad )}} $
					<br>
					Ganancia = {{ $monto_por_usuario_dolar - $invertido_usuario  }}

					@php

					$total_usuario[$involucrado->persona->id] += $monto_por_usuario_dolar;
					$invertido_u[$involucrado->persona->id] += $invertido_usuario;
					$total_usuario_banco[$involucrado->persona->id][$pago->id_bancoEmisor] += $monto_por_usuario_dolar;
				// $por_cobrar_banco[$usuario->id][$banco->id] = 0;
						// $invertido_usuario[1] += $monto_por_usuario_dolar;
					@endphp

					@endforeach
					@php $contador++; @endphp
					@endforeach

					@endforeach
				</td>
			</tr>
			@endforeach
			@foreach ($usuarios_sistema as $usuario)
			{{ $usuario->name }}
			<br>
			Total que se lleva = {{ $total_usuario[$usuario->id] }}  $;
			<br>
			Invertido = {{ $invertido_u[$usuario->id] }}  $;
			<br>
			Ganancia = {{ $total_usuario[$usuario->id] - $invertido_u[$usuario->id] }} $;
			<br>
			<br>
			Total por cobrar = {{ $por_cobrar[$usuario->id] }}
			<br>
			Total por cobrar: 
			<br>
			@foreach ($bancos as $banco)
			{{ $banco->banco }} = {{ $por_cobrar_banco[$usuario->id][$banco->id]  }}
			<br>
			
			
			

			


			@endforeach

			<br>
			<br>
			Total:
			<br>
			@foreach ($bancos as $banco)
			{{ $banco->banco }} = {{ $total_usuario_banco[$usuario->id][$banco->id]  }}
			<br>


			@endforeach

			<hr>
			@endforeach
		</tbody>
	</table>
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