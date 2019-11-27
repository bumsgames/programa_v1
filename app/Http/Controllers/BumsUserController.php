<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Bumsgames\Notifications\TaskCompleted;
use Bumsgames\BumsUser;


class BumsUserController extends Controller
{
    //Redirecciona al usuario comun en las paginas de administracion
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'webuser.index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()) 
        {
            return redirect()->route('menu');
        }
        else
        {
            return view('admin.login');
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

    public function actualizar_user(Request $request)
    {
        $this->validate($request, [
            'password' => 'password|required|string',
        ]);
    }

    public function verifyPass(Request $request)
    {   
        $user = Auth::user();

        if (Auth::attempt(['nickname' => $user->nickname, 'password' => $request->password])) {
            return response()->json(['data'=>true,'user'=>$user]);
        }else{
            return response()->json(['data'=>false, 'error'=>'La contraseña ingresada no coincide.']);
        }
    }


    public function logueo(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'required|string',
        ]);

        // return Redirect::to('/');


        if (Auth::attempt(['nickname' => $request->nickname, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->route('menu');
            //return Redirect::to('/');
        }

        return back()
            ->withErrors(['nickname' => 'Usuario o Clave incorrecto'])
            ->withInput(request(['nickname']));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nickname' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'required|string',
        ]);

        // return Redirect::to('/');


        if (Auth::attempt(['nickname' => $request->nickname, 'password' => $request->password])) {
            // Authentication passed...

            dd('bien');
            return redirect()->route('menu');
            //return Redirect::to('/');
        }

        return back()
            ->withErrors(['nickname' => 'Usuario o Clave incorrecto'])
            ->withInput(request(['nickname']));
    }


    //Crea un nuevo bumsuser
    public function crear_usuario(Request $request)
    {

        $this->validate($request, [
            'nickname' => 'required|string|unique:bums_users',
            'email' => 'nullable|email|unique:bums_users',
            'password' => 'required|string',
        ]);

        try {
            //encripta la contraseña
            $request['password'] = bcrypt($request->password);
            $request['porcentaje_ventaPropia'] = number_format((float)($request['porcentaje_ventaPropia'] / 100), 2, '.', '');
            $request['porcentaje_ventaParcial'] = number_format((float)($request['porcentaje_ventaParcial'] / 100), 2, '.', '');
            $request['porcentaje_ventaAjena'] = number_format((float)($request['porcentaje_ventaAjena'] / 100), 2, '.', '');
            $request['porcentaje_ventaPorOtraPersona'] = number_format((float)($request['porcentaje_ventaPorOtraPersona'] / 100), 2, '.', '');
            //dd($request->all());
            \Bumsgames\BumsUser::create($request->all());

            $titulo = 'USUARIO CREADO';
            $data = 'Accion por: ' . auth()->user()->name . ' ' . auth()->user()->lastname;
            $data2 = '';
            $users = BumsUser::where('level', '>=', '7')->get();
            foreach ($users as $user) {
                $user->notify(new TaskCompleted($titulo, $data, $data2));
            }
            return back()->with('success', 'Usuario creado, correctamente.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Hubo un error y no se pudo agregar su Usuario')
                ->withInput(request(['name', 'lastname', 'email', 'nickname', 'level','telefono',]));
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
