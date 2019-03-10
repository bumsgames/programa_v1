
@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
        <div class="row"> 
          <div class="col"> 
            @include('flash-message')
            <center>
              <br>
              <h2>Crear usuario nuevo</h2>
              <form enctype="multipart/form-data" files="true" action="/crear_usuario" method="post">
                <input hidden="" name="_token" value="{{ csrf_token() }}">
                <div class="row"> 
                  <div class="col"> 
                    <div class="form-group">
                      <label for="">Nombre de usuario</label>
                      <input type="text" 
                      class="form-control" 
                      name="name"
                      value="{{ old('name') }}" 
                      autocomplete="nope">
                    </div>
                  </div>
                  <div class="col"> 
                    <div class="form-group">
                      <label for="">Apellido de usuario</label>
                      <input type="text" 
                      class="form-control" 
                      name="lastname"
                      value="{{ old('lastname') }}" 
                      autocomplete="nope">
                    </div>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="">Correo de usuario</label>
                  <input type="text" 
                  class="form-control" 
                  name="email"
                  value="{{ old('email') }}" 
                  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">Nickname de usuario</label>
                  <input type="text" 
                  class="form-control" 
                  name="nickname"
                  value="{{ old('nickname') }}" 
                  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">Nivel de usuario</label>
                  <input type="number" 
                  class="form-control " 
                  name="level"
                  value="{{ old('level') }}" 
                  autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="image">Password de Usuario</label>
                  <input type="password" 
                  class="form-control" 
                  name="password"
                  value="{{ old('password') }}" 
                  autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="image">Imagen de Usuario</label>
                  <br>  
                  <br>  
                  
                  <div class="custom-file">
                    <input name="image" id="inputFile1" type="file" class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                  </div>
                  <br> 
                  <br>   
                  <img id="img1" width="175"><br/>

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
        <?php $i = 1; ?>
        @foreach($users as $user)
        <tr>
          <th scope="row"><?php echo $i; $i++; ?></th>
          <td>{{$user->name}} {{$user->lastname}}</td>
          <td>{{$user->nickname}}</td>
          <td><button type="button"
           class="btn btn-secondary"
           id="modificar_user"
           data-toggle="modal" data-target=".modificar_user"
           onclick="modificar_user({{$user->id}});">Modificar</button>
          <button type="button"
           class="btn btn-secondary"
           id=""
           data-toggle="modal" data-target=".bd-example-modal-lg3"
           onclick="mandarid({{$user->id}});">Eliminar</button>
         </td>
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

@include('modal.modificar_user')
@include('modal.eliminar_usuario')

@endsection