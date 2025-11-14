<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen', // Si tienes un campo para imagen
    ];

    // Relación con el usuario vendedor
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
