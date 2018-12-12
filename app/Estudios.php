<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
/**
 * @property int $id
 * @property int $estados_estudio_id
 * @property int $imagen_id
 * @property int $modalidad_id
 * @property int $orden_id
 * @property int $pacientes_id
 * @property string $informacion
 * @property float $intensidad_media
 * @property float $vol_agua
 * @property float $vol_total
 * @property string $hallazgo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property EstadosEstudio $estadosEstudio
 * @property Imagen $imagen
 * @property Modalidad $modalidad
 * @property Orden $orden
 * @property Paciente $paciente
 * @property BirardsHasEstudio[] $birardsHasEstudios
 * @property Lectura[] $lecturas
 */
class Estudios extends Model implements AuditableContract 
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['estadosEstudio', 'imagen', 'modalidad', 'orden', 'paciente', 'birardsHasEstudios', 'lecturas' ];

    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['estados_estudio_id', 'imagen_id', 'modalidad_id', 'orden_id', 'pacientes_id', 'informacion', 'intensidad_media', 'vol_agua', 'vol_total', 'hallazgo', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadosEstudio()
    {
        return $this->belongsTo('App\EstadosEstudio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imagen()
    {
        return $this->belongsTo('App\Imagen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modalidad()
    {
        return $this->belongsTo('App\Modalidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orden()
    {
        return $this->belongsTo('App\Orden');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paciente()
    {
        return $this->belongsTo('App\Paciente', 'pacientes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function birardsHasEstudios()
    {
        return $this->hasMany('App\BirardsHasEstudio', 'estudios_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lecturas()
    {
        return $this->hasMany('App\Lectura', 'estudios_id');
    }
}
