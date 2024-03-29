@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> {{ $title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
                <div class="tile">
                        <h6>Numero de articulos: {{ $articles_cantidad }}</h6>

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre del Articulo</th>
                        <th>Categoria del Articulo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td scope="row">{{$article->id}}</td>
                        <td>{{$article->name}}</td>
                        <td>{{$article->pertenece_category->category}}</td>
                        <td>
                            <form action="/actualizarPeso/{{$article->id}}" method="post">
                                <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
                                <div class="form-group">
                                    <label for=""><strong>Peso del juego (Gb)</strong></label>
                                    <div class="input-group">
                                        <input min="0" value="0" type="number" autocomplete="off" class="form-control" name="peso" id="peso">                                            
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Actualizar Peso</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center"><strong><h5>No hay productos sin Peso</h5></strong></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
                </div>
	    </div>
    </div>
</main>

@endsection