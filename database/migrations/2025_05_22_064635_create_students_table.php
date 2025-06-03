<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Nama Depan
            $table->string('last_name');  // Nama Belakang
            $table->string('phone_number'); // Nomor HP
            $table->string('student_id')->unique(); // Nomor Induk Siswa
            $table->text('address'); // Alamat
            $table->enum('gender', ['Laki-laki', 'Perempuan']); // Jenis Kelamin
            $table->string('photo')->nullable(); // Foto (path)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};