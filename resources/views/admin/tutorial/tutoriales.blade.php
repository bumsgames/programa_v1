@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Todos los Tutoriales</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">

			<br>
			<div id="select" class="panel-body">
				<strong>Cantidad total de tutoriales: </strong>{{ $cantidad_tutoriales }}
				@include('admin.misc.pagination', ['paginator' => $tutoriales])

					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<br>
					<div id="accordion">						
					<?php $count=0;?>
						@foreach($tutoriales as $tutorial)
						<?php $count++;?>
						<div class="card">
							<div class="card-header">
								<a  class="card-link" data-toggle="collapse" href="#collapse{{$count}}">
									<h4>Id: {{$tutorial->id}} - {{$tutorial->titulo}}</h4>
								</a>
	
							</div>
							<div id="collapse{{$count}}" class="collapse" data-parent="#accordion">
								<div class="card-body">
									<?php echo $tutorial->texto;?>
								</div>
								@if(Auth::user()->level >= 10)

								<a style="width:49%" href="/tutorial/editar/{{$tutorial->id}}" class="btn btn-primary">Editar Tutorial</a>
								<a style="width:49%; float:right" href="/tutorial/eliminar/{{$tutorial->id}}" class="btn btn-danger">Eliminar Tutorial</a>
								@endif
							</div>	
						</div>
					
						@endforeach
						
					</div>

				@include('admin.misc.pagination', ['paginator' => $tutoriales])
			</div>


		</div>

	</div>
</div>
</main>

<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

@endsection