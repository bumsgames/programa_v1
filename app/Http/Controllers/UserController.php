<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \Bumsgames\BumsUser::All();
        return view('user.createUser', compact('users'));
    }

    public function prueba(Request $request){
        return "bien";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = \Bumsgames\BumsUser::All();
        return view('user.createUser', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request('tal')
       // \Bumsgames\BumsUser::create([
       //  'name' => $request['name']
       // ]);
        // \Bumsgames\BumsUser::create([
        //     'name'     => $request->name,
        //     'lastname'     => $request->lastname,
        //     'nickname'     => $request->nickname,
        //     'email'    => $request->email,
        //     'level' => $request->level,
        //     'image' => $request->image,
        //     'password' => bcrypt($request->password),
        // ]);
        $request['password'] = bcrypt($request->password);
        // return $request->all();
        \Bumsgames\BumsUser::create($request->all());
        // return redirect('user')->with('message','store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'dfdfjsdfjsdfjfsd';
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
