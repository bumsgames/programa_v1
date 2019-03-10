<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class Articulo extends Model
{
    protected $table = "articles2";
    
    protected $fillable = [
    	'id_creator',
    	'name',
    	'description',
    	'category',
    	'quantity',
    	'price_in_dolar',
    	'image',
    	'email',
    	'nickname',
    	'password',
    	'reset_button',
    	'note',
        'fondo',
        'oferta'
    ];

}
