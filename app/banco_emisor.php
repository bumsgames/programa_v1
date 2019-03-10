<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class banco_emisor extends Model
{
    protected $table = "banco_emisor";
    
    protected $fillable = [
    	'banco',
    ];}
