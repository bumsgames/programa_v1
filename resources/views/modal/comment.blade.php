<div class="modal fade" id="commentModal">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header headerComment" style="background-color: black;">
        <h3 class="commentTitle" style="color: #0080c7;"> Tu opinion vale mucho para nosotros</h3>

      </div>
      <div class="modal-body bodyComment" id='comentariosmodal'>
        <center>
          <h3 style="color: #0080c7;">TU COMENTARIO SERA MOSTRADO UNA VEZ SEA APROBADO.</h3>

        <h4>
          {!! Form::open(['action' => 'CommentController@store', 'method' => 'POST'])!!}
        </h4>
        </center>
        <br>
        <h4>
          <div class="form-check-inline">
            <label class="form-check-label">
               <input class="form-check-input" checked="" type="radio" name="opcion" value="2">
              Publicar como anonimo
            </label>
           
          </div>
        </h4>
        @if (Auth::guard('client')->guest())

{{--         <div class="form-group">

          {{Form::label('nombre','Escribe el nombre a mostrar (Dejalo vacio para comentar como anonimo)')}}  
          {{Form::text('nombre','',['class'=>'form-control','placeholder'=>'Nombre','autocomplete'=>'off'])}}
        </div> --}}
        @endif
        <div class="form-group">
          {{Form::textarea('comentario','',['class'=>'form-control','placeholder'=>'Dejanos tu opinion, tambien puedes reportar alguna falla en sistema...'])}}
        </div>
        {{Form::submit('Enviar comentario',['class'=>'btn btn-primary btnmodal btn-standar','id'=>'idcomentariobtn'])}}
        {!! Form::close()!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnmodal btn-standar" data-dismiss="modal">Cerrar</button>
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