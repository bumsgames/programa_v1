<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category',
    ];

    public function articles() {
        return $this->belongsToMany(Article::class, 'articulo_categorias','id_categoria', 'id_articulo');
    }

}
