<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
	protected $table = 'cuentas';

	protected $fillable = [
		'entidad',
		'correo',
		'password',
		'id_bumsuser',
		'note_cuenta',
		'id_coin',
		'price'
	];

	public function su_movimiento()
	{
		return $this->belongsToMany('Bumsgames\Movimiento', 'bums_user__movimientos', 'id_cuenta', 'id_movimiento');
		// ->withPivot('porcentaje');;
	}

	public function ordenes()
	{
		return $this->hasMany('Bumsgames\Orden_Envio', 'id_cuenta');
		// ->withPivot('porcentaje');;
	}

	public function moneda()
	{
		return $this->belongsTo('Bumsgames\Coin', 'id_coin'); // Le indicamos que se va relacionar con el atributo id
	}
}
