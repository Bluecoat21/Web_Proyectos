<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servicio::create([
            "titulo" => "Asesoria Integral de Tesis",
            "descripcion"=> "Acompañamiento desde la eleccion del tema hasta la sustentacion",
            "precio_base" => 650.0]);
        Servicio::create([
            "titulo" =>"Servicio de normas APA y originalidad",
            "descripcion" =>"Revision exhaustiva de citas, referencias y formatos academicos",
            "precio_base" => 70.00]);
        Servicio::create([
            "titulo" => "Analisis Estadistico",
            "descripcion" => "procesamiento de datos y validacion de hipotesis para resultados",
            "precio_base" => 250.00]);
    }
}
