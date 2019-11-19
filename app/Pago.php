<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

class Pago extends Model
{
	protected $table = 'pagos';

	protected $fillable = [
		'name',
		'lastname',
		'ws',
		'tipo_trans',
		'banco',
		'cedula',
		'referencia',
		'fecha',
		'monto',
		'image',
		'verificado',
		'entregado',
		'id_user',
		'id_user2',
		'nota_adicional',
		'cupon_id',
	];

	public function setImageAttribute($image)
	{	

		if ($image != 'undefined') {
			$this->attributes['image'] = Carbon::now()->second . $image->getClientOriginalName();
			$name = Carbon::now()->second . $image->getClientOriginalName();
			\Storage::disk('local')->put($name, \File::get($image));
		}
	}

	public function persona1()
	{
		return $this->belongsTo('Bumsgames\BumsUser', 'id_user'); // Le indicamos que se va relacionar con el atributo id
	}

	public function persona2()
	{
		return $this->belongsTo('Bumsgames\BumsUser', 'id_user'); // Le indicamos que se va relacionar con el atributo id
	}

	public function cupon()
	{
		return $this->belongsTo('Bumsgames\Coupon', 'cupon_id');
	}

	public function Articulos()
	{
		return $this->belongsToMany('Bumsgames\Article','pago__articulos','id_pago','id_article');
	}
}

