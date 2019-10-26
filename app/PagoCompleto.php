<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class PagoCompleto extends Model
{
	protected $table = 'pago_completos';

	protected $fillable = [
		'id_venta', 
		'monto',
		'bancoEmisor',
		'referencia',
		'notaPago',
		'capture',
		'id_coin' ,      
		'dolardia',
	];

	public function moneda()
	{
		return $this->belongsTo('Bumsgames\Coin', 'id_coin'); // Le indicamos que se va relacionar con el atributo id
	}
}
