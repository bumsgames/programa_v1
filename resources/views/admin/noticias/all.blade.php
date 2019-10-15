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
				<h6>Numero de Noticias: {{ $noticias->total() }}</h6>
				
				<div class="table-responsive">
				
					<table class="table">
						<thead>
							<tr>
                                <th scope="col">#</th>
								<th scope="col">Título</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Prioridad</th>
								<th scope="col"># de Likes</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Autor</th>
                                <th></th>
							</tr>
						</thead>
						<tbody>	
                            @foreach($noticias as $noticia)
                            <tr>
                                <td class="align-middle break-word ">{{$noticia->id}}</td>
                                <td class="align-middle break-word ">{{$noticia->titulo}}</td>
                                <td class="align-middle break-word ">{{$noticia->descripcion}}</td>
                                <td class="align-middle break-word ">{{$noticia->prioridad}}</td>
                                <td class="align-middle break-word ">{{$noticia->likes}}</td>
                                <td class="align-middle break-word " style="width:25%"><img width="100%" src="{{asset('img/'.$noticia->imagen)}}" alt="No se encontro la imagen"></td>
                                <td class="align-middle">{{$noticia->autor->name}} {{$noticia->autor->lastname}}</td>
                                <td class="align-middle">
                                    <a href="/noticias/editar/{{$noticia->id}}" class="btn btn-info">Editar</a> 
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarmodal" id="modaltrigger" onclick="modaltrigger({{$noticia->id}},'{{$noticia->titulo}}')">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                            @endforeach
			            </tbody>
		            </table>
                    <style type="text/css">
                        .break-word {
                             -ms-word-break: break-all;
                                 word-break: break-all;

                                 // Non standard for webkit
                                 word-break: break-word;

                            -webkit-hyphens: auto;
                               -moz-hyphens: auto;
                                -ms-hyphens: auto;
                                    hyphens: auto;
                            }
                    </style>
	            </div>
	@if ($noticias->hasPages())
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($noticias->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $noticias->previousPageUrl() }}" rel="prev"><</a></li>
            @endif

            @if($noticias->currentPage() > 3)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $noticias->url(1) }}">1</a></li>
            @endif
            @if($noticias->currentPage() > 4)
                <li class="page-item"><span class="page-link">...</span></li>
            @endif
            @foreach(range(1, $noticias->lastPage()) as $i)
                @if($i >= $noticias->currentPage() - 2 && $i <= $noticias->currentPage() + 2)
                    @if ($i == $noticias->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $noticias->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($noticias->currentPage() < $noticias->lastPage() - 3)
                <li class="page-item"><span class="page-link">...</span></li>
            @endif
            @if($noticias->currentPage() < $noticias->lastPage() - 2)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $noticias->url($noticias->lastPage()) }}">{{ $noticias->lastPage() }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($noticias->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $noticias->nextPageUrl() }}" rel="next">></a></li>
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
                    <p>Estas seguro que deseas eliminar la noticia "<strong><span class="titulomodal"></span></strong>"?</p>
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
        $('#delete-link').attr("href","/noticias/eliminar/"+id);
    }
</script>
@endsection