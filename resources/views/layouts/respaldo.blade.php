<nav id="mainnavbar" style="background: white !important;" class="navbar navbar-expand-xl navbar-light bg-light menu navBums fixed-top">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" style="background: white;">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="/">
				<img alt="Brand" src="{{ url('img/lo2.png') }}" width="160">
			</a>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<br>
				<div class="row">
					
				</div>
				<ul id="searchnav" class="navbar-nav mr-auto">
					<li>		
						<form class="form-inline" action="/buscar_articulo_bums" method="get">
							<div id="searchnavgroup" class="input-group">
								<input autocomplete="off" type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Simplifica tu compra utilizando el buscador.">

								<div class="input-group-append">
									<button id="searchbtn" class="btn btn-danger btnbuscar"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
								</div>
							</div>
						</form>
					</li>
				</ul>

				<ul class="navbar-nav ml-auto menubuttons">
					<li class="nav-item active">
						<div class="dropdown">
							<a class="nav-link dropbtn" id="category_btn"><i id="down_icon" class="fas fa-chevron-down"></i> CATEGORIAS</a>
						</div>
					</li>

					
					<li class="nav-item menunav active">
						<a class="nav-link" id="login_us" href="/ayuda"><i class="fa fa-users" aria-hidden="true" title="texto al pasar el raton"></i> AYUDA</a>
					</li>
					{{-- BOTON REGISTRARSE --}}
					{{-- @if (Auth::guard('client')->guest())
					<li class="nav-item menunav active">
						<strong>
							<button style="border:none" type="button" class="btn btn-primary nav-link" id="login_us" data-toggle="modal" data-target="#modalregistro">
								<i class="fa fa-user-circle" aria-hidden="true"></i> REGISTRARSE
							</button>
						</strong>
					</li>
					@endif --}}
					@if (Auth::guard('client')->guest())
					<li class="nav-item menunav active">	
						<a class="nav-link " href="/login" id="login_us"><i class="fas fa-user"></i> INICIAR SESION</a>
					</li>
					@endif
					@if (Auth::guard('client')->check())
					<li class="nav-item menunav active dropicon casolog">
						<a class="nav-link " href="/adminpaneluser" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> MI CUENTA</a>
						<div class="dropdown-content">
							<a href="/adminpaneluser">Panel Personal</a>
							<a href="/logout_user">Cerrar Sesion</a>

						</div>
					</li>
					<li style="display:none" class="nav-item menunav active casolog">
						<a class="nav-link " href="/adminpaneluser" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> PANEL PERSONAL</a>
					</li>
					<li style="display:none" class="nav-item menunav active casolog">
						<a class="nav-link " href="/logout_user" id="login_us"><i class="fa fa-user-circle-o dropbtn" style="padding:0" aria-hidden="true"></i> CERRAR SESION</a>
					</li>
					@endif		
					<li class="nav-item menunav active">	
						<label class="menu car" for="check"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-light rojoBlanco" id="badge">{{ count(Session::get('carrito')) }}</span>	</label>
					</li>
				</ul>

			</div>
		</nav>

		<!-- INICIO FOOTER -->
<footer class="page-footer font-small cyan darken-3 foot1">
	<div class="container">
		<br>
		<br>
		<div class="row">

			<div class="col-2">

				<a class="navbar-brand" href="/">
					<img alt="Brand" src="{{ url('img/lo2.png') }}" width="160">
				</a>
			</div>
			<div class="col escondite">
				<div class="cartica">
					<center style="padding: 10px;"><h5>DIRECCION</h5></center>
					<hr>	
					<center>
						<img src="img/pelota.png" width="150" alt="Avatar">
						<br>
						<br>	
						PUERTO ORDAZ, Estado Bolivar <br>	
						C.C. Alta Vista II, segundo Piso <br>
						Local #22 frente a la Sala de Juegos <br>	
						<br>	
					</center>	
				</div>
			</div>
			<div class="col escondite">
				<div class="cartica">
					<center style="padding: 10px;"><h5>REDES SOCIALES</h5></center>
					<hr>	
					<center>	
						<a href="https://www.facebook.com/bumsgamesoficial" target="_blank" title="Vista nuestro facebook, que esperas?"><img src="img/logo-f.png" class="abc" alt=""> @BumsGames</a>
						<br>
						<br>
						<a href="https://www.instagram.com/bumsgames/" target="_blank" href="www.google.co.ve" title="Unete a nuestra comunidad en Instagram, tenemos muchas sorpresas"><img class="abc" src="img/logo-i.png" alt=""> @BumsGames</a>
						<br>
						<br>
						<a href="https://perfil.mercadolibre.com.ve/BUMSGAMES_OFICIAL" target="_blank" title="Mira nuestra reputacion en MercadoLibre, somos MercadoLideres"><img class="abc2" src="img/logo-m.png" alt=""> BumsGames_OFICIAL</a>
					</center>


					<br>
				</div>
			</div>
			<div class="col escondite">
				<div class="cartica">
					<center style="padding: 10px;"><h5>CONTACTANOS</h5>
						<hr>	
						David Salazar.
						<br>	
						<i class="fab fa-whatsapp fa-2x"></i> 
						(+58) 0414-987-50-29

						<br>
						<br>			
						Genesis Moreno.
						<br>	
						<i class="fab fa-whatsapp fa-2x"></i> 
						(+58) 0412-796-43-49
						<br>	
						<br>	
						Daniel Duarte.
						<br>	
						<i class="fab fa-whatsapp fa-2x"></i> 
						(+58) 0412-119-23-79
						<br>	
						<br>
					</center>
				</div>
			</div>
		</div>
		<br>	
		
		<div class="footer-copyright text-center py-3 foot2">Llegamos para hacer la diferencia.
			<a href="https://mdbootstrap.com/bootstrap-tutorial/"> BumsGames.com.ve</a>
		</div>
	</footer>	

	li a:hover {
	/*color:#C0392B;*/
	text-decoration: underline;
	opacity: 0.85;
	transition: all 0.3s ease-in-out;
}


<div class="card-body letraNegra" style="background-color: rgba(220, 220, 220, 1);">
			<form class="" action="ver_mas" method="POST">
				<button style="border:none;background-color:unset;padding:0;cursor:pointer;text-align:unset" type="submit" name="art_id" value="{{$articulo->id}}">
					<div class="titulo_carta">
						<strong>{{ $articulo->name }}</strong>
					</div>
					<br>
					
				    @if($articulo->category == 4 || $articulo->category == 6 || $articulo->category == 11 || $articulo->category == 14 || $articulo->category == 15 || $articulo->category == 16 )
							<div style="font-size: 11px !important;"><b>Condicion: </b>{{ $articulo->estado }}</div>
						
					@else
							<div style="font-size: 11px !important;"><b>Condicion: </b>Digital</div>
					@endif
				</button>
				<strong><p style='font-size: 13px;'>{{ $articulo->pertenece_category->category }}</p></strong>		
				@if($articulo->category == 4 || $articulo->category == 6 || $articulo->category == 11 || $articulo->category >= 14)	
				<p style='font-size:12px'>Envios al siguiente dia habil luego del pago.</p>
				@else
				<p style='font-size:12px;'>Peso: {{$articulo->peso}}GB</p>
				@endif
			
			</form>
		</div>