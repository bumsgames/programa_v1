@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i>Modificar Categorias </h1>
			<p>Aqui es donde comienza todo.</p>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				

				<form action="{{ url('categorias_mod') }}" method="POST">
					{{ csrf_field() }}
					

					Modificar categorias
					<hr>	

					<center><div class="row">
				
						<div  class="form-group col-12 ">
							<input type="text" value="{{ $categoria->id}}" name="id" hidden="" >
							<label> Nombre de la categoria </label>
							<input  value="{{ $categoria->category }}" autocomplete="off" type="text" class="form-control" name="category" >
						</div>
		               </div>
					<button class="btn btn-primary my-1 mr-sm-2" id="" type="submit">REGISTRAR</button></center>
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
