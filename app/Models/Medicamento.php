<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'cantidad', 'user_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function dosis()
    {
        return $this->hasMany(Dosis::class,'medicamento_id','id');
    }
}
