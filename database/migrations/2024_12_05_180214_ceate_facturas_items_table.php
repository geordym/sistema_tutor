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
        Schema::create('facturas_items', function (Blueprint $table) {
            $table->id(); // ID único para el ítem de la factura
            $table->foreignId('factura_id')->constrained('facturas'); // Relación con la tabla facturas
            $table->string('descripcion'); // Descripción del ítem (producto o servicio)
            $table->integer('cantidad'); // Cantidad del producto/servicio
            $table->decimal('precio_unitario', 10, 2); // Precio unitario del producto/servicio
            $table->decimal('subtotal', 10, 2); // Subtotal del ítem (cantidad * precio unitario)
            $table->timestamps(); // Timestamps (created_at, updated_at)
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
