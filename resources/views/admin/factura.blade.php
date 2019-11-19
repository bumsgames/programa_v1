@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<style type="text/css">
	.shadow_ligero{
		-webkit-box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
		-moz-box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
		box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
	}
</style>
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Factura </h1>
			<p>Aqui es donde comienza todo.</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">FACTURA</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col">	

	@php $total = 0; @endphp
	<br>
	<div class="card shadow_ligero" style="width: 500px;" style="">
		<div class="card-header">
			<center>
				BUMSGAMES
				<br>
				<br>
				<p>Centro Comercial: Ciudad Alta Vista II
					<br>
					2do Piso / Local #22
				</p>
				Ingresa en: www.bumsgames.com.ve
				<br>
			</center>
			<br>
		</div>
		<div class="card-body" style="margin: 10px;">
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
			Nickname: <b>{{ $venta->ventaCliente->nickname }} (Ingrese a nuestra Pagina) </b>
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
<div class="col">	
	<br>
<div class="card shadow_ligero" style="width: 500px;" style="">
		<div class="card-header">
			<h3>Entrega</h3>
<b>Vendedor:</b> {{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}
<br>	
<b>Fecha del mensaje:</b> {{ $venta->created_at->format('d - m - Y ') }}
<br>
<br>
<p>Hola amigo, <b>{{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }}</b>, gracias por tu compra.</p>
<br>
		</div>
		<div class="card-body" style="margin: 10px;">

			<?php $i = 1; ?>
<?php $categoria = ''; ?>
<div class="row">
	<div class="col">
		@foreach($venta->articulos as $articulo)
		@if($articulo->articulo->categorias[0]->category != $categoria)
		@if($i != 1)
	</div>
	@endif
	<?php $categoria = $articulo->articulo->categorias[0]->category; ?>
	<?php $id_categoria = $articulo->articulo->categorias[0]->id; ?>
	<?php $i = 1; ?>




	<div id="div_{{$articulo->id_categoria}}">
		<h4><strong>{{ $categoria }}</strong></h4>
		<br>
		@if($id_categoria == 1)

		{{-- Instrucciones PlayStation 4 Primario  --}}
		<b>LOS JUEGOS ESTARAN EN LA PARTE DE ABAJO</b>
		<br>
		<br>	
		ATENCION, OJO: Bajo ninguna circunstancia cambiar el APODO, NICKNAME de la cuenta proporcionada, puede significar la expulsion inmediata sin reembolso del JUEGO.
		<br>
		*REGLAS (OBLIGATORIO):* No utilizar el usuario una vez puesto a descargar, no cambiar o modificar datos de la CUENTA. (Hay sanciones en caso de que no se cumplan las mismas)
		<br>	
		<br>	
		*VIDEOTUTORIAL PARA DESCARGAR:* https://www.youtube.com/watch?v=fzHBj8vPZ3s&t=36s 
		<br>

		<br>
		RECORDATORIO: Usted cuenta con garantia de por vida, siempre y cuando cumpla las normativas y tambien puede utilizar este producto como PARTE DE PAGO por otros articulos de nosotros. 
		<br>
		<br>	
		Cualquier duda, hacersela saber a su vendedor, para nosotros es un Placer trabajar para usted :).
		<br>
		<br>	
		Echale un vistazo a nuestro Instagram: https://www.instagram.com/bumsgames/
		<br>
		*Buscas mas Juegos?, visita ya nuestra Pagina Web: *www.bumsgames.com.ve*
		<br>

		@endif

		@endif

		<div style="border: solid 3px rgba(0,10,0,0.3); border-radius: 20px; padding: 10px;">	
			<strong><?php echo $i++; ?></strong>. 
			@if(((strpos($articulo->articulo->categorias[0]->category,'Cuenta') !== false) 
			|| (strpos($articulo->articulo->categorias[0]->category,'Cupo') !== false)))

			Juego: {{  $articulo->articulo->name }}
			<br>
			Correo: {{  $articulo->articulo->email }}
			<br>
			Password: {{  $articulo->articulo->password }}

			@else
			@if((strpos($articulo->articulo->categorias[0]->category,'Codigo') !== false ))

			<b>Articulo:</b> {{ $articulo->articulo->name }}
			<br>
			<b>Codigo:</b> El Agente BumsGames de esta entrega, le entregara su codigo

			<br>

			@else
			<b>Articulo:</b> {{ $articulo->articulo->name }}
			<br>
			<b>Envio: </b>


			@endif


			@endif

			<br><br>	
		</div>

<br>	
		@endforeach
	</div>

</div>
			
			
		</div>

		
	</div>
</div>
<br>











<br>
		</div>
		
	</div>

</main>



<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/bums.js"></script>

@endsection