

<form action="{{ url('filtrar_ventas_v2') }}" method="POST">
	{{ csrf_field() }}
	VENTAS
	<hr>	
	<div class="row">
		<div  class="form-group col-12 col-lg-3">
			<label>Nombre de Cliente</label>
			<input id="filter_name" value="" autocomplete="off" type="text" class="form-control" name="nombre_cliente">
		</div>
		<div  class="form-group col-12 col-lg-3">
			<label>Apellido de Cliente</label>
			<input  value="" autocomplete="off" type="text" class="form-control" name="apellido_cliente">
		</div>
		<div  class="form-group col-12 col-lg-3">
			<label>Filtrar por Vendedor</label>
			<select class="form-control form-control-sm" name="select_vendedor">
				<option value="-1">CUALQUIERA</option>
				@foreach($select_usuarios as $usuario)
				<option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->lastname }}</option>
				@endforeach
			</select>
		</div>


		<div  class="form-group col-12 col-lg-3">
			<label>Filtrar por Involucrado en Venta</label>
			<select class="form-control form-control-sm" name="select_involucrado">
				<option value="-1">CUALQUIERA</option>
				@foreach($usuarios_sistema as $usuario)
				<option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->lastname }}</option>
				@endforeach
			</select>
		</div>

		<div  class="form-group col-12 col-lg-3">
			<label>Envio</label>
			<select class="form-control form-control-sm" name="select_envio">
				<option value="-1">CUALQUIERA</option>
				<option value="1">SI</option>
				<option value="0">NO</option>
			</select>
		</div>

		<div class="form-row align-items-center">
			<div class="col-md-6">
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
			<div class="col-md-6">
				<label for="validationCustomUsername">Fecha final</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroupPrepend">final: </span>
					</div>
					<input type="date" class="form-control" id="validationCustomUsername" name="fecha_final" placeholder="Username" aria-describedby="inputGroupPrepend">
					<div class="invalid-feedback">

					</div>
				</div>
			</div>

		</div>	

	</div>

	PAGO
	<hr>	
	<div class="row">
		<div  class="form-group col-12 col-lg-3">
			<label>Filtrar por Banco Emisor</label>
			<select class="form-control form-control-sm" name="select_banco">
				<option value="-1">CUALQUIERA</option>
				@foreach($bancos_emisores as $banco_emisor)
				<option value="{{ $banco_emisor->id }}">{{ $banco_emisor->banco }}</option>
				@endforeach
			</select>
		</div>

		<div  class="form-group col-12 col-lg-3">
			<label>Cobrado o No Cobrado</label>
			<select class="form-control form-control-sm" name="select_cobrado">
				<option value="-1">CUALQUIERA</option>
				<option value="1">Cobrado</option>
				<option value="0">NO Cobrado</option>
				
			</select>
		</div>

		<div  class="form-group col-12 col-lg-3">
			<label>Tipo de Moneda</label>
			<select class="form-control form-control-sm" name="select_moneda">
				<option value="-1">CUALQUIERA</option>
				@foreach($monedas as $moneda)
				<option value="{{ $moneda->id }}">{{ $moneda->coin }}</option>
				@endforeach
			</select>
		</div>

		<div  class="form-group col-12 col-lg-3">
			<label>Referencia</label>
			<input  value="" autocomplete="off" type="text" class="form-control" name="input_referencia">
		</div>

		<div  class="form-group col-12 col-lg-3">
			<label>Nota de Pago</label>
			<input  value="" autocomplete="off" type="text" class="form-control" name="input_notaPago">
		</div>
	</div>

	ARTICULO
	<hr>	
	<div class="row">
		<div  class="form-group col-12 col-lg-3">
			<label>Filtrar por Nombre del Articulo</label>
			<input  value="" autocomplete="off" type="text" class="form-control" name="nombre_articulo">
		</div>

		<div  class="form-group col-12 col-lg-3">
			<label>Correo del Juego</label>
			<input  value="" autocomplete="off" type="text" class="form-control" name="input_correo">
		</div>

		<div  class="form-group col-12 col-lg-3">
			<label>Filtrar por Categoria del Articulo</label>
			<select class="form-control form-control-sm" name="select_categoria">
				<option value="-1">CUALQUIERA</option>
				@foreach($categories as $categorie)
				<option value="{{ $categorie->id }}">{{ $categorie->category }}</option>
				@endforeach
			</select>
		</div>

		<div  class="form-group col-12 col-lg-3">
			<label>Filtrar por Ubicacion del Articulo</label>
			<select class="form-control form-control-sm" name="select_ubicacion">
				<option value="-1">CUALQUIERA</option>
				@foreach($ubicaciones as $ubicacion)
				<option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre_ubicacion }}</option>
				@endforeach
			</select>
		</div>
	</div>	
	<center><button class="btn btn-primary my-1 mr-sm-2" id="filtrar_ventas_v2" type="submit" formtarget="_blank">FILTRAR VENTAS</button></center>
</form>





