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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('usuario_id')->constrained('users'); 
            $table->date('fecha_emision'); 
            $table->decimal('total', 10, 2); 
            $table->enum('estado', ['pendiente', 'pagada', 'cancelada']); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};