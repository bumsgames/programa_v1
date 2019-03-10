@extends('layouts/admin-layout')

@section('content')
<div class="container">
	<?php $message=Session::get('message') ?>

	@if($message == 'store')
	<h1>Usuario creado exitosamente</h1>
	@endif

	Usuarios registrados (Esto esta leyendo de la base de datos): 
	@foreach($users as $user)
	<br>
	{{$user->name}}
	@endforeach
	<center>
		<br>
		<h1>Formulario</h1>
		<form enctype="multipart/form-data" files="true" action="/user" method="post">
			<input hidden="" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label for="">Nombre de usuario</label>
				<input type="text" 
				class="form-control" 
				name="name">
			</div>
			<div class="form-group">
				<label for="">Apellido de usuario</label>
				<input type="text" 
				class="form-control" 
				name="lastname">
			</div>
			<div class="form-group">
				<label for="">Correo de usuario</label>
				<input type="text" 
				class="form-control" 
				name="email">
			</div>
			<div class="form-group">
				<label for="">Nickname de usuario</label>
				<input type="text" 
				class="form-control" 
				name="nickname">
			</div>
			<div class="form-group">
				<label for="">Nivel de usuario</label>
				<input type="text" 
				class="form-control	" 
				name="level">
			</div>
			<div class="form-group">
				<label for="image">Imagen de Usuario</label>
				<input type="file" 
				class="form-control-file" 
				name="image">
			</div>
			<div class="form-group">
				<label for="image">Password de Usuario</label>
				<input type="password" 
				class="form-control" 
				name="password">
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

@endsection