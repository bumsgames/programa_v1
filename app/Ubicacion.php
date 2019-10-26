<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{

    protected $table = 'ubicacion';

    protected $fillable = [
        'nombre_ubicacion',
    ];


}
