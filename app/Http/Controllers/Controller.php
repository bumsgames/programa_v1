<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public function index()
    {
        return "hola";
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
