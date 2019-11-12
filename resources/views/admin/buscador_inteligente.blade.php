<center>
	<form class="form-inline margin" action="{{  url('prueba') }}" method="get">
		<select class="form-control selectCoin" onchange="this.form.submit()" name="id_coin" id="id_coin" style="border: solid; border-color: #808080;">
			<option class="form-control" selected="" value="{{ $moneda_actual->id }}">{{ $moneda_actual->coin }}</option>
			@foreach($coins as $coin)
			<option class="form-control" value="{{ $coin->id }}">{{ $coin->coin }}</option>
			@endforeach
		</select>
		&nbsp;
		@if( $moneda_actual->id != 2)

		Tasa: {{ number_format($moneda_actual->valor, 2, ',', '.') }} {{ $moneda_actual->sign }}

		@endif
		<input type="" name="" id="tasa" value="{{ $moneda_actual->valor }}">
		<input type="" name="" id="signo" value="{{ $moneda_actual->sign }}">
	</form>	
</center>

<input name="_token" id="token" value="{{ csrf_token() }}" hidden="">

<input type="text" id="name_buscador_inteligente" value="" >

<div class="col-12 col-lg">
	<div class="form-group">
		<label for=""><strong>Categoria</strong></label>
		<select 
		class="form-control form-control-sm" name="category" 
		id="category_buscador_inteligente">
		@foreach ($categories as $category)
		<option value="{{$category->id}}">{{$category->category}}</option>
		@endforeach
	</select>
</div>
</div>

<div class="table-responsive">
	<table class="table">
		<tbody id="table_client">

		</tbody>
	</table>
</div>

<script src="js/jquery-3.2.1.min.js"></script> 
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bums.js') }}"></script>
<script src="{{ url('js/bums_v2.js') }}"></script>
<script src="{{ asset('js/genesis.js') }}"></script>


<script src="{{ url('js/popper.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/datatables.min.js') }}"></script>
<script src="{{ url('js/datatables-bootstrap.min.js') }}"></script>
<script src="{{ url('js/main.js') }}"></script>
<script src="{{ url('js/plugins/pace.min.js') }}"></script>
<script src="{{url('js/sweet.min.js')}}"></script>