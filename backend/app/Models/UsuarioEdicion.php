<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsuarioEdicion extends Model
{
    protected $table = 'usuario_edicion';

    protected $fillable = [
        'user_id',
        'edicion_id',
        'estado',
        'fecha_inicio',
        'fecha_fin'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function edicion(): BelongsTo
    {
        return $this->belongsTo(Edicion::class, 'edicion_id');
    }
}
