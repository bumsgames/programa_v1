<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
    	'nombre',
    	'estado'
    ];

    public function Options()
    {
        return $this->hasMany('Bumsgames\Poll_Option','Fk_Poll');
    }
}
