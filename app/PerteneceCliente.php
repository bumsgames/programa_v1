<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class PerteneceCliente extends Model
{
    protected $fillable = [
    	'id_cliente',
    	'id_article',
        'id_venta',
    	'informacion'
    ];

    public function cliente()
    {
        return $this->belongsTo('Bumsgames\Client', 'id_cliente');
    }

    public function articulo()
    {
        return $this->belongsTo('Bumsgames\Article', 'id_article');
    }

    public function venta()
    {
        return $this->belongsTo('Bumsgames\Sales', 'id_venta');
    }
}
