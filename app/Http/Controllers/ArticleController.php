<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Bumsgames\Http\Requests\ArticleRequest;
use Bumsgames\Notifications\TaskCompleted;
use Bumsgames\BumsUser;
use DB;
use Carbon\Carbon;


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
  // ArticleRequest
  public function store(ArticleRequest $request)
  {
    $this->validate($request, [
      'image' => 'nullable|max:300',
      'fondo' => 'nullable|max:300',
    ]);
    //verificar si es cuenta digital 
    $variable = $request->category_nombre;
    $searchterm = "Cuenta Digital";
    $pos = strrpos($variable, $searchterm);
    if ($pos !== false && strlen($searchterm) + $pos == strlen($variable)) {
      // vericar que la cantidad no sea mayor a 1
      if ($request->quantity > 1) {
        return response()->json([
          "tipo" => "1",
          "data" => "Este articulo digital no puede tener una cantidad mayor a 1.\n\n\nCantidad colocada: " . $request->quantity . " \n\n\nCorreo: " . $request->email . ".\n\nCategoria: " . $request->category_nombre,
        ]);
      }
      $art = \Bumsgames\Article::where('email', $request->email)->where('category', $request->category)->get();
      // verificar si hay otro articulo con ese mismo correo y misma categoria
      if ($art->count() >= 1) {
        return response()->json([
          "tipo" => "1",
          "data" => "Este articulo digital ya ha sido registrado con ese mismo correo.\n\n\n Correo: " . $request->email . ".\n\nCategoria: " . $request->category_nombre,
        ]);
      }
    }
    if (($request->offer_price < $request->price_in_dolar) && ($request->oferta == 1)) {
      return response()->json([
        "tipo" => "1",
        "data" => "El precio subrayado no puede ser menor al precio unitario.\n\n\nPrecio Unitario: " . $request->price_in_dolar . " $.\n\nPrecio de subrayado: " . $request->offer_price . " $",
      ]);
    }
    if (($request->costo < 0)) {
      return response()->json([
        "tipo" => "1",
        "data" => "El costo de inversión no puede ser menor a 0.\n\n\Costo de Inversión: " . $request->costo . "$",
      ]);
    }
    $variable = $request->category_nombre;
    $searchterm = "Cupo Digital";
    $pos = strrpos($variable, $searchterm);

    //si es cupo digital 
    if ($pos !== false && strlen($searchterm) + $pos == strlen($variable)) {
      // verificar que no sea mayor a 4
      if ($request->quantity > 4) {
        return response()->json([
          "tipo" => "1",
          "data" => "Este articulo digital no puede tener una cantidad mayor a 4.\n\n\nCantidad colocada: " . $request->quantity . " \n\n\nCorreo: " . $request->email . ".\n\nCategoria: " . $request->category_nombre,
        ]);
      }

      $art = \Bumsgames\Article::where('email', $request->email)->where('category', $request->category)->get();

      // verificar si no hay otro correo en esa misma categoria
      if ($art->count() >= 1) {
        return response()->json([
          "tipo" => "1",
          "data" => "Este articulo digital ya ha sido registrado con ese mismo correo.\n\n\n Correo: " . $request->email . ".\n\nCategoria: " . $request->category_nombre,
        ]);
      }
    }
    // tomar todos los articulos donde tengan ese mismo nombre y categoria
    $art = \Bumsgames\Article::where('name', $request->name)
      ->where('category', $request->category)
      ->get();

    // NOTIFICACIONES
    $temporal = \Bumsgames\Category::find($request->category);
    $temporal = $temporal->category;

    // SIGNIFICA QUE LLEGO ESTE ARTICULO

    // si no existe
    if ($art->count() == 0 && $request->quantity >= 1) {
      $titulo = 'LLEGO ESTE ARTICULO A STOCK';
      $data = "Articulo: " . $request->name;
      $data2 = "Categoria: " . $temporal;
      $users = BumsUser::where('level', '>=', '7')->get();
      $this->notificacion_para_todos_level7($titulo, $data, $data2);
    } else {
      // si existe y hay 0 cantidad
      if ($art->sum('quantity') == 0 && $request->quantity >= 1) {
        $titulo = 'LLEGO ESTE ARTICULO A STOCK';
        $data = "Articulo: " . $request->name;
        $data2 = "Categoria: " . $temporal;
        $users = BumsUser::where('level', '>=', '7')->get();
        $this->notificacion_para_todos_level7($titulo, $data, $data2);
      }
    }

    // crea la notificacion
    $titulo = 'ARTICULO AGREGADO POR: ' . auth()->user()->name . ' ' . auth()->user()->lastname;
    $data = "Articulo: " . $request->name;
    $data2 = "Categoria: " . $temporal;

    $this->notificacion_para_todos_level9($titulo, $data, $data2);

    $comprobante_disponibilidad =
      \Bumsgames\Article::where('quantity', '>', '0')
      ->where('name', '=', $request->name)
      ->where('category', '=', $request->category)
      ->get();
    if (($comprobante_disponibilidad->count() == 0) && ($request->quantity > 0)) {
      $request->request->add(['ultimo_agregado' => Carbon::now()]);
    }
    // crea el articulo
    if ($request->ajax()) {
      $articulo = \Bumsgames\Article::create($request->all());
    }

    //Actualiza el costo del producto con el mismo email y nickname
    if(in_array($articulo->category,[1,2])){
      if($articulo->category == 1){
        $artref = \Bumsgames\Article::where('articles.email', $request->email)
        ->where('category','2')
        ->where('articles.nickname', $request->nickname)
        ->first();
      }
      else if($articulo->category == 2){
        $artref = \Bumsgames\Article::where('articles.email', $request->email)
        ->where('category','1')
        ->where('articles.nickname', $request->nickname)
        ->first();
      }
    }
    if(in_array($articulo->category,[8,9])){
      if($articulo->category == 8){
        $artref = \Bumsgames\Article::where('articles.email', $request->email)
        ->where('category','9')
        ->where('articles.nickname', $request->nickname)
        ->first();
      }
      else if($articulo->category == 9){
        $artref = \Bumsgames\Article::where('articles.email', $request->email)
        ->where('category','8')
        ->where('articles.nickname', $request->nickname)
        ->first();
      }
    }
    if(isset($artref)){
      $artref->costo = $request->costo;
      $artref->save();
    }

    $temporal =  \Bumsgames\Article::where('name', $articulo->name)
      ->where('category', $articulo->category)
      ->get();
    foreach ($temporal as $x) {
      $algo = \Bumsgames\Article::find($x->id);
      $algo->fill(['price_in_dolar' => $articulo->price_in_dolar]);
      $algo->save();
      if (!isset($imagentodos) && $x->fondo != 'fondo_nada.jpg') {
        $imagentodos = $x->fondo;
      }
    }
    if (!isset($request->fondo) && isset($imagentodos)) {
      DB::statement('UPDATE articles SET fondo="' . $imagentodos . '" WHERE id=' . $articulo->id . ' ');
    }
    //Actualizar imagenes de mismos productos sin foto
    foreach ($temporal as $x) {
      $algo = \Bumsgames\Article::find($x->id);
      if (isset($request->fondo)) {
        DB::statement('UPDATE articles SET fondo="' . $articulo->fondo . '" WHERE id=' . $algo->id . ' ');
      } else if ($algo->fondo == 'fondo_nada.jpg' && isset($imagentodos)) {
        DB::statement('UPDATE articles SET fondo="' . $imagentodos . '" WHERE id=' . $algo->id . ' ');
      }
      $algo->save();
    }

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

    return $request->all();
  }

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

  public function modificar_Articulo(ArticleRequest $request)
  {
    $variable = $request->category_nombre;
    $searchterm = "Cuenta Digital";
    $pos = strrpos($variable, $searchterm);

    $cambio_email_o_category = 0;

    //Se busca el articulo antes del cambio para tenerlo como referencia
    $refer = \Bumsgames\Article::find($request->id_articulo);

    //si es cuenta digital 
    if ($pos !== false && strlen($searchterm) + $pos == strlen($variable)) {
      if ($request->quantity > 1) {
        return response()->json([
          "tipo" => "1",
          "data" => "Este articulo digital no puede tener una cantidad mayor a 1.\n\n\nCantidad colocada: " . $request->quantity . " \n\n\nCorreo: " . $request->email . ".\n\nCategoria: " . $request->category_nombre,
        ]);
      }


      //Modificacion caso Ps4/Ps3
      //Modificar el reset_button de todos los otros productos con el mismo correo
      if (($refer->reset_button != $request->reset_button) && (in_array($refer->category, [1, 2, 5]))) {
        DB::statement('UPDATE articles SET reset_button="' . $request->reset_button . '" WHERE id!=' . $request->id_articulo . ' AND (email="' . $refer->email . '" AND (category IN (1,2,5)))');
      }

      //Modificar el nickname de todos los otros productos con el mismo correo
      if (($refer->nickname != $request->nickname) && (in_array($refer->category, [1, 2, 5]))) {
        DB::statement('UPDATE articles SET nickname="' . $request->nickname . '" WHERE id!=' . $request->id_articulo . ' AND (email="' . $refer->email . '" AND (category IN (1,2,5)))');
      }

      //Modificar el password de todos los otros productos con el mismo correo
      if (($refer->password != $request->password) && (in_array($refer->category, [1, 2, 5]))) {
        DB::statement('UPDATE articles SET password="' . $request->password . '" WHERE id!=' . $request->id_articulo . ' AND (email="' . $refer->email . '" AND (category IN (1,2,5)))');
      }

      //Modificar el email de todos los otros productos con el mismo correo anterior
      if (($refer->email != $request->email) && (in_array($refer->category, [1, 2, 5]))) {
        DB::statement('UPDATE articles SET email="' . $request->email . '" WHERE id!=' . $request->id_articulo . ' AND (email="' . $refer->email . '" AND (category IN (1,2,5)))');
      }

      //Modificacion caso Xbox One
      //Modificar el reset_button de todos los otros productos con el mismo correo
      if (($refer->reset_button != $request->reset_button) && (in_array($refer->category, [8, 9]))) {
        DB::statement('UPDATE articles SET reset_button="' . $request->reset_button . '" WHERE id!=' . $request->id_articulo . ' AND (email="' . $refer->email . '" AND (category IN (8,9)))');
      }

      //Modificar el nickname de todos los otros productos con el mismo correo
      if (($refer->nickname != $request->nickname) && (in_array($refer->category, [8, 9]))) {
        DB::statement('UPDATE articles SET nickname="' . $request->nickname . '" WHERE id!=' . $request->id_articulo . ' AND (email="' . $refer->email . '" AND (category IN (8,9)))');
      }

      //Modificar el password de todos los otros productos con el mismo correo
      if (($refer->password != $request->password) && (in_array($refer->category, [8, 9]))) {
        DB::statement('UPDATE articles SET password="' . $request->password . '" WHERE id!=' . $request->id_articulo . ' AND (email="' . $refer->email . '" AND (category IN (8,9)))');
      }

      //Modificar el email de todos los otros productos con el mismo correo anterior
      if (($refer->email != $request->email) && (in_array($refer->category, [8, 9]))) {
        DB::statement('UPDATE articles SET email="' . $request->email . '" WHERE id!=' . $request->id_articulo . ' AND (email="' . $refer->email . '" AND (category IN (8,9)))');
      }

      //Modificar el peso de todos los otros productos con el mismo nombre y categoria
      if (($refer->peso != $request->peso) && (in_array($refer->category, [8, 9]))) {
        DB::statement('UPDATE articles SET peso="' . $request->peso . '" WHERE id!=' . $request->id_articulo . ' AND (name="' . $refer->name . '" AND (category IN (8,9)))');
      }

      //Modificar el peso de todos los otros productos con el mismo nombre y categoria
      if (($refer->peso != $request->peso) && (in_array($refer->category, [1, 2]))) {
        DB::statement('UPDATE articles SET peso="' . $request->peso . '" WHERE id!=' . $request->id_articulo . ' AND (name="' . $refer->name . '" AND (category IN (1,2)))');
      }

      if (($request->cambio_email_o_category == 1) && isset($request->email)) {
        $cambio_email_o_category = 1;
        $art = \Bumsgames\Article::where('email', $request->email)->where('category', $request->category)->get();
        if ($art->count() >= 1) {
          return response()->json([
            "tipo" => "1",
            "data" => "Este articulo digital ya ha sido registrado con ese mismo correo.\n\n\n Correo: " . $request->email . ".\n\nCategoria: " . $request->category_nombre,
          ]);
        }
      }
    }
    if (($request->offer_price < $request->price_in_dolar) && ($request->oferta == 1)) {
      return response()->json([
        "tipo" => "1",
        "data" => "El precio subrayado no puede ser menor al precio unitario.\n\n\nPrecio Unitario: " . $request->price_in_dolar . " $.\n\nPrecio de subrayado: " . $request->offer_price . " $",
      ]);
    }
    $variable = $request->category_nombre;
    $searchterm = "Cupo Digital";
    $pos = strrpos($variable, $searchterm);

    //si es cuenta digital 
    if ($pos !== false && strlen($searchterm) + $pos == strlen($variable)) {
      if ($request->quantity > 4) {
        return response()->json([
          "tipo" => "1",
          "data" => "Este articulo digital no puede tener una cantidad mayor a 4.\n\n\nCantidad colocada: " . $request->quantity . " \n\n\nCorreo: " . $request->email . ".\n\nCategoria: " . $request->category_nombre,
        ]);
      }
      if (($request->cambio_email_o_category == 1) && isset($request->email)) {
        $art = \Bumsgames\Article::where('email', $request->email)->where('category', $request->category)->get();
        if ($art->count() >= 1) {
          return response()->json([
            "tipo" => "1",
            "data" => "Este articulo digital ya ha sido registrado con ese mismo correo.\n\n\n Correo: " . $request->email . ".\n\nCategoria: " . $request->category_nombre,
          ]);
        }
      }
    }

    $art = \Bumsgames\Article::where('name', $request->name)
      ->where('category', $request->category)
      ->get();

    if ($art->count() == 0) {
      $cantidad_que_tenia = 0;
    } else {
      $cantidad_que_tenia = $art->sum('quantity');
    }

    $comprobante_disponibilidad =
      \Bumsgames\Article::where('quantity', '>', '0')
      ->where('name', '=', $refer->name)
      ->where('category', '=', $refer->category)
      ->get();
    if (($comprobante_disponibilidad->count() == 0) && ($refer->quantity < $request->quantity)) {
      $request->request->add(['ultimo_agregado' => Carbon::now()]);
    }
    // modificacion articulo
    $articulo = \Bumsgames\Article::find($request->id_articulo);
    $articulo->fill($request->all());
    $articulo->save();

    
    //Actualiza el costo del producto con el mismo email y nickname
    if(in_array($articulo->category,[1,2])){
      if($articulo->category == 1){
        $artref = \Bumsgames\Article::where('articles.email', $request->email)
        ->where('category','2')
        ->where('articles.nickname', $request->nickname)
        ->first();
      }
      else if($articulo->category == 2){
        $artref = \Bumsgames\Article::where('articles.email', $request->email)
        ->where('category','1')
        ->where('articles.nickname', $request->nickname)
        ->first();
      }
    }
    if(in_array($articulo->category,[8,9])){
      if($articulo->category == 8){
        $artref = \Bumsgames\Article::where('articles.email', $request->email)
        ->where('category','9')
        ->where('articles.nickname', $request->nickname)
        ->first();
      }
      else if($articulo->category == 9){
        $artref = \Bumsgames\Article::where('articles.email', $request->email)
        ->where('category','8')
        ->where('articles.nickname', $request->nickname)
        ->first();
      }
    }
    if(isset($artref)){
      $artref->costo = $request->costo;
      $artref->save();
    }


    $temporal =  \Bumsgames\Article::where('name', $articulo->name)
      ->where('category', $request->category)
      ->get();
    foreach ($temporal as $x) {
      $algo = \Bumsgames\Article::find($x->id);
      $algo->fill(['price_in_dolar' => $articulo->price_in_dolar]);
      if (isset($request->image)) {
        $algo->fill(['image' => $request->image]);
      }
      if (isset($request->fondo)) {
        $algo->fill(['fondo' => $request->fondo]);
      }
      $algo->save();
    }

    // cambio de oferta de todos los que son iguales
    if (1 == 1) {
      $temporal =  \Bumsgames\Article::where('name', $articulo->name)
        ->where('category', $articulo->category)
        ->get();

      foreach ($temporal as $x) {
        $algo = \Bumsgames\Article::find($x->id);
        $algo->fill(['oferta' => $request->oferta]);
        $algo->save();
      }
    }


    //Cambio de la cuenta secundaria si se cambio la primaria en PS4
    if ($articulo->category == 1) {
      $temporal =  \Bumsgames\Article::where('email', $articulo->email)
        ->where('category', 2)
        ->get();
      foreach ($temporal as $x) {
        $algo = \Bumsgames\Article::find($x->id);
        if ($x->name == $refer->name) {
          $algo->fill(['name' => $request->name]);
          if (isset($request->image)) {
            $algo->fill(['image' => $request->image]);
          }
          if (isset($request->fondo)) {
            $algo->fill(['fondo' => $request->fondo]);
          }
        }
        $algo->save();
      }

      $temporal =  \Bumsgames\Article::where('email', $articulo->email)
        ->where('category', 5)
        ->where('name', $articulo->name)
        ->get();
      foreach ($temporal as $x) {
        $algo = \Bumsgames\Article::find($x->id);
        $algo->fill(['note' => $request->note]);
        $algo->save();
      }
    }

    //Cambio de la cuenta primaria si se cambio la secundaria en PS4
    if ($articulo->category == 2) {
      $temporal =  \Bumsgames\Article::where('email', $articulo->email)
        ->where('category', 1)
        ->get();
      foreach ($temporal as $x) {
        $algo = \Bumsgames\Article::find($x->id);
        if ($x->name == $refer->name) {
          $algo->fill(['name' => $request->name]);
          if (isset($request->image)) {
            $algo->fill(['image' => $request->image]);
          }
          if (isset($request->fondo)) {
            $algo->fill(['fondo' => $request->fondo]);
          }
        }
        $algo->save();
      }

      $temporal =  \Bumsgames\Article::where('email', $articulo->email)
        ->where('category', 5)
        ->get();
      foreach ($temporal as $x) {
        $algo = \Bumsgames\Article::find($x->id);
        $algo->fill(['note' => $request->note]);
        $algo->save();
      }
    }

    //Cambio de la nota en los mismos correos en PS4 en base a PS3
    /* if($articulo->category == 5){
          $temporal =  \Bumsgames\Article::where('email',$articulo->email)
          ->where('category',1)
          ->get();
          foreach($temporal as $x){
            $algo = \Bumsgames\Article::find($x->id);
            $algo->fill(['note'=>$request->note]);
            $algo->save();
          }
          
          $temporal =  \Bumsgames\Article::where('email',$articulo->email)
          ->where('category',2)
          ->get();
          foreach($temporal as $x){
            $algo = \Bumsgames\Article::find($x->id);
            $algo->fill(['note'=>$request->note]);
            $algo->save();
          }
          
        }*/
    //Cambio de la cuenta secundaria de Xbox One si se cambio la primaria
    if ($articulo->category == 8) {
      $temporal =  \Bumsgames\Article::where('email', $articulo->email)
        ->where('category', 9)
        ->get();
      foreach ($temporal as $x) {
        $algo = \Bumsgames\Article::find($x->id);
        if ($x->name == $refer->name) {
          $algo->fill(['name' => $request->name]);
          if (isset($request->image)) {
            $algo->fill(['image' => $request->image]);
          }
          if (isset($request->fondo)) {
            $algo->fill(['fondo' => $request->fondo]);
          }
        }
        $algo->save();
      }
    }

    //Cambio de la cuenta secundaria de Xbox One si se cambio la primaria
    if ($articulo->category == 9) {
      $temporal =  \Bumsgames\Article::where('email', $articulo->email)
        ->where('category', 8)
        ->get();
      foreach ($temporal as $x) {
        $algo = \Bumsgames\Article::find($x->id);
        if ($x->name == $refer->name) {
          $algo->fill(['name' => $request->name]);
          if (isset($request->image)) {
            $algo->fill(['image' => $request->image]);
          }
          if (isset($request->fondo)) {
            $algo->fill(['fondo' => $request->fondo]);
          }
        }
        $algo->save();
      }
    }
    // fin modificacion

    if ($request->cambio_password >= 1) {
      $this->cambia_password($request->category, $request->email, $request->password, $request->nickname);
    }
    if ($cantidad_que_tenia == 0 &&  $request->quantity > 0) {
      //llego
      $titulo = 'LLEGO A STOCK';
      $data = "Articulo: " . $request->name;
      $data2 = "Categoria: " . $request->category_nombre;
      $users = BumsUser::where('level', '>=', '7')->get();
      foreach ($users as $user) {
        $user->notify(new TaskCompleted($titulo, $data, $data2));
      }
    }

    if ($cantidad_que_tenia > 0) {
      //se agoto
      $art = \Bumsgames\Article::where('name', $request->name)
        ->where('category', $request->category)
        ->get();

      if ($art->sum('quantity') == 0) {
        //se agoto
        $titulo = 'SE AGOTO';
        $data = "Articulo: " . $request->name;
        $data2 = "Categoria: " . $request->category_nombre;
        $users = BumsUser::where('level', '>=', '7')->get();
        foreach ($users as $user) {
          $user->notify(new TaskCompleted($titulo, $data, $data2));
        }
      }
    }
    // Despues de guardar

    // $titulo = 'ARTICULO MODIFICADO';
    // $data = "Articulo: ".$request->name;
    // $data2 = "Categoria: ".$request->category_nombre;
    // $users = BumsUser::where('level','>=','9')->get();
    // foreach ($users as $user){
    //     $user->notify(new TaskCompleted($titulo,$data, $data2));
    // }


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
      "message" => "Success"
    ]);
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
