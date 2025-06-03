<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_extracurricular', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('extracurricular_id')->constrained()->onDelete('cascade');
            $table->year('start_year'); 
            $table->timestamps();
            
            $table->unique(['student_id', 'extracurricular_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_extracurricular');
    }
};