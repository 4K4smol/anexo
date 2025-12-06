<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Anotacion extends Model
{
    protected $table = 'anotaciones';

    protected $fillable = [
        'user_id',
        'obra_id',
        'edicion_id',
        'tipo',
        'contenido',
        'cita',
        'pagina_inicio',
        'pagina_fin'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function edicion(): BelongsTo
    {
        return $this->belongsTo(Edicion::class, 'edicion_id');
    }

    public function etiquetas(): BelongsToMany
    {
        return $this->belongsToMany(Etiqueta::class, 'anotacion_etiqueta', 'anotacion_id', 'etiqueta_id');
    }
}
