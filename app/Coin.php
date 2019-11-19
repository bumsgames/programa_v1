<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
	protected $table = 'coins';

	protected $fillable = [
		'coin',
		'sign',
		'valor',
		'imagen'
	];

	public function cuentas_bancarias()
    {
        return $this->hasMany('Bumsgames\banco_emisor', 'id_coin');
    }
}

