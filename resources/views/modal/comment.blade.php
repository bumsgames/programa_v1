<div class="modal fade" id="commentModal">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header headerComment">
        <h3 class="commentTitle"> Tu opinion vale mucho para nosotros</h3>

      </div>
      <div class="modal-body bodyComment" id='comentariosmodal'>
        <h5>Tu comentario sera mostrado una vez sea aprobado!</h5>
        {!! Form::open(['action' => 'CommentController@store', 'method' => 'POST'])!!}
        @if (Auth::guard('client')->check())
        <div class="form-check-inline">
        <label class="form-check-label">
          {{Form::radio('opcion', '1',true),['class'=>'form-check-input']}}
          Publicar con mi nombre
          </label>
        </div>
        <div class="form-check-inline">
        <label class="form-check-label">
          {{Form::radio('opcion', '2'),['class'=>'form-check-input']}}
          Publicar como anonimo
          </label>
        </div>
        @endif
        <br>
        @if (Auth::guard('client')->guest())

        <div class="form-group">
          
          {{Form::label('nombre','Escribe el nombre a mostrar (Dejalo vacio para comentar como anonimo)')}}  
          {{Form::text('nombre','',['class'=>'form-control','placeholder'=>'Nombre','autocomplete'=>'off'])}}
        </div>
        @endif
        <div class="form-group">
        {{Form::label('comentario','Dejanos tu comentario y sera mostrado una vez sea aprobado')}}  
          {{Form::textarea('comentario','',['class'=>'form-control','placeholder'=>'Deja tu comentario...'])}}
        </div>
        {{Form::submit('Enviar comentario',['class'=>'btn btn-primary btnmodal','id'=>'idcomentariobtn'])}}
        {!! Form::close()!!}
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnmodal" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@if(session()->has('errormessage'))
    <div class="alert alert-warning">
        {{ session()->get('errormessage') }}
    </div>
@endif