@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .btn-grid {
        display: grid;
        gap: 10px;
    }
    
    .card-header {
        font-weight: 600;
    }
    
    .quick-stat {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
    }
    
    .quick-stat h3 {
        margin-bottom: 5px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Welcome, Admin!</h1>
            <p class="lead">You have successfully logged in.</p>
        </div>
    </div>

    <div class="row">
        <!-- Data Siswa Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-primary text-black">
                    <h5 class="card-title mb-0"><i class="fas fa-users me-2"></i>Data Siswa</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Kelola data siswa termasuk informasi pribadi, NIS, dan kontak.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-1"></i> Daftar Siswa
                        </a>
                        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Siswa Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ekstrakurikuler Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-success text-black">
                    <h5 class="card-title mb-0"><i class="fas fa-futbol me-2"></i>Ekstrakurikuler</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Kelola kegiatan ekstrakurikuler yang tersedia di sekolah.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.extracurriculars.index') }}" class="btn btn-outline-success">
                            <i class="fas fa-list me-1"></i> Daftar Ekstrakurikuler
                        </a>
                        <a href="{{ route('admin.extracurriculars.create') }}" class="btn btn-success">
                            <i class="fas fa-plus me-1"></i> Tambah Ekstrakurikuler
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ekstrakurikuler Siswa Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-warning text-black">
                    <h5 class="card-title mb-0"><i class="fas fa-user-friends me-2"></i>Ekstrakurikuler Siswa</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Kelola data siswa yang mengikuti kegiatan ekstrakurikuler.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.students.extracurriculars.all') }}" class="btn btn-outline-warning">
                            <i class="fas fa-list me-1"></i> Lihat Keterlibatan
                        </a>
                        <a href="{{ route('admin.students.extracurriculars.page') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-1"></i> Tambah Keterlibatan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-info text-black">
                    <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i>Laporan</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Generate laporan partisipasi siswa dalam ekstrakurikuler.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid">
                        <a href="{{ route('reports.student-extracurriculars') }}" class="btn btn-info text-black">
                            <i class="fas fa-file-pdf me-1"></i> Laporan Ekskul Siswa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistik Singkat</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light">
                                <h3 class="text-primary">{{ $studentCount ?? 0 }}</h3>
                                <p class="mb-0">Total Siswa</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light">
                                <h3 class="text-success">{{ $extracurricularCount ?? 0 }}</h3>
                                <p class="mb-0">Ekstrakurikuler</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Di bagian Activity List --}}
<div class="col-md-6">
    <div class="card shadow">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Aktivitas Terakhir</h5>
        </div>
        <div class="card-body">
            @forelse($latestStudents ?? [] as $student)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <strong>{{ $student->first_name }} {{ $student->last_name }}</strong>
                        <small class="d-block text-muted">
                            Ditambahkan: {{ $student->created_at->diffForHumans() }}
                        </small>
                    </div>
                    <a href="{{ route('students.show', $student->id) }}" 
                       class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            @empty
                <p class="text-muted">Belum ada data siswa</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection