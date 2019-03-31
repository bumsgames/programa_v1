@extends('layouts.plantillaWeb')

@section('content')

<div class="offset-4 col-4">
		<div class="container">
        <br>
        <br>
			<center>
            

				<form class="container-login" method="post" action="{{ url('/login') }}">
					{{ csrf_field() }}
                    <div class="loginContainer">
                        <img src="{{url('img/logobums2.png')}}"/>
                        <br>
                        <br>                       
                        {!!$errors->first('nickname','<span style="color:white" class="help-block">:message</span>')!!}
                        <br>                   
                        <h5 class="titulo-ayuda">Login</h5>

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
                        <a class="forgot" href="#" data-toggle="modal" data-target="#modelId">¿Olvidaste tu contraseña?</a>
                    </div>
				</form>
			</center>
            <br>
        <br>
		</div>
	</div>


    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <a href="#" data-dismiss="modal">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5><strong>Si has olvidado tu contraseña ponte en contacto con un agente de BumsGames e indicale tu situación</strong></h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection


