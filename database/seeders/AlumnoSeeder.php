<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private function addIdiomasAlumnos(Alumno $alumno, int $numeroIdiomas):void{
        $idiomas = collect(config("idiomas"))->shuffle()->slice(0, $numeroIdiomas);
        $niveles = ["Alto", "Medio", "Bajo"];
        $titulos = ["A1", "A2", "B1", "B2", "C1"];
        $idiomas->each(fn($idioma) => $alumno->idiomas()->create([
            "idioma" => $idioma,
            "nivel" => $niveles[rand(0,2)],
            "titulo" => $titulos[rand(0,4)]
        ]));
    }

    public function run(): void
    {
        $idiomas = config("idiomas");
        $niveles = ["Alto", "Medio", "Bajo"];
        $titulos = ["A1", "A2", "B1", "B2", "C1"];
        Alumno::factory()->count(5)->create()->each(function (Alumno $alumno){
            $numeroIdiomas = rand(0, 4);
            if($numeroIdiomas > 0)
                $this->addIdiomasAlumnos($alumno, $numeroIdiomas);

        });
        //
    }
}
