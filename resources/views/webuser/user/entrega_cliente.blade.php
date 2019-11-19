@extends('webuser.user.adminpaneluser')

@section('contenido_cliente')

<h1 class="panel-title">VER RECIBO</h1>
<div >
	<div >	

	@php $total = 0; @endphp
	<br>
	<div class=" shadow_medio" style="width: 800px;">
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
		<div class="" style="margin: 10px;">

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
<br>
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
</div> 
<br>

@endsection
