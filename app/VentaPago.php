<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class VentaPago extends Model
{

	protected $fillable = [
		'id_venta',
		'monto',
		'id_bancoEmisor',
		'referencia',
		'notaPago',
		// 'capture',
		'id_coin',
		'dolardia',
	];

    public function venta()
    {
        return $this->belongsTo('Bumsgames\Venta', 'id_venta'); // Le indicamos que se va relacionar con el atributo id
    }

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


	public function scopeConVendedor($query, $p)
    {      
        if ($p != -1) {
            return $query->where('id_bancoEmisor',$p);
        }
    }

    public function scopeConMoneda($query, $p)
    {      
        if ($p != -1) {
            return $query->where('id_coin',$p);
        }
    }

    public function scopeConBanco($query, $p)
    {   
        if ($p != "-1") {
            return $query->where('id_bancoEmisor',$p);
        }
    }

}
