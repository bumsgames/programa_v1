<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Article_Image extends Model
{
    protected $table = "articles_images";

    protected $fillable = [
        'article_id',
        'image_id',
    ];
}
