<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


    protected $table = 'comment';


    protected $fillable = [
    	'id_comentario',
    	'nombre',
    	'texto',
    	'fecha_comentado',
    	'aprobado',
    	'fecha_aprobado'
    ];
}
