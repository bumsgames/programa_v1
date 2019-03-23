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
				@if($articles->total() == 0)
					<h6>Mostrando 0 articulos</h6>
				@else
					<h6>Mostrando del {{($articles->perPage())*($articles->currentPage()-1)+1}} al {{($articles->perPage() * $articles->currentPage())-($articles->perPage() - $articles->count())}} de {{$articles->total()}} resultados</h6>
					{{--<h6>Numero de articulos: {{ $articles_cantidad }}</h6>--}}
				@endif
				<form action="articulos_bd" method="POST" class="form-inline" target="_blank">
					{{ csrf_field() }}
					<div class="custom-control my-1 mr-sm-2">
						<input autocomplete="off" type="text" placeholder="Buscar" class="form-control" name="coincidencia" id="buscador">
						<input type="text" name="misbusqueda" value="{{Auth::id()}}" hidden>
					</div>
					<button type="submit" class="btn btn-primary my-1">
						<i class="fa fa-search" aria-hidden="true"></i> 
						Buscar Coincidencia
					</button>
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
								<th scope="col">Duenno</th>
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
							<tr>
								<th scope="row">
									<?php echo $i++; ?>
								</th>
								<td>
									{{$article->name}}  (ID: {{ $article->id }})
									<br>	
									<br>	
									<strong>
										Categoria: 
									</strong>
									{{ $article->pertenece_category->category }}
									<br>
									<br>
									<strong>
										Agregado por: 
									</strong>
									{{ $article->pertenece_id_creator->name }} 
									{{ $article->pertenece_id_creator->lastname }}

									

									<br>
									<br>
									<strong>
										Nota: 
									</strong>
									{{ $article->note }} 									
								</td>
								<td style="width: 20%;">
									<strong>Accion:</strong> 
									<br>
									{{ $article->porcentaje }} %
								</td>
								<td>
									@if(Auth::user()->level >= 7)
									<strong>
										Correo: 
									</strong>
									{{ $article->email }} 
									<br>
									<br>
									<strong>
										Password: 
									</strong>
									{{ $article->password }}
									<br>
									<br>
									<strong>
										Nickname: 
									</strong>
									{{ $article->nickname }} 
									<br>
									<br>
									@if(!(empty($article->reset_button)))
									<strong>	
										Fecha de reseteo: 
									</strong>
									{{ date('d-m-Y', strtotime($article->reset_button)) }} 
									@endif
									@endif 				
								</td>
								<td>	
									<strong>Cantidad: </strong>
									{{ $article->quantity }} 
									<br>	
									<br>
									<strong>Precio: </strong>
									{{ $article->price_in_dolar }} $
									<br>	
									<br>	
									<strong>Precio en oferta: </strong>
									{{ $article->offer_price }} $
									<br>	
									<br>
									@if(!in_array($article->category,array(4,6,11,14,15)))
									<strong>Peso del juego: </strong>
									{{ $article->peso }} GB
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
										Onclick='vender_articulo({{ $article->id }},"{{ $article->name }}", "{{ $article->email }}", "{{ $article->password }}");'>
										Vender
									</button>

									<form action="/buscar_articulo" method="post" target="_blank">
										<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
										<input type="text" hidden="" value="{{ $article->id_articulo }}" name="id_art">
										<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="" value="" Onclick="">Modificar</button>
									</form>
									@endif
									<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg3" Onclick="mandaridM({{$article->id}})">Eliminar</button>

									
									
								</div>
								<br>
								<br>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cliente" onclick='mostrar_articulo_cliente({{ $article->id }})'>Parte cliente</button>

								<div class="modal fade modal_cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h6 class="modal-title" id="titulo_cliente_articulo"></h6>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<br>	
											<div class="container">	
												<input type="text" id="id_articulo2" hidden="">
												<div class="row">
												<div class="col-12 col-lg">
														<div class="form-group">
															<label for=""><strong>ID CLIENTE</strong></label>
															<input class="form-control form-control-sm" 
															type="text"
															name="id_client" 
															id="id_client2" 
															placeholder=""
															autocomplete="off"
															readonly="">
														</div>							
													</div>
													<div class="col-12 col-lg">
														<div class="form-group">
															<label for=""><strong>Nombre</strong></label>
															<input class="form-control form-control-sm" 
															type="text"
															id="name_client2" 
															placeholder=""
															autocomplete="off"
															>

														</div>

													</div>
													<div class="col-12 col-lg">
														<div class="form-group">
															<label for=""><strong>Apellido</strong></label>
															<input class="form-control form-control-sm" 
															type="text"
															name="lastname_client" 
															id="lastname_client2" 
															placeholder=""
															autocomplete="off"
															>
														</div>
													</div>
													<div class="col-12 col-lg">
														<div class="form-group">
															<label for=""><strong>Num Contacto</strong></label>
															<input class="form-control form-control-sm" 
															type="text"
															id="num_contact2" 
															placeholder=""
															autocomplete="off"
															>
														</div>
													</div>
												</div>

												<br>
												<center>
													<button class="btn" id="borrar_campos">Borrar campos</button>	
													<button class="btn btn-primary" id="agregar_cliente_articulo">Agregar cliente</button>
												</center>
												<br>
												<table class="" id="table_client2">

												</table>
												<strong>A que cliente(s) pertenece este articulo?</strong>	
												<div class="modal-body">
													<table class="table-responsive" id="tabla">
														<thead>	
															<tr>
																<td>#</td>
																<td>Cliente</td>
																<td>Contacto</td>
															</tr>
														</thead>
														<tbody>	

														</tbody>
													</table>
												</div>

											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
					</tr>
				</tbody>
			</table>
		</div>
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


	</div>

</div>
</div>

</main>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
				<div class="col-12 col-lg">
						
						<center>
							PARTE CLIENTE
						</center>
						<hr>
						<div class="row">
							<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
							<input name="id_articulo" id="id_articulo" hidden="">
							<input name="id_user" id="id_user" value="{{ Auth::user()->id }}" hidden="">

							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>ID CLIENTE</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="id_client" 
									id="id_client" 
									placeholder=""
									autocomplete="off"
									readonly="">

								</div>
								
							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Nickname</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="nickname" 
									id="nickname" 
									placeholder=""
									autocomplete="off"
									readonly="">

								</div>
							</div>
							
						</div>
						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Nombre</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									id="name_client" 
									placeholder=""
									autocomplete="off"
									>

								</div>
								
							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Apellido</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="lastname_client" 
									id="lastname_client" 
									placeholder=""
									autocomplete="off"
									>
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Contacto</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="num_contact" 
									id="num_contact" 
									placeholder=""
									autocomplete="off"
									>
								</div>		
							</div>
							<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Nota</strong></label>
									<input class="form-control form-control-sm" 
									type="text"
									name="note" 
									id="note" 
									placeholder=""
									autocomplete="off"
									>
								</div>		
							</div>
						</div>

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Nombre y Apellido</th>
										<th scope="col">Nickname</th>
										<th scope="col">Boton</th>
									</tr>
								</thead>
								<tbody id="table_client">

								</tbody>
							</table>
						</div>
						<button id="borrar_client_venta">Cliente Nuevo</button>
					</div>
					<div class="col-12 col-lg">
						<center>
							PARTE PAGO
						</center>
						<hr>
						<input type="text" hidden="" id="articulo_venta">
						<div class="row">
						<div class="col-12 col-lg">
								<div class="form-group">
									<label for=""><strong>Tipo de Transaccion</strong></label>
									<select 
									class="form-control form-control-sm" 
									name="type" 
									id="type">
									<option value="Venta">Venta</option>
									<option value="Cambio">Cambio</option>
								</select>
							</div>
							<label for=""><strong>Si es cambio, dejar nota y anotar si hay diferencia.</strong>
							</label>	

						</div>

					</div>
					<br>	
					<br>
					<div class="row">
					<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Cantidad</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="cantidad" 
								id="cantidad" 
								placeholder=""
								autocomplete="off">

							</div>

						</div>
						<div class="col-12 col-lg-9">
							<div class="form-group">
								<label for=""><strong>Banco Emisor</strong></label>
{{-- 								<input class="form-control form-control-sm" 
								type="text"
								name="description" 
								id="description" 
								placeholder=""
								autocomplete="off"> --}}
								<select class="form-control form-control-sm" name="description" id="description">
									@foreach($bancos as $banco)
									<option value="{{ $banco->banco }}">{{ $banco->banco }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Referencia</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="reference" 
								id="reference" 
								placeholder=""
								autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Monto</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="price" 
								id="price" 
								placeholder=""
								autocomplete="off">

							</div>

						</div>
						<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Moneda</strong></label>
								<select class="form-control form-control-sm" name="coin" id="coin">
									@foreach($coins as $coin)
									<option value="{{ $coin->id }}">{{ $coin->coin }} ({{ $coin->sign }})</option>

									@endforeach
									
								</select>
							</div>

						</div>
					</div>
					<div class="row">
					<div class="col-12 col-lg">
							<div class="form-group">
								<label for=""><strong>Nota</strong></label>
								<textarea class="form-control form-control-sm" 
								type="text"
								name="note_sale" 
								id="note_sale" 
								placeholder=""
								autocomplete="off">
							</textarea>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>

	<div class="container" >	
		<label>
			<input type="checkbox" value="checkbox" name="CheckboxGroup1" id="boxchecked" />
		Incluye envio.</label>	
		<div class="row" id="hidden">
		<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Empresa</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="empresa" 
					id="empresa" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Direccion</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="direccion" 
					id="direccion" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Cedula</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="cedula" 
					id="cedula" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Numero de telefono</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="num_telefono" 
					id="num_telefono" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="form-group">
					<label for=""><strong>Quien recibe?</strong></label>
					<input class="form-control form-control-sm" 
					type="text"
					name="recibe" 
					id="recibe" 
					placeholder=""
					autocomplete="off">
				</div>
			</div>

		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="realizar_venta">Realizar venta</button>
	</div>
</div>
</div>
</div>

@include('modal.eliminar_articulo')

@endsection