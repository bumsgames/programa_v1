<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = [
        'name',
        'telefono',
        'oferta',
        'estado',
        'Fk_article',
        'mensaje'
    ];

    public function articulo()
    {
        return $this->belongsTo('Bumsgames\Article', 'Fk_article');
    }

    public function client()
    {
        return $this->belongsTo('Bumsgames\Client', 'client_id');
    }
}
