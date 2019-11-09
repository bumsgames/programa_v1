<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Carrito_Admin extends Model
{
	protected $table = "carrito_admin";
    protected $fillable = [
        'id_admin',
        'id_articulo',
        'cantidad',
    ];

    public function articulo()
    {
        return $this->belongsTo('Bumsgames\Article', 'id_articulo','id');
    }
}
