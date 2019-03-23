
<p class="card-text">

    <?php $opciones = 0;?>
    <?php $total = 0;?>
    @foreach($encuesta->Options as $option)
        <?php $total+=$option->contador?>
    @endforeach
    <?php if($total == 0){ $total = 1;}?>
    @if(Session::get('poll_voted') != $encuesta->id)

    @foreach($encuesta->Options as $option)
    <?php $opciones++;?>
    <div class="custom-control custom-radio encuesta-option">
        <input type="radio" class="custom-control-input" id="option_{{$opciones}}" name="respuesta" value="{{$option->id}}">
        <label class="custom-control-label" for="option_{{$opciones}}">{{$option->nombre}}</label>
    </div>
    @endforeach 
    @else
    <div class="encuesta-option">
        <h5>Ya has votado en esta encuesta!</h5>
    </div>
    @endif
    @foreach ($encuesta->Resultados as $resultado)
    <div class="encuesta-resultado" style="display:none">
        {{$resultado->nombre}}<span class="float-right">{{$resultado->contador}} ({{number_format ( $resultado->contador * 100/$total , 2 , "," , "." )}}%)</span>
        <div class="progress mb-1">
            <div id="progress_{{$resultado->id}}" class="progress-bar" role="progressbar" 
            style="width: {{number_format ( $resultado->contador * 100/$total , 0 , "," , "." )}}%;background-color:{{$resultado->color}}"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    @endforeach
   
</p>
