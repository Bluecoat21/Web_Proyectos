<?php

namespace Database\Seeders;

use App\Models\Trabajo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TrabajoSeeder extends Seeder
{
    public function run(): void
    {
        // Ruta donde están las fotos de tus proyectos en seeders
        $projectsSourcePath = database_path('seeders/images/projects');

        // Ejemplo de un proyecto inicial
        $fotoProyecto = 'proyecto1.jpg'; // Asegúrate que este archivo existe en seeders/images/projects/

        if (File::exists($projectsSourcePath . '/' . $fotoProyecto)) {
            // Copiamos la imagen al storage
            Storage::disk('public')->put(
                'trabajos/' . $fotoProyecto,
                File::get($projectsSourcePath . '/' . $fotoProyecto)
            );

            // Creamos el registro que leerá portafolio.blade.php
            Trabajo::create([
                'titulo' => 'Proyecto Académico Demo',
                'categoria' => 'Auditoría',
                'caratula' => 'trabajos/' . $fotoProyecto, // Ruta relativa al disco public
                'pdf' => 'demo.pdf'
            ]);
        }
    }
}