@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

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
				
					@include('admin.movimientos.filtros_ventas')

					<table class="table">
						<tr>	
							<td>
					@if ( $pagado_hoy[0]->pagado != null && $invertido_hoy[0]->invertido != null)
										<h3>HOY</h3>
										<b>N# de Ventas: </b> {{ $venta_hoy->count() }}  <br>
										Pagado: {{ $pagado_hoy[0]->pagado }} $<br>
										Invertido: {{ $invertido_hoy[0]->invertido }} $<br>
										Ganancia: {{ $pagado_hoy[0]->pagado - $invertido_hoy[0]->invertido}} $<br>
									@endif	
					</td>
					<td>
					@if ( $pagado_semana[0]->pagado != null && $invertido_semana[0]->invertido != null)
										<h3>SEMANA</h3>
										<b>N# de Ventas: </b> {{ $venta_semana->count() }} <br>
										Pagado: {{ $pagado_semana[0]->pagado }} $<br>
										Invertido: {{ $invertido_semana[0]->invertido }} $<br>
										Ganancia: {{ $pagado_semana[0]->pagado - $invertido_semana[0]->invertido}} $<br>
									@endif	
					</td>

						</tr>
					</table>

				

										
						{{-- 
										@if (isset() && isset())
											<h3>SEMANA</h3>
											Pagado: <br>
											Invertido: <br>
											Ganancia: <br>
										@endif --}}
						{{-- 				{{ $pagado_semana }}
										{{ $invertido_semana }}
										
										{{ $pagado_hoy }}

										
										{{ $invertido_hoy }} --}}

				<form class="form-inline margin" action="{{  url('n_paginacion') }}" method="get" style="float: right;">
					<div class="form-inline">
						<label style="color: black;">Mostrar resultados: </label>
						<select class="" name="n_paginacion" onchange="this.form.submit()">
							@if ($n_paginacion == 10)
							<option value="{{ $n_paginacion }}">{{ $n_paginacion }}</option>
							<option value="50">50</option>
							<option value="100">100</option>
							@else
							@if($n_paginacion == 50)
							<option value="{{ $n_paginacion }}">{{ $n_paginacion }}</option>
							<option value="10">10</option>
							<option value="100">100</option>
							@else
							<option value="{{ $n_paginacion }}">{{ $n_paginacion }}</option>
							<option value="10">10</option>
							<option value="50">50</option>
							@endif
							@endif
						</select>
					</div>
				</form>
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

				@php $i = 1; @endphp
				<table class="table table-bordered display" style="font-size: 20px;">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col" style="width: 40%;">Transacción</th>
							<th scope="col">Articulos</th>
							<th scope="col">Fecha</th>
							<th><i class="fa fa-trash" aria-hidden="true"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ventas as $venta)
						<tr>
							<td>
								{{ $i++ }}

								@php $precio_carrito = 0; @endphp
								@php $suma_inversion = 0; @endphp

								@foreach($venta->articulos as $articulo)
									{{-- Muestra los articulos {{ $articulo }} --}}
									@php 
										$suma_inversion += $articulo->costo_individual * $articulo->cantidad; 
										$precio_carrito += $articulo->precio_venta * $articulo->cantidad;
									@endphp
								@endforeach

							</td>
							<td>
								<b>Venta realizada por: </b>{{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}
								<br>	

								<b>Cliente: </b>{{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }}<br>	
								<a href="{{ url('factura/'.$venta->id) }}" target="_blank"><button class="btn">Ver factura y entrega</button></a>
								<hr>	
								
								@php $total_pagado = 0; @endphp

								@foreach ($venta->pagos as $pago)
									<br>
									<b>Bando Emisor: </b>{{ $pago->banco->banco }}
									<br>
									<b>Monto:</b> {{ $pago->monto }} {{ $pago->moneda->sign }}
									<br>

									@if ($pago->moneda->id != 2)
										<b>Tasa:</b> {{ $pago->dolardia }} {{ $pago->moneda->sign }} = 1 $
									@endif

									@php 
										$total_pagado += $pago->monto / $pago->dolardia; 
									@endphp

								@endforeach
								<hr>	
								<b>Equivalente:</b> {{ $pago->monto / $pago->dolardia }} $
								<br>	
								<b>Se debia pagar:</b> {{ $precio_carrito }} $
								<hr>	
								<br>
								<br>
								<b>	Inversion Total:</b> {{ $suma_inversion }} $
								<br>
								<b>Pago Total:</b> {{ $total_pagado }} $
								<br>
								<b>	Ganancia Total:</b> {{ $total_pagado - $suma_inversion }} $
								<br>
							</td>
							{{-- precio total de lo que se pago por todo --}}
							<td>
								{{-- {{ $venta->ventaArticulo }} --}}
								Linea de productos: #{{ $venta->articulos->count() }}
								@foreach($venta->articulos as $articulo)
								{{-- donde va el 1 va precio carrito --}}

								@php $pago_articulo =  ($articulo->precio_venta / $precio_carrito)  * $total_pagado @endphp

								<div style="border: solid 2px rgba(0,10,0,0.3); padding: 10px;">
									<b>	Articulo:</b> {{ $articulo->articulo->name }}
									<br>
									<b>Ubicacion: </b>{{  $articulo->articulo->ubicacion2->nombre_ubicacion }}
									<br>
									@if (isset($articulo->articulo->email))
									<b>Correo: </b> {{ $articulo->articulo->email }}
									@endif


									@foreach (	$articulo->articulo->categorias as $categoria)
									<b>Categoria: </b>{{ $categoria->category }}
									<br>	
									@endforeach
									<br>
									<b>Cada unidad de este articulo se lleva:</b> {{ $pago_articulo }} $
									<br>	
									<b>Cantidad:</b> {{ $articulo->cantidad }}
								</div>
								
								<br>
								<b></b>
								

								@endforeach
							</td>
							<td>
								{{$venta->created_at->format('d-m-Y')}}
								<br>	
								{{$venta->created_at->format('H:i')}}
								<br><br>
								{{$venta->created_at->diffForHumans()}}
							</td>
							<td>
								<button type="button" class="btn btn-danger text-center" data-toggle="modal" data-target=".modal-eliminar-venta" Onclick="mandaridM({{ $venta->id }});"><i class="fa fa-trash" aria-hidden="true"></i></button>
							</td>
						</tr>
						@endforeach
						{{-- @foreach ($usuarios_sistema as $usuario)
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
						@endforeach --}}
					</tbody>
				</table>
				<hr>
			</div>

		</div>
	</div>
</div>

</main>


<div class="modal fade modal-eliminar-venta" tabindex="-1" role="dialog" aria-labelledby="myLargeModal" aria-hidden="true">
	<div class="modal-dialog modal-lg3">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Debe ingresar la clave autorizada para eliminar esta Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="row">
			</div>
			<div class="container">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<input readonly="" id="id_eliminar" value="" type="text" hidden="">

					<div class="form-group">
						<label for="">CLAVE</label>
						<input type="password" name="clave" id="clave" class="form-control">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="" value=" " Onclick='Eliminar_Venta();'>Eliminar</button>
					</div>

			</div>

		</div>
	</div>
</div>

<style type="text/css">
td:nth-child(2){
	width: 220px;
}
</style>

@endsection

@section("scripts")

<script>
	form=document.getElementById("excelFiltr");
	function askForExcel() {
		form.action="{{route("exportar_movimientos")}}";
		form.submit();
	}
	function askForSubmit() {
		form.action="{{route("filtrar_movimientos_bums")}}";
		form.submit();
	}
	function askForDavid() {
		form.action="{{route("filtrar_movimientos_bums_david")}}";
		form.submit();
	}

	$('#filter_name').keyup(function() {
		console.log("se cambio el nombre");
	});

</script>
@endsection