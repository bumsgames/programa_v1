@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

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
					<input type="text" id="movement" value="{{ $movement }}" hidden="">
					<!--<button type="button" class="btn btn-success" onclick="window.location.href='{{ $url }}'">Movimientos tipo Banco</button>
					<button type="button"
					class="btn btn-success"
					data-toggle="modal" 
					data-target=".registrar_movimiento"
					id="prueba" 
					>Crear nuevo movimiento</button>-->
					@include('modal.registrar_movimiento')
					<br>
					<br>

					<div class="table-responsive">
						<table id="table-list" class="table table-bordered display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Información</th>
									<th scope="col">Transacción</th>
									<th scope="col">Artículo</th>
									<th scope="col"># de operación</th>
									<th scope="col">Fecha</th>
									<th><i class="fa fa-trash" aria-hidden="true"></i></th>
								</tr>
							</thead>
						</table>
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

@include('modal.modificar_movimiento')

@endsection

@section("scripts")
    <script>
        $(document).ready(function() {
            $('#table-list').DataTable( {
                "ajax": '{{route("obtener_movimientos_personal")}}',
                "columnDefs": [{ "orderable": false, "targets": -1}],
                "iDisplayLength": 10,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ movimientos",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando de _START_ a _END_ movimientos de un total de _TOTAL_",
                    "sInfoEmpty":      "No se ha registrado ningún movimiento",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ movimientos)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     ">",
                        "sPrevious": "<"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            } );
        });
    </script>
@endsection