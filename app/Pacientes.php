<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_nacimiento
 * @property string $n_ident
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Estudio[] $estudios
 */
class Pacientes extends Model implements AuditableContract 
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    /**
     * @var array
     */
    protected $fillable = ['nombres', 'apellidos', 'fecha_nacimiento', 'n_ident', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudios()
    {
        return $this->hasMany('App\Estudio', 'pacientes_id');
    }
}
