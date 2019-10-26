<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class VentaArticulos extends Model
{
    // protected $table = 'venta_articulos';

	protected $fillable = [
		'id_venta',
		'id_articulo',
		'cantidad',
		'inversionIndividual',
		'costo_individual',
		'precio_venta',
	];

	public function articulo()
	{
        return $this->belongsTo('Bumsgames\Article', 'id_articulo'); // Le indicamos que se va relacionar con el atributo id
    }

    public function involucrados()
    {
    	return $this->hasMany('Bumsgames\Venta_PagoInvolucrados','id_ventaArticulo');
    }
}
