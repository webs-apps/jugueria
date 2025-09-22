<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            // Productos de Venta
            [
                'nombre' => 'Jugo de Naranja',
                'tipo' => 'venta',
                'precio' => 3.50,
                'foto' => null,
            ],
            [
                'nombre' => 'Jugo de Manzana',
                'tipo' => 'venta',
                'precio' => 3.00,
                'foto' => null,
            ],
            [
                'nombre' => 'Jugo de Piña',
                'tipo' => 'venta',
                'precio' => 3.25,
                'foto' => null,
            ],
            [
                'nombre' => 'Jugo de Mango',
                'tipo' => 'venta',
                'precio' => 4.00,
                'foto' => null,
            ],
            [
                'nombre' => 'Jugo de Fresa',
                'tipo' => 'venta',
                'precio' => 3.75,
                'foto' => null,
            ],
            [
                'nombre' => 'Jugo de Zanahoria',
                'tipo' => 'venta',
                'precio' => 2.50,
                'foto' => null,
            ],
            [
                'nombre' => 'Batido de Plátano',
                'tipo' => 'venta',
                'precio' => 4.50,
                'foto' => null,
            ],
            [
                'nombre' => 'Smoothie de Frutas',
                'tipo' => 'venta',
                'precio' => 5.00,
                'foto' => null,
            ],
            
            // Productos de Gasto
            [
                'nombre' => 'Naranjas (kg)',
                'tipo' => 'gasto',
                'precio' => 2.00,
                'foto' => null,
            ],
            [
                'nombre' => 'Manzanas (kg)',
                'tipo' => 'gasto',
                'precio' => 1.80,
                'foto' => null,
            ],
            [
                'nombre' => 'Piñas (unidad)',
                'tipo' => 'gasto',
                'precio' => 1.50,
                'foto' => null,
            ],
            [
                'nombre' => 'Mangos (kg)',
                'tipo' => 'gasto',
                'precio' => 2.50,
                'foto' => null,
            ],
            [
                'nombre' => 'Fresas (kg)',
                'tipo' => 'gasto',
                'precio' => 3.00,
                'foto' => null,
            ],
            [
                'nombre' => 'Zanahorias (kg)',
                'tipo' => 'gasto',
                'precio' => 1.20,
                'foto' => null,
            ],
            [
                'nombre' => 'Plátanos (kg)',
                'tipo' => 'gasto',
                'precio' => 1.50,
                'foto' => null,
            ],
            [
                'nombre' => 'Azúcar (kg)',
                'tipo' => 'gasto',
                'precio' => 1.00,
                'foto' => null,
            ],
            [
                'nombre' => 'Vasos Descartables (paquete)',
                'tipo' => 'gasto',
                'precio' => 2.50,
                'foto' => null,
            ],
            [
                'nombre' => 'Pajillas (paquete)',
                'tipo' => 'gasto',
                'precio' => 1.00,
                'foto' => null,
            ],
            [
                'nombre' => 'Bolsas (paquete)',
                'tipo' => 'gasto',
                'precio' => 0.80,
                'foto' => null,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
