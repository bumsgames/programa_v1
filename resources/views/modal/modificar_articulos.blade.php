<div class="modal fade bd-example-modal-lg modificar_art" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col">
						
						<center>
						center>
					<br>
					<h1>Formulario</h1>
					<!-- 		enctype="multipart/form-data" files="true" action="/user" method="post" -->

					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<br>
					<br>
					<div class="row">

						<div class="col">
							<div class="form-group">
								<label for=""><strong>ID_USUARIO DEL USUARIO QUE CREA</strong></label>
								<input class="form-control form-control-sm" 
								type="text" 
								placeholder=""
								name="id_creator" 
								value="{{ isset(Auth::user()->id) ? Auth::user()->id : 'USUARIO NO LOGUEADO' }}"
								readonly 
								id="id_creator" 
								>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Dueño Primero</strong></label>
								<select class="form-control form-control-sm cd" name="primary_owner" id="primary_owner">
									@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
									@endforeach
								</select>
							</div>
							<button id="agregarDuenno">Agregar</button>
							<br><br>
							<div id="xxx">
								
							</div>
							<br>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Nombre del Articulo</strong></label>
								<input class="form-control form-control-sm" 
								type="text"
								name="name" 
								id="name" 
								placeholder=""
								autocomplete="off">

							</div>
							{!!$errors->first('name','<span class="help-block">:message</span>')!!}
							{!!$errors->first('nickname','<span class="help-block">:message</span>')!!}
						</div>
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Descripcion</strong></label>
								<input type="text" 
								class="form-control" 
								name="description"
								id="description"
								autocomplete="off">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Categoria</strong></label>
								<select 
								class="form-control form-control-sm" name="category" 
								id="category">
								<option value="0">Sin categoria</option>
								@foreach($categories as $category)
								<option value="{{$category->id}}">{{$category->category}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Precio en $</strong></label>
							<input class="form-control form-control-sm" 
							type="number"
							autocomplete="off" 
							name="price_in_dolar"
							id="price_in_dolar" 
							placeholder="">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Cantidad</strong></label>
							<input type="number"
							autocomplete="off"  
							class="form-control" 
							name="quantity"
							id="quantity">
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Correo</strong></label>
							<input class="form-control form-control-sm" 
							type="text" 
							name="email" 
							id="email" 
							placeholder=""
							autocomplete="off">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Password</strong></label>
							<input type="text" 
							class="form-control" 
							id="password" 
							name="password"
							autocomplete="off">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Nickname</strong></label>
							<input type="text" 
							class="form-control" 
							id="nickname" 
							name="nickname"
							autocomplete="off">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for=""><strong>Boton reseteo</strong></label>
							<input type="date" 
							class="form-control" 
							name="reset_button"
							id="reset_button"
							autocomplete="off">
						</div>
					</div>
					

				</div>
				<div class="row">	
					<div class="col">	
						<div class="col">
							<div class="form-group">
								<label for=""><strong>Nota del Articulo</strong></label>
								<textarea type="text" 
								class="form-control" 
								name="note"
								id="note"></textarea>
							</div>
						</div>
					</div>
					<div class="col">	
						<div class="form-group">
							<label for="image">
								<strong>
									<label for="image">Imagen de Articulo</label>
								</strong>
							</label>
							<div class="custom-file">
								<input name="image" id="inputFile1" type="file" class="custom-file-input" lang="es">
								<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
							</div>
							<img id="img1" width="175"><br/>
						</div>
					</div>
				</div>



				
				<hr>



				<br>
			<!-- <div class="form-group">
				<label for="">Password</label>
				<input type="text" class="form-control" name="tal">
			</div> -->
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button class="btn btn-primary" type="submit" id="guardar_articulo">Guardar</button>
			
		</center>


<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

<script src="/js/bums.js"></script>
