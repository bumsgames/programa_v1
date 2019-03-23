@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')`
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i>Categoria de articulos</h1>
			<p>Llegamos para hacer la diferencia</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div style="overflow-x:scroll" class="row">
					<div class="col">
						<h4>Articulos disponibles</h4>
						<br>	
						@foreach($categories as $category)
						<h6>{{ $category->category }}</h6>
						<button class="btn btn-primary" onclick="location.href='{{ url('categoria_art/'.$category->id) }}';">{{ $category->category }}</button>
						<br>	
						<br>
						<br>
						{{-- <form action="allArticles_cat" method="POST" target="_blank">
							{{ csrf_field() }}
							<input type="" name="category" value="{{ $category->id }}" hidden="">
							<h6>{{ $category->category }}</h6>
							<button class="btn btn-primary" type="submit">{{ $category->category }}</button>
							<br>	
							<br>
							<br>
						</form> --}}
						@endforeach
					</div>
					<div class="col">
						<h4>Articulos Agotados</h4>
						<br>	
						@foreach($categories as $category)
						<h6>{{ $category->category }}</h6>
						<button class="btn btn-secondary" onclick="location.href='{{ url('categoria_artOff/'.$category->id) }}';">{{ $category->category }}</button>
						<br>	
						<br>
						<br>
						{{-- <form action="allArticles_catOff" method="POST" target="_blank">
							{{ csrf_field() }}
							<input type="" name="category" value="{{ $category->id }}" hidden="">
							<h6>{{ $category->category }}</h6>
							<button class="btn btn-secondary" type="submit">{{ $category->category }}</button>
							<br>	
							<br>
							<br>
						</form> --}}
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection