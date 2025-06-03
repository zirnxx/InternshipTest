<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('extracurriculars', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Ekstrakurikuler
            $table->string('responsible_person'); // Penanggung Jawab
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif'); // Status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('extracurriculars');
    }
};