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
				

				<form action="{{ url('modif_banco') }}" method="POST">
					{{ csrf_field() }}
					

					Modificar banco
					<hr>	

					<center>
						<div class="row">
							<div  class="form-group col-6 ">
								<input type="text" value="{{ $bancos->id}}" name="id" hidden="" >
								<label> Nombre del banco </label>
								<input  value="{{ $bancos->banco }}" autocomplete="off" type="text" class="form-control" name="banco" >
							</div>
							@if (isset($bancos->moneda))
							<div  class="form-group col-6 ">
								<label>Relacionado con: </label>
								<select name="id_coin" class="form-control">
									<option value="{{$bancos->id_coin}}">{{$bancos->moneda->coin}} ({{$bancos->moneda->sign}})</option>
									@foreach($coins_select as $coin)
									<option style="color:black;" value="{{$coin->id}}">{{$coin->coin}} ({{$coin->sign}})</option>
									@endforeach

								</select>
							</div>
							@else
							<div  class="form-group col-6 ">
								<label>Relacionado con: </label>
								<select name="id_coin" class="form-control">
									@foreach($coins as $coin)
									<option style="color:black;" value="{{$coin->id}}">{{$coin->coin}} ({{$coin->sign}})</option>
									@endforeach

								</select>
							</div>
							@endif
						</div>	

						<div class="row">
							<div  class="form-group col-6 ">
								<label>Titular:</label>
								<input autocomplete="off" type="text" class="form-control" name="titular"  value="{{ $bancos->titular }}">
							</div>
							<div  class="form-group col-6 ">
								<label>Tipo de cuenta:</label>
								<input autocomplete="off" type="text" class="form-control" name="tipo_cuenta"  value="{{ $bancos->tipo_cuenta }}">
							</div>
						</div>

						<div class="row">
							<div  class="form-group col-4 ">
								<label>Cedula:</label>
								<input autocomplete="off" type="text" class="form-control" name="cedula"
								value="{{ $bancos->cedula }}">
							</div>
							<div  class="form-group col-4 ">
								<label>Cuenta Bancaria:</label>
								<input autocomplete="off" type="text" class="form-control" name="cuentaBancaria"
								value="{{ $bancos->cuentaBancaria }}"">
							</div>
							<div  class="form-group col-4 ">
								<label>Nota:</label>
								<input autocomplete="off" type="text" class="form-control" name="nota"
								value="{{ $bancos->nota }}">
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
