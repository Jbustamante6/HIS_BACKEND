<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $estudios_id
 * @property int $users_id
 * @property string $fecha_lectura
 * @property string $hora_in_lectura
 * @property string $hora_fn_lectura
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Estudio $estudio
 * @property User $user
 */
class Lecturas extends Model implements AuditableContract 
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;

    /**
     * @var array
     */
    protected $fillable = ['estudios_id', 'users_id', 'fecha_lectura', 'hora_in_lectura', 'hora_fn_lectura', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudio()
    {
        return $this->belongsTo('App\Estudio', 'estudios_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
