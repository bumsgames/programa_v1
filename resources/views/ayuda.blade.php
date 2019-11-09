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
<div class="container">
	<div class="fondotituloEscrito">
		<h2 class="titulobumsEscrito">Ayuda</h2>
	</div>
	<div class="tile fondoBlanco" style="padding-left:0">

		
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
							<a class="list-group-item list-group-item-action ayuda-item " id="list-norma-list" data-toggle="list" href="#list-norma" role="tab" aria-controls="norma">Normas</a>
						</div>
					</div>
					<div class="col-12 col-lg-8">
						<div class="tab-content letraNegra ayudabody" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-digital" role="tabpanel" aria-labelledby="list-digital-list">
							    <center class="fondo-titulo-ayuda">
							        <h1 class="titulo-ayuda">¿Que es un juego digita2l?</h1>
								 </center>
								<br>
							    <br>
							   	<p> Un juego digital, es un juego en formato digital, lo cual significa que es el mismo que un juego en formato fisico, pero esto es en formato digital, lo cual queda en tu disco duro.</p>
								<br>
								<br>
							    <center class="mensaje-importante">Los juegos descargados mediante cuentas son solo para uno y solo una Consola</center>
							    <br>
							    <br> 
							</div>
							<div class="tab-pane fade" id="list-principal" role="tabpanel" aria-labelledby="list-principal-list">   
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
							        	<li>Se instala mediante una cuenta alterna.</li>
							        	<li>Podras jugar desde cualquier usuario una vez descargado.</li>
							        	<li>No necesitas internet para jugar una vez descargado.</li>
										<li>Totalmente igual a un juego en formato fisico.</li>
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
							        	<li>Se instala mediante una cuenta alterna.</li>
							        	<li>Podras jugar desde el usuario desde donde se realizo la descarga.</li>
							        	<li>En algunos caso en PS4 podras jugar desde tu usuario y en Xbox One podras jugar siempre desde cualquier usuario.</li>
							        	<li>Necesitas internet obligatoriamente para jugar.</li>
										<li>Totalmente igual a un juego en formato fisico.</li>
									</ul>
							        <br>
									<br>
							        <center>
									<h3 class="titulo-ayuda-MINI">
										Juego Digital PS3 por cuenta:
									</h3>
							        </center>
									<br>
									<br>
									<ul>
										<li>Se instala mediante una cuenta alterna</li>
										<li>Podras jugar desde cualquier usuario una vez descargado</li>
							        	<li>No necesitas internet para jugar una vez descargado</li>
										<li>Totalmente igual a un juego en formato fisico.</li>	
									</ul>
							        <br>
							        <br>
							        <center class="mensaje-importante">Los juegos descargados mediante cuentas son solo para uno y solo una Consola</center>
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
							        <li><h5>Los juegos descargados mediante cuentas son solo para uno y solo una Consola</h5></li>
									<li><h5>Este tipo de juego adquiridos a nosotros se pueden utilizar como Parte de Pago por otros de nuestros articulos</h5></li>
									<li><h5>Damos garantias de por vida, siempre y cuando se cumpla la normativa</h5></li>
									<li><h5>Al incumplir las normativas hay sanciones como resultados</h5></li>
								</ul>
								<br>
							        <br>
							        <center class="mensaje-importante">Los juegos descargados mediante cuentas son solo para uno y solo una Consola</center>
							        <br>
							        <br>
							</div>
							
								<div class="tab-pane fade" id="list-norma" role="tabpanel" aria-labelledby="list-norma-list">   
								<center class="fondo-titulo-ayuda">
									<h1 class="titulo-ayuda">
										Politicas de garantia.
									</h1>
							        </center>   
								 <br>
								 <br>
									<br>
								<ul>
							        <li><h5>Los juegos descargados mediante cuentas son solo para uno y solo una Consola</h5></li>
									<li><h5>Este tipo de juego adquiridos a nosotros se pueden utilizar como Parte de Pago por otros de nuestros articulos</h5></li>
									<li><h5>Damos garantias de por vida, siempre y cuando se cumpla la normativa</h5></li>
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


@endsection