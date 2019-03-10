<?php

namespace Bumsgames\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;
use Illuminate\Support\Facades\Auth;

class User_level
{
    protected $auth;

    public function __construcs(Guard $auth){
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->level != 022390848){
            Session::flash('message-error', 'Sin privilegios');
            return redirect()->to('menu');
        }
        return $next($request);
    }
}
