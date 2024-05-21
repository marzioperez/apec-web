<?php

namespace Database\Seeders;

use App\Models\Economy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EconomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Economy::create(['name' => 'Australia']);
        Economy::create(['name' => 'Brunei Darussalam']);
        Economy::create(['name' => 'Canadá']);
        Economy::create(['name' => 'Corea']);
        Economy::create(['name' => 'Chile']);
        Economy::create(['name' => 'China']);
        Economy::create(['name' => 'Estados Unidos']);
        Economy::create(['name' => 'Filipinas']);
        Economy::create(['name' => 'Hong Kong']);
        Economy::create(['name' => 'Indonesia']);
        Economy::create(['name' => 'Japón']);
        Economy::create(['name' => 'Malasia']);
        Economy::create(['name' => 'México']);
        Economy::create(['name' => 'Nueva Zelanda']);
        Economy::create(['name' => 'Papúa Nueva Guinea']);
        Economy::create(['name' => 'Perú']);
        Economy::create(['name' => 'Rusia']);
        Economy::create(['name' => 'Singapur']);
        Economy::create(['name' => 'Taiwán']);
        Economy::create(['name' => 'Tailandia']);
        Economy::create(['name' => 'Viernam']);
    }
}
