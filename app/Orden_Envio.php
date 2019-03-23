<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Orden_Envio extends Model
{
	protected $fillable = [
		'articulo',
		'type_orden',
		'status',
		'price',
		'empresa',
		'id_cuenta',
		'id_recibeUsuario',
		'id_creadoUsuario',
		'id_venta',
		'direccion',
		'cedula',
		'num_telefono',
		'recibe',
		'cedula',
		'id_movimiento',
		'envia_Usuario',
		'tracking'
	];

	public function venta()
	{
		return $this->belongsTo('Bumsgames\Sales', 'id_venta'); // Le indicamos que se va relacionar con el atributo id
	}

	public function recibe_usuario()
	{
		return $this->belongsTo('Bumsgames\BumsUser', 'id_recibeUsuario'); // Le indicamos que se va relacionar con el atributo id
	}

	public function envia_usuario()
	{
		return $this->belongsTo('Bumsgames\BumsUser', 'envia_Usuario'); // Le indicamos que se va relacionar con el atributo id
	}

	public function creado_Usuario()
	{
		return $this->belongsTo('Bumsgames\BumsUser', 'id_creadoUsuario'); // Le indicamos que se va relacionar con el atributo id
	}

	public function cuenta()
	{
		return $this->belongsTo('Bumsgames\Cuenta', 'id_cuenta'); // Le indicamos que se va relacionar con el atributo id
	}

	public function movimiento()
	{
		return $this->belongsTo('Bumsgames\Movimiento', 'id_movimiento'); // Le indicamos que se va relacionar con el atributo id
	}
}
