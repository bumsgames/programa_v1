@extends('layouts.plantillaWeb')

@section('content')

<br>
<center>
    <div class="col-12 col-lg-4">
        <div class="container-login">
            {{ csrf_field() }}
            <div class="loginContainer">
                <img class="img_login" src="{{url('img/log3.png')}}" width="400" />  
                
                <form method="post" action="{{ url('/register') }}">
                    {{ csrf_field() }}    

                    {!!$errors->first('nickname','<span style="color:white" class="help-block">:message</span>')!!}

                    <br>

                    <div class="form-group">
                        <input type="text" class="form-control loginUser" name="nickname" autocomplete="off" value="{{ old('nickname') }}" placeholder="Nombre de usuario" required>
                    </div>   
                    
                    {!!$errors->first('email','<span class="help-block" style="color:red;">:message</span>')!!}

                    <div class="form-group">
                        <input type="text" class="form-control loginUser" name="email" autocomplete="off" value="{{ old('email') }}" 
                        placeholder="Dirección de Email" required>
                    </div>  

                    <div class="form-group">
                        <input type="number" class="form-control loginUser" name="documento_identidad" autocomplete="off" 
                        value="{{ old('documento_identidad') }}" placeholder="Numero de Cédula" required>
                    </div> 

                    {!!$errors->first('password','<span class="help-block" style="color:red;">:message</span>')!!}
                    
                    <div class="form-group">
                        <input type="password" class="form-control loginUser" name="password" autocomplete="off" placeholder="Contraseña" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" class="form-control loginUser" name="password_confirmation" autocomplete="off" placeholder="Confirme Contraseña" required>
                    </div>
                    
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block text-danger" role="alert">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif

                    <div class="col">
                        {!! NoCaptcha::display() !!}
                    </div>
                    
                    
                    {{-- 
                    <div class="form-group">
                        <label class="remember"><input type="checkbox" name="keepload"> Mantener Sesion Iniciada</label>
                    </div> --}}


                    <button class="btn btn-primary btnLogin mt-5" type="submit">Registrarse</button>

                    </form>
                    <br>
                    <br>
                    {{-- <a class="forgot" href="#" data-toggle="modal" data-target="#modelId">¿Olvidaste tu contraseña?</a> --}}
                    <hr>
                    <br>
                    
                    <div class="col">
                        <button class="btn btn-primary btnregistrar" data-toggle="modal" data-target="#sirveReg">
                            ¿Para que sirve estar registrado?
                        </button>
                    <a class="btn btn-primary btnregistrar" href="{{ url('/login')}}" >
                        Inicia Sesión
                    </a>
                </div>

            </div>
        
        </div>
    </div>


</center>


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                    <div class="modal-body">
                        <h5><strong>Si has olvidado tu contraseña ponte en contacto con un agente de BumsGames e indicale tu situación.</strong></h5>
                    </div>
                </div>
        </div>
    </div>

    <style>
        
        iframe{
            width:550px !important;
            height:150px !important;
        }

    </style>
@endsection


