<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'responsible_person',
        'status'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_extracurricular')
                    ->withPivot('start_year')
                    ->withTimestamps();
    }
}