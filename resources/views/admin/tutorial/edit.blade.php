@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Crear Tutorial</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">


			<br>
			<div id="select" class="panel-body">
                <div class="col-12">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">

				
                         <form class="form-group"  method="post" action="{{ url('/editartutorial') }}">
                            {{ csrf_field() }}
                            <input name="id" id="id" value="{{$tutorial->id}}" hidden="">
                            <div class="row">
                                <div class="col-6">
                                    <label for=tituloTutorial><h4>Titulo del tutorial</h4></label>
                                    <input value="{{$tutorial->titulo}}" class="form-control" type="text" name="tituloTutorial" placeholder="Titulo del tutorial..." autocomplete="off">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                <label for=contenidoTutorial><h4>Contenido del tutorial</h4></label>
                                    <br>
                                    <button class="texteditor" id="h1el" type="button">H1</button>
                                    <button class="texteditor" id="h2el" type="button">H2</button>
                                    <button class="texteditor" id="h3el" type="button">H3</button>
                                    <button class="texteditor" id="h4el" type="button">H4</button>
                                    <button class="texteditor" id="h5el" type="button">H5</button>
                                    <button class="texteditor" id="h6el" type="button">H6</button>
                                    <button class="texteditor" id="smll" type="button">Small</button>
                                    <button class="texteditor" id="brel" type="button">Br</button>
                                    <button class="texteditor" id="hrel" type="button">Hr</button>
                                    <button class="texteditor" id="subr" type="button"><strong>N</strong></button>
                                    <button class="texteditor" id="udrl" type="button"><u>U</u></button>
                                    <button class="texteditor" id="strk" type="button"><strike>T</strike></button>
                                    <button class="texteditor" id="itlc" type="button"><i>i</i></button>
                                    <button class="texteditor" id="Href" type="button">Href</button>
                                    <button class="texteditor" id="ulli" type="button">Ul</button>
                                    <button class="texteditor" id="olli" type="button">Ol</button>
                                    <button class="texteditor" id="lili" type="button">Li</button>
                                    <button class="texteditor" id="cntr" type="button">Center</button>

                                    <br>
                                    <br>                                    
                                    <div id="txtEditor">
                                        <textarea id="myTextArea" class="form-control" name="contenidoTutorial" placeholder="Titulo del tutorial..." autocomplete="off">{{$tutorial->texto}}</textarea >
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">   
                                    <h3>Preview:</h3>
                                    <span id="preview"><?php echo $tutorial->texto;?>
                                    </span>
                                </div>
                            </div>
                            <button style="float:right" type="submit" class="btn btn-primary">Editar Tutorial</button>
                            <br>
                        </form>
                </div>
            
			</div>


		</div>

	</div>
</div>
</main>
<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>
<script>
    $("#myTextArea").on("keyup",function(){

        $('#preview').html($("#myTextArea").val());
    });
    $('#h1el').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<h1>" + segment_2 + "</h1>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#h2el').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<h2>" + segment_2 + "</h2>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#h3el').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<h3>" + segment_2 + "</h3>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#h4el').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<h4>" + segment_2 + "</h4>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#h5el').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<h5>" + segment_2 + "</h5>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#h6el').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<h6>" + segment_2 + "</h6>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });

    $('#brel').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + segment_2 + "<br>" + segment_3 ;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });

    $('#hrel').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + segment_2 + "<hr>" + segment_3 ;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });

       $('#subr').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<strong>" + segment_2 + "</strong>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#udrl').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<u>" + segment_2 + "</u>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#strk').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<strike>" + segment_2 + "</strike>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#smll').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<small>" + segment_2 + "</small>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#itlc').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<i>" + segment_2 + "</i>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#Href').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<a href='#'>" + segment_2 + "</a>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });

    $('#ulli').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<ul>" + segment_2 + "</ul>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    
    $('#olli').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<ol>" + segment_2 + "</ol>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    
    $('#lili').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<li>" + segment_2 + "</li>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
    $('#cntr').on('click',function(){
        var selStart = $("#myTextArea")[0].selectionStart;
        var selEnd = $("#myTextArea")[0].selectionEnd;
        var lenghtstring = selEnd-selStart;
        var originalString = $("#myTextArea").val();
        var segment_1 = originalString.substr(0,selStart);
        var segment_2 = originalString.substr(selStart,lenghtstring);
        var segment_3 = originalString.substr(selEnd,originalString.length);
        var finalString = segment_1 + "<center>" + segment_2 + "</center>" + segment_3;
        $("#myTextArea").val(finalString);
        $('#preview').html(finalString);
    });
</script>
@endsection