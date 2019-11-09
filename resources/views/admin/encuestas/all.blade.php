@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<style>

/*Switch de las encuestas*/
/* The switch - the box around the slider */
.switch {
    position: relative!important;
    display: inline-block!important;
    width: 60px!important;
    height: 34px!important;
  }
  
  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0!important;
    width: 0!important;
    height: 0!important;
  }
  
  /* The slider */
  .slider {
    position: absolute!important;
    cursor: pointer!important;
    top: 0!important;
    left: 0!important;
    right: 0!important;
    bottom: 0!important;
    background-color: #ccc!important;
    -webkit-transition: .4s!important;
    transition: .4s!important;
  }
  
  .slider:before {
    position: absolute!important;
    content: ""!important;
    height: 26px!important;
    width: 26px!important;
    left: 4px!important;
    bottom: 4px!important;
    background-color: white!important;
    -webkit-transition: .4s!important;
    transition: .4s!important;
  }
  
  input:checked + .slider {
    background-color: #2196F3!important;
  }
  
  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3!important;
  }
  
  input:checked + .slider:before {
    -webkit-transform: translateX(26px)!important;
    -ms-transform: translateX(26px)!important;
    transform: translateX(26px)!important;
  }
  
  /* Rounded sliders */
  .slider.round {
    border-radius: 34px!important;
  }
  
  .slider.round:before {
    border-radius: 50%!important;
  }

</style>
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
                                <th>Activar/Desactivar</th>
                                <th scope="col">Opciones</th>
                                <th></th>
							</tr>
						</thead>
						<tbody>	
                            @foreach($encuestas as $encuesta)
                            <?php $total = 0;?>
                            @foreach($encuesta->Resultados as $opcion)
                                <?php $total+=$opcion->contador?>
                            @endforeach
                            <?php if($total == 0){ $total = 1;}?>
                            <tr>
                                <td class="align-middle">{{$encuesta->id}}</td>
                                <td class="align-middle">{{$encuesta->nombre}}</td>
                                <td class="align-middle">
                                    <label class="switch">
                                        <input onchange="activarencuesta({{$encuesta->id}})" type="checkbox" @if($encuesta->estado == 1) checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                    <br>
                                    <small>*Solo puede haber una encuesta activa a la vez</small>
                                </td>
                                <td class="align-middle">
                                    @foreach($encuesta->Resultados as $opcion)
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
<script>
    function activarencuesta(id){
        window.location.href = "/encuesta/activar/"+id;
    }
</script>
@endsection