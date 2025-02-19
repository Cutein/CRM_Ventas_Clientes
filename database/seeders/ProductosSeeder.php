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
        for ($i = 1; $i <= 20; $i++) {
            Producto::create([
                'nombre' => 'Producto ' . $i,
                'descripcion' => 'Descripcion del producto ' . $i,
                'precio' => rand(1000, 5000),
                'cantidad' => rand(1, 50),
            ]);
        }
    }
}
