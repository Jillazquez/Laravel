<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profesor;

class ProfesorSeeder extends Seeder
{
    public function run()
    {
        $profesores = [
            ['nombre' => 'Juan', 'email' => 'juan@example.com'],
            ['nombre' => 'María', 'email' => 'maria@example.com'],
            ['nombre' => 'Luis', 'email' => 'luis@example.com'],
            ['nombre' => 'Ana', 'email' => 'ana@example.com'],
            ['nombre' => 'Sofía', 'email' => 'sofia@example.com'],
        ];

        foreach ($profesores as $profesor) {
            Profesor::create($profesor);
        }
    }
}
