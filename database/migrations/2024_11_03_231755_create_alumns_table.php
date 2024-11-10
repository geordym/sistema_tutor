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
        Schema::create('alumns', function (Blueprint $table) {
            $table->id();
            $table->string('fullname'); 
            $table->string('curp')->unique(); 
            $table->timestamps();

            $table->unsignedBigInteger('collaborator_id'); 
            $table->foreign('collaborator_id')->references('id')->on('collaborators')->onDelete('cascade');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumns');
    }
};
