@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> inventario</h1>
		</div>
    </div>

    <div class="row">
		<div class="col-md-12">
			<div class="tile">

                <div class="row mb-5">
                    <div class="col">
                        @foreach ($ubicaciones as $ubicacion)
                            <button class="btn btn-primary" type="button" 
                            Onclick='activar_inventario("{{ $ubicacion->id }}")'>{{$ubicacion->nombre_ubicacion}}</button>
                        @endforeach
                    </div>
                </div>

                <div id="tableRioAro" style="display:none;" >

                    <h3 class="mb-3">Articulos en Rio Aro</h3>
                    <hr>
                    @foreach ($categories as $category)
                        @if (count($category->articles)>0)
                            <h5>{{$category->category}}</h5>

                            <div class="table-responsive" >
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cantidad</th> 
                                        </tr>
                                    </thead>
                                    
                                    <tbody >
                                        @foreach ($category->articles->where("ubicacion",1) as  $article)
                                            <tr>
                                                <td>
                                                    {{$article->name}}
                                                </td>

                                                <td>
                                                    {{$article->quantity}} 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach
                    
                </div>

                <div id="tableAltaVista" style="display:none;">
                    <h3 class="mb-3">Articulos en Alta Vista</h3>
                    <hr>
                    @foreach ($categories as $category)
                        @if (count($category->articles)>0)
                            
                            <h5>{{$category->category}}</h5>
                            <div class="table-responsive" >
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cantidad</th> 
                                        </tr>
                                    </thead>

                                    <tbody >
                                        @foreach ($category->articles->where("ubicacion",2) as  $article)
                                            <tr>
                                                <td>
                                                    {{$article->name}}
                                                </td>

                                                <td>
                                                    {{$article->quantity}} 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>


</main>


@endsection
