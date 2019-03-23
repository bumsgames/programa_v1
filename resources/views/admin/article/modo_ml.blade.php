@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Modo Mercadolibre</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="row">
					<div style="border-right: 1px solid;" class="col">
						<h6 style="color: red;">Articulos agotados: {{ $articles_off->count() }}</h6>
						<div class="custom-control my-1 mr-sm-2">
							<input autocomplete="off" type="text" placeholder="Buscar" class="form-control" name="coincidencia" id="buscador1">
						</div>
						<br>	

						<br>
						<div class="table-responsive">
							<table class="table table-responsive">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Informacion</th>	
										<th scope="col">Cantidad</th>
										<th scope="col">Botones</th>
									</tr>
								</thead>
								<?php $i=1; ?>
								<tbody>
									@foreach($articles_off as $article)
									<tr>
										<th scope="row">
											<?php echo $i++; ?>
										</th>
										<td>
											{{$article->name}}
											<br>	
											<br>	
											<strong>
												Categoria: 
											</strong>
											<br>	
											{{ $article->pertenece_category->category }}
											<br>
											<br>
										</td>
										
										<td>	
											<strong>Cantidad: </strong>
											<br>	
											{{ $article->quantity }} 
											<br>	
											<br>
											<strong>Precio: </strong>
											<br>	
											{{ $article->price_in_dolar }} $
											<br>	
											<br>
										</td>
										<td>
											<strong>Ultima actualizacion: </strong>
											<br>	
											{{ $article->updated_at->diffForHumans() }}
											<br>
											<br>
											<form action="/buscar_articulo" method="post" target="_blank">
												<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
												<input type="text" hidden="" value="{{ $article->id }}" name="id_art">
												<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="" value="" Onclick="">Modificar</button>
											</form>
										</td>
									</div>
								</td>
							</tr>
							@endforeach
						</tr>
					</tbody>
				</table>

			</div>
		</div>
		<div class="col">
			<h6 style="color: green;">Articulos disponibles: {{ $articles_on->count() }}</h6>
			<div class="custom-control my-1 mr-sm-2">
				<input autocomplete="off" type="text" placeholder="Buscar" class="form-control" name="coincidencia" id="buscador2">
			</div>
			<br>	

			<br>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Informacion</th>	
							<th scope="col">Cantidad</th>
							<th scope="col">Botones</th>
						</tr>
					</thead>
					<?php $i=1; ?>
					<tbody>
						@foreach($articles_on as $article)
						<tr>
							<th scope="row">
								<?php echo $i++; ?>
							</th>
							<td>
								{{$article->name}}
								<br>	
								<br>	
								<strong>
									Categoria: 
								</strong>
								<br>	
								{{ $article->pertenece_category->category }}
								<br>
								<br>
							</td>

							<td>	
								<strong>Cantidad: </strong>
								<br>	
								{{ $article->quantity }} 
								<br>	
								<br>
								<strong>Precio: </strong>
								<br>	
								{{ $article->price_in_dolar }} $
								<br>	
								<br>	
							</td>
							<td>
								<strong>Ultima actualizacion: </strong>
								<br>	
								{{ $article->updated_at->diffForHumans() }}
								<br>
								<br>
								<form action="/buscar_articulo" method="post" target="_blank">
									<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
									<input type="text" hidden="" value="{{ $article->id }}" name="id_art">
									<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="" value="" Onclick="">Modificar</button>
								</form>
							</td>
						</div>
					</td>
				</tr>
				@endforeach
			</tr>
		</tbody>
	</table>

</div>
</div>

</div>
</div>

</div>
</div>

</main>

@endsection