@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

	<main class="app-content">

		<div class="app-title">
			<div>
				<h1><i class="fa fa-dashboard"></i> {{ $title }}</h1>
				<p>Llegamos para hacer la diferencia.</p>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
				<li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
			</ul>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="tile">

					<form id="excelFiltr" action="" method="post">
						<!--Descomentar si se quiere poner nuevamente el excel-->
						<!--Solo sirve para exportar a <b>Excel</b> los movimientos de los usuarios.-->
						<br>
						<br>
						{{ csrf_field() }}
						<div class="form-row align-items-center">
							<div class="col-md-4">
								<label for="validationCustomUsername">Fecha de comienzo</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroupPrepend">Comienzo: </span>
									</div>
									<input type="date" class="form-control" name="fecha_inicio" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
									<div class="invalid-feedback">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label for="validationCustomUsername">Fecha final</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroupPrepend">final: </span>
									</div>
									<input type="date" class="form-control" id="validationCustomUsername" name="fecha_final" placeholder="Username" aria-describedby="inputGroupPrepend" required>
									<div class="invalid-feedback">

									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label for="validationCustomUsername">Usuario</label>
								<select class="form-control" name="id_usuario" id="">
									<option value="0">Todos los usuarios</option>
									@foreach($usuarios as $usuario)
									<option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->lastname }}</option>
									@endforeach
								</select>

							</div>
						</div>	
						<br>	
						<center>
						<!-- Descomentar si se quiere volver a poner el excel
						<button value="excel" name="excel" onclick="askForExcel()" class="btn btn-primary">Exportar</button>-->
						<button value="save" name="save" onclick="askForSubmit()" class="btn btn-primary">Filtrar Busqueda</button>
						<button value="save" name="save" onclick="askForDavid()" formtarget="_blank" class="btn btn-primary">Busqueda David</button>
						</center>
						<br>	

					</form>
					<form>

					</form>
					<input type="text" id="movement" value="{{ $movement }}" hidden="">
					<!--<button type="button" class="btn btn-success" onclick="window.location.href='{{ $url }}'">Movimientos tipo Banco</button>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target=".registrar_movimiento" id="prueba">Crear nuevo movimiento</button>-->
					@include('modal.registrar_movimiento')
					<br>
					<br>
					@if ($movimientos->hasPages())
				<ul class="pagination justify-content-center">
					{{-- Previous Page Link --}}
					@if ($movimientos->onFirstPage())
						<li class="page-item disabled"><span class="page-link"><</span></li>
					@else
						<li class="page-item"><a class="page-link" href="{{ $movimientos->previousPageUrl() }}" rel="prev"><</a></li>
					@endif

					@if($movimientos->currentPage() > 3)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $movimientos->url(1) }}">1</a></li>
					@endif
					@if($movimientos->currentPage() > 4)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@foreach(range(1, $movimientos->lastPage()) as $i)
						@if($i >= $movimientos->currentPage() - 2 && $i <= $movimientos->currentPage() + 2)
							@if ($i == $movimientos->currentPage())
								<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
							@else
								<li class="page-item"><a class="page-link" href="{{ $movimientos->url($i) }}">{{ $i }}</a></li>
							@endif
						@endif
					@endforeach
					@if($movimientos->currentPage() < $movimientos->lastPage() - 3)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@if($movimientos->currentPage() < $movimientos->lastPage() - 2)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $movimientos->url($movimientos->lastPage()) }}">{{ $movimientos->lastPage() }}</a></li>
					@endif

					{{-- Next Page Link --}}
					@if ($movimientos->hasMorePages())
						<li class="page-item"><a class="page-link" href="{{ $movimientos->nextPageUrl() }}" rel="next">></a></li>
					@else
						<li class="page-item disabled"><span class="page-link">></span></li>
					@endif
				</ul>
			@endif
					<div class="table-responsive">
						<table id="table-list" class="table table-bordered display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Información</th>
									<th scope="col">Transacción</th>
									<th scope="col">Artículo</th>
									<th scope="col">Fecha</th>
									<th><i class="fa fa-trash" aria-hidden="true"></i></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							if ($movimientos->hasPages()){
								$count_movimientos=0+(($movimientos->currentPage()-1)*100);
							}
							else{
								$count_movimientos=0;
							}?>
							@foreach($movimientos as $movimiento)
								<tr role="row" class="">
								<td><?php echo ++$count_movimientos;?></td>
								<td><strong>Entidad: </strong>{{$movimiento->movimiento->entidad}}
									<br><br>						 
									<strong>Descripción: </strong>{{$movimiento->movimiento->description}}
									<br><br>
									<strong>Nota: </strong>{{$movimiento->movimiento->note_movimiento}}
								</td>
								<td>

								@if($movimiento->movimiento->type == $movement)
									<?php $transaccion="";
									$contar_x=0;?>
									@foreach($movimiento->movimiento->usuario as $x)
										@if($x->pivot->porcentaje == 0)
											@if($contar_x>0)
											<br><br>
											@endif
											<strong>Venta realizada por: </strong>{{$x->name}} {{$x->lastname}}
											@if($movimiento->movimiento->comision)
											<br>
											{{number_format($movimiento->movimiento->comision * $movimiento->movimiento->cantidad, 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}}
											@else
											<br><br><strong style='color: red;'>FALTA COLOCARLE LA COMISIÓN POR VENDER</strong>
											@endif
											<br><br>
										@else
											<strong>Dueño:</strong> ({{$x->name}} {{$x->lastname}}) | {{number_format((($x->pivot->porcentaje / 100) *  $movimiento->movimiento->price) - ($movimiento->movimiento->comision * ($x->pivot->porcentaje / 100) ), 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}} ({{$x->pivot->porcentaje}}%)
											<br><br>

											@if($x->pivot->permiso == 1)
												@if(starts_with($movimiento->movimiento->description, 'Venta Realizada'))
													<br><br>Puedes modificar la comisión
													@if($x->id == Auth::id() || auth()->user()->level >= 10)
														<form class="form-inline" action="guardar_comision" method="POST"> 
														{{csrf_field()}} 
															<input type="text" name="colocada_por" value='{{$x->id}}' hidden=""> 
															<input type="text" name="id_movimiento" value='{{$movimiento->movimiento->id}}' hidden=""> 
															<input type="text" class="form-control form-control-sm mt-2" placeholder="Agregar comisión" name="comision" autocomplete="off"> 
															<button class="btn mt-2">Generar comisión por precio unitario</button> 
														</form>
														<br>
													@endif
												@endif
											@endif
										@endif
										<?php $contar_x++;?>
									@endforeach			
									<br><strong>Total: </strong>{{number_format($movimiento->movimiento->price * $movimiento->movimiento->cantidad, 0, ',', '.')." ".$movimiento->movimiento->moneda->sign}}		


								</td>

								<?php $articulo="";?>
								<td>
								@if(starts_with($movimiento->movimiento->description, 'Venta Realizada'))
									@foreach($movimiento->movimiento->venta as $movimiento->movimiento->venta)
										<strong>Artículo: </strong>{{$movimiento->movimiento->venta->articulo->name}}
										<br>
										<strong>Cantidad: </strong>{{$movimiento->movimiento->cantidad}}
										<br><br>
										<strong>Categoría: </strong>{{$movimiento->movimiento->venta->articulo->pertenece_category->category}}
										<br><br>
										{{$movimiento->movimiento->venta->articulo->email}} | {{$movimiento->movimiento->venta->articulo->nickname}} @if(Auth::user()->level >= 7)| {{$movimiento->movimiento->venta->articulo->password}} @endif
										<br><br>
										<strong>Cliente: </strong>{{$movimiento->movimiento->venta->cliente->name}} {{$movimiento->movimiento->venta->cliente->lastname}}
										<br>
										<br>


										
										<br><br>
										<strong>Precio del dolar del día: </strong>{{number_format($movimiento->movimiento->dolardia, 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}}
										<br><br>
										<strong>Precio de venta unitario: </strong>{{number_format($movimiento->movimiento->price/$movimiento->movimiento->cantidad, 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}}
										<br><br>
										<strong>Precio de venta unitario ($): </strong> {{ number_format($movimiento->movimiento->price/($movimiento->movimiento->cantidad*$movimiento->movimiento->moneda->valor), 2, ',', '.') }} $
										<br><br>
										<br>

										<b>Costo inversion:</b> {{ $movimiento->movimiento->inversion  }} $
										<br>
										<br>
										<b>Ganancia neta:</b> {{ number_format(($movimiento->movimiento->price / $movimiento->movimiento->moneda->valor) - ($movimiento->movimiento->inversion * $movimiento->movimiento->cantidad), 2, ',', '.') }} $

										<?php
											/*
											$ganancian = ($movimiento->movimiento->price/$movimiento->movimiento->dolardia) - ($movimiento->movimiento->venta->articulo->costo * ($movimiento->movimiento->price/$movimiento->movimiento->dolardia)/($movimiento->movimiento->venta->articulo->price_in_dolar));
											echo number_format($ganancian*$movimiento->movimiento->dolardia, 0, ',', '.')." ".$movimiento->movimiento->moneda->sign;
											*/
										?> 
										<?php break;?>
									@endforeach
								@else
									NO APLICA
								@endif
								</td>	
								<td>
								{{$movimiento->created_at}}
								<br><br>
								{{$movimiento->created_at->diffForHumans()}}
								</td>
								<td>
								<button type="button" class="btn btn-danger text-center" data-toggle="modal" data-target=".bd-example-modal-lg3" Onclick="mandaridM('{{$movimiento->movimiento->id}}');"><i class="fa fa-trash" aria-hidden="true"></i></button>
								</td>

								@endif
							</tr>
							@endforeach
							</tbody>								
						</table>
					</div>
					@if ($movimientos->hasPages())
				<ul class="pagination justify-content-center">
					{{-- Previous Page Link --}}
					@if ($movimientos->onFirstPage())
						<li class="page-item disabled"><span class="page-link"><</span></li>
					@else
						<li class="page-item"><a class="page-link" href="{{ $movimientos->previousPageUrl() }}" rel="prev"><</a></li>
					@endif

					@if($movimientos->currentPage() > 3)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $movimientos->url(1) }}">1</a></li>
					@endif
					@if($movimientos->currentPage() > 4)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@foreach(range(1, $movimientos->lastPage()) as $i)
						@if($i >= $movimientos->currentPage() - 2 && $i <= $movimientos->currentPage() + 2)
							@if ($i == $movimientos->currentPage())
								<li class="page-item active"><span class="page-link">{{ $i }}</span></li>
							@else
								<li class="page-item"><a class="page-link" href="{{ $movimientos->url($i) }}">{{ $i }}</a></li>
							@endif
						@endif
					@endforeach
					@if($movimientos->currentPage() < $movimientos->lastPage() - 3)
						<li class="page-item"><span class="page-link">...</span></li>
					@endif
					@if($movimientos->currentPage() < $movimientos->lastPage() - 2)
						<li class="page-item hidden-xs"><a class="page-link" href="{{ $movimientos->url($movimientos->lastPage()) }}">{{ $movimientos->lastPage() }}</a></li>
					@endif

					{{-- Next Page Link --}}
					@if ($movimientos->hasMorePages())
						<li class="page-item"><a class="page-link" href="{{ $movimientos->nextPageUrl() }}" rel="next">></a></li>
					@else
						<li class="page-item disabled"><span class="page-link">></span></li>
					@endif
				</ul>
			@endif
				</div>
			</div>
		</div>

		<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModal" aria-hidden="true">
			<div class="modal-dialog modal-lg3">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Debe ingresar la clave autorizada para eliminar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="row">
					</div>
					<div class="container">
						<form action="">
							<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
							<input readonly="" id="id_eliminar" value="" type="text" hidden="">

							<div class="form-group">
								<label for="">CLAVE</label>
								<input type="password" name="clave" id="clave" class="form-control">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" id="" value=" " Onclick='Eliminar_mov2();'>Eliminar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</main>

	<style type="text/css">
		td:nth-child(2){
			width: 220px;
		}
	</style>

@endsection

@section("scripts")

	<script>
		form=document.getElementById("excelFiltr");
		function askForExcel() {
				form.action="{{route("exportar_movimientos")}}";
				form.submit();
		}
		function askForSubmit() {
				form.action="{{route("filtrar_movimientos_bums")}}";
				form.submit();
		}
		function askForDavid() {
			form.action="{{route("filtrar_movimientos_bums_david")}}";
			form.submit();
		}
		
	</script>
@endsection