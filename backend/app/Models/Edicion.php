<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Edicion extends Model
{
    protected $table = 'ediciones';

    protected $fillable = [
        'obra_id',
        'editorial_id',
        'coleccion_id',
        'isbn',
        'traductor',
        'anio',
        'paginas',
        'numero_edicion',
        'fuente_externa',
        'id_externo'
    ];

    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function editorial(): BelongsTo
    {
        return $this->belongsTo(Editorial::class, 'editorial_id');
    }

    public function coleccion(): BelongsTo
    {
        return $this->belongsTo(Coleccion::class, 'coleccion_id');
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(UsuarioEdicion::class, 'edicion_id');
    }

    public function anotaciones(): HasMany
    {
        return $this->hasMany(Anotacion::class, 'edicion_id');
    }
}
