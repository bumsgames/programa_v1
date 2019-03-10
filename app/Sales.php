<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
	protected $fillable = [
		'id_vendedor',
		'id_movimiento',
		'note',
		'id_client',
		// 'envio',
		'id_article',
	];

	// public function pertenece_article() {
	// 	return $this->belongsTo('Bumsgames\Article', 'id_article'); 
	// }

	// public function pertenece_id_user_que_vende() {
	// 	return $this->belongsTo('Bumsgames\BumsUser', 'id_user_que_vende');
	// }

	// public function pertenece_id_user_duenno_articulo() {
	// 	return $this->belongsTo('Bumsgames\BumsUser', 'id_user_duenno_articulo');
	// }

	// public function pertenece_id_client() {
	// 	return $this->belongsTo('Bumsgames\Client', 'id_client');
	// }

	// public function papa() {
	// 	return $this->price - $this->commission;
	// }

	public function articulo() {
        return $this->belongsTo('Bumsgames\Article', 'id_article'); // Le indicamos que se va relacionar con el atributo id
    }

    public function user() {
        return $this->belongsTo('Bumsgames\BumsUser', 'id_vendedor'); // Le indicamos que se va relacionar con el atributo id
    }

    public function cliente() {
        return $this->belongsTo('Bumsgames\Client', 'id_client'); // Le indicamos que se va relacionar con el atributo id
    }

    public function movimiento() {
        return $this->belongsTo('Bumsgames\Movimiento', 'id_movimiento'); // Le indicamos que se va relacionar con el atributo id
	}
	

	
}