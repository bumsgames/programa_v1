@extends('webuser.user.adminpaneluser')

@section('contenido_cliente')
<h1 class="panel-title">MIS JUEGOS DIGITALES</h1>
                <br>
                <table class="table table-shadow">
                    <thead class="miscomprashead">
                        <tr>
                            <th>#</th>
                            <th>Nombre del producto</th>
                            <th>Categoria</th>
                            <th>Clave</th>
                            <th>Información</th>
                        </tr>
                    </thead>
                    <?php $count=0;?>
                     <tbody>
                    @foreach($articulosmios as $articulos)
                        @if($articulos->articulo->category==1||
                            $articulos->articulo->category==2||
                            $articulos->articulo->category==5||
                            $articulos->articulo->category==8||
                            $articulos->articulo->category==9||
                            $articulos->articulo->category==15||
                            $articulos->articulo->category==12)

                            <tr class="miscompras">
                                <td>{{++$count}}</td>

                                <td>

                                    <h4>{{$articulos->articulo->name}}</h4>
                                    <br>
                                   @if (isset($articulos->articulo->images[0]))
                                        <img class="img-top imagen newImg" src="{{ url('img/'.$articulos->articulo->images[0]->file) }}" alt="Card image cap" style="border-radius: 10px 10px 10px 10px;">
                                   @endif
                                </td>


                                

                                   

                                <td>
                                    @if(1 == 1)
                                    <h5> {{$articulos->articulo->email}}</h5>
                                    <br>
                                    <br>
                                    <h5>{{$articulos->articulo->categorias[0]->category}}</h5>
                                    @endif
                                </td>
                                


                               


                                <td>
                                    @if ((strpos($articulos->articulo->categorias[0]->category,'Secundario') !== false) 
                                    || (strpos($articulos->articulo->categorias[0]->category,'Secundaria') !== false))
                                    {{$articulos->articulo->password}}
                                    @else
                                    En este tipo de Categoria no te podemos mostrar la Clave, ya que no debes loguearte en la Cuenta, en caso de que quieras cambiar de Consola, contacta a un agente BumsGames :)
                                    @endif
                                </td>
                                
                                <td>
                                    @if($articulos->articulo->id == '2')
                                    <?php echo $articulos->informacion;?> @else @if(in_array($articulos->articulo->category,[2,9])) Recuerda que no debes
                                    cambiar la clave <br>de esta cuenta @endif @if(in_array($articulos->articulo->category,[1,5,8]))
                                    Recuerda que no debes jugar desde el <br>usuario de donde descargaste el juego @endif
                                    @endif @if(in_array($articulos->articulo->category,[1,2,8,9,12])&&$articulos->articulo->id
                                    !='2')
                                    <br>
                                    <br>Recuerda que puedes utilizar tus juegos <br>como parte del pago @endif
                                    <br>
                                    <br>

                                    <form action="{{ url('entrega_cliente') }}" method="POST">   
                                    {{ csrf_field() }}   
                                    @if($articulos->articulo->id != '2')
                                    <button class="btn btn-primary" type="submit" name="id_compra" value="{{$articulos->articulo->id }}">Ver entrega</button>
                                    @endif
                                </form>
                                </td>
                                <script>
                                    $('#textimport').text('');
                                </script>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>

                    </table>
                

@endsection