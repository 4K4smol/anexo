<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genero extends Model
{
    protected $table = 'generos';

    protected $fillable = ['nombre'];

    public function obras(): BelongsToMany
    {
        return $this->belongsToMany(Obra::class, 'obra_genero', 'genero_id', 'obra_id');
    }
}
