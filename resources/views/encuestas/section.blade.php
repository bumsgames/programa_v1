<p class="card-text">
    <?php $opciones = 0;?>
    <?php $total = 0;?>
    @foreach($encuesta->Options as $option)
        <?php $total+=$option->contador?>
    @endforeach
    <?php if($total == 0){ $total = 1;}?>
    @foreach($encuesta->Options as $option)
    <?php $opciones++;?>
    <div class="custom-control custom-radio encuesta-option">
        <input type="radio" class="custom-control-input" id="option_{{$opciones}}" name="respuesta" value="{{$option->id}}">
        <label class="custom-control-label" for="option_{{$opciones}}">{{$option->nombre}}</label>
    </div> 
    <div class="encuesta-resultado" style="display:none">
        {{$option->nombre}}<span class="float-right">{{$option->contador}} ({{number_format ( $option->contador * 100/$total , 2 , "," , "." )}}%)</span>
        <div class="progress mb-1">
            <div id="progress_{{$option->id}}" class="progress-bar" role="progressbar" 
            style="width: {{number_format ( $option->contador * 100/$total , 0 , "," , "." )}}%;background-color:{{$option->color}}"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    
    @endforeach
</p>