<?php

namespace App\Http\Controllers;

use App\Models\Student;

class ReportController extends Controller
{
    public function studentExtracurriculars()
    {
        $students = Student::with(['extracurriculars' => function($query) {
            $query->orderBy('name');
        }])->orderBy('first_name')->paginate(20);

        return view('reports.student_extracurriculars', compact('students'));
    }
}
