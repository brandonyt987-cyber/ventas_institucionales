<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->timestamps();
            
            // Un usuario no puede tener el mismo producto duplicado en el carrito
            $table->unique(['user_id', 'producto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};