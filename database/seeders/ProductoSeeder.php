<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'Uniforme Escolar Azul',
                'descripcion' => 'Uniforme institucional color azul marino para colegios y academias.',
                'precio' => 45.99,
                'stock' => 120,
                'imagen' => 'https://via.placeholder.com/300x300.png?text=Uniforme+Escolar'
            ],
            [
                'nombre' => 'Kit de Materiales Básicos',
                'descripcion' => 'Incluye cuadernos, lapiceros, lápices, borradores y regla.',
                'precio' => 18.50,
                'stock' => 200,
                'imagen' => 'https://via.placeholder.com/300x300.png?text=Kit+Escolar'
            ],
            [
                'nombre' => 'Chaqueta Institucional',
                'descripcion' => 'Chaqueta personalizada con el logo de la institución.',
                'precio' => 65.00,
                'stock' => 60,
                'imagen' => 'https://via.placeholder.com/300x300.png?text=Chaqueta+Institucional'
            ],
            [
                'nombre' => 'Servilleta Institucional',
                'descripcion' => 'Servilleta blanca de 30x30 cm para cafeterías y eventos institucionales.',
                'precio' => 1.25,
                'stock' => 500,
                'imagen' => 'https://via.placeholder.com/300x300.png?text=Servilleta'
            ],
            [
                'nombre' => 'Camisa Corporativa',
                'descripcion' => 'Camisa de presentación con el logo bordado de la empresa.',
                'precio' => 38.99,
                'stock' => 150,
                'imagen' => 'https://via.placeholder.com/300x300.png?text=Camisa+Corporativa'
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
