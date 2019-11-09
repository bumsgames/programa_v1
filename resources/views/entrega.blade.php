<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Entrega</title>
</head>
<body>
	<h3>Hola amigo, {{ $nombre }} {{ $apellido }}, gracias por su compra.</h3>
	Vendedor: {{ Auth::user()->name }} {{ Auth::user()->lastname }}
	<br>	
	Fecha del mensaje: {{ $now->format('d M Y ') }}

	{{-- PlayStation 4 Primario --}}
	@if($articulo->category == 1)
	<br>	
	<br>	
	*DATOS DE DESCARGA:*
	<br>
	<br>	
	Juego: {{ $articulo->name }}
	<br>
	Correo: {{ $articulo->email }}
	<br>
	Password: {{ $articulo->password }}
	<br>
	Categoria: 	{{ $articulo->pertenece_category->category }}
	<br>	
	<br>
	ATENCION, OJO: Bajo ninguna circunstancia cambiar el APODO, NICKNAME de la cuenta proporcionada, puede significar la expulsion inmediata sin reembolso del JUEGO.
	<br>
	<br>	
	*VIDEOTUTORIAL PARA DESCARGAR:* https://www.youtube.com/watch?v=fzHBj8vPZ3s&t=36s 
	<br>
	<br>
	RECORDATORIO: Usted cuenta con garantia de por vida, siempre y cuando cumpla las normativas y tambien puede utilizar este producto como PARTE DE PAGO por otros articulos de nosotros. 
	<br>
	<br>
	REGLAS (OBLIGATORIO): No utilizar el usuario una vez puesto a descargar, no cambiar o modificar datos de la CUENTA. (Hay sanciones en caso de que no se cumplan las mismas)
	<br>
	<br>	
	Cualquier duda realizarla a su vendedor, gracias por su compra.
	<br>
	<br>	
	Echale un vistazo a nuestro Instagram: https://www.instagram.com/bumsgames/
	<br>
	*Aqui nuestra pagina web, visitala ya:* www.bumsgames.com.ve
	@endif

	{{-- PlayStation 4 Secundario --}}
	@if($articulo->category == 2)
	<br>	
	<br>	
	*DATOS DE DESCARGA:*
	<br>
	<br>	
	Juego: {{ $articulo->name }}
	<br>
	Correo: {{ $articulo->email }}
	<br>
	Password: {{ $articulo->password }}
	<br>
	Categoria: 	{{ $articulo->pertenece_category->category }}
	<br>
	<br>
	
	@endif

	{{-- PlayStation 3 Cupo Digital --}}
	@if($articulo->category == 5)
	<br>	
	<br>	
	*DATOS DE DESCARGA:*
	<br>
	<br>	
	Juego: {{ $articulo->name }}
	<br>
	Correo: {{ $articulo->email }}
	<br>
	Password: {{ $articulo->password }}
	<br>
	Categoria: 	{{ $articulo->pertenece_category->category }}
	<br>	
	<br>
	ATENCION, OJO: Bajo ninguna circunstancia cambiar el APODO, NICKNAME de la cuenta proporcionada, puede significar la expulsion inmediata sin reembolso del JUEGO.
	<br>	
	<br>
	*VIDEOTUTORIAL PARA DESCARGAR:* https://www.youtube.com/watch?v=YZzDS5CJJ4s
	<br>
	<br>
	*MUY IMPORTANTE: *Al momento de la descarga recuerdo colocar varias descargas en segundo plano o descargas de respaldo, ya que si por algun motivo su descarga se llegara dannar podria correr el riesgo de quedarse sin el juego.
	<br>	
	<br>
	*REGLAS (OBLIGATORIO):* Esta descarga solo es valida para una consola, no cambiar datos de la CUENTA, recuerde que usted tiene cierto limite de tiempo para realizar la descarga. (Hay sanciones en caso de que no se cumplan las mismas). No borrar el perfil creado para realizar la descarga, recuerde que si lo borra, desactivara su juego y no se le podra enviar de nuevo.
	<br>	
	<br>		
	@endif

	{{-- XB1 primario o secundario --}}
	@if($articulo->category == 8 || $articulo->category == 9)
	*IMPORTANTE: *En estos momentos no contamos con Videotutorial o un tutorial escrito, usted sera guiado por un Vendedor de BumsGames
	<br>
	<br>	
	Cualquier duda realizarla a su vendedor, gracias por su compra.
	<br>
	<br>	
	Echale un vistazo a nuestro Instagram: https://www.instagram.com/bumsgames/
	<br>
	*Aqui nuestra pagina web, visitala ya:* www.bumsgames.com.ve
	@endif

	{{-- CODIGO --}}
	@if($articulo->category == 3 || $articulo->category == 7 || $articulo->category == 10 || $articulo->category == 13)
	*IMPORTANTE: *En estos momentos no contamos con Videotutorial o un tutorial escrito, usted sera guiado por un Vendedor de BumsGames
	<br>
	<br>	
	Cualquier duda realizarla a su vendedor, gracias por su compra.
	<br>
	<br>	
	Echale un vistazo a nuestro Instagram: https://www.instagram.com/bumsgames/
	<br>
	*Aqui nuestra pagina web, visitala ya:* www.bumsgames.com.ve
	@endif

	@if($articulo->category == 4 || $articulo->category == 6 || $articulo->category == 11 || $articulo->category >= 14)
		<br>
	<br>	
	Articulo: {{ $articulo->name }}
	<br>
	Categoria: 	{{ $articulo->pertenece_category->category }}
	<br>	
	<br>
	*Si es por trato personal, este tipo de trato o entrega debe cuadrarlo con su respectivo vendedor.*
	<br>	
	*Si hay que realizarle algun tipo de envio, *amig@ {{ $nombre }} {{ $apellido }}.
	<br>	
	<br>
	Si no nos ha suministrado los datos de envio, necesitamos estos datos, enviados en un solo texto, un mismo texto, no enviar los datos salteados, ni tampoco separados. Recuerde enviar todo ordenado y que se entienda por favor, para poder realizarle el envio lo mas pronto posible
	<br>
	<br>	
	*Nombre de la persona que retira: *
	<br>	
	*Documento de identidad de la persona que retira: *
	<br>	
	*Numero de telefono de la persona que retira: *
	<br>
	<br>		
	*Empresa de envio: *
	<br>	
	*Direccion de oficina o su direccion: *
	<br>	
	*Algun otro dato adicional:*
	<br>	
	<br>	
	Apenas se le haga el envio se le enviara una imagen del Voucher con su respectivo numero de Tracking.
	<br>
	<br>	
	Cualquier duda realizarla a su vendedor, gracias por su compra.
	<br>
	<br>	
	Echale un vistazo a nuestro Instagram: https://www.instagram.com/bumsgames/
	<br>
	*Aqui nuestra pagina web, visitala ya:* www.bumsgames.com.ve	

	@endif
</body>
</html>