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
        Schema::create('citas', function (Blueprint $table) {
            $table->id(); 
            $table->timestamps(); 

            $table->date('fecha'); 
            $table->time('hora_inicio'); 
            $table->time('hora_fin'); 
            $table->unsignedBigInteger('cantidad_personas'); // Relación con la tabla users
            $table->unsignedBigInteger('costo_total'); // Relación con la tabla users

            $table->foreignId('espacio_id')->constrained('espacios')->onDelete('cascade'); // Tutor relacionado
            $table->foreignId('tutor_id')->constrained('tutores')->onDelete('cascade'); // Tutor relacionado
            $table->foreignId('estudiante_id')->constrained()->onDelete('no action');
            $table->string('estado'); // Estado de la cita (pendiente, confirmada, cancelada, etc.)
            $table->string('enlace_reunion')->nullable(); // Enlace de la reunión (por ejemplo, para videollamadas)
            $table->string('tipo'); // Tipo de cita (por ejemplo, "presencial" o "online")
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_citas');
    }
};
