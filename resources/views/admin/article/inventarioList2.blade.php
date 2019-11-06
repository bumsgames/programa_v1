@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

<main class="app-content">
    <div class="app-title">
        <div>
        <h1><i class="fa fa-dashboard"></i> inventario {{$ubicacion->nombre_ubicacion}}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">

                <div class="row mb-5">
                    <div class="col">
                        @foreach ($ubicaciones as $ubicacion)
                            <a href="{{ url('inventario/'.$ubicacion->id) }}">
                                <button class="btn btn-primary" type="button">
                                    {{$ubicacion->nombre_ubicacion}}
                                </button>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    {{-- <h3 class="mb-3">{{ $titulo }}</h3> --}}
                    <h4 class="mb-3">{{ $titulo }}</h4>
                    {{-- <hr> --}}
                    <?php $i = 1; ?>
                    <?php $categoria = ''; ?>

                    @foreach($articulos as $articulo)
                        @if($articulo->category != $categoria)
                        @if($i != 1)
                        @endif
                        <?php $categoria = $articulo->category; ?>
                        <?php $i = 1; ?>


                        <h4 class="mt-5"><strong>{{ $articulo->category }}</strong></h4>

                        @endif
                        <table class="table table-light">
                            <tbody>
                                <tr>
                                    <td><strong><?php echo $i++; ?></strong>.</td>
                                    <td>{{$articulo->name }}</td>
                                    <td>Cantidad: {{ $articulo->quantity }}</td>
                                    <td>Precio: {{ $articulo->price_in_dolar }}</td>
                                    <td>Ubicación: {{ $articulo->ubicacion }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</main>

<style>

    .table th, .table td {

        width: 115px !important;
    }

</style>

@endsection