<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('proyectos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('caratula'); // Ruta de la imagen (jpg/png)
        $table->string('pdf');      // Ruta del archivo pdf
        $table->string('categoria')->nullable(); // Ej: 'Hidráulica', 'Tesis'
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
