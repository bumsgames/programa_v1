<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Pago_Articulo extends Model
{
    protected $table = 'pago__articulos';

    protected $fillable = [
		'id_pago',
		'id_article',
	];
	
}
