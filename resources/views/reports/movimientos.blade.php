<table>
    <tr style="text-align: center; font-weight: bold;">
        <td>#</td>
        <td>Información</td>
        <td>Venta</td>
        <td>Vendedor</td>
        <td>Dueño(s)</td>
        <td>Total</td>
        <td># de operación</td>
        <td>Fecha</td>
    </tr>

    @php $compr_rep=0; $count=1; $total_ventas_bolivar=0; $total_ventas_dolar=0; $total_ventas_arg=0; $total_ventas_reais=0; $ventas_entidad_bs=[]; $ventas_entidad_dolar=[]; $ventas_entidad_arg=[]; $ventas_entidad_reais=[]; @endphp

    @foreach($movimientos as $key => $movimiento)
        @if($movimiento->type == "bums")
            @if($compr_rep != $movimiento->id)
            @php $compr_rep = $movimiento->id; @endphp
             <tr style="text-align: center;">
                <td>{{$count}}</td>
                <td>Cliente: {{$movimiento->venta->cliente->name}} {{$movimiento->venta->cliente->lastname}} <br> Entidad: {{$movimiento->entidad}}</td>
                <td>Artículo: {{$movimiento->venta->articulo->name}} <br> Categoría: {{$movimiento->venta->articulo->pertenece_category->category}} <br> {{$movimiento->venta->articulo->email}} | {{$movimiento->venta->articulo->nickname}} {{$movimiento->venta->articulo->password}}</td>
                <td>{{$movimiento->venta->user->name}} @if($movimiento->comision) {{number_format($movimiento->comision * $movimiento->cantidad, 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}} @endif</td>
                <td>
                    @foreach($movimiento->venta->articulo->duennos as $duenno) 
                       
                        ({{$duenno->name}} {{$duenno->lastname}}) | {{number_format((($duenno->pivot->porcentaje / 100) *  $movimiento->price) - ($movimiento->comision * ($duenno->pivot->porcentaje / 100)), 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}} ({{$duenno->pivot->porcentaje}}%)<br>

                    @endforeach
                </td>
                <td>{{number_format($movimiento->price * $movimiento->cantidad, 0, ',', '.')}} {{$movimiento->movimiento->moneda->sign}}</td>
                <td>{{$movimiento->id}}</td>
                <td>{{$movimiento->updated_at->format('d M Y')}}</td>
            </tr>
            @endif
            @if($movimiento->movimiento->moneda->coin=="Bolivares")
                @php $total_ventas_bolivar+=($movimiento->price * $movimiento->cantidad * $movimiento->porcentaje / 100); @endphp
                @if(!isset($ventas_entidad_bs[strtoupper($movimiento->entidad." Bs")]))
                    @php $ventas_entidad_bs[strtoupper($movimiento->entidad." Bs")]=0; @endphp
                @endif
                @php $ventas_entidad_bs[strtoupper($movimiento->entidad." Bs")]+=($movimiento->price * $movimiento->cantidad * $movimiento->porcentaje / 100); @endphp

            @elseif($movimiento->movimiento->moneda->coin=="Dolares")
                @php $total_ventas_dolar+=($movimiento->price * $movimiento->cantidad * $movimiento->porcentaje / 100); @endphp
                @if(!isset($ventas_entidad_dolar[strtoupper($movimiento->entidad." $")]))
                    @php $ventas_entidad_dolar[strtoupper($movimiento->entidad." $")]=0; @endphp
                @endif
                @php $ventas_entidad_dolar[strtoupper($movimiento->entidad." $")]+=($movimiento->price * $movimiento->cantidad * $movimiento->porcentaje / 100); @endphp

            @elseif($movimiento->movimiento->moneda->coin=="Peso Argentinos")
                @php $total_ventas_arg+=($movimiento->price * $movimiento->cantidad * $movimiento->porcentaje / 100); @endphp
                @if(!isset($ventas_entidad_arg[strtoupper($movimiento->entidad." ARS")]))
                    @php $ventas_entidad_arg[strtoupper($movimiento->entidad." ARS")]=0; @endphp
                @endif
                @php $ventas_entidad_arg[strtoupper($movimiento->entidad." ARS")]+=($movimiento->price * $movimiento->cantidad * $movimiento->porcentaje / 100); @endphp

            @elseif($movimiento->movimiento->moneda->coin=="Reais")
                @php $total_ventas_reais+=($movimiento->price * $movimiento->cantidad * $movimiento->porcentaje / 100); @endphp
                @if(!isset($ventas_entidad_reais[strtoupper($movimiento->entidad." R$")]))
                    @php $ventas_entidad_reais[strtoupper($movimiento->entidad." R$")]=0; @endphp
                @endif
                @php $ventas_entidad_reais[strtoupper($movimiento->entidad." R$")]+=($movimiento->price * $movimiento->cantidad * $movimiento->porcentaje / 100); @endphp
            @endif

            @php $count++; @endphp
        @endif
    @endforeach

    <tr style="text-align: center;">
        <td style="font-weight: bold;">Total de ventas en Bs: {{$total_ventas_bolivar}}</td>

        @foreach($ventas_entidad_bs as $key => $venta_entidad)
            <td>{{$key}}: {{$venta_entidad}}</td>
        @endforeach
    </tr>
    <tr style="text-align: center;">
        <td style="font-weight: bold;">Total de ventas en $: {{$total_ventas_dolar}}</td>

        @foreach($ventas_entidad_dolar as $key => $venta_entidad)
            <td>{{$key}}: {{$venta_entidad}}</td>
        @endforeach
    </tr>
    <tr style="text-align: center;">
        <td style="font-weight: bold;">Total de ventas en ARS: {{$total_ventas_arg}}</td>

        @foreach($ventas_entidad_arg as $key => $venta_entidad)
            <td>{{$key}}: {{$venta_entidad}}</td>
        @endforeach
    </tr>
    <tr style="text-align: center;">
        <td style="font-weight: bold;">Total de ventas en R$: {{$total_ventas_reais}}</td>

        @foreach($ventas_entidad_reais as $key => $venta_entidad)
            <td>{{$key}}: {{$venta_entidad}}</td>
        @endforeach
    </tr>

</table>