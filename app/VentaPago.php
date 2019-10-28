<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class VentaPago extends Model
{

	protected $fillable = [
		'id_venta',
		'monto',
		'id_bancoEmisor',
		// 'referencia',
		// 'notaPago',
		// 'capture',
		'id_coin',
		'dolardia',
	];

	public function pagoInvolucrados()
    {
    	return $this->hasMany('Bumsgames\pagoInvolucrados','id_pago');
    }

    public function moneda()
	{
		return $this->belongsTo('Bumsgames\Coin', 'id_coin'); // Le indicamos que se va relacionar con el atributo id
	}

	public function banco()
	{
		return $this->belongsTo('Bumsgames\banco_emisor', 'id_bancoEmisor'); // Le indicamos que se va relacionar con el atributo id
	}

}
