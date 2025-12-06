<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ideologia extends Model
{
    protected $table = 'ideologias';

    protected $fillable = ['nombre', 'descripcion'];

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'autor_ideologia', 'ideologia_id', 'autor_id');
    }

    public function obras(): BelongsToMany
    {
        return $this->belongsToMany(Obra::class, 'obra_ideologia', 'ideologia_id', 'obra_id')
                    ->withPivot('rol');
    }
}
