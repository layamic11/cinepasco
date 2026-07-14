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
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id(); // Este es el ID automático
            $table->string('titulo'); // Ej: Michael, Star Wars
            $table->string('genero'); // Ej: Terror, Biografía
            $table->string('duracion'); // Ej: 2h 10min
            $table->string('clasificacion'); // Ej: APT, +14
            $table->text('sinopsis')->nullable(); // Texto largo
            $table->string('imagen_poster'); // Ruta de la foto
            $table->string('estado')->default('cartelera'); // Estreno, cartelera, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};