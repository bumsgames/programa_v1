<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use Response;
use App\User;
use GuzzleHttp\Client;
use Bumsgames\Notifications\TaskCompleted;
use Bumsgames\BumsUser;
use Bumsgames\Coin;
use Bumsgames\Movimiento;
use Bumsgames\Reporte;
use Bumsgames\Sales;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class ProgramController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
/*
	function dolar_today(){
		$client = new Client([
			'base_uri' => 'https://s3.amazonaws.com/dolartoday/data.json',
		]);
		$response = $client->request('GET', 'data.json');

		$a = $response->getBody()->getContents();
		// $a=preg_replace('/\s+/', '',$a);
		$a = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $a), true );
		return $precio_dolar = $a['USD']['transferencia'];
	}

	function bitcoin_price(){
		$client = new Client([
			'base_uri' => 'https://api.coindesk.com/v1/bpi/',
		]);
		$response = $client->request('GET', 'currentprice.json/');
		$body = $response->getBody()->getContents();
		$json = json_decode($body); 
		$precio_bitcoin = json_decode($json->bpi->USD->rate_float);
		return $precio_bitcoin;
	}*/

	public function index()
	{
		//$precio_dolar = $this->dolar_today();
		//$precio_dolar_bumsgames = $precio_dolar * 1.05;
		//$precio_dolar_bumsgames = 50000 * floor($precio_dolar_bumsgames/50000);

		//$precio_bitcoin = $this->bitcoin_price();

// 		$dolar_venezuela = Coin::where('id',1)->first();
// 		$dolar_venezuela->fill(['valor' => $precio_dolar_bumsgames]);;
// 		$dolar_venezuela->save();

		$users = \Bumsgames\BumsUser::where('id', '!=', Auth::id())->get();

		$start_day = \Carbon\Carbon::parse('last monday')->startOfDay()->format('Y-m-d');

		$end_day = \Carbon\Carbon::parse('next sunday')->endOfDay()->format('Y-m-d');
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$mejor_vendedores_hoy = \Bumsgames\Sales::
		join('bums_users','bums_users.id','=','id_vendedor')
		->whereDate('sales.created_at', \Carbon\Carbon::today())
		->select(\DB::raw("*, count(*) as ventas"))
		->groupby('id_vendedor')
		->orderby('ventas','desc')
		->get();

		$mejor_vendedores_semana = \Bumsgames\Sales::
		join('bums_users','bums_users.id','=','id_vendedor')
		->whereBetween('sales.created_at',[$start_day,$end_day])
		->select(\DB::raw("*, count(*) as ventas"))
		->groupby('id_vendedor')
		->orderby('ventas','desc')
		->get();

		$articulo_mas_vendido_hoy = \Bumsgames\Sales::
		join('articles','id_article','=','articles.id')
		->join('categories','articles.category','=','categories.id')
		->select(\DB::raw("*, count(*) as ventas"))
		->whereDate('sales.created_at', \Carbon\Carbon::today())
		->groupby('articles.name')
		->groupby('articles.category')
		->get();

		$articulo_mas_vendido_semana = \Bumsgames\Sales::
		join('articles','id_article','=','articles.id')
		->join('categories','articles.category','=','categories.id')
		->select(\DB::raw("*, count(*) as ventas"))
		->whereBetween('sales.created_at',[$start_day,$end_day])
		->groupby('articles.name')
		->groupby('articles.category')
		->orderby('ventas','desc')
		->limit(10)
		->get();

		$articulo_agregados_recientemente = \Bumsgames\Article::
		orderby('created_at','desc')
		->limit(50)
		->get();

		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();

		$coins = \Bumsgames\Coin::All();

		$tutoriales = \Bumsgames\tutorial::All();

		return view('layouts.menu', compact('users', 
			'comments_por_aprobar',
			'mejor_vendedores_hoy',
			'mejor_vendedores_semana',
			'articulo_mas_vendido_hoy',
			'articulo_mas_vendido_semana',
			'coins',
			'articulo_agregados_recientemente',
			'tutoriales',
			'pago_sin_confirmar'
		));
	}

	public function guia(){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('guia',compact('tutoriales','comments_por_aprobar', 'pago_sin_confirmar'));
	}

	public function menu_usuario()
	{
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$users = \Bumsgames\BumsUser::All();
		return view('menu_usuario', compact('users','comments_por_aprobar','tutoriales','pago_sin_confirmar'));
	}

	public function clientes(){
		$tutoriales = \Bumsgames\tutorial::All();
	    $clientes = \Bumsgames\Client::orderby('created_at','desc')->paginate(75);
		$clientes_cantidad = \Bumsgames\Client::orderby('name')->get();
		$clientes_cantidad = $clientes_cantidad->count();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('clientes', compact('clientes','comments_por_aprobar','clientes_cantidad','tutoriales', 'pago_sin_confirmar'));
	}

	public function clientesFilt(){
		$tutoriales = \Bumsgames\tutorial::All();
		$buscador  = Input::get('buscador');
		$clientes = \Bumsgames\Client::orderby('name')
		->where('name','like','%'.$buscador.'%')
		->orwhere('lastname','like','%'.$buscador.'%')
		->orwhere('nickname','like','%'.$buscador.'%')
		->orwhere('email','like','%'.$buscador.'%')
		->orwhere('num_contact','like','%'.$buscador.'%')->paginate(10);

		$clientes_cantidad = \Bumsgames\Client::orderby('name')
		->where('name','like','%'.$buscador.'%')
		->orwhere('lastname','like','%'.$buscador.'%')
		->orwhere('nickname','like','%'.$buscador.'%')
		->orwhere('email','like','%'.$buscador.'%')
		->orwhere('num_contact','like','%'.$buscador.'%')->count();
	
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$clientes->appends(['buscador' => $buscador]);
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('clientes', compact('clientes','comments_por_aprobar','clientes_cantidad','tutoriales', 'pago_sin_confirmar'));
	}

	public function mis_clientes(){
		$tutoriales = \Bumsgames\tutorial::All();

		$clientes = \Bumsgames\Sales::join('clients', 'id_client', '=', 'clients.id')
		->where('id_vendedor', Auth::id())
		->groupby('id_client')
		->orderby('clients.created_at','DESC')
		->paginate(75);

		$clientes_cantidad = \Bumsgames\Sales::join('clients', 'id_client', '=', 'clients.id')
		->where('id_vendedor', Auth::id())
		->groupby('id_client')
		->orderby('clients.name')
		->get();
		$clientes_cantidad = $clientes_cantidad->count();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('clientes', compact('clientes','comments_por_aprobar','clientes_cantidad','tutoriales', 'pago_sin_confirmar'));
	}

	public function ventas(){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$sales = \Bumsgames\Sales::orderby('created_at','desc')->get();
		$title = 'Ventas generales';
		$usuarios = \Bumsgames\BumsUser::All();
		return view('ventas', compact('title','comments_por_aprobar', 'sales', 'usuarios','tutoriales', 'pago_sin_confirmar'));
	}

	public function obtenerVentas($id_usuario=false, $fecha_inicio=false, $fecha_final=false){
		if($id_usuario!=0 && $fecha_inicio && $fecha_final){
			$sales = Sales::orderby('created_at','desc')->where('created_at','>=',$fecha_inicio)->where('created_at','<=',$fecha_final)->where('id_vendedor',$id_usuario)->get();
		}elseif($id_usuario==0 && $fecha_inicio && $fecha_final){
			$sales = Sales::orderby('created_at','desc')->where('created_at','>=',$fecha_inicio)->where('created_at','<=',$fecha_final)->get();
		}elseif($id_usuario && !$fecha_inicio && !$fecha_final){
			$sales = Sales::orderby('created_at','desc')->where('id_vendedor',$id_usuario)->get();
		}else{
			$sales = Sales::orderby('created_at','desc')->get();
		}

		$sales_list = [];
		$count_sales = 1;
		foreach($sales as $key => $sale){

			$duennos = "";
			foreach($sale->articulo->duennos as $duenno) {
				$duennos = $duenno->name." ".$duenno->lastname;
			}

			$sales_list[] = [$count_sales, $sale->user->name." ".$sale->user->lastname, "<strong>Artículo: </strong>".$sale->articulo->name."<br> <strong>Categoría: </strong>".$sale->articulo->pertenece_category->category."<br><br> <strong>Dueño(s): </strong>".$duennos, "<strong>Cliente: </strong>".$sale->cliente->name." ".$sale->cliente->lastname."<br> <strong>Cantidad: </strong>".$sale->movimiento->cantidad."<br> <strong>Precio unitario: </strong>".$sale->movimiento->price." ".$sale->movimiento->moneda->coin."<br><br> <strong>Total: </strong>".number_format($sale->movimiento->price * $sale->movimiento->cantidad, 0, ',', '.')." | ".$sale->movimiento->moneda->coin." | ".$sale->movimiento->entidad, $sale->created_at->format('d M Y ')."<br>".$sale->created_at->diffForHumans()];
			$count_sales++;
		}

		return response()->json(['data' => $sales_list]);
	}

	public function filtrarVentas(Request $request){
		$tutoriales = \Bumsgames\tutorial::All();

		$id_usuario = $request->get("id_usuario");
		$fecha_inicio = $request->get("fecha_inicio");
		$fecha_final = $request->get("fecha_final");

		if($id_usuario) {
			$sales = Sales::orderby('created_at','desc')->where('created_at','>=',$fecha_inicio)->where('created_at','<=',$fecha_final)->where('id_vendedor',$id_usuario)->get();
		}else{
			$sales = Sales::orderby('created_at','desc')->where('created_at','>=',$fecha_inicio)->where('created_at','<=',$fecha_final)->get();
		}
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$title = 'Ventas generales';
		$usuarios = \Bumsgames\BumsUser::All();
		return view('ventas_filtradas', compact('title','comments_por_aprobar','tutoriales', 'sales', 'usuarios', 'id_usuario', 'fecha_inicio', 'fecha_final', 'pago_sin_confirmar'));
	}

	public function ventas_mias(){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$sales = Sales::orderby('created_at','desc')->where('id_vendedor', Auth::id())->get();
		$usuarios = \Bumsgames\BumsUser::All();
		$title = 'Tus ventas';
		return view('ventas_mias', compact('title','comments_por_aprobar', 'sales', 'usuarios','tutoriales','pago_sin_confirmar'));
	}

	public function ordenes(){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$ordenes = \Bumsgames\Orden_Envio::All();
		return view('ordenes', compact('ordenes','comments_por_aprobar','tutoriales','pago_sin_confirmar'));
	}

	public function ordenes_cuenta(Request $request){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$ordenes = \Bumsgames\Orden_Envio::where('id_cuenta',$request->id)
		->orderby('created_at','desc')->get();
		$moneda = 'Bs';
		return view('ordenes_cuenta', compact('ordenes','comments_por_aprobar', 'moneda','tutoriales','pago_sin_confirmar'));
	}

	public function configurar_tu_user(Request $request){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('configurar_tu_user',compact('tutoriales','comments_por_aprobar','pago_sin_confirmar'));
	}

	public function registrar_orden(Request $request){

		$cuenta = \Bumsgames\Cuenta::find($request->id_cuenta);

		$dinero_en_cuenta = $cuenta->ordenes->sum('price');

		if(($dinero_en_cuenta - $request->price) < 0){
			return response()->json([
				"tipo" => 1,
				"data" => "No se puede hacer la consulta, tienes menos saldo de lo que vas a gastar."
			]);
		}

		$price = $request->price * -1;
		$request->request->add(['price' => $price]);
		$request->request->add(['description' => 'Orden de cuenta']);
		$request->request->add(['note_movimiento' => 'Orden de cuenta']);
		$request->request->add(['type' => 'bums']);
		$request->request->add(['id_coin' => $cuenta->id_coin]);
		$request->request->add(['entidad' => $cuenta->entidad]);
		$request->request->add(['porcentaje' => '100']);

		$movimiento = \Bumsgames\Movimiento::create($request->all());

		$request->request->add(['id_cuenta' => $request->id_cuenta]);
		$request->request->add(['id_recibeUsuario' => Auth::id() ]);
		$request->request->add(['id_creadoUsuario' => Auth::id() ]);
		$request->request->add(['id_movimiento' => $movimiento->id]);

		$orden = \Bumsgames\Orden_Envio::create($request->all());

		$request->request->add(['porcentaje' => 100]);
		$request->request->add(['descripcion_movimiento' => 'Orden de cuenta']);
		$request->request->add(['permiso' => '1']);
		$request->request->add(['movimiento_usuario' => Auth::id()]);
		$request->request->add(['id_movimiento' => $movimiento->id]);
		\Bumsgames\BumsUser_Movimiento::create($request->all());

		return $request->all();
	}

	public function clientes_totales(){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('clientes_totales',compact('tutoriales','comments_por_aprobar','pago_sin_confirmar'));
	}

	public function cuentas()
	{
		$tutoriales = \Bumsgames\tutorial::All();

		$coins = \Bumsgames\Coin::All();
		$cuentas_tuyas = \Bumsgames\Cuenta::where('id_bumsuser', '=', Auth::id())->get();
		$title = "Cuentas en especifico";
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('cuentas',compact('title','coins','comments_por_aprobar', 'cuentas_tuyas','tutoriales','pago_sin_confirmar'));
	}

	public function cuentas_todas()
	{
		$tutoriales = \Bumsgames\tutorial::All();

		$coins = \Bumsgames\Coin::All();
		$cuentas_tuyas = \Bumsgames\Cuenta::All();
		$title = "Todas las cuentas";
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('cuentas',compact('title','coins','comments_por_aprobar', 'cuentas_tuyas','tutoriales','pago_sin_confirmar'));
	}

	public function formulario_registrar_articulo()
	{
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		foreach($categories as $category){
			$cat[$category->id]=$category->category;
		}
		return view('registrar_articulo', compact('users','comments_por_aprobar', 'categories', 'cat','tutoriales','pago_sin_confirmar'));
	}
	public function Modificar_Articulo()
	{
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$bancos = \Bumsgames\banco_emisor::All();

		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		return view('Allarticle', compact('users','bancos','comments_por_aprobar', 'categories','tutoriales','pago_sin_confirmar'));
	}

	public function prueba(){
		$articulo = \Bumsgames\Article::find(237);
		return $articulo->duennos;
	}

	public function actualizar_uss(Request $request)
	{
		if(isset($request->password)){
			$request->request->add(['password' => bcrypt($request->password)]);
		}
		$usuario = \Bumsgames\BumsUSer::find($request->id);
		$usuario->fill($request->all());
		$usuario->save();
		$titulo = 'USUARIO ACTUALIZADO';
		$data = 'Accion por: '.auth()->user()->name.' '.auth()->user()->lastname;
		$data2 = '';
		$users = BumsUser::where('level','>=','7')->get();
		foreach ($users as $user){
			$user->notify(new TaskCompleted($titulo,$data,$data2));
		}


		return response()->json([
			"mensaje" =>"Modificado"
		]);
	}

	public function devolver_articulo(Request $request){
		$pertenece = \Bumsgames\PerteneceCliente::where('id','=',$request->id)->first();

		$article = \Bumsgames\Article::where('id','=',$request->id_articulo)->first();
		$quantity = $article->quantity + 1;
		$article->fill(['quantity' => $quantity]);
		$anexado= '<br>Devuelto:  '.$article->pertenece_category->category.' Fecha: '.Carbon::now()->format('d-m-Y').'. Por: '.Auth::user()->name.' '.Auth::user()->lastname.'. ';
		$anexado = $anexado.' Dueño anterior: '.$pertenece->cliente->name.' '.$pertenece->cliente->lastname;
		$anexado=$article->note.$anexado;
		$informacion = 'Devuelto:  '.$article->name.' | '.$article->pertenece_category->category.' <span id="textimport">| '.$article->email.'</span> |  Fecha: '.Carbon::now()->format('d-m-Y').'. Por: '.Auth::user()->name.' '.Auth::user()->lastname.'. ';

		$article->fill(['note'=> $anexado]);
		$article->save();		

		$informacion = $informacion.' Dueño anterior: '.$pertenece->cliente->name.' '.$pertenece->cliente->lastname;
		$pertenece->fill(['id_article' => '2']);
		$pertenece->fill(['informacion' => $informacion]);
		$pertenece->save();

		return $request->all();
	}

	public function devolverA(Request $request){
		$relacionCliente_Articulo = \Bumsgames\PerteneceCliente::find($request->id_pertenece);

		$articulo = \Bumsgames\Article::find($relacionCliente_Articulo->id_article);
		if($articulo->id == 2){
			return Response::json([
				'message' => 'No se puede devolver un articulo devuelto'
			], 500);
		}
		if($articulo->category == 1 
			|| $articulo->category == 2 
			|| $articulo->category == 8 
			|| $articulo->category == 9 
			|| $articulo->category == 12){
			$anexado= '<br>Devuelto:  '.$articulo->pertenece_category->category.' Fecha: '.Carbon::now()->format('d-m-Y').'. Por: '.Auth::user()->name.' '.Auth::user()->lastname.'. ';
			$anexado = $anexado.' Dueño anterior: '.$relacionCliente_Articulo->cliente->name.' '.$relacionCliente_Articulo->cliente->lastname;

			$anexado=$articulo->note.$anexado;
			$informacion = 'Devuelto:  '.$articulo->name.' | '.$articulo->pertenece_category->category.' <span id="textimport">| '.$articulo->email.'</span> |  Fecha: '.Carbon::now()->format('d-m-Y').'. Por: '.Auth::user()->name.' '.Auth::user()->lastname.'. ';

			$articulo->fill(['note'=> $anexado]);
			$articulo->fill(['quantity'=> 1]);
			$articulo->save();

			$articulo = $relacionCliente_Articulo->articulo->name;
			$category = $relacionCliente_Articulo->articulo->pertenece_category->category;
			$email = $relacionCliente_Articulo->articulo->email;
			$cliente = $relacionCliente_Articulo->cliente->name.' '.$relacionCliente_Articulo->cliente->lastname;
			$informacion = $informacion.' Dueño anterior: '.$relacionCliente_Articulo->cliente->name.' '.$relacionCliente_Articulo->cliente->lastname;


			DB::statement('UPDATE pertenece_clientes SET id_article="2" WHERE id="'.$request->id_pertenece.'" ');

			$relacionCliente_Articulo->fill(['informacion' => $informacion]);
			$relacionCliente_Articulo->save();
			return Response::json([
				'message' => 'Exitoso'
			], 200);
		}else{
			return Response::json([
				'message' => 'Este tipo de categoria no se puede devolver, debe eliminar la venta desde el Modulo movimientos'
			], 500);
		}
	}

	public function registrar_cuenta(Request $request){


		$request->request->add(['id_bumsuser' => Auth::id()]);

		$cuenta = \Bumsgames\Cuenta::where('entidad', $request->entidad)->where('correo', $request->correo)->get();
		$mensaje = 'Ya hay una cuenta de '.$request->entidad.', registrada con ese correo: '.$request->correo.'';

		if($cuenta->count() > 0){
			return response()->json([
				"tipo" => '1',
				"data" => $mensaje
			]);
		}

		$cuenta = \Bumsgames\Cuenta::create($request->all());

		$request->request->add(['description' => 'Saldo agregado a cuenta']);
		$request->request->add(['note_movimiento' => 'Saldo agregado a cuenta']);
		$request->request->add(['type' => 'bums']);


		$movimiento = \Bumsgames\Movimiento::create($request->all());

		$request->request->add(['articulo' => 'Saldo agregado']);
		$request->request->add(['type_orden' => 'Saldo agregado']);
		$request->request->add(['id_cuenta' => $cuenta->id]);
		$request->request->add(['id_recibeUsuario' => Auth::id()]);
		$request->request->add(['id_creadoUsuario' => Auth::id()]);
		$request->request->add(['id_movimiento' => $movimiento->id]);

		$orden = \Bumsgames\Orden_Envio::create($request->all());

		$request->request->add(['porcentaje' => 100]);
		$request->request->add(['descripcion_movimiento' => 'Saldo agregado a cuenta']);
		$request->request->add(['permiso' => '1']);
		$request->request->add(['movimiento_usuario' => Auth::id()]);
		$request->request->add(['id_movimiento' => $movimiento->id]);
		\Bumsgames\BumsUser_Movimiento::create($request->all());
		// $request->request->add(['movimiento_usuario' => Auth::id()]);
		// $request->request->add(['type' => 'bums']);
		// $request->request->add(['description' => 'Cuenta Agregada | Bums']);

		// $movimiento = \Bumsgames\Movimiento::create($request->all());

		// $request->request->add(['movimiento_usuario' => Auth::id()]);
		// $request->request->add(['id_movimiento' => $movimiento->id]);
		// $request->request->add(['id_cuenta' => $cuenta->id]);
		// $request->request->add(['porcentaje' => 100]);
		// $request->request->add(['permiso' => 1]);
		// $request->request->remove('type');
		// \Bumsgames\BumsUser_Movimiento::create($request->all());
		// return response()->json([
		// 	"correo" => 'fdsfdsfdsfds'
		// ]);
	// return $request->all();
		return response()->json([
			"mensaje"=> $request->all()
		]);
	}

	public function articulos_bd(Request $request){
		$tutoriales = \Bumsgames\tutorial::All();

		// $articles = \Bumsgames\Article::
		// where(function($q) use ($request){
		// 	$q->where('email','like','%'.$request->coincidencia.'%')
		// 	->orWhere('name','like','%'.$request->coincidencia.'%')
		// 	->orWhere('nickname','like','%'.$request->coincidencia.'%');
		// })
		// ->orderby('name')
		// ->orderby('quantity','asc')
		// ->paginate(100);

		$articles = \Bumsgames\Article::
		where(function($q) use ($request){
			$q->Where('name','like','%'.$request->coincidencia.'%');
		})
		->orderby('category')
		->orderby('email')
		->orderby('name')
		->orderby('quantity','DESC')
		->paginate(5000);

		$articles_cantidad = $articles->count();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$comments_por_aprobar = \Bumsgames\Comment::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('aprobado','!=',0)
			->orWhere('aprobado','!=',1);
		})->get();
		$bancos = \Bumsgames\banco_emisor::All();

		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::All();
		$title = "Buscador de coincidencia en la base de datos";

		$busqueda = $request->coincidencia;
		return view('allArticle', compact('title','bancos','comments_por_aprobar','pago_sin_confirmar' , 'articles','coins','users','categories', 'articles_cantidad','tutoriales','busqueda'));
	}

	public function allArticle(){
// 		$articles = \Bumsgames\Article::
// 		where('quantity','>=','1')
// 		->select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note"))
// 		->orderby('name')
// 		->paginate(100);
		$tutoriales = \Bumsgames\tutorial::All();

		$articles = \Bumsgames\Article::
		where('quantity','>=','-1000')
		->where("id","!=","2")
		->select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note, offer_price, peso"))
		->orderby('email')
		->orderby('category')
		->paginate(100);

		$articles_cantidad = \Bumsgames\Article::
		where('quantity','>=','0')
		->where('id','!=','2')
		->get();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$articles_cantidad = $articles_cantidad->count();
		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::All();
		$bancos = \Bumsgames\banco_emisor::All();
		$title = "Todos los articulos disponibles.";


		return view('allArticle', compact('title','comments_por_aprobar','pago_sin_confirmar' , 'articles','coins','users','categories', 'articles_cantidad','tutoriales','bancos'));
	}
	public function allOrdenados(Request $request){
		switch ($request->parametro) {
			case 1:
				$parametre = 'price_in_dolar';
				break;
			case 2:
				$parametre = 'offer_price';
				break;
			case 3:
				$parametre = 'name';
				break;
			case 4:
				$parametre = 'nickname';
				break;	
			case 5:
				$parametre = 'email';
				break;
			case 6:
				$parametre = 'reset_button';
				break;
		}
		switch($request->mayormenor){
			case 1:
				$maymen = 'DESC';
				break;
			case 2:
				$maymen = 'ASC';
				break;
		}
		$articles = \Bumsgames\Article::
		where('quantity','>=','-1000')
		->where('id','!=','2')
		->select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note, offer_price, peso"))
		->orderby($parametre,$maymen)
		->orderby('category')
		->paginate(100);

		$articles_cantidad = \Bumsgames\Article::
		where('quantity','>=','0')
		->where('id','!=','2')
		->get();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$articles_cantidad = $articles_cantidad->count();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::All();
		$title = "Todos los articulos disponibles.";
		$bancos = \Bumsgames\banco_emisor::All();

		$articles->appends(['parametro' => $request->parametro]);
		$articles->appends(['mayormenor' => $request->mayormenor]);

		return view('allArticle', compact('title','bancos','comments_por_aprobar','pago_sin_confirmar', 'articles','coins','users','categories', 'articles_cantidad','tutoriales'));
	
	}

	//Retorna los articulos sin imagenes
	public function Articulos_Sin_Imagen(){

		$articles = \Bumsgames\Article::where('articles.quantity','>=','-1000')
		->where('articles.id','!=','2')
		->where('articles.fondo','like','azar.jpg')
		->get();

		$articles_cantidad = $articles->count();

		$tutoriales = \Bumsgames\tutorial::All();

		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::All();
		$title = "Todos los articulos sin imagenes.";
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		
		return view('articleNoImage', compact('title','bancos','comments_por_aprobar', 'articles','coins','users','categories', 'articles_cantidad','tutoriales'));
	}

	//Agrega la imagen a todos los articulos iguales
	public function Actualizar_Imagen(Request $request, $id){
		$article = \Bumsgames\Article::find($id);

		$article->fondo = $request->image;
		 //Se buscan todos los articulos de la misma categoria y nombre
		
		 if(($article->category == 1) || ($article->category == 2)){
			$articles = \Bumsgames\Article::where('name',$article->name)
			->whereIn('category',[1,2])
			->get();
		 }
		 else if(($article->category == 8) || ($article->category == 9)){
			$articles = \Bumsgames\Article::where('name',$article->name)
			->whereIn('category',[8,9])
			->get();
		 }
		 else{
			$articles = \Bumsgames\Article::where('name',$article->name)
			->where('category',$article->category)
			->get();
		 }

		 //Se actualizan todos los articulos iguales
		 foreach($articles as $art){
			 $art->fondo = $request->image;
			 $art->save();
		 }

		 $article->save();

		 return back();
	}

	//Retorna los articulos sin peso
	public function Articulos_Sin_Peso(){

		$articles = \Bumsgames\Article::where('articles.quantity','>=','-1000')
		->where('articles.peso','0')
		->where('articles.id','!=','2')		
		->whereIn('articles.category',[1,2,3,5,7,8,9,10,12,13])
		->get();

		$articles_cantidad = $articles->count();

		$tutoriales = \Bumsgames\tutorial::All();

		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::All();
		$title = "Todos los articulos sin peso.";
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		
		return view('articleNoPeso', compact('title','bancos','comments_por_aprobar', 'articles','coins','users','categories', 'articles_cantidad','tutoriales'));
	}

	public function Actualizar_Peso(Request $request, $id){

		$article = \Bumsgames\Article::find($id);

		$article->peso = $request->peso;

		 //Se buscan todos los articulos de la misma categoria y nombre
		 if(($article->category == 1) || ($article->category == 2)){
			$articles = \Bumsgames\Article::where('name',$article->name)
			->whereIn('category',[1,2])
			->get();
		 }
		 else if(($article->category == 8) || ($article->category == 9)){
			$articles = \Bumsgames\Article::where('name',$article->name)
			->whereIn('category',[8,9])
			->get();
		 }
		 else{
			$articles = \Bumsgames\Article::where('name',$article->name)
			->where('category',$article->category)
			->get();
		 }
		 //Se actualizan todos los articulos iguales
		 foreach($articles as $art){
			 $art->peso = $request->peso;
			 $art->save();
		 }

		 $article->save();

		 return back();
	}

	public function aplicar_filtros_multiples(Request $request){
		$namefilt = $request->namefilt;
		$category= $request->selcat;
		$filtrocorreo = $request->filtrocorreo;
		$disponible = $request->disponible;
		$creatorfilter = $request->creatorfilter;
		$nickfil = $request->nickfil;
		$precio = $request->precio;
		$oferta = $request->oferta;
		$peso = $request->peso;
		$seldu = $request->seldu;

		$busqueda = $request->namefilt;
		$parametros = [$category,$filtrocorreo,$disponible,$creatorfilter,$nickfil,$precio,$oferta,$peso,$seldu];

		$articles = \Bumsgames\Article::where('articles.quantity','>=','-1000')
		->where('articles.id','!=','2');

		if(isset($namefilt)){
			$articles->where('name','LIKE','%'.$namefilt.'%');
		}
		if($category != 0){
			$articles->where('category',$category);
		}
		if(isset($filtrocorreo)){
			$articles->where('email','LIKE','%'.$filtrocorreo.'%');
		}
		if($disponible == 1){
			$articles->where('quantity','>',0);
		}
		if($disponible == 2){
			$articles->where('quantity','=',0);
		}
		if($creatorfilter !=0){
			$articles->where('id_creator',$creatorfilter);
		}
		if(isset($nickfil)){
			$articles->where('nickname','LIKE','%'.$nickfil.'%');
		}
		if($precio > 0){
			$articles->where('price_in_dolar','>=',$precio);
		}
		if($oferta > 0){
			$articles->where('offer_price','>=',$oferta);
		}
		if($peso > 0){
			$articles->where('peso','>=',$peso);
		}		

		if($seldu != 0){
			$articles->join('bums_user_articles','bums_user_articles.id_article','=','articles.id')
			->where('bums_user_articles.id_bumsuser','=',$seldu);
		}
		$articles_cantidad = $articles->count();

		$articles = $articles->select(\DB::raw("articles.id, articles.id_creator, articles.name, articles.category, articles.price_in_dolar, articles.quantity, articles.email, articles.password, articles.nickname, articles.reset_button, articles.note, articles.offer_price, articles.peso"))
		->orderby('articles.id')
		->orderby('articles.category')
		->paginate(100);
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		if(isset($namefilt)){
			$articles->appends(['namefilt' => $namefilt]);
		}
		if($category != 0){
			$articles->appends(['selcat' => $category]);
		}
		if(isset($filtrocorreo)){
			$articles->appends(['filtrocorreo' => $filtrocorreo]);
		}
		if($disponible == 1){
			$articles->appends(['disponible' => $disponible]);
		}
		if($disponible == 2){
			$articles->appends(['disponible' => $disponible]);
		}
		if($creatorfilter !=0){
			$articles->appends(['creatorfilter' => $creatorfilter]);
		}
		if(isset($nickfil)){
			$articles->appends(['nickfil' => $nickfil]);
		}
		if($precio > 0){
			$articles->appends(['precio' => $precio]);
		}
		if($oferta > 0){
			$articles->appends(['oferta' => $oferta]);
		}
		if($peso > 0){
			$articles->appends(['peso' => $peso]);
		}
		$bancos = \Bumsgames\banco_emisor::All();

		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::All();
		$title = "Todos los articulos disponibles.";
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		
		return view('allArticle', compact('title','bancos','comments_por_aprobar','pago_sin_confirmar', 'articles','coins','users','categories', 'articles_cantidad','tutoriales','parametros','busqueda'));
	}
	public function categoria_art($category){
		$articles = \Bumsgames\Article::
		select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note, offer_price, peso"))
		->where('quantity','>=','1')
		->where('category',$category)
		->where('id','!=','2')
		->orderby('name')
		->orderby('quantity','DESC')
		->paginate(200);

		$articles_cantidad = \Bumsgames\Article::
		select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note, offer_price, peso"))
		->where('quantity','>=','1')
		->where('category',$category)
		->where('id','!=','2')
		->orderby('name')
		->get();

		$articles_cantidad = $articles_cantidad->count();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$bancos = \Bumsgames\banco_emisor::All();

		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$category = \Bumsgames\Category::find($category);
		$coins = \Bumsgames\Coin::All();
		$title = "Todos los articulos disponibles. (".$category->category.")";
		return view('allArticle', compact('title','bancos','comments_por_aprobar','pago_sin_confirmar', 'articles','coins','users','categories','articles_cantidad','tutoriales'));
	}

	public function categoria_artOff($category){
		if($category != 5){
			$articles = \Bumsgames\Article::
			select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note"))
			->where('quantity','<=','0')
			->where('category',$category)
			->where('id','!=','2')
			->orderby('name')
			->paginate(100);

			$articles_cantidad = \Bumsgames\Article::
			select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note"))
			->where('quantity','<=','0')
			->where('category',$category)
			->where('id','!=','2')
			->orderby('name')
			->get();
		}else{
			$articles = \Bumsgames\Article::
			select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note"))
			->where('quantity','<=','0')
			->where('category',$category)
			->where('id','!=','2')
			->orderby('reset_button','desc')
			->orderby('name')
			->paginate(100);

			$articles_cantidad = \Bumsgames\Article::
			select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note"))
			->where('quantity','<=','0')
			->where('category',$category)
			->where('id','!=','2')
			->orderby('name')
			->get();
		}

		$articles_cantidad = $articles_cantidad->count();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$bancos = \Bumsgames\banco_emisor::All();

		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$category = \Bumsgames\Category::find($category);
		$coins = \Bumsgames\Coin::All();
		$title = "Todos los articulos agotados. (".$category->category.")";
		return view('allArticle', compact('tutoriales','bancos','comments_por_aprobar','pago_sin_confirmar','title', 'articles','coins','users','categories','articles_cantidad','article_cantidad'));
	}

	public function allArticles_cat($category){
		$articles = \Bumsgames\Article::
		select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note"))
		->where('quantity','>=','1')
		->where('category',$request->category)
		->where('id','!=','2')
		->orderby('name')
		->paginate(100);

		$articles_cantidad = \Bumsgames\Article::
		select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note"))
		->where('quantity','>=','1')
		->where('category',$request->category)
		->where('id','!=','2')
		->orderby('name')
		->get();

		$articles_cantidad = $articles_cantidad->count();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$category = \Bumsgames\Category::find($request->category);
		$coins = \Bumsgames\Coin::All();
		$bancos = \Bumsgames\banco_emisor::All();

		$title = "Todos los articulos disponibles. (".$category->category.")";
		return view('allArticle', compact('tutoriales','bancos','comments_por_aprobar','pago_sin_confirmar','title', 'articles','coins','users','categories','articles_cantidad'));
	}

	public function allArticles_catOff(Request $request){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$articles = \Bumsgames\Article::
		select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note"))
		->where('quantity','<=','0')
		->where('category',$request->category)
		->orderby('reset_button','desc')
		->orderby('name')
		->get();
		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$category = \Bumsgames\Category::find($request->category);
		$coins = \Bumsgames\Coin::All();
		$bancos = \Bumsgames\banco_emisor::All();

		$title = "Todos los articulos agotados. (".$category->category.")";
		return view('allArticle', compact('tutoriales','bancos','comments_por_aprobar','pago_sin_confirmar','title', 'articles','coins','users','categories'));
		
	}

	public function allArticlesOff(){
		$articles = \Bumsgames\Article::
		where('quantity','<=','0')
		->where('id','!=','2')
		->select(\DB::raw("id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, note, offer_price, peso"))
		->orderby('name')
		->paginate(100);
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$articles_cantidad = \Bumsgames\Article::
		where('quantity','<=','0')
		->where('id','!=','2')
		->get();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$articles_cantidad = $articles_cantidad->count();
		$tutoriales = \Bumsgames\tutorial::All();
		$bancos = \Bumsgames\banco_emisor::All();

		$users = \Bumsgames\BumsUser::All();
		$categories = \Bumsgames\Category::All();
		$coins = \Bumsgames\Coin::All();
		$title = "Todos los articulos agotados.";
		return view('allArticle', compact('tutoriales','bancos','comments_por_aprobar','pago_sin_confirmar','title', 'articles','coins','users','categories', 'articles_cantidad'));
	}


	public function misArticles(){
		$articles = \Bumsgames\Article::join('bums_user_articles', 'articles.id', '=', 'bums_user_articles.id_article')
		->selectRaw('articles.id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, porcentaje, articles.id as id_articulo, note, offer_price, peso')
		->where('bums_user_articles.id_bumsuser', Auth::id())
		->where('articles.id','!=','2')
		->orderby('name')
		->paginate(100);
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$articles->cantidad = \Bumsgames\Article::join('bums_user_articles', 'articles.id', '=', 'bums_user_articles.id_article')
		->selectRaw('articles.id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, porcentaje, articles.id as id_articulo, note, offer_price, peso')
		->where('bums_user_articles.id_bumsuser', Auth::id())
		->where('articles.id','!=','2')
		->orderby('name')
		->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$articles_cantidad = $articles->cantidad->count();
		$bancos = \Bumsgames\banco_emisor::All();

		$coins = \Bumsgames\Coin::All();
		$title = "Mis articulos";
		return view('misArticles', compact('tutoriales','bancos','comments_por_aprobar','pago_sin_confirmar','title', 'articles','coins','articles_cantidad'));
	}

	public function articles_web(){
		$articles = \Bumsgames\Article::
		selectRaw('id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, sum(quantity) as quantity, note, offer_price, peso')
		->where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->orderBy('quantity', 'desc')
		->orderBy('name')
		->paginate(100);
		$tutoriales = \Bumsgames\tutorial::All();

		$articles_cantidad = \Bumsgames\Article::
		selectRaw('id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, sum(quantity) as quantity, note, offer_price, peso')
		->where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->orderBy('quantity', 'desc')
		->orderBy('name')
		->get();
		$categories = \Bumsgames\Category::All();
		$users = \Bumsgames\BumsUser::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$bancos = \Bumsgames\banco_emisor::All();

		$articles_cantidad = $articles_cantidad->count();
		$coins = \Bumsgames\Coin::All();
		$title = "Articulos de la Pagina Web.";
		return view('allArticle', compact('tutoriales','bancos','comments_por_aprobar','pago_sin_confirmar','users','title', 'articles','coins','articles_cantidad','categories'));
	}

	public function modo_ml(){
		$articles_on = \Bumsgames\Article::
		selectRaw('id, name, category, price_in_dolar, quantity, sum(quantity) as quantity, updated_at')
		->where('quantity', '>', 0)
		->where('id','!=','2')
		->groupBy('name','category')
		->orderBy('updated_at','desc')
		->get();

		$articles_off = \Bumsgames\Article::
		selectRaw('id, name, category, price_in_dolar, quantity, sum(quantity) as quantity, updated_at')
		->where('quantity', '<=', 0)
		->where('id','!=','2')
		// ->whereNotIn('name', function($q){
  //           $q->select('name')->from('articles')->where('quantity','>', 0)->groupBy('name','category');
  //       })
		// ->whereNotExists(function($q){
  //           $q->selectRaw(1)
  //           ->from('articles')
  //           ->where('quantity','>', 0)
  //           ->groupBy('name','category');
  //       })
		->groupBy('name','category')
		->orderBy('updated_at','desc')
		->get();

		$i = 0;
		foreach($articles_off as $articulo){
			$coincidencia = \Bumsgames\Article::
			where('name', $articulo->name)
			->where('category', $articulo->category)
			->where('quantity', '>', 0)
			->first();

			if($coincidencia){
				unset($articles_off[$i]);
			}
			$i++;
		}
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$precio_dolar_bumsgames =\Bumsgames\Coin::find(1);
		$precio_dolar_bumsgames = $precio_dolar_bumsgames->valor;
		return view('modo_ml', compact('tutoriales','comments_por_aprobar','pago_sin_confirmar','articles_on', 'articles_off','precio_dolar_bumsgames'));
	}

	public function coincidencia(Request $request){
		$coincidencia = \Bumsgames\Client::where('name','like','%'.$request->name_client.'%')->where('lastname','like','%'.$request->lastname_client.'%')->get();
		return response()->json([
			"mensaje" => $coincidencia
		]);
	}
	public function coincidenciaArticulo(Request $request){
		$coincidencia = \Bumsgames\Article::where('name','like','%'.$request->name.'%')->groupBy('name','category')
		->get();
		$categoria = \Bumsgames\Category::all();
		return response()->json([
			"mensaje" => $coincidencia,
			"cat" => $categoria
		]);
	}

	public function modicacion_rapida_get(Request $request){
		$articuloRapido = \Bumsgames\Article::where('id',$request->id)->first();

		return response()->json([
			"data" => $articuloRapido,
		]);
	}

	public function realizar_venta(Request $request){
		$this->validate($request, [
			'name' => 'required|string',
			'lastname' => 'required|string',
			'num_contact' => 'required|string',
			'cantidad' => 'required|integer',
			'entidad' => 'required|string',
			'price' => 'required|integer',
			'id_coin' => 'required',
		]);

		$article = \Bumsgames\Article::where('id','=',$request->id_article)->first();
		if(!isset($article->duennos[0])){
			return response()->json([
				"tipo" => 1,
				"data" => "No puedes vender un articulo sin dueño"
			]);
		}
		$quantity = $article->quantity - $request->cantidad;
		if($quantity < 0){
			return response()->json([
				"tipo" => 1,
				"data" => "El articulo no tiene suficiente cantidad"
			]);
		}

		$article->fill(['quantity' => $quantity]);
		$article->save();

		$art = \Bumsgames\Article::where('name',$article->name)
		->where('category',$article->category)
		->get();
		
		if($art->sum('quantity') == 0){
			$temporal = \Bumsgames\Category::find($article->category);
			$temporal = $temporal->category;
			$titulo = 'SE AGOTO';
			$data = "Articulo: ".$article->name;
			$data2 = "Categoria: ".$temporal;
			$users = BumsUser::where('level','>=','7')->get();
			foreach ($users as $user){
				$user->notify(new TaskCompleted($titulo,$data, $data2));
			}
		}

		$titulo = 'ARTICULO VENDIDO POR:'.auth()->user()->name.' '.auth()->user()->lastname;
		$data = "Articulo: ".$article->name;
		$data2 = "Categoria: ".$article->pertenece_category->category;
		$users = BumsUser::where('level','>=','9')->get();
		foreach ($users as $user){
			$user->notify(new TaskCompleted($titulo,$data, $data2));
		}

		//registrando o actualizando cliente
		$cliente = \Bumsgames\Client::where('id','=',$request->id)->first();
		if(isset($cliente)){
			$cliente->fill($request->all());
			$cliente->save();
		}else{
			$cliente = \Bumsgames\Client::create($request->all());
		}
		$valordia= \Bumsgames\Coin::where('coin','=','Bolivares')->first();


		//creando movimiento
		$request->request->add(['cantidad' => $request->cantidad]);
		$request->request->add(['price'    => $request->price]);
		$request->request->add(['note_movimiento' => $request->note_sale]);
		$request->request->add(['dolardia' => $valordia->valor]);
		$movimiento = \Bumsgames\Movimiento::create($request->all());
		
		$request->request->add(['id_movimiento' => $movimiento->id]);
		$request->request->add(['id_vendedor'   => Auth::id()]);
		$request->request->add(['id_client'     => $cliente->id]);
		// $request->request->add(['entidad' => $request->entidad]);
		$venta = \Bumsgames\Sales::create($request->all());

		$request->request->add(['id_venta' => $venta->id]);
		$request->request->add(['id_creadoUsuario' => Auth::id() ]);
		if($request->envio == 'si'){
			\Bumsgames\Orden_Envio::create($request->all());
		}

		$duennos = \Bumsgames\BumsUser_Article::where('id_article','=',$request->id_article)->orderby('porcentaje','DESC')->get();

		if($duennos->count() == 1){
			$duennos = \Bumsgames\BumsUser_Article::where('id_article','=',$request->id_article)->first();
			if($duennos->id_bumsuser == Auth::id()){
				$request->request->add(['porcentaje' => 100]);
				$request->request->add(['descripcion_movimiento' => 'Venta Realizada']);
				$request->request->add(['permiso' => '1']);

				$request->request->add(['movimiento_usuario' => Auth::id()]);
				$request->request->add(['id_movimiento' => $movimiento->id]);
				\Bumsgames\BumsUser_Movimiento::create($request->all());
			}else{
				//comision
				$request->request->add(['porcentaje' => 0]);
				$request->request->add(['descripcion_movimiento' => 'Comision']);
				$request->request->add(['permiso' => '0']);
				$request->request->add(['movimiento_usuario' => Auth::id()]);
				$request->request->add(['id_movimiento' => $movimiento->id]);
				\Bumsgames\BumsUser_Movimiento::create($request->all());

				//pago a duenno del articulo
				$request->request->add(['porcentaje' => 100]);
				$request->request->add(['descripcion_movimiento' => 'Articulo tuyo, fue vendido.']);
				$request->request->add(['permiso' => '1']);
				$request->request->add(['movimiento_usuario' => $duennos->id_bumsuser]);
				$request->request->add(['id_movimiento' => $movimiento->id]);
				\Bumsgames\BumsUser_Movimiento::create($request->all());
			}
		}else{		
			$vuelta = 1;
			$permiso = 1;
			$coincidencia = 0;
			foreach($duennos as $duenno){
				if($vuelta == 1){
					if($duenno->id_bumsuser == Auth::id()){
						$request->request->add(['porcentaje' => $duenno->porcentaje]);
						if(($duenno->id_bumsuser == Auth::id())){
							$request->request->add(['descripcion_movimiento' => 'Vendiste un articulo tuyo | Tiene multiples duennos.']);
							$coincidencia++;
						}else{
							$request->request->add(['descripcion_movimiento' => 'Articulo tuyo, fue vendido.']);
						}

						$request->request->add(['permiso' => '0']);
						$request->request->add(['movimiento_usuario' => $duenno->id_bumsuser]);
						$request->request->add(['id_movimiento' => $movimiento->id]);
						\Bumsgames\BumsUser_Movimiento::create($request->all());
					}else{
						$request->request->add(['porcentaje' => $duenno->porcentaje]);
						if(($duenno->id_bumsuser == Auth::id())){
							$request->request->add(['descripcion_movimiento' => 'Vendiste un articulo tuyo | Tiene multiples duennos.']);
							$coincidencia++;
						}else{
							$request->request->add(['descripcion_movimiento' => 'Articulo tuyo, fue vendido.']);
						}
						$request->request->add(['permiso' => '1']);
						$request->request->add(['movimiento_usuario' => $duenno->id_bumsuser]);
						$request->request->add(['id_movimiento' => $movimiento->id]);
						\Bumsgames\BumsUser_Movimiento::create($request->all());
						$permiso--;
					}
				}else{
					if($permiso == 1 && $vuelta == 2){
						$request->request->add(['porcentaje' => $duenno->porcentaje]);
						if(($duenno->id_bumsuser == Auth::id())){
							$request->request->add(['descripcion_movimiento' => 'Vendiste un articulo tuyo | Tiene multiples duennos.']);
							$coincidencia++;
						}else{
							$request->request->add(['descripcion_movimiento' => 'Articulo tuyo, fue vendido.']);
						}
						$request->request->add(['permiso' => '1']);
						$request->request->add(['movimiento_usuario' => $duenno->id_bumsuser]);
						$request->request->add(['id_movimiento' => $movimiento->id]);
						\Bumsgames\BumsUser_Movimiento::create($request->all());
						$permiso--;
					}else{
						$request->request->add(['porcentaje' => $duenno->porcentaje]);
						if(($duenno->id_bumsuser == Auth::id())){
							$request->request->add(['descripcion_movimiento' => 'Vendiste un articulo tuyo | Tiene multiples duennos.']);
							$coincidencia++;
						}else{
							$request->request->add(['descripcion_movimiento' => 'Articulo tuyo, fue vendido.']);
						}
						$request->request->add(['permiso' => '0']);
						$request->request->add(['movimiento_usuario' => $duenno->id_bumsuser]);
						$request->request->add(['id_movimiento' => $movimiento->id]);
						\Bumsgames\BumsUser_Movimiento::create($request->all());
					}


				}	
				$vuelta++;
			}

			if($coincidencia > 0){
				//comision
				$request->request->add(['porcentaje' => 0]);
				$request->request->add(['descripcion_movimiento' => 'Comision | es tuyo | Multiples Duennos']);
				$request->request->add(['permiso' => '0']);
				$request->request->add(['movimiento_usuario' => Auth::id()]);
				$request->request->add(['id_movimiento' => $movimiento->id]);
				\Bumsgames\BumsUser_Movimiento::create($request->all());
			}else{
			//comision
				$request->request->add(['porcentaje' => 0]);
				$request->request->add(['descripcion_movimiento' => 'Comision']);
				$request->request->add(['permiso' => '0']);
				$request->request->add(['movimiento_usuario' => Auth::id()]);
				$request->request->add(['id_movimiento' => $movimiento->id]);
				\Bumsgames\BumsUser_Movimiento::create($request->all());
			}
		}
//pertenece
		$request->request->add(['id_cliente' => $cliente->id]);
		$request->request->add(['id_article' => $article->id]);
		$request->request->add(['id_venta' => $venta->id]);
		$request->request->add(['informacion' => 'Adquisicion de articulo.']);
		\Bumsgames\PerteneceCliente::create($request->all());

		return response()->json([
			"data" => "Concretado",
		]);
	}




	public function buscar_sale($id){
		$sale = \Bumsgames\Sales::where('id', $id)->get();
		return $sale;
	}

	public function ver_detalle_compra($id){
		$pago = \Bumsgames\Pago::
		leftJOIN('envio__pagos','pagos.id','=','envio__pagos.id_pago')
		->leftJOIN('coupon','pagos.cupon_id','=','coupon.id')
		->select(\DB::raw("*, pagos.id as id"))
		->where('pagos.id', $id)
		->groupby('pagos.id')
		->get();

		return $pago;
	}

	public function ver_articulo_compra($id){
		$articulos = \Bumsgames\Pago_Articulo::
		JOIN('articles','pago__articulos.id_article','=','articles.id')
		->where('pago__articulos.id_pago','=', $id)
		->get();
		return $articulos;
	}

	public function buscar_usuario($id){
		$BumsUser = \Bumsgames\BumsUser::where('id', $id)->get();
		return $BumsUser;
	}

	public function ver_articulos(Request $request){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$articulos = \Bumsgames\PerteneceCliente::with('cliente')->with('articulo')->where('id_cliente',$request->id)->get();
		return view('articulos_cliente', compact('tutoriales','comments_por_aprobar','pago_sin_confirmar','articulos'));
	}
	public function colocar_comision(Request $request){
		\Bumsgames\Sales::where('id',$request->id)->first()->fill($request->all())->save();
		return "true";
	}

	public function modificacion_rapida(Request $request){
		$refer = \Bumsgames\Article::find($request->id);
		if(isset($request->note)){
				DB::statement('UPDATE articles SET note="'.$request->note.'" WHERE id='.$request->id.' ');
		}
		if(isset($request->quantity)){
			//Comprobante que dice si se agregara timestramp o no
			$comprobante_disponibilidad = 
			\Bumsgames\Article::where('quantity','>','0')
			->where('name','=',$refer->name)
			->where('category','=',$refer->category)
			->get();
			if(($comprobante_disponibilidad->count() == 0)&& $refer->quantity<$request->quantity){
				DB::statement('UPDATE articles SET ultimo_agregado="'.Carbon::now().'" WHERE id='.$request->id.' ');
			}
			DB::statement('UPDATE articles SET quantity="'.$request->quantity.'" WHERE id='.$request->id.' ');
		}
		if(isset($request->reset_button)){
			if(in_array($refer->category,[1,2,5])){
				DB::statement('UPDATE articles SET reset_button="'.$request->reset_button.'" WHERE id='.$request->id.' OR (email="'.$refer->email.'" AND (category IN (1,2,5)))');
			}
			else if(in_array($refer->category,[8,9])){
				DB::statement('UPDATE articles SET reset_button="'.$request->reset_button.'" WHERE id='.$request->id.' OR (email="'.$refer->email.'" AND (category IN (8,9)))');
			}
			else{
				DB::statement('UPDATE articles SET reset_button="'.$request->reset_button.'" WHERE id='.$request->id.' ');
			}
		}
		if(isset($request->password)){
			if(in_array($refer->category,[1,2,5])){
				DB::statement('UPDATE articles SET password="'.$request->password.'" WHERE id='.$request->id.' OR (email="'.$refer->email.'" AND (category IN (1,2,5))) ');
			}
			else if(in_array($refer->category,[8,9])){
				DB::statement('UPDATE articles SET password="'.$request->password.'" WHERE id='.$request->id.' OR (email="'.$refer->email.'" AND (category IN (8,9))) ');
			}
			else{
				DB::statement('UPDATE articles SET password="'.$request->password.'" WHERE id='.$request->id.' ');
			}
		}
		return response()->json([
			"data" => "Modificado",
		]);	
	}

	public function realizar_modificacion_cliente(Request $request){
		if(isset($request->name)){
			DB::statement('UPDATE clients SET name="'.$request->name.'" WHERE id='.$request->id.' ');
		}
		if(isset($request->lastname)){
			DB::statement('UPDATE clients SET lastname="'.$request->lastname.'" WHERE id='.$request->id.' ');
		}
		if(isset($request->nickname)){
			DB::statement('UPDATE clients SET nickname="'.$request->nickname.'" WHERE id='.$request->id.' ');
		}
		if(isset($request->password)){
			DB::statement('UPDATE clients SET password="'.bcrypt($request->password).'" WHERE id='.$request->id.' ');
		}
		if(isset($request->num_contact)){
			DB::statement('UPDATE clients SET num_contact="'.$request->num_contact.'" WHERE id='.$request->id.' ');
		}
		if(isset($request->note)){
			DB::statement('UPDATE clients SET note="'.$request->note.'" WHERE id='.$request->id.' ');
		}
		if(isset($request->email)){
			DB::statement('UPDATE clients SET email="'.$request->email.'" WHERE id='.$request->id.' ');
		}
		return response()->json([
			"data" => "Modificado",
		]);	
	}



	public function movimientos_bums_banco(){
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$sales = \Bumsgames\Movimiento::where('type', 'bums')
		->where(function($q) {
			$q->where('pertenece_user',Auth::user()->id)
			->orWhere('comision_user',Auth::user()->id);
		})
		->where('cantidad','!=','0')

		->orderby('created_at','ASC')
		->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$title = 'Movimientos de Empresa';
		$movement = 'bums';
		$url = 'movimientos_tipo_banco';
		$tutoriales = \Bumsgames\tutorial::All();

		$coins = \Bumsgames\Coin::All();

		return view('movimientos_tipo_banco', compact('tutoriales','comments_por_aprobar','pago_sin_confirmar','sales','title','movement','url','coins'));
	}







	public function movimientos_p(){
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$sales = \Bumsgames\Movimiento::where('type', 'personales')
		->where(function($q) {
			$q->where('pertenece_user',Auth::user()->id)
			->orWhere('comision_user',Auth::user()->id);
		})
		->where('cantidad','!=','0')

		->orderby('created_at','DESC')
		->get();

		$title = 'Movimientos Personales';
		$movement = 'personal';
		$url = 'movimientos_personal';
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$coins = \Bumsgames\Coin::All();
		$tutoriales = \Bumsgames\tutorial::All();


		return view('movimientos_tipo_banco', compact('tutoriales','comments_por_aprobar','sales','title','movement','url','coins','pago_sin_confirmar'));
	}



	public function movimientos_tipo_banco(){
		// $sales = \Bumsgames\Movimiento::where('type', 'bums')
		// ->where(function($q) {
		// 	$q->where('pertenece_user',Auth::user()->id)
		// 	->orWhere('comision_user',Auth::user()->id);
		// })
		// ->get();
		$sales = \Bumsgames\Movimiento::where('cantidad','!=','0')
		->orderby('movimientos.updated_at','ASC')
		
		
		->get();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$tutoriales = \Bumsgames\tutorial::All();

		$title = 'Movimientos de Empresa';
		$movement = 'bums';
		$url = 'movimientos';
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$coins = \Bumsgames\Coin::All();

		$usuarios = \Bumsgames\BumsUser::All();
		return view('movimientos_tipo_banco', compact('tutoriales','comments_por_aprobar','sales','title','movement','url','coins','usuarios','pago_sin_confirmar'));
	}

	public function movimientos_banco_filtro(Request $request){
		// $sales = \Bumsgames\Movimiento::join('bums_user__movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		// ->orderby('movimientos.updated_at','DESC')
		// ->get();

		$from = $request->fecha_inicio;
		$to = $request->fecha_final;
		if($request->id_usuario == 0){
			$sales = \Bumsgames\Movimiento::
			join('sales', 'movimientos.id','=','sales.id_movimiento')
			->whereBetween('sales.created_at', [$from, $to])
			->orderby('movimientos.updated_at','DESC')
			->get();

			$title = 'Movimientos de Venta-Banco. (Todos los usuarios)';
		}else{
			$sales = \Bumsgames\Movimiento::
			join('sales', 'movimientos.id','=','sales.id_movimiento')
			->where('id_vendedor', $request->id_usuario)
			->whereBetween('sales.created_at', [$from, $to])
			->orderby('movimientos.updated_at','DESC')
			->get();

			$busqueda = \Bumsgames\BumsUser::find($request->id_usuario);
			$title = 'Movimientos de Venta-Banco. ('.$busqueda->name.' '.$busqueda->lastname.')';
		}

		$movement = 'bums';
		$url = 'movimientos';
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('movimientos_tipo_banco_filtro', compact('tutoriales','comments_por_aprobar','sales','title','movement','url','coins','usuarios','pago_sin_confirmar'));
	}

	public function reporte(){
		$reportes = \Bumsgames\Reporte::
		orderby('created_at', 'desc')
		->get();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('reporte', compact('tutoriales','comments_por_aprobar','reportes','pago_sin_confirmar'));
	}

	public function pago_cliente(){
		$pago_v = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where('verificado','>',0)
		->where('entregado','>',0)
		->latest()
		->take(20)
		->get();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->paginate(100);

		$pago_s = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->paginate(100);
		$tutoriales = \Bumsgames\tutorial::All();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('pago_cliente', compact('tutoriales','comments_por_aprobar','reportes','pago_s','pago_v','pago_sin_confirmar'));
	}

	public function guardar_reporte(Request $request){
		$request->request->add(['creador' => auth()->user()->id]);
		\Bumsgames\Reporte::create($request->all());

		$titulo = 'NUEVO REPORTE O NOTICIA';
		$data = 'Accion por: '.auth()->user()->name.' '.auth()->user()->lastname;
		$data2 = '';
		$users = BumsUser::where('level','>=','1')
		->where('id','!=',auth()->user()->id)
		->get();
		foreach ($users as $user){
			$user->notify(new TaskCompleted($titulo,$data,$data2));
		}

		return back()->with('success','Usuario creado, correctamente.');
	}

	

	public function movimientos_personal(){
		$movimientos = \Bumsgames\BumsUser_Movimiento::
		join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		->where('movimiento_usuario', Auth::id())
		->where('movimientos.type', 'bums')
		->where('movimientos.cantidad','>','0')
		->orderby('movimientos.created_at','DESC')
		->paginate(100);
		//Cambiar el paginate(100) de arriba por get() si se quiere volver a ajax
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$title = 'Movimientos Personales';
		$movement = 'bums';
		$url = 'movimientos_tipo_banco_personal';
		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
			//Comentar las 3 lineas de abajo para volver a
			$movimientos_list = [];
			$count_movimientos = 1;
			return view('movimientosFILTRADOS',compact('movimientos','comments_por_aprobar','movimientos_list','count_movimientos','pago_sin_confirmar', 'title', 'movement', 'url', 'coins', 'usuarios','tutoriales'));
			//Descomentar lo de abajo para volver a ajax
		//return view('movimientos_personal', compact('movimientos','comments_por_aprobar','pago_sin_confirmar','title','movement','url', 'coins','usuarios','tutoriales'));
		
	}

	public function obtenerMovimientosPersonal(){
		$movimientos = \Bumsgames\BumsUser_Movimiento::
		join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		->where('movimiento_usuario', Auth::id())
		->where('movimientos.type', 'bums')
		->where('movimientos.cantidad','>','0')

		->orderby('movimientos.created_at','DESC')
		->get();

		$movimientos_list = [];
		$count_movimientos = 1;
		foreach($movimientos as $movimiento){

			$informacion="";
			$informacion.="<strong>Entidad: </strong>".$movimiento->movimiento->entidad;
			if($movimiento->descripcion_movimiento){
				$informacion.="<br><br><strong>Descripción: </strong>".$movimiento->descripcion_movimiento;
			}else{
				$informacion.="<br><br><strong>Descripción: </strong>".$movimiento->movimiento->description;
			}
			if(isset($movimiento->venta->user->name)){
				$informacion.="<br><br><strong>Vendedor: </strong>".$movimiento->venta->user->name." ".$movimiento->venta->user->lastname;				
			}
			$informacion.="<br><br><strong>Nota: </strong>".$movimiento->note_movimiento;

			$transaccion="";
			$transaccion.="<strong>Persona: </strong>".Auth::user()->name." ".Auth::user()->lastname;
			if($movimiento->porcentaje != 0){
				$transaccion.="<br><br><strong>Acciones: </strong>".$movimiento->porcentaje."% <br><br> <strong>Total: </strong>".number_format(($movimiento->movimiento->price * $movimiento->movimiento->cantidad) *  ($movimiento->porcentaje / 100), 0, ',', '.')." ".$movimiento->movimiento->moneda->sign;
			}
			else{
				$transaccion.="<br><br>USTED REALIZO UNA VENTA DE OTRA PERSONA<br><br>";
				if($movimiento->comision == null){
					$transaccion.="<p style='color: red;'>LE DEBEN COLOCAR COMISIÓN</p>";
				}else{
					$transaccion.="<br><br><strong>Comisión colocada: </strong>".number_format($movimiento->comision, 0, ',', '.')." ".$movimiento->movimiento->moneda->sign;

					$transaccion.="<br><br><strong>Total: </strong>".number_format($movimiento->comision * $movimiento->cantidad, 0, ',', '.').$movimiento->movimiento->moneda->sign;
				}
				$transaccion.="<br>";
			}

			$articulo="";
			if(isset($movimiento->venta->articulo)){
				$articulo.="<strong>".$movimiento->venta->articulo->name."</strong>";
				$articulo.="<br><br> <strong>Categoría: </strong>".$movimiento->venta->articulo->pertenece_category->category ;
				$articulo.="<br><br>".$movimiento->venta->articulo->email;
				$articulo.="<br>".$movimiento->venta->articulo->password;
				$articulo.="<br>".$movimiento->venta->articulo->nickname;
				$articulo.="<br><br> <strong>Dueño(s): </strong>";
				foreach($movimiento->venta->articulo->duennos as $duenno){
					$articulo.="<br>".$duenno->name." ".$duenno->lastname." ".$duenno->pivot->porcentaje."%";
				}
			}else{
				$articulo.="NO APLICA";
			}

			$fecha=$movimiento->updated_at."<br><br>".$movimiento->updated_at->diffForHumans();

			$eliminar='<button class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg3" Onclick="mandaridM('.$movimiento->id.');" ><i class="fa fa-trash" aria-hidden="true"></i></button>';

			$movimientos_list[] = [$count_movimientos, $informacion, $transaccion, $articulo, $movimiento->id, $fecha, $eliminar];

			$count_movimientos++;
		}

		return response()->json(['data' => $movimientos_list]);
	}

	public function movimientos_personal_buscador(Request $request){
		// id articulo, date
		$movimientos = \Bumsgames\BumsUser_Movimiento::
		join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		->where('movimiento_usuario', Auth::id())
		->where('movimientos.type', 'bums')
		->where('movimientos','!=','0')
		->orderby('movimientos.created_at','ASC')
		->get();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$title = 'Movimientos Personales';
		$movement = 'bums';
		$url = 'movimientos_tipo_banco_personal';
		$coins = \Bumsgames\Coin::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('movimientos_personal', compact('tutoriales','comments_por_aprobar','pago_sin_confirmar','movimientos','title','movement','url', 'coins'));
	}

	public function movimientos_tipo_banco_personal(){
		$movimientos = \Bumsgames\BumsUser_Movimiento::
		join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		->where('movimientos.cantidad','!=','0')
		->where('movimiento_usuario', Auth::id())
		->where('movimientos.type', 'bums')
		->orderby('movimientos.created_at','DESC')
		->get();


		$title = 'Movimientos Tipo Banco (Personal)';
		$movement = 'bums';
		$url = 'movimientos_personal';

		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('movimientos_tipo_banco_individual', compact('tutoriales','comments_por_aprobar','pago_sin_confirmar','movimientos','title','movement','url','coins','usuarios'));
	}

	public function movimientos_tipo_banco_personal_filtro(Request $request){
		$from = $request->fecha_inicio;
		$to = $request->fecha_final;
				// entre 2 fechas
		$movimientos = \Bumsgames\BumsUser_Movimiento::
		join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		->where('movimiento_usuario', $request->id_usuario)		
		->where('movimientos.cantidad','!=','0')
		->whereDate("movimientos.created_at",">=",$from)
		->whereDate("movimientos.created_at","<=",$to)
		->where('movimientos.type',$request->type)
		->orderby('movimientos.created_at','ASC')
		->get();

		$usuario = \Bumsgames\BumsUser::find($request->id_usuario);
		if($request->type == 'bums'){
			$title = 'Movimientos de la empresa de: '.$usuario->name.' '.$usuario->lastname;
			$movement = 'bums';
			$url = 'movimientos_personal';
		}else{
			$title = 'Movimientos personales de: '.$usuario->name.' '.$usuario->lastname;
			$movement = 'personal';
			$url = 'movimientos_tuyos';
		}
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('movimientos_tipo_banco_individual', compact('tutoriales','comments_por_aprobar','pago_sin_confirmar','movimientos','title','movement','url','coins','usuarios'));
	}

	public function movimientos(){

		//Descomentar este pedazo de codigo si se quiere volver al metodo ajax
		/*$movimientos = \Bumsgames\Movimiento::where('movimientos.cantidad','>','0')
		->orderby('movimientos.updated_at','DESC')
		->get();*/

		//comentar el pedazo de codigo de abajo si se quiere volver al metodo ajax
		$movimientos = \Bumsgames\BumsUser_Movimiento::
		join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		->where('cantidad','!=','0')
		->groupBy('movimientos.id')
		->orderby('movimientos.created_at','DESC')
		->paginate(100);

		// return $sales->movimiento;

		$title = 'Movimientos de Empresa';
		$movement = 'bums';
		$url = 'movimientos_tipo_banco';

		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();

		//Descomentar lo de abajo si se quiere volver al metodo de ajax (como estaba antes)
		//return view('movimientos', compact('movimientos','pago_sin_confirmar','comments_por_aprobar', 'title', 'movement', 'url', 'coins', 'usuarios','tutoriales'));
		
		//Comentar las 3 lineas de abajo para volver al emtodo ajax	
		$movimientos_list = [];
		$count_movimientos = 1;
		return view('movimientosFILTRADOS',compact('movimientos','comments_por_aprobar','movimientos_list','count_movimientos','pago_sin_confirmar', 'title', 'movement', 'url', 'coins', 'usuarios','tutoriales'));
	
	}

	public function filtrar_movimientos_bums( Request $request){
		if(isset($request->fecha_inicio) && isset($request->fecha_final)){
			if($request->id_usuario > 0){
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimientos.created_at','>=',$request->fecha_inicio)
				->where('movimientos.created_at','<=',$request->fecha_final)
				->where('movimiento_usuario', $request->id_usuario)	
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->paginate(100);			}
			else{
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimientos.created_at','>=',$request->fecha_inicio)
				->where('movimientos.created_at','<=',$request->fecha_final)
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->paginate(100);			}
		}
		else if(isset($request->fecha_inicio)){
			if($request->id_usuario > 0){
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimientos.created_at','>=',$request->fecha_inicio)
				->where('movimiento_usuario', $request->id_usuario)
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->paginate(100);			}
			else{
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimientos.created_at','>=',$request->fecha_inicio)
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->paginate(100);			}
		}
		else if(isset($request->fecha_final)){
			if($request->id_usuario > 0){
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimientos.created_at','<=',$request->fecha_final)
				->where('movimiento_usuario', $request->id_usuario)
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->paginate(100);			}
			else{
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimientos.created_at','<=',$request->fecha_final)
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->paginate(100);			}
		}
		else{
			if($request->id_usuario > 0){
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimiento_usuario', $request->id_usuario)
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->paginate(100);			}
			else{
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->paginate(100);
			}
		}

		
		$movimientos_list = [];
		$count_movimientos = 1;
		$title = 'Movimientos de Empresa';
		$movement = 'bums';
		$url = 'movimientos_tipo_banco';
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		return view('movimientosFILTRADOS',compact('movimientos','comments_por_aprobar','movimientos_list','count_movimientos','pago_sin_confirmar', 'title', 'movement', 'url', 'coins', 'usuarios','tutoriales'));
	}

	// public function filtrar_movimientos_bums( Request $request){
	// 	$movimientos = \Bumsgames\BumsUser_Movimiento::
	// 	join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
	// 	->where('cantidad','!=','0')
	// 	->groupBy('movimientos.id')
	// 	->orderby('movimientos.updated_at','DESC')
	// 	->get();

	// 	if(isset($request->fecha_inicio)){
	// 		$movimientos = $movimientos->where('updated_at','>=',$request->fecha_inicio);
	// 	}
	// 	if(isset($request->fecha_final)){
	// 		$movimientos = $movimientos->where('updated_at','<=',$request->fecha_final);
	// 	}
	// 	if($request->id_usuario > 0){
	// 		$movimientos = $movimientos->where('movimiento_usuario', $request->id_usuario);

	// 	}
		
	// 	$movimientos_list = [];
	// 	$count_movimientos = 1;
	// 	$title = 'Movimientos de Empresa';
	// 	$movement = 'bums';
	// 	$url = 'movimientos_tipo_banco';

	// 	$coins = \Bumsgames\Coin::All();
	// 	$usuarios = \Bumsgames\BumsUser::All();
	// 	$tutoriales = \Bumsgames\tutorial::All();
	// 	$pago_sin_confirmar = \Bumsgames\Pago::
	// 	orderby('created_at', 'desc')
	// 	->where(function ($query) {
	// 		$query->where('verificado','<=',0)
	// 		->orWhere('entregado','<=',0);
	// 	})->get();
	// 	return view('movimientosFILTRADOS',compact('movimientos','movimientos_list','count_movimientos','pago_sin_confirmar', 'title', 'movement', 'url', 'coins', 'usuarios','tutoriales'));
	// }

	
	public function obtener_movimientos($movement){


		$movimientos = Movimiento::where('movimientos.cantidad','>','0')
		->orderby('updated_at','DESC')->get();

		$movimientos_list = [];
		$count_movimientos = 1;
		foreach($movimientos as $movimiento){

			if($movimiento->type == $movement){
				$transaccion="";
				$contar_x=0;
				foreach($movimiento->usuario as $x){

					if($x->pivot->porcentaje == 0){
						if($contar_x>0){
							$transaccion.="<br><br>";
						}

						$transaccion.="<strong>Comisión para: </strong>".$x->name." ".$x->lastname;

						if($movimiento->comision){
							$transaccion.="<br>".number_format($movimiento->comision * $movimiento->cantidad, 0, ',', '.')." ".$movimiento->moneda->sign;
						}else{
							$transaccion.="<br><br><strong style='color: red;'>FALTA COLOCARLE LA COMISIÓN POR VENDER</strong>";
						}
						$transaccion.="<br><br>";
					}else{
						$transaccion.="<strong>Dueño:</strong> (".$x->name." ".$x->lastname.") | ".number_format((($x->pivot->porcentaje / 100) *  $movimiento->price) - ($movimiento->comision * ($x->pivot->porcentaje / 100) ), 0, ',', '.')." ".$movimiento->moneda->sign." (".$x->pivot->porcentaje."%) <br><br>";

						if($x->pivot->permiso == 1){
							if(starts_with($movimiento->description, 'Venta Realizada')){
								$transaccion.="<br><br>Puedes modificar la comisión";

								if($x->id == Auth::id() || auth()->user()->level >= 10){
									$transaccion.='<form class="form-inline" action="guardar_comision" method="POST"> '.csrf_field().' <input type="text" name="colocada_por" value='.$x->id.' hidden=""> <input type="text" name="id_movimiento" value='.$movimiento->id.' hidden=""> <input type="text" class="form-control form-control-sm mt-2" placeholder="Agregar comisión" name="comision" autocomplete="off"> <button class="btn mt-2">Generar comisión por precio unitario</button> </form><br>';
								}
							}
						}
					}
					$contar_x++;
				}

				$transaccion.="<br><strong>Total: </strong>".number_format($movimiento->price * $movimiento->cantidad, 0, ',', '.')." ".$movimiento->moneda->sign;

				$articulo="";
				if(starts_with($movimiento->description, 'Venta Realizada')){
					foreach($movimiento->venta as $movimiento->venta){
						$articulo.="<strong>Artículo: </strong>".$movimiento->venta->articulo->name;
						$articulo.="<br><br><strong>Categoría: </strong>".$movimiento->venta->articulo->pertenece_category->category;
						$articulo.="<br><br>".$movimiento->venta->articulo->email." | ".$movimiento->venta->articulo->nickname." | ".$movimiento->venta->articulo->password;
						$articulo.="<br><br><strong>Cantidad: </strong>".$movimiento->cantidad;
						$articulo.="<br><br><strong>Precio unitario: </strong>".number_format($movimiento->price, 0, ',', '.')." ".$movimiento->moneda->sign;
						$articulo.="<br><br><strong>Precio del dolar del día: </strong>".number_format($movimiento->dolardia, 0, ',', '.')." Bs";
						$articulo.="<br><br><strong>Cliente: </strong>".$movimiento->venta->cliente->name." ".$movimiento->venta->cliente->lastname;
						break;
					}
				}else{
					$articulo.="NO APLICA";
				}

				$fecha=$movimiento->updated_at."<br><br>".$movimiento->updated_at->diffForHumans();

				$eliminar='<button type="button" class="btn btn-danger text-center" data-toggle="modal" data-target=".bd-example-modal-lg3" Onclick="mandaridM('.$movimiento->id.');"><i class="fa fa-trash" aria-hidden="true"></i></button>';

				$movimientos_list[] = [$count_movimientos,"<strong>Entidad: </strong>".$movimiento->entidad."<br><br> <strong>Descripción: </strong>".$movimiento->description."<br><br> <strong>Nota: </strong>".$movimiento->note_movimiento,$transaccion, $articulo, $fecha, $eliminar];

				$count_movimientos++;
			}
		}

		return response()->json(['data' => $movimientos_list]);
	}


	public function movimientos_filtro(Request $request){
		$from = $request->fecha_inicio;
		$to = $request->fecha_final;

		if($request->id_usuario == 0){
			$sales = \Bumsgames\Sales::
			whereDate("created_at",">=",$from)
			->whereDate("created_at","<=",$to)
			->orderby('created_at','DESC')
			->get();
			$title = 'Ventas de todos los usuarios en un rango especifico ';				
		}else{
			$sales = \Bumsgames\Sales::
			where('id_vendedor', $request->id_usuario)
			->whereDate("created_at",">=",$from)
			->whereDate("created_at","<=",$to)
			->orderby('created_at','DESC')
			->get(); 

			$title = 'Ventas de un usuario en especifico en un rango en especifico';
		}

		// 		$title = 'Movimientos de: '.auth()->user()->name.' '.auth()->user()->lastname;	
		// if($from == $to){
		// 	$now = \Carbon\Carbon::today();
		// 	if($request->id_usuario == 0){
		// 		$sales = \Bumsgames\Sales::
		// 		whereDate('created_at', $now)
		// 		->orderby('created_at','DESC')
		// 		->get();
		// 		$title = 'Movimientos de: '.auth()->user()->name.' '.auth()->user()->lastname;

		// 	}else{
		// 		$sales = \Bumsgames\Sales::
		// 		where('id_vendedor', $request->id_usuario)
		// 		->whereDate('created_at', $now)
		// 		->orderby('created_at','DESC')
		// 		->get(); 

		// 		$title = 'Movimientos de Venta (Todos los usuarios)';
		// 	}
		// }else{
		// 	if($request->id_usuario == 0){
		// 		$sales = \Bumsgames\Sales::
		// 		whereBetween('sales.created_at', [$from, $to])
		// 		->orderby('created_at','DESC')
		// 		->get();
		// 		$title = 'Movimientos de: '.auth()->user()->name.' '.auth()->user()->lastname;				
		// 	}else{
		// 		$sales = \Bumsgames\Sales::
		// 		where('id_vendedor', $request->id_usuario)
		// 		->whereBetween('sales.created_at', [$from, $to])
		// 		->orderby('created_at','DESC')
		// 		->get(); 

		// 		$title = 'Movimientos de Venta (Todos los usuarios)';
		// 	}
		// }

		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$movement = 'bums';
		$url = 'movimientos_tipo_banco_filtro';
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();

		return view('movimientos_filtro', compact('sales','comments_por_aprobar','pago_sin_confirmar','title','movement','url','coins','usuarios','tutoriales'));
	}

	public function movimientos_tipo_banco_filtro(Request $request){
		if(isset($request->fecha_inicio) && isset($request->fecha_final)){
			$from = $request->fecha_inicio;
			$to = $request->fecha_final;
			if($from == $to){
				$now = \Carbon\Carbon::today();
				if($request->id_usuario == 0){
					$sales = \Bumsgames\Sales::
					whereDate('created_at', $request->fecha_inicio)
					->orderby('created_at','ASC')
					->get();
					$title = 'Movimientos de: '.auth()->user()->name.' '
					.auth()->user()->lastname;

				}else{
					$sales = \Bumsgames\Sales::
					where('id_vendedor', $request->id_usuario)
					->whereDate('created_at', $request->fecha_inicio)
					->orderby('created_at','ASC')
					->get(); 

					$title = 'Movimientos de Venta (Todos los usuarios)';
				}
			}else{
				if($request->id_usuario == 0){
					$sales = \Bumsgames\Sales::
					whereBetween('sales.created_at', [$from, $to])
					->orderby('created_at','ASC')
					->get();
					$title = 'Movimientos de: '.auth()->user()->name.' '.auth()->user()->lastname;				
				}else{
					$sales = \Bumsgames\Sales::
					where('id_vendedor', $request->id_usuario)
					->whereBetween('sales.created_at', [$from, $to])
					->orderby('created_at','ASC')
					->get(); 

					$title = 'Movimientos de Venta (Todos los usuarios)';
				}
			}
		}else{
			$sales = \Bumsgames\Sales::
			orderby('created_at','ASC')
			->get(); 

			$title = 'Movimientos de Venta (Todos los usuarios)';		
		}
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$title = 'Movimientos tipo banco (FILTRO)';
		$movement = 'bums';
		$url = 'movimientos_filtro';
		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		return view('movimientos_tipo_banco_filtro', compact('sales','comments_por_aprobar','pago_sin_confirmar','title','url','movement','usuarios','coins','tutoriales'));	
	}

	public function movimientos_tuyos(){
		// $movimientos = \Bumsgames\Movimiento::
		// join('bums_user__movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		// ->join('sales','sales.id','=','bums_user__movimientos.id_venta')
		// ->where('movimiento_usuario', Auth::id())
		// ->where('type', 'personal')
		// ->orderby('movimientos.updated_at','DESC')
		// ->get();

		$movimientos = \Bumsgames\BumsUser_Movimiento::
		join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		->where('movimiento_usuario', Auth::id())
		->where('movimientos.type', 'personal')
		->where('movimientos.cantidad','!=','0')
		->orderby('movimientos.created_at','DESC')
		->get();

		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();

		$title = 'Tus ahorros o Movimientos personales fuera de BumsGames';
		$movement = 'personal';
		$url = 'movimientos_tipo_banco_tuyos';
		$coins = \Bumsgames\Coin::All();

		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		return view('movimientos_personal', compact('movimientos','comments_por_aprobar','pago_sin_confirmar','title','movement','url', 'coins','usuarios','tutoriales'));
	}

	public function movimientos_tipo_banco_tuyos(){
		$movimientos = \Bumsgames\BumsUser_Movimiento::
		join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
		->where('movimiento_usuario', Auth::id())
		->where('movimientos.type', 'personal')
		->where('id_cuenta','IS','NULL')
		->orderby('movimientos.created_at','DESC')
		->get();

		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$title = 'Movimientos Tipo personales fuera de BumsGames';
		$movement = 'personal';
		$url = 'movimientos_tuyos';

		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		return view('movimientos_tipo_banco_individual', compact('tutoriales','comments_por_aprobar','pago_sin_confirmar','movimientos','title','movement','url','coins','usuarios'));
	}

	public function realizar_movimiento_financiero(Request $request){
		$id_usuario = $request->pertenece_user;
		$request->request->remove('pertenece_user');
		$movimiento = \Bumsgames\Movimiento::create($request->all());
		$request->request->add(['movimiento_usuario' => $id_usuario]);
		$request->request->add(['id_movimiento' => $movimiento->id]);
		$request->request->add(['porcentaje' => 100]);
		$request->request->add(['permiso' => 0]);
		$request->request->remove('type');
		\Bumsgames\BumsUser_Movimiento::create($request->all());

		return $request->all();
	}

	public function mostrar_articulo_cliente($id, Request $request){
		$temp = \Bumsgames\Article::where('articles.id', $id)
		->join('categories','categories.id','=','articles.category')
		->leftjoin('pertenece_clientes', 'articles.id','=','id_article')
		->leftjoin('clients', 'clients.id','=','id_cliente')
		->where('articles.id', $id)
		->select(\DB::raw("*, articles.name as nombre_articulo, articles.email as correo_articulo, categories.category as nombre_categoria, pertenece_clientes.id as id_pertenece"))
		->get();

		return $temp;
	}

	public function agregar_tutorial_modal(Request $request){
		$this->validate($request, [
			'titulo' => 'required|string',
			'texto' => 'required|string',
		]);
		$request->request->add(['titulo' => $request->titulo]);
		$request->request->add(['texto' => $request->texto]);
		\Bumsgames\tutorial::create($request->all());
			return 1;
	}

	public function agregar_cliente_articulo(Request $request){
		$article = \Bumsgames\Article::find($request->id_article);
		if($article->category == 1 
			|| $article->category == 2 
			|| $article->category == 8 
			|| $article->category == 9 
			|| $article->category == 12){
		}else{
			return Response::json([
				'message' => 'Este tipo de categoria no se le pueden agregar clientes por esta parte, debe realizar la venta'
			], 500);
		}

		$this->validate($request, [
			'name' => 'required|string',
			'lastname' => 'required|string',
		]);

		if(($article->quantity - 1) >= 0){
			$article->fill(['quantity' => $article->quantity - 1]);
			$article->save();
		}else{
			return Response::json([
				'message' => 'La cantidad de este articulo no es suficiente'
			], 500);
		}

		if($article->quantity - 1 <= 0){
			$art = \Bumsgames\Article::where('name',$article->name)
			->where('category',$article->category)
			->get();

			if($art->sum('quantity') <= 0) {
				$titulo = 'SE AGOTO';
				$data = "Articulo: ".$article->name;
				$data2 = "Categoria: ".$article->pertenece_category->category;
				$users = BumsUser::where('level','>=','7')->get();
				foreach ($users as $user){
					$user->notify(new TaskCompleted($titulo,$data, $data2));
				}
			}
		}

		$cliente = \Bumsgames\Client::where('id','=',$request->id_cliente)->first();
		if(isset($cliente)){
			$cliente->fill($request->all());
			$cliente->save();
		}else{
			$cliente = \Bumsgames\Client::create($request->all());
		}

		$request->request->add(['id_cliente' => $cliente->id]);
		\Bumsgames\PerteneceCliente::create($request->all());
		return $request->all();
	}

	public function eliminar_orden($id){
		$orden = \Bumsgames\Pago::find($id)->delete();;
		return Response::json([
			'message' => 'Exito'
		]);

	}

	public function elimina_cliente_articulo($id, Request $request){
		$relacionCliente_Articulo = \Bumsgames\PerteneceCliente::find($id);

		$venta = \Bumsgames\Sales::
		where('id_article', $relacionCliente_Articulo->id_article)
		->where('id_client', $relacionCliente_Articulo->id_cliente)
		->get();

		if( $venta->count() > 0 ){
			return Response::json([
				'message' => 'Este parte esta relacionada a una venta, para poder eliminarla, debe eliminar la venta'
			], 500);
		}
		$articulo = \Bumsgames\Article::find($relacionCliente_Articulo->id_article);
		if($articulo->category == 1 
			|| $articulo->category == 2 
			|| $articulo->category == 8 
			|| $articulo->category == 9 
			|| $articulo->category == 12){
			$articulo->fill(['quantity'=> 1]);
			$articulo->save();

			$relacionCliente_Articulo->delete();

			return Response::json([
				'message' => 'Exitoso'
			], 200);
		}else{
			return Response::json([
				'message' => 'Este tipo de categoria no puede eliminar la relacion de pertenencia'
			], 500);
		}
	}


	public function m_pago(Request $request){

		$pago = \Bumsgames\Pago::where('id','=',$request->id)->first();


		if($request->verificar == 1){
			$pago->fill(['verificado'=>1]);
			$pago->fill(['id_user'=>Auth::id()]);
		}

		if($request->entregar == 1){
			$pago->fill(['entregado'=>1]);
			$pago->fill(['id_user2'=>Auth::id()]);
		}

		if($request->verificar_entregar == 1){
			$pago->fill(['verificado'=>1]);
			$pago->fill(['entregado'=>1]);
			$pago->fill(['id_user'=>Auth::id()]);
			$pago->fill(['id_user2'=>Auth::id()]);
		}

		$pago->save();

		return Response::json([
			'message' => 'Este tipo de categoria no puede eliminar la relacion de pertenencia'
		]);
	}

	public function logout () {
    //logout userQ
		try {
			Auth::logout();

		} catch (\Exception $e) {


		}
		return redirect('/logloglog');
	}

	public function categoria_articulo_admin(){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$categories = \Bumsgames\Category::All();
		return view('categoria_articulo_admin', compact('categories','comments_por_aprobar','pago_sin_confirmar','tutoriales'));
	}

	public function guardar_comision(Request $request){
		$usuario = \Bumsgames\BumsUser::find($request->colocada_por);
		$movimiento = \Bumsgames\Movimiento::find($request->id_movimiento);
		$movimiento->fill(['note_movimiento'=>$movimiento->note_movimiento.' || Comision colocada por: '.$usuario->name.' '.$usuario->lastname]);
		$movimiento->fill(['comision'=>$request->comision]);
		$movimiento->save();
		return back();
	}

	public function cambiar_valor(Request $request){
		$moneda = \Bumsgames\Coin::find($request->id);
		$moneda->fill(['valor'=>$request->valor]);
		$moneda->save();
		return back();
	}

	public function entrega($id_articulo, $nombre, $apellido){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$articulo = \Bumsgames\Article::find($id_articulo);
		$now = \Carbon\Carbon::today();
		return view('entrega',compact('articulo','comments_por_aprobar','pago_sin_confirmar','nombre','apellido','now','tutoriales'));
	}

	public function portal(){
		$imagenes = \Bumsgames\Imagen::where('portal','>=','1')
		->orderby('portal')
		->get();
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$imagenes_cantidad = $imagenes->count();
		return view('portal',compact('imagenes','comments_por_aprobar','pago_sin_confirmar','imagenes_cantidad','tutoriales'));
	}

	public function portal_guardar(Request $request){
		$tutoriales = \Bumsgames\tutorial::All();

		$titulo = 'NUEVA IMAGEN DE PORTAL AGREGADA';
		$data = 'Accion por: '.auth()->user()->name.' '.auth()->user()->lastname;
		$data2 = '';
		$users = BumsUser::where('level','>=','1')
		->where('id','!=',auth()->user()->id)
		->get();
		foreach ($users as $user){
			$user->notify(new TaskCompleted($titulo,$data,$data2));
		}

		$this->validate($request, [
			'imagen' => 'required|max:3000',
			'portal' => 'required|integer',
		]);

		\Bumsgames\Imagen::create($request->all());
		return back();
	}

	public function visitas(){
		$now = \Carbon\Carbon::today();
		$result = \Bumsgames\Visita::get();
		$intervalos       = array();
		$intervalos_fecha = array();
		$visitas          = array();
		$visitas_fecha    = array();
		$i = 0;
		$j = 1;
		$d = 1;

		$fecha = $now->format('Y-m');
		

		do{
			$temp1 = $fecha.'-'.sprintf("%02d", $d);
			$temp2 = \Carbon\Carbon::parse($temp1)->format('d M Y ');
			array_push($intervalos_fecha, $temp2);

			//visitas
			$visita = \Bumsgames\Visita::
			whereDate('created_at', '=', $temp1)
			->select(\DB::raw("count(*) as visita"))
			->first();
			array_push($visitas_fecha, $visita->visita);
			$d++;
		}while($d <= $now->format('d'));

		do{
			$temp1 = sprintf("%02d", $i).':00:00';
			$temp2 = sprintf("%02d", $j).':00:00';
			$elemento = $temp1.'-'.$temp2;
			array_push($intervalos, $elemento);

			//visitas
			$visita = \Bumsgames\Visita::
			whereTime('created_at', '>=', $temp1)
			->whereTime('created_at', '<=', $temp2)
			->whereDate('created_at', $now)
			->select(\DB::raw("count(*) as visita"))
			->first();
			array_push($visitas, $visita->visita);

			$i++;
			$j++;
		}while($j <= 24);

		$temp  = json_encode($intervalos);
		$temp2 = json_encode($visitas);
		$temp3 = json_encode($intervalos_fecha);
		$temp4 = json_encode($visitas_fecha);

		return response()->json([
			"intervalos"        => $temp,
			"visitas"           => $temp2,
			"intervalos_fecha"  => $temp3,
			"visitas_fecha"     => $temp4,
		]);
	}
	
// 	function modo_respaldo(){
// 	    $algo = \Bumsgames\Articulo::
// 	    where('id','>=',4000)
// 	   ->where('id','<=',5000)
// 	   ->get();
// 	    foreach($algo as $x){
// 	        echo $x->id.' <br>';
// 	        $a = \Bumsgames\Article::find($x->id);
// 	        if(isset($a)){
// 	            $a->fill(['quantity'=>1]);
// 	            $a->fill(['note'    =>$x->note]);
// 	            $a->save();
// 	            echo 'ACTUALIZADO <br>';
// 	        }else{
// 	            echo 'NO ENCONTRADO <br>';
// 	        }
// 	    }
// 	    return 'Exito';
// 	}

	function modo_funcion(){
		$algo = \Bumsgames\Article::
		where('name',"MLB 18")
		->get();
		foreach($algo as $x){
			$a = \Bumsgames\Article::find($x->id);
			$a->fill(['name'=>"MLB The Show 18"]);
            // $a->fill(['quantity'=>"0"]);
			$a->save();
		}
		return 'Exito';
	}

	public function filtrar_movimientos(Request $request){
		$movimientos = \Bumsgames\Movimiento::where('movimientos.cantidad','>','0')
		->where('movimientos.created_at', '>=', $request->fecha_inicio)
		->where('movimientos.created_at', '<=', $request->fecha_final)
		->orderby('movimientos.updated_at','DESC')
		->get();
		// return $sales->movimiento;

		$title = 'Movimientos de Empresa';
		$movement = 'bums';
		$url = 'movimientos_tipo_banco';
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

		$coins = \Bumsgames\Coin::All();
		$usuarios = \Bumsgames\BumsUser::All();
		$tutoriales = \Bumsgames\tutorial::All();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('movimientos', compact('movimientos','comments_por_aprobar','pago_sin_confirmar', 'title', 'movement', 'url', 'coins', 'usuarios','tutoriales'));
	
	}

	public function exportarMovimientos(Request $request){
		$fecha_inicio = $request->fecha_inicio;
		$fecha_final = $request->fecha_final;
		$id_usuario = $request->id_usuario;

		if($id_usuario==0){
			$movimientos = \Bumsgames\BumsUser_Movimiento::
			join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
			->distinct()
			->where('movimientos.type', 'bums')
			->where('movimientos.created_at', '>=', $fecha_inicio)
			->where('movimientos.created_at', '<=', $fecha_final)
			->where('cantidad','!=','0')
			->orderby('movimientos.created_at','DESC')
			->get();
			
			$file_name = "Movimientos de todos los usuarios - (Inicio ".$fecha_inicio.") - (Final ".$fecha_final.")";
		}else{
			$movimientos = \Bumsgames\BumsUser_Movimiento::
			join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
			->where('movimiento_usuario', $id_usuario)
			->where('movimientos.type', 'bums')
			->where('movimientos.created_at', '>=', $fecha_inicio)
			->where('movimientos.created_at', '<=', $fecha_final)
			->where('cantidad','!=','0')
			->groupBy('movimientos.id')

			->orderby('movimientos.created_at','DESC')
			->get();
			$usuario=BumsUser::where("id",$id_usuario)->first();
			$file_name = "Movimientos de ".$usuario->name." ".$usuario->lastname." (Inicio ".$fecha_inicio.") - (Final ".$fecha_final.")";
		}

		Excel::create($file_name, function ($excel) use ($movimientos) {
			$excel->setTitle("Movimientos");
			$excel->sheet("Hoja 1", function ($sheet) use ($movimientos) {
				$sheet->loadView('reports.movimientos')->with('movimientos', $movimientos);;
			});
		})->download('xls');
	}

	public function verTutoriales(){
		$tutoriales = \Bumsgames\tutorial::orderby('id')
        ->paginate(100);
		$cantidad_tutoriales = $tutoriales->count();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('tutorial.tutoriales',compact('tutoriales','comments_por_aprobar','pago_sin_confirmar','cantidad_tutoriales'));
	}

	public function menuCrearTutorial(){
		$tutoriales = \Bumsgames\tutorial::All();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		return view('tutorial.create',compact('tutoriales','comments_por_aprobar','pago_sin_confirmar'));
	}

	public function crearTutorial(Request $request){
		$this->validate($request, [
			'tituloTutorial' => 'required|string',
			'contenidoTutorial' => 'required|string'
		]);

		$request->request->add(['titulo' => $request->tituloTutorial]);
		$request->request->add(['texto' => $request->contenidoTutorial]);
		$tutorial = \Bumsgames\tutorial::create($request->all());
		return redirect('/ver_tutoriales')->with('success','Tutorial Creado');    	
	}

	public function editarTutorial($id){
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
		$comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
		$tutoriales = \Bumsgames\tutorial::all();
		$tutorial = \Bumsgames\tutorial::find($id);
		return view('tutorial.edit', compact('tutorial','comments_por_aprobar','pago_sin_confirmar','tutoriales'));
	}

	public function editar_Tutorial(Request $request){
		$this->validate($request,[
			'tituloTutorial' => 'required|string',
			'contenidoTutorial' => 'required|string'
		]);
		$request->request->add(['titulo' => $request->tituloTutorial]);
		$request->request->add(['texto' => $request->contenidoTutorial]);
		$tutorial = \Bumsgames\tutorial::find($request->id);
		$tutorial->fill($request->all());
		$tutorial->save();
		return redirect('/menu')->with('success','Tutorial editado');    
	}

	public function eliminarTutorial($id){
		$tutorial = \Bumsgames\tutorial::find($id);
        $tutorial->delete();
        return redirect('/ver_tutoriales')->with('success','Tutorial Eliminado');    
	}
 
	public function misArticles_lista_escrita(){
		$articles = \Bumsgames\Article::join('bums_user_articles', 'articles.id', '=', 'bums_user_articles.id_article')
		->selectRaw('articles.id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, porcentaje, articles.id as id_articulo, note, offer_price, peso')
		->where('bums_user_articles.id_bumsuser', Auth::id())
		->where('articles.id','!=','2')
		->orderby('name')
		->paginate(100);

		$articles_mios2 = \Bumsgames\Article::join('bums_user_articles', 'articles.id', '=', 'bums_user_articles.id_article')
		->selectRaw('articles.id, id_creator, name, category, price_in_dolar, quantity, email, password, nickname, reset_button, porcentaje, articles.id as id_articulo, note, offer_price, peso')
		->where('bums_user_articles.id_bumsuser', Auth::id())
		->where('articles.id','!=','2')
		->where('articles.quantity',']>=','1')
		->groupBy('name','category')
		->orderBy('category','asc')
		->orderBy('price_in_dolar', 'desc')
		->get();

		$articles_mios = \Bumsgames\Article::join('bums_user_articles', 'articles.id', '=', 'bums_user_articles.id_article')
		->where('bums_user_articles.id_bumsuser', Auth::id())
		->where('articles.quantity', '>', 0)
		->where('articles.id','!=','2')
		->groupBy('articles.name','articles.category')
		->orderBy('articles.category')
		->orderBy('articles.price_in_dolar', 'asc')
		->get();

		$articles_price = \Bumsgames\Article::join('bums_user_articles', 'articles.id', '=', 'bums_user_articles.id_article')
		->where('bums_user_articles.id_bumsuser', Auth::id())
		->where('articles.quantity', '>', 0)
		->where('articles.id','!=','2')
		->orderBy('articles.category')
		->orderBy('articles.price_in_dolar', 'asc')
		->get();

		
		return view('lista_mia', compact('articles_mios','articles_price'));
	}

	public function filtrar_movimientos_bums_david(Request $request){
		if(isset($request->fecha_inicio) && isset($request->fecha_final)){
			if($request->id_usuario > 0){
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimientos.created_at','>=',$request->fecha_inicio)
				->where('movimientos.created_at','<=',$request->fecha_final)
				->where('movimiento_usuario', $request->id_usuario)	
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->get();
			}
			else{
				$movimientos = \Bumsgames\BumsUser_Movimiento::
				join('movimientos','movimientos.id','=','bums_user__movimientos.id_movimiento')
				->where('cantidad','!=','0')
				->where('movimientos.created_at','>=',$request->fecha_inicio)
				->where('movimientos.created_at','<=',$request->fecha_final)
				->groupBy('movimientos.id')
				->orderby('movimientos.created_at','DESC')
				->get();
			}

			$inicio = $request->fecha_inicio;

			$fin = $request->fecha_final;

			$usuario = $request->id_usuario;

			$usuarios = \Bumsgames\BumsUser::All();
		}else{
			dd('error');
		}
		return view('busqueda_david', compact('movimientos','inicio','fin','usuario','usuarios'));

	}

	public function eliminarmodal($id){
		$tutorial = \Bumsgames\tutorial::find($id);
		$tutorial->delete();
		return 1;
	}
}
