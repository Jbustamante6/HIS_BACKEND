<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property int $eps_id
 * @property string $num
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Ep $ep
 * @property Estudio[] $estudios
 */
class Orden extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'orden';

    /**
     * @var array
     */
    protected $fillable = ['eps_id', 'num', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ep()
    {
        return $this->belongsTo('App\Ep', 'eps_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudios()
    {
        return $this->hasMany('App\Estudio');
    }
}
