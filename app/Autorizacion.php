<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property string $numero
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Orden[] $ordens
 */
class Autorizacion extends Model implements AuditableContract
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['orden'];

    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'autorizacion';

    /**
     * @var array
     */
    protected $fillable = ['numero', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orden()
    {
        return $this->hasMany('App\Orden');
    }
}
