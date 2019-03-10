@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-4 off-set-4"></div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">
				Acceso a la administracion
			</h1>
			<div class="panel-body">
				<form method="post" action="{{ url('/logueandose') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="email">
							Nickname
						</label>
						<input class="form-control" 
						type="text" 
						name="nickname" 
						placeholder="Ingresa tu nickname">
						{!!$errors->first('email','<span class="help-block">:message</span>')!!}
					</div>
					<div class="form-group">
						<label for="password">
							Clave
						</label>
						<input class="form-control" 
						type="password" 
						name="password" 
						placeholder="Ingresa tu password">
						{!!$errors->first('password','<span class="help-block">:message</span>')!!}
					</div>
					<button class="btn btn-primary btn-block">
						Acceder
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection