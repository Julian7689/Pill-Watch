<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Dosis extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicamento_id',
        'cantidad',
        'unidad',
        'frecuencia_horas',
    ];
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}
