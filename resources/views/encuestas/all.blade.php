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
				<h6>Numero de Encuestas: {{ $encuestas->total() }}</h6>
				
				<div class="table-responsive">
				
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
                                <th scope="col">Título</th>
                                <th scope="col">Opciones</th>
                                <th></th>
							</tr>
						</thead>
						<tbody>	
                            @foreach($encuestas as $encuesta)
                            <?php $total = 0;?>
                            @foreach($encuesta->Options as $opcion)
                                <?php $total+=$opcion->contador?>
                            @endforeach
                            <?php if($total == 0){ $total = 1;}?>
                            <tr>
                                <td class="align-middle">{{$encuesta->id}}</td>
                                <td class="align-middle">{{$encuesta->nombre}}</td>
                                <td class="align-middle">
                                    @foreach($encuesta->Options as $opcion)
                                    {{$opcion->nombre}}
                                    <div class="progress mb-1">
                                        <div class="progress-bar" role="progressbar" 
                                        style="width: {{number_format ( $opcion->contador * 100/$total , 0 , "," , "." )}}%;background-color:{{$opcion->color}}"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{number_format ( $opcion->contador * 100/$total , 2 , "," , "." )}}%</div>
                                    </div>
                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    <a href="/encuestas/editar/{{$encuesta->id}}" class="btn btn-info">Editar</a> 
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarmodal" id="modaltrigger" onclick="modaltrigger({{$encuesta->id}},'{{$encuesta->nombre}}')">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                            @endforeach
			            </tbody>
		            </table>
	            </div>
	@if ($encuestas->hasPages())
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($encuestas->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $encuestas->previousPageUrl() }}" rel="prev"><</a></li>
            @endif

            @if($encuestas->currentPage() > 3)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $encuestas->url(1) }}">1</a></li>
            @endif
            @if($encuestas->currentPage() > 4)
                <li class="page-item"><span class="page-link">...</span></li>
            @endif
            @foreach(range(1, $encuestas->lastPage()) as $i)
                @if($i >= $encuestas->currentPage() - 2 && $i <= $encuestas->currentPage() + 2)
                    @if ($i == $encuestas->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $encuestas->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($encuestas->currentPage() < $encuestas->lastPage() - 3)
                <li class="page-item"><span class="page-link">...</span></li>
            @endif
            @if($encuestas->currentPage() < $encuestas->lastPage() - 2)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $encuestas->url($encuestas->lastPage()) }}">{{ $encuestas->lastPage() }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($encuestas->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $encuestas->nextPageUrl() }}" rel="next">></a></li>
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
<div class="modal fade" id="eliminarmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar: <span class="titulomodal"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <p>Estas seguro que deseas eliminar la encuesta "<strong><span class="titulomodal"></span></strong>"?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="" id="delete-link" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>
<script src="http://127.0.0.1:8000/js/jquery3.min.js"></script>
<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);        
    });
    
    function modaltrigger(id, titulo){
        $('.titulomodal').text(titulo);
        $('#delete-link').attr("href","/encuestas/eliminar/"+id);
    }
</script>
@endsection