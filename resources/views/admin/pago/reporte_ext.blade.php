<!doctype html>
<html lang="en">
  <head>
    <title>Reporte de pago</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
        <style>
	

                .pago_section{
                    background-color:#009688;
                    padding: 10px 5px;
                    color:white;
                    width: 90%;
                    display: inline-block;
                }
                .pago_section_title{
                    background-color:#009688;
                    padding: 10px 5px;
                    color:white;
                    width: 100%;
                    display: inline-block;
                }
                .right_triangle{
                    margin-bottom: -14px;
                    border-top: 48px solid #009688;
                    border-right: 45px solid transparent;
                    display: inline-block;
                }

                .reporte-container{
                    border-radius: 5px;
                    border: 2px solid #009688;
                }
                </style>
    <div class="container">
        <div class="row">
            <div class="col-12 reporte-container">
                <h4 class="pago_section_title mt-2 text-center">REPORTE DE PAGO #{{$pago->id}}</h4>
                <hr>
                <h4 class="pago_section">DATOS DEL PAGO</h4><span class="right_triangle"></span>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <span>ID del pago</span>
                    </div>
                    <div class="col-6">
                        <span id="identificador">{{$pago->id}}</span>
                    </div>
                </div>
                <br>
                <h4 class="pago_section">ARTICULOS COMPRADOS</h4><span class="right_triangle"></span>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div id="articulos_div">
                            <?php $total=0;?>
                            @foreach($pago->Articulos as $articulo)
                            <div class="card mb-3" style="max-width: 100%;max-height:510px">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="{{asset('img/'.$articulo->fondo)}}" class="card-img" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 style="margin-bottom:0" class="card-title">
                                                {{$articulo->name}}
                                            </h5>
                                            <p style="margin-bottom:0" class="card-text">
                                                {{$articulo->pertenece_category->category}}
                                            </p>
                                            <p class="card-text">
                                                <span>
                                                    Precio: {{$articulo->price_in_dolar}}$
                                                    <?php $total+=$articulo->price_in_dolar;?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if(isset($pago->descuento))
                    <h4 class="pago_section">CODIGO DE DESCUENTO</h4><span class="right_triangle"></span>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <span>ID del cupon aplicado</span>
                        </div>
                        <div class="col-6">
                            {{$pago->cupon_id}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <span>Monto del cupon aplicado ($)</span>
                        </div>
                        <div class="col-6">
                            {{$pago->descuento}}
                            <?php $total-=$pago->descuento;?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <span>Creado por</span>
                        </div>
                        <div class="col-6">
                            {{$pago->c_name}} {{$pago->c_lastname}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <span>Codigo</span>
                        </div>
                        <div class="col-6">
                            {{$pago->codigo}}
                        </div>
                    </div>
                    <br>
                @endif
                <h4 class="pago_section">TOTAL COMPRA</h4><span class="right_triangle"></span>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <h5>Total ($)</h5>
                    </div>
                    <div class="col-6">
                        <h5>{{$total}} $</h5>
                    </div>
                </div>
                <br>
                <h4 class="pago_section">DATOS DEL CLIENTE</h4><span class="right_triangle"></span>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <span>Nombre del cliente</span>
                    </div>
                    <div class="col-6">
                        {{$pago->name}} {{$pago->lastname}}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span>WhatsApp</span>
                    </div>
                    <div class="col-6">
                        {{$pago->ws}}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span>Nota Adicional</span>
                    </div>
                    <div class="col-6">
                        @if(isset($pago->nota_adicional))
                            {{$pago->nota_adicional}}
                        @endif
                    </div>
                </div>
                <br>
                <h4 class="pago_section">DATOS DEL PAGO</h4><span class="right_triangle"></span>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <span>Tipo de pago</span>
                    </div>
                    <div class="col-6">
                        <span style="text-transform: capitalize;" id="tipo_pago">{{$pago->tipo_trans}}</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span>Banco</span>
                    </div>
                    <div class="col-6">
                        <span style="text-transform: capitalize;" id="pago_banco">{{$pago->banco}}</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span>Cedula</span>
                    </div>
                    <div class="col-6">
                        <span style="text-transform: capitalize;" id="pago_cedula">{{$pago->cedula}}</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span># de referencia</span>
                    </div>
                    <div class="col-6">
                        <span style="text-transform: capitalize;" id="pago_referencia">{{$pago->referencia}}</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span>Monto</span>
                    </div>
                    <div class="col-6">
                        <span style="text-transform: capitalize;" id="pago_monto">{{$pago->monto}}</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span>Fecha</span>
                    </div>
                    <div class="col-6">
                        <span style="text-transform: capitalize;" id="pago_fecha">{{$pago->fecha}}</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span>Pago Verificado</span>
                    </div>
                    <div class="col-6">
                        <span style="text-transform: capitalize;" id="pago_ver">
                            @if($pago->verificado != 0)
                                <span class='fa fa-check text-success'></span>
                            @else
                                <span class='fa fa-lg fa-times text-danger'></span>
                            @endif
                        </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <span>Orden Entregada</span>
                    </div>
                    <div class="col-6">
                        <span style="text-transform: capitalize;" id="pago_ent">
                            @if($pago->entregado != 0)
                                <span class='fa fa-check text-success'></span>
                            @else
                                <span class='fa fa-lg fa-times text-danger'></span>
                            @endif
                        </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4" style=" display: flex;
                    justify-content: center;
                    flex-direction: column;">
                        <span >Capture</span>
                    </div>
                    <div class="col-6">
                        <img id="pago_capture" src="{{asset('img/'.$pago->image)}}" height="250" alt="">
                    </div>
                </div>
                <br>
                <div id="envio_div">
                    <h4 class="pago_section">DATOS DE ENVIO</h4><span class="right_triangle"></span>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <span>Empresa</span>
                        </div>
                        <div class="col-6">
                            <span style="text-transform: capitalize;" id="envio_emp">{{$pago->empresa}}</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <span>Destinatario</span>
                        </div>
                        <div class="col-6">
                            <span style="text-transform: capitalize;" id="envio_des">{{$pago->destinario}}</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <span>Cedula</span>
                        </div>
                        <div class="col-6">
                            <span style="text-transform: capitalize;" id="envio_ced">{{$pago->cedula_destinario}}</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <span>Dirección</span>
                        </div>
                        <div class="col-6">
                            <span style="text-transform: capitalize;" id="envio_dir">{{$pago->direccion}}</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <span>Teléfono</span>
                        </div>
                        <div class="col-6">
                            <span style="text-transform: capitalize;" id="envio_tel">{{$pago->telefono}}</span>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            
        </div>
    </div>







    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>




