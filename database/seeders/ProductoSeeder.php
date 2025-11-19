<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Crear vendedor por defecto
        $vendedor = User::firstOrCreate(
            ['email' => 'tienda@oficial.com'],
            [
                'name' => 'Tienda Oficial',
                'role' => 'vendedor',
                'password' => bcrypt('Ab123456*'),
            ]
        );

        // Productos de demo
        Producto::create([
            'user_id' => $vendedor->id,
            'nombre' => 'Laptop Premium',
            'descripcion' => 'Laptop de alta gama para profesionales',
            'precio' => 1500000,
            'stock' => 10,
            'imagen' => null,
        ]);

        Producto::create([
            'user_id' => $vendedor->id,
            'nombre' => 'Mouse Inalámbrico',
            'descripcion' => 'Mouse ergonómico y silencioso',
            'precio' => 50000,
            'stock' => 50,
            'imagen' => null,
        ]);

        Producto::create([
            'user_id' => $vendedor->id,
            'nombre' => 'Teclado Mecánico',
            'descripcion' => 'Teclado con switches mecánicos RGB',
            'precio' => 150000,
            'stock' => 30,
            'imagen' => null,
        ]);
    }
}