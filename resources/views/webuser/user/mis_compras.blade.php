@extends('webuser.user.adminpaneluser')

@section('contenido_cliente')
<h1 class="panel-title">MIS COMPRAS</h1>
                    <br>
                    <table class="table table-shadow">
                        <thead class="miscomprashead">
                            <tr>
                                <th>#</th>
                                <th>Nombre del producto</th>
                                <th>Categoria</th>
                                <th>Fecha de la compra</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $venta)
                        <tr>
                            <td>
                                {{ $i++ }}

                                @php $precio_carrito = 0; @endphp
                                @php $suma_inversion = 0; @endphp
                                @foreach($venta->articulos as $articulo)
                                {{-- Muestra los articulos {{ $articulo }} --}}
                                @php 
                                $suma_inversion += $articulo->costo_individual * $articulo->cantidad; 
                                $precio_carrito += $articulo->precio_venta * $articulo->cantidad;
                                @endphp
                                @endforeach
                            </td>
                            <td>
                                <b>Venta realizada por: </b>{{ $venta->ventaVendedor->name }} {{ $venta->ventaVendedor->lastname }}
                                <br>    
                                <b>Cliente: </b>{{ $venta->ventaCliente->name }} {{ $venta->ventaCliente->lastname }}<br>   <br>
                                <form action="{{ url('factura_cliente') }}" method="POST">   
                                    {{ csrf_field() }}   
                                    <button class="btn" type="submit" name="id_compra" value="{{ $venta->id }}">Ver recibo</button>
                                </form>
                                
                                <hr>    
                                @php $total_pagado = 0; @endphp
                                @foreach ($venta->pagos as $pago)
                                <br>
                                <b>Bando Emisor: </b>{{ $pago->banco->banco }}
                                <br>
                                <b>Monto:</b> {{ $pago->monto }} {{ $pago->moneda->sign }}
                                <br>
                                @if ($pago->moneda->id != 2)
                                <b>Tasa:</b> {{ $pago->dolardia }} {{ $pago->moneda->sign }} = 1 $
                                @endif

                                
                                @php $total_pagado += $pago->monto / $pago->dolardia; @endphp
                                @endforeach
                                <hr>    
                                <b>Equivalente:</b> {{ $pago->monto / $pago->dolardia }} $
<br>
                                <b>Pago Total:</b> {{ $total_pagado }} $
                                <br>
                                <br>
                            </td>
                            {{-- precio total de lo que se pago por todo --}}
                            <td>
                                {{-- {{ $venta->ventaArticulo }} --}}
                                @php $i = 1; @endphp
                                @foreach($venta->articulos as $articulo)
                                {{-- donde va el 1 va precio carrito --}}

                                @php $pago_articulo =  ($articulo->precio_venta / $precio_carrito)  * $total_pagado @endphp

                                <div style="border: solid 2px rgba(0,10,0,0.3); padding: 10px;">
                                    <b> {{ $i++ }}. Articulo:</b> {{ $articulo->articulo->name }}
                                    <br>



                                    <b>Categoria: </b>{{  $articulo->articulo->categorias[0]->category }}
                                    <br>    
                                    <br>
                                    <b>Pago Unitario:</b> {{ $pago_articulo }} $
                                    <br>    
                                    <b>Cantidad:</b> {{ $articulo->cantidad }}
                                </div>
                                
                                <br>
                                <b></b>
                                

                                @endforeach
                            </td>
                            <td>
                                {{$venta->created_at->format('d-m-Y')}}
                                <br>    
                                {{$venta->created_at->format('H:i')}}
                                <br><br>
                                {{$venta->created_at->diffForHumans()}}
                            </td>
                        </tr>
                        @endforeach
                            
                        </tbody>
                    </table>
                

@endsection