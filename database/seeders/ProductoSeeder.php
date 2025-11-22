<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario Tienda Oficial como cliente con modo vendedor activado
        $vendedor = User::firstOrCreate(
            ['email' => 'tienda@cliente.com'],
            [
                'nombre' => 'Tienda',
                'apellido' => 'Oficial',
                'role' => 'cliente',       // porque no existe "vendedor"
                'modo_vendedor' => true,   // habilita modo vendedor
                'password' => bcrypt('Ab123456*'),
            ]
        );

        // Lista de productos institucionales
        $productos = [
            [
                'nombre' => 'Kit Escolar Básico',
                'descripcion' => 'Incluye cuadernos, lápices, colores y cartuchera.',
                'precio' => 35000,
                'stock' => 40,
                'imagen' => 'kit-escolar-basico.jpg',
            ],
            [
                'nombre' => 'Uniforme Institucional Masculino',
                'descripcion' => 'Camisa blanca y pantalón azul.',
                'precio' => 120000,
                'stock' => 20,
                'imagen' => 'uniforme-hombre.jpg',
            ],
            [
                'nombre' => 'Uniforme Institucional Femenino',
                'descripcion' => 'Blusa blanca y falda azul.',
                'precio' => 115000,
                'stock' => 18,
                'imagen' => 'uniforme-mujer.jpg',
            ],
            [
                'nombre' => 'Kit de Aseo Personal',
                'descripcion' => 'Incluye jabón, shampoo, crema dental y cepillo.',
                'precio' => 28000,
                'stock' => 50,
                'imagen' => 'kit-aseo.jpg',
            ],
            [
                'nombre' => 'Maleta Institucional',
                'descripcion' => 'Maleta resistente, color negro.',
                'precio' => 90000,
                'stock' => 25,
                'imagen' => 'morral-institucional.jpg',
            ],
            [
                'nombre' => 'Material Didáctico Infantil',
                'descripcion' => 'Material pedagógico para actividades educativas.',
                'precio' => 45000,
                'stock' => 35,
                'imagen' => 'material-didactico.jpg',
            ],
            [
                'nombre' => 'Caja de Colores',
                'descripcion' => 'Caja de 24 colores para uso escolar o artístico.',
                'precio' => 22000,
                'stock' => 60,
                'imagen' => 'colores-profesionales.jpg',
            ],
            [
                'nombre' => 'Compás de Precisión',
                'descripcion' => 'Compás metálico ideal para geometría y dibujo técnico.',
                'precio' => 15000,
                'stock' => 45,
                'imagen' => 'compas.jpg',
            ],
            [
                'nombre' => 'Camiseta Deportiva Institucional',
                'descripcion' => 'Camiseta ligera y transpirable para actividades deportivas.',
                'precio' => 38000,
                'stock' => 30,
                'imagen' => 'camiseta-deportiva.jpg',
            ],
            [
                'nombre' => 'Kit de Seguridad Industrial',
                'descripcion' => 'Incluye guantes, gafas y casco de seguridad.',
                'precio' => 160000,
                'stock' => 15,
                'imagen' => 'kit-seguridad.jpg',
            ],
        ];

        // Crear registros en la base de datos
        foreach ($productos as $item) {
            Producto::create([
                'user_id' => $vendedor->id,
                'nombre' => $item['nombre'],
                'descripcion' => $item['descripcion'],
                'precio' => $item['precio'],
                'stock' => $item['stock'],
                'imagen' => $item['imagen'],
            ]);
        }
    }
}
