<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExtracurricular extends Model
{
    protected $table = 'student_extracurriculars'; // pastikan sesuai dengan nama tabel pivot Anda
    public $timestamps = true; // atau false, tergantung migrasi
}

