<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    
    protected $fillable = [
        'user_id',
        'producto_id',
        'cantidad',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Calcular el subtotal de este item
    public function getSubtotalAttribute()
    {
        return $this->cantidad * $this->producto->precio;
    }
}