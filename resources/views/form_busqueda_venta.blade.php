<form action="{{route("filtrar_ventas")}}" method="post">
	Solo sirve para buscar ventas y el parametro es por la persona que hizo la venta.
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
				<input @if(isset($fecha_inicio)) value="{{$fecha_inicio}}" @endif type="date" class="form-control" name="fecha_inicio" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
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
				<input @if(isset($fecha_final)) value="{{$fecha_final}}" @endif type="date" class="form-control" id="validationCustomUsername" name="fecha_final" placeholder="Username" aria-describedby="inputGroupPrepend" required>
				<div class="invalid-feedback">

				</div>
			</div>
		</div>
		<div class="col-md-4">
			<label for="validationCustomUsername">Usuario</label>
			<select class="form-control" name="id_usuario" id="">
				<option @if(isset($id_usuario)) {{$id_usuario==0?"selected":""}} @endif value="0">Todos los usuarios</option>
				@foreach($usuarios as $usuario)
				<option @if(isset($id_usuario)) {{$id_usuario==$usuario->id?"selected":""}} @endif value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->lastname }}</option>
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