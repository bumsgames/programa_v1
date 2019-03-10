@extends('layouts.plantillaWeb')

@section('content')

<div class="offset-4 col-4">
		<div class="container">
        <br>
        <br>
			<center>
            

				<form method="post" action="{{ url('/login') }}">
					{{ csrf_field() }}
                    <div class="loginContainer">
                        <img src="{{url('img/logobums2.png')}}"/>
                        <br>
                        <br>                       
                        {!!$errors->first('nickname','<span style="color:white" class="help-block">:message</span>')!!}
 <br>                   <h5 class="titulo-ayuda">Login</h5>

                        <br>
                        <div class="form-group">
                            <input type="text" class="form-control loginUser" name="nickname" autocomplete="off" value="{{ old('nickname') }}" placeholder="Nombre de usuario">
                        </div>                       
                         {!!$errors->first('password','<span class="help-block">:message</span>')!!}
                       
                        <div class="form-group">
                            <input type="password" class="form-control loginUser" name="password" autocomplete="off" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <label class="remember"><input type="checkbox" name="keepload"> Mantener Sesion Iniciada</label>

                        </div>
                        <button class="btn btn-primary btnLogin" type="submit">Iniciar Sesion</button>
                        <br>
                        <br>
                        <a class="forgot" href="#">¿Olvidaste tu contraseña?</a>
                    </div>
				</form>
			</center>
            <br>
        <br>
		</div>
	</div>

@endsection


