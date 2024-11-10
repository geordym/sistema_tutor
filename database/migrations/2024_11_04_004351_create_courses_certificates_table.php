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
        Schema::create('courses_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certify_code'); 
            $table->string('student_fullname'); 
            $table->string('student_curp'); 
            $table->string('course_name');
            $table->integer('course_hour_load'); 
            $table->date('issue_date'); 
            $table->string('instructor_name'); 
            $table->string('certify_path');
            $table->unsignedBigInteger('collaborator_id'); 
            $table->timestamps();
        
            $table->foreign('collaborator_id')->references('id')->on('collaborators')->onDelete('cascade'); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_certificates');
    }
};
