

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
    <style>
    
      .div-recientes::-webkit-scrollbar-track
      {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
      }
  
      .div-recientes::-webkit-scrollbar
      {
        width: 12px;
        background-color: #F5F5F5;
      }
  
      .div-recientes::-webkit-scrollbar-thumb
      {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #888;
      }
      </style>
    <div class="col-12 col-lg">
      <div style="max-height:500px;padding:0" class="tile">
        <h6 style="padding:20px 20px 0 20px">Articulos recientes (llegaron a stock)</h6>
        <div class="div-recientes" style="overflow-y:scroll;max-height:450px;padding-left:20px;padding-bottom:20px">
          <?php $i = 0; ?>
          <?php $contador = -1; ?>
          @foreach($articulo_agregados_recientemente as $articulo)
          <?php 
          $i++;

          echo $i;  ?>. <img class="img_vermas" width="30" height="30" src="{{ url('img/'.$articulo->fondo) }}"> <strong>Articulo: </strong>{{ $articulo->name }} || {{ $articulo->pertenece_category->category }}. {{ $articulo->price_in_dolar }} $
          <br> 
          <b>({{ $articulo->ultimo_agregado }})</b>
          <br>
          <br> 
          @endforeach
        </div>

      </div>
    </div>
    <div class="col-12 col-lg">
        <div  style="max-height:500px;padding:0" class="tile">
            <h6 style="padding:20px 20px 0 20px">Ultimos articulos registrados (Articulos registrados) </h6>
            <div class="div-recientes" style="overflow-y:scroll;max-height:450px;padding-left:20px;padding-bottom:20px">
              <?php $i = 0; ?>
              <?php $contador = -1; ?>
              @foreach($articulo_registrado_recientemente as $articulo)
              <?php 
              $i++;
    
              echo $i;  ?>. <img class="img_vermas" width="30" height="30" src="{{ url('img/'.$articulo->fondo) }}"> <strong>Articulo: </strong>{{ $articulo->name }} || {{ $articulo->pertenece_category->category }}. 
<br>
              <strong>Agregado por:</strong> {{ $articulo->pertenece_id_creator->name }} {{ $articulo->pertenece_id_creator->lastname }} ({{ $articulo->created_at->diffForHumans() }})
              <br>
              <br> 
              @endforeach
            </div>
    
          </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div style="overflow-y:scroll" class="tile">
            <h6 style="color: red;">Articulos agotados: {{ $articles_off->count() }}</h6>
            <div class="custom-control my-1 mr-sm-2">
              <input autocomplete="off" type="text" placeholder="Buscar" class="form-control" name="coincidencia" id="buscador1">
            </div>
            <br>  

            <br>
            <div class="table">
              <?php $i=1; ?>
              <table class="table">
     <?php $i=1; ?>
<thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Informacion</th>  
                    <th scope="col">Informacion Extra</th>
                    <th scope="col">Botones</th>
                  </tr>
                </thead>
 <tbody>
                  @foreach($articles_off as $article)
                  <tr>
                    <th scope="row">
                      <?php echo $i++; ?>.
                    </th>
                    <td>
                      <img class="img_vermas" width="50" height="50" src="{{ url('img/'.$article->fondo) }}">
                    </td>
                    <td>
                      {{$article->name}}
                      <br>  
                      <br>  
                      <strong>
                        Categoria: 
                      </strong>
                      <br>  
                      {{ $article->pertenece_category->category }}
                      <br>
                      <br>
                    </td>
                    
                    <td>  
                      <strong>Cantidad: </strong>
                      <br>  
                      {{ $article->quantity }} 
                      <br>  
                      <br>
                      <strong>Precio: </strong>
                      <br>  
                      {{ $article->price_in_dolar }} $
                      <br>  
                      <br>
                    </td>
                    <td>
                      <strong>Ultima actualizacion: </strong>
                      <br>  
                      {{ $article->updated_at->diffForHumans() }}
                      <br>
                      <br>
                      <form action="/buscar_articulo" method="post" target="_blank">
                        <input name="_token" id="token" value="{{ csrf_token() }}" hidden="">
                        <input type="text" hidden="" value="{{ $article->id }}" name="id_art">
                        <button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="" value="" Onclick="">Modificar</button>
                      </form>
                    </td>
              </tr>
              @endforeach
          </tbody>
</table>
      </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      
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