<div class="modal fade letraNegra" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content" >
			<div class="modal-header" >
				<h3 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Carrito de compras</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover" id="tablaCarrito">
					<tbody>
						<?php $i = 1; ?>
						<?php $precio = 0; ?>
						@if(Session::has('carrito'))


						@foreach( Session::get('carrito') as $x )
						<tr>
							<th>
								<?php echo $i++; ?>
							</th>
							<td>
								<input type='text' class='id_articulo' value='{{ $x['id'] }}' hidden="">
								{{ $x['articulo'] }} || {{ $x['categoria'] }}
							</td>
							<td>
								{{  number_format($x['precio'] * $moneda_actual->valor, 2, ',', '') }} {{ $moneda_actual->sign }}
								<?php $precio += $x['precio']; ?>
							</td>
							<td>
								<img src="img/{{ $x['imagen'] }}" width="40" height="45" alt="">

							</td>
							
							<td>
								<button type="button" class="close" onclick="borrarElementoCarrito({{ $i - 1 }}, {{ $moneda_actual->valor }}, '{{ $moneda_actual->sign }}');">
									<span aria-hidden="true">&times;</span>
								</button>
							</td>

						</tr>

						@endforeach

						@endif
						<tr>
							<td>
								<strong>Total: {{ number_format($precio * $moneda_actual->valor, 2, ',', '')}} {{ $moneda_actual->sign }}</strong>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="number" id="nArt" value="{{ $i - 1}}" hidden="">
			<div class="modal-footer">
				<button id="comprarCarrito" class="btn btn-danger"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Comprar</button>
			</div>
		</div>
	</div>
</div>