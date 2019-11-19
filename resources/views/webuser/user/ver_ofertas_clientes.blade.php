@extends('webuser.user.adminpaneluser')

@section('contenido_cliente')
<h1 class="panel-title">FAVORITOS</h1>
                <br>
                <table class="table table-shadow">
                    <thead class="miscomprashead">
                        <tr>
                            <th>#</th>
                            <th>Nombre del producto</th>
                            <th>Oferta</th>
                            <th>Contacto</th>
                        </tr>
                    </thead>
                    <?php $count=1;?>
                     <tbody>
                    @foreach($ofertas_cliente as $oferta_cliente)
                        <tr>
                            <td>    
{{ $count++ }}
                            </td>
                            <td>    
<b> {{  $oferta_cliente->articulo->name }}</b> ({{  $oferta_cliente->articulo->categorias[0]->category }})
<br>    
<br>    
<img class="img-top imagen newImg" src="{{ url('img/'.$oferta_cliente->articulo->images[0]->file) }}" alt="Card image cap" style="border-radius: 10px 10px 10px 10px;">
<br>    
<br>    
<a href="{{ url('ver_mas/'.$oferta_cliente->Fk_article) }}">
                                        <button class="btn btn-primary">Ver mas</button>
                                    </a>
                            </td>
                            <td>    
{{ $oferta_cliente->oferta }}$
<br>    
<br>    
{{ $oferta_cliente->mensaje }}
                            </td>
                             <td>    
Contacto: {{ $oferta_cliente->telefono }}
<br>    
<br>    
<br>    
 @if ($oferta_cliente->estado == 0)
                                    <span style="font-size: 1rem;padding: .375rem .75rem;"  class="badge badge-warning">En espera</span>
                                    
                                    @else
                                    @if ($oferta_cliente->estado == 1)
                                     <span style="font-size: 1rem;padding: .375rem .75rem;"  class="badge badge-success">Aprobado</span>
                                    @else
<span style="font-size: 1rem;padding: .375rem .75rem;"  class="badge badge-danger">Rechazado</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                            @endforeach
                        </tbody>

                    </table>
                

@endsection