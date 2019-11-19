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
                @if ($errors->any())
                <br>
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
                <br>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre del Articulo</th>
                            <th>Categoria del Articulo</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse($articles as $article)
                        <tr>
                            <td scope="row">{{ $i++ }}</td>
                            <td>{{ $article->name }}</td>
                            <td>{{ $article->category }}</td>
                            <td>{{ $article->quantity }}</td>
                            {{--  <td>
                                <form action="/actualizarImagen/{{$article->id}}" method="post" enctype="multipart/form-data">
                                    <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">

                                    <div class="custom-file">
                                        <input name="image" id="inputFile2" type="file" class="custom-file-input" lang="es" required>
                                        <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                        <input hidden="" name="image" id="inputFiletext" type="text" class="custom-file-input" lang="es">
                                    </div>
                                    <button class="btn btn-primary mt-2 float-right" type="submit">Actualizar Imagen</button>
                                </form>
                                <div style="text-align:center;">
                                        <img id="img2" width="175">
                                    </div>
                            </td> --}}
                            <td>
                                <form action="/buscar_articulo" method="post" target="_blank">
                                                <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
                                                <input type="text" hidden="" value="{{ $article->id }}" name="id_art">
                                                <button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="" value="" Onclick="">Modificar</button>
                                            </form>
                                {{-- <button class="btn btn-info" type="button">Modificar</button> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center"><strong><h5>No se han encontrado productos con estas caracteristicas</h5></strong></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
	    </div>
    </div>
</main>

@endsection