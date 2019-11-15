@extends('layouts.plantillaWeb') 
@section('content')
<br>
<br>
<style>
.btn-categorias {
    margin: 20px;
    padding: 10px !important;
}

.fondoBlanco {
    color: black !important;
    background: white !important;
}
</style>
<div class="">

    <div class="tile fondoBlanco sidebarpanel" style="padding-left:0">


        <br>
        <style>
        .list-group .active {
            background: #ff0005;
            border: none !important;
            opacity: 0.8 !important;
        }

        .hr_negro {
            border: 1px black solid;
        }
    </style>
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="container-fluid">
                <div class="list-group group-panel" id="list-tab" role="tablist">
                  <span class="list-group-item panel-item-main " style="border: none; color: gray;">
                    <div class="row">
                        <div class="col-2">    
                            <i style="vertical-align:-100%; color: #0080c7;" class="fa fa-user fa-lg"></i> 
                        </div>
                        <div class="col-10"> 
                            <strong style="color: black;">Mi cuenta</strong><br>
                            Bienvenido, {{$user->name}} {{$user->lastname}}<br>
                        </div>
                    </div>
                </span>
                <a class="list-group-item list-group-item-action panel-item active" id="list-principal-list" data-toggle="list" href="#list-principal"
                role="tab" aria-controls="principal">Mis compras</a>

                <a class="list-group-item list-group-item-action panel-item" id="list-digital-list" data-toggle="list" href="#list-digital"
                role="tab" aria-controls="digital">Mis Juegos Digitales</a>
                @include('modal.comment')
                <br>
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#commentModal">
                    APOYANOS CON TU OPINION    
                </button>

            </div>
        </div>
        <br>
        <br>

    </div>
    <div class="col-12 col-lg-10">
        <div class="container">
            <div class="tab-content letraNegra ayudabody" id="nav-tabContent">
            <div class="tab-pane fade table-responsive" id="list-digital" role="tabpanel" aria-labelledby="list-digital-list">
                <h1 class="panel-title">MIS JUEGOS DIGITALES</h1>
                <br>
                <table class="table table-shadow">
                    <thead class="miscomprashead">
                        <tr>
                            <th>#</th>
                            <th>Nombre del producto</th>
                            <th>Categoria</th>
                            <th>Email</th>
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
                                @if(isset($articulos->venta->articulo->name))
                                <td>{{$articulos->venta->articulo->name}}</td>
                                @else
                                <td>{{$articulos->articulo->name}}</td>
                                @endif @if(isset($articulos->venta->articulo->name))
                                <td>{{$articulos->venta->articulo->pertenece_category->category}}</td>
                                @elseif($articulos->articulo->id =='2')
                                <td>ARTICULO DEVUELTO</td>
                                @else
                                <td>{{$articulos->articulo->pertenece_category->category}}</td>
                                @endif @if($articulos->articulo->id != 2) @if(in_array($articulos->articulo->category,[1,2,8,9,12]))
                                <td>{{$articulos->articulo->email}}</td>
                                @else
                                <td>-</td>
                                @endif @else
                                <td>-</td>
                                @endif
                                <td>
                                    @if(in_array($articulos->articulo->category,[2,9])) {{$articulos->articulo->password}} @endif @if(!in_array($articulos->articulo->category,[2,9]))
                                    - @endif
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
                                </td>
                                <script>
                                    $('#textimport').text('');
                                </script>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="tab-pane fade show active" id="list-principal" role="tabpanel" aria-labelledby="list-principal-list">
                    @if (Auth::guard('client')->user()->confirmed==0)
                        <div class="alert alert-danger mb-4" style="font-size: 24pt" role="alert">
                            Su cuenta no ha sido verificada, verifiquela o en 7 dias sera borrada.
                        </div>
                    @endif
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
                            
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
        </div>
    </div>


</div>

</div>
@endsection