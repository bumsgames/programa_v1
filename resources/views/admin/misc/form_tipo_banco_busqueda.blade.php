<form action="movimientos_tipo_banco_filtro" method="post">
	<br>
	{{ csrf_field() }}
	<div class="form-row align-items-center">
		<div class="col-md-4">
			<label for="validationCustomUsername">Fecha de comienzo</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroupPrepend">Comienzo: </span>
				</div>
				<input type="date" class="form-control" name="fecha_inicio" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend">
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
				<input type="date" class="form-control" id="validationCustomUsername" name="fecha_final" placeholder="Username" aria-describedby="inputGroupPrepend">
				<div class="invalid-feedback">

				</div>
			</div>
		</div>
		<div class="col-md-4">
			<label for="validationCustomUsername">Usuario</label>
			<select class="form-control" name="id_usuario" id="">
				<option value="0">Todos los usuarios</option>
				@foreach($usuarios as $usuario)
				<option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
				@endforeach
			</select>

		</div>
	</div>	
	<br>	
	<center>
		<button class="btn btn-primary">Buscar</button>
	</center>
	<br>	

</form>