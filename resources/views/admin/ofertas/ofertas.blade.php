@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> {{ $title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">				
				<div class="table-responsive">
				
					<table class="table">
						<thead>
							<tr>
                                <th scope="col">#</th>
								<th scope="col">Nombre y Apellido</th>
                                <th scope="col">Juego</th>
                                <th scope="col">Categoria</th>
								<th scope="col">N# de Whatsapp</th>
                                <th></th>
							</tr>
						</thead>
						<tbody>	
                            @foreach($ofertas as $oferta)
                            <tr>
                                <td class="align-middle">{{$oferta->id}}</td>
                                <td class="align-middle">{{$oferta->name}}</td>
                                <td class="align-middle">{{$oferta->articulo->name}}</td>
                                <td class="align-middle">{{$oferta->articulo->pertenece_category->category}}</td>
                                <td class="align-middle">{{$oferta->telefono}}</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#veroferta" id="modaltrigger" onclick="modaltrigger({{$oferta->id}},'{{$oferta->name}}','{{$oferta->articulo->name}}','{{$oferta->articulo->pertenece_category->category}}','{{$oferta->telefono}}','{{$oferta->oferta}}','{{$oferta->articulo->price_in_dolar}}$',{{$oferta->estado}})">
                                        Ver Oferta
                                    </button>
                                </td>
                            </tr>
                            @endforeach
			            </tbody>
		            </table>
	            </div>
	@if ($ofertas->hasPages())
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($ofertas->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $ofertas->previousPageUrl() }}" rel="prev"><</a></li>
            @endif

            @if($ofertas->currentPage() > 3)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $ofertas->url(1) }}">1</a></li>
            @endif
            @if($ofertas->currentPage() > 4)
                <li class="page-item"><span class="page-link">...</span></li>
            @endif
            @foreach(range(1, $ofertas->lastPage()) as $i)
                @if($i >= $ofertas->currentPage() - 2 && $i <= $ofertas->currentPage() + 2)
                    @if ($i == $ofertas->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $ofertas->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($ofertas->currentPage() < $ofertas->lastPage() - 3)
                <li class="page-item"><span class="page-link">...</span></li>
            @endif
            @if($ofertas->currentPage() < $ofertas->lastPage() - 2)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $ofertas->url($ofertas->lastPage()) }}">{{ $ofertas->lastPage() }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($ofertas->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $ofertas->nextPageUrl() }}" rel="next">></a></li>
            @else
                <li class="page-item disabled"><span class="page-link">></span></li>
            @endif
        </ul>
    @endif


</div>

</div>
</div>

</main>
<!-- Modal -->
<div class="modal fade" id="veroferta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Oferta de cliente #<span class="titulomodal"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                    <h5>Cliente: &nbsp;<span style="font-weight:normal" class="cliente"></span></h5>
                    <h5># de Whatsapp: &nbsp;<span style="font-weight:normal" class="telefono"></span></h5>
                    <h5>Artículo: &nbsp;<span style="font-weight:normal" class="articulo"></span></h5>
                    <h5>Categoría: &nbsp;<span style="font-weight:normal" class="categoria"></span></h5>
                    <h5>Precio: &nbsp;<span style="font-weight:normal" class="precio"></span></h5>
                    <h5>Oferta: &nbsp;</h5>
                    <h5><span style="font-weight:normal" class="oferta"></span></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="aprobar-link" class="btn btn-success">Aprobar</button>               
                <button id="rechazar-link" class="btn btn-danger">Rechazar</button>
            </div>
        </div>
    </div>
</div>
<script src="http://127.0.0.1:8000/js/jquery3.min.js"></script>
<script>
    $('#veroferta').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);        
    });
    
    function modaltrigger(id, nombre, articulo, categoria, telefono, oferta,precio,estado){
        $('.titulomodal').text(id);
        $('.cliente').text(nombre);
        $('.articulo').text(articulo);
        $('.categoria').text(categoria);
        $('.telefono').text(telefono);
        $('.precio').text(precio);
        $('.oferta').text(oferta);
        if(estado == 0){
            $('#aprobar-link').show();
            $('#rechazar-link').show();
        }
        else{
            $('#aprobar-link').hide();
            $('#rechazar-link').hide();
        }
    }

    $('#aprobar-link').click(function(){
        $.get( "/ofertas_cliente/aprobar/"+$('.titulomodal').text(), function( data ) {
            if(data.success){
                $('#veroferta').modal('hide')
                swal('Oferta Aprobada!','La oferta ha sido aprobada correctamente','success');
            }
            else{
                $('#veroferta').modal('hide')
                swal('Error!','Algo ha salido mal, reinicia la pagina y vuelve a intentarlo.','error');
            }
        });
    });

    $('#rechazar-link').click(function(){
        $.get( "/ofertas_cliente/rechazar/"+$('.titulomodal').text(), function( data ) {
            if(data.success){
                $('#veroferta').modal('hide')
                swal('Oferta Rechazada','La oferta ha sido rechazada correctamente','success');
            }
            else{
                $('#veroferta').modal('hide')
                swal('Error!','Algo ha salido mal, reinicia la pagina y vuelve a intentarlo.','error');
            }
        });
    });
</script>
@endsection