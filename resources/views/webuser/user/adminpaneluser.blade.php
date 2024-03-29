@extends('layouts.plantillaWeb') 
@section('content')
<br>
<br>
<style>
.btn-categorias {
    margin: 20px;
    padding: 10px !important;
}

.fondoBlanco {
    color: black !important;
    background: white !important;
}
</style>
<div class="">

    <div class="tile fondoBlanco sidebarpanel" style="padding-left:0">


        <br>
        <style>
        .list-group .active {
            background: #ff0005;
            border: none !important;
            opacity: 0.8 !important;
        }

        .hr_negro {
            border: 1px black solid;
        }
    </style>
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="container-fluid">
                <div class="list-group group-panel" id="list-tab" role="tablist">
                  <span class="list-group-item panel-item-main " style="border: none; color: gray;">
                    <div class="row">
                        <div class="col-2">    
                            <i style="vertical-align:-100%; color: #0080c7;" class="fa fa-user fa-lg"></i> 
                        </div>
                        <div class="col-10"> 
                            <strong style="color: black;">Mi cuenta</strong><br>
                            Bienvenido, {{$user->name}} {{$user->lastname}}<br>
                        </div>
                    </div>
                </span>
                <a class="list-group-item list-group-item-action panel-item" href="{{ url('adminpaneluser') }}"
                role="tab" aria-controls="principal">Mis compras</a>

                <a class="list-group-item list-group-item-action panel-item" href="{{ url('mis_juegos_digitales') }}">Mis Juegos Digitales</a>
                <a class="list-group-item list-group-item-action panel-item" href="{{ url('favoritos_cliente') }}">Favoritos</a>
                <a class="list-group-item list-group-item-action panel-item" href="{{ url('ver_ofertas_clientes') }}">Ofertas Realizadas</a>
                <a class="list-group-item list-group-item-action panel-item" href="{{ url('configuracion_cliente') }}">Configuración</a>
                @include('modal.comment')
                <br>
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#commentModal">
                    APOYANOS CON TU OPINION    
                </button>

            </div>
        </div>
        <br>
        <br>

    </div>
    <div class="col-12 col-lg-10">
        <div class="container">
            <div class="tab-content letraNegra ayudabody" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-principal" role="tabpanel" aria-labelledby="list-principal-list">
                    
                    @if (Auth::guard('client')->user()->confirmed==0 && isset(Auth::guard('client')->user()->email))
                        <div class="alert alert-danger mb-4" style="font-size: 24pt" role="alert">
                            Su cuenta no ha sido verificada, verifiquela o en 7 dias sera borrada. 
                            <a href="{{ url('sendVerify') }}">Reenviar Correo</a>
                        </div>
                    @endif
                    @if (\Session::has('resend'))
                        <div class="alert alert-success" style="font-size: 24pt">
                            {!! \Session::get('resend') !!}
                        </div>
                    @endif
                    @yield('contenido_cliente')
            </div>
        </div>
        </div>
    </div>


</div>

</div>
@endsection