<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Envio_Pago extends Model
{
	protected $table = 'envios';

	protected $fillable = [
		'empresa',
		'destinario',
		'cedula_destinario',
		'direccion',
		'telefono',
		'id_pago',
	];
}
