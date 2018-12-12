<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $nombres
 * @property string $apellidos
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Lectura[] $lecturas
 */
class Users extends Model implements AuditableContract 
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    /**
     * @var array
     */
    protected $fillable = ['username', 'password', 'nombres', 'apellidos', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lecturas()
    {
        return $this->hasMany('App\Lectura', 'users_id');
    }
}
