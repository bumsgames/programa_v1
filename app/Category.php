<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'category',
		// PlayStation, Xbox (Este modelo es SubCategoria	)
		'id_categoria',
	];


	public function PerteneceCategoria(){
		return $this->belongsTo('Bumsgames\Categoria_SubCategoria', 'id_categoria');
	}

	public function scopePs4($query)
	{
		return $query->orderBy('category', 'ASC');
    }
    
    
    public function articles() {
        return $this->belongsToMany(Article::class, 'articulo_categorias','id_categoria', 'id_articulo');
    }

    public function scopeConCategoria($query, $p)
    {   
        if ($p != "0") {
            return $query->where('categories.id',$p);
        }
    }

}
