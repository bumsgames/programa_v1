<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Homework extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'id',
		'de_usuario',
		'para_usuario',
		'mensaje',
		'status',

	];
	protected $dates = ['deleted_at'];


	public function enviado_de() {
        return $this->belongsTo('Bumsgames\BumsUser', 'de_usuario'); // Le indicamos que se va relacionar con el atributo id
    }
    public function recibido_por() {
        return $this->belongsTo('Bumsgames\BumsUser', 'para_usuario'); // Le indicamos que se va relacionar con el atributo id
    }
    public function nombre_status() {
        return $this->belongsTo('Bumsgames\Status', 'status'); // Le indicamos que se va relacionar con el atributo id
    }

}
