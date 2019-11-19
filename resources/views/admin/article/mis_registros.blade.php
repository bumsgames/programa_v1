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
                            <td>Imagen(es)</td>
                            <th>Nombre del Articulo</th>
                            <th>Ubicacion</th>
                            <th>Dueño</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr>
                            <td scope="row">
                                ID: {{$article->id}}
                                <br>    
                                <br>    
                                Crador: {{ $article->pertenece_id_creator->name }} {{ $article->pertenece_id_creator->lastname }}
                            </td>
                             <td>
                                 @foreach ( $article->images as $image)
                                     <img src="{{ url('img/'.$image->file) }}" height="50">
                                     <br>   
                                 @endforeach
                             </td>
                            <td>{{ $article->name }}
                                <br>   
                                <br>    
                                @foreach ($article->categorias   as $categoria)
                                    {{ $categoria->category }}
                                    <br>    
                                @endforeach
                                <br>      
                            Cantidad: {{ $article->quantity }}
                        </td>
                            <td>
                                {{ $article->ubicaciones->nombre_ubicacion }}
                            </td>
                            <td>    
                                 @foreach($article->duennos->sortBy('porcentaje') as $duenno)
                                    <strong>
                                        Dueño:
                                    </strong>
                                    <br>
                                    <div class="dufiltrar">{{ $duenno->name }} {{ $duenno->lastname }}</div>
                                    <br>
                                    <strong>
                                        Acciones:
                                    </strong>
                                    <br>
                                    {{ $duenno->pivot->porcentaje }} %


                                    <br>    
                                    <br>    
                                    @endforeach  
                            </td>
                            <td>    
<div class="btn-group" role="group" aria-label="Basic example">

                                        @if(Auth::user()->level >= 7)

                                        

                                        <form action="/buscar_articulo" method="post" target="_blank">
                                            <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
                                            <input autocomplete="off" type="text" hidden="" value="{{ $article->id }}" name="id_art">
                                            <button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="" value="" Onclick="">Modificar</button>
                                        </form>

                                        @endif
                                        
                                        <button type="submit" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg3" 
                                        Onclick="mandaridM({{$article->id}})">
                                            Eliminar
                                        </button>
                                </div>
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