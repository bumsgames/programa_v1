<?php

namespace Bumsgames\Http\Controllers;

use Bumsgames\Coupon;
use Illuminate\Http\Request;
use Auth;
use Session;
use URL;
use Carbon\Carbon; 
use DB;
use Mail;

class WebController extends Controller
{

	function comentarios(){
		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();
		return $comentarios;

	}

	function zona_prueba(){
		return view('prueba');
	}
	//Devuelve la pagina inicial de bumsgames
	function index()
	{

		// $articulos2 = \Bumsgames\Article::
		// where('quantity', '>', 0)
		// ->where('articles.id', '!=', '2')
		// ->orderBy('articles.ultimo_agregado', 'desc')
		// ->with('categorias')
		// ->get()->groupBy('name','categorias.id');

		// $articulos2 = \Bumsgames\Article::
		
		// with(['categorias' => function($query){
		// 	$query->groupBy('category');
		// }])
		// ->where('quantity', '>', 0)
		// ->where('articles.id', '!=', '2')
		// ->groupBy('articles.name')
		// ->orderBy('articles.ultimo_agregado', 'desc')
		// ->get();

		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->selectRaw('articles.id as id, name, file, categories.category as category')
		->with('images')
		// ->join("articulo_categorias",function($join){
		// 	$join->on('articles.id', '=', 'articulo_categorias.id_articulo');
		// })
		->leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
		->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')
		->leftJoin('articles_images', function ($join) {
			$join->on('articles_images.id', '=', DB::raw('(SELECT id FROM articles_images WHERE articles_images.article_id = articles.id LIMIT 1)'));
		})
		->leftjoin('images','articles_images.image_id','=','images.id')
		->where('articles.id', '!=', '2')
		->groupBy('name', 'categories.category')
		->orderBy('articles.ultimo_agregado', 'desc')
		->take(20)
		->get();

		// dd($articulos->toArray());

		// return view('prueba', compact('articulos','articulos2'));
		// dd(1234);
		
		$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
		->where('level', '>=', '7')
		->orderBy('id', 'asc')
		->get();


		// $numero = $articulos->count();
		//Descomentar el codigo que esta abajo si se quiere mostrar los productos mas recientes en un orden random
		/*
		if(($numero) < 15){
			$articulos = $articulos->random($numero);
		}else{
			$articulos = $articulos->random(15);	
		}
		*/
		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		// $day1 = \Carbon\Carbon::parse('last monday')->startOfDay()->format('Y-m-d');
		// $day2 = \Carbon\Carbon::parse('next sunday')->endOfDay()->format('Y-m-d');

		// Articulo mas vendido del dia

		

		$articulo_mas_vendido_semana = \Bumsgames\VentaArticulos::
		leftjoin('articles', 'articles.id', '=', 'venta_articulos.id_articulo')
		->leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
		->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')
		->select(\DB::raw("name,categories.category, sum(cantidad) as ventas"))
		->groupby('articles.name','categories.category')
		
		->whereDate('venta_articulos.created_at', \Carbon\Carbon::today())
		->orderby('ventas', 'desc')
		->limit(10)
		->get();


			// ->groupby('name')
			// ->get();
		// leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
		// ->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')
		// ->select(\DB::raw("*, count(*) as ventas"))
		// ->groupby('articles.name')
		// ->groupby('articles.category')
		// 	// ->whereBetween('sales.created_at',[$day1,$day2])
		// ->whereDate('sales.created_at', \Carbon\Carbon::today())
		// ->orderby('ventas', 'desc')
		// ->orderby('sales.created_at', 'desc')
		// ->limit(5)
		// ->get();


		//Devuelve las imagenes de los carrouseles
		// $portal1 = \Bumsgames\Imagen::where('portal', '=', '1')->inRandomOrder()->get();
		// $portal2 = \Bumsgames\Imagen::where('portal', '=', '2')->inRandomOrder()->get();
		// $portal3 = \Bumsgames\Imagen::where('portal', '=', '3')->inRandomOrder()->get();

		//Devuelve los ultimos 50 comentarios
		$comentarios = DB::table('comment')
		->select('nombre','texto')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(50)
		->get();

		//Randomiza el orden de los comentarios
		$comentarios = $comentarios->shuffle();
		//Toma 10 de los primeros 50 para mostrarlo cada vez que reinicie la pagina
		$comentarios = $comentarios->take(10);
		//Devuelve la unica encuesta activa
		$encuesta = \Bumsgames\Poll::where('estado', '1')->first();
		//Devuelve las ultimas 10 noticias y las ordena por prioridad y despues por creado
		// $noticias = \Bumsgames\Noticia::orderby('created_at', 'desc')
		// ->take(10)
		// ->get()
		// ->sortBy('prioridad');
		//Crea una visita
		\Bumsgames\Visita::create(['tipo' => 'General']);
		$carrito = Session::get('carrito');

		//dd($noticias->toArray());

		return view('webuser.index', compact('carrito','categorias', 'articulos', 'coins', 'moneda_actual', 'articulo_mas_vendido_semana', 'portal1', 'portal2', 'portal3', 'comentarios', 'noticias', 'encuesta','categorias_sub','agentes_activos'));
		//return view('webuser.index', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'articulo_mas_vendido_semana', 'comentarios', 'encuesta'));
	}



	function buscar_articulo_bums(Request $request)
	{
		Session::put('name', $request->name);

		$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
		->where('level', '>=', '7')
		->orderBy('id', 'asc')
		->get();

		$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();

		if (Session::has('id_ordenador')) {
			$id_ordenador = Session::get('id_ordenador');
		} else {
			$id_ordenador = 1;
		}

		if (Session::has('n_paginacion')) {
			$n_paginacion = Session::get('n_paginacion');
		} else {
			$n_paginacion = 50;
		}

		$request->request->add(['filtro' => $id_ordenador]);

		$id_categorias = json_decode($request->id_categorias);
		$filtros_activos = $id_categorias;


		$articulos = \Bumsgames\Article::
		selectRaw('articles.id, name, fondo, estado, offer_price, price_in_dolar, oferta, sum(quantity) as cantidad')
		->leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
		->BuscaCategoria($id_categorias)
		->oferta($request->all())
		->where('quantity', '>', 0)
		->where('articles.id', '!=', '2')
		->groupBy('name','articulo_categorias.id_categoria')
		->BuscaPorNombre($request->name)
		->busca($request->all())
		->paginate($n_paginacion);



		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}


		$ordenador = 1;

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();


		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);



		$title = 'BUSQUEDA: '.$request->name;
		$buscador_ruta = 'buscar_articulo_bums?name='.$request->name.'&';

		\Bumsgames\Visita::create(['tipo' => 'General']);

		$filtro_oferta = 1;
		$carrito = Session::get('carrito');

		return view('webuser.article.articulos_web', compact('carrito','filtro_oferta','n_paginacion','filtros_activos','id_ordenador','ordenador','categorias_sub','agentes_activos','categorias', 'comentarios', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos'));

	}

	function buscar_articulo_bumsG(Request $request)
	{
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id', '!=', '2')
		->groupBy('name', 'category')
		->BuscaPorNombre(Session::get('name'))
		->BuscaPorCategoria(Session::get('categoria'))
		->busca($request->all())
		->orderBy('updated_at', 'desc')
		->paginate(75);

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		$title = 'Busqueda de: ' . Session::get('name');
		$buscador_ruta = 'buscar_articulo_bumsG';
		\Bumsgames\Visita::create(['tipo' => 'General']);

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		return view('webuser.article.articulos_web', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos'));
	}

	function categorias()
	{

		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id', '!=', '2')
		->groupBy('name', 'category')
		->orderBy('updated_at', 'desc')
		->take(25)
		->get();
		$numero = $articulos->count();
		if (($numero) < 3) {
			$articulos = $articulos->random($numero);
		} else {
			$articulos = $articulos->random(3);
		}

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		\Bumsgames\Visita::create(['tipo' => 'General']);
		$portal1 = \Bumsgames\Imagen::where('portal', '=', '1')->inRandomOrder()->get();
		return view('categorias', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'portal1'));
	}

	function prueba(Request $request)
	{
		Session::put('id_coin', $request->id_coin);
		Session::put('requestReferrer', URL::previous());
		return redirect(Session::get('requestReferrer'));
	}

	function cambio_ordenador(Request $request)
	{
		Session::put('id_ordenador', $request->filtro);
		Session::put('requestReferrer', URL::previous());
		return redirect(Session::get('requestReferrer'));
	}

	function n_paginacion(Request $request)
	{	
		Session::put('n_paginacion', $request->n_paginacion);
		Session::put('requestReferrer', URL::previous());
		return redirect(Session::get('requestReferrer'));
	}

	function articulos_web(Request $request)
	{	

		$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
		->where('level', '>=', '7')
		->orderBy('id', 'asc')
		->get();

		$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();

		if (Session::has('id_ordenador')) {
			$id_ordenador = Session::get('id_ordenador');
		} else {
			$id_ordenador = 1;
		}

		if (Session::has('n_paginacion')) {
			$n_paginacion = Session::get('n_paginacion');
		} else {
			$n_paginacion = 50;
		}

		$request->request->add(['filtro' => $id_ordenador]);

		$id_categorias = json_decode($request->id_categorias);
		$filtros_activos = $id_categorias;


		$filtrado_cat = 1;

		$articulos = \Bumsgames\Article::select('articles.id','peso','name','fondo','estado','offer_price','price_in_dolar','oferta','quantity')
		->leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
		->BuscaCategoria($id_categorias)
		->where('quantity', '>', 0)
		->where('articles.id', '!=', '2')
		->groupBy('name', 'articulo_categorias.id_categoria')
		->orderBy('ultimo_agregado', 'desc')
		->limit(100)
		->paginate($n_paginacion);

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}




		$ordenador = 0;

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);


		$title = 'ARTICULOS RECIENTES | TOP 100';
		$buscador_ruta = 'articulos_web';
		\Bumsgames\Visita::create(['tipo' => 'General']);
		$filtro_oferta = 1;

		//dd(Session::get('carrito'));
		//dd($articulos->toArray());

		return view('webuser.article.articulos_web', compact('filtrado_cat','filtro_oferta','n_paginacion','filtros_activos','id_ordenador','ordenador','categorias_sub','agentes_activos','categorias', 'comentarios', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos'));
	}

	function subcategoria(Request $request, $id){
		$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
		->where('level', '>=', '7')
		->orderBy('id', 'asc')
		->get();

		$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();

		if (Session::has('id_ordenador')) {
			$id_ordenador = Session::get('id_ordenador');
		} else {
			$id_ordenador = 1;
		}

		if (Session::has('n_paginacion')) {
			$n_paginacion = Session::get('n_paginacion');
		} else {
			$n_paginacion = 50;
		}

		$request->request->add(['filtro' => $id_ordenador]);

		$id_categorias = json_decode($request->id_categorias);
		$filtros_activos = $id_categorias;

		$articulos = \Bumsgames\Article::select('articles.id','name','fondo','estado','offer_price','price_in_dolar','oferta')
		->leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
		->BuscaCategoria($id_categorias)
		->where('articulo_categorias.id_categoria', '=', $id)
		->oferta($request->all())
		->busca($request->all())
		->where('quantity', '>', 0)
		->where('articles.id', '!=', '2')
		->groupBy('name', 'articulo_categorias.id_categoria')
		->limit(100)
		->paginate($n_paginacion);


		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$ordenador = 1;
		$filtrado_cat = 0;

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();

		$categorias = \Bumsgames\Category::where('id', '<=',0)->get();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);


		$temporal = \Bumsgames\Category::where('id', '=',$id)->get();
		$title = $temporal[0]->category;
		$buscador_ruta = 'subcategoria/'.$id;
		\Bumsgames\Visita::create(['tipo' => 'General']);
		$filtro_oferta = 1; 
		return view('webuser.article.articulos_web', compact('filtrado_cat','filtro_oferta','n_paginacion','filtros_activos','id_ordenador','ordenador','categorias_sub','agentes_activos','categorias', 'comentarios', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos'));
	}

	function categoria(Request $request, $id){
		// CATEGORIA GENERAL
		$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
		->where('level', '>=', '7')
		->orderBy('id', 'asc')
		->get();

		$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();

		if (Session::has('id_ordenador')) {
			$id_ordenador = Session::get('id_ordenador');
		} else {
			$id_ordenador = 1;
		}


		if (Session::has('n_paginacion')) {
			$n_paginacion = Session::get('n_paginacion');
		} else {
			$n_paginacion = 50;
		}

		$request->request->add(['filtro' => $id_ordenador]);

		$id_categorias = json_decode($request->id_categorias);
		$filtros_activos = $id_categorias;




		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$ordenador = 1;

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();

		// filtros
		$temporal = \Bumsgames\Categoria_SubCategoria::find($id);
		$categorias = $temporal->categoria;
		$categoria_array = array();

		foreach ($categorias as $categoria) {
			array_push($categoria_array, $categoria->id);
		}


		$articulos = \Bumsgames\Article::select('articles.id','name','fondo','estado','offer_price','price_in_dolar','oferta')
		->leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
		->BuscaCategoria($id_categorias)
		->whereIn('articulo_categorias.id_categoria',$categoria_array)
		->oferta($request->all())
		->busca($request->all())
		->where('quantity', '>', 0)
		->where('articles.id', '!=', '2')
		->groupBy('name', 'articulo_categorias.id_categoria')
		->limit(100)
		->paginate($n_paginacion);


		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		$title = $temporal->nombre;
		$buscador_ruta = 'categoria/'.$id;
		$filtro_oferta = 1; 

		\Bumsgames\Visita::create(['tipo' => 'General']);
		$filtrado_cat = 1;

		return view('webuser.article.articulos_web', compact('filtrado_cat','filtro_oferta','n_paginacion','filtros_activos','id_ordenador','ordenador','categorias_sub','agentes_activos','categorias', 'comentarios', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos'));
	}

	function articulos_web_cat(Request $request, $id)
	{
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id', '!=', '2')
		->where('category',$id)
		->groupBy('name', 'category')
		->busca($request->all())
		->orderBy('updated_at', 'desc')
		->paginate(75);

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$no_filter = 1;

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		$categor_title = \Bumsgames\Category::find($id);

		$title = $categor_title->category;
		$buscador_ruta = 'articulos_web';
		\Bumsgames\Visita::create(['tipo' => 'General']);
		return view('webuser.article.articulos_web', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos', 'no_filter'));
	}
	// function categoria_general($categoria, Request $request){
	// 	Session::put('categoria', $categoria);

	// 	$categoria_Buscada = \Bumsgames\Category::where('category', $categoria)->first();
	// 	Session::put('categoria', $categoria);
	// 	Session::put('id_category', $categoria_Buscada['id']);

	// 	$articulos = \Bumsgames\Article::join('categories', 'articles.category', '=', 'categories.id')
	// 	->where('categories.category','like', '%'.Session::get('categoria').'%') 
	// 	->where('articles.quantity', '>', 0)
	// 	->groupBy('articles.name','articles.category')
	// 	->busca($request->all())
	// 	->orderBy('articles.updated_at', 'desc')
	// 	->get();


	// 	if(Session::has('id_coin')){
	// 		$id_coin = Session::get('id_coin');
	// 	}else{
	// 		$id_coin = 1;
	// 	}
	// 	$buscador_ruta = Session::get('categoria');

	// 	$categorias = \Bumsgames\Category::All();
	// 	$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
	// 	$moneda_actual = \Bumsgames\Coin::find($id_coin);
	// 	$title = Session::get('categoria');
	// 	return view('categoria_general', compact('categorias','articulos','coins','moneda_actual', 'title', 'buscador_ruta'));

	// }

	function filtros_prueba(Request $request){
		$id_categorias = json_decode($request->id_categorias);

		// if (isset($request->oferta_filt) && $request->oferta_filt) {
		// 	dd(111);
		// }

		// $articulos = \Bumsgames\Article::select('articles.id','name','category','fondo','estado','offer_price','price_in_dolar','oferta')
		// // ->leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
		// ->where('quantity', '>', 0)
		// ->where('articles.id', '!=', '2')
		// ->BuscaCategoria($id_categorias)
		// // ->whereIn('articulo_categorias.id_categoria', $id_categorias)
		// // ->orderBy('ultimo_agregado', 'desc')
		// // ->oferta($request->all())
		// ->groupBy('name', 'category')
		// // ->busca($request->all())
		// ->limit(100)
		// ->paginate(100);

		// $articulos = \Bumsgames\Article::leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
		// ->BuscaCategoria($id_categorias)
		// ->where('quantity', '>', 0)
		// ->where('articles.id', '!=', '2')
		// ->groupBy('name', 'category')
		// ->limit(100)
		// ->paginate(100);


		$articulos = \Bumsgames\Article::leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
		->BuscaCategoria($id_categorias)
		->oferta($request->all())
		->where('quantity', '>', 0)
		->where('articles.id', '!=', '2')
		->groupBy('name', 'category')
		->limit(100)
		->paginate(100);

		dd($articulos->toArray());


	}

	function categoria_general(Request $request)
	{
		if (isset($request->categoria)) {
			Session::put('categoria', $request->categoria);
			$categoria_Buscada = \Bumsgames\Category::where('category', $request->categoria)->first();
			Session::put('categoria', $request->categoria);
			Session::put('id_category', $categoria_Buscada['id']);
		}

		$articulos = \Bumsgames\Article::join('categories', 'articles.category', '=', 'categories.id')
		->where('categories.category', 'like', '%' . Session::get('categoria') . '%')
		->where('articles.quantity', '>', 0)
		->where('articles.id', '!=', '2')
		->groupBy('articles.name', 'articles.category')
		->busca($request->all())
		->orderBy('articles.updated_at', 'desc')
		->get();

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		$buscador_ruta = 'categoria_general';

		$title = Session::get('categoria');
		\Bumsgames\Visita::create(['tipo' => 'General']);
		return view('webuser.article.categoria_general', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta'));
	}

	function articulos(Request $request)
	{
		if (isset($request->category)) {
			$categoria = $request->category;
			$categoria_Buscada = \Bumsgames\Category::find($categoria);
			Session::put('categoria', $categoria_Buscada->category);
			Session::put('id_category', $categoria_Buscada['id']);
		}


		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('category', Session::get('id_category'))
		->where('id', '!=', '2')
		->groupBy('name', 'category')
		->busca($request->all())
		->orderBy('updated_at', 'desc')
		->paginate(50);

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		$comprofilt = 1;
		$buscador_ruta = 'articulos';

		$title = Session::get('categoria');
		\Bumsgames\Visita::create(['tipo' => 'General']);

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		return view('webuser.article.articulos_web', compact('categorias', 'comentarios', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos','comprofilt'));
	}

	function articulos2(Request $request)
	{	
		if (isset($request->category)) {
			$categoria = $request->category;
			$categoria_Buscada = \Bumsgames\Category::find($categoria);
			Session::put('categoria', $categoria_Buscada->category);
			Session::put('id_category', $categoria_Buscada['id']);
		}

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		$comprofilt = 1;
		$buscador_ruta = 'articulos';



		switch ($request->category) {

			case 1:
			$title = "PlayStation";
			$opcion = 1;
			break;

			case 2:
			$title = "XBOX";
			$opcion = 2;
			break;

			case 3:
			$title = "NINTENDO";
			$opcion = 3;
			break;

			default:
				# code...
			break;
		}

		\Bumsgames\Visita::create(['tipo' => 'General']);

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		return view('webuser.article.menu_categorias', compact('opcion','categorias', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos','comprofilt'));
	}

	function ayuda(Request $request)
	{
		// $articulos = \Bumsgames\Article::where('quantity', '>', 0)
		// ->where('id', '!=', '2')
		// ->groupBy('name', 'category')
		// ->busca($request->all())
		// ->orderBy('price_in_dolar', 'desc')
		// ->get();
		// $numero = $articulos->count();

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		\Bumsgames\Visita::create(['tipo' => 'General']);


		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();


		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();
		$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
		->where('level', '>=', '7')
		->orderBy('id', 'asc')
		->get();

		return view('webuser.ayuda.ayuda', compact('agentes_activos','categorias_sub','categorias', 'articulos', 'coins', 'moneda_actual', 'ultimos_vendidos','comentarios'));
	}

	function comprasuser(Request $request)
	{
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id', '!=', '2')
		->groupBy('name', 'category')
		->busca($request->all())
		->orderBy('price_in_dolar', 'desc')
		->get();
		$numero = $articulos->count();
		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}
		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		\Bumsgames\Visita::create(['tipo' => 'General']);
		return view('compras', compact('categorias', 'articulos', 'coins', 'moneda_actual'));
	}

	function adminpaneluser(Request $request)
	{
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id', '!=', '2')
		// ->groupBy('name', 'category')
		->busca($request->all())
		->orderBy('price_in_dolar', 'desc')
		->get();
		$numero = $articulos->count();
		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else  {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		if (Auth::guard('client')->guest()) {
			return redirect('/');
		}
		//MIS JUEGOS DIGITALES
		\Bumsgames\Visita::create(['tipo' => 'General']);
		$user = \Bumsgames\Client::where('id', '=', '' . Auth::guard('client')->user()->id . '')->first();
		$articulosmios = \Bumsgames\PerteneceCliente::with('cliente')
		->with('articulo')
		->where('id_cliente', $user->id)
		->orderBy('created_at','desc')
		->get();
		/*DB::select('
			SELECT a.*, cat.category as catname
			FROM articles as a, pertenece_clientes as pc, clients as c, categories as cat
			WHERE a.id = pc.id_article AND pc.id_cliente = c.id AND cat.id=a.category AND c.id = "'.$user->id.'"
			');*/
			// $articulocomprado = DB::select('
			// 	SELECT a.*, cat.category as catname, s.created_at fecha
			// 	FROM articles as a, sales as s, clients as c, categories as cat
			// 	WHERE a.id = s.id_article AND s.id_client = c.id AND cat.id=a.category AND c.id = "' . $user->id . '"
			// 	ORDER BY s.created_at DESC
			// 	');

			$comentarios = DB::table('comment')
			->where('aprobado', '1')
			->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
			->orderby('fecha_comentado', 'desc')
			->take(50)
			->get();

		//Randomiza el orden de los comentarios
			$comentarios = $comentarios->shuffle();
		//Toma 10 de los primeros 50 para mostrarlo cada vez que reinicie la pagina
			$comentarios = $comentarios->take(10);
		//Devuelve la unica encuesta activa
			$encuesta = \Bumsgames\Poll::where('estado', '1')->first();

			$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
			->where('level', '>=', '7')
			->orderBy('id', 'asc')
			->get();
			$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();

			return view('webuser.user.adminpaneluser', compact('agentes_activos','categorias_sub','articulosmios', 'comentarios', 'articulocomprado', 'categorias', 'articulos', 'coins', 'moneda_actual', 'user'));
		}

		// function prueba_lista_escrita(Request $request){
		// 	$articulos = \Bumsgames\Article::
		// 	leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
		// 	->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')
		// 	->where('quantity', '>', 0)
		// 	->where('articles.id', '!=', '2')
		// 	->orderby('categories.id')
		// 	// ->groupby('categories.id','name')
		// 	->get();

		// 	return view('webuser.listaescrita.lista_escrita', compact('articulos'));
		// }


		function lista_escrita(Request $request)
		{

			if (Session::has('id_ordenador')) {
				$id_ordenador = Session::get('id_ordenador');
			} else {
				$id_ordenador = 1;
			}
			$request->request->add(['filtro' => $id_ordenador]);

			$articulos = \Bumsgames\Article::
			leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
			->orderby('articulo_categorias.id_categoria','asc')
			->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')
			->where('quantity', '>', 0)
			->where('articles.id', '!=', '2')
			->groupBy('name', 'category')
			->busca($request->all())
			->get();

			$categorias_articulo = \Bumsgames\Category::	
			with(['articles' => function ($q) {
				$q->groupBy('name');
				$q->orderBy('price_in_dolar','asc');
				$q->orderBy('name','asc');
			}])
			->get();

			$numero = $articulos->count();
			if (isset($request->precio_fijo)) {
				$precio_cliente = $request->precio_fijo;
				if (isset($request->precio_porcentaje)) {
					$precio_porcentaje = 1 + ($request->precio_porcentaje * 0.01);
				} else {
					$precio_porcentaje = 1;
				}
			} else {
				if (isset($request->precio_porcentaje)) {
					$precio_porcentaje = 1 + ($request->precio_porcentaje * 0.01);
				} else {
					$precio_porcentaje = 1;
				}
				$precio_cliente = 0;
			}
			if (Session::has('id_coin')) {
				$id_coin = Session::get('id_coin');
			} else {
				$id_coin = 1;
			}

			$comentarios = DB::table('comment')
			->where('aprobado', '1')
			->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
			->orderby('fecha_comentado', 'desc')
			->take(10)
			->get();

			$categorias = \Bumsgames\Category::All();
			$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
			$moneda_actual = \Bumsgames\Coin::find($id_coin);

			\Bumsgames\Visita::create(['tipo' => 'General']);
			$portal3 = \Bumsgames\Imagen::where('portal', '=', '3')->inRandomOrder()->get();

			

			$comentarios = DB::table('comment')
			->where('aprobado', '1')
			->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
			->orderby('fecha_comentado', 'desc')
			->take(50)
			->get();

		//Randomiza el orden de los comentarios
			$comentarios = $comentarios->shuffle();
		//Toma 10 de los primeros 50 para mostrarlo cada vez que reinicie la pagina
			$comentarios = $comentarios->take(10);
		//Devuelve la unica encuesta activa
			$encuesta = \Bumsgames\Poll::where('estado', '1')->first();

			$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
			->where('level', '>=', '7')
			->orderBy('id', 'asc')
			->get();


			$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();

			if (Session::has('id_ordenador')) {
				$id_ordenador = Session::get('id_ordenador');
			} else {
				$id_ordenador = 1;
			}

			if (Session::has('n_paginacion')) {
				$n_paginacion = Session::get('n_paginacion');
			} else {
				$n_paginacion = 50;
			}

			$request->request->add(['filtro' => $id_ordenador]);

			$id_categorias = json_decode($request->id_categorias);
			$filtros_activos = $id_categorias;

			if (Session::has('id_coin')) {
				$id_coin = Session::get('id_coin');
			} else {
				$id_coin = 1;
			}

			$ordenador = 0;

			$ultimos_vendidos = \Bumsgames\VentaArticulos::
			orderby('created_at', 'desc')
			->limit(10)
			->get();

			$categorias = \Bumsgames\Category::All();
			$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
			$moneda_actual = \Bumsgames\Coin::find($id_coin);


			\Bumsgames\Visita::create(['tipo' => 'General']);
			$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();
			$buscador_ruta = 'lista_escrita';

			return view('webuser.listaescrita.lista_escrita', compact('buscador_ruta','id_ordenador','categorias_articulo','agentes_activos','categorias_sub','categorias', 'comentarios', 'articulos', 'coins', 'moneda_actual', 'portal3', 'precio_cliente', 'precio_porcentaje', 'ultimos_vendidos'));
		}

		function lista_escrita2(Request $request)
		{
			Session::put('id_coin', $request->id_coin);
			Session::put('requestReferrer', URL::previous());
			\Bumsgames\Visita::create(['tipo' => 'General']);
			return redirect(Session::get('requestReferrer'));
		}

		function agregaCarro(Request $request)
		{	
			
			
			$cantidad = 1;
			$cantidad_total = $request->cantidad;
			$carrito = Session::get('carrito');

			if(isset($carrito)){
				foreach ($carrito as $key ) {
					if($request->id == $key['id']){

						if (($cantidad_total - $key['cantidad'] - 1) < 0) {
							return response()->json([
								"tipo" => "1",
								"data" => "Cantidad Insuficiente.",
							]);
						}else{
							$key['cantidad'] = $key['cantidad'] + 1;
							return response()->json($carrito);
						}

					}
				}
			}


			$elemento = collect([
				'id' => $request->id,
				'articulo' => $request->articulo,
				'categoria' => $request->categoria,
				'precio' => (float)$request->precio,
				'imagen' => $request->imagen,
				'cantidad' => $cantidad,
			]);

			Session::push('carrito', $elemento);

			$carritos = Session::get('carrito');
			$moneda_actual = \Bumsgames\Coin::where('id',1)->first();

			foreach ($carritos as $carro ){
				$carro['category'] = \Bumsgames\Category::where('id', $carro['categoria'])->first();
				//$moneda_actual = \Bumsgames\Coin::where('id',1)->first();
				$carro['priceUnitedBs'] = number_format($carro['precio'] * $moneda_actual->valor, 2, ',', '.');
				$carro['priceTotalBs'] = number_format($carro['precio'] * $moneda_actual->valor, 2, ',', '.');
			}

			return response()->json($carritos);
		}

		function borrarElementoCarrito(Request $request)
		{

			$x = Session::get('carrito');
			$index = $request->elemento - 1;

			unset($x[$index]);
			$x = array_values($x);
			Session::put('carrito', $x);

			$carritos = Session::get('carrito');

			$moneda_actual = \Bumsgames\Coin::where('id',1)->first();
			
			foreach ($carritos as $carro ){
				$carro['category'] = \Bumsgames\Category::where('id', $carro['categoria'])->first();
				//$moneda_actual = \Bumsgames\Coin::where('id',1)->first();
				$carro['priceUnitedBs'] = number_format($carro['precio'] * $moneda_actual->valor, 2, ',', '.');
				$carro['priceTotalBs'] = number_format($carro['precio'] * $moneda_actual->valor, 2, ',', '.');
			}

			return response()->json($carritos);

			// // $x = Session::get('carrito')[$request->elemento - 1];
			// unset(Session::get('carrito')[$request->elemento - 1]);
			// return Session::get('carrito');
			// // return Session::get('carrito');
			// return $x;
		}

		function filtrar_articulos(Request $request)
		{
			$articulos = \Bumsgames\Article::where('quantity', '>', 0)
			->where('id', '!=', '2')
			->groupBy('name', 'category')
			->busca($request->all())
			->orderBy('updated_at', 'desc')
			->paginate(75);

			if (Session::has('id_coin')) {
				$id_coin = Session::get('id_coin');
			} else {
				$id_coin = 1;
			}

			$categorias = \Bumsgames\Category::All();
			$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
			$moneda_actual = \Bumsgames\Coin::find($id_coin);

			\Bumsgames\Visita::create(['tipo' => 'General']);

			$ultimos_vendidos = \Bumsgames\VentaArticulos::
			orderby('created_at', 'desc')
			->limit(10)
			->get();
			return view('webuser.article.articulos_web', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'ultimos_vendidos'));
		}

		public function lala()
		{
			$p = 1;
			$datos = \Bumsgames\Article::where('id', '>', '0')
			->busca($p)
			->get();

			return $datos;
		}

		public function articulos_oferta(Request $request)
		{

			$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
			->where('level', '>=', '7')
			->orderBy('id', 'asc')
			->get();

			$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();

			if (Session::has('id_ordenador')) {
				$id_ordenador = Session::get('id_ordenador');
			} else {
				$id_ordenador = 1;
			}

			if (Session::has('n_paginacion')) {
				$n_paginacion = Session::get('n_paginacion');
			} else {
				$n_paginacion = 50;
			}

			$request->request->add(['filtro' => $id_ordenador]);

			$id_categorias = json_decode($request->id_categorias);
			$filtros_activos = $id_categorias;



			$articulos = \Bumsgames\Article::select('articles.id','name','fondo','estado','offer_price','price_in_dolar','oferta')
			->leftjoin('articulo_categorias','articulo_categorias.id_articulo','articles.id')
			->BuscaCategoria($id_categorias)
			->where('oferta', '>=', '1')
			->where('quantity', '>', 0)
			->where('articles.id', '!=', '2')
			->groupBy('name', 'articulo_categorias.id_categoria')
			->limit(100)
			->paginate($n_paginacion);

			if (Session::has('id_coin')) {
				$id_coin = Session::get('id_coin');
			} else {
				$id_coin = 1;
			}




			$ordenador = 1;
			$filtro_oferta = 0;

			$ultimos_vendidos = \Bumsgames\VentaArticulos::
			orderby('created_at', 'desc')
			->limit(10)
			->get();

			$comentarios = DB::table('comment')
			->where('aprobado', '1')
			->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
			->orderby('fecha_comentado', 'desc')
			->take(10)
			->get();

			$categorias = \Bumsgames\Category::All();
			$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
			$moneda_actual = \Bumsgames\Coin::find($id_coin);

			$buscador_ruta = 'articulos_oferta';

			$title = 'Articulos en oferta';


			$title = 'ARTICULOS EN OFERTA';
			$buscador_ruta = 'articulos_oferta';
			$filtrado_cat = '1';

			$carrito = Session::get('carrito');

			\Bumsgames\Visita::create(['tipo' => 'General']);
			return view('webuser.article.articulos_web', compact('filtrado_cat','filtro_oferta','n_paginacion','filtros_activos','id_ordenador','ordenador','categorias_sub','agentes_activos','categorias', 'comentarios', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos','carrito'));

			// $ultimos_vendidos = \Bumsgames\Sales::join('articles', 'id_article', '=', 'articles.id')
			// ->join('categories', 'articles.category', '=', 'categories.id')
			// ->orderby('sales.created_at', 'desc')
			// ->limit(4)
			// ->get();

			//$carrito = Session::get('carrito');

			//dd($carrito);

			// return view('webuser.article.articulos_web', 
			// 	compact('categorias', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos', 'carrito'));
		}

		public function articulos_oferta_opc(Request $request){
			switch ($request->tipo_oferta) {
				case 'playstation':
				$articulos = \Bumsgames\Article::where('quantity', '>', 0)
				->where('id', '!=', '2')
				->groupBy('name', 'category')
				->busca($request->all())
				->where('oferta', '>=', '1')
				->where(function ($query) {
					$query->where('category', '=', 1)
					->orWhere('category', '=', 2)
					->orWhere('category', '=', 3)
					->orWhere('category', '=', 4);
				})
				->orderBy('updated_at', 'desc')
				->get();
				$categorias = \Bumsgames\Category::where(function ($query) {
					$query->where('id', '=', 1)
					->orWhere('id', '=', 2)
					->orWhere('id', '=', 3)
					->orWhere('id', '=', 4);
				})
				->orderBy('updated_at', 'desc')
				->get();

				$title = 'OFERTAS PS4';
				break;

				case 'xbox':
				$articulos = \Bumsgames\Article::where('quantity', '>', 0)
				->where('id', '!=', '2')
				->groupBy('name', 'category')
				->busca($request->all())
				->where('oferta', '>=', '1')
				->where(function ($query) {
					$query->where('category', '=', 8)
					->orWhere('category', '=', 9)
					->orWhere('category', '=', 10)
					->orWhere('category', '=', 11);
				})
				->orderBy('updated_at', 'desc')
				->get();
				$categorias = \Bumsgames\Category::where(function ($query) {
					$query->where('id', '=', 8)
					->orWhere('id', '=', 9)
					->orWhere('id', '=', 10)
					->orWhere('id', '=', 11);
				})
				->orderBy('updated_at', 'desc')
				->get();

				$title = 'OFERTAS XBOX';
				break;

				case 'nintendo':
				$articulos = \Bumsgames\Article::where('quantity', '>', 0)
				->where('id', '!=', '2')
				->groupBy('name', 'category')
				->busca($request->all())
				->where('oferta', '>=', '1')
				->where(function ($query) {
					$query->where('id', '=', 12)
					->orWhere('id', '=', 13)
					->orWhere('id', '=', 14);
				})
				->orderBy('updated_at', 'desc')
				->get();
				$categorias = \Bumsgames\Category::where(function ($query) {
					$query->where('id', '=', 12)
					->orWhere('id', '=', 13)
					->orWhere('id', '=', 14);
				})
				->orderBy('updated_at', 'desc')
				->get();

				$title = 'OFERTAS NINTENDO';
				break;

				default:
				# code...
				break;
			}

			if (Session::has('id_coin')) {
				$id_coin = Session::get('id_coin');
			} else {
				$id_coin = 1;
			}


			$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
			$moneda_actual = \Bumsgames\Coin::find($id_coin);

			$buscador_ruta = 'articulos_oferta';

			\Bumsgames\Visita::create(['tipo' => 'General']);



			$ultimos_vendidos = \Bumsgames\Sales::join('articles', 'id_article', '=', 'articles.id')
			->join('categories', 'articles.category', '=', 'categories.id')
			->orderby('sales.created_at', 'desc')
			->limit(4)
			->get();

			return view('webuser.article.articulos_web', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos'));
		}

		public function orden_a_pagar(Request $request)
		{
			if (Session::has('id_coin')) {
				$id_coin = Session::get('id_coin');
			} else {
				$id_coin = 1;
			}

			$categorias = \Bumsgames\Category::All();
			$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
			$moneda_actual = \Bumsgames\Coin::find($id_coin);
			$todas_las_monedas = \Bumsgames\Coin::All();

			$date = Carbon::now();

			return view('webuser.pago.orden_a_pagar', compact('todas_las_monedas','coins', 'moneda_actual', 'date'));
		}

		public function reportar_pago(Request $request)
		{
			if (isset($request->id_cupon)) {
				$couponact = Coupon::find($request->id_cupon);
				if ($couponact->disponible == 0) {
					return response()->json([
						"tipo" => "1",
						"data" => "Lo sentimos, el cupon ha expirado!",
					]);
				}
				$request->request->add(['cupon_id' => $request->id_cupon]);
			}

			$ultimo_pago = \Bumsgames\Pago::create($request->all());

			if ($request->envio == 1) {
				$request->request->add(['id_pago' => $ultimo_pago->id]);
				dd(22);
				$envio_pago = \Bumsgames\Envio_Pago::create($request->all());
			}

			dd(1);

			if (isset($request->id_cupon)) {
				$couponact->disponible--;
				$couponact->save();
			}

			$id_art = json_decode($request->id_articulo);
			for ($i = 0; $i < count($id_art); $i++) {
				\Bumsgames\Pago_Articulo::create([
					'id_pago' => $ultimo_pago->id,
					'id_article' => $id_art[$i]
				]);
			}

			Mail::send(['text' => 'mail.pago'], ['name', 'Bumsgames'], function ($message) {
				$message->to('bumsgames.notificaciones@gmail.com', 'To Bumsgames')->subject('Nuevo Pago');
				$message->from('bumsgames.notificaciones@gmail.com', 'Bumsgames Notificaciones');
			});

			return 1;
		}

		public function login()
		{
			if (Session::has('id_coin')) {
				$id_coin = Session::get('id_coin');
			} else {
				$id_coin = 1;
			}
			$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();

			$categorias = \Bumsgames\Category::All();
			$moneda_actual = \Bumsgames\Coin::find($id_coin);
			$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();

			$comentarios = DB::table('comment')
			->where('aprobado', '1')
			->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
			->orderby('fecha_comentado', 'desc')
			->take(10)
			->get();


			$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
			->where('level', '>=', '7')
			->orderBy('id', 'asc')
			->get();

			return view('loginUser.clienteLogin', compact('agentes_activos','categorias_sub','categorias', 'comentarios', 'moneda_actual', 'coins'));
		}

		public function loginAuth(Request $request)
		{
			$this->validate($request, [
				'nickname' => 'required|string',
				'password' => 'required|string',
			]);


			if (Auth::guard('client')->attempt(['nickname' => $request->nickname, 'password' => $request->password])) {

				return redirect('/adminpaneluser');
			}
			return back()
			->withErrors(['nickname' => 'Usuario o Clave incorrecto'])
			->withInput(request(['nickname']));
		}

		public function logout()
		{
			try {
				Auth::guard('client')->logout();
			} catch (\Exception $e) { }
			return redirect('/');
		}

		public function canjear(Request $request, $precio)
		{
			$this->validate($request, [
				'cupon' => 'required|string',
			]);
			$coupon = DB::table('coupon')->where('codigo', '=', $request->cupon)->first();
			if (!is_null($coupon)) {
				if ($coupon->disponible > 0) {
					if ($coupon->descuento >= $precio) {
						return back()->withErrors(['cupon' => 'El descuento del cupon no puede ser igual o exceder el monto']);
					}

					if (Session::has('id_coin')) {
						$id_coin = Session::get('id_coin');
					} else {
						$id_coin = 1;
					}

					$categorias = \Bumsgames\Category::All();
					$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
					$moneda_actual = \Bumsgames\Coin::find($id_coin);


					$ultimo_pago = \Bumsgames\Pago::orderby('created_at', 'DESC')->take(1)->get();
					if (!(isset($ultimo_pago->id))) {
						$ultimo_pago = 0;
					} else {
						$ultimo_pago = $ultimo_pago->id;
					}

					$date = Carbon::now();
				/*
				$couponact = coupon::find($coupon->id);
				$couponact->disponible--;
				$couponact->save();*/

				return view('webuser.pago.orden_a_pagar', compact('coins', 'moneda_actual', 'ultimo_pago', 'date', 'coupon'));
			}
			return back()->withErrors(['cupon' => 'Codigo expirado']);
		}
		return back()
		->withErrors(['cupon' => 'Codigo invalido']);
	}

	public function publicacion(Request $request, $id){
		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		$articulo_part = \Bumsgames\Article::find($id);


		$imagenes_articulo = \Bumsgames\Image::

		whereHas('articles', function($q) use($id) {
			$q->where('articles.id',$id); 
		})
		->orderby('numero')
		->limit(10)
		->get();

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		// $clientes_recomendado = \Bumsgames\Client::join('pertenece_clientes','clients.id','pertenece_clientes.id_cliente')
		// ->join('articles','articles.id','pertenece_clientes.id_article')
		// ->where('articles.name','like', $articulo_part->name)
		// ->select('clients.id')
		// ->pluck('id')->toArray();

		// $recomendados = \Bumsgames\Article::join('pertenece_clientes','articles.id','pertenece_clientes.id_article')
		// ->whereIn('pertenece_clientes.id_cliente',$clientes_recomendado)
		// ->where('articles.quantity','>',0)
		// ->where('articles.id','!=',2)
		// ->where('articles.name','not like',$articulo_part->name)
		// ->select('articles.*')
		// ->groupBy('articles.name')
		// ->groupBy('articles.category')
		// ->take(4)
		// ->get();

		// if($recomendados->count() < 4){
		// 	$article_mas_vendidos = \Bumsgames\Article::join('sales', 'id_article', '=', 'articles.id')
		// 	->join('categories', 'articles.category', '=', 'categories.id')
		// 	->select(\DB::raw("articles.*, count(*) as ventas"))
		// 	->groupby('articles.name')
		// 	->groupby('articles.category')
		// 	->whereBetween('sales.created_at',[\Carbon\Carbon::now()->subDays(30),\Carbon\Carbon::today()])
		// 	->orderby('ventas', 'desc')
		// 	->orderby('sales.created_at', 'desc')
		// 	->take(10)
		// 	->pluck('articles.name')->toArray();


		// 	$recomendados = \Bumsgames\Article::whereIn('articles.name',$article_mas_vendidos)
		// 	->where('articles.quantity','>',0)
		// 	->where('articles.id','!=',2)
		// 	->where('articles.name','not like',$articulo_part->name)
		// 	->select('articles.*')
		// 	->groupBy('articles.name')
		// 	->take(4)
		// 	->get();

		// }

		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();

		$categorias_sub = \Bumsgames\Categoria_SubCategoria::All();
		$agentes_activos = \Bumsgames\BumsUser::where('active', '>', 0)
		->where('level', '>=', '7')
		->orderBy('id', 'asc')
		->get();

		$ventas = \Bumsgames\Venta::count();
		$clientes = \Bumsgames\Client::count();
		$articulos_vendidos = \Bumsgames\VentaArticulos::selectRaw('sum(cantidad) as cantidad')
		->get();

		

		\Bumsgames\Visita::create(['tipo' => 'General']);
		return view('webuser.article.ver_mas', compact('imagenes_articulo','id','articulos_vendidos','clientes','ventas','agentes_activos','categorias_sub','categorias', 'comentarios', 'articulo_part', 'coins', 'moneda_actual', 'title', 'buscador_ruta','ultimos_vendidos','recomendados'));
	}

	
	//articulo particular
	public function ver_mas(Request $request){

		dd(1);
		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();
		if($request->art_id != 2){
			$articulo_part = \Bumsgames\Article::find($request->art_id);
			$imagenes_articulo = \Bumsgames\Image::
			with('articles');
		}
		

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		// $clientes_recomendado = \Bumsgames\Client::join('pertenece_clientes','clients.id','pertenece_clientes.id_cliente')
		// ->join('articles','articles.id','pertenece_clientes.id_article')
		// ->where('articles.name','like', $articulo_part->name)
		// ->select('clients.id')
		// ->pluck('id')->toArray();

		// $recomendados = \Bumsgames\Article::join('pertenece_clientes','articles.id','pertenece_clientes.id_article')
		// ->whereIn('pertenece_clientes.id_cliente',$clientes_recomendado)
		// ->where('articles.quantity','>',0)
		// ->where('articles.id','!=',2)
		// ->where('articles.name','not like',$articulo_part->name)
		// ->select('articles.*')
		// ->groupBy('articles.name')
		// ->groupBy('articles.category')
		// ->take(4)
		// ->get();

		// if($recomendados->count() < 4){
		// 	$article_mas_vendidos = \Bumsgames\Article::join('sales', 'id_article', '=', 'articles.id')
		// 	->join('categories', 'articles.category', '=', 'categories.id')
		// 	->select(\DB::raw("articles.*, count(*) as ventas"))
		// 	->groupby('articles.name')
		// 	->groupby('articles.category')
		// 	->whereBetween('sales.created_at',[\Carbon\Carbon::now()->subDays(30),\Carbon\Carbon::today()])
		// 	->orderby('ventas', 'desc')
		// 	->orderby('sales.created_at', 'desc')
		// 	->take(10)
		// 	->pluck('articles.name')->toArray();


		// 	$recomendados = \Bumsgames\Article::whereIn('articles.name',$article_mas_vendidos)
		// 	->where('articles.quantity','>',0)
		// 	->where('articles.id','!=',2)
		// 	->where('articles.name','not like',$articulo_part->name)
		// 	->select('articles.*')
		// 	->groupBy('articles.name')
		// 	->take(4)
		// 	->get();

		// }

		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();
		

		\Bumsgames\Visita::create(['tipo' => 'General']);
		return view('webuser.article.ver_mas', compact('categorias', 'comentarios', 'articulo_part', 'coins', 'moneda_actual', 'title', 'buscador_ruta','ultimos_vendidos','recomendados'));
	}


	

	//Articulos agotados
	public function Art_agotados(Request $request){

		$articulos = \Bumsgames\Article::where('quantity', 0)
		->where('id', '!=', '2')
		->groupBy('name', 'category')
		->orderBy('updated_at', 'desc')
		->paginate(75);

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		$comprofilt = 1;
		$buscador_ruta = 'articulos';

		$title = "ARTICULOS AGOTADOS";
		\Bumsgames\Visita::create(['tipo' => 'General']);

		$ultimos_vendidos = \Bumsgames\VentaArticulos::
		orderby('created_at', 'desc')
		->limit(10)
		->get();

		return view('webuser.article.articulos_web', compact('categorias', 'articulos', 'coins', 'moneda_actual', 'title', 'buscador_ruta', 'ultimos_vendidos','comprofilt'));
	}

	public function probando(Request $request){
		$coincidencia = \Bumsgames\Article::with('categorias')
		->where('name', 'like', '%king%')
		->whereHas('categorias', function($q) {
			$q->where('categories.id', '=', 1); 
			$q->groupby('name','categories.id'); 
		})
		->get();

		dd($coincidencia);
	}

	public function coincidencia_buscador_inteligente(Request $request)
	{	
		if($request->categoria_articulo == 0){
			$coincidencia = \Bumsgames\Article::
			leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
			->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')
			->where('name', 'like', '%' . $request->nombre_articulo . '%')
			->groupby('name','categories.id')
			->get();
		}else{
			$id_categoria = $request->categoria_articulo;
			$coincidencia = \Bumsgames\Article::
			leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
			->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')
			->where('name', 'like', '%' . $request->nombre_articulo . '%')
			->where('categories.id', $request->categoria_articulo)
			->groupby('name','categories.id')
			->get();

			// $coincidencia = \Bumsgames\Article::with('categorias')
			// ->where('name', 'like', '%' . $request->nombre_articulo . '%')
			// ->whereHas('categorias', function($q) use ($request)  {
			// 	$q->where('categories.id', $request->categoria_articulo); 
			// 	$q->groupby('name','categories.id'); 
			// })
			// ->groupby('name')
			// ->get();

		}
// leftjoin('articulo_categorias', 'articles.id', '=', 'articulo_categorias.id_articulo')
// ->leftjoin('categories','articulo_categorias.id_categoria','=','categories.id')


		if ($coincidencia->count()) {
			return response()->json([
				"articulos" => $coincidencia
			]);
		}else{
			return response()->json([
				"articulos" => 0
			]);
		}
		

		
	}



	public function error404($url)
	{

		if (Session::has('id_coin')) {
			$id_coin = Session::get('id_coin');
		} else {
			$id_coin = 1;
		}

		$comentarios = DB::table('comment')
		->where('aprobado', '1')
		->leftjoin('clients', 'comment.id_comentario', '=', 'clients.id')
		->orderby('fecha_comentado', 'desc')
		->take(10)
		->get();

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id', '!=', $id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		$title = 'Pagina no encontrada';
		$buscador_ruta = 'buscar_articulo_bums';
		\Bumsgames\Visita::create(['tipo' => 'General']);
		return view('errors.404', compact('categorias','comentarios', 'coins', 'moneda_actual', 'title', 'buscador_ruta'));
	}
}
