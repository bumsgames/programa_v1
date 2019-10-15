
<div class="container">	

	<div class="offset-4 col-4">
		<div class="container">
			<center>
				<div class="fondo-titulo-ayuda"><h1 class="titulo-ayuda">BUMS-Login</h1></div>


				<form method="post" action="{{ url('/logueo') }}">
					{{ csrf_field() }}
					<input type="text" class="form-control" name="nickname" autocomplete="off" value="{{ old('nickname') }}">
					<br>
					{!!$errors->first('nickname','<span class="help-block">:message</span>')!!}
					<br>
					<input type="password" class="form-control" name="password" autocomplete="off">
					<br>
					{!!$errors->first('password','<span class="help-block">:message</span>')!!}

					<br>	
					<button class="btn btn-primary" type="submit">LOGUEARSE</button>
				</form>
			</center>
		</div>
	</div>

