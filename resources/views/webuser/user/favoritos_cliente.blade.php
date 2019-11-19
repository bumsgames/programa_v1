@extends('webuser.user.adminpaneluser')

@section('contenido_cliente')
<h1 class="panel-title">FAVORITOS</h1>
                <br>
                <table class="table table-shadow">
                    <thead class="miscomprashead">
                        <tr>
                            <th>#</th>
                            <th>Nombre del producto</th>
                            <th>Categoria</th>
                            <th>Disponibilidad</th>
                        </tr>
                    </thead>
                    <?php $count=1;?>
                     <tbody>
                    @foreach($data as $articulo)
                        <tr>
                            <td>
                                {{ $count++ }}
                            </td>
                            <td>
                                {{ $articulo['name'] }}
                                <br>
                                <br>
                                    <img class="img-top imagen newImg" src="{{ url('img/'.$articulo['file']) }}" alt="Card image cap" style="border-radius: 10px 10px 10px 10px;">
                            </td>
                            <td>
                                {{ $articulo['categoria'] }}
                            </td>
                            <td>
                                @if ($articulo['quantity'] > 0)
                                    <span style="font-size: 1rem;padding: .375rem .75rem;"  class="badge badge-success">Disponible</span>
                                    <br>
                                    <br>
                                    <a href="{{ url('ver_mas/'.$articulo['id']) }}">
                                        <button class="btn btn-primary">Ver mas</button>
                                    </a>
                                    @else
                                    <span style="font-size: 1rem;padding: .375rem .75rem;" class="badge badge-danger">Agotado</span>
                                @endif
                               
                   

                            </td>
                        </tr>
                            @endforeach
                        </tbody>

                    </table>
                

@endsection