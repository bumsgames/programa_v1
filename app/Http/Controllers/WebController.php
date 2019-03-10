<?php

namespace Bumsgames\Http\Controllers;
use Bumsgames\Coupon;
use Illuminate\Http\Request;
use Auth;
use Session;
use URL;
use Carbon\Carbon;
use DB;


class WebController extends Controller
{
	function index(){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->orderBy('ultimo_agregado', 'desc')
		->take(5)
		->get();
		$numero = $articulos->count();
		//Descomentar el codigo que esta abajo si se quiere mostrar los productos mas recientes en un orden random
		/*
		if(($numero) < 15){
			$articulos = $articulos->random($numero);
		}else{
			$articulos = $articulos->random(15);	
		}
		*/
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);



		$day1 = \Carbon\Carbon::parse('last monday')->startOfDay()->format('Y-m-d');
		$day2 = \Carbon\Carbon::parse('next sunday')->endOfDay()->format('Y-m-d');

		// del dia
		$articulo_mas_vendido_semana = \Bumsgames\Sales::
		join('articles','id_article','=','articles.id')
		->join('categories','articles.category','=','categories.id')
		->select(\DB::raw("*, count(*) as ventas"))
		->groupby('articles.name')
		->groupby('articles.category')
		// ->whereBetween('sales.created_at',[$day1,$day2])
		->whereDate('sales.created_at', \Carbon\Carbon::today())
		->orderby('ventas','desc')
		->orderby('sales.created_at','desc')
		->limit(5)
		->get();

		$portal1 = \Bumsgames\Imagen::where('portal','=','1')->inRandomOrder()->get();
		$portal2 = \Bumsgames\Imagen::where('portal','=','2')->inRandomOrder()->get();
		$portal3 = \Bumsgames\Imagen::where('portal','=','3')->inRandomOrder()->get();
		
		/* Nuevo codigo */
		$comentarios = DB::table('comment')->where('aprobado','1')->leftjoin('clients','comment.id_comentario','=','clients.id')->orderby('fecha_comentado','desc')->take(50)->get();

		
		$comentarios = $comentarios->shuffle();
		$comentarios = $comentarios->take(10);


		/* Fin del nuevo codigo */
		\Bumsgames\Visita::create(['tipo'=>'General']);

		return view('index', compact('categorias','articulos','coins','moneda_actual','articulo_mas_vendido_semana','portal1','portal2','portal3', 'comentarios'));
		/* Nuevo codigo, se agrego 'comentarios' arriba*/
	}

	function buscar_articulo_bums(Request $request){
		Session::put('name', $request->name);

		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->BuscaPorNombre(Session::get('name'))
		->BuscaPorCategoria(Session::get('categoria'))
		->busca($request->all())
		->orderBy('updated_at', 'desc')
		->get();
		
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
// 		where('id','!=',1)
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		$title = 'Busqueda de: '.Session::get('name');
		$buscador_ruta = 'buscar_articulo_bums';
		\Bumsgames\Visita::create(['tipo'=>'General']);

		return view('articulos_web', compact('categorias','articulos','coins','moneda_actual','title', 'buscador_ruta'));
	}

	function buscar_articulo_bumsG(){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->BuscaPorNombre(Session::get('name'))
		->BuscaPorCategoria(Session::get('categoria'))
		->busca($request->all())
		->orderBy('updated_at', 'desc')
		->get();
		
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		$title = 'Busqueda de: '.Session::get('name');
		$buscador_ruta = 'buscar_articulo_bumsG';
		\Bumsgames\Visita::create(['tipo'=>'General']);
		return view('articulos_web', compact('categorias','articulos','coins','moneda_actual','title', 'buscador_ruta'));
	}

	function categorias(){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->orderBy('updated_at', 'desc')
		->take(25)
		->get();
		$numero = $articulos->count();
		if(($numero) < 3){
			$articulos = $articulos->random($numero);
		}else{
			$articulos = $articulos->random(3);	
		}

		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		
		\Bumsgames\Visita::create(['tipo'=>'General']);
		$portal1 = \Bumsgames\Imagen::where('portal','=','1')->inRandomOrder()->get();
		return view('categorias', compact('categorias','articulos','coins','moneda_actual','portal1'));
	}

	function prueba(Request $request){
		Session::put('id_coin', $request->id_coin);
		Session::put('requestReferrer', URL::previous());
		return redirect(Session::get('requestReferrer'));
	}

	function articulos_web(Request $request){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->busca($request->all())
		->orderBy('updated_at', 'desc')
		->get();

		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		
		$title = 'Todos los articulos';
		$buscador_ruta = 'articulos_web';
		\Bumsgames\Visita::create(['tipo'=>'General']);
		return view('articulos_web', compact('categorias','articulos','coins','moneda_actual','title', 'buscador_ruta'));
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

	function categoria_general(Request $request){		
		if(isset($request->categoria)){
			Session::put('categoria', $request->categoria);
			$categoria_Buscada = \Bumsgames\Category::where('category', $request->categoria)->first();
			Session::put('categoria', $request->categoria);
			Session::put('id_category', $categoria_Buscada['id']);
		}

		$articulos = \Bumsgames\Article::join('categories', 'articles.category', '=', 'categories.id')
		->where('categories.category','like', '%'.Session::get('categoria').'%') 
		->where('articles.quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('articles.name','articles.category')
		->busca($request->all())
		->orderBy('articles.updated_at', 'desc')
		->get();
		
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		
		$buscador_ruta = 'categoria_general';

		$title = Session::get('categoria');
		\Bumsgames\Visita::create(['tipo'=>'General']);
		return view('categoria_general', compact('categorias','articulos','coins','moneda_actual', 'title', 'buscador_ruta'));

	}

	function articulos(Request $request){
		if(isset($request->category)){
			$categoria = $request->category;
			$categoria_Buscada = \Bumsgames\Category::find($categoria);
			Session::put('categoria', $categoria_Buscada->category);
			Session::put('id_category', $categoria_Buscada['id']);
		}

		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('category', Session::get('id_category'))
		->where('id','!=','2')
		->groupBy('name','category')
		->busca($request->all())
		->orderBy('updated_at', 'desc')
		->get();

		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		
		$buscador_ruta = 'articulos';

		$title = Session::get('categoria');
		\Bumsgames\Visita::create(['tipo'=>'General']);
		return view('articulos_web', compact('categorias','articulos','coins','moneda_actual', 'title', 'buscador_ruta'));
	}

	function ayuda(Request $request){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->busca($request->all())
		->orderBy('price_in_dolar', 'desc')
		->get();
		$numero = $articulos->count();

		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		\Bumsgames\Visita::create(['tipo'=>'General']);
		return view('ayuda', compact('categorias','articulos','coins','moneda_actual'));
	}

	function comprasuser(Request $request){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->busca($request->all())
		->orderBy('price_in_dolar', 'desc')
		->get();
		$numero = $articulos->count();
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}
		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);

		\Bumsgames\Visita::create(['tipo'=>'General']);
		return view('compras', compact('categorias','articulos','coins','moneda_actual'));
	}

	function adminpaneluser(Request $request){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->busca($request->all())
		->orderBy('price_in_dolar', 'desc')
		->get();
		$numero = $articulos->count();
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}
		
		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		if(Auth::guard('client')->guest()){
			return redirect('/');
		}
		\Bumsgames\Visita::create(['tipo'=>'General']);
		$user = \Bumsgames\Client::where('id','=',''.Auth::guard('client')->user()->id.'')	->first();
		$articulosmios = \Bumsgames\PerteneceCliente::with('cliente')->with('articulo')->where('id_cliente',$user->id)->get();
		/*DB::select('
			SELECT a.*, cat.category as catname
			FROM articles as a, pertenece_clientes as pc, clients as c, categories as cat
			WHERE a.id = pc.id_article AND pc.id_cliente = c.id AND cat.id=a.category AND c.id = "'.$user->id.'"
		');*/
		$articulocomprado = DB::select('
			SELECT a.*, cat.category as catname, s.created_at fecha
			FROM articles as a, sales as s, clients as c, categories as cat
			WHERE a.id = s.id_article AND s.id_client = c.id AND cat.id=a.category AND c.id = "'.$user->id.'"
		');

		return view('adminpaneluser',compact('articulosmios','articulocomprado','categorias','articulos','coins','moneda_actual','user'));
	}


	function lista_escrita(Request $request){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->orderBy('category')
		->busca($request->all())
		->orderBy('price_in_dolar', 'asc')
		->get();
		$numero = $articulos->count();
		if(isset($request->precio_fijo)){
			$precio_cliente=$request->precio_fijo;		
			if(isset($request->precio_porcentaje)){
				$precio_porcentaje= 1 + ($request->precio_porcentaje*0.01);
			}
			else{
				$precio_porcentaje=1;
			}
		}
		else{
			if(isset($request->precio_porcentaje)){
				$precio_porcentaje= 1 + ($request->precio_porcentaje*0.01);
			}
			else{
				$precio_porcentaje=1;
			}
			$precio_cliente=0;
		}
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		
		\Bumsgames\Visita::create(['tipo'=>'General']);
		$portal3 = \Bumsgames\Imagen::where('portal','=','3')->inRandomOrder()->get();
		return view('lista_escrita', compact('categorias','articulos','coins','moneda_actual','portal3','precio_cliente','precio_porcentaje'));
	}

	function lista_escrita2(Request $request){
		Session::put('id_coin', $request->id_coin);
		Session::put('requestReferrer', URL::previous());
		\Bumsgames\Visita::create(['tipo'=>'General']);
		return redirect(Session::get('requestReferrer'));
	}

	function agregaCarro(Request $request){	
		$elemento = collect([
			'id' => $request->id,
			'articulo' => $request->articulo,
			'categoria' => $request->categoria,
			'precio' => (float)$request->precio,
			'imagen' => $request->imagen
		]);

		Session::push('carrito', $elemento);
		$carrito = Session::get('carrito');
		return response()->json($carrito);
	}

	function borrarElementoCarrito(Request $request){

		$x = Session::get('carrito');
		$index = $request->elemento - 1;

		unset($x[$index]);
		$x = array_values($x);
		Session::put('carrito', $x);

		$carrito = Session::get('carrito');
		return response()->json($carrito);

		// // $x = Session::get('carrito')[$request->elemento - 1];
		// unset(Session::get('carrito')[$request->elemento - 1]);
		// return Session::get('carrito');
		// // return Session::get('carrito');
		// return $x;
	}

	function filtrar_articulos(Request $request){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->busca($request->all())
		->orderBy('updated_at', 'desc')
		->get();

		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		
		\Bumsgames\Visita::create(['tipo'=>'General']);
		return view('articulos_web', compact('categorias','articulos','coins','moneda_actual'));
	}

	public function lala(){
		$p = 1;
		$datos = \Bumsgames\Article::where('id','>','0')
		->busca($p)
		->get();

		return $datos;
	}

	public function articulos_oferta(Request $request){
		$articulos = \Bumsgames\Article::where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->busca($request->all())
		->where('oferta', '>=','1')
		->orderBy('updated_at', 'desc')
		->get();

		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		
		$buscador_ruta = 'articulos_oferta';

		$title = 'Articulos en oferta';
		\Bumsgames\Visita::create(['tipo'=>'General']);
		return view('articulos_web', compact('categorias','articulos','coins','moneda_actual', 'title', 'buscador_ruta'));
	}

	public function orden_a_pagar(Request $request){
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}

		$categorias = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);


		$ultimo_pago = \Bumsgames\Pago::orderby('created_at','DESC')->take(1)->get();
		if(!(isset($ultimo_pago->id))){
			$ultimo_pago = 0;
		}else{
			$ultimo_pago = $ultimo_pago->id;
		}

		$date = Carbon::now();

		return view('orden_a_pagar', compact('coins','moneda_actual','ultimo_pago','date'));
	}

	public function reportar_pago(Request $request){
		if(isset($request->id_cupon)){	
			$couponact = Coupon::find($request->id_cupon);
			if($couponact->disponible == 0){
				return response()->json([
					"tipo" => "1",
					"data" => "Lo sentimos, el cupon ha expirado!",
				  ]);
			}
			$request->request->add(['cupon_id' => $request->id_cupon]);
		}
		$ultimo_pago = \Bumsgames\Pago::create($request->all());
		// dd($ultimo_pago->id);
		// dd($request->all());
		if($request->envio == 1){
			$request->request->add(['id_pago' => $ultimo_pago->id]);
			$ultimo_pago = \Bumsgames\Envio_Pago::create($request->all());
		}
		if(isset($request->id_cupon)){
		
			$couponact->disponible--;
			$couponact->save();
		}

		$id_art = json_decode($request->id_articulo);
		for ($i=0; $i < count($id_art); $i++) { 
			\Bumsgames\Pago_Articulo::create(['id_pago' => $ultimo_pago->id,
				'id_article' => $id_art[$i]]);
		}

		return 1;
	}

	public function login(){
		if(Session::has('id_coin')){
			$id_coin = Session::get('id_coin');
		}else{
			$id_coin = 1;
		}
		$categorias = \Bumsgames\Category::All();
		$moneda_actual = \Bumsgames\Coin::find($id_coin);
		$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();


		return view('loginUser.clienteLogin',compact('categorias','moneda_actual','coins'));
	}

	public function loginAuth(Request $request){
		$this->validate($request, [
            'nickname' => 'required|string',
            'password' => 'required|string',
		]);


		if (Auth::guard('client')->attempt(['nickname' => $request->nickname, 'password' => $request->password])) {
			
            return redirect('/adminpaneluser');
		}
		return back()
        ->withErrors(['nickname'=>'Usuario o Clave incorrecto'])
        ->withInput(request(['nickname']));
	}

	public function logout () {
			try {
				Auth::guard('client')->logout();
	
			} catch (\Exception $e) {
			}
			return redirect('/');
		}

	public function canjear(Request $request, $precio){
		$this->validate($request, [
			'cupon' => 'required|string',
		]);
		$coupon =DB::table('coupon')->where('codigo','=',$request->cupon)->first();
		if(!is_null($coupon)){
			if($coupon->disponible > 0){
				if($coupon->descuento >= $precio){
					return back()->withErrors(['cupon'=>'El descuento del cupon no puede ser igual o exceder el monto']);
				}

				if(Session::has('id_coin')){
					$id_coin = Session::get('id_coin');
				}else{
					$id_coin = 1;
				}
		
				$categorias = \Bumsgames\Category::All();
				$coins = \Bumsgames\Coin::where('id','!=',$id_coin)->get();
				$moneda_actual = \Bumsgames\Coin::find($id_coin);
		
		
				$ultimo_pago = \Bumsgames\Pago::orderby('created_at','DESC')->take(1)->get();
				if(!(isset($ultimo_pago->id))){
					$ultimo_pago = 0;
				}else{
					$ultimo_pago = $ultimo_pago->id;
				}
		
				$date = Carbon::now();
				/*
				$couponact = coupon::find($coupon->id);
				$couponact->disponible--;
				$couponact->save();*/

				return view('orden_a_pagar', compact('coins','moneda_actual','ultimo_pago','date','coupon'));
			}
			
			return back()->withErrors(['cupon'=>'Codigo expirado']);
		}
		return back()
		->withErrors(['cupon'=>'Codigo invalido']);
	}

}

