<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Notificacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'mensaje',
        'leido',
    ];
    protected $casts = [
        'leido' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
