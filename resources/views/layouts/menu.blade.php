

@extends('layouts.bums', ['tutoriales' => $tutoriales])

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i>Menu principal</h1>
      <p>Llegamos para hacer la diferencia</p>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg">
      <div class="tile">
        <h6>Mejor vendedor del dia</h6>
        <?php $i = 0; ?>
        <?php $contador = -1; ?>
        @foreach($mejor_vendedores_hoy as $vendedor)
        <?php if($contador != $vendedor->ventas){
          $i++;
          $contador = $vendedor->ventas;
        } 
        echo $i;  ?>. {{ $vendedor->name }} {{ $vendedor->lastname }}. Ventas: {{ $vendedor->ventas }}
        <br>
        <br>  
        @endforeach
      </div>
      
    </div>
    <div class="col-12 col-lg">
      <div class="tile">
        <h6>Mejor vendedor de la semana</h6>
        <?php $i = 0; ?>
        <?php $contador = -1; ?>
        @foreach($mejor_vendedores_semana as $vendedor)
        <?php if($contador != $vendedor->ventas){
          $i++;
          $contador = $vendedor->ventas;
        } 
        echo $i;  ?>. {{ $vendedor->name }} {{ $vendedor->lastname }}. Ventas: {{ $vendedor->ventas }}
        <br>
        <br>  
        @endforeach
      </div>

    </div>
    <div class="col-12 col-lg">
      <div class="tile">
        <h6>Articulo mas vendido del dia</h6>
        <?php $i = 0; ?>
        <?php $contador = -1; ?>
        @foreach($articulo_mas_vendido_hoy as $articulo)
        <?php if($contador != $articulo->ventas){
          $i++;
          $contador = $articulo->ventas;
        } 
        echo $i;  ?>. {{ $articulo->name }} || {{ $articulo->category }}. Ventas: {{ $articulo->ventas }}
        <br>
        <br> 
        @endforeach
      </div>
    </div>
    <div class="col-12 col-lg">
      <div class="tile">
        <h6>Articulo mas vendido de la semana</h6>
        <?php $i = 0; ?>
        <?php $contador = -1; ?>
        @foreach($articulo_mas_vendido_semana as $articulo)
        <?php if($contador != $articulo->ventas){
          $i++;
          $contador = $articulo->ventas;
        } 
        echo $i;  ?>. {{ $articulo->name }} || {{ $articulo->category }}. Ventas: {{ $articulo->ventas }}
        <br>
        <br>  
        @endforeach
      </div>
    </div>
  </div>
  <div class="row"> 
  <div class="col-12 col-lg-3">
      <div class="tile">
        <h5>Valor de las monedas: </h5>
        <br>  
        @foreach($coins as $coin)
        <h6>{{ $coin->coin }}</h6>
        <form action="cambiar_valor" method="post">
          {{ csrf_field() }}
          <label for="  ">1$ = {{ $coin->valor }} {{ $coin->sign }}</label>
          <br>  
          <input type="text" name="valor" autocomplete="off">
          <button name="id" value="{{ $coin->id }}">Guardar</button>
          <br>  
          <br>  
        </form>
        @endforeach 
      </div>
    </div>
    <div class="col-12 col-lg-9">
      <div style="max-height:500px; overflow-y:scroll" class="tile">
        <h6>Ultimos articulos agregados</h6>
        <?php $i = 0; ?>
        <?php $contador = -1; ?>
        @foreach($articulo_agregados_recientemente as $articulo)
        <?php 
        $i++;

        echo $i;  ?>. <strong>Articulo: </strong>{{ $articulo->name }} || {{ $articulo->pertenece_category->category }}. <strong>Agregado por:</strong> {{ $articulo->pertenece_id_creator->name }} {{ $articulo->pertenece_id_creator->lastname }} ({{ $articulo->created_at->diffForHumans() }})
        <br>
        <br> 
        @endforeach
      </div>
    </div>
  </div>
  <div class="row" id="graficos">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body" style="word-break: break-all;">
          <center>
            <div class="container"> 
              <canvas id="line-chart2" height="75"></canvas>
            </div>
            <br> 
            <br>  
            <div class="container"> 
              <canvas id="line-chart" height="75"></canvas>
            </div>
          </center>
          <br> 
          <br>       
        </div>

      </div>
    </div>
  </div>
</main>
<style>
@media(max-width:767px){
                #graficos{
                  display:none;
                }    
}
                  </style>
<script src="{{ url('js/jquery3.min.js') }}" ></script>
<script> 
  var route = "/visitas";
  var intervalos = new Array();
  var visitas = new Array();
  var intervalos_fecha = new Array();
  var visitas_fecha = new Array();
  $.get(route, function(data){
    intervalos = JSON.parse(data.intervalos);
    visitas = JSON.parse(data.visitas);
    

    new Chart(document.getElementById("line-chart"), {
      type: 'line',
      data: {
        labels: intervalos,
        datasets: [{ 
          data: visitas,
          label: "General",
          borderColor: "#3e95cd",
          fill: false
        }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Visitas del dia en Intervalos de tiempo determinado'
        }
      }
    });

    intervalos = JSON.parse(data.intervalos_fecha);
    visitas    = JSON.parse(data.visitas_fecha);

    new Chart(document.getElementById("line-chart2"), {
      type: 'line',
      data: {
        labels: intervalos,
        datasets: [{ 
          data: visitas,
          label: "General",
          borderColor: "#3e95cd",
          fill: false
        }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Visitas de BumsGames.com.ve durante todo el Mes'
        }
      }
    });
  });  
</script>
@endsection