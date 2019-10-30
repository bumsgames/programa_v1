<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{

    protected $table = 'ubicacion';

    protected $fillable = [
        'nombre_ubicacion',
    ];

    public function articles()
    {
        //return $this->belongsTo('Bumsgames\Article','articles', 'ubicacion');
        return $this->hasMany('Bumsgames\Article', 'ubicacion');
    }

}
