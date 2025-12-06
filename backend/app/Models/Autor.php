<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Autor extends Model
{
    protected $table = 'autores';

    protected $fillable = [
        'nombre',
        'biografia',
        'fecha_nacimiento',
        'fecha_defuncion',
        'nacionalidad',
    ];

    public function obras(): HasMany
    {
        return $this->hasMany(Obra::class, 'autor_id');
    }

    public function ideologias(): BelongsToMany
    {
        return $this->belongsToMany(Ideologia::class, 'autor_ideologia', 'autor_id', 'ideologia_id');
    }
}
