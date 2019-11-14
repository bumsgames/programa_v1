<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Bumsgames\Http\Requests\ArticleRequest;
use Bumsgames\Notifications\TaskCompleted;
use Bumsgames\BumsUser;
use DB;
use Carbon\Carbon;
use Image;


class ArticleController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
  {
    //
  }

  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function create()
  {
    //
  }

  function notificacion_para_todos_level9($titulo, $data, $data2)
  {
    $users = BumsUser::where('level', '>=', '9')->get();
    foreach ($users as $user) {
      $user->notify(new TaskCompleted($titulo, $data, $data2));
    }
  }

  function notificacion_para_todos_level7($titulo, $data, $data2)
  {
    $users = BumsUser::where('level', '>=', '7')->get();
    foreach ($users as $user) {
      $user->notify(new TaskCompleted($titulo, $data, $data2));
    }
  }

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


  /*
  -------------------------------------
      Agrega un articulo
  -------------------------------------
  */

  // ArticleRequest // REGISTRAR ARTICULO
  public function store(ArticleRequest $request)
  {
    $mensaje = "";


    //$images = $request->images;
    //return response()->json($request->images);

    // Tama;o maximo de imagen 100 kb
    $this->validate($request, [
      'image' => 'nullable|max:100',
      //'fondo' => 'nullable|max:100',
    ]);

    $id_categorias = json_decode($request->id_categorias);
    $categoria = \Bumsgames\Category::find($id_categorias[0]);

    $nombre_categoria = $categoria->category;

    $searchterm = "Cuenta Digital";
    $searchterm2 = "Cupo Digital";
    $pos = strrpos( $nombre_categoria, $searchterm);
    $pos2 = strrpos( $nombre_categoria, $searchterm2);



    // Verificar si es Articulo Cuenta Digital o Cupo Digital que no haya otro Articulo de esa misma categoria con el mismo Correo
    if (($pos !== false && strlen($searchterm) + $pos == strlen($nombre_categoria)) || 
      ($pos2 !== false && strlen($searchterm2) + $pos2 == strlen($nombre_categoria))) {

 // verificar si hay otro articulo con ese mismo correo y misma categoria
      $art = \Bumsgames\Article::
    leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
    ->where('email', $request->email)
    ->where('articulo_categorias.id_categoria', $id_categorias[0])
    ->get();


    if ($art->count() >= 1) {
      return response()->json([
        "tipo" => "1",
        "data" => "Este articulo digital ya ha sido registrado con este mismo correo.\n\n\n Correo: " . $request->email . " para esta categoria. ",
      ]);
    }
  }
  

  // Validacion Oferta
  if($request->offer_price){
    if (($request->offer_price <= $request->price_in_dolar)) {
      return response()->json([
        "tipo" => "1",
        "data" => "El precio subrayado no puede ser menor o igual al precio de Venta (unitario).\n\n\nPrecio Unitario: " . $request->price_in_dolar . " $.\n\nPrecio de subrayado: " . $request->offer_price . " $",
      ]);
    }
  }

    // No numero negativo en Inversion, Precio u Oferta
  if (($request->costo < 0) && ($request->price_in_dolar < 0) && ($request->offer_price < 0)) {
    return response()->json([
      "tipo" => "1",
      "data" => "Existen montos con Saldo Negativo. Articulo NO Registrado",
    ]);
  }

    // tomar todos los articulos donde tengan ese mismo nombre y categoria
  $todas_categorias = '';

  for ($i = 0; $i < count($id_categorias); $i++) {
    $art = \Bumsgames\Article::
    leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
    ->where('name', $request->name)
    ->where('articulo_categorias.id_categoria', $id_categorias[$i])
    ->get();

    $categoria = \Bumsgames\Category::find($id_categorias[0]);
    $nombre_categoria = $categoria->category;
    $todas_categorias .= $nombre_categoria.' ';

  // if (($art->count() == 0 && $request->quantity >= 1) || ($art->sum('quantity') == 0 && $request->quantity >= 1)) {
    if ($art->sum('quantity') == 0 && $request->quantity >= 1) {
      $titulo = 'LLEGO ESTE ARTICULO A STOCK';
      $data = "Articulo: " . $request->name;
      $data2 = "Categoria: " . $nombre_categoria;
      $users = BumsUser::where('level', '>=', '7')->get();
      $this->notificacion_para_todos_level7($titulo, $data, $data2);

      $request->request->add(['ultimo_agregado' => Carbon::now()]);
    } 


    $temporal =  \Bumsgames\Article::
    leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
    ->where('name', $request->name)
    ->where('articulo_categorias.id_categoria', $id_categorias[$i])
    ->get();
    
    // cambiando precio de todas las coincidencias con misma categoria
    foreach ($temporal as $x) {
      $algo = \Bumsgames\Article::find($x->id_articulo);
      if ($request->price_in_dolar < $x->price_in_dolar) {
        $algo->fill(['ultimo_agregado' => Carbon::now()]);
      }
      $algo->fill(['price_in_dolar' => $request->price_in_dolar]);
      $algo->save();

// cambio de imagen
      // if (!isset($imagentodos) && $x->fondo != 'fondo_nada.jpg') {
      //   $imagentodos = $x->fondo;
      // }
    }
  }

    // crea la notificacion
  $titulo = 'ARTICULO AGREGADO POR: ' . auth()->user()->name . ' ' . auth()->user()->lastname;
  $data = "Articulo: " . $request->name . ". Cantidad: " . $request->quantity ;
  $data2 = "Categoria(s): " . $todas_categorias;
  $this->notificacion_para_todos_level9($titulo, $data, $data2);

  
  // crea el articulo
  if ($request->ajax()) {
    $articulo = \Bumsgames\Article::create($request->all());
  }


  //Articulos mismo nombre e id
  

  

    // crea a quien pertenece el juego
  $id_articulo = $articulo->id;
  $id_bumsuser = json_decode($request->id_bumsuser);
  $porcentaje = json_decode($request->porcentaje);

  for ($i = 0; $i < count($id_bumsuser); $i++) {
    \Bumsgames\BumsUser_Article::create([
      'id_bumsuser' => $id_bumsuser[$i],
      'id_article' => $id_articulo,
      'porcentaje' => $porcentaje[$i]
    ]);
  }

    // AGREGAR CATEGORIAS AL ARTICULO, mensaje cuanto articulos hay de cada categoria
  $id_categorias = json_decode($request->id_categorias);

  for ($i = 0; $i < count($id_categorias); $i++) {
    \Bumsgames\Articulo_Categoria::create([
      'id_articulo' => $id_articulo,
      'id_categoria' => $id_categorias[$i]
    ]);


    
    $cantidad = \Bumsgames\Article::
    selectRaw('name, categories.category, sum(quantity) as cantidad')
    ->leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
    ->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')
    ->where('articles.id', '!=', '2')
    ->where('name', $request->name)
    ->where('articulo_categorias.id_categoria', $id_categorias[$i])
    ->groupBy('name', 'categories.category')
    ->get();

    $mensaje .= "Articulo: ".$cantidad[0]->name . ". Categoria: ".$cantidad[0]->category. ". \nCantidad en Sistema: ".$cantidad[0]->cantidad."\n\n";
  }

    //guardo ubicacion 
  $articulo->ubicacion =  $request->ubicacion;
  $articulo->save();


  // return $articulo;


  //  $file = $request->file('image');
  //   //$file = $request->images;

  // // $name = Carbon::now()->day . $file->getClientOriginalName();

  // $image = new \Bumsgames\Image;
  // $image->numero = $request->number;
  // $image->file = $name;
  // $image->save();

  // \Storage::disk('local')->put($name, \File::get($file));

  // \Bumsgames\Article_Image::create([
  //   'article_id' => $request->article_id,
  //   'image_id' => $image->id
  // ]);
  // return response()->json(["se guardo la imagen"=>$image]);

  $mensaje .= "bien";
  // return $articulo;
  return response()->json([
    "articulo" => $articulo,
    "articuloID" => $articulo->id,
    "data" => $mensaje,
  ]);
}

public function fotoMultiple(Request $request){
  $articulos_referencia = \Bumsgames\Article::find($request->article_id);
  // dd($articulos_referencia->name);
  $id_categoria = $articulos_referencia->categorias[0]->id;

  $articulos_coincidencia = \Bumsgames\Article::
  where('name', 'like', '%' . $articulos_referencia->name . '%')
  ->whereHas('categorias', function($q) use ($id_categoria) {
    $q->where('categories.id', '=', $id_categoria); 
  })
  ->get();

  // guardo imagen
  $file = $request->file('image');
  $name = Carbon::now()->second . $file->getClientOriginalName();

  $image = new \Bumsgames\Image;
  $image->numero = $request->number;
  $image->file = $name;
  $image->save();

  \Storage::disk('local')->put($name, \File::get($file));

  $image = Image::make(\Storage::disk('local')->get($image->file));
  
  $image->resize(250, null, function ($constraint) {
    $constraint->aspectRatio();
    $constraint->upsize();
  });

  //\Storage::disk('local')->put($name, \File::get($file));
  \Storage::disk('local')->put($name, (string) $image->encode('jpg', 30));

  foreach ($articulos_coincidencia as $articulo) {
    \Bumsgames\Article_Image::create([
      'article_id' => $articulo->id,
      'image_id' => $image->id
    ]);
  }
  
  return response()->json(["se guardo la imagen"=>$image]);
}


// public function fotoMultiple(Request $request){
//     dd($request->all());
//   $file = $request->file('image');
//     //$file = $request->images;

//   $name = Carbon::now()->day . $file->getClientOriginalName();

//   $image = new \Bumsgames\Image;
//   $image->numero = $request->number;
//   $image->file = $name;
//   $image->save();

//   \Storage::disk('local')->put($name, \File::get($file));

//   \Bumsgames\Article_Image::create([
//     'article_id' => $request->article_id,
//     'image_id' => $image->id
//   ]);
//   return response()->json(["se guardo la imagen"=>$image]);
// }

public function fotoMultipleMod(Request $request){
  $articleID=$request->article_id;
  $articulo =  \Bumsgames\Article::where('id', '=', $request->article_id)->first();
  $images = $articulo->images;
  //dd($articulo->toArray());

  if($request->index==0 && count($images)>0){
    foreach ($images as $image) {
      \Bumsgames\Article_Image::where('article_id', '=', $request->article_id)->where('image_id', '=', $image->id)->delete();
      $image->delete();
    }
  }

  $file = $request->file('image');
  $name = Carbon::now()->second . $file->getClientOriginalName();

  $image = new \Bumsgames\Image;
  $image->numero = $request->number;
  $image->file = $name;
  $image->save();

  \Storage::disk('local')->put($name, \File::get($file));

  $image = Image::make(\Storage::disk('local')->get($image->file));
  
  $image->resize(250, null, function ($constraint) {
    $constraint->aspectRatio();
    $constraint->upsize();
  });

  \Storage::disk('local')->put($name, (string) $image->encode('jpg', 30));

  \Bumsgames\Article_Image::create([
    'article_id' => $request->article_id,
    'image_id' => $image->id
  ]);

  return response()->json(["se guardo la imagen"=>$image]);
}

public function eliminarFotosArticulo(Request $request){

  $articulo =  \Bumsgames\Article::where('id', '=', $request->article_id)->first();
  $images = $articulo->images;
    //dd($articulo->toArray());

  foreach ($images as $image) {
    \Bumsgames\Article_Image::where('article_id', '=', $request->article_id)->where('image_id', '=', $image->id)->delete();
    $image->delete();
  }

  return response()->json(["se eliminaron las imagenes de"=>$articulo]);
}

   /*
  -------------------------------------
      cambiar contraseña
  -------------------------------------
  */

  public function cambia_password($category, $email, $password, $nickname)
  {
    switch ($category) {
        // PlayStation 4 Primario | Cuenta Digital
      case 1:
        //cambiando clave juego ps3
      $temp = \Bumsgames\Article::where('articles.email', '=', $email)
      ->where('articles.category', 5)
      ->first();
      if (isset($temp)) {
        $temp->fill(['password' => $password]);
        $temp->fill(['nickname' => $nickname]);
        $temp->save();
      }

      $temp = \Bumsgames\Article::where('articles.email', '=', $email)
      ->where('articles.category', 2)
      ->get();

      foreach ($temp as $x) {
        $articulo = \Bumsgames\Article::where('articles.id', '=', $x->id)
        ->first();

        $articulo->fill(['password' => $password]);
        $articulo->fill(['nickname' => $nickname]);
        $articulo->save();

        $res = \Bumsgames\PerteneceCliente::where('id_article', '=', $x->id)
        ->get();

        if ($res->count() > 0) {
          foreach ($res as $pertenencia) {
            $titulo = 'CAMBIARON LA CLAVE DE ESTE JUEGO SECUNDARIO PS4';
            $data = "Articulo: " . $articulo->name . ". Correo: " . $articulo->email . '. Password: ' . $articulo->password;
            $data2 = "Cliente: " . $pertenencia->cliente->name . " 
            " . $pertenencia->cliente->lastname . ". 
            Contacto: " . $pertenencia->cliente->num_contact;
            $this->notificacion_para_todos_level7($titulo, $data, $data2);

            \Bumsgames\Reporte::create([
              'type_reporte' => 'Reporte',
              'titulo_reporte' => $titulo,
              'descripcion_reporte' => $data . ' || ' . $data2
            ]);
          }
        }
      }
      break;

        // PlayStation 4 Secundario | Cuenta Digital
      case 2:
        //cambiando clave juego ps3
      $temp = \Bumsgames\Article::where('articles.email', '=', $email)
      ->where('articles.category', 5)
      ->first();
      if (isset($temp)) {
        $temp->fill(['password' => $password]);
        $temp->fill(['nickname' => $nickname]);
        $temp->save();
      }


      $temp = \Bumsgames\Article::where('articles.email', '=', $email)
      ->where('articles.category', 1)
      ->get();

      foreach ($temp as $x) {
        $articulo = \Bumsgames\Article::where('articles.id', '=', $x->id)
        ->first();
        $articulo->fill(['password' => $password]);
        $articulo->fill(['nickname' => $nickname]);
        $articulo->save();

        $res = \Bumsgames\PerteneceCliente::where('id_article', '=', $x->id)
        ->get();

        if ($res->count() > 0) {
          foreach ($res as $pertenencia) {
            $titulo = 'CAMBIARON LA CLAVE DE ESTE JUEGO PRIMARIO PS4';
            $data = "Articulo: " . $articulo->name . ". Correo: " . $articulo->email . '. Password: ' . $articulo->password;
            $data2 = "Cliente: " . $pertenencia->cliente->name . " 
            " . $pertenencia->cliente->lastname . ". 
            Contacto: " . $pertenencia->cliente->num_contact;
            $this->notificacion_para_todos_level7($titulo, $data, $data2);

            \Bumsgames\Reporte::create([
              'type_reporte' => 'Reporte',
              'titulo_reporte' => $titulo,
              'descripcion_reporte' => $data . ' || ' . $data2
            ]);
          }
        }
      }
      break;

        // PlayStation 3 Cupo Digital | Cuenta Digital
      case 5:
      $temp = \Bumsgames\Article::where('articles.email', '=', $email)
      ->where('articles.category', 1)
      ->get();

      foreach ($temp as $x) {
        $articulo = \Bumsgames\Article::where('articles.id', '=', $x->id)
        ->first();
        if (isset($x)) {
          $x->fill(['password' => $password]);
          $x->fill(['nickname' => $nickname]);
          $x->save();
        }

        $res = \Bumsgames\PerteneceCliente::where('id_article', '=', $x->id)
        ->get();

        if ($res->count() > 0) {
          foreach ($res as $pertenencia) {
            $titulo = 'CAMBIARON LA CLAVE DE ESTE JUEGO PRIMARIO PS4';
            $data = "Articulo: " . $articulo->name . ". Correo: " . $articulo->email . '. Password: ' . $articulo->password;
            $data2 = "Cliente: " . $pertenencia->cliente->name . " 
            " . $pertenencia->cliente->lastname . ". 
            Contacto: " . $pertenencia->cliente->num_contact;
            $this->notificacion_para_todos_level7($titulo, $data, $data2);

            \Bumsgames\Reporte::create([
              'type_reporte' => 'Reporte',
              'titulo_reporte' => $titulo,
              'descripcion_reporte' => $data . ' || ' . $data2
            ]);
          }
        }
      }

      $temp = \Bumsgames\Article::where('articles.email', '=', $email)
      ->where('articles.category', 2)
      ->get();

      foreach ($temp as $x) {
        $articulo = \Bumsgames\Article::where('articles.id', '=', $x->id)
        ->first();
        $articulo->fill(['password' => $password]);
        $articulo->fill(['nickname' => $nickname]);
        $articulo->save();

        $res = \Bumsgames\PerteneceCliente::where('id_article', '=', $x->id)
        ->get();

        if ($res->count() > 0) {
          foreach ($res as $pertenencia) {
            $titulo = 'CAMBIARON LA CLAVE DE ESTE JUEGO SECUNDARIO PS4';
            $data = "Articulo: " . $articulo->name . ". Correo: " . $articulo->email . '. Password: ' . $articulo->password;
            $data2 = "Cliente: " . $pertenencia->cliente->name . " 
            " . $pertenencia->cliente->lastname . ". 
            Contacto: " . $pertenencia->cliente->num_contact;
            $this->notificacion_para_todos_level7($titulo, $data, $data2);

            \Bumsgames\Reporte::create([
              'type_reporte' => 'Reporte',
              'titulo_reporte' => $titulo,
              'descripcion_reporte' => $data . ' || ' . $data2
            ]);
          }
        }
      }
      break;

        // XBOX ONE PRIMARIO
      case 8:
      $temp = \Bumsgames\Article::where('articles.email', '=', $email)
      ->where('articles.category', 9)
      ->get();

      foreach ($temp as $x) {
        $articulo = \Bumsgames\Article::where('articles.id', '=', $x->id)
        ->first();
        $articulo->fill(['password' => $password]);
        $articulo->fill(['nickname' => $nickname]);
        $articulo->save();

        $res = \Bumsgames\PerteneceCliente::where('id_article', '=', $x->id)
        ->get();

        if ($res->count() > 0) {
          foreach ($res as $pertenencia) {
            $titulo = 'CAMBIARON LA CLAVE DE ESTE JUEGO SECUNDARIO XB1';
            $data = "Articulo: " . $articulo->name . ". Correo: " . $articulo->email . '. Password: ' . $articulo->password;
            $data2 = "Cliente: " . $pertenencia->cliente->name . " 
            " . $pertenencia->cliente->lastname . ". 
            Contacto: " . $pertenencia->cliente->num_contact;
            $this->notificacion_para_todos_level7($titulo, $data, $data2);

            \Bumsgames\Reporte::create([
              'type_reporte' => 'Reporte',
              'titulo_reporte' => $titulo,
              'descripcion_reporte' => $data . ' || ' . $data2
            ]);
          }
        }
      }
      break;

        // XBOX ONE PRIMARIO
      case 9:
      $temp = \Bumsgames\Article::where('articles.email', '=', $email)
      ->where('articles.category', 8)
      ->get();

      foreach ($temp as $x) {
        $articulo = \Bumsgames\Article::where('articles.id', '=', $x->id)
        ->first();
        $articulo->fill(['password' => $password]);
        $articulo->fill(['nickname' => $nickname]);
        $articulo->save();

        $res = \Bumsgames\PerteneceCliente::where('id_article', '=', $x->id)
        ->get();

        if ($res->count() > 0) {
          foreach ($res as $pertenencia) {
            $titulo = 'CAMBIARON LA CLAVE DE ESTE JUEGO PRIMARIO XB1';
            $data = "Articulo: " . $articulo->name . ". Correo: " . $articulo->email . '. Password: ' . $articulo->password;
            $data2 = "Cliente: " . $pertenencia->cliente->name . " 
            " . $pertenencia->cliente->lastname . ". 
            Contacto: " . $pertenencia->cliente->num_contact;
            $this->notificacion_para_todos_level7($titulo, $data, $data2);

            \Bumsgames\Reporte::create([
              'type_reporte' => 'Reporte',
              'titulo_reporte' => $titulo,
              'descripcion_reporte' => $data . ' || ' . $data2
            ]);
          }
        }
      }
      break;
    }
  }

  /*
  -------------------------------------
      Modificar un articulo
  -------------------------------------
  */

  public function modificar_Articulo_PRUEBA(ArticleRequest $request){

  }

  public function modificar_Articulo(ArticleRequest $request)
  {

    $mensaje = "";

    $cambio_email_o_category = 0;

    //Se busca el articulo antes del cambio para tenerlo como referencia
    $refer = \Bumsgames\Article::with('categorias')
    ->where('id',$request->id_articulo)
    ->get();

    if (($request->offer_price < $request->price_in_dolar) && ($request->oferta == 1)) {
      return response()->json([
        "tipo" => "1",
        "data" => "El precio subrayado no puede ser menor al precio unitario.\n\n\nPrecio Unitario: " . $request->price_in_dolar . " $.\n\nPrecio de subrayado: " . $request->offer_price . " $",
      ]);
    }

    //print_r(0);

    $id_categorias = json_decode($request->id_categorias);
    $categoria = \Bumsgames\Category::find($id_categorias[0]);

    // $articulo->categorias()->sync($id_categorias);

    $nombre_categoria = $categoria->category;
    $primera_categoria_id = $id_categorias[0];

    $searchterm = "Cuenta Digital";
    $searchterm2 = "Cupo Digital";
    $pos = strrpos( $nombre_categoria, $searchterm);
    $pos2 = strrpos( $nombre_categoria, $searchterm2);

    //print_r(0.1);

    //si es cuenta digital  o cupo
    if (($pos !== false && strlen($searchterm) + $pos == strlen($nombre_categoria)) || 
      ($pos2 !== false && strlen($searchterm2) + $pos2 == strlen($nombre_categoria))) {

      $art = \Bumsgames\Article::
    leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
    ->where('email', $request->email)
    ->where('articulo_categorias.id_categoria', $id_categorias[0])
    ->get();

    //print_r(0);

    if ($art->count() >= 2) {
      return response()->json([
        "tipo" => "1",
        "data" => "Este articulo digital ya ha sido registrado con este mismo correo.\n\n\n Correo: " . $request->email . " para esta categoria. ",
      ]);
    }

    $id_ps4_pri = 1;
    $id_ps4_sec = 2;
    $id_ps4_codigo = 3;
    $id_ps3_cuenta = 5;
    
    //print_r(2);
    //caso ps4 pri, ps4 sec y ps3 cuenta , mismo correo y misma categoria   
    if (in_array($id_categorias[0], [$id_ps4_pri, $id_ps4_sec, $id_ps3_cuenta, $id_ps4_codigo])) {
      //print_r('en ps4');
      $articlesPivote = \Bumsgames\Article::
      where('email', $refer[0]->email)
      ->where('id','!=',$request->id_articulo)
      ->whereHas('categorias', function($q)  use ($id_ps4_pri,  $id_ps4_sec, $id_ps3_cuenta) {
        $q->whereIn('categories.id', array($id_ps4_pri, $id_ps4_sec, $id_ps3_cuenta));
      });

      //boton de reseteo cambiado
      if ( $refer[0]->reset_button != $request->reset_button ) {
        $articlesPivote ->update(['reset_button' => $request->reset_button]);
        $mensaje .= "Boton de reseteo cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
      }

      //nickname cambiado
      if ($refer[0]->nickname != $request->nickname) {
       $articlesPivote ->update(['nickname' => $request->nickname]);
       $mensaje .= "Nickname cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
     }
      // cambio de password
     if ($refer[0]->password != $request->password) {
       $articlesPivote ->update(['password' => $request->password ]);
       $mensaje .= "Password cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
     }
      // cambio de email
     if ($refer[0]->email != $request->email) {
       $articlesPivote ->update(['email' => $request->email ]);
       $mensaje .= "Correo cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
     }

      // cambio de peso y nombre, ps4: primario, secundario y codigo

     //si no es ps3 cuenta, actualizar en pri, sec y codigo (peso y nombre, si cambia)
     if ($primera_categoria_id != $id_ps3_cuenta) {
      //peso
       $articlesPivote = \Bumsgames\Article::
       where('id','!=',$request->id_articulo)
       ->where(function ($query) use ($request, $refer){
         $query->where('name', 'like', '%' . $request->name . ' -I%')
         ->orWhere('name', 'like', '%' . $refer[0]->name . ' -I%')
         ->orWhere('name',  $request->name )
         ->orWhere('name',  $refer[0]->name );
       })
       ->whereHas('categorias', function($q)  use ($id_ps4_pri,  $id_ps4_sec, $id_ps4_codigo) {
        $q->whereIn('categories.id', array($id_ps4_pri,  $id_ps4_sec, $id_ps4_codigo));
      });

       if ($refer[0]->peso != $request->peso) {
        $articlesPivote->update(['peso' => $request->peso ]);
        $mensaje .= "Peso cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
      }

      $articlesPivote = \Bumsgames\Article::
      where('id','!=',$request->id_articulo)
      ->where(function ($query) use ($request, $refer){
       $query->where('name',  $request->name )
       ->orWhere('name',  $refer[0]->name );
     })
      ->whereHas('categorias', function($q)  use ($id_ps4_pri,  $id_ps4_sec, $id_ps4_codigo) {
        $q->whereIn('categories.id', array($id_ps4_pri,  $id_ps4_sec, $id_ps4_codigo));
      });

      if ($refer[0]->name != $request->name) {
        $articlesPivote->update(['name' => $request->name ]);
        $mensaje .= "Nombre cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
      }
    }else{
      $articlesPivote = \Bumsgames\Article::
      where('id','!=',$request->id_articulo)
      ->where(function ($query) use ($request, $refer){
       $query->where('name', 'like', '%' . $request->name . ' -I%')
       ->orWhere('name', 'like', '%' . $refer[0]->name . ' -I%')
       ->orWhere('name',  $request->name )
       ->orWhere('name',  $refer[0]->name );
     })
      ->whereHas('categorias', function($q)  use ($id_ps3_cuenta) {
        $q->whereIn('categories.id', array($id_ps3_cuenta));
      });

      if ($refer[0]->peso != $request->peso) {
        $articlesPivote->update(['peso' => $request->peso ]);
        $mensaje .= "Peso cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
      }

      $articlesPivote = \Bumsgames\Article::
      where('id','!=',$request->id_articulo)
      ->where(function ($query) use ($request, $refer){
       $query->where('name',  $request->name )
       ->orWhere('name',  $refer[0]->name );
     })
      ->whereHas('categorias', function($q)  use ($id_ps3_cuenta) {
        $q->whereIn('categories.id', array($id_ps3_cuenta));
      });

      if ($refer[0]->name != $request->name) {
        $articlesPivote->update(['name' => $request->name ]);
        $mensaje .= "Nombre cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
      }
    }
  }

  $id_xb1_pri = 8;
  $id_xb1_sec = 9;
  $id_xb1_codigo = 10;


  //caso xb1 pri y xb1 sec , mismo correo y misma categoria   
  if (in_array($id_categorias[0], [$id_xb1_pri, $id_xb1_sec])) {

    $articlesPivote = \Bumsgames\Article::
    where('email', $refer[0]->email)
    ->where('id','!=',$refer[0]->id)
    ->whereHas('categorias', function($q)  use ($id_xb1_pri,  $id_xb1_sec) {
      $q->whereIn('categories.id', array($id_xb1_pri, $id_xb1_sec));
    });

  //nickname cambiado
    if ($refer[0]->nickname != $request->nickname) {
     $articlesPivote ->update(['nickname' => $request->nickname]);
     $mensaje .= "Nickname cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
   }
  // cambio de password
   if ($refer[0]->password != $request->password) {
     $articlesPivote ->update(['password' => $request->password ]);
     $mensaje .= "Password cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
   }
  // cambio de email
   if ($refer[0]->email != $request->email) {
     $articlesPivote ->update(['email' => $request->email ]);
     $mensaje .= "Correo cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
   }

   // cambio de peso y nombre, xb1: primario, secundario y codigo
   $articlesPivote = \Bumsgames\Article::
   where('id','!=',$request->id_articulo)
   ->where(function ($query) use ($request, $refer){
     $query->where('name', 'like', '%' . $request->name . ' -I%')
     ->orWhere('name', 'like', '%' . $refer[0]->name . ' -I%')
     ->orWhere('name',  $request->name )
     ->orWhere('name',  $refer[0]->name );
   })
   ->whereHas('categorias', function($q)  use ($id_xb1_pri,  $id_xb1_sec, $id_xb1_codigo) {
    $q->whereIn('categories.id', array($id_xb1_pri,  $id_xb1_sec, $id_xb1_codigo));
  });

   if ($refer[0]->peso != $request->peso) {
    $articlesPivote->update(['peso' => $request->peso ]);
    $mensaje .= "Peso cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }

  $articlesPivote = \Bumsgames\Article::
  where('id','!=',$request->id_articulo)
  ->where(function ($query) use ($request, $refer){
   $query->where('name',  $request->name )
   ->orWhere('name',  $refer[0]->name );
 })
  ->whereHas('categorias', function($q)  use ($id_xb1_pri,  $id_xb1_sec, $id_xb1_codigo) {
    $q->whereIn('categories.id', array($id_xb1_pri,  $id_xb1_sec, $id_xb1_codigo));
  });

  if ($refer[0]->name != $request->name) {
    $articlesPivote->update(['name' => $request->name ]);
    $mensaje .= "Nombre cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }

}

  $id_nin_pri = 18;
  $id_nin_sec = 19;
  $id_nin_codigo = 13;

  //caso xb1 pri y xb1 sec , mismo correo y misma categoria   
  if (in_array($id_categorias[0], [$id_nin_pri, $id_nin_sec])) {

    $articlesPivote = \Bumsgames\Article::
    where('email', $refer[0]->email)
    ->where('id','!=',$refer[0]->id)
    ->whereHas('categorias', function($q)  use ($id_nin_pri,  $id_nin_sec) {
      $q->whereIn('categories.id', array($id_nin_pri,  $id_nin_sec));
    });

  //nickname cambiado
    if ($refer[0]->nickname != $request->nickname) {
    $articlesPivote ->update(['nickname' => $request->nickname]);
    $mensaje .= "Nickname cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }
  // cambio de password
  if ($refer[0]->password != $request->password) {
    $articlesPivote ->update(['password' => $request->password ]);
    $mensaje .= "Password cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }
  // cambio de email
  if ($refer[0]->email != $request->email) {
    $articlesPivote ->update(['email' => $request->email ]);
    $mensaje .= "Correo cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }

  // cambio de peso y nombre, xb1: primario, secundario y codigo
  $articlesPivote = \Bumsgames\Article::
  where('id','!=',$request->id_articulo)
  ->where(function ($query) use ($request, $refer){
    $query->where('name', 'like', '%' . $request->name . ' -I%')
    ->orWhere('name', 'like', '%' . $refer[0]->name . ' -I%')
    ->orWhere('name',  $request->name )
    ->orWhere('name',  $refer[0]->name );
  })
  ->whereHas('categorias', function($q)  use ($id_nin_pri,  $id_nin_sec, $id_nin_codigo) {
    $q->whereIn('categories.id', array($id_nin_pri,  $id_nin_sec, $id_nin_codigo));
  });

  if ($refer[0]->peso != $request->peso) {
    $articlesPivote->update(['peso' => $request->peso ]);
    $mensaje .= "Peso cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }

  $articlesPivote = \Bumsgames\Article::
  where('id','!=',$request->id_articulo)
  ->where(function ($query) use ($request, $refer){
  $query->where('name',  $request->name )
  ->orWhere('name',  $refer[0]->name );
  })
  ->whereHas('categorias', function($q)  use ($id_nin_pri,  $id_nin_sec, $id_nin_codigo) {
    $q->whereIn('categories.id', array($id_nin_pri,  $id_nin_sec, $id_nin_codigo));
  });

  if ($refer[0]->name != $request->name) {
    $articlesPivote->update(['name' => $request->name ]);
    $mensaje .= "Nombre cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }
  }
  }
    // fin if (si es cuenta o cupo)

  //Cambio en Articulos mismo nombre viejo o nuevo, llegado a stock, agotado en stock, precio, precio 
  for ($i = 0; $i < count($id_categorias) - 1; $i++) {
    $primera_categoria_id = $id_categorias[$i];

    $articlesPivote = \Bumsgames\Article::
    where(function ($query) use ($request, $refer){
    $query->where('name',  $request->name )
    ->orWhere('name',  $refer[0]->name );
  })
    ->whereHas('categorias', function($q)  use ($primera_categoria_id) {
      $q->where('categories.id', $primera_categoria_id);
    });

    if ($articlesPivote->sum('quantity') <= 0 && $request->quantity > 0) {
    $articlesPivote->update(['ultimo_agregado' => Carbon::now()]);
    $mensaje .= "Articulo llego a Stock\n\n";
  }else{
    if ($articlesPivote->sum('quantity') > 0 
      && $request->quantity <= 0 
      && $refer[0]->quantity > 0
      && (($articlesPivote->sum('quantity') - $refer[0]->quantity) <= 0 )) {
      $articlesPivote->update(['fecha_agotado' => Carbon::now()]);
    $mensaje .= "Articulo Agotado\n\n";
  }
  }


  if ($refer[0]->offer_price != $request->offer_price) {
    $articlesPivote->update(['offer_price' => $request->offer_price ]);
    $mensaje .= "Precio Oferta cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }

  if ($refer[0]->price_in_dolar != $request->price_in_dolar) {

    if ( $request->price_in_dolar < $refer[0]->price_in_dolar) {
      $articlesPivote->update(['ultimo_agregado' => Carbon::now()]);
      $mensaje .= "Este Articulo ahora tiene un precio mas bajo\n\n";
    }

    $articlesPivote->update(['price_in_dolar' => $request->price_in_dolar ]);
    $mensaje .= "Precio de Venta cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }

  if ($refer[0]->oferta != $request->oferta) {
    $articlesPivote->update(['oferta' => $request->oferta ]);
    $mensaje .= "Precio de Oferta cambiado en ".$articlesPivote->count()." Articulo(s)\n\n";
  }

  }

    // modificacion articulo
  $articulo = \Bumsgames\Article::find($request->id_articulo);
  $articulo->fill($request->all());
  $articulo->save();

  $articulo->categorias()->sync($id_categorias);
      //Actualiza categorias en tabla pivote
  $articulo->categorias()->sync($id_categorias);





  \Bumsgames\BumsUser_Article::where('id_article', $articulo->id)->delete();

  $id_bumsuser = json_decode($request->id_bumsuser);
  $porcentaje = json_decode($request->porcentaje);
  $request->request->add(['id_article' => $articulo->id]);

  for ($i = 0; $i < count($id_bumsuser); $i++) {
    \Bumsgames\BumsUser_Article::create([
      'id_bumsuser' => $id_bumsuser[$i],
      'id_article' => $articulo->id,
      'porcentaje' => $porcentaje[$i]
    ]);
  }


  return response()->json([
    "data" => $mensaje,
  ]);

  //print_r(2);
}

  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function show($id)
  {
    //
  }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function edit($id)
  {
    //
  }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, $id)
  {
    //
  }

  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
  {
    //
  }
}
