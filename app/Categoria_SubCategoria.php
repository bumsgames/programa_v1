<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Categoria_SubCategoria extends Model
{
    //

    public function categoria()
    {
       return $this->hasMany('Bumsgames\Category', 'id_categoria', 'id');
    }

}
