@extends('webuser.user.adminpaneluser')

@section('contenido_cliente')

<h1 class="panel-title">VER RECIBO</h1>
<div >
	<div >	

	@php $total = 0; @endphp
	<br>
	<div class=" shadow_medio" style="width: 800px;">
		<div class="card-header">
			<center>
				BUMSGAMES
				<br>
				<br>
				<p>Centro Comercial: Ciudad Alta Vista II
					<br>
					2do Piso / Local #22
				</p>
			</center>
			<br>
		</div>
		<div class="" style="margin: 10px;">
			Venta N#: {{ $venta->id }}
			<br>
			Fecha: {{ $venta->created_at->format('d - m - Y ') }}
			<br>
			Hora: {{ $venta->created_at->format('H:i:s') }}
			<br>
			<br>
			<br>
			Vendedor: <b>{{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}</b>
			<br>
			Nombre de cliente: <b>{{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }} </b>
			<br>
			Documento de Identidad: <b>{{ $venta->ventaCliente->documento_identidad }}</b>
			<br>
			Nickname: <b>{{ $venta->ventaCliente->nickname }}</b>
			<br>
			<br>  
<hr>	

			<center>	
<b>DATOS</b>
			</center>
@php $i = 0; @endphp
			<table class="table">	
			@foreach ($venta->articulos as $articulo)
			@php $pago_articulo =  ($articulo->precio_venta / $precio_carrito[0]->precio_carrito) * $pago_total[0]->pago_total; @endphp
			<tr>	
<td>	
	@php $i++; @endphp
	{{ $i }}. <b>Articulo:</b> {{ $articulo->articulo->name }}	
	<br>	
	{{ $articulo->articulo->categorias[0]->category }}	
	

</td>
<td>	
	
	<b>Cantidad:</b> {{ $articulo->cantidad }}	({{  number_format($pago_articulo, 2, ',', '.')  }} $)
	<br>	
	<b>Pago:</b> {{ number_format($pago_articulo * $articulo->cantidad, 2, ',', '.') }} $

	@php $total +=  $pago_articulo * $articulo->cantidad @endphp
</td>
			</tr>
			
			{{-- {{ $pago_articulo }} --}}
			@endforeach
			</table>
			<br>
			<br>
			<h3>Total: {{ number_format($total, 2, ',', '.') }} $</h3>
			<br>
<hr>	
			<br>
			<b>	PAGOS:</b>
			<br>
			@foreach ($venta->pagos as $pago)
			@php $dolardia = $pago->dolardia; @endphp

			<br>
			{{ $pago->banco->banco }} = @if ($dolardia == 0)
			No se incluye monto, por error en programa (division entre 0).
			@else
			{{ number_format($pago->monto / $dolardia, 2, ',', '.') }} $
			@endif
			@endforeach
			<br>
			<br>
			<center>
				** Politicas BumsGames en nuestra Pagina Web **
			</center>
			<br>
		</div>

		
	</div>
</div>
</div> 
<br>

@endsection
