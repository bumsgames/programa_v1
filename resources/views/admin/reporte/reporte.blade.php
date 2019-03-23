@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Generar reporte</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">

				<div class="tile-body"> </div>
				<form class="row" action="guardar_reporte" method="post">
					{{ csrf_field() }}
					
					<div class="form-group col-md-2">
						<label for=""><strong>Tipo de reporte</strong></label>
						<select class="form-control form-control-sm		" name="type_reporte" id="">
							<option value="Idea">	Idea</option>
							<option value="Pregunta">Pregunta</option>
							<option value="Reporte">Reporte</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label"><strong>	Titulo</strong></label>
						<input autocomplete="off" class="form-control form-control-sm" name="titulo_reporte" type="text">
					</div>
					<div class="form-group col-md-4">
						<label class="control-label"><strong>	Descripcion</strong></label>
						<textarea autocomplete="off" class="form-control" name="descripcion_reporte" id="" cols="30" rows="2">
						</textarea>
					</div>
					<div class="form-group col-md-3">
						<br>	
						<button class="btn btn-primary btn-block">Generar reporte</button>
					</div>

					
					
				</form>
				<hr>	
				<div class="row">
					@foreach($reportes as $reporte)
					<div class="col-md-6">
						<div class="tile">
							<p>{{ $reporte->created_at->diffForHumans() }}</p>
							@if(isset( $reporte->creadorF->name))
							<p>Por: {{ $reporte->creadorF->name }} {{ $reporte->creadorF->lastname }}</p>
							@endif
							
							<h3 class="tile-title">{{ $reporte->titulo_reporte }}</h3>
							
							<div class="tile-body">{{ $reporte->descripcion_reporte }}</div>
							@if(auth()->user()->level >= 7)
							<div class="tile-footer"> <button class="btn btn-primary" data-toggle="modal" data-target=".eliminar-report" Onclick="mandaridM({{$reporte->id}});">
								<i class="fa fa-fw fa-lg fa-check-circle"></i>
							Solucionado</button></div>
							@endif


							<p style="float: right;">
								<strong>Tipo: </strong>
								{{ $reporte->type_reporte }}
							</p>
						</div>
					</div>
					<br>	
					<br>	
					<br>	
					@endforeach	
					
				</div>
				<br>
			</div>
		</div>
		@include('modal.eliminar-reporte')
	</main>
	@endsection