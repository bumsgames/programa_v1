
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

	<link rel="icon" href="{{ url('img/LOGO.ico') }}" />   <meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">

	</script>


</head>

<style type="text/css">
	.shadow_ligero{
		-webkit-box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
		-moz-box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
		box-shadow: 0px 0px 20px 3px rgba(0,0,0,0.12);
	}
</style>

<body>
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
			--------------------------------------------------------------------------
			<br>
			<b>DATOS</b>
			<br>
			--------------------------------------------------------------------------
			<br>
			@foreach ($venta->articulos as $articulo)
			@php $pago_articulo =  ($articulo->precio_venta / $precio_carrito[0]->precio_carrito) * $pago_total[0]->pago_total @endphp
			<b>Cantidad:</b> {{ $articulo->cantidad }}	({{ $pago_articulo  }} $)
			{{-- {{ $pago_articulo }} --}}
			<br>
			<b>Articulo:</b> {{ $articulo->articulo->name }}	
			<br>
			{{ $articulo->articulo->categorias[0]->category }}	
			<br>

			<b>Pago:</b> {{ $total +=  $pago_articulo * $articulo->cantidad }} $
			<br>
			<br>
			@endforeach
			<br>
			<br>
			<h3>Total: {{ $total }} $</h3>
			<br>
			------------------------------------------------------------------------
			<br>
			------------------------------------------------------------------------
			<br>
			PAGOS:
			<br>
			@foreach ($venta->pagos as $pago)
			@php $dolardia = $pago->dolardia; @endphp

			<br>
			{{ $pago->banco->banco }} = @if ($dolardia == 0)
			No se incluye monto, por error en programa (division entre 0).
			@else
			{{ $pago->monto / $dolardia }} $
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
<br>


<h3>Entrega</h3>
<b>Vendedor:</b> {{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}
<br>	
<b>Fecha del mensaje:</b> {{ $venta->created_at->format('d - m - Y ') }}
<br>
<br>
<p>Hola amigo, <b>{{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }}</b>, gracias por tu compra.</p>
<br>

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
	<br>
	<br>




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
		<br>
		<br>
		@endif

		<div style="border: solid 2px rgba(0,10,0,0.3); border-radius: 20px; width: 500px; padding: 10px;">	
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


		@endforeach
	</div>

</div>






<br>
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