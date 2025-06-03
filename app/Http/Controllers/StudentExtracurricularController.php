<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Extracurricular;
use App\Models\StudentExtracurricular;
use Illuminate\Http\Request;


class StudentExtracurricularController extends Controller
{
    // Menampilkan ekstrakurikuler siswa
    // StudentExtracurricularController.php
    public function index()
    {
        $students = Student::with('extracurriculars')->get();
        return view('students.extracurriculars.index', compact('students'));
    }

    public function allStudentsWithExtracurriculars()
    {
        // Ambil semua siswa beserta ekstrakurikuler yang diikuti
        $students = Student::with('extracurriculars')->get();

        return view('students.extracurriculars.all', compact('students'));
    }

    public function extracurriculars()
    {   
        return $this->belongsToMany(Extracurricular::class, 'student_extracurricular')
                    ->withPivot('start_year')
                    ->withTimestamps();
    }


    public function create(Student $student)
    {
        $extracurriculars = Extracurricular::all(); // Ambil semua ekskul yang tersedia

        return view('students.extracurriculars.create', compact('student', 'extracurriculars'));
    }

    // Menambahkan ekstrakurikuler ke siswa
    public function store(Request $request, $studentId)
    {
        $request->validate([
            'extracurricular_id' => 'required|exists:extracurriculars,id',
            'start_year' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1)
        ]);

        $student = Student::findOrFail($studentId);

        if ($student->extracurriculars()->where('extracurricular_id', $request->extracurricular_id)->exists()) {
            return back()->with('error', 'Siswa sudah terdaftar di ekstrakurikuler ini');
        }

        $student->extracurriculars()->attach([
            $request->extracurricular_id => ['start_year' => $request->start_year]
        ]);

        return redirect()->route('admin.students.extracurriculars.index', $studentId)
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan');
    }

    // Menghapus ekstrakurikuler dari siswa
    public function destroy($studentId, $extracurricularId)
    {
        $student = Student::findOrFail($studentId);
        $student->extracurriculars()->detach($extracurricularId);

        return back()->with('success', 'Ekstrakurikuler berhasil dihapus');
    }
}
