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

		{{ $request }}
		



		<div class="row">
			<div class="col-md-12">
				<div class="tile">

					<div class="row">
						<div class="col-3">
							<h3>Ventas:</h3>
							Fecha de Inicio: {{ $request['fecha_inicio'] }}<br>
							Fecha Final: {{ $request['fecha_final'] }}<br>
							<br>

							Vendedor: {{ $request['select_vendedor'] }} <br>
							Involucrado: {{ $request['select_involucrado'] }} <br>
							Envio: {{ $request['select_envio'] }}<br>
							<br>	
							<h3>Cliente:</h3>
							Nombre de Cliente: {{ $request['nombre_cliente'] }}
							<br>
							Apellido de Cliente: {{ $request['apellido_cliente'] }}
							<br>
							<br>
							<h6>Ventas: {{ $ventas->count() }}</h6>
						</div>
						<div class="col-3">
							<h3>Pago</h3>
							Banco: {{ $request['select_banco'] }}<br>
							
							<br>
							Tipo de Moneda: {{ $request['select_moneda'] }} <br>

							Referencia: {{ $request['input_referencia'] }} <br>
							Nota de Pago: {{ $request['input_notaPago'] }} <br>
							
							<br>
							<h6>Cantidad de Pagos con estas caracteristicas: {{ $cantidad_pago }}</h6>	
							<br>
							<br>
							<br>
							<h3>Pago de Involucrados</h3>
							Involucrado: {{ $request['select_involucrado'] }} <br>
							¿Pagos Cobrados?: {{ $request['select_cobrado'] }}<br>
							<hr>
							Cantidad Cobrados:  {{ $cantidad_cobrado }}<br>
							Cantidad No Cobrados:  {{ $cantidad_no_cobrado }}<br>
						</div>
						<div class="col-3">
							<h3>Articulo</h3>
							{{-- @if (isset($request['nombre_articulo']))
							Nombre del Articulo: {{ $request['nombre_articulo'] }}
							<br>
							@if (isset($cantidad_articulo->cantidad))
							Cantidad: {{ $cantidad_articulo->cantidad }}
							@endif

							@endif --}}
							<br>	
							Nombre del Articulo: {{ $request['nombre_articulo'] }}<br>
							Correo del Articulo: {{ $request['input_correo'] }} <br>
							Categoria: {{ $request['select_categoria'] }} <br>
							Ubicacion: {{ $request['select_ubicacion'] }} <br>
							<br>
							<br>
							<h6>Cantidad de Articulos con estas caracteristicas: {{ $cantidad_articulo->cantidad }}</h6>
							<br>
							<br>
							{{-- {{ $ventas->articulos() }} --}}
						</div>
						

					</div>
					
					<br>
					<hr>
					

					
					
					<br>
					

					

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
									<b>Venta: </b>#{{ $venta->id }}
									<br>
									<b>Venta realizada por: </b>{{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}
									<br>	
									<b>Cliente: </b>{{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }}
									<hr>	
									@php $total_pagado = 0; @endphp
									@foreach ($venta->pagos as $pago)
									<br>
									<b>Bando Emisor: </b>{{ $pago->banco->banco }}
									<br>

									<b>Monto:</b> {{ number_format($pago->monto, 2, ',', '.') }} {{ $pago->moneda->sign }}
									<br>
									@if ($pago->moneda->id != 2)
									<b>Tasa:</b> {{number_format($pago->dolardia, 2, ',', '.')   }} {{ $pago->moneda->sign }} = 1 $
									@endif

									
									@php $total_pagado += $pago->monto / $pago->dolardia; @endphp
									@endforeach
									<hr>	
									<b>Equivalente:</b> {{number_format($pago->monto / $pago->dolardia, 2, ',', '.') }} $
									<br>	
									<b>Se debia pagar:</b> {{ number_format($precio_carrito, 2, ',', '.') }} $
									<hr>	
									<br>
									<br>
									<b>	Inversion Total:</b> {{number_format($suma_inversion, 2, ',', '.')  }} $
									<br>
									<b>Pago Total:</b> {{number_format($total_pagado, 2, ',', '.')  }} $
									<br>
									<b>	Ganancia Total:</b> {{number_format($total_pagado - $suma_inversion, 2, ',', '.') }} $
									<br>
									<hr style="border: 2px solid rgba(0, 0, 0, 0.5);">
									@foreach($venta->articulos as $articulo)
									{{-- donde va el 1 va precio carrito --}}

									@php $pago_articulo =  ($articulo->precio_venta / $precio_carrito)  * $total_pagado @endphp

									<div style="border: solid 2px rgba(0, 230, 64, 1); padding: 10px;">
										<b>	Articulo:</b> {{ $articulo->articulo->name }}
										<br>
										<b>Ubicacion: </b>{{  $articulo->articulo->ubicacion2->nombre_ubicacion }}
										<br>
										<br>
										<b>Categoria: </b>{{ $articulo->articulo->categorias[0]->category }}
										<br>	

										<br>
										<b>Cada unidad de este articulo se lleva:</b> {{ number_format($pago_articulo, 2, ',', '.') }} $
										<br>	
										<b>Cantidad:</b> {{ $articulo->cantidad }}
									</div>
									<br>
									@endforeach

								</td>
								{{-- precio total de lo que se pago por todo --}}
								<td>
									{{-- {{ $venta->ventaArticulo }} --}}
									@foreach($venta->articulos as $articulo)
									{{-- donde va el 1 va precio carrito --}}

									@php $pago_articulo =  ($articulo->precio_venta / $precio_carrito)  * $total_pagado @endphp

									<div style="border: solid 2px rgba(0, 230, 64, 1); padding: 10px;">
										<b>	Articulo:</b> {{ $articulo->articulo->name }}
										<br>
										@if (isset($articulo->articulo->email))
										<b>Correo: </b> {{ $articulo->articulo->email }}
										@endif
										@foreach (	$articulo->articulo->categorias as $categoria)
										<b>Categoria: </b>{{ $categoria->category }}
										<br>	
										@endforeach
										<br>
										<b>Cada unidad de este articulo se lleva:</b> {{number_format($pago_articulo, 2, ',', '.')  }} $
										<br>	
										<b>Cantidad:</b> {{ $articulo->cantidad }}
									</div>
									<br>
									
									@php $contador = 1; @endphp
									@foreach ($venta->pagos as $pago)
									<div style="background-color: rgba(0,10,0,0.2); padding: 20px; border-radius: 20px;">
										<b>PAGO #{{ $contador }}</b>
										{{-- Descripcion del pago --}}
										{{ $pago->bancoEmisor }}
										<br>
										Monto de este Pago: {{number_format($pago->monto, 2, ',', '.') }} {{ $pago->moneda->sign }}
										<br>
										@php $equivale_monto = $pago->monto / $pago->dolardia @endphp
										Equivale: {{number_format( $equivale_monto, 2, ',', '.')  }} $
										<br>
										<br>
										<b>Pago Articulo (unidad):</b> {{ number_format( $pago_articulo, 2, ',', '.')    }} $
										<br>
										@php $porcentaje_se_lleva_unidad = $pago_articulo / $total_pagado @endphp
										<b>Representa:</b> {{number_format( $porcentaje_se_lleva_unidad * 100, 2, ',', '.')  }} % 
										<br>
										<b>Representa unidades ({{ $articulo->cantidad }}): </b>
										{{ number_format($articulo->cantidad *  $porcentaje_se_lleva_unidad * 100, 2, ',', '.')  }} % 
										<br>
										@if ($pago->dolardia != 1)
										<b>Tasa:</b> {{number_format( $pago->dolardia, 2, ',', '.') }} {{ $pago->moneda->sign }}
										@endif
										
										<br>
										<br>

										@php $total_del_articulo = $pago->monto * ( $pago_articulo / $total_pagado ) @endphp
										<b>Total por Unidad:</b> ({{ $articulo->cantidad }}): 
										{{ number_format( $total_del_articulo * $articulo->cantidad, 2, ',', '.') }} {{ $pago->moneda->sign }}
										<br>
										<b>Total:</b> {{ number_format($total_del_articulo, 2, ',', '.')   }} {{ $pago->moneda->sign }}
										
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




									Lo que se lleva este usuario del monto: {{ number_format($monto_por_usuario, 2, ',', '.') }} {{ $pago->moneda->sign }}
									<br>
									Conversion a Dolar:  {{ number_format($monto_por_usuario_dolar = $monto_por_usuario  / $pago->dolardia, 2, ',', '.')   }} $
									<br>
									@php  $invertido_usuario = ($articulo->costo_individual * $involucrado->porcentajeInversion * ($pago_articulo / $total_pagado) * (($pago->monto / $pago->dolardia) / $pago_articulo) * $articulo->cantidad ) @endphp
									
									Invertido en este monto: {{ number_format($invertido_usuario, 2, ',', '.') }} $

									<br>
									Ganancia = {{  number_format($monto_por_usuario_dolar - $invertido_usuario, 2, ',', '.')  }} $
									<hr style="border: 2px solid rgba(0, 0, 0, 0.5);">

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
								<td>
									{{$venta->created_at->format('d-m-Y')}}
									<br>	
									{{$venta->created_at->format('H:i')}}
									<br><br>
									{{$venta->created_at->diffForHumans()}}
								</td>
								<td>
									<button type="button" class="btn btn-danger text-center" data-toggle="modal" data-target=".bd-example-modal-lg3" Onclick="mandaridM('');"><i class="fa fa-trash" aria-hidden="true"></i></button>
								</td>	
							</tr>
							@endforeach
							
						</tbody>
					</table>
					<hr>
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
				</div>


			</div>
		}
	</div>

</div>

</main>



<style type="text/css">
td:nth-child(2){
	width: 220px;
}
</style>

@endsection

@section("scripts")


@endsection