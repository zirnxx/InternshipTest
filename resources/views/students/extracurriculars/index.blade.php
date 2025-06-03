@extends('layouts.app')

@section('content')
<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
</a>

<h3>Daftar Siswa dan Ekstrakurikuler</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Ekstrakurikuler</th>
            <th>Tahun Mulai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            @php
                $count = $student->extracurriculars->count();
            @endphp

            @if($count > 0)
                @foreach($student->extracurriculars as $index => $extracurricular)
                    <tr>
                        @if($index == 0)
                            <td rowspan="{{ $count }}">{{ $student->name }}</td>
                        @endif
                        <td>{{ $extracurricular->name }}</td>
                        <td>{{ $extracurricular->pivot->tahun_mulai }}</td>
                        <td>
                            <form action="{{ route('admin.students.extracurriculars.destroy', [$student->id, $extracurricular->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ekstrakurikuler ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{{ $student->name }}</td>
                    <td colspan="3">Belum mengikuti ekstrakurikuler</td>
                </tr>
            @endif

            <tr>
                <td colspan="4" class="text-center">
                    <a href="{{ route('admin.students.extracurriculars.create', $student->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Ekstrakurikuler
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
