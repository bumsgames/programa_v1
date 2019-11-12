<?php

namespace Bumsgames;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{


    use Notifiable;

    protected $guard = 'client';

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'lastname',
        'nickname',
        'cedula',
        'email',
        'image',
        'password',
        'num_contact',
        'note',
        'documento_identidad',
        'confirmation_code',
        'confirmed'

    ];

    public function mis_articulos()
    {
        return $this->belongsToMany('Bumsgames\Client', 'pertenece_clientes', 'id_cliente', 'id_article');
    }

    public function vendedor_del_articulo()
    {
        return $this->belongsToMany('Bumsgames\BumsUser', 'sales', 'id_client', 'id_vendedor');
    }
}

