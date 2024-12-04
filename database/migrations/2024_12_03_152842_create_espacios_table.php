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
        Schema::create('espacios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->date('fecha'); // Campo para la fecha del espacio
            $table->time('hora_inicio'); // Hora de inicio
            $table->time('hora_fin'); // Hora de fin
            $table->foreignId('tutor_id')->constrained('tutores'); // Relación con la tabla 'tutores'
            $table->timestamps(); // Tiempos de creación y actualización
            $table->boolean('espacioTomado')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espacios');
    }
};
