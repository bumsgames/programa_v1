<!DOCTYPE html>
<html lang="en">

<head>
  <title>BumsGames Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->

  <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ url('css/datatables.min.css') }}">

  <!-- Font-icon css-->

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="icon" href="{{ url('img/LOGO.ico') }}" /> {{--
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css"
  /> --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">

  </script>


</head>

<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header id="headadmin" class="app-header"><a class="app-header__logo" href="/menu">Bums</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">

      {{-- @if(isset($precio_dolar_bumsgames))
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-usd" aria-hidden="true"></i>
    Precio dolar BumsGames: {{ number_format($precio_dolar_bumsgames, 0, ',', '.') }} Bs
  </a>
      </li>
      @endif --}}

      <li>
        <button type="button" class="btn btn-light btn-guia" data-toggle="modal" data-target=".modal_ayuda"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Guia y ayuda</button>
      </li>

      <!--Notification Menu-->
      <li class="dropdown"><a class="app-nav__item" style="width:72px;" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i> 

        @if( auth()->user()->unreadNotifications->count() >= 1)
        <span class="badge badge-light">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
        <span class="sr-only">unread messages</span></a>
        <ul class="app-notification dropdown-menu dropdown-menu-right">
          <li class="app-notification__title">You have {{ auth()->user()->unreadNotifications->count() }} new notifications.</li>
          <div class="app-notification__content">


            <div class="app-notification__content">
              @foreach(auth()->user()->unreadNotifications as $notification)
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                <div>
                 <p class="app-notification__body"><strong>{{ $notification->data['titulo'] }}</strong></p> 
                 <p class="app-notification__message">{{ $notification->data['data'] }}</p>
                 <br> 
                 <p class="app-notification__message">{{ $notification->data['data2'] }}</p>
                 <br> 
                 <p class="app-notification__meta">{{ $notification->created_at->diffForHumans() }}</p>
               </div></a></li>
               @endforeach
             </div>
           </div>
           <li class="app-notification__footer"><a href="{{ url('markAsRead') }}">Marcar notificaciones como leidas.</a></li>
         </ul>
       </li>
       <!-- User Menu-->
       <li class="dropdown"><a style="width:130px;" class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i> {{ Auth::user()->name }} {{ Auth::user()->lastname }}
       </a>
       <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="configurar_tu_user"><i class="fa fa-cog fa-lg"></i> Configurar</a></li>
          {{--
          <form action="/logout" method="post">
            {{ csrf_field() }}
            <button type="submit">Logout</button>
          </form> --}}
          <li><a class="dropdown-item" href="logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_carrito" style="background-color: black;">
        Carrito 
        <span id="cantCarrito">({{count($carrito)}})</span> 
      </button>

      {{-- <li class="nav-item">
        <div class="d-flex">
          <div class="dropdown mr-1">

            <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
              <label class="menu car" for="check">
                <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> 
                <span class="badge badge-light" id="badge2" style="color: black !important;">{{ count(Session::get('carrito_admin')) }}</span>  
              </label>
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <table class="table table-hover">
                <tbody id="tablaCarrito2">
                  
                  @if(Session::has('carrito_admin'))


                  @foreach( Session::get('carrito_admin') as $x )
                  <tr>
                    <th>
                      
                    </th>
                    <td>
                      <input autocomplete="off" type='text' class='id_articulo' value='{{ $x['id'] }}' hidden="">
                      {{ $x['articulo'] }} || {{ $x['categoria'] }}
                    </td>
                    <td class="columna_precio">
                      {{  number_format($x['precio'], 2, ',', '.') }} $
                      
                    </td>
                    <td>
                      <img src="img/{{ $x['imagen'] }}" width="40" height="45" alt="">
                    </td>
                    <td>
                      <button style="color: white !important;" type="button" class="close" onclick="borrarElementoCarrito({{ $i - 1 }}, 0, '$');">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </td>

                  </tr>

                  @endforeach

                  @endif
                  <tr>
                    <td>  
                    </td>
                    <td>  
                    </td>

                    <td>
                      @if($precio != 0)
                      <strong>Total:<br> {{ number_format($precio, 2, ',', '.')}} $</strong>
                      @endif

                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
              <button>Procesar compra</button>
            </div>
          </div>

        </div>
      </li> --}}
    </ul>
  </header>
  <!-- Modal -->
  <div class="modal fade" id="modal_carrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 650px !important;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Carrito de compras</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <table class="table table-hover" id="tableLyon">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Categorias</th>
                <th>Dueños</th>
                <th>Cantidad</th>
                <th>Precio</th>
              </tr>
            </thead>
            {{-- <tbody id="tablaCarrito2"> --}}
            <tbody id="tablaCarritoNew">
              <?php $i = 1; ?>
              <?php $precio = 0; ?>


             @if(@isset ($carrito))
              @foreach( $carrito as $item )
              <tr id="fila_{{$item->articulo->id}}">
                <th>

                  <?php echo $i++; ?>.
                </th>
                <th>
                  {{ $item->articulo->name }}
                </th>
                <th>
                  @foreach($item->articulo->categorias as $categoria)
                    {{ $categoria->category }}
                    <br>
                    <br>
                  @endforeach
                </th>
                <th>
                  @foreach($item->articulo->duennos as $duenno)
                    {{ $duenno->name }} {{ $duenno->lastname }}
                    <br>
                  @endforeach
                </th>
                <th>
                  {{ $item->cantidad }}
                </th>
                <th>
                  {{ $item->cantidad * $item->articulo->price_in_dolar }} $
                  <?php $precio = $precio + ($item->cantidad * $item->articulo->price_in_dolar); ?>
                </th>
              </tr>
              @endforeach
              <tr id="carritoTotal">
                <th>
                  
                </th>
                <th>
                  
                </th>
                <th>
                  
                </th>
                <th>

                </th>
                <th>
                  Total:
                </th>
                <th>
                  {{$precio}} $
                </th>
              </tr>
             @endif


            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          
          <button id="cancelarCompraAdmin" type="button" class="btn btn-secondary" 
          data-dismiss="modal" onclick="BorrarTodoCarro_admin();" @if(count($carrito)==0) style="display:none;" @endif>
            Cancelar carrito
          </button>
          
          <a id="procederCompraAdmin" href="{{ url('facturacion') }}" @if(count($carrito)==0) style="display:none;" @endif >
            <button type="button" class="btn btn-primary">Proceder compra</button>
          </a>

        </div>
      </div>
    </div>
  </div>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ url('img/'.Auth::user()->image) }}" alt="User Image" width="50" height="52">
      <div>
        <p class="app-sidebar__user-name">{{ Auth::user()->name }} {{ Auth::user()->lastname }}
        </p>
        <p class="app-sidebar__user-designation">Gamer Profesional</p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item" href="{{ url('/menu') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Menu Principal</span></a></li>

      @if(Auth::user()->level >= 10)
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>

        <ul class="treeview-menu">
          <li><a class="treeview-item" href="menu_usuario"><i class="icon fa fa-circle-o"></i>Menu Usuario</a></li>
        </ul>
      </li>
      @endif @if(Auth::user()->level >= 7)
      <!--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Ventas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @if(Auth::user()->level >= 9)
          <li><a class="treeview-item" href="{{ url('ventas') }}"><i class="icon fa fa-circle-o"></i>Todas las ventas</a></li>
          @endif
          <li><a class="treeview-item" href="{{ url('ventas_mias') }}"><i class="icon fa fa-circle-o"></i>Mis ventas</a></li>
        </ul>
      </li>-->
      @endif
      {{-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Cuentas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @if(Auth::user()->level >= 10)
          <li><a class="treeview-item" href="cuentas_todas"><i class="icon fa fa-circle-o"></i> Cuentas Todas</a></li>
          @endif
          <li><a class="treeview-item" href="cuentas"><i class="icon fa fa-circle-o"></i> Cuentas Mias</a></li>
        </ul>
      </li> --}}
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Articulos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="{{ url('formulario_registrar_articulo') }}"><i class="icon fa fa-circle-o"></i> Registrar Articulo</a></li>
          {{--
            <li><a class="treeview-item" href="{{ url('categoria_articulo_admin') }}"><i class="icon fa fa-circle-o"></i> Articulos por categoria</a></li>--}}

            <li><a class="treeview-item" href="{{ url('allArticles') }}"><i class="icon fa fa-circle-o"></i> Articulos Disponibles</a></li>
          {{--
          <li><a class="treeview-item" href="{{ url('allArticlesOff') }}"><i class="icon fa fa-circle-o"></i> Articulos Agotados</a></li>
          --}} {{--
          <li><a class="treeview-item" href="allArticlesPS3"><i class="icon fa fa-circle-o"></i> Articulos de ps3</a></li> --}}
          <li><a class="treeview-item" href="{{ url('misArticles') }}"><i class="icon fa fa-circle-o"></i> Mis Articulos</a></li>
          <li><a class="treeview-item" href="{{ url('misArticles_lista_escrita') }}" target="_blank"><i class="icon fa fa-circle-o"></i> Mis Articulos (lista escrita)</a></li>
          <li><a class="treeview-item" href="{{ url('modo_ml') }}"><i class="icon fa fa-circle-o"></i> Modo Mercadolibre</a></li>
          <li><a class="treeview-item" href="{{ url('articles_web') }}"><i class="icon fa fa-circle-o"></i> Articulos en la Pagina Web</a></li>
          <li><a class="treeview-item" href="{{ url('articulosSinImagen') }}"><i class="icon fa fa-circle-o"></i> Articulos Sin Imagenes</a></li>
          <li><a class="treeview-item" href="{{ url('articulosSinPeso') }}"><i class="icon fa fa-circle-o"></i> Articulos Sin Peso</a></li>
          <li><a class="treeview-item" href="{{ url('inventario') }}"><i class="icon fa fa-circle-o"></i> Inventario</a></li>
        </ul>
      </li>
      {{-- @if(Auth::user()->level >= 7)
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Ordenes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/envios"><i class="icon fa fa-circle-o"></i> Paquetes por Enviar.</a></li>
          <li><a class="treeview-item" href="/Arecibir"><i class="icon fa fa-circle-o"></i> Paquetes por recibir.</a></li>
        </ul>
      </li>
      @endif --}}
     {{--  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Ventas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @if(Auth::user()->level >= 9)
          <li><a class="treeview-item" href="/movimientos"><i class="icon fa fa-circle-o"></i>Ventas Generales</a></li>
          @endif
          <li><a class="treeview-item" href="/movimientos_personal"><i class="icon fa fa-circle-o"></i>Mis ventas</a></li>
          
          <li><a class="treeview-item" href="/movimientos_tuyos"><i class="icon fa fa-circle-o"></i>Movimientos Personales (Generales)</a></li>
          
        </ul>
      </li> --}}

       <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Ventas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @if(Auth::user()->level >= 9)
          <li><a class="treeview-item" href="{{ url('ver_ventas') }}"><i class="icon fa fa-circle-o"></i>Ventas Generales</a></li>
          @endif
          <li><a class="treeview-item" href="/movimientos_personal"><i class="icon fa fa-circle-o"></i>Mis ventas</a></li>
          
          <li><a class="treeview-item" href="/movimientos_tuyos"><i class="icon fa fa-circle-o"></i>Movimientos Personales (Generales)</a></li>
          
        </ul>
      </li>


      @if(Auth::user()->level >= 7)
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Clientes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @if(Auth::user()->level >= 9)
          <li><a class="treeview-item" href="/clientes"><i class="icon fa fa-circle-o"></i>Clientes totales</a></li>
          @endif
          <li><a class="treeview-item" href="/mis_clientes"><i class="icon fa fa-circle-o"></i> Mis clientes</a></li>

        </ul>
      </li>
      @endif
     {{--  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Noticias</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/noticias/crear"><i class="icon fa fa-circle-o"></i>Agregar Noticia</a></li>
          <li><a class="treeview-item" href="/noticias"><i class="icon fa fa-circle-o"></i> Ver Noticias</a></li>
        </ul>
      </li> --}}
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Encuesta</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/encuestas/crear"><i class="icon fa fa-circle-o"></i>Agregar Encuesta</a></li>
          <li><a class="treeview-item" href="/encuestas"><i class="icon fa fa-circle-o"></i> Ver Encuestas</a></li>
        </ul>
      </li>
      <li>
        <a class="app-menu__item" href="/cupones">
          <i class="app-menu__icon fa fa-dashboard"></i>
          <span class="app-menu__label">Cupones</span>
        </a>
      </li>
      <!--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Tareas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                  <ul class="treeview-menu">
                    @if(Auth::user()->level >= 7)
                    <li><a class="treeview-item" href="homework"><i class="icon fa fa-circle-o"></i>Generales</a></li>
                    @endif
                    <li><a class="treeview-item" href="individual_duties"><i class="icon fa fa-circle-o"></i>Mis tareas</a></li>
                  </ul>
                </li>-->
                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">Comentarios &nbsp;      
                 @if(isset($comments_por_aprobar))
                 <span class="badge badge-light">{{ $comments_por_aprobar->count() }}</span>
                 @endif
               </span><i class="treeview-indicator fa fa-angle-right"></i></a>

               <ul class="treeview-menu">
                <li><a class="treeview-item" href="/comentariosall"><i class="icon fa fa-circle-o"></i>Todos los comentarios</a></li>
                <li><a class="treeview-item" href="/comentariospendientes"><i class="icon fa fa-circle-o"></i>Comentarios por aprobar</a></li>
                <li><a class="treeview-item" href="/comentariosaprobados"><i class="icon fa fa-circle-o"></i>Comentarios aprobados</a></li>
                <li><a class="treeview-item" href="/comentariosrechazados"><i class="icon fa fa-circle-o"></i>Comentarios rechazados</a></li>
              </ul>
            </li>
            {{-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-handshake-o"></i>
              <span class="app-menu__label">Ofertas de Clientes &nbsp;       
                <span class="badge badge-light">{{ \Bumsgames\Oferta::where('estado','0')->count() }}</span>
              </span><i class="treeview-indicator fa fa-angle-right"></i></a>

              <ul class="treeview-menu">
                <li><a class="treeview-item" href="/ofertas_cliente"><i class="icon fa fa-circle-o"></i>Ofertas por revisar</a></li>
                <li><a class="treeview-item" href="/ofertas_cliente_aprobadas"><i class="icon fa fa-circle-o"></i>Ofertas aprobadas</a></li>
                <li><a class="treeview-item" href="/ofertas_cliente_rechazadas"><i class="icon fa fa-circle-o"></i>Ofertas rechazadas</a></li>
              </ul>
            </li> --}}
            <li>
              <a class="app-menu__item" href="/pago_cliente"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Pago de Clientes &nbsp; 
                  @if(isset($pago_sin_confirmar))
                  <span class="badge badge-light">{{ $pago_sin_confirmar->count() }}</span>
                  @endif
                </span>
              </a>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Formulario</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="{{ url('ubicacion') }}"><i class="icon fa fa-circle-o"></i>Ubicacion</a></li>
          <li><a class="treeview-item" href="{{ url('bancoEmisor') }}"><i class="icon fa fa-circle-o"></i>Banco emisor</a></li>
        </ul>
      </li>
      <li>
        
      </li>
            <!--<li><a class="app-menu__item" href="reporte"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Reporte</span></a></li>-->
     {{--  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Imagenes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/imagenes"><i class="icon fa fa-circle-o"></i>Todas las imagenes</a></li>
        </ul>
      </li> --}}

      <li hidden=""><a class="app-menu__item" href="/guia"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Guia BumsGames</span></a></li>
      <li><a class="app-menu__item" href="{{ url('portal') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Imagenes del Portal</span></a></li>
    </ul>
  </aside>
  <style>
  @media(max-width:478px) {
    #headadmin {
      overflow-x: scroll;
    }
  }
</style>
  @include('layouts.modal_ayuda') @yield('content') {{--
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> --}}
  <script src="{{ url('js/jquery3.min.js') }}"></script>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/bums.js') }}"></script>
  <script src="{{ url('js/bums_v2.js') }}"></script>
  <script src="{{ asset('js/genesis.js') }}"></script>
  <!-- Essential javascripts for application to work-->
  {{--
    <script src="js/jquery-3.2.1.min.js"></script> --}}
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/datatables.min.js') }}"></script>
    <script src="{{ url('js/datatables-bootstrap.min.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>
    <script src="{{ url('js/plugins/pace.min.js') }}"></script>
  {{--
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script> --}}
  <!-- The javascript plugin to display page loading on top-->
  {{--
    <script src="js/plugins/pace.min.js"></script> --}}
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
  {{--
  <script type="text/javascript">
    if(document.location.hostname == 'pratikborsadiya.in') {
               (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
               })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
               ga('create', 'UA-72504830-1', 'auto');
               ga('send', 'pageview');
             }
           </script> --}}
           <script src="{{url('js/sweet.min.js')}}"></script>
  {{--
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}} @yield("scripts")

  </body>

  </html>