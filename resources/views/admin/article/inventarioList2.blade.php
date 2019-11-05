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
                <a href="{{ url('inventario/'.$ubicacion->id) }}"><button class="btn btn-primary" type="button" 
                    Onclick='activar_inventario("{{ $ubicacion->id }}")'>{{$ubicacion->nombre_ubicacion}}</button></a>
                    @endforeach
                </div>
            </div>

            <div id="tableRioAro" >

                <h3 class="mb-3">{{ $titulo }}</h3>
                <hr>
                <?php $i = 1; ?>
                <?php $categoria = ''; ?>
                <div class="row">
                    <div class="col">
                        @foreach($articulos as $articulo)
                        @if($articulo->category != $categoria)
                        @if($i != 1)
                    </div>
                    @endif
                    <?php $categoria = $articulo->category; ?>
                    <?php $i = 1; ?>
                    <br>
                    <br>

                    {{-- LISTA PS4 COPIAR Y PEGAR --}}




                    <div id="div_{{$articulo->id_categoria}}">
                        <h4><strong>{{ $articulo->category }}</strong></h4>
                        <br>
                        <br>
                        @endif




                        <strong><?php echo $i++; ?></strong>. {{$articulo->name }} Cantidad: {{ $articulo->quantity }} Precio: {{ $articulo->price_in_dolar }} {{ $articulo->ubicacion }}
                           {{--  @if($articulo->oferta==1)
                            {{ $articulo->price_offer }}
                            <del>{{ number_format((($articulo->offer_price* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</del>
                            <strong class="precio_oferta"> {{ number_format((($articulo->price_in_dolar* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</strong>
                            @else    
                            <strong> {{ number_format((($articulo->price_in_dolar* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</strong>
                            @endif      --}}         
                            <br><br>    


                            @endforeach
                        </div>

                    </div>
                    
                    
                </div>

                <div id="tableAltaVista" style="display:none;">
                    <h3 class="mb-3">Articulos en Alta Vista</h3>
                    <hr>
                    {{-- @foreach ($categories as $category)
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
                        @endforeach --}}

                    </div>
                </div>
            </div>
        </div>


    </main>


    @endsection
