@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Daftar Siswa dengan Ekstrakurikuler</h4>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    Kembali ke Daftar Siswa
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Ekstrakurikuler</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->student_id }}</td>
                            <td>
                                @if($student->extracurriculars->isEmpty())
                                    <span class="text-muted">Tidak mengikuti</span>
                                @else
                                    <ul class="list-unstyled mb-0">
                                        @foreach($student->extracurriculars as $extracurricular)
                                        <li>
                                            {{ $extracurricular->name }} 
                                            <small class="text-muted">({{ $extracurricular->pivot->start_year }})</small>
                                            <span class="badge bg-{{ $extracurricular->status == 'Aktif' ? 'success' : 'danger' }}">
                                                {{ $extracurricular->status }}
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td>{{ $student->extracurriculars->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection