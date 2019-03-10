<div class="tile-body" style="overflow-wrap: break-word;">
	<div class="row">
		<div class="col-12 col-lg-3">
			<div class="list-group" id="list-tab" role="tablist">
				<?php $count=0?>
				@foreach($tutoriales as $tuto)
				<a class="list-group-item list-group-item-action <?php if(++$count == 1) echo 'active';?>" id="list-home-list" data-toggle="list" href="#list-{{$tuto->id}}" role="tab" aria-controls="home">{{$tuto->titulo}}</a>
				@endforeach

				<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Entrega personalizada</a>
				<a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-input" role="tab" aria-controls="home">Agregar Tutorial</a>
			</div>
			<br>
		</div>
		
		<div class="col">
			<div class="tab-content letraNegra" id="nav-tabContent">
			<?php $count=0?>

				@foreach($tutoriales as $tuto)
					<div class="tab-pane fade  <?php if(++$count == 1) echo 'show active';?>" id="list-{{$tuto->id}}" role="tabpanel" aria-labelledby="list-{{$tuto->id}}">
						<?php echo $tuto->texto; ?>
						<br><br>
						<div style="float:right">
							<a href="/tutorial/editar/{{$tuto->id}}" class="btn btn-secondary">Editar Tutorial</a>
							<button type="button" 
											class="btn btn-danger" 
											data-toggle="modal" data-target=".bd-example-modal-lg"	
											value="{{ $tuto->id }} "
											Onclick='borrar_tutorial_modal({{ $tuto->id }})'>
											Elminar tutorial
										</button>	
						</div>
				</div>
				@endforeach

				<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
					<div class="container">	
						<label for="">ID del Articulo</label>
						<input class="form-control form-control-sm" type="text" class="" id="entega_idArticulo">
						<br>	

						<label for="">Nombre del cliente</label>
						<input class="form-control form-control-sm" type="text" class=""  id="entega_nombreCliente">

						<label for="">Apellido del cliente</label>
						<input class="form-control form-control-sm" type="text" class="" id="entega_apellidoCliente">
						<br>	
						<br>	
						<center>	
							<button class="btn btn-primary" id="btn-entrega">Realizar entrega</button>
						</center>
					</div>
				</div>
	
				<div class="tab-pane fade" id="list-input" role="tabpanel" aria-labelledby="list-input">
					<form class="form-group"  method="post" action="{{ url('/creartutorial') }}">
							{{ csrf_field() }}
							<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">

                            <div class="row">
                                <div class="col">
                                    <label for=tituloTutorialmodal><h4>Titulo del tutorial</h4></label>
                                    <input class="form-control" type="text" id="tituloTutorialmodal" name="tituloTutorialmodal" placeholder="Titulo del tutorial..." autocomplete="off">
                                </div>
                            </div>
							<br>
                            <label for=contenidoTutorialmodal><h4>Texto del tutorial</h4></label>

                            <textarea rows="20" id="contenidoTutorialmodal" class="form-control" name="contenidoTutorialmodal" placeholder="Contenido del tutorial..." autocomplete="off"></textarea >
							<br>
							<button id="botonagregartutorial" style="float:right" type="button" class="btn btn-primary">Crear Tutorial</button>
                            <br>
                        </form>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
</div>
