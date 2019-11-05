<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";

    protected $fillable = [
        'numero',
        'file',
    ];

    public function articles() {
        return $this->belongsToMany(Article::class, 'articles_images','image_id','article_id');
    }

}
