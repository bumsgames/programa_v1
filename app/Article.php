<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    protected $fillable = [
        'id_creator',
        'name',
        'description',
        'quantity',
        'peso',
        'price_in_dolar',
        'offer_price',
        'image',
        'email',
        'nickname',
        'password',
        'ultimo_agregado',
        'reset_button',
        'note',
        'fondo',
        'oferta',
        'costo',
        'estado',
        'trailer',
        'ubicacion',
        'fecha_agotado',
    ];

    public function categorias()
    {
        return $this->belongsToMany(Category::class, 'articulo_categorias','id_articulo', 'id_categoria') 
        ->withPivot([
            'id_categoria',
        ]);
    }

    public function ubicaciones()
    {
        return $this->belongsTo('Bumsgames\Ubicacion', 'ubicacion');
    }

    public function Categorias_prueba()
    {
        return $this->belongsToMany(Category::class, 'articulo_categorias','id_articulo', 'id_categoria') 
        ->groupBy('id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'articles_images','article_id', 'image_id');
    }

    public function scopeDebts($query)
    {

        return $query->with('articles.categorias', function($q){
            $q->groupBy('category');
        });
    }


    //Coloca un valor default al peso al usar create
    //Se debe usar esto debido a que la funcion Article::create() no toma el default de la bd y hay que forzarlo
    public static function boot()
    {
        parent::boot();
        self::creating(function ($my_model) {
            if (is_null($my_model->peso)) {
                $my_model->peso = 0;
            }
        });
    }

    public function sale()
    {
        return $this->hasMany('Bumsgames\Sales', 'id_article');
    }

    public function duennos()
    {
        return $this->belongsToMany('Bumsgames\BumsUser', 'bums_user_articles', 'id_article', 'id_bumsuser')
        ->withPivot('porcentaje');
    }

    public function duennos_prueba($index)
    {
        return $this->belongsToMany('Bumsgames\BumsUser', 'bums_user_articles', 'id_article', 'id_bumsuser')->where('bums_user_articles.id_bumsuser', $index)
        ->withPivot('porcentaje');;
    }


    public function setImageAttribute($image)
    {
        $this->attributes['image'] = Carbon::now()->second . $image->getClientOriginalName();
        $name = Carbon::now()->second . $image->getClientOriginalName();
        \Storage::disk('local')->put($name, \File::get($image));
    }

    public function setFondoAttribute($fondo)
    {
        $this->attributes['fondo'] = Carbon::now()->second . $fondo->getClientOriginalName();
        $name = Carbon::now()->second . $fondo->getClientOriginalName();
        \Storage::disk('local')->put($name, \File::get($fondo));
    }

    public function pertenece_category()
    {
        return $this->belongsTo('Bumsgames\Category', 'category'); // Le indicamos que se va relacionar con el atributo id
    }


    public function pertenece_id_creator()
    {
        return $this->belongsTo('Bumsgames\BumsUser', 'id_creator'); // Le indicamos que se va relacionar con el atributo id
    }

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('age', '>', 200);
    }

    public function scopeBusca($query, $p)
    {
        if (isset($p['filtro'])) {
            if ($p['filtro'] == 1) {
                return $query->orderBy('price_in_dolar', 'ASC');
            }

            if ($p['filtro'] == 2) {
                return $query->orderBy('price_in_dolar', 'DESC');
            }

            if ($p['filtro'] == 3) {
                return $query->orderBy('name', 'DESC');
            }

            if ($p['filtro'] == 4) {
                return $query->orderBy('name', 'ASC');
            }
        }
    }

    public function scopeOferta($query, $p)
    {
        if (isset($p['oferta_filt'])) {
            if ($p['oferta_filt'] == 1) {
                return $query->where('oferta',1);
            }
        }
    }

    public function scopeBuscaPorCategoria($query, $data)
    {
        if (isset($data)) {
            if ($data >= 1) {

                return $query->whereIn('articulo_categorias.id_categoria', $data);
            }
        }
    }

    public function scopeBuscaCategoria($query, $data)
    {
        if (count($data)) {
            return $query->whereIn('articulo_categorias.id_categoria', $data);
        }
        
    }

    public function scopeBuscaPorNombre($query, $data)
    {
        if (isset($data)) {
            return $query->where('name', 'like', '%' . $data . '%');
        }
    }

    public function clientes_del_articulo()
    {
        return $this->belongsToMany('Bumsgames\Client', 'pertenece_clientes', 'id_article', 'id_cliente');
    }

    public function ventas_del_articulo()
    {
        return $this->belongsToMany('Bumsgames\Sales', 'pertenece_clientes', 'id_article', 'id_venta');
    }

    public function ubicacion2()
    {
        return $this->belongsTo('Bumsgames\Ubicacion','ubicacion');
        //return $this->hasOne('Bumsgames\Ubicacion', 'ubicacion', 'id');
    }

    public function scopeConUbicacion($query, $p)
    {   
        if ($p != "-1") {
            return $query->where('ubicacion',$p);
        }
    }

    public function scopeConCorreo($query, $p)
    {   
        if ($p != "") {
            return $query->where('email','like', '%' . $p . '%');
        }
    }

    public function scopeDisponibilidad($query, $disponible)
    {   
        if (isset($disponible)) {
            if ($disponible == 1) {
                return $query->where('quantity', '>=', 1);
            }
            if ($disponible == 0) {
                return $query->where('quantity', '<=', 0);
            }
        }
    }

    public function scopeCreador($query, $p)
    {   
        if ($p != 0) {
            return $query->where('id_creator', '%' . $p . '%');
        }
    }

    public function scopeNickname($query, $p)
    {   
        if ($p != "") {
            return $query->where('nickname', 'LIKE', '%' . $p . '%');
        }
    }


}
