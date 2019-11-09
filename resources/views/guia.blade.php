@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')`
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-dashboard"></i>Guias y tutoriales</h1>
			<p>Llegamos para hacer la diferencia</p>
		</div>
{{--     <ul class="app-breadcrumb breadcrumb">
      <li cla`ss="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
  </ul> --}}
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			@include('admin.misc.plantilla_guia')
		</div>
	</div>
</div>
</main>

@endsection