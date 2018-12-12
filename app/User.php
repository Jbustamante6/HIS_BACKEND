<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JWTAuth;
use OwenIt\Auditing\Contracts\UserResolver;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'nombres', 'apellidos', 'created_at', 'updated_at', 'deleted_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    
    public static function resolveId()
    {   
        $user = JWTAuth::parseToken()->authenticate();
        return $user->id;
    }
    
}
