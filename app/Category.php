<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'category',
		'id_categoria',
	];

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

}
