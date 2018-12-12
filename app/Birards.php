<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property string $nombre
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property BirardsHasEstudio[] $birardsHasEstudios
 */
class Birards extends Model implements AuditableContract 
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function birardsHasEstudios()
    {
        return $this->hasMany('App\BirardsHasEstudio', 'birards_id');
    }
}
