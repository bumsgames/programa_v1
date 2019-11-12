@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Clientes </h1>
			<p>Aqui es donde comienza todo.</p>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				

				<form action="{{ url('modif_ubicacion') }}" method="POST">
					{{ csrf_field() }}
					

					UBICACION
					<hr>	

					<center><div class="row">
						<div  class="form-group col-12 ">
							<input type="text" value="{{ $ubicacion->id}}" name="id" hidden="" >
							<label>Nombre de la ubicacion</label>
							<input  value="{{ $ubicacion->nombre_ubicacion }}" autocomplete="off" type="text" class="form-control" name="nombre_ubicacion" >
						</div>

					</div>	
					<button class="btn btn-primary my-1 mr-sm-2" id="" type="submit" formtarget="_blank">MODIFICAR</button></center>
				</form>
				<hr>
				

				
			</div>
		</div>
	</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	
</script>

@endsection
