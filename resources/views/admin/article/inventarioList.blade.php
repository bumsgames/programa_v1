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
                            <button class="btn btn-primary" type="button">{{$ubicacion->nombre_ubicacion}}</button>
                        @endforeach
                    </div>
                </div>


                @foreach ($categories as $category)
                    @if (count($category->articles)>0)
                        
                    
                        <h3>{{$category->category}}</h3>

                        <div class="table-responsive" id="tableRioAro">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Cantidad</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category["articlesRioAro"] as $hola)
                                        <tr>
                                            <td>
                                                {{$hola->name}}
                                            </td>

                                            <td>
                                                {{$hola->quantity}}
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


</main>

@endsection
