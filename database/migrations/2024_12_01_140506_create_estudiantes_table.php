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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id(); // Identificador único del estudiante
            $table->string('nombre'); // Nombre completo del estudiante
            $table->string('matricula')->unique(); // Número de matrícula único
            $table->string('correo')->nullable(); // Correo electrónico del estudiante
            $table->string('telefono')->nullable(); // Teléfono de contacto del estudiante
            $table->date('fecha_nacimiento')->nullable(); // Fecha de nacimiento del estudiante
            $table->text('direccion')->nullable(); // Dirección del estudiante
            $table->unsignedBigInteger('user_id'); // Relación con la tabla users
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
