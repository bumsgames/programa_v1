<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Articulo_Categoria extends Model
{
    protected $table = "articulo_categorias";

    protected $fillable = [
        'id_articulo',
        'id_categoria',
    ];
}
