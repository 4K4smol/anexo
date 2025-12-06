<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coleccion extends Model
{
    protected $table = 'colecciones';

    protected $fillable = ['nombre', 'editorial_id'];

    public function editorial(): BelongsTo
    {
        return $this->belongsTo(Editorial::class, 'editorial_id');
    }

    public function ediciones(): HasMany
    {
        return $this->hasMany(Edicion::class, 'coleccion_id');
    }
}
