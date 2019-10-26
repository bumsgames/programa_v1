<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Venta_PagoInvolucrados extends Model
{
    // protected $table = 'pago_involucrados';

	protected $fillable = [
		'id_ventaArticulo',
		'id_agente',
		'porcentajeInvolucrado',
		'descripcionInvolucrado',
		'cobrado_boolean',
		'porcentajeInversion',
	];

	public function persona()
    {
        return $this->belongsTo('Bumsgames\BumsUser', 'id_agente'); // Le indicamos que se va relacionar con el atributo id
    }
}
