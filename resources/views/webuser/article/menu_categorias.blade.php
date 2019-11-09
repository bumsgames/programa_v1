@extends('layouts.plantillaWeb')

@extends('layouts.ultimos-v')

@section('content')
<br>
<br>
<br>


<div class="" style="background-color: white;">
	
	{{-- PlayStation 4 --}}
	@if ($opcion == 1)
	<div class="fondotituloArticulos-ps" style="">
		<h2  class="titulobumsArticulos">{{ $title }}</h2>
	</div>

	
	{{-- <img class="tuberia-ps4 escondite" src="{{ url('img/crashps.png') }}"> --}}
	<div class="container">		
		<div class="row">
			<div class="col">

				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="1">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/prueba2.png') }}" alt=""> 
						</center>
					</a>
				</form>
			</div>
			<div class="col">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="2">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/ps4 secundario.png') }}" alt="">
						</center>
					</a>
				</form>
			</div>
			<div class="col">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="4">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/ps4 articulos fisicos.png') }}" alt="">
						</center>
					</a>
				</form>
				
			</div>
			<div class="col">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="3">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/ps4 codigo digital.png') }}" alt="">
						</center>
					</a>
				</form>
				
			</div>
			<div class="col">
				<form action="articulos_oferta_opc" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="tipo_oferta" hidden="" value="playstation">	
						<center>
						<img class="mancha_categoria" src="{{ url('img/ps4 oferta.png') }}" alt="">
					</center>
					</a>
				</form>	
			</div>
			<div class="col">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="5">	
						<center>
						<img class="mancha_categoria" src="{{ url('img/PS3 DIGITAL.png') }}" alt="">
					</center>
					</a>
				</form>
				
			</div>

			
			
		</div>
		<center>
			
			<img class="img_category" src="{{ url('img/horizon.png') }}" alt="prueba">
			<img class="img_category" src="{{ url('img/juego god.jpg') }}" alt="">
			<img class="img_category" src="{{ url('img/spider2.jpg') }}" alt="">
			<img class="img_category" src="{{ url('img/days.jpg') }}" alt="">
			
		</center>
		<br>
	</div>
	@elseif ($opcion == 2)
	<div class="fondotituloArticulos-xbox">
		<h2  class="titulobumsArticulos">{{ $title }}</h2>
	</div>

	
	<img class="imagen_2_xbox escondite" src="{{ url('img/halo2.png') }}">
	<div class="container">		
		<div class="row">
			<div class="col">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="8">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/XB1 PRIMARIO.png') }}" alt="">
						</center>
					</a>
				</form>

			</div>
			<div class="col">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="9">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/xbox one sec.png') }}" alt="">
						</center>
					</a>
				</form>
				
			</div>
			<div class="col">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="10">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/XBOX ONE CODIGO.png') }}" alt="">
						</center>
					</a>
				</form>

				
			</div>
			<div class="col">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="11">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/XBOX FISICO.png') }}" alt="">
						</center>
					</a>
				</form>

				
			</div>
			<div class="col">
				<form action="articulos_oferta_opc" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="tipo_oferta" hidden="" value="xbox">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/XBOX ONE OFERTA.png') }}" alt="">
						</center>
					</a>
				</form>
				
			</div>
			
		</div>
		<center>
			<img class="img_category" src="{{ url('img/forza4.jpg') }}" alt="prueba">
			<img class="img_category" src="{{ url('img/cuphead.jpg') }}" alt="">
			<img class="img_category" src="{{ url('img/halo 5.jpg') }}" alt="">
			<img class="img_category" src="{{ url('img/gears4.jpg') }}" alt="">
			
		</center>
		<br>
	</div>

	@elseif ($opcion == 3)
	<div class="fondotituloArticulos-nintendo" style="">
		<h2  class="titulobumsArticulos">{{ $title }}</h2>
	</div>

	
	<img class="tuberia-xbox escondite" src="{{ url('img/tuberia.png') }}">
	<div class="container">		
		<div class="row">
			<div class="col-12 col-lg-6">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="12">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/ns digital.png') }}" alt="">
						</center>
					</a>
				</form>
				

			</div>
			<div class="col-12 col-lg-6">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="13">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/NINTENDO CODIGO.png') }}" alt="">
						</center>
					</a>
				</form>
				
				
			</div>
			<div class="col-12 col-lg-6">
				<form action="articulos" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="category" hidden="" value="14">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/NINTENDO FISICO.png') }}" alt="">
						</center>
					</a>
				</form>
				
				
			</div>
			<div class="col-12 col-lg-6">
				<form action="articulos_oferta_opc" @method('POST') name="formulario_category">
					<a href="#" class="submit-link" >
						<input type="text" name="tipo_oferta" hidden="" value="nintendo">	
						<center>
							<img class="mancha_categoria" src="{{ url('img/NINTENDO ofertas.png') }}" alt="">
						</center>
					</a>
				</form>	
			</div>
			


			
			
		</div>
		<center>
			<img class="img_category" src="{{ url('img/mario kart.jpg') }}" alt="prueba">
			<img class="img_category" src="{{ url('img/smash.jpg') }}" alt="">
			<img class="img_category" src="{{ url('img/splatoon.jpg') }}" alt="">
			<img class="img_category" src="{{ url('img/zelda.jpg') }}" alt="">
			
		</center>
		<br>
	</div>
	@endif

	
</div>
<br>
<br>

@endsection