@extends('layouts.plantillaWeb')

@section('content')
<br>
<br>
<style>
.btn-categorias{
	margin: 20px;
	padding: 10px !important;
}
.fondoBlanco{
	color: black !important;
	background: white !important;
}
</style>
<div class="container-fluid">

	<div class="tile fondoBlanco sidebarpanel" style="padding-left:0">

		
		<br>
		<style>	
.list-group .active{
	background: #ff0005;
	border: none !important;
	opacity: 0.8 !important;
}

.hr_negro{
    border: 1px black solid;
}
	</style>
    <div class="row">
					<div class="col-2 side-panel-col">
						<div class="list-group group-panel" id="list-tab" role="tablist">
                            <span class="list-group-item list-group-item-action panel-item-main " >
                                <div class="row">
                                    <div class="col-2">    
                                        <i style="vertical-align:-100%" class="fa fa-user fa-lg"></i> 
                                    </div>
                                    <div class="col-10"> 
                                        <strong>Mi cuenta</strong><br>
                                        Bienvenido, {{$user->name}} {{$user->lastname}}<br>
                                    </div>
                                </div>
                            </span>
							<a class="list-group-item list-group-item-action panel-item active" id="list-digital-list" data-toggle="list" href="#list-digital" role="tab" aria-controls="digital">Mis productos</a>
							<a class="list-group-item list-group-item-action panel-item " id="list-principal-list" data-toggle="list" href="#list-principal" role="tab" aria-controls="principal">Mis compras</a>
                        </div>
                        
					</div>
					<div class="col-10">
						<div class="tab-content letraNegra ayudabody" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-digital" role="tabpanel" aria-labelledby="list-digital-list">
                                <h1 class="panel-title">MIS PRODUCTOS</h1>
                                <br>
                            <table class="table">
                                <thead class="miscomprashead">
                                <tr >
                                    <th>#</th>
                                    <th>Nombre del producto</th>
                                    <th>Categoria</th>
                                    <th>Email</th>
                                    <th>Clave</th>
                                    <th>Información</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $count=0;?>
                                @foreach($articulosmios as $articulos)
                                <tr class="miscompras">
                                    <td>{{++$count}}</td>
                                    @if(isset($articulos->venta->articulo->name))
                                    <td>{{$articulos->venta->articulo->name}}</td>
                                    @else
                                        <td>{{$articulos->articulo->name}}</td>
                                    @endif
                                    @if(isset($articulos->venta->articulo->name))
                                        <td>{{$articulos->venta->articulo->pertenece_category->category}}</td>
                                    @elseif($articulos->articulo->id =='2')
                                        <td>ARTICULO DEVUELTO</td>
                                    @else
                                        <td>{{$articulos->articulo->pertenece_category->category}}</td>
                                    @endif
                                    
                                    @if($articulos->articulo->id != 2)                                    
                                    @if(in_array($articulos->articulo->category,[1,2,8,9,12]))
                                    <td>{{$articulos->articulo->email}}</td>
                                    @else
                                    <td>-</td>
                                    @endif

                                    @else
                                    <td>-</td>
                                    @endif
                                    <td>
                                        @if(in_array($articulos->articulo->category,[2,9]))
                                        {{$articulos->articulo->password}}
                                        @endif
                                        @if(!in_array($articulos->articulo->category,[2,9]))
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if(in_array($articulos->articulo->category,[2,9]))
                                            @if($articulos->articulo->id =='2')
                                            <?php echo $articulos->informacion;?>
                                            @else
                                            Recuerda que no debes cambiar la clave <br>de esta cuenta
                                            @endif
                                        @endif
                                        @if(in_array($articulos->articulo->category,[1,5,8]))
                                        @if($articulos->articulo->id =='2')
                                            <?php echo $articulos->informacion;?>
                                            @else
                                            Recuerda que no debes jugar desde el <br>usuario de donde descargaste el juego
                                            @endif

                                        @endif
                                        @if($articulos->articulo->id =='2')
                                            <?php echo $articulos->informacion;?>
                                            @endif
                                        @if(in_array($articulos->articulo->category,[1,2,5,8,9,12])&&$articulos->articulo->id !='2')
                                            <br>
                                            <br>Recuerda que puedes utilizar tus juegos <br>como parte ddel pago
                                        @endif
                                    </td>
                                    <script>
                                        $('#textimport').hide();
                                    </script>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
							</div>
							<div class="tab-pane fade" id="list-principal" role="tabpanel" aria-labelledby="list-principal-list">   
                            <h1 class="panel-title">MIS COMPRAS</h1>
                                <br>
                            <table class="table">
                                <thead class="miscomprashead">
                                <tr >
                                    <th>#</th>
                                    <th>Nombre del producto</th>
                                    <th>Categoria</th>
                                    <th>Fecha de la compra</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $count=0;?>
                                @foreach($articulocomprado as $articulos)
                                <tr class="miscompras">
                                    <td>{{++$count}}</td>
                                    <td>{{$articulos->name}}</td>
                                    <td>{{$articulos->catname}}</td>
                                    <td>{{$articulos->fecha}}</td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
									</div>
					
									
						</div>
					</div>
</div>
			

	</div>

</div>


@endsection