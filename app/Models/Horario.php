<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medicamento_id',
        'hora_toma',
    ];

    protected $casts = [
        'hora_toma' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un horario pertenece a un medicamento.
     */
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}
