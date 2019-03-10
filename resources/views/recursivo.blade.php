@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Menu Usuario</h1>
      <p>Aqui es donde comienza todo.</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Menu Usuario</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">El orden domina el negocio</div>
        <div class="row"> 
          <div class="col"> 
            <?php $message=Session::get('message') ?>

            @if($message == 'store')
            <h1>Usuario creado exitosamente</h1>
            @endif
            <center>
              <br>
              <h2>Crear usuario nuevo</h2>
              <form enctype="multipart/form-data" files="true" action="/user" method="post">
                <input hidden="" name="_token" value="{{ csrf_token() }}">
                <div class="row"> 
                  <div class="col"> 
                    <div class="form-group">
                      <label for="">Nombre de usuario</label>
                      <input type="text" 
                      class="form-control" 
                      name="name"
                      autocomplete="nope">
                    </div>
                  </div>
                  <div class="col"> 
                    <div class="form-group">
                      <label for="">Apellido de usuario</label>
                      <input type="text" 
                      class="form-control" 
                      name="lastname"
                      autocomplete="nope">
                    </div>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="">Correo de usuario</label>
                  <input type="text" 
                  class="form-control" 
                  name="email"
                  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">Nickname de usuario</label>
                  <input type="text" 
                  class="form-control" 
                  name="nickname"
                  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">Nivel de usuario</label>
                  <input type="number" 
                  class="form-control " 
                  name="level"
                  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="image">Password de Usuario</label>
                  <input type="password" 
                  class="form-control" 
                  name="password"
                  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="image">Imagen de Usuario</label>
                  <input type="file" 
                  class="form-control-file" 
                  name="image"
                  autocomplete="off">
                </div>

                <br>
      <!-- <div class="form-group">
        <label for="">Password</label>
        <input type="text" class="form-control" name="tal">
      </div> -->
      <button class="btn btn-primary" type="submit">Guardar</button>
    </form>
  </center>
</div>
<div class="col"> 
  <br>  
  <center>
    <h2>Lista de Usuarios</h2>
  </center>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre y Apellido</th>
          <th scope="col">Nickname</th>
          <th scope="col">Botones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <th scope="row">1</th>
          <td>{{$user->name}} {{$user->lastname}}</td>
          <td>{{$user->nickname}}</td>
          <td>@mdo</td>
        </tr>
        @endforeach
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>
</div>

</div>
</div>

</main>

@endsection