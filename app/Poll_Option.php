<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Poll_Option extends Model
{
    protected $fillable = [
        'nombre',
        'contador',
        'Fk_Poll',
        'color'
    ];

    public function Poll()
    {
        return $this->belongsTo('Bumsgames\Poll', 'Fk_Poll');
    }
}
