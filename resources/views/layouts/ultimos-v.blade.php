@section('ultimos-vendidos')
<style>
	.btn-categorias{
		margin: 20px;
		padding: 10px !important;
	}
	</style>
	<style>
	.vendido_img{
		width: 170px;
		
	}

	
	</style>

<div class="container-fluid escondite">
		<div class="row justify-content-center ultimo-vendido-banner">
			<div class="col-12 col-lg-2 text-center">
				<br>
				<img class="vendido_img" src="img/logo-fuego.png" alt="">
			</div>
			<div style="border-left-style: solid; margin: 0 40px;"></div>
			<div class="col-12 col-lg-9">
				<div class="row">
					<div class="col-12">
						<h3 class="ultimo-vendido-title" style="width:100%">Ultimos articulos vendidos</h3>
					</div>
				</div>

				<div class="row">
					@foreach($ultimos_vendidos as $uv)
					<div class="col-12 col-lg-3">
						<center>
						<br>
						<div class="ultimo-vendido-content">
							<div class="ultimo-vendido-c-img text-center" style="overflow:hidden;max-width:50%">
								<img src="img/{{$uv->articulo->fondo}}" height="80" style="width:auto" alt="">
							</div>
							<br>
							<br>
							<div class="ultimo-vendido-c-text">
								{{$uv->articulo->name}}
								<br>
								<strong>{{$uv->articulo->pertenece_category->category}}</strong>
								<br>
							</div>
						</div>
						</center>
					</div>
					@endforeach
					
				</div>
				
			</div>
		</div>
	</div>
	@endsection