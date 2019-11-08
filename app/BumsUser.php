<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BumsUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'bums_users';

    protected $guard = 'admin';


    protected $fillable = [
        'name', 'lastname', 'nickname', 'email', 'level', 'image', 'password'
    ];

    public function setImageAttribute($image)
    {
        $this->attributes['image'] = Carbon::now()->second . $image->getClientOriginalName();
        $name = Carbon::now()->second . $image->getClientOriginalName();
        \Storage::disk('local')->put($name, \File::get($image));
    }

    public function misArticulo()
    {
        return $this->belongsToMany('Bumsgames\Article');
    }

    public function scopeDueño($query, $p)
    {   
       
        if ($p != "0") {
            return $query->where('id_bumsuser', $p);
        }
    }
}
