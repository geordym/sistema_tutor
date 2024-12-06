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
        Schema::create('tutores', function (Blueprint $table) {
            $table->id(); // Identificador único del tutor
            $table->string('nombre'); // Nombre completo del tutor
            $table->unsignedBigInteger('area_id')->nullable(); // Especialidad o área de conocimiento del tutor
            $table->unsignedBigInteger('materia_id')->nullable(); // Especialidad o área de conocimiento del tutor

            $table->string('telefono')->nullable(); // Teléfono de contacto del tutor
            $table->string('correo')->nullable(); // Correo electrónico del tutor
            $table->text('direccion')->nullable(); // Dirección del tutor
            $table->unsignedBigInteger('costo_por_hora');
            $table->unsignedBigInteger('user_id'); // Relación con la tabla users
            $table->decimal('saldo')->default(0); 
           
            $table->timestamps();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};
