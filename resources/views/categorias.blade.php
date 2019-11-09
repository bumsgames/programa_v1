@extends('layouts.plantillaWeb')

@section('content')
<br>
<br>
<style>
.btn-categorias{
	margin: 20px;
	padding: 10px !important;
}
</style>
<div class="container">
	<div class="tile">
		<h2>Categorias</h2>
		<hr>
		<div class="row">
			<div class="col-6">
				<div class="container">
					<h4>Especifica</h4>
					<hr>	
					@foreach($categorias as $categoria)
					<form action="articulos" method="POST">
						{{ csrf_field() }}
						<button type="submit" name="category" value="{{$categoria->id}}" class="btn btn-block btn-categorias">
							{{ $categoria->category }}
						</button>
					</form>
					@endforeach
				</div>
			</div>
			<div class="col-6">
				<div class="container">
					<h4>General</h4>
					<hr>
					<form id="category_Playstation3_form" action="categoria_general" method="post">	
						{{ csrf_field() }}
						<input name='categoria' value="PlayStation 3" hidden="">		
						<button class="btn btn-block">

							<a class="nav-link active" href="#" onclick="document.getElementById('category_Playstation3_form').submit();">PlayStation 3</a>
						</button>
					</form>
					<br>	
					<form id="category_Playstation4_form" action="categoria_general" method="post">	
						{{ csrf_field() }}
						<input name='categoria' value="PlayStation 4" hidden="">		
						<button class="btn btn-block">	
							<a class="nav-link active" href="#" onclick="document.getElementById('category_Playstation4_form').submit();">PlayStation 4</a>
						</button>
					</form>
					<br>	
					<form id="category_XboxOne_form" action="categoria_general" method="post">	
						{{ csrf_field() }}
						<input name='categoria' value="Xbox One" hidden="">		
						<button class="btn btn-block">	
							<a class="nav-link active" href="#" onclick="document.getElementById('category_XboxOne_form').submit();">Xbox One</a>
						</button>
					</form>
					<br>	
					<form id="category_Nintendo_form" action="categoria_general" method="post">	
						{{ csrf_field() }}
						<input name='categoria' value="Nintendo" hidden="">		
						<button class="btn btn-block">	
							<a class="nav-link active" href="#" onclick="document.getElementById('category_Nintendo_form').submit();">Nintendo</a>
						</button>
					</form>
					<br>
					<br>
					<div class="container">
					<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php $i = 0; ?>
							@foreach($portal1 as $imagen)
							@if($i == 0)
							<div class="carousel-item active">
								<img class="d-block w-100" height="400" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
							</div>
							@else
							<div class="carousel-item">
								<img class="d-block w-100" height="400" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
							</div>
							@endif
							<?php $i++; ?>

							@endforeach
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		<hr>
		
	</div>

</div>


@endsection