<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class mailController extends Controller
{
    public function EnviarPago()
    {
        Mail::send(['text' => 'mail.pago'], ['name', 'Bumsgames'], function ($message) {
            $message->to('bumsgames.notificaciones@gmail.com', 'To Bumsgames')->subject('Nuevo Pago');
            $message->from('bumsgames.notificaciones@gmail.com', 'Bumsgames Notificaciones');
        });
    }
}
