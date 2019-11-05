<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'category',
		'id_categoria',
	];

<<<<<<< HEAD

	// public function articles() {
	// 	return $this->belongsToMany(Article::class);
	// }
=======
>>>>>>> b61954011d43fe0e7db27b23de158819f3d196c7

	public function prueba(){
		return $this;
	}

	public function scopePs4($query)
	{
		return $query->orderBy('category', 'ASC');
<<<<<<< HEAD
	}

    public function articles() {
        return $this->belongsToMany(Article::class, 'articulo_categorias','id_categoria', 'id_articulo');
    }

=======
    }
    
    
    public function articles() {
        return $this->belongsToMany(Article::class, 'articulo_categorias','id_categoria', 'id_articulo');
    }
>>>>>>> b61954011d43fe0e7db27b23de158819f3d196c7

}
