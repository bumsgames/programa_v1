<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class banco_emisor extends Model
{
	protected $table = "banco_emisor";

	protected $fillable = [
		'banco',
		'id_coin',
		'titular',
		'cuentaBancaria',
		'tipo_cuenta',
		'cedula',
		'nota',
	];

	public function moneda()
    {
        return $this->belongsTo('Bumsgames\Coin', 'id_coin'); // Le indicamos que se va relacionar con el atributo id
    }
}
