<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{

    public function run(): void
    {
        // Evitamos duplicar el administrador si vuelves a ejecutar el seeder
        User::updateOrCreate(
            ['email' => 'admin@proyectox.com'], // Cambia esto por tu correo real de administración
            [
                'name' => 'Administrador Proyecto -X',
                'password' => Hash::make('adminqwerty'), // Cambia esto por una contraseña fuerte
            ]
        );
    }
}