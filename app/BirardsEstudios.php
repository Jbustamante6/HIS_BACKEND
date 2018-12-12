<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract; 

/**
 * @property int $birards_id
 * @property int $estudios_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Birard $birard
 * @property Estudio $estudio
 */
class BirardsEstudios extends Model implements AuditableContract 
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'birards_has_estudios';

    /**
     * @var array
     */
    protected $fillable = ['birards_id', 'estudios_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function birard()
    {
        return $this->belongsTo('App\Birard', 'birards_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudio()
    {
        return $this->belongsTo('App\Estudio', 'estudios_id');
    }
}
