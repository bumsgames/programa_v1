@extends('layouts.plantillaWeb')
@extends('layouts.ultimos-v')

@section('content')
<br>
<br>

<div class="container" >
<div class="fondotituloEscrito2" >
<h2 class="col-8 titulobumsEscrito2">Lista escrita</h2>
</div>
<div class="tile fondoBlanco shadow_ligero">
<div class="row">
<div id="accordion" class="col-lg-3 col-12">
<div class="card menu_rev">
<div class="card-header revendedor-header">
<div style="padding:;">
<center>
<h3>
<i class="fa fa-gear"></i> Herramientas para revendedores
</h3>
<p>Aumenta el precio de la lista escrita a tu conveniencia.</p>
</center>
</div>
<hr style="border: solid 1px gray; opacity: 0.7;">
<form class="form" action="lista_escrita" method="post">
<div class="form-group">
<label for="pf">
<strong>Precio unitario a aumentar (<span id="sign">{{$moneda_actual->sign}}</span>)</strong>
</label>
<input id="pf" class="form-control" type="number" name="precio_fijo" value="{{$precio_cliente}}">
</div>

<div class="form-group">
<strong><label for="pp">Porcentaje de precio a aumentar (%)</label></strong>
<input id="pp" class="form-control" type="number" name="precio_porcentaje" value="{{($precio_porcentaje*100)-100}}">
</div>
<center>

<button id="herramientbtn" class="btn btn-primary" type="submit"><i class="fas fa-wrench"></i> Usar herramienta</button>
</center>
<br>
<br>
<br>
</form>

<h5 style="text-align:center;text-transform:uppercase;font-size:17px" id="precioherramienta"></h5>
<br>
<h5 style="text-align:center;text-transform:uppercase;font-size:17px" id="porcentajeherramienta"></h5>
<br>
<h5 style="text-align:center;text-transform:uppercase;font-size:17px" id="infoherramienta"></h5>

<br>
{{-- <center>
	@foreach (	$categorias_sub as $categoria)
		<button type="button" onclick='CopyToClipboard("lista_1","{{ $categoria->nombre }}")' class="btn btn-primary btn-block"></i> Copiar Lista
		 {{ $categoria->nombre }}</button>
	@endforeach
</center>
<br> --}}

</div>
<div class="container sticky2 masAncho">
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
<?php $i = 0; ?>
@foreach($portal3 as $imagen)
@if($i == 0)
<div class="carousel-item active">
<img class="d-block w-100" height="auto" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
</div>
@else
<div class="carousel-item">
<img class="d-block w-100" height="auto" src="{{ url('img/'.$imagen->imagen) }}" alt="First slide">
</div>
@endif
<?php $i++; ?>
@endforeach
</div>
</div>

</div>
<br>
<br>
<br>
<br>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Bloque Lista Escrita -->
<ins class="adsbygoogle"
style="display:block"
data-ad-client="ca-pub-2298464716816209"
data-ad-slot="7801147059"
data-ad-format="auto"
data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

</div>
<div class="col-lg-8 col-12 tile_3">
<h5>Ordenar por:</h5>

<div class="container responsive">
<br>
<div class="row">
<div class="col-12">
Ordenar por:
<form class="form-inline" action="{{ url('cambio_ordenador') }}" method="get">
<select class="form-control se letraPe" onchange="this.form.submit()" id="filtro_order" name="filtro" style="font-size: 14px; width: 100%;">
@if ($id_ordenador == 1)
<option value="1" selected="">Menor a mayor</option>
<option value="2">Mayor a menor</option>
<option value="4">Orden alfabetico ascendente</option>
<option value="3">Orden alfabetico descendente</option>
@else
@if ($id_ordenador == 2)
<option value="1">Menor a mayor</option>
<option value="2" selected="">Mayor a menor</option>
<option value="4">Orden alfabetico ascendente</option>
<option value="3">Orden alfabetico descendente</option>
@else
@if ($id_ordenador == 3)
<option value="1">Menor a mayor</option>
<option value="2">Mayor a menor</option>
<option value="4">Orden alfabetico ascendente</option>
<option value="3" selected="">Orden alfabetico descendente</option>
@else
<option value="1">Menor a mayor</option>
<option value="2">Mayor a menor</option>
<option value="4" selected="">Orden alfabetico ascendente</option>
<option value="3">Orden alfabetico descendente</option>
@endif
@endif
@endif

</select>
</form>
</div>
</div>

</div>
<br>
<br>	




<?php $i = 1; $j = -1; ?>
                    <?php $categoria = ''; ?>
                    @php $total = 0; @endphp

                    @foreach($articulos as $articulo)
                        @if($articulo->category != $categoria)
                        @php $j++; @endphp 

                        
                       

                        @if($i != 1)
                        @if ($j != 0)
                        	
                        </div>
                        @endif
                        @endif
                        <div id="div_{{$articulo->id_categoria}}">

                        <?php $categoria = $articulo->category; ?>
                        <?php $i = 1; ?>


                        <h4 class="mt-5"><strong>{{ $articulo->category }}</strong></h4>
                        <button type="button" onclick='CopyToClipboard("div_{{$articulo->id_categoria}}","{{ $articulo->category }}")' class="btn btnbums sticky copy" style="top:180px; background-color: blue;">Copiar</button>

                        @endif
                        @if($articulo->id_categoria == 4 || $articulo->id_categoria == 6 || $articulo->id_categoria == 11 || $articulo->id_categoria == 14 || $articulo->id_categoria == 15 || $articulo->id_categoria == 16 )
						<strong><?php echo $i++; ?></strong>. {{$articulo->name }} - {{ $articulo->estado}}.

						
						@else

						<strong><?php echo $i++; ?></strong>. {{$articulo->name }}.
						@endif

						@if($articulo->oferta==1)
						{{ $articulo->price_offer }}
						<del>{{ number_format((($articulo->offer_price* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</del>
						<strong class="precio_oferta"> {{ number_format((($articulo->price_in_dolar* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</strong>
						@else    
						<strong> {{ number_format((($articulo->price_in_dolar* $moneda_actual->valor) + $precio_cliente)*$precio_porcentaje, 2, ',', '.') }} {{ $moneda_actual->sign }}</strong>
						@endif	

						<br><br>
                    @endforeach
                    </div>
                    
</div>
</div>
<br>
<br>

</div>

</div>
<br>
<br>
<br>
<br>
</div>

</div>

<script>
function CopyToClipboard(containerid, b) {
	
if (document.selection) {
var range = document.body.createTextRange();
range.moveToElementText(document.getElementById(containerid));
range.select().createTextRange();
document.execCommand("copy");

} else if (window.getSelection) {
var range = document.createRange();
range.selectNode(document.getElementById(containerid));
window.getSelection().removeAllRanges()
window.getSelection().addRange(range);
document.execCommand("copy");
window.getSelection().removeAllRanges();
alert("Usted ha copiado la categoria: "+b+".");
}
}
</script>
@endsection