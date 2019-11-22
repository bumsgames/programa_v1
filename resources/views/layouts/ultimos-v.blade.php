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
			<img class="vendido_img" src="{{ url('img/logo-fuego.png') }}" alt="">
		</div>
		<div style="border-left-style: solid; margin: 0 40px;"></div>
		<div class="col-12 col-lg-9">
			<div class="row">
				<div class="col-12">
					<h3 class="ultimo-vendido-title" style="width:100%">Ultimos articulos vendidos</h3>
				</div>
			</div>
			<br>

			<div class="row">

				<div class="col-12">
					<div class="" 
					data-speed="0.7"
					data-reverse="" 
					data-pausable="bool">
					<div class="row">
						@foreach($ultimos_vendidos as $uv)
						<div class="col-3">
							<div class="row">
								<div class="col-4">
									<center>
										<img src="{{ url('img/'.$uv->articulo->images[0]->file) }}" height="80" style="width:auto" alt="">
									</center>
								</div>
								<div class="col-8">
									<div class="ultimo-vendido-c-text">
										<h4>{{$uv->articulo->name}}</h4>
										@if (isset($uv->articulo->categorias[0]))
											<strong>{{$uv->articulo->categorias[0]->category}}</strong>
										@endif
										<br>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>


			</div>



		</div>


	</div>
</div>
</div>
@endsection

