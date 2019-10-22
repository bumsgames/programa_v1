<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Bumsgames\Notifications\TaskCompleted;
use Bumsgames\BumsUser;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        $Status = \Bumsgames\Status::All();
        $users = \Bumsgames\BumsUser::All();
        $Homeworks = \Bumsgames\Homework::orderby('created_at', 'desc')->get();

        return view('HomeWork.index', compact('pago_sin_confirmar', 'users', 'Homeworks', 'Status', 'tutoriales'));
    }

    public function imagenes()
    {
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        $imagenes = \Bumsgames\Imagen::orderby('created_at', 'desc')
            ->where('portal', 0)
            ->paginate(5);
        $imagenes_cantidad = \Bumsgames\Imagen::orderby('created_at', 'desc')->where('portal', 0)->get();
        $imagenes_cantidad = $imagenes_cantidad->count();
        return view('HomeWork.imagenes', compact('pago_sin_confirmar', 'imagenes', 'imagenes_cantidad', 'tutoriales'));
    }

    public function add_imagenes(Request $request)
    {
        // if($request->ajax()){
        $titulo = 'NUEVA IMAGEN AGREGADA';
        $data = 'Accion por: ' . auth()->user()->name . ' ' . auth()->user()->lastname;
        $data2 = '';
        $users = BumsUser::where('level', '>=', '1')
            ->where('id', '!=', auth()->user()->id)
            ->get();
        foreach ($users as $user) {
            $user->notify(new TaskCompleted($titulo, $data, $data2));
        }
        $this->validate($request, [
            'imagen' => 'required|max:2000',
        ]);
        \Bumsgames\Imagen::create($request->all());

        return $request->all();
    }

    public function tareas_mias()
    {
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        $Status = \Bumsgames\Status::All();
        $users = \Bumsgames\BumsUser::All();
        $Homeworks = \Bumsgames\Homework::where('para_usuario', Auth::id())
            ->orderby('created_at', 'desc')->get();
        return view('HomeWork.index', compact('pago_sin_confirmar', 'users', 'Homeworks', 'Status', 'tutoriales'));
    }

    public function actualizar_uss($id, Request $request)
    {
        $usuario = \Bumsgames\BumsUSer::find($id);
        $usuario->fill($request->all());
        $usuario->save();
        return response()->json([
            "mensaje" => "Modificado"
        ]);
    }

    public function buscar_articulo(Request $request)
    {
        $tutoriales = \Bumsgames\tutorial::all();

        $id = $request->id_art;
        $articulo = \Bumsgames\Article::find($id);
        //$articulo = \Bumsgames\Article::with('categorias')->where('id', $id)->get();

        
        
        $articuloConCategory = \Bumsgames\Article::with('categorias')->where('id', $id)->first();

        //dd($articuloConCategory->toArray());
        //dd($articuloConCategory["categorias"]->toArray());
        $categoriesArt = $articuloConCategory['categorias'];

        //dd($articuloConCategory->toArray(), $categoriesArt);
        

        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        $users = \Bumsgames\BumsUser::whereNotIn('id', function ($q) use ($id) {
                $q->select('id_bumsuser')->from('bums_user_articles')->where('id_article', $id);
            })->get();
        // $users = \Bumsgames\BumsUser::All();
        $categories = \Bumsgames\Category::All();

        foreach ($categoriesArt as $category) {
            //dd($categories[$category->id - 1]->id);
            unset($categories[$category->id - 1]);
        }
        
        if(Auth::user()->level >= 7 || in_array($articulo->category,[3,4,6,7,10,11,13,14,15])){
            return view('admin.article.formulario_Art', compact('pago_sin_confirmar', 'users', 'categories', 'articulo', 'tutoriales', 'categoriesArt'));
        }
        else{
            return redirect('404');
        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->de_usuario != $request->para_usuario) {
            $titulo = 'TE HAN COLOCADO UNA TAREA';
            $data = 'Accion por: ' . auth()->user()->name . ' ' . auth()->user()->lastname;
            $data2 = '';
            $user = BumsUser::find($request->para_usuario);
            $user->notify(new TaskCompleted($titulo, $data, $data2));
        }
        if ($request->ajax()) {

            \Bumsgames\homework::create($request->all());
            return response()->json([
                "mensaje" => $request->all()
            ]);
        }
    }

    public function add_envios(Request $request)
    {
        if ($request->ajax()) {

            \Bumsgames\Orden_Envio::create($request->all());
            return response()->json([
                "mensaje" => $request->all()
            ]);
        }

        $titulo = 'NUEVO ENVIO AGREGADO';
        $data = 'Accion por: ' . auth()->user()->name . ' ' . auth()->user()->lastname;
        $data2 = '';
        $users = BumsUser::where('level', '>=', '7')
            ->where('id', '!=', auth()->user()->id)
            ->get();
        foreach ($users as $user) {
            $user->notify(new TaskCompleted($titulo, $data, $data2));
        }
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

        $homework = \Bumsgames\Homework::find($id);

        return response()->json($homework);
    }

    public function EnviarOrden($id)
    {

        $Orden = \Bumsgames\Orden_Envio::find($id);

        return response()->json($Orden);
    }

    public function buscar_cuenta($id)
    {

        $Cuenta = \Bumsgames\Cuenta::find($id);

        return response()->json($Cuenta);
    }

    public function eliminar_cliente(Request $request)
    {
        $comprob = \Bumsgames\PerteneceCliente::where('id_cliente', $request->id)
            ->where('id_article', '!=', '2')
            ->first();

        if ($request->id == 1167) {
            return Response()->json([
                "error" => "reservado",
                "mensaje" => "No se puede borrar este cliente"
            ]);
        }
        if (isset($comprob)) {
            return Response()->json([
                "error" => "duenno",
                "mensaje" => "No puedes eliminar clientes que poseen algun articulo"
            ]);
        }
        $sales = \Bumsgames\Sales::where('id_client', $request->id);

        DB::statement('UPDATE sales SET id_client="1167" WHERE id_client =' . $request->id . ' ');


        $perteneceCliente = \Bumsgames\PerteneceCliente::where('id_cliente', $request->id);

        DB::statement('UPDATE pertenece_clientes SET id_cliente="1167" WHERE id_cliente =' . $request->id . ' ');



        $homework = \Bumsgames\Client::find($request->id);
        $homework->delete();
        return Response()->json(["mensaje" => "borrado"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update2($id, Request $request)
    {
        $homework = \Bumsgames\Homework::find($id);
        $homework->fill($request->all());
        $homework->save();
        return response()->json([
            "mensaje" => "Modificado"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->ajax()) {
                $homework = \Bumsgames\Homework::find($id);
                // \Bumsgames\Homework::destroy($id);
                $homework->delete();

                return Responseonse()->json(["mensaje" => "borrado"]);
            }
    }

    public function destroymov($id, Request $request)
    {
        if ($request->ajax()) {
                $movimiento = \Bumsgames\Movimiento::find($id);
                if ($movimiento->description == 'Venta Realizada') {
                    $temp = \Bumsgames\Sales::where('id_movimiento', $id)->first();
                    $temp = \Bumsgames\Article::find($temp->id_article);
                    $temp->fill(['quantity' => $temp->quantity + $movimiento->cantidad]);
                    $temp->save();
                }
                \Bumsgames\Movimiento::destroy($id);
                return $request->all();
            }
    }

    public function destroyuss($id, Request $request)
    {
        if ($request->ajax()) {

                $Usuario = \Bumsgames\BumsUser::destroy($id);

                $titulo = 'USUARIO ELIMINADO';
                $data = 'Accion por: ' . auth()->user()->name . ' ' . auth()->user()->lastname;
                $data2 = '';
                $users = BumsUser::where('level', '>=', '7')->get();
                foreach ($users as $user) {
                    $user->notify(new TaskCompleted($titulo, $data, $data2));
                }

                return $request->all();
            }
    }

    public function destroyArt($id, Request $request)
    {
        if ($request->ajax()) {

                $Articulos = \Bumsgames\Article::destroy($id);

                // $homework->destroy();

                $titulo = 'ARTICULO ELIMINADO';
                $data = "Eliminacion por: " . auth()->user()->name . ' ' . auth()->user()->lastname;
                $data2 = "";
                $users = BumsUser::where('level', '>=', '9')->get();
                foreach ($users as $user) {
                    $user->notify(new TaskCompleted($titulo, $data, $data2));
                }

                return $request->all();
            }
    }

    public function destroyEnv($id, Request $request)
    {
        if ($request->ajax()) {

                $Envios = \Bumsgames\Orden_Envio::destroy($id);

                // $homework->destroy();

                return $request->all();
            }
    }

    public function destroyAcc($id, Request $request)
    {
        if ($request->ajax()) {

                $Envios = \Bumsgames\Cuenta::destroy($id);

                // $homework->destroy();

                return $request->all();
            }
    }

    public function destroyImagen($id, Request $request)
    {
        if ($request->ajax()) {

                $Envios = \Bumsgames\Imagen::destroy($id);

                $titulo = 'IMAGEN ELIMINADA';
                $data = 'Accion por: ' . auth()->user()->name . ' ' . auth()->user()->lastname;
                $data2 = '';
                $users = BumsUser::where('level', '>=', '1')
                    ->where('id', '!=', auth()->user()->id)
                    ->get();
                foreach ($users as $user) {
                    $user->notify(new TaskCompleted($titulo, $data, $data2));
                }

                // $homework->destroy();

                return $request->all();
            }
    }

    public function eliminar_reporte($id, Request $request)
    {
        if ($request->ajax()) {

                \Bumsgames\Reporte::destroy($id);
                return $request->all();
            }
    }

    public function envios_actuales()
    {
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        $Envios = \Bumsgames\Orden_Envio::where('type_orden', 'Por Enviar.')
            ->orderby('created_at', 'desc')
            ->get();
        return view('HomeWork.envios', compact('pago_sin_confirmar', 'Envios', 'tutoriales'));
    }

    public function envios_actuales_recibir()
    {
        $Envios = \Bumsgames\Orden_Envio::where('type_orden', 'Por recibir')
            ->where('articulo', '!=', 'Saldo agregado')
            ->orderby('created_at', 'desc')
            ->get();
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        return view('HomeWork.envios', compact('pago_sin_confirmar', 'Envios', 'tutoriales'));
    }
    
    public function modEnvio($id, Request $request)
    {
        $envios = \Bumsgames\Orden_Envio::find($id);
        $envios->fill($request->all());
        $envios->save();
        return response()->json([
            "mensaje" => "Modificado"
        ]);
    }

    public function modCuent($id, Request $request)
    {
        $Cuenta = \Bumsgames\Cuenta::find($id);
        $Cuenta->fill($request->all());
        $Cuenta->save();
        return response()->json([
            "mensaje" => "Modificado"
        ]);
    }
}
