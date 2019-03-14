<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $fillable = [
        'imagen',
        'titulo',
        'descripcion',
        'likes',
        'Fk_Creador',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function autor(){
        return $this->belongsTo('Bumsgames\BumsUser','Fk_Creador');
    }
}
