<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Obra extends Model
{
    protected $table = 'obras';

    protected $fillable = [
        'titulo',
        'autor_id',
        'fuente_externa',
        'id_externo'
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function ediciones(): HasMany
    {
        return $this->hasMany(Edicion::class, 'obra_id');
    }

    public function generos(): BelongsToMany
    {
        return $this->belongsToMany(Genero::class, 'obra_genero', 'obra_id', 'genero_id');
    }

    public function ideologias(): BelongsToMany
    {
        return $this->belongsToMany(Ideologia::class, 'obra_ideologia', 'obra_id', 'ideologia_id')
                    ->withPivot('rol');
    }

    public function sagas(): BelongsToMany
    {
        return $this->belongsToMany(Saga::class, 'obra_saga', 'obra_id', 'saga_id')
                    ->withPivot('orden');
    }

    public function anotaciones(): HasMany
    {
        return $this->hasMany(Anotacion::class, 'obra_id');
    }
}
