@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Editar Cupon</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">


			<br>
			<div id="select" class="panel-body">

				<table class="table table-responsive">
					<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
					<br>
					<thead>
						<tr>
							<th style="width:50%"></th>
							<th style="width:50%"></th>

                        </tr>
                       
					</thead>
					<tbody style="width:100%">
                         
                         <form method="post" action="/cupones/editar/{{$cupones->id}}">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    Descuento ($)                                
                                </td>
                                <td>
                                    <input class="form-control" autocomplete="off" type="number" value="{{$cupones->descuento}}" name="descuento" min="1" max="100" placeholder="$$$">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Disponibles                                
                                </td>
                                <td>
                                    <input class="form-control" autocomplete="off" type="number" value="{{$cupones->disponible}}" name="disponible" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Codigo                                
                                </td>
                                <td>
                                    <input class="form-control" autocomplete="off" type="text" value="{{$cupones->codigo}}" name="codigo" maxlength="12">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nota (no es obligatoria)                                
                                </td>
                                <td>
                                    <input class="form-control" autocomplete="off" type="text" value="{{$cupones->nota_cupon}}" name="nota_cupon">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <button class="btn btn-success" type="submit">Editar Cupon</button>
                                </td>
                            </div>   
                        </tr>
                        <tr>
                            <td></td>
                            <td>{!!$errors->first('descuento','<span class="help-block">:message</span>')!!}</td>
                            <td>{!!$errors->first('disponible','<span class="help-block">:message</span>')!!}</td>
                            <td>{!!$errors->first('codigo','<span class="help-block">:message</span>')!!}</td>               <td></td>

                        </tr>
                        </form>
                           
                     
					</tbody>
				</table>
			</div>


		</div>

	</div>
</div>
</main>
<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

@endsection