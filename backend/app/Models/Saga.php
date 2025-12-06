<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Saga extends Model
{
    protected $table = 'sagas';

    protected $fillable = ['nombre', 'descripcion'];

    public function obras(): BelongsToMany
    {
        return $this->belongsToMany(Obra::class, 'obra_saga', 'saga_id', 'obra_id')
                    ->withPivot('orden');
    }
}
