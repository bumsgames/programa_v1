<?php

namespace Bumsgames;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{


    use Notifiable;

    protected $guard = 'client';

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'lastname',
        'nickname',
        'email',
        'image',
        'password',
        'num_contact',
        'note',
        'documento_identidad',
        'confirmation_code',
        'confirmed'

    ];

    public function favorites()
    {
        return $this->hasMany('Bumsgames\Favorite', 'client_id');
    }

    public function scopeConCedula($query, $p)
    {      
print_r("veo si entro2");
        if ($p) {
            print_r("entre2");
            return $query->where('documento_identidad', 'like', '%' . $p . '%');
        }
    }

    public function scopeConNickname($query, $p)
    {   
         print_r("veo si entro");
        if ($p) {
            print_r("entre");
            return $query->where('nickname', 'like', '%' . $p . '%');
        }
    }


}

