<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        {
        // Llamamos al seeder del administrador
        $this->call([
            AdminUserSeeder::class,
        ]);
        }
        // 1. GESTIÓN DE IMÁGENES ESTÁTICAS (FRONTEND -> PUBLIC)
        // Definimos rutas de origen y destino
        $logoSource = database_path('seeders/images/fronted/logo1.png');
        $publicAssetsPath = public_path('images/assets');

        // Creamos la carpeta en public si no existe
        if (!File::exists($publicAssetsPath)) {
            File::makeDirectory($publicAssetsPath, 0755, true);
        }

        // Copiamos el logo a public para que asset() lo encuentre
        if (File::exists($logoSource)) {
            File::copy($logoSource, $publicAssetsPath . '/logo1.png');
        }


        // 2. PREPARACIÓN DE STORAGE (PROYECTOS -> STORAGE)
        // Aseguramos que la carpeta de trabajos en storage/app/public existe
        Storage::disk('public')->makeDirectory('trabajos');


        // 3. LLAMADA A OTROS SEEDERS
        // Aquí llamamos a TrabajoSeeder pero NO a ServicioSeeder
        $this->call([
            TrabajoSeeder::class,
            // Agrega aquí otros seeders si los creas en el futuro, 
            // pero mantén ServicioSeeder fuera de esta lista.
        ]);
    }
}