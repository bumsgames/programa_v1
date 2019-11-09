@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> {{$title}} </h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				@include('form_busqueda_venta')
				<strong>Total de ventas:</strong> {{$sales->count()}}
				<div class="table-responsive">
					<table id="table-list" class="table table-bordered display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Vendedor</th>
								<th scope="col">Artículo</th>
								<th scope="col">Información de Venta</th>
								<th scope="col">Fecha</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection

@section("scripts")
    <script>
        $(document).ready(function() {
            $('#table-list').DataTable( {
                "ajax": '{{route("obtener_ventas")}}',
                "columnDefs": [{ "orderable": false, }],
                "iDisplayLength": 10,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ ventas",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando de _START_ a _END_ ventas de un total de _TOTAL_",
                    "sInfoEmpty":      "No se ha registrado ninguna venta",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ ventas)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
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