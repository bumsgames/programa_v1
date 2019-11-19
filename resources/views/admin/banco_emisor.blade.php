@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Bancos </h1>
			<p>Aqui es donde comienza todo.</p>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				

				<form action="{{ url('agg_bancoE') }}" method="POST">
					{{ csrf_field() }}

					Bancos
					<hr>	

					<center>
						<div class="row">
							<div  class="form-group col-6 ">
								<label>Nombre del banco</label>
								<input  value="" autocomplete="off" type="text" class="form-control" name="banco" required="">
							</div>
							<div  class="form-group col-6 ">
								<label>Relacionado con: </label>
								<select name="id_coin" class="form-control">
									@foreach($coins as $coin)
									<option style="color:black;" value="{{$coin->id}}">{{$coin->coin}} ({{$coin->sign}})</option>
									@endforeach

								</select>
							</div>

						</div>	

						<div class="row">
							<div  class="form-group col-6 ">
								<label>Titular:</label>
								<input autocomplete="off" type="text" class="form-control" name="titular" required="">
							</div>
							<div  class="form-group col-6 ">
								<label>Tipo de cuenta:</label>
								<input autocomplete="off" type="text" class="form-control" name="tipo_cuenta">
							</div>
						</div>

						<div class="row">
							<div  class="form-group col-4 ">
								<label>Cedula:</label>
								<input autocomplete="off" type="text" class="form-control" name="cedula">
							</div>
							<div  class="form-group col-4 ">
								<label>Cuenta Bancaria:</label>
								<input autocomplete="off" type="text" class="form-control" name="cuentaBancaria" required="">
							</div>
							<div  class="form-group col-4 ">
								<label>Nota:</label>
								<input autocomplete="off" type="text" class="form-control" name="nota">
							</div>
						</div>
						<button class="btn btn-primary my-1 mr-sm-2" id="" type="submit">REGISTRAR</button></center>
					</form>
					<hr>
					<h3>LISTA DE BANCOS</h3>
					<table class="table">


						@foreach ($bancosE as $bancos)

						<tr>
							<td>{{ $bancos->banco }} / {{ $bancos->titular }}  </td>
							<td>{{ $bancos->cuentaBancaria }} /  {{ $bancos->tipo_cuenta }} </td>
							<td>{{ $bancos->nota }}  </td>

							<td>
								<form action="{{ url('mod_bancos') }}" method="POST">
									{{ csrf_field() }}
									<button class="btn" name="modificar_id" value="{{ $bancos->id }}">Modificar</button>
								</form>
							</td>


							<td>
								<form action="{{ url('del_bancos') }}" method="POST">
									{{ csrf_field() }}
									<button class="btn btn-danger" name="eliminar_id" value="{{ $bancos->id }}">Eliminar</button> <br>
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
