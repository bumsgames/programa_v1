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
				<h6>Numero de articulos: {{ $articles_cantidad }}</h6>
				<div class="row">
					<form action="{{ url('articulos_bd') }}" method="POST" class="form-inline col-12 col-lg-7" target="_blank">
						{{ csrf_field() }}
						<div class="my-1 mr-sm-2">
							<input autocomplete="off" type="text" placeholder="Buscar" class="form-control" name="coincidencia" id="buscador">
						</div>
						<button type="submit" class="btn btn-primary mr-sm-2 my-1">
							<i class="fa fa-search" aria-hidden="true"></i> 
							Buscar Coincidencia
						</button>
						<button type="button" class="btn btn-primary my-1 mr-sm-2" data-toggle="collapse" data-target="#filtros"><i class="fa fa-gear"></i>Filtros</button>
						
					</form>
					<form action="{{url('articulosAllOrdenados')}}" method="POST" class="form-inline col-12 col-lg-5">
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
					</form>
				</div>
				<br>
				<form action="{{url('aplicar_filtros_multiples')}}" method="POST" target="_blank">
					{{ csrf_field() }}

					<div id="filtros" class="collapse">
						<div class="row" style="margin-left:0">
							<div class="form-group col-12">
								<label for="namefilt"> Filtrar por nombre</label>
								<input autocomplete="off" class="form-control" type="text" name="namefilt" placeholder="Filtrar por nombre">
							</div>
							<div class="form-group col-12 col-lg-3">
								<label for="selcat">Filtrar por categoria</label>
								<select name="selcat" class="form-control" id="selcat">
									<option value='0'>No filtrar</option>
									<?php $cont=0?>
									@foreach($categories as $categoria)
									<option value="{{$categoria->id}}">{{$categoria->category}}</option>
									@endforeach
								</select>
							</div>	
							<div  class="form-group col-12 col-lg-3">
								<label for="seldu">Filtrar por Dueño</label>
								<select name="seldu" class="form-control custom-select" id="seldu">
									<option value="0">No filtrar</option>
									<?php $cont=0?>
									@foreach($users as $usuario)
									<option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->lastname}}</option>
									@endforeach
								</select>
							</div>

							<div  class="form-group col-12 col-lg-3">
								<label for="correofiltro">Filtrar por Correo</label>
								<input autocomplete="off" type="text" placeholder="Buscar correo" class="form-control" name="filtrocorreo" id="correofiltro">
							</div>
							<div class="form-group col-12 col-lg-3">
								<label for="seldu">Filtrar por disponibilidad</label>
								<div class="form-control">
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" class="custom-control-input" id="disponible" name="disponible" value="1">
										<label class="custom-control-label" for="disponible">Disponible</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" class="custom-control-input" id="nodisponible" name="disponible" value="2">
										<label class="custom-control-label" for="nodisponible">No disponible</label>
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
									<option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->lastname}}</option>
									@endforeach
								</select>
							</div>	


							<div  class="form-group col-12 col-lg-3">
								<label for="nickfil">Filtrar por Nickname</label>
								<input autocomplete="off" type="text" placeholder="Buscar correo" class="form-control" name="nickfil" id="nickfil">
							</div>

							<div class="form-group col-12 col-lg-3">
								<label for="precio">Filtrar por Precio</label>
								<div >
									<label for="preciorange">Precio: <span id="precioranget"></span > $</label>
									<input value="0" type="range" class="custom-range" id="preciorange" name="precio">
								</div>
								<div>
									<label  for="ofertarange">Precio subrayado: <span id="ofertaranget"></span> $</label>
									<input value="0" type="range" class="custom-range" id="ofertarange" name="oferta">
								</div>
							</div>
							<div class="form-group col-12 col-lg-3">
								<label for="peso">Filtrar por Peso</label>
								<div class="form-control">
									<label for="pesorange">Peso: <span id="pesoranget"></span > GB</label>
									<input value="0" type="range" class="custom-range" id="pesorange" name="peso">
								</div>
							</div>
							
						</div>	
						
						<button type="submit" class="btn btn-primary my-1 mr-sm-2">Filtrado multiple</button>

					</div>
				</form>
				<br>	

				@if ($articles->hasPages())
				<ul class="pagination justify-content-center">
					{{-- Previous Page Link --}}
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

					{{-- Next Page Link --}}
					@if ($articles->hasMorePages())
					<li class="page-item"><a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next">></a></li>
					@else
					<li class="page-item disabled"><span class="page-link">></span></li>
					@endif
				</ul>
				@endif
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
						<tbody>
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
										Categoria: 
									</strong>
									{{-- categoria vieja --}}
									{{-- <br>	
									<div class="catefiltrar">{{ $article->pertenece_category->category }}</div>
									<br>
									<br> --}}
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
									Ubicacion {{ $article }}

								</td>
								<td>
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
									<br>
									<br>
								</td>
								<td>	
									Cantidad: {{ $article->quantity }}
									{{-- <div class="disponibilidad">{{ $article->quantity }}</div>  --}}
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
								</td>
								<td>
									@if(Auth::user()->level >= 7)
									<div class="btn-group" role="group" aria-label="Basic example">
										<button type="button" 
										class="btn btn-secondary" 
										data-toggle="modal" data-target=".bd-example-modal-lg"	
										value="{{ $article->id }} "
										Onclick='vender_articulo({{ $article->id }},"{{ $article->name }}", "{{ $article->email }}", "{{ $article->password }}","{{ $article->pertenece_category->category }}",{{ $article->category }});'>
										Vender
									</button>
									@endif

									<form action="/buscar_articulo" method="post" target="_blank">
										<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
										<input autocomplete="off" type="text" hidden="" value="{{ $article->id }}" name="id_art">
										<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="" value="" Onclick="">Modificar</button>
									</form>
									
									<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg3" Onclick="mandaridM({{$article->id}})">Eliminar</button>

									
									
								</div>
								<br>
								<br>
								
								<button type="button" 
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
							</button>
							<br>
							<br>
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
@if ($articles->hasPages())
<ul class="pagination justify-content-center">
	{{-- Previous Page Link --}}
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

	{{-- Next Page Link --}}
	@if ($articles->hasMorePages())
	<li class="page-item"><a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next">></a></li>
	@else
	<li class="page-item disabled"><span class="page-link">></span></li>
	@endif
</ul>
@endif


</div>

</div>
</div>

</main>

@include('modal.venta')
@include('modal.modificacionRapida')

@include('modal.eliminar_articulo')
@include('modal.parte_cliente')

@endsection