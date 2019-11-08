@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1> Modificar Categoria</h1>
			<p>Aqui es donde comienza todo.</p>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				

				<form action="{{ url('modif_subCategorias') }}" method="POST">
					{{ csrf_field() }}					
	

					<center><div class="row">
						<div  class="form-group col-12 ">
							<input type="text" value="{{ $Subcategoria->id}}" name="id" hidden="" >
							<label>Nombre de la Sub categoria</label>
							<input  value="{{ $Subcategoria->nombre }}" autocomplete="off" type="text" class="form-control" name="nombre">
							<label>Descripcion del style</label>
							<input  value="{{ $Subcategoria->style }}" autocomplete="off" type="text" class="form-control" name="style">
						</div>

					</div>	
					<button class="btn btn-primary my-1 mr-sm-2" id="" type="submit">MODIFICAR</button></center>
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