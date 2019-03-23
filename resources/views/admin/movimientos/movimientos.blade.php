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
						Solo sirve para exportar a <b>Excel</b> los movimientos de los usuarios.
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
									<input type="date" class="form-control" name="fecha_inicio" id="fechainicio" placeholder="Username" aria-describedby="inputGroupPrepend" required>
									<div class="invalid-feedback">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label for="validationCustomUsername">Fecha final</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroupPrepend">Final: </span>
									</div>
									<input type="date" class="form-control" id="fechafinal" name="fecha_final" placeholder="Username" aria-describedby="inputGroupPrepend" required>
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
						<button value="excel" name="excel" onclick="askForExcel()" class="btn btn-primary">Exportar</button>
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
						</table>
					</div>

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
        $(document).ready(function() {

            $('#table-list').DataTable( {
                "ajax": '{{route("obtener_movimientos",["movement"=>$movement])}}',
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