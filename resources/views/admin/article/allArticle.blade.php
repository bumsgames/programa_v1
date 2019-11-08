@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> {{ $title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				{{-- @if($articles->total() == 0)
				<h6>Mostrando 0 articulos</h6>
				@else
				<h6>Mostrando del {{($articles->perPage())*($articles->currentPage()-1)+1}} al {{($articles->perPage() * $articles->currentPage())-($articles->perPage() - $articles->count())}} de {{$articles->total()}} resultados</h6>
				<h6>Numero de articulos: {{ $articles_cantidad }}</h6>
				@endif
				--}}
				@if(isset($articlesLista))
				LISTA DE CANTITADES
				<br>	
				<br>	
				@foreach($articlesLista as $article)
				{{$article->name}} ({{ $article->price_in_dolar }} $) | <b>{{ $article->category }}</b> |
				<br>	
				Cantidad: {{$article->quantity}}
				<br>	
				<br>	
				@endforeach
				@endif


				<div class="row">
					{{-- <form action="{{ url('articulos_bd') }}" method="POST" class="form-inline col-12 col-lg-7" target="_blank">
						{{ csrf_field() }}
						<div class="my-1 mr-sm-2">
							<input autocomplete="off" type="text" placeholder="Buscar" class="form-control" name="coincidencia" id="buscador" @if(isset($busqueda)) value={{$busqueda}} @endif>
						</div>
						<button type="submit" class="btn btn-primary mr-sm-2 my-1">
							<i class="fa fa-search" aria-hidden="true"></i> 
							Buscar Coincidencia
						</button>
						
						
					</form> --}}
					<button style="margin-left: 30px;" type="button" class="btn btn-primary my-1 mr-sm-2" data-toggle="collapse" data-target="#filtros"><i class="fa fa-gear"></i>Filtros</button>
					{{-- <form action="{{url('articulosAllOrdenados')}}" method="POST" class="form-inline col-12 col-lg-5">
						{{ csrf_field() }}
						<div class="my-1 form-group mr-sm-2">
							<label for="sel1">Ordenar por:  </label>
							<select name="parametro" class="form-control" id="order">
								<option value="1">Precio</option>
								<option value="2">Precio Oferta</option>
								<option value="3">Titulo</option>
								<option value="4">Nickname</option>
								<option value="5">Correo</option>
								<option value="6">Fecha de reset</option>
							</select>
						</div>
						<div class="my-1 form-group mr-sm-2">
							<label for="sel1">de:  </label>
							<select name="mayormenor" class="form-control" id="by">
								<option value="1">Mayor a menor</option>
								<option value="2">Menor a mayor</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary mr-sm-2 my-1">
							<i class="fa fa-search" aria-hidden="true"></i> 
							Ordenar
						</button>
					</form> --}}
				</div>
				<br>
				<form action="{{url('aplicar_filtros_multiples')}}" method="POST" target="_blank">
					{{ csrf_field() }}

					<div id="filtros" class="collapse">
						<div class="row" style="margin-left:0">
							<div class="form-group col-12">
								<label for="namefilt"> Filtrar por nombre</label>
								<input autocomplete="off" class="form-control" type="text" name="namefilt" placeholder="Filtrar por nombre" @if(isset($busqueda)) value={{$busqueda}} @endif>
							</div>
							<div class="form-group col-12 col-lg-3">
								<label for="selcat">Filtrar por categoria</label>
								<select name="selcat" class="form-control" id="selcat">
									<option value='0'>No filtrar</option>
									<?php $cont=0?>
									@foreach($categories as $categoria)
									<option value="{{$categoria->id}}" @if(isset($parametros[0]))@if($parametros[0] == $categoria->id) selected @endif @endif>{{$categoria->category}}</option>
									@endforeach
								</select>
							</div>	
							<div  class="form-group col-12 col-lg-3">
								<label for="seldu">Filtrar por Dueño</label>
								<select name="seldu" class="form-control custom-select" id="seldu">
									<option value="0">No filtrar</option>
									<?php $cont=0?>
									@foreach($users as $usuario)
									<option value="{{$usuario->id}}" @if(isset($parametros[8]))@if($parametros[8] == $usuario->id) selected @endif @endif>{{$usuario->name}} {{$usuario->lastname}}</option>
									@endforeach
								</select>
							</div>

							<div  class="form-group col-12 col-lg-3">
								<label for="correofiltro">Filtrar por Correo</label>
								<input @if(isset($parametros[1])) value="{{$parametros[1]}}" @endif autocomplete="off" type="text" placeholder="Buscar correo" class="form-control" name="filtrocorreo" id="correofiltro">
							</div>
							<div class="form-group col-12 col-lg-3">
								<label for="seldu">Filtrar por disponibilidad</label>
								<div class="form-control">
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" class="custom-control-input" id="disponible" name="disponible" value="1" @if(isset($parametros[2]))@if($parametros[2] == 1) checked @endif @endif>
										<label class="custom-control-label" for="disponible">Disponible</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" class="custom-control-input" id="nodisponible" name="disponible" value="0"  @if(isset($parametros[2]))@if($parametros[2] == 2) checked @endif @endif>
										<label class="custom-control-label" for="nodisponible">No disponible</label>
									</div> 
									<div class="custom-control custom-control-inline" style="margin-right:0">
										<button id="uncheck" class="btn btn-primary btn-sm" type="button">Resetear</button>
									</div>
								</div>
							</div>

						</div>
						<div class="row" style="margin-left:0">
							<div class="form-group col-12 col-lg-3">
								<label for="creatorfilter">Filtrar por creador</label>
								<select name="creatorfilter" class="form-control" id="creatorfilter">
									<option value="0">No filtrar</option>
									<?php $cont=0?>
									@foreach($users as $usuario)
									<option value="{{$usuario->id}}" @if(isset($parametros[3]))@if($parametros[3] == $usuario->id) selected @endif @endif>{{$usuario->name}} {{$usuario->lastname}}</option>
									@endforeach
								</select>
							</div>	


							<div  class="form-group col-12 col-lg-3">
								<label for="nickfil">Filtrar por Nickname</label>
								<input autocomplete="off" type="text" @if(isset($parametros[4])) value="{{$parametros[4]}}"  @endif placeholder="Buscar Nickname" class="form-control" name="nickfil" id="nickfil">
							</div>

							{{-- <div class="form-group col-12 col-lg-3">
								<label for="precio">Filtrar por Precio</label>
								<div >
									<label for="preciorange">Precio Minimo: <span id="precioranget"></span > $</label>
									<input @if(isset($parametros[5])) value="{{$parametros[5]}}" @else value="0" @endif  type="range" class="custom-range" id="preciorange" name="precio">
								</div>
								<div>
									<label  for="ofertarange">Precio Subrayado Minimo: <span id="ofertaranget"></span> $</label>
									<input @if(isset($parametros[6])) value="{{$parametros[6]}}" @else value="0" @endif type="range" class="custom-range" id="ofertarange" name="oferta">
								</div>
							</div>
							<div class="form-group col-12 col-lg-3">
								<label for="peso">Filtrar por Peso Minimo</label>
								<div class="form-control">
									<label for="pesorange">Peso: <span id="pesoranget"></span > GB</label>
									<input @if(isset($parametros[7])) value="{{$parametros[7]}}" @else value="0" @endif type="range" class="custom-range" id="pesorange" name="peso">
								</div>
							</div> --}}

						</div>	

						<button type="submit" class="btn btn-primary my-1 mr-sm-2">Filtrado multiple</button>

					</div>
				</form>
				<br>	
				
				{{-- @if ($articles->hasPages())
				<ul class="pagination justify-content-center">
					@if ($articles->onFirstPage())
					<li class="page-item disabled"><span class="page-link"><</span></li>
					@else
					<li class="page-item"><a class="page-link" href="{{ $articles->previousPageUrl() }}" rel="prev"><</a></li>
					@endif

					@if($articles->currentPage() > 3)
					<li class="page-item hidden-xs"><a class="page-link" href="{{ $articles->url(1) }}">1</a></li>
					@endif
					@if($articles->currentPage() > 4)
					<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@foreach(range(1, $articles->lastPage()) as $i)
					@if($i >= $articles->currentPage() - 2 && $i <= $articles->currentPage() + 2)
					@if ($i == $articles->currentPage())
					<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
					@else
					<li class="page-item"><a class="page-link" href="{{ $articles->url($i) }}">{{ $i }}</a></li>
					@endif
					@endif
					@endforeach
					@if($articles->currentPage() < $articles->lastPage() - 3)
					<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@if($articles->currentPage() < $articles->lastPage() - 2)
					<li class="page-item hidden-xs"><a class="page-link" href="{{ $articles->url($articles->lastPage()) }}">{{ $articles->lastPage() }}</a></li>
					@endif

					@if ($articles->hasMorePages())
					<li class="page-item"><a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next">></a></li>
					@else
					<li class="page-item disabled"><span class="page-link">></span></li>
					@endif
				</ul>
				@endif --}}

				<br>
				<div class="table-responsive">

					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Informacion</th>
								<th scope="col">Dueño</th>
								@if(Auth::user()->level >= 7)
								<th scope="col">Correo y Clave</th>
								@else
								<th></th>
								@endif
								<th scope="col">Cantidad</th>
								<th scope="col">Botones</th>
							</tr>
						</thead>
						<?php $i=1; ?>
						<tbody id="articlesAll">
							@foreach($articles as $article)
							<tr class="prod">
								<th scope="row">
									<?php echo $i++; ?>
								</th>
								<td>
									<div class="nombreafiltrar">{{$article->name}}</div> (ID: {{ $article->id }})
									<br>	
									<br>	
									<strong>
										Categorias: 
									</strong>
									<br>	
									
									<div class="catefiltrar">
										@foreach($article->categorias as $categoria)
										<span>{{ $categoria->category }}</span>
										<br>
										@endforeach
									</div>

									<br>	
									<br>	 
									<strong>
										Condición: 
									</strong>
									<br>	
									<div class="estadofiltrar">{{ $article->estado }}</div>
									<br>
									<br>
									<strong>
										Agregado por: 
									</strong>
									<br>	
									<div class="crefiltrar">{{ $article->pertenece_id_creator->name }} {{ $article->pertenece_id_creator->lastname }}</div>
									<br>
									<br>
									<strong>
										Nota: 
									</strong>
									<?php echo $article->note; ?> 
									<br>
									<br>
									<?php
									$compronumber=$article->clientes_del_articulo->count();
									?>
									@if($article->clientes_del_articulo->count() > 0)
									<strong>Vendedor por cliente: </strong>
									<br>
									<?php $j = 1; ?>

									@foreach($article->ventas_del_articulo as $ventas)
									<?php echo $j++; ?>) {{ $ventas->user->name }} {{ $ventas->user->lastname }} <br>	
									@endforeach
									<br>
									<br>	
									@endif
								</td>
								<td style="width: 20%;">
									<b>Ubicacion:</b> {{ $article->Ubicacion2->nombre_ubicacion }}
									<br>
									<br>
									@foreach($article->duennos->sortBy('porcentaje') as $duenno)
									<strong>
										Dueño:
									</strong>
									<br>
									<div class="dufiltrar">{{ $duenno->name }} {{ $duenno->lastname }}</div>
									@if($duenno->pivot->porcentaje != 100)
									<br>
									<strong>
										Acciones:
									</strong>
									<br>
									{{ $duenno->pivot->porcentaje }} %

									@endif
									<br>	
									<br>	
									@endforeach			
									@if(Auth::user()->level >= 7)
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									@if($article->clientes_del_articulo->count() > 0)
									<strong>Clientes dueños del articulo: </strong>
									<br>
									<?php $j = 1; ?>
									@foreach($article->clientes_del_articulo as $cliente)
									<?php echo $j++; ?>) {{ $cliente->name }} {{ $cliente->lastname }} <br>	
									@endforeach
									<br>
									<br>	
									@endif
									@endif
									<br>
									<br>



									
								</td>
								<td>
									{{-- {{ $article->categorias[0]->category }} --}}
									
									@if (isset($article->categorias[0]))
									@if ((strpos($article->categorias[0]->category,'Cuenta') !== false) 
									|| (strpos($article->categorias[0]->category,'Cupo') !== false))

									@if(Auth::user()->level >= 7)
									<strong>
										Correo: 
									</strong>
									<br>	
									<div class="correofiltrar">{{ $article->email }} </div>
									<br>
									<br>
									<strong>
										Password: 
									</strong>
									<br>	
									{{ $article->password }}
									<br>
									<br>
									<strong>
										Nickname: 
									</strong>
									<br>	
									<div class="nickfiltrar">{{ $article->nickname }}</div> 
									<br>
									<br>
									@if(!(empty($article->reset_button)))
									<strong>	
										Fecha de reseteo: 
									</strong>
									{{ date('d-m-Y', strtotime($article->reset_button)) }} 
									@endif
									<br>
									<br>
									@if($article->clientes_del_articulo->count() > 0)
									<strong>Numero de contacto de comprador: </strong>
									<br>
									<?php $j = 1; ?>
									@foreach($article->clientes_del_articulo as $cliente)
									<?php echo $j++; ?>) {{ $cliente->num_contact }} <br>	
									@endforeach
									<br>
									<br>	
									@endif
									@endif
									
									
									@endif
									@endif
									
								</td>
								<td>	
									<span class="font-weight-bold">Cantidad:</span> 
									<br>
									<span id="cantidadDisponible_{{ $article->id }}">{{ $article->quantity }}</span>
									<br>	
									<br>
									<strong>Precio: </strong>
									<br>
									<span class="preciofil">{{ $article->price_in_dolar }}</span> $
									<br>	
									<br>
									<strong>Precio subrayado: </strong>
									<br>
									<span class="ofertafil">{{ $article->offer_price }}</span> $
									<br>	
									<br>	
									@if(!in_array($article->category, array(4,6,11,14,15)))
									<strong>Peso del juego: </strong>
									<br>
									<span class="pesofil">{{ $article->peso }}</span> GB
									<br>	
									<br>
									@endif
									<strong>Costo de Inversión: </strong>
									<br>
									<span class="costofil">{{$article->costo}} $</span>
									<br>
									<br>
								</td>
								<td>
									<div class="btn-group" role="group" aria-label="Basic example">

										@if(Auth::user()->level >= 7 || in_array($article->category,[3,4,6,7,10,11,13,14,15]))

										

										<form action="/buscar_articulo" method="post" target="_blank">
											<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
											<input autocomplete="off" type="text" hidden="" value="{{ $article->id }}" name="id_art">
											<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="" value="" Onclick="">Modificar</button>
										</form>
										
										<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg3" Onclick="mandaridM({{$article->id}})">Eliminar</button>
										
									{{-- <button class="btn btn-primary botonCarta"
										onclick="agregaCarro_admin('{{ $article->id }}', '{{ $article->name }}', 
										'{{ $article->pertenece_category->category }}', 
										{{ $article->price_in_dolar }},
										'{{ $article->fondo }}');">
										<img width="50" src="{{ url('img/carrito crash.png') }}">
									</button> --}}

									<button class="btn btn-primary botonCarta"
									onclick="agregaCarro_admin(
										'{{ $article->id }}',
										'{{ $article->name }}', 
										{{ $article->categorias }}, 
										{{ $article->price_in_dolar }},
										'{{ $article->fondo }}',
										{{ $article->duennos }});">
										<img width="50" src="{{ url('img/carrito crash.png') }}">
									</button>
									
								</div>
								<br>
								<br>
								
								{{-- <button type="button" 
								class="btn btn-secondary" 
								data-toggle="modal" 
								data-target=".modal_rapido" 
								value="{{$article->id}}" 

								Onclick='modicacion_rapida(
								{{ $article->id }},
								"{{$article->name}}",
								"{{ $article->pertenece_category->category }}",
								{{$article->quantity}},
								"{{ $article->note }}",
								"{{$article->reset_button}}")'>
								Modificacion Rapida
							</button> --}}
							<br>
							<br>
							@endif

							{{-- onclick='mostrar_articulo_cliente({{ $article->id }})' --}}
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cliente" onclick='mostrar_articulo_cliente({{ $article->id }})'>Parte cliente</button>
						</div>
					</td>
				</tr>
				@endforeach
			</tr>
		</tbody>
	</table>
</div>
{{-- 
@if ($articles->hasPages())
<ul class="pagination justify-content-center">
	@if ($articles->onFirstPage())
	<li class="page-item disabled"><span class="page-link"><</span></li>
	@else
	<li class="page-item"><a class="page-link" href="{{ $articles->previousPageUrl() }}" rel="prev"><</a></li>
	@endif

	@if($articles->currentPage() > 3)
	<li class="page-item hidden-xs"><a class="page-link" href="{{ $articles->url(1) }}">1</a></li>
	@endif
	@if($articles->currentPage() > 4)
	<li class="page-item"><span class="page-link">...</span></li>
	@endif
	@foreach(range(1, $articles->lastPage()) as $i)
	@if($i >= $articles->currentPage() - 2 && $i <= $articles->currentPage() + 2)
	@if ($i == $articles->currentPage())
	<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
	@else
	<li class="page-item"><a class="page-link" href="{{ $articles->url($i) }}">{{ $i }}</a></li>
	@endif
	@endif
	@endforeach
	@if($articles->currentPage() < $articles->lastPage() - 3)
	<li class="page-item"><span class="page-link">...</span></li>
	@endif
	@if($articles->currentPage() < $articles->lastPage() - 2)
	<li class="page-item hidden-xs"><a class="page-link" href="{{ $articles->url($articles->lastPage()) }}">{{ $articles->lastPage() }}</a></li>
	@endif

	@if ($articles->hasMorePages())
	<li class="page-item"><a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next">></a></li>
	@else
	<li class="page-item disabled"><span class="page-link">></span></li>
	@endif
</ul>
@endif --}}


</div>

</div>
</div>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	$('#uncheck').click(function(){
		$('input[name="disponible"]:checked').prop('checked', false);
	});
</script>
@include('modal.venta')
@include('modal.modificacionRapida')

@include('modal.eliminar_articulo')
@include('modal.parte_cliente')

@endsection