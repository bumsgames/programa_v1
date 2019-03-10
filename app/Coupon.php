<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';


    protected $fillable = [
    	'id',
    	'descuento',
    	'disponible',
    	'codigo',
        'nota_cupon',
    	'fk_empleado'
	];
	
	public function pertenece_fk_empleado() {
        return $this->belongsTo('Bumsgames\BumsUser', 'fk_empleado'); 
    }
}
