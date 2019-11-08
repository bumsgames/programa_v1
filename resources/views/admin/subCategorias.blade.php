@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Sub categorias </h1>
			<p>Aqui es donde comienza todo.</p>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				

				<form action="{{ url('agg_subCategorias') }}" method="POST">
					{{ csrf_field() }}
					
					<hr>	

					<center><div class="row">
						<div  class="form-group col-12 ">
							<label>Nombre de la Sub categoria</label>
							<input  value="" autocomplete="off" type="text" class="form-control" name="nombre">
							<label>Descripcion del style</label>
							<input  value="" autocomplete="off" type="text" class="form-control" name="style">
						</div>

					</div>	
					<button class="btn btn-primary my-1 mr-sm-2" id="" type="submit">REGISTRAR</button></center>
				</form>
				<hr>
				<h3>LISTA DE CATEGORIAS</h3>
				<table class="table">


					@foreach ($subCategoria as $categoria)

					<tr>
						<td>{{ $categoria->nombre }}  </td>
                        <td>{{ $categoria->style }}  </td>
						<td>
							<form action="{{ url('mod_subCategorias') }}" method="POST">
								{{ csrf_field() }}
								<button class="btn" name="modificar_id" value="{{ $categoria->id }}">Modificar</button>
							</form>
						</td>


						<td>
							<form action="{{ url('del_subCategorias') }}" method="POST">
								{{ csrf_field() }}
								<button class="btn btn-danger" name="eliminar_id" value="{{ $categoria->id }}">Eliminar</button> <br>
							</form>
						</td>

					</tr>

					@endforeach
				</table>

				

				
			</div>
		</div>
	</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	
</script>

@endsection
