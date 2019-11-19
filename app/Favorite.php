<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = "favorites";

    protected $fillable = [
        'client_id',
        'article_id',
    ];

    public function articulo()
    {
        return $this->belongsTo('Bumsgames\Article', 'article_id');
    }
    
}
