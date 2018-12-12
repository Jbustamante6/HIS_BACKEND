<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property string $num
 * @property string $nombre
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 * @property Orden[] $ordens
 */
class EPS extends Model implements AuditableContract 
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'eps';

    /**
     * @var array
     */
    protected $fillable = ['num', 'nombre', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordens()
    {
        return $this->hasMany('App\Orden', 'eps_id');
    }
}
