<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Article_Image extends Model
{
    protected $table = "articles_Images";

    protected $fillable = [
        'article_id',
        'image_id',
    ];
}
