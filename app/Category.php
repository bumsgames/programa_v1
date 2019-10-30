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
	public function articles() {
		return $this->belongsToMany(Article::class);
	}

	public function prueba(){
		return $this;
	}

	public function scopePs4($query)
	{
		return $query->orderBy('category', 'ASC');
	}
=======
    public function articles() {
        return $this->belongsToMany(Article::class, 'articulo_categorias','id_categoria', 'id_articulo');
    }
>>>>>>> ea8652ffc9237f2ecee0905ff53f8a9bd876d746

}
