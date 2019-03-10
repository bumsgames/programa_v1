<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Movimiento extends Model
{
    // use SoftDeletes;
    
	protected $table = 'movimientos';

    protected $fillable = [
        'pertenece_user',
        'type',
        'description',
        'price',
        'referencia',
        'comision',
        'comision_user',
        'id_coin',
        'dolardia',
        'entidad',
        'note_movimiento',
        'cantidad'
    ];
    // protected $dates = ['deleted_at'];


    public function moneda() {
        return $this->belongsTo('Bumsgames\Coin', 'id_coin'); // Le indicamos que se va relacionar con el atributo id
    }


    public function venta(){
        return $this->belongsToMany('Bumsgames\Sales', 'bums_user__movimientos','id_movimiento', 'id_venta')
        ->withPivot('porcentaje','movimiento_usuario');
    }

    public function usuario(){
        return $this->belongsToMany('Bumsgames\BumsUser', 'bums_user__movimientos','id_movimiento', 'movimiento_usuario')
        ->withPivot('porcentaje','movimiento_usuario','permiso');
    }

}