<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class tutorial extends Model
{   
    
    protected $table = 'tutorial';


    protected $fillable = [
    	'titulo',
    	'texto'
    ];
    
}
