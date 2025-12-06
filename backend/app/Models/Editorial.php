<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Editorial extends Model
{
    protected $table = 'editoriales';

    protected $fillable = ['nombre', 'pais'];

    public function colecciones(): HasMany
    {
        return $this->hasMany(Coleccion::class, 'editorial_id');
    }

    public function ediciones(): HasMany
    {
        return $this->hasMany(Edicion::class, 'editorial_id');
    }
}
