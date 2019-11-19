
@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

<script src="/js/bums.js"></script>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Menu Usuario</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Menu Usuario</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="container">
          <div class="row"> 
            <div class="col"> 
              @include('admin.misc.flash-message')
              <center>
                <br>
                <h2>Actualizar tu usuario</h2>
                  <input hidden="" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="text" name="id_usuario" id="id_usuario" class="form-control" value="{{ Auth::user()->id }}" hidden="">
                  <div class="row"> 
                    <div class="col"> 
                      <div class="form-group">
                        <label for="">Nombre de usuario</label>
                        <input type="text" 
                        class="form-control" 
                        name="name_modificar" id="name_modificar"
                        readonly="" 
                        value="{{ Auth::user()->name }}" 
                        autocomplete="nope">
                      </div>
                    </div>
                    <div class="col"> 
                      <div class="form-group">
                        <label for="">Apellido de usuario</label>
                        <input type="text" 
                        class="form-control" 
                        name="last_modificar" id="last_modificar"
                        readonly="" 
                        value="{{ Auth::user()->lastname }}" 
                        autocomplete="nope">
                      </div>
                    </div>
                    <div class="col">
                     <div class="form-group">
                      <label for="">Correo de usuario</label>
                      <input type="text" 
                      class="form-control" 
                      name="email_modificar" id="email_modificar" 
                      value="{{ Auth::user()->email }}" 
                      autocomplete="off">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="">Nickname de usuario</label>
                      <input type="text" 
                      class="form-control" 
                      name="nickname_modificar" id="nickname_modificar"
                      value="{{ Auth::user()->nickname }}" 
                      autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="">Teléfono</label>
                      <input type="text" pattern="^[0-9]+" id="telefonoMod" required
                      class="form-control" 
                      name="telefono"
                      value="{{ Auth::user()->telefono }}" 
                      autocomplete="off" required>
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <label for=""> <strong>¿Activo?</strong></label>
                      <select id="activeMod" class="form-control" name="active" required>
                        <option value="1" @if (Auth::user()->active==1)
                          selected
                        @endif >Si</option>
                        <option value="0" @if (Auth::user()->active==0)
                          selected
                        @endif>No</option>
                      </select>
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <label for="image">Password de Usuario</label>
                      <input type="password" 
                      class="form-control" 
                      name="password" id="password_modificar" 
                      value="{{ old('password') }}" 
                      autocomplete="off">
                    </div>
                  </div>

                </div>

                <div class="form-group">
                  <label for="image">Imagen de Usuario</label>
                  <br>  
                  <br>  

                  <div class="custom-file">
                    <input name="image" id="inputFile1" type="file" class="custom-file-input" lang="es">
                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                  </div>
                  <br> 
                  <br>   
                  <img id="img1" width="175" src="img/{{ Auth::user()->image }}"><br/>

                </div>

                <br>
      <!-- <div class="form-group">
        <label for="">Password</label>
        <input type="text" class="form-control" name="tal">
      </div> -->
      <button class="btn btn-primary" id="actualizar_uss2" type="submit">Guardar</button>
  </center>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
 $('#nickname_modificar').on('keypress',function(){
    $('#nickname_modificar').val($('#nickname_modificar').val().replace(/ /g, ''));
  });
  $('#nickname_modificar').change(function(){
    $('#nickname_modificar').val($('#nickname_modificar').val().replace(/ /g, ''));
  });
</script>
 
@endsection