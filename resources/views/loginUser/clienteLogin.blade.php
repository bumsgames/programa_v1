@extends('layouts.plantillaWeb')

@section('content')

<br>
<center>
        <div class="col-12 col-lg-4">
            <div class="container-login">
                    {{ csrf_field() }}
                    <div class="loginContainer">
                    <img class="img_login" src="{{url('img/log3.png')}}" width="400" />  
                    <form method="post" action="{{ url('/login') }}">
                    {{ csrf_field() }}                
                        {!!$errors->first('nickname','<span style="color:white" class="help-block">:message</span>')!!}
 
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
                        </form>
                        <br>
                        <br>
                        <a class="forgot" href="#" data-toggle="modal" data-target="#modelId">¿Olvidaste tu contraseña?</a>
                        <br>
                        <br>
                        <br>
                        
                        <div class="col">
                            <button class="btn btn-primary btnbuscar" data-toggle="modal" data-target="#sirveReg">¿Para que sirve estar registrado?</button>
                        <button class="btn btn-primary btnregistrar" data-toggle="modal" data-target="#modalReg">Registrate</button>
                        </div>

                    </div>
            
        </div>
    </div>


</center>

{{-- <div class="row">
    <div class="col-4">
        fsdsdf
    </div>
    <div class="col-12 col-lg-4">
        <div class="container">
        <br>
        <br>
            <center>
                <div class="container-login">
                    {{ csrf_field() }}
                    <div class="loginContainer">
                    <img class="img_login" src="{{url('img/log3.png')}}" width="400" />  
                    <form method="post" action="{{ url('/login') }}">
                    {{ csrf_field() }}                
                        {!!$errors->first('nickname','<span style="color:white" class="help-block">:message</span>')!!}
 
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
                        </form>
                        <br>
                        <br>
                        <a class="forgot" href="#" data-toggle="modal" data-target="#modelId">¿Olvidaste tu contraseña?</a>
                        <br>
                        <br>
                        <br>
                        
                        <button class="btn btn-primary btnregistrar" data-toggle="modal" data-target="#modalReg">Registrate</button>

                    </div>
                </div>
            </center>
            <br>
        <br>
        </div>
    </div>
</div> --}}

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

    <div class="modal fade" id="modalReg" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                    <div class="modal-body">
                        <h5><b>Al tener una o mas compras hechas en Bumsga-<br>mes puede consultar a su agente de confianza,
                        el mismo le proporcionará los datos para iniciar se-<br>sion en nuestro sistema.</b></h5>
                    </div>
                </div>
        </div>
    </div>

    <div class="modal fade" id="sirveReg" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                    <div class="modal-body">
                        <h5><strong>Ayuda.</strong></h5>
                    </div>
                </div>
        </div>
    </div>
@endsection


