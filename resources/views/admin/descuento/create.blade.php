@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i> Crear Cupon</h1>
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
                            <th></th>
                            <th></th>
                        </tr>
                       
					</thead>
					<tbody>
                         
                         <form method="post" action="{{ url('/cupones/crear') }}">
                            {{ csrf_field() }}
                            <tr>
                                <td>Registrado por:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="de_usuario" id="de_usuario" class="form-control" value="{{ Auth::user()->id }}" hidden="">
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }} {{ Auth::user()->lastname }}" readonly="" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Descuento ($)</td>
                                <td>
                                    <input class="form-control" placeholder="$$$$" type="number" name="descuento" min="1" max="100" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <td>Disponibles</td>
                                <td>
                                    <input class="form-control" type="number" name="disponible" min="0" max="100" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <td>Codigo</td>
                                <td>
                                    <input class="form-control" type="text" id="codigo" name="codigo" maxlength="12" onkeypress="return AvoidSpace(event)" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <td>Nota (no es obligatoria)</td>
                                <td>
                                    <input class="form-control" type="text" name="nota_cupon" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <button class="btn btn-success" type="submit">Agregar Cupon</button>
                                </td>
                            </tr>
                            </div>   
                        <tr>
                            <td></td>
                            <td>{!!$errors->first('descuento','<span class="help-block">:message</span>')!!}</td>
                            <td>{!!$errors->first('disponible','<span class="help-block">:message</span>')!!}</td>
                            <td>{!!$errors->first('codigo','<span class="help-block">:message</span>')!!}</td>
                            <td></td>

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