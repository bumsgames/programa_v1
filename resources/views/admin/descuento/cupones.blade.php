@extends('layouts.bums', ['tutoriales' => $tutoriales])


@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Todos los Cupones</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">

				<div class="tile-body"> </div>
                    <div class="table-responsive">
                        <br>
                        <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="/cupones/crear" class="btn btn-primary">
                            Agregar Nuevo Cupon
                            </a>
                    </div>
				<br>
				<br>
				
			</div>
			<br>
			<div id="select" class="panel-body">
				<strong>Cantidad total de cupones: </strong>{{ $cupones_cantidad }}
				@include('admin.misc.pagination', ['paginator' => $cupones])

				<table class="table table-responsive">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<br>
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Usuario creador</th>
							<th scope="col">Descuento</th>
                            <th scope="col">Disponibles</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nota de cupon</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						@foreach($cupones as $cupon)
						<tr>

							<th scope="row"><?php echo $cupon->id ?></th>

							<td>
								
								<?php echo $cupon->pertenece_fk_empleado->name.' '.$cupon->pertenece_fk_empleado->lastname?>
							</td> 
							<td>
                                <?php echo $cupon->descuento.' $';?>
							</td>
							<td>
                                <?php echo $cupon->disponible?>
                            </td>
                            <td>
                                <?php echo $cupon->codigo?>
                            </td>
                            <td>
                                <?php echo $cupon->nota_cupon?>
                            </td>
                            <td>
								<a href="/cupones/editar/{{$cupon->id}}" class="btn btn-primary">Editar cupon</a>
								<a href="/cupones/eliminar/{{$cupon->id}}" class="btn btn-danger">Eliminar cupon</a>

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@include('admin.misc.pagination', ['paginator' => $cupones])
			</div>


		</div>

	</div>
</div>
</main>
@include('modal.eliminar-imagen')
<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

@endsection