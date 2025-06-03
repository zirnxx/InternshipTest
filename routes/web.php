<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\StudentExtracurricularController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return "This works, Yatta!";
});

// Authentication Routes (for regular users)
require __DIR__.'/auth.php';

// Authenticated User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication Routes (for guests)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::post('/students', [\App\Http\Controllers\StudentController::class, 'store'])
         ->name('students.store');

        Route::post('/extracurriculars', [\App\Http\Controllers\ExtracurricularController::class, 'store'])
         ->name('extracurriculars.store');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('students', StudentController::class);

        Route::resource('extracurriculars', ExtracurricularController::class);

        Route::resource('student-extracurriculars', StudentExtracurricularController::class);
        
        // Admin Profile Management
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/show', [AdminProfileController::class, 'show'])->name('show');
            Route::get('/edit', [AdminProfileController::class, 'edit'])->name('edit');
            Route::put('/update', [AdminProfileController::class, 'update'])->name('update');
            Route::get('/password/edit', [AdminProfileController::class, 'editPassword'])->name('edit.password');
            Route::put('/password/update', [AdminProfileController::class, 'updatePassword'])->name('update.password');
        });
    });
});

// Student Management Routes
Route::resource('students', StudentController::class)->middleware(['auth', 'verified']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/students', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('admin/students/create', [StudentController::class, 'create'])->name('admin.students.create');
});

// Extracurricular Management Routes
Route::resource('extracurriculars', ExtracurricularController::class)->middleware(['auth', 'verified']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/extracurriculars', [ExtracurricularController::class, 'index'])->name('admin.extracurriculars.index');
    Route::get('admin/extracurriculars/create', [ExtracurricularController::class, 'create'])->name('admin.extracurriculars.create');
});

// Route::middleware(['auth:admin'])->group(function () {
//     Route::get('admin/student-extracurriculars', [StudentExtracurricularController::class, 'index'])->name('admin.student-extracurriculars.index');
//     Route::get('admin/student-extracurriculars/create', [StudentExtracurricularController::class, 'create'])->name('admin.student-extracurriculars.create');
// });

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/students.extracurriculars', [StudentExtracurricularController::class, 'allStudentsWithExtracurriculars'])
        ->name('admin.students.extracurriculars.all');
        // routes/web.php
});

Route::get('/students/extracurriculars', function () {
    return view('students.extracurriculars.index');
})->name('admin.students.extracurriculars.page');

Route::prefix('admin/students/{student}/extracurriculars')
    ->name('admin.students.extracurriculars.')
    ->middleware('auth:admin')
    ->group(function () {
        Route::get('/', [StudentExtracurricularController::class, 'index'])->name('index');
        Route::get('/create', [StudentExtracurricularController::class, 'create'])->name('create');
        Route::post('/', [StudentExtracurricularController::class, 'store'])->name('store');
        Route::delete('/{extracurricular}', [StudentExtracurricularController::class, 'destroy'])->name('destroy');
    });

// Tampilkan halaman daftar siswa dengan aksi tambah/hapus ekstrakurikuler
Route::get('admin/students/extracurriculars/page', [StudentExtracurricularController::class, 'index'])->name('admin.students.extracurriculars.page');

// Tampilkan form tambah ekstrakurikuler untuk siswa spesifik
Route::get('admin/students/{student}/extracurriculars/create', [StudentExtracurricularController::class, 'create'])->name('admin.students.extracurriculars.create');

// Simpan data ekstrakurikuler yang baru ditambahkan ke siswa
Route::post('admin/students/{student}/extracurriculars', [StudentExtracurricularController::class, 'store'])->name('admin.students.extracurriculars.store');

// Hapus keterlibatan ekstrakurikuler dari siswa
Route::delete('admin/students/{student}/extracurriculars/{extracurricular}', [StudentExtracurricularController::class, 'destroy'])->name('admin.students.extracurriculars.destroy');

// Reports Routes
Route::get('/reports/student-extracurriculars', [ReportController::class, 'studentExtracurriculars'])
    ->name('reports.student-extracurriculars')
    ->middleware('auth');
