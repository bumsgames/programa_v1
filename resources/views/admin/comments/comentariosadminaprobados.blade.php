@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Comentarios Aprobados</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">

				<div class="tile-body"><div id="select" class="panel-body">
				<strong>Comentarios aprobados totales: </strong>{{ $comentarios_cantidad }}
				@include('admin.misc.pagination', ['paginator' => $comentarios])

				<table class="table table-responsive">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<br>
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Id del usuario</th>
							<th scope="col">Nombre del usuario</th>
                            <th scope="col">Comentario</th>
                            <th scope="col">Fecha comentado</th>
							<th scope="col">Fecha aprobado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						@foreach($comentarios as $comentario)
						<tr>

							<th scope="row"><?php echo $comentario->id ?></th>

							<td>
								<?php echo $comentario->id_comentario?>
							</td>
							<td>
                                <?php echo $comentario->nombre?>
							</td>
							<td>
                                <?php echo $comentario->texto?>
                            </td>
                            <td>
                                <?php echo $comentario->fecha_comentado?>
                            </td>
                            <td>
                                <?php echo $comentario->fecha_aprobado?>
							</td>
							<td>
									<a class="btn btn-warning" href="/comentario/rechazar/{{$comentario->id}}">Rechazar</a>
									<a class="btn btn-danger" href="/comentario/eliminar/{{$comentario->id}}">Eliminar</a>

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@include('admin.misc.pagination', ['paginator' => $comentarios])
			</div> </div>
				
				<br>
				<br>
				
			</div>
			<br>
			


		</div>

	</div>
</div>
</main>
<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

@endsection