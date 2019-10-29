
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
		<br>  
		--------------------------------------------------------------------------
		<br>
		<b>DATOS</b>
		<br>
		--------------------------------------------------------------------------
		<br>
		@foreach ($venta->articulos as $articulo)
		@php $pago_articulo =  ($articulo->precio_venta / $precio_carrito[0]->precio_carrito) * $pago_total[0]->pago_total @endphp
		Cantidad: {{ $articulo->cantidad }}	({{ $pago_articulo  }} $)
		<br>
		{{-- {{ $pago_articulo }} --}}
		<br>
		Articulo: {{ $articulo->articulo->name }}	
		<br>
		{{ $articulo->articulo->categorias[0]->category }}	
		<br>
		<br>

		Pago: {{ $total +=  $pago_articulo * $articulo->cantidad }} $
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

<div style="width: 500px;">


	<hr>
	@foreach ($articulo->articulo->categorias->groupby('id') as $element)
	Agrupaje <br>
	{{ $element }}
	@endforeach
	<hr>
	<h3>Entrega</h3>
	Vendedor: {{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}
	<br>	
	Fecha del mensaje: {{ $venta->created_at->format('d - m - Y ') }}
	<br>
	<br>
	<p>Hola amigo, {{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }}, gracias por tu compra.</p>
	<br>
	<br>
	@foreach ($venta->articulos as $articulo)
	Cantidad: {{ $articulo->cantidad }}	({{ ($articulo->precio_venta / $precio_carrito[0]->precio_carrito) * $pago_total[0]->pago_total / $articulo->cantidad }} $)
	<br>
	Articulo: {{ $articulo->articulo->name }}	
	<br>
	<br>
	<br>
	{{ $articulo->articulo->categorias[0]->category }}
	<br>
	<br>
	{{ $articulo }}
	@foreach ( $articulo->articulo->categorias as $categoria)
	<hr>
	prueba
	<br>
	{{ $categoria->category }}
	<hr>
	@endforeach	
	<br>
	<br>

	{{ $total += ($articulo->precio_venta / $precio_carrito[0]->precio_carrito) * $pago_total[0]->pago_total }} $
	@endforeach
	
	<br>
	<br>
	<br>
	
	<hr>
	<h3>Entrega</h3>
	Vendedor: {{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}
	<br>	
	Fecha del mensaje: {{ $venta->created_at->format('d - m - Y ') }}
	<br>
	<br>
	<p>Hola amigo, {{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }}, gracias por tu compra.</p>
	<br>
	@php $aux1 = 0; @endphp
	@foreach ($articulos_factura as $articulo_factura)
	@if ($aux1 != $articulo_factura->id_categoria)
	<h4>Articulos de Categoria: {{ $articulo_factura->id_categoria }}</h4>
	@if ($articulo_factura->id_categoria == 1)
	<h5>Instrucciones PlayStation 4 Primario</h5>
	{{-- Instrucciones PlayStation 4 Secundario  --}}
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



	@if ($articulo_factura->id_categoria == 1)
	<br>
	<br>
	<br>
	<br>
	<br>

	<b>*DATOS DE DESCARGA:*</b>
	<br>
	Categoria: Articulo PlayStation 4 Primario
	<br>
	<br>	
	Juego: {{ $articulo_factura->name }}
	<br>
	Correo: {{ $articulo_factura->email }}
	<br>
	Password: {{ $articulo_factura->password }}
	<br>
	<br>
	Las instrucciones y reglas (obligatorio leerlas) estaran en la Parte abajo
	<br>
	<br>
	@endif	

	@if ($articulo_factura->id_categoria == 2)
	<br>
	<br>
	<br>
	*DATOS DE DESCARGA:*
	<br>
	Categoria: Articulo PlayStation 4 Secundario
	<br>
	<br>	
	Juego: {{ $articulo_factura->name }}
	<br>
	Correo: {{ $articulo_factura->email }}
	<br>
	Password: {{ $articulo_factura->password }}
	<br>
	<br>
	Las instrucciones y reglas (obligatorio leerlas) estaran en la Parte de abajo.
	<br>
	<br>
	@endif

	@if ($aux1 != $articulo_factura->id_categoria)
	@php $aux1 = $articulo_factura->id_categoria; @endphp
	@endif



	@if ($aux1 == 2)
	{{-- Instrucciones PlayStation 4 Secundario  --}}
	ATENCION, OJO: Bajo ninguna circunstancia cambiar el APODO, NICKNAME de la cuenta proporcionada, puede significar la expulsion inmediata sin reembolso del JUEGO.
	<br>
	*REGLAS (OBLIGATORIO):* No activarse como PRIMARIO por ninguna razon, no cambiar o modificar datos de la CUENTA. (Hay sanciones en caso de que no se cumplan las mismas)	
	<br>	
	<br>	
	*VIDEOTUTORIAL PARA DESCARGAR:* https://www.youtube.com/watch?v=5vXs4Gnxxi0&t=12s
	<br>
	<br>	
	*VIDEOTUTORIAL para jugar:* https://www.youtube.com/watch?v=lD2_neiQM0c
	<br>
	<br>	
	*VIDEOTUTORIAL fallo (muy poco frecuente):* https://www.youtube.com/watch?v=2RcHgtIshzQ 
	<br>
	<br>
	Sabias que algunos juegos secundarios de PlayStation 4 se pueden jugar desde tu usuario?, mira este tutorial e intentalo a ver si es el caso para este Juego: *VIDEOTUTORIAL para jugar desde nuestro usuario:* https://www.youtube.com/watch?v=X0Ha1McuIto 
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

	@endforeach

	

	

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