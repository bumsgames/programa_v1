@extends('webuser.user.adminpaneluser')

@section('contenido_cliente')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Configuracion de tu cuenta.</h1>
            </div>
        </div>
        {{ csrf_field() }}

        <div class="row">
            <div class="col-12">
                
                @if(Session::has('flash_message'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('flash_message')}}
                    </div>
                @endif
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('flash_message_success')}}
                    </div>
                @endif
                {!!$errors->first('nickname','<span style="color:red" class="help-block">:message</span>')!!}
                {!!$errors->first('email','<span class="help-block" style="color:red;">:message</span>')!!}
                {!!$errors->first('password','<span class="help-block" style="color:red;">:message</span>')!!}
            
            </div>
        </div>

        <div class="row">
            
            <div class="col-12">

                <form method="post" action="{{ url('/update_client') }}">
                    {{ csrf_field() }}    

                    <br>

                    <input type="text" name="id"  value="{{ $user->id }}" hidden>

                    <div class="row">
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="my-input">Nombre</label>
                                <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Auth::guard('client')->user()->name }}" 
                                placeholder="Nombre de usuario" required>
                            </div> 
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="my-input">Apellido</label>
                                <input type="text" class="form-control" name="lastname" autocomplete="off" value="{{ Auth::guard('client')->user()->lastname }}" 
                                placeholder="Nombre de usuario" required>
                            </div> 
                        </div>

                        

                        <div class="col-4">
                            <div class="form-group">
                                <label for="my-input">Nickname</label>
                                <input type="text" class="form-control" name="nickname" autocomplete="off" value="{{ Auth::guard('client')->user()->nickname }}" 
                                placeholder="Nombre de usuario" required>
                            </div> 
                        </div>
                          
                        <div class="col-6">
                            <div class="form-group">
                                <label for="my-input">Email</label>
                                <input type="text" class="form-control" name="email" autocomplete="off" value="{{ Auth::guard('client')->user()->email }}" 
                                placeholder="Dirección de Email" required disabled>
                            </div>  
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="my-input">Cedula</label>
                                <input type="number" class="form-control" name="documento_identidad" autocomplete="off" 
                                value="{{Auth::guard('client')->user()->documento_identidad }}" placeholder="Numero de Cédula" required 
                                @if (isset($user->documento_identidad))
                                    disabled
                                @endif>
                            </div> 
                        </div>


                        <div class="col-6">
                            <h1>Confirme Clave</h1>
                
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Contraseña" required>
                            </div>
                        </div>
                        

                    </div>

                    <div class="row mt-4">
                        
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary btnLogin mb-5 col-3" type="submit">Actualizar datos</button>
                        </div>

                    </div>
                    

                </form>

                

            </div>
        </div>
        
    </main>

@endsection
    