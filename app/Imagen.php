<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Imagen extends Model
{
    protected $fillable = [
        'imagen',
        'id_creator',
        'tipo',
        'portal'
    ];

    public function setImagenAttribute($imagen)
    {
        $this->attributes['imagen'] = Carbon::now()->second . $imagen->getClientOriginalName();
        $name = Carbon::now()->second . $imagen->getClientOriginalName();
        \Storage::disk('local')->put($name, \File::get($imagen));
    }

    public function pertenece_id_creator()
    {
        return $this->belongsTo('Bumsgames\BumsUser', 'id_creator'); // Le indicamos que se va relacionar con el atributo id
    }
}
