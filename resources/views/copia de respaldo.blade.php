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