@extends('layouts.plantillaWeb')

@section('content')
<br>
<br>
<style>
.btn-categorias{
	margin: 20px;
	padding: 10px !important;
}
.fondoBlanco{
	color: black !important;
	background: white !important;
}
</style>

<div class="" style="background-color: white;">
	<div class="fondotituloArticulos-xbox">
		<h2  class="titulobumsArticulos">Ayuda</h2>
	</div>
	<div class="container">
	
		<br>
		<style>	
		.list-group .active{
			background: #ff0005;
			border: none !important;
			opacity: 0.8 !important;
		}

		.hr_negro{
			border: 1px black solid;
		}
	</style>
	<div class="row">
		<div class="col">
			<div class="row">
				<div class="col-12 col-lg-4">
					<div class="list-group" id="list-tab" role="tablist">
						<a class="list-group-item list-group-item-action ayuda-item active" id="list-digital-list" data-toggle="list" href="#list-digital" role="tab" aria-controls="digital">¿Que es un juego digital?</a>
						<a class="list-group-item list-group-item-action ayuda-item " id="list-principal-list" data-toggle="list" href="#list-principal" role="tab" aria-controls="principal">¿Que es un Juego Digital Primario, Secundario y Codigo?</a>
						<a class="list-group-item list-group-item-action ayuda-item " id="cambio-list" data-toggle="list" href="#cambio" role="tab" aria-controls="norma">¿Cómo funciona nuestro sistema de cambio?</a>
						<a class="list-group-item list-group-item-action ayuda-item " id="beneficios-list" data-toggle="list" href="#beneficios" role="tab" aria-controls="norma">Beneficios de ser un usuario registrado</a>
						<a class="list-group-item list-group-item-action ayuda-item " id="list-norma-list" data-toggle="list" href="#list-norma" role="tab" aria-controls="norma">Normas del sitio</a>
						<a class="list-group-item list-group-item-action ayuda-item " id="tutorial-list" data-toggle="list" href="#tutorial" role="tab" aria-controls="norma">Tutorial para descargas</a>
						<a class="list-group-item list-group-item-action ayuda-item " id="pol-list" data-toggle="list" href="#pol" role="tab" aria-controls="norma">Politicas de garantia</a>

					</div>
				</div>
				<div class="col-12 col-lg-8">
					<div class="tab-content letraNegra ayudabody" id="nav-tabContent">
						<div class="tab-pane fade show active" id="list-digital" role="tabpanel" aria-labelledby="list-digital-list">
							    <center class="fondo-titulo-ayuda">
							        <h1 class="titulo-ayuda">¿Que es un juego digital?</h1>
								 </center>
								<br>
							    <br>
							   	<p> 
									Es un juego completo al igual que un juego en formato físico, la diferencia es que un juego digital está contenido 
									en una cuenta desde la cual se podrá comenzar la descarga del mismo, el juego quedará en el disco duro de la consola, 
									estos juegos son 100% originales, la consola no debe estar chipeada para poder descargar los juegos digitales. Ofrecemos 
									garantía de cada compra permanente, para ello se debe guardar nuestras normativas obligatoriamente, en caso de faltar 
									a nuestras políticas el comprador irrumpe en la garantía.
								</p>
								<br>
								<br>
							    <center class="mensaje-importante">Los juegos descargados mediante cuentas son solo para uno y solo una Consola</center>
							    <br>
							    <br> 
							</div>
						<div class="tab-pane fade" id="list-principal" role="tabpanel" aria-labelledby="list-digital-list">   
							<center class="fondo-titulo-ayuda">
								<h1 class="titulo-ayuda">¿Que es un Juego Digital Primario, Secundario y Codigo?</h1>
							</center>
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Juego Digital Primario
								</h3>
							</center>
							<br>
							<br>
							<ul>
								<li>Se comienza la descarga del juego mediante una cuenta alterna.</li>
								<li>Podrás jugar desde tu usuario personal u otro de tu preferencia.</li>
								<li>No necesitas internet para jugar una vez descargado.</li>
								<li>Los trofeos son agregados a tu perfil.</li>
								<li>Totalmente igual a un juego en formato físico.</li>
							</ul>
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Juego Digital Secundario
								</h3>
							</center>
							<br>
							<br>
							<ul>
								<li>Se comienza la descarga del juego mediante una cuenta alterna.</li>
								<li>Se juega mediante el usuario desde donde se realizó la descarga.</li>
								<li>En algunos casos en PS4 podrás jugar desde tu usuario y en Xbox One podrás jugar siempre desde cualquier usuario.</li>
								<li>Necesitas internet obligatoriamente para jugar.</li>
								<li>Totalmente igual a un juego en formato físico.</li>
							</ul>
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Juego digital por código
								</h3>
							</center>
							<br>
							<br>
							<p>
								Es un juego completo al igual que un juego en formato físico, los juegos por códigos son canjeados en la 
								cuenta del comprador, por lo cual una vez comprados los juegos quedan vinculados para siempre a dicha cuenta.
							</p>
							<br>
							<br>
							<center class="mensaje-importante">Los juegos descargados mediante cuentas son solo para uno y solo una Consola</center>
							<br>
							<br>

						</div>
						
						
						<div class="tab-pane fade" id="list-principal" role="tabpanel" aria-labelledby="list-principal-list">   
							<center class="fondo-titulo-ayuda">
								<h1 class="titulo-ayuda">¿Que es un Juego Digital Primario, Secundario y Codigo222?</h1>
							</center>
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Juego Digital Primario
								</h3>
							</center>
							<br>
							<br>
							<ul>
								<li>Se comienza la descarga del juego mediante una cuenta alterna.</li>
								<li>Podrás jugar desde tu usuario personal u otro de tu preferencia.</li>
								<li>No necesitas internet para jugar una vez descargado.</li>
								<li>Los trofeos son agregados a tu perfil.</li>
								<li>Totalmente igual a un juego en formato físico.</li>
							</ul>
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Juego Digital Secundario
								</h3>
							</center>
							<br>
							<br>
							<ul>
								<li>Se comienza la descarga del juego mediante una cuenta alterna.</li>
								<li>Se juega mediante el usuario desde donde se realizó la descarga.</li>
								<li>En algunos casos en PS4 podrás jugar desde tu usuario y en Xbox One podrás jugar siempre desde cualquier usuario.</li>
								<li>Necesitas internet obligatoriamente para jugar.</li>
								<li>Totalmente igual a un juego en formato físico.</li>
							</ul>
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Juego digital por código
								</h3>
							</center>
							<br>
							<br>
							<p>
								Es un juego completo al igual que un juego en formato físico, los juegos por códigos son canjeados en la 
								cuenta del comprador, por lo cual una vez comprados los juegos quedan vinculados para siempre a dicha cuenta.
							</p>
							<br>
							<br>
							<center class="mensaje-importante">Los juegos descargados mediante cuentas son solo para uno y solo una Consola</center>
							<br>
							<br>

						</div>
						<div class="tab-pane fade" id="cambio" role="tabpanel" aria-labelledby="cambio-list">   
							<center class="fondo-titulo-ayuda">
								<h1 class="titulo-ayuda">
									¿Cómo funciona nuestro sistema de cambio?
								</h1>
							</center>   
							<br>
							<br>
							<br>
							<ul>
								<li>
									Puedes utilizar tus juegos digitales comprados a nosotros, como parte de pago para adquirir cualquier otro 
									artículo de nuestro stock.
								</li>
								<li>
									Para conocer el porcentaje al cual se le recibirá el juego ofrecido como parte de pago, debe comunicarse con un 
									agente Bumsgames, este porcentaje se calcula dependiendo el año del juego, la demanda y otros factores.
								</li>
								<li>
									Tus juegos físicos también puedes utilizarlos como parte de pago para adquirir cualquier juego de nuestro 
									stock, en caso de no estar en la cuidad no asumimos el precio de envío, correrá de parte de la persona interesada 
									cancelar el envio del juego que desee ofrecer como parte de pago.
								</li>
							</ul>
							<br>
							<br>
						</div>
						<div class="tab-pane fade" id="beneficios" role="tabpanel" aria-labelledby="beneficios-list">   
							<center class="fondo-titulo-ayuda">
								<h1 class="titulo-ayuda">
									Beneficios de ser un usuario registrado
								</h1>
							</center>   
							<br>
							<br>
							<br>
							<p>
								Al realizar tu primera compra en el sitio, un agente de BumsGames te registrará en el sistema.
								<br><br>	
								Al estar registrado en el sistema podras revisar los productos que te pertenecen, así como las compras que has realizado en el pasado.
								<br><br>
								En adición a esto, podrás tener un control de los productos que son tuyos y aquellos que has cambiado.
								<br>
								Podrás ver el correo electrónico de las cuentas digitales que te pertenecen y en el caso de tener compras en cuentas secundarias podrás ver su contraseña en cualquier momento.
							</p>	
							<br>
							<br>
						</div>
						<div class="tab-pane fade" id="pol" role="tabpanel" aria-labelledby="pol-list">   
							<center class="fondo-titulo-ayuda">
								<h1 class="titulo-ayuda">
									Políticas de garantía

								</h1>
							</center>   
							<br>
							<br>
							<br>
							<ul>
								<h3>Artículos digitales</h3>
								<br>
								- BumsGames ofrece garantía de por vida en artículos digitales (tipo cuenta) de Nintendo Switch, PlayStation 4 y Xbox One, siempre y cuando se sigan las politicas suministradas al momento de la entrega.
								<br>
								<br>
								- BumsGames ofrece garantía de descarga en artículos digitales (tipo cuenta) de PlayStation 3, no nos hacemos responsables si el perfil suministrado para descargar es borrado de su Consola PlayStation 3.
								<br>
								<br>
								- Habra sanciones a usuarios que no sigan las política de los juegos digitales.
								<br>
								<br>
								<br>
								<center class="mensaje-importante">Los juegos descargados mediante cuentas son solo para uno y solo una Consola</center>
								<br>
								<br>

								<h3>Artículos físicos</h3>
								<br>
								- BumsGames es totalmente transparente al momento de vender un artículo físico, no vendemos artículos destapados o reparados.
								<br>
								<br>
								- En caso de que algun artículo tengo algun defecto seremos totalmente transparentes y se lo haremos saber al cliente.
								<br>
								<br>
								- Todo producto que no sea sellado antes de ser vendido pasa por un periodo de prueba para evitar inconvenientes.
								<br>
								<br>
								- BumsGames no se hace responsable por daños físicos o inmersion a líquidos ocasionados por el Cliente.
								<br>
								<br>
								- Si el artículo llega a dañarse por alguna falla eléctrica (problemas de eléctricidad, bajones, equivocacion de enchufe, estar enchufado mucho tiempo). BumsGames no se haría responsable.
								<br>
								<br>
								- Todo artículo físico tiene 5 dias de garantía (luego de ser entregado al cliente) por si tiene alguna falla oculta que haya pasado desapercibida (se podrían realizar excepciones).

								<p>

								</p>
							</ul>
							<br>

							<br>
						</div>
						<div class="tab-pane fade" id="tutorial" role="tabpanel" aria-labelledby="tutorial-list">   
							<center class="fondo-titulo-ayuda">
								<h1 class="titulo-ayuda">
									Tutorial para descargas
								</h1>
							</center>   
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Descarga PlayStation 4 primario:
								</h3>
							</center>
							<br>
							<br>
							<p>
								<strong>VIDEOTUTORIAL PARA DESCARGAR:</strong> Al ingresar al siguiente link -> <a href="https://www.youtube.com/watch?v=fzHBj8vPZ3s&t=36s">https://www.youtube.com/watch?v=fzHBj8vPZ3s&t=36s</a> 
								Puedes observar los pasos necesarios para comenzar con la descarga de tu juego versión primaria en menos de 3 
								minutos.
							</p>
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Descargar PlayStation 4 Secundario:
								</h3>
							</center>
							<br>
							<br>
							<p>
								<strong>VIDEOTUTORIAL PARA DESCARGAR:</strong> <a href="https://www.youtube.com/watch?v=5vXs4Gnxxi0&t=12s">https://www.youtube.com/watch?v=5vXs4Gnxxi0&t=12s</a> 
								<br>
								<strong>VIDEOTUTORIAL para jugar:</strong> <a href="https://www.youtube.com/watch?v=lD2_neiQM0c">https://www.youtube.com/watch?v=lD2_neiQM0c</a>
								<br>
								<strong>VIDEOTUTORIAL fallo en bloqueo de usuario secundario (muy poco frecuente):</strong> <a href="https://www.youtube.com/watch?v=2RcHgtIshzQ">https://www.youtube.com/watch?v=2RcHgtIshzQ</a>
								<br>
								<strong>VIDEOTUTORIAL para jugar desde tu usuario:</strong> <a href="https://www.youtube.com/watch?v=X0Ha1McuIto">https://www.youtube.com/watch?v=X0Ha1McuIto</a>	
							</p>
							<br>
							<br>
							<center>
								<h3 class="titulo-ayuda-MINI">
									Descargar PlayStation 3:
								</h3>
							</center>
							<br>
							<br>
							<p>
								<strong>VIDEOTUTORIAL PARA DESCARGAR:</strong> <a href="https://www.youtube.com/watch?v=YZzDS5CJJ4s"> https://www.youtube.com/watch?v=YZzDS5CJJ4s</a>
							</p>
							<br>
							<br>
						</div>
						<div class="tab-pane fade" id="list-norma" role="tabpanel" aria-labelledby="list-norma-list">   
							<center class="fondo-titulo-ayuda">
								<h1 class="titulo-ayuda">
									Normas del sitio
								</h1>
							</center>   
							<br>
							<br>
							<br>
							<ul>
								<li><h5>Los juegos descargados mediante cuentas son válidos solo para una Consola</h5></li>
								<li><h5>El cliente por ninguna razón debe modificar datos de la cuenta, si tiene algún problema con la cuenta comprada debe contactar directamente a su vendedor.</h5></li>
								<li><h5>Debe mantenerse activado en el tipo de cuenta que adquirió (Primario o Secundario).</h5></li>
								<li><h5>Las cuentas son intransferible, en caso de prestar su cuenta y le sea quitado el cupo por un tercero, pierde totalmente la garantía de su compra.</h5></li>
								<li><h5>Al incumplir las normativas hay sanciones como resultados</h5></li>
							</ul>
							<br>
							<br>
							<center class="mensaje-importante">Los juegos descargados mediante cuentas son solo para uno y solo una Consola</center>
							<br>
							<br>
						</div>
						
						
						
					</div>
				
			</div>
		</div>
		<div class="col-12 col-lg-2">
			
			
		</div>
		
	</div>
	<br>
	<br>
	<br>
	<br>
</div>

</div>
<br>
<br>
</div>
<br>
<br>



@endsection

