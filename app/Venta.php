<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
      'id_vendedor',
      'id_cliente',
      'id_envio',
  ];

  public function ventaCliente()
  {
        return $this->belongsTo('Bumsgames\Client', 'id_cliente'); // Le indicamos que se va relacionar con el atributo id
    }

    public function ventaVendedor()
    {
        return $this->belongsTo('Bumsgames\BumsUser', 'id_vendedor'); // Le indicamos que se va relacionar con el atributo id
    }

    public function ventaEnvio()
    {
        return $this->belongsTo('Bumsgames\Envio_Pago', 'id_envio'); // Le indicamos que se va relacionar con el atributo id
    }

    public function pagos()
    {
        return $this->hasMany('Bumsgames\VentaPago','id_venta');
    }

    public function articulos()
    {
    	return $this->hasMany('Bumsgames\VentaArticulos','id_venta');
    }

    public function scopeConVendedor($query, $p)
    {      
        if ($p != -1) {
            return $query->where('id_vendedor',$p);
        }
    }

    public function scopeConEnvio($query, $p)
    {   

        if ($p == "1") {
            return $query->where('id_envio','>',0);
        }else{
            if($p == "0"){
                return $query->where('id_envio',null);
            }
        }
    }

    public function scopeFecha($query, $p)
    {  
        if (isset($p['fecha_inicio']) && isset($p['fecha_final'])) {
            $from = $p['fecha_inicio'];
            $to = $p['fecha_final'];
            return $query->whereBetween('created_at', [$from, $to]);
        }    
    }
}
