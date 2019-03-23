<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class BumsUser_Movimiento extends Model
{
    protected $table = 'bums_user__movimientos';

    protected $fillable = [
        'movimiento_usuario',
        'id_movimiento',
        'porcentaje',
        'id_cuenta',
        'id_venta',
        'permiso',
        'descripcion_movimiento'
    ];

    public function usuario()
    {
        return $this->belongsTo('Bumsgames\BumsUser', 'movimiento_usuario'); // Le indicamos que se va relacionar con el atributo id
    }

    public function movimiento()
    {
        return $this->belongsTo('Bumsgames\Movimiento', 'id_movimiento'); // Le indicamos que se va relacionar con el atributo id
    }

    public function cuenta()
    {
        return $this->belongsTo('Bumsgames\Cuenta', 'id_cuenta'); // Le indicamos que se va relacionar con el atributo id
    }

    public function venta()
    {
        return $this->belongsTo('Bumsgames\Sales', 'id_venta'); // Le indicamos que se va relacionar con el atributo id
    }
}
