<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class reporte extends Model
{
	protected $fillable = [
		'type_reporte',
		'titulo_reporte',
		'descripcion_reporte',
		'creador'
	];

	public function creadorF(){
		return $this->belongsTo('Bumsgames\BumsUser', 'creador');
	}
}
