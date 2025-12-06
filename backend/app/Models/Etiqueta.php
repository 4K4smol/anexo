<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Etiqueta extends Model
{
    protected $table = 'etiquetas';

    protected $fillable = ['nombre'];

    public function anotaciones(): BelongsToMany
    {
        return $this->belongsToMany(Anotacion::class, 'anotacion_etiqueta', 'etiqueta_id', 'anotacion_id');
    }
}
